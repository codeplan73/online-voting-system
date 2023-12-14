<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elections = Election::all();
        return view('election.index', ['elections' => $elections]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        return view('election.create', ['positions' => $positions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'position' => ['required'],
            'start_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_date' => ['required', 'date'],
            'end_time' => ['required', 'date_format:H:i'],
            'status' => ['required', 'string'],
        ]);

        $startDateTime = Carbon::parse($request->start_date . ' ' . $request->start_time);
        $endDateTime = Carbon::parse($request->end_date . ' ' . $request->end_time);

        // Check if start date has not passed
        if ($startDateTime->isPast()) {
            return redirect()->back()->with('error', 'The start date and time have already passed.');
        }

        // Check if end date and time are not less than start date and time
        if ($endDateTime->lessThan($startDateTime)) {
            return redirect()->back()->with('error', 'The end date and time should be greater than the start date and time.');
        }

        $existingElection = Election::where('position', $request->position)->exists();

        if ($existingElection) {
            return redirect()->back()->with('error', 'An election for the same position is already scheduled during the specified date and time range.');
        }

        $election = Election::create([
            'position' => $request->position,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ]);

        return redirect('/election')->with('message', $request->position . ' Election Scheduled Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Election $election)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Election $election)
    {
        $positions = Position::all();
        return view('election.edit', [
            'election' => $election,
            'positions' => $positions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Election $election)
    {
        $request->validate([
            'position' => ['required'],
            'start_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_date' => ['required', 'date'],
            'end_time' => ['required'],
            'status' => ['required'],
        ]);

        $startDateTime = Carbon::parse($request->start_date . ' ' . $request->start_time);
        $endDateTime = Carbon::parse($request->end_date . ' ' . $request->end_time);

        // Check if start date has not passed
        if ($startDateTime->isPast()) {
            return redirect()->back()->with('error', 'The start date and time have already passed.');
        }

        // Check if end date and time are not less than start date and time
        if ($endDateTime->lessThan($startDateTime)) {
            return redirect()->back()->with('error', 'The end date and time should be greater than the start date and time.');
        }

        $election->position = $request['position'];
        $election->start_date = $request['start_date'];
        $election->start_time = $request['start_time'];
        $election->end_date = $request['end_date'];
        $election->end_time = $request['end_time'];
        $election->status = $request['status'];

        $election->update();

        return redirect('/election')->with('message', 'Party Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Election $election)
    {
        $election->delete();

        return redirect('/election')->with('message', 'Election deleted Successfully');
    }
}
