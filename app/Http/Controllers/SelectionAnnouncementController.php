<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SelectionAnnouncementController extends Controller
{
    /**
     * Display public landing page.
     */
    public function home(): View
    {
        return view('welcome');
    }

    /**
     * Display dedicated public announcement page with schedule & countdown logic.
     */
    public function index(): View
    {
        $status = Setting::get('announcement_status', 'draft');
        $datetime = Setting::get('announcement_datetime', null);

        $mode = 'in_progress';
        $targetTimestamp = null;

        if ($status === 'published') {
            $mode = 'open';
        } elseif ($status === 'scheduled' && $datetime) {
            $target = Carbon::parse($datetime);
            if ($target->isFuture()) {
                $mode = 'countdown';
                $targetTimestamp = $target->toIso8601String();
            } else {
                $mode = 'open';
            }
        }

        return view('pengumuman.index', [
            'mode' => $mode,
            'targetTimestamp' => $targetTimestamp,
            'datetime' => $datetime,
            'status' => $status,
        ]);
    }

    /**
     * Check selection result by Full Name and Birth Date.
     */
    public function check(Request $request): View
    {
        $status = Setting::get('announcement_status', 'draft');
        $datetime = Setting::get('announcement_datetime', null);

        $mode = 'in_progress';
        $targetTimestamp = null;

        if ($status === 'published') {
            $mode = 'open';
        } elseif ($status === 'scheduled' && $datetime) {
            $target = Carbon::parse($datetime);
            if ($target->isFuture()) {
                $mode = 'countdown';
                $targetTimestamp = $target->toIso8601String();
            } else {
                $mode = 'open';
            }
        }

        // If not open yet, prevent search
        if ($mode !== 'open') {
            return view('pengumuman.index', [
                'mode' => $mode,
                'targetTimestamp' => $targetTimestamp,
                'datetime' => $datetime,
                'status' => $status,
            ]);
        }

        // Combine split date fields securely
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

        $request->validate([
            'full_name' => ['required', 'string', 'min:2', 'max:100'],
            'birth_date' => ['required', 'date'],
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi untuk memeriksa hasil seleksi.',
            'full_name.min' => 'Nama lengkap minimal 2 karakter.',
            'birth_date.required' => 'Tanggal, bulan, dan tahun lahir wajib diisi.',
            'birth_date.date' => 'Kombinasi Tanggal, Bulan, dan Tahun lahir tidak valid.',
        ]);

        $fullName = trim(strip_tags($request->full_name));
        $birthDate = $request->birth_date;

        // Search candidate by name and birth date
        $candidate = Candidate::whereDate('birth_date', $birthDate)
            ->where(function ($q) use ($fullName) {
                $q->where('full_name', 'like', $fullName)
                  ->orWhere('full_name', 'like', "%{$fullName}%");
            })
            ->first();

        return view('pengumuman.index', [
            'candidate' => $candidate,
            'searched' => true,
            'searchName' => $fullName,
            'searchDate' => $birthDate,
            'searchDay' => $request->birth_day ?? Carbon::parse($birthDate)->format('d'),
            'searchMonth' => $request->birth_month ?? Carbon::parse($birthDate)->format('m'),
            'searchYear' => $request->birth_year ?? Carbon::parse($birthDate)->format('Y'),
            'mode' => $mode,
            'targetTimestamp' => $targetTimestamp,
            'datetime' => $datetime,
            'status' => $status,
        ]);
    }
}
