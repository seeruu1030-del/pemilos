<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CandidateController extends Controller
{
    /**
     * Display candidate list for Admin-02 (Penerimaan Panitia OSIS & MPK).
     */
    public function index(Request $request): View
    {
        $query = Candidate::query();

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('class_name', 'like', "%{$search}%")
                  ->orWhere('birth_place', 'like', "%{$search}%");
            });
        }

        // Organization Filter (OSIS / MPK)
        if ($request->filled('organization')) {
            $query->where('organization_type', $request->organization);
        }

        // Status Filter (pending / passed / failed)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $candidates = $query->latest()->paginate(15)->withQueryString();

        // Summary Statistics
        $stats = [
            'total' => Candidate::count(),
            'osis' => Candidate::where('organization_type', 'OSIS')->count(),
            'mpk' => Candidate::where('organization_type', 'MPK')->count(),
            'passed' => Candidate::where('status', 'passed')->count(),
            'failed' => Candidate::where('status', 'failed')->count(),
            'pending' => Candidate::where('status', 'pending')->count(),
        ];

        // Announcement Settings
        $announcementStatus = Setting::get('announcement_status', 'draft');
        $announcementDatetime = Setting::get('announcement_datetime', '');
        $whatsappLinkOsis = Setting::get('whatsapp_group_link_osis', '');
        $whatsappLinkMpk = Setting::get('whatsapp_group_link_mpk', '');

        return view('penerimaan.index', compact('candidates', 'stats', 'announcementStatus', 'announcementDatetime', 'whatsappLinkOsis', 'whatsappLinkMpk'));
    }

    /**
     * Display settings page for Admin-02.
     */
    public function settings(): View
    {
        $announcementStatus = Setting::get('announcement_status', 'draft');
        $announcementDatetime = Setting::get('announcement_datetime', '');
        $whatsappLinkOsis = Setting::get('whatsapp_group_link_osis', '');
        $whatsappLinkMpk = Setting::get('whatsapp_group_link_mpk', '');
        $whatsappQrOsis = Setting::get('whatsapp_qr_osis', '');
        $whatsappQrMpk = Setting::get('whatsapp_qr_mpk', '');

        return view('penerimaan.settings', compact(
            'announcementStatus',
            'announcementDatetime',
            'whatsappLinkOsis',
            'whatsappLinkMpk',
            'whatsappQrOsis',
            'whatsappQrMpk'
        ));
    }

    /**
     * Update announcement schedule & WhatsApp group settings (Admin-02).
     */
    public function updateSetting(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'announcement_status' => ['required', Rule::in(['draft', 'scheduled', 'published'])],
            'announcement_datetime' => ['nullable', 'date'],
            'whatsapp_group_link_osis' => ['nullable', 'url', 'max:500'],
            'whatsapp_group_link_mpk' => ['nullable', 'url', 'max:500'],
            'whatsapp_qr_osis' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'whatsapp_qr_mpk' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ], [
            'whatsapp_group_link_osis.url' => 'Format URL Grup WhatsApp OSIS harus berupa link yang valid (misal: https://chat.whatsapp.com/...).',
            'whatsapp_group_link_mpk.url' => 'Format URL Grup WhatsApp MPK harus berupa link yang valid (misal: https://chat.whatsapp.com/...).',
            'whatsapp_qr_osis.image' => 'File QR Code OSIS harus berupa gambar.',
            'whatsapp_qr_mpk.image' => 'File QR Code MPK harus berupa gambar.',
            'whatsapp_qr_osis.max' => 'Ukuran gambar QR Code OSIS maksimal 2MB.',
            'whatsapp_qr_mpk.max' => 'Ukuran gambar QR Code MPK maksimal 2MB.',
        ]);

        Setting::set('announcement_status', $validated['announcement_status']);
        Setting::set('announcement_datetime', $validated['announcement_datetime']);
        Setting::set('whatsapp_group_link_osis', $validated['whatsapp_group_link_osis'] ?? '');
        Setting::set('whatsapp_group_link_mpk', $validated['whatsapp_group_link_mpk'] ?? '');

        // Upload Gambar QR Code OSIS
        if ($request->hasFile('whatsapp_qr_osis')) {
            $file = $request->file('whatsapp_qr_osis');
            $filename = 'qr_osis_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/qr_codes'), $filename);
            Setting::set('whatsapp_qr_osis', 'images/qr_codes/' . $filename);
        }

        // Upload Gambar QR Code MPK
        if ($request->hasFile('whatsapp_qr_mpk')) {
            $file = $request->file('whatsapp_qr_mpk');
            $filename = 'qr_mpk_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/qr_codes'), $filename);
            Setting::set('whatsapp_qr_mpk', 'images/qr_codes/' . $filename);
        }

        return redirect()->back()
            ->with('success', 'Pengaturan sistem pengumuman & QR Code Grup WhatsApp berhasil diperbarui!');
    }

    /**
     * Show form page to create a new candidate.
     */
    public function create(): View
    {
        return view('penerimaan.create');
    }

    /**
     * Store a newly created candidate in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Combine split date fields (Tanggal / Bulan / Tahun) if provided
        if ($request->filled('birth_day') && $request->filled('birth_month') && $request->filled('birth_year')) {
            $day = (int) $request->birth_day;
            $month = (int) $request->birth_month;
            $year = (int) $request->birth_year;

            if (checkdate($month, $day, $year)) {
                $request->merge([
                    'birth_date' => sprintf('%04d-%02d-%02d', $year, $month, $day),
                ]);
            }
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', 'before:today'],
            'gender' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'class_name' => ['required', 'string', 'max:100'],
            'organization_type' => ['required', Rule::in(['OSIS', 'MPK'])],
            'status' => ['nullable', Rule::in(['pending', 'passed', 'failed'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'full_name.required' => 'Nama lengkap calon wajib diisi.',
            'birth_place.required' => 'Tempat lahir wajib diisi.',
            'birth_date.required' => 'Kombinasi Tanggal, Bulan, dan Tahun lahir wajib diisi.',
            'birth_date.before' => 'Tanggal lahir tidak valid.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'class_name.required' => 'Kelas wajib diisi.',
            'organization_type.required' => 'Pilihan organisasi (OSIS/MPK) wajib dipilih.',
        ]);

        $validated['registration_number'] = Candidate::generateRegistrationNumber($validated['organization_type']);
        $validated['status'] = $validated['status'] ?? 'pending';

        Candidate::create($validated);

        return redirect()->route('penerimaan.index')
            ->with('success', 'Calon pengurus ' . $validated['organization_type'] . ' (' . $validated['full_name'] . ') berhasil didaftarkan!');
    }

    /**
     * Show form page to edit an existing candidate.
     */
    public function edit(Candidate $candidate): View
    {
        return view('penerimaan.edit', compact('candidate'));
    }

    /**
     * Update the specified candidate in storage.
     */
    public function update(Request $request, Candidate $candidate): RedirectResponse
    {
        // Combine split date fields (Tanggal / Bulan / Tahun) if provided
        if ($request->filled('birth_day') && $request->filled('birth_month') && $request->filled('birth_year')) {
            $day = (int) $request->birth_day;
            $month = (int) $request->birth_month;
            $year = (int) $request->birth_year;

            if (checkdate($month, $day, $year)) {
                $request->merge([
                    'birth_date' => sprintf('%04d-%02d-%02d', $year, $month, $day),
                ]);
            }
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', 'before:today'],
            'gender' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'class_name' => ['required', 'string', 'max:100'],
            'organization_type' => ['required', Rule::in(['OSIS', 'MPK'])],
            'status' => ['required', Rule::in(['pending', 'passed', 'failed'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $candidate->update($validated);

        return redirect()->route('penerimaan.index')
            ->with('success', 'Data calon ' . $candidate->full_name . ' berhasil diperbarui!');
    }

    /**
     * Quick status update for selection decision.
     */
    public function updateStatus(Request $request, Candidate $candidate): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'passed', 'failed'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $candidate->update($validated);

        $statusMessage = match ($validated['status']) {
            'passed' => 'DITERIMA / LOLOS SELEKSI',
            'failed' => 'TIDAK LOLOS SELEKSI',
            default => 'DIBALIKKAN KE PROSES SELEKSI',
        };

        return redirect()->back()
            ->with('success', "Status seleksi {$candidate->full_name} berhasil diubah menjadi: {$statusMessage}.");
    }

    /**
     * Remove the specified candidate from storage.
     */
    public function destroy(Candidate $candidate): RedirectResponse
    {
        $name = $candidate->full_name;
        $candidate->delete();

        return redirect()->route('penerimaan.index')
            ->with('success', "Data calon {$name} telah dihapus dari sistem.");
    }
}
