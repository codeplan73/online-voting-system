<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elections = Election::all();
        return view('result.index', ['elections' => $elections]);
    }

    public function indexVoter()
    {
        $elections = Election::all();
        return view('result.indexVoter', ['elections' => $elections]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function storeResult(Request $request)
    {
        $position = $request->get('candidate_position');

         // Check if there is an active election for the given position
        $activeElection = Election::where('position', $position)
            ->where('status', 'Active')
            ->exists();

        if (!$activeElection) {
            return back()->with('error', 'There is no result yet for '. $position .' position.');
        }

        // Group by candidate_id and select the candidate with the highest votes
        $voteResult = Vote::where('candidate_position', $position)
        ->select('candidate_id', 'candidate_name', 'candidate_party', DB::raw('COUNT(*) as vote_count'))
        ->groupBy('candidate_id', 'candidate_name', 'candidate_party')
        ->orderByDesc('vote_count')
        ->first();

        // dd($voteResult);

        return view('result.resultShowVoter', [
            'voteResult' => $voteResult,
            'position' => $position
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $position = $request->get('candidate_position');

        // Group by candidate_id and select the candidate with the highest votes
        $voteResult = Vote::where('candidate_position', $position)
        ->select('candidate_id', 'candidate_name', 'candidate_party', DB::raw('COUNT(*) as vote_count'))
        ->groupBy('candidate_id', 'candidate_name', 'candidate_party')
        ->orderByDesc('vote_count')
        ->first();

        // dd($voteResult);

        return view('result.resultShow', [
            'voteResult' => $voteResult,
            'position' => $position
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showResultVoter(Result $result)
    {
        return view('result.showResultVoter');
    }

    public function showResult(Result $result)
    {
        return view('result.showResult');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
