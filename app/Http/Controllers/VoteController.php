<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Position;
use App\Models\Election;
use App\Models\CandidatePosition;
use App\Models\Party;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $votes = Vote::all();
        return view('vote.index', ['votes' => $votes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showCandidateVoting()
    {

        $candidates = CandidatePosition::where('status', 'Approved')->get();
        $positions = Election::where('status', 'Active')->get();
        $elections = Election::where('status', 'Active')->get();

        $startDate = $elections[0]->start_date;
        $startTime = $elections[0]->start_time;

        // dd($elections[0]->start_time);
        
        return view('vote.candidate-vote', [
            'candidates' => $candidates,
            'positions' => $positions,
            'positions' => $positions,
            'startDate' => $startDate,
            'startTime' => $startTime,

        ]);
    }

    public function showVotersVoting()
    {
        $candidates = CandidatePosition::where('status', 'Approved')->get();
        $positions = Election::where('status', 'Active')->get();
        $elections = Election::where('status', 'Active')->get();

        // Check if there is an active election
        if ($elections->isEmpty()) {
            return back()->with('error', 'There is no active election now.');
        }

        $startDate = $elections[0]->start_date;
        $startTime = $elections[0]->start_time;

        

        // dd($election); 
        return view('vote.voters-vote', [
            'candidates' => $candidates,
            'positions' => $positions,
            'positions' => $positions,
            'startDate' => $startDate,
            'startTime' => $startTime,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeVoterVote(Request $request)
    {
        $request->validate([
            'candidate_position' => ['required', 'string'],
            'candidate_name' => ['required', 'string'],
            'candidate_id' => ['required', 'string'],
            'candidate_party' => ['required', 'string'],
        ]);

        // Check if the user has already voted
        $userHasVoted = Vote::where('voter_id', auth()->user()->id)->where('candidate_id', $request->candidate_id)->exists();

        if ($userHasVoted) {
            return back()->with('error', 'You have already voted. Each user is allowed to vote only once.');
        }

        $name = auth()->user()->firstname . ' ' . auth()->user()->surname;

        $vote = Vote::create([
            'candidate_position' => $request->candidate_position,
            'candidate_name' => $request->candidate_name,
            'candidate_id' => $request->candidate_id,
            'candidate_party' => $request->candidate_party,
            'voter_id' =>  auth()->user()->id,
            'voter_name' => $name,
        ]);

        return redirect('/candidate')->with('message', $name . ' You vote was recorded successfully');
    }


    public function storeCandidateVote(Request $request)
    {
        $request->validate([
            'candidate_position' => ['required', 'string'],
            'candidate_name' => ['required', 'string'],
            'candidate_id' => ['required', 'string'],
            'candidate_party' => ['required', 'string'],
        ]);

        // Check if the user has already voted
        $userHasVoted = Vote::where('voter_id', auth()->user()->id)->where('candidate_id', $request->candidate_id)->exists();

        if ($userHasVoted) {
            return back()->with('error', 'You have already voted. Each user is allowed to vote only once.');
        }

        $name = auth()->user()->firstname . ' ' . auth()->user()->surname;

        $vote = Vote::create([
            'candidate_position' => $request->candidate_position,
            'candidate_name' => $request->candidate_name,
            'candidate_id' => $request->candidate_id,
            'candidate_party' => $request->candidate_party,
            'voter_id' =>  auth()->user()->id,
            'voter_name' => $name,
        ]);

        return redirect('/dashboard')->with('message', $name . ' You vote was recorded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
