<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parties = Party::all();
        return view('party.index', ['parties' => $parties]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('party.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'leader' => ['required', 'string'],
            'manifesto' => ['required', 'string'],
        ]);

        $party = Party::create([
            'name' => $request->name,
            'leader' => $request->leader,
            'manifesto' => $request->manifesto,
        ]);

        return redirect('/party')->with('message', 'Party Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Party $party)
    {
        return view('party.edit', ['party' => $party]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Party $party)
    {
        $data = $request->validate([
            'name' => 'required',
            'leader' => 'required', 
            'manifesto' => 'required',
        ]);

        $party->name = $data['name'];
        $party->leader = $data['leader'];
        $party->manifesto = $data['manifesto'];

        $party->update();

        return redirect('/party')->with('message', 'Party Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Party $party)
    {
        $party->delete();

        return redirect('/party')->with('message', 'Party deleted Successfully');
    }
}
