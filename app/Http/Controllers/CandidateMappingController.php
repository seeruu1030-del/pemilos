<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateMapping;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CandidateMappingController extends Controller
{
    /**
     * Display candidate mapping page for OSIS.
     */
    public function osis(): View
    {
        return $this->renderMappingView('OSIS');
    }

    /**
     * Display candidate mapping page for MPK.
     */
    public function mpk(): View
    {
        return $this->renderMappingView('MPK');
    }

    /**
     * Helper to load mapping data for given organization type.
     */
    private function renderMappingView(string $organizationType): View
    {
        // Get candidates filtered by organization type
        $candidates = Candidate::where('organization_type', $organizationType)
            ->orderBy('full_name', 'asc')
            ->get();

        // Get existing mapped Paslon cards for this organization
        $mappings = CandidateMapping::with(['chairman', 'viceChairman'])
            ->where('organization_type', $organizationType)
            ->orderBy('paslon_number', 'asc')
            ->get();

        // If no cards exist yet, auto-initialize 2 default empty cards (Paslon 01 & Paslon 02)
        if ($mappings->isEmpty()) {
            CandidateMapping::create([
                'organization_type' => $organizationType,
                'paslon_number' => 1,
            ]);
            CandidateMapping::create([
                'organization_type' => $organizationType,
                'paslon_number' => 2,
            ]);

            $mappings = CandidateMapping::with(['chairman', 'viceChairman'])
                ->where('organization_type', $organizationType)
                ->orderBy('paslon_number', 'asc')
                ->get();
        }

        // Determine mapped candidate IDs so we can highlight or filter available pool
        $mappedCandidateIds = [];
        foreach ($mappings as $m) {
            if ($m->chairman_id) {
                $mappedCandidateIds[] = $m->chairman_id;
            }
            if ($m->vice_chairman_id) {
                $mappedCandidateIds[] = $m->vice_chairman_id;
            }
        }

        return view('penerimaan.mapping', [
            'activeOrg' => $organizationType,
            'candidates' => $candidates,
            'mappings' => $mappings,
            'mappedCandidateIds' => array_unique($mappedCandidateIds),
        ]);
    }

    /**
     * Store a newly created Paslon mapping card.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'organization_type' => 'required|in:OSIS,MPK',
            'paslon_number' => 'required|integer|min:1',
            'chairman_id' => 'nullable|exists:candidates,id',
            'vice_chairman_id' => 'nullable|exists:candidates,id|different:chairman_id',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'vice_chairman_id.different' => 'Wakil Ketua tidak boleh sama dengan Ketua.',
            'photo.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('paslon-photos', 'public');
            $validated['photo'] = $path;
        }

        CandidateMapping::create($validated);

        return redirect()->back()->with('success', 'Kartu Mapping Paslon No. ' . $validated['paslon_number'] . ' berhasil ditambahkan!');
    }

    /**
     * Update an existing Paslon mapping card.
     */
    public function update(Request $request, CandidateMapping $mapping): RedirectResponse
    {
        $validated = $request->validate([
            'paslon_number' => 'required|integer|min:1',
            'chairman_id' => 'nullable|exists:candidates,id',
            'vice_chairman_id' => 'nullable|exists:candidates,id|different:chairman_id',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'vice_chairman_id.different' => 'Wakil Ketua tidak boleh sama dengan Ketua.',
            'photo.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($mapping->photo && Storage::disk('public')->exists($mapping->photo)) {
                Storage::disk('public')->delete($mapping->photo);
            }

            $path = $request->file('photo')->store('paslon-photos', 'public');
            $validated['photo'] = $path;
        }

        $mapping->update($validated);

        return redirect()->back()->with('success', 'Data Mapping Paslon No. ' . $mapping->paslon_number . ' berhasil diperbarui!');
    }

    /**
     * Remove the specified Paslon mapping card.
     */
    public function destroy(CandidateMapping $mapping): RedirectResponse
    {
        $paslonNum = $mapping->paslon_number;

        if ($mapping->photo && Storage::disk('public')->exists($mapping->photo)) {
            Storage::disk('public')->delete($mapping->photo);
        }

        $mapping->delete();

        return redirect()->back()->with('success', 'Kartu Mapping Paslon No. ' . $paslonNum . ' berhasil dihapus!');
    }
}
