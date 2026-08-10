<?php

namespace App\Http\Controllers;

use App\Models\CandidateMapping;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PemilosController extends Controller
{
    /**
     * Display the OSIS E-Voting selection page for Admin-01.
     */
    public function index(): View
    {
        $mappings = CandidateMapping::with([
                'chairman:id,full_name,class_name',
                'viceChairman:id,full_name,class_name'
            ])
            ->where('organization_type', 'OSIS')
            ->orderBy('paslon_number', 'asc')
            ->get();

        return view('pemilos.vote', compact('mappings'));
    }

    /**
     * Store candidate vote securely with atomic increment.
     */
    public function storeVote(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'paslon_id' => 'required|integer|exists:candidate_mappings,id',
        ]);

        $mapping = CandidateMapping::where('id', $validated['paslon_id'])
            ->where('organization_type', 'OSIS')
            ->firstOrFail();

        // Increment vote count atomically to ensure lightweight DB execution
        $mapping->increment('votes_count');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vote Anda telah berhasil terkirim!',
                'paslon_number' => $mapping->paslon_number,
            ]);
        }

        return redirect()->route('pemilos.vote')
            ->with('vote_success', true)
            ->with('voted_paslon', $mapping->paslon_number);
    }

    /**
     * Display the Real Count monitoring dashboard.
     */
    public function realCount(): View
    {
        return view('pemilos.realcount');
    }

    /**
     * API Endpoint for fetching live Real Count data.
     */
    public function realCountData(): JsonResponse
    {
        $mappings = CandidateMapping::with([
                'chairman:id,full_name,class_name',
                'viceChairman:id,full_name,class_name'
            ])
            ->where('organization_type', 'OSIS')
            ->orderBy('paslon_number', 'asc')
            ->get();

        $totalVotes = (int) $mappings->sum('votes_count');

        $formattedMappings = $mappings->map(function ($mapping) use ($totalVotes) {
            $votes = (int) $mapping->votes_count;
            $percentage = $totalVotes > 0 ? round(($votes / $totalVotes) * 100, 1) : 0;

            return [
                'id' => $mapping->id,
                'paslon_number' => $mapping->paslon_number,
                'chairman_name' => $mapping->chairman ? $mapping->chairman->full_name : 'Belum di-mapping',
                'vice_chairman_name' => $mapping->viceChairman ? $mapping->viceChairman->full_name : 'Belum di-mapping',
                'chairman_class' => $mapping->chairman ? $mapping->chairman->class_name : '-',
                'vice_chairman_class' => $mapping->viceChairman ? $mapping->viceChairman->class_name : '-',
                'photo_url' => $mapping->photo_url,
                'vision' => $mapping->vision,
                'mission' => $mapping->mission,
                'votes_count' => $votes,
                'percentage' => $percentage,
            ];
        });

        return response()->json([
            'success' => true,
            'total_votes' => $totalVotes,
            'mappings' => $formattedMappings,
            'updated_at' => now()->translatedFormat('H:i:s') . ' WIB',
        ])->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    /**
     * Display the MPK E-Voting selection page for Admin-03.
     */
    public function indexMpk(): View
    {
        $mappings = CandidateMapping::with([
                'chairman:id,full_name,class_name',
                'viceChairman:id,full_name,class_name'
            ])
            ->where('organization_type', 'MPK')
            ->orderBy('paslon_number', 'asc')
            ->get();

        return view('pemilos.vote_mpk', compact('mappings'));
    }

    /**
     * Store MPK candidate vote securely with atomic increment.
     */
    public function storeVoteMpk(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'paslon_id' => 'required|integer|exists:candidate_mappings,id',
        ]);

        $mapping = CandidateMapping::where('id', $validated['paslon_id'])
            ->where('organization_type', 'MPK')
            ->firstOrFail();

        $mapping->increment('votes_count');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vote MPK Anda telah berhasil terkirim!',
                'paslon_number' => $mapping->paslon_number,
            ]);
        }

        return redirect()->route('pemilos.mpk.vote')
            ->with('vote_success', true)
            ->with('voted_paslon', $mapping->paslon_number);
    }

    /**
     * Display the Real Count MPK monitoring dashboard.
     */
    public function realCountMpk(): View
    {
        return view('pemilos.realcount_mpk');
    }

    /**
     * API Endpoint for fetching live Real Count MPK data.
     */
    public function realCountDataMpk(): JsonResponse
    {
        $mappings = CandidateMapping::with([
                'chairman:id,full_name,class_name',
                'viceChairman:id,full_name,class_name'
            ])
            ->where('organization_type', 'MPK')
            ->orderBy('paslon_number', 'asc')
            ->get();

        $totalVotes = (int) $mappings->sum('votes_count');

        $formattedMappings = $mappings->map(function ($mapping) use ($totalVotes) {
            $votes = (int) $mapping->votes_count;
            $percentage = $totalVotes > 0 ? round(($votes / $totalVotes) * 100, 1) : 0;

            return [
                'id' => $mapping->id,
                'paslon_number' => $mapping->paslon_number,
                'chairman_name' => $mapping->chairman ? $mapping->chairman->full_name : 'Belum di-mapping',
                'vice_chairman_name' => $mapping->viceChairman ? $mapping->viceChairman->full_name : 'Belum di-mapping',
                'chairman_class' => $mapping->chairman ? $mapping->chairman->class_name : '-',
                'vice_chairman_class' => $mapping->viceChairman ? $mapping->viceChairman->class_name : '-',
                'photo_url' => $mapping->photo_url,
                'vision' => $mapping->vision,
                'mission' => $mapping->mission,
                'votes_count' => $votes,
                'percentage' => $percentage,
            ];
        });

        return response()->json([
            'success' => true,
            'total_votes' => $totalVotes,
            'mappings' => $formattedMappings,
            'updated_at' => now()->translatedFormat('H:i:s') . ' WIB',
        ])->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
