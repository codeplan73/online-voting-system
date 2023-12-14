<?php

namespace App\Http\Controllers;

use App\Models\CandidatePosition;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Rules\PdfDocValidationRule;
use App\Rules\ImageValidationRule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CandidatePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = CandidatePosition::where('user_id', auth()->user()->id)->get();
        return view('candidate.index', ['candidates' => $candidates]);
    }

    public function list()
    {
        $candidates = CandidatePosition::all();
        return view('candidate.list', ['candidates' => $candidates]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        return view('candidate.create', ['positions' => $positions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    //     // dd($request->all());

    //     $data = $request->validate([
    //         'position' => 'required',
    //         'certificate_pdf' => ['required', new PdfDocValidationRule],
    //     ]);    

    //     // dd($data);

    //     // Check if the user has already applied for this position
    //     $existingApplication = CandidatePosition::where('user_id', auth()->user()->id)
    //         ->where('position', $data['position'])
    //         ->first();

    //     if ($existingApplication) {
    //         return back()->with('error', 'You have already applied for this position, wait for approval.');
    //     }

    //     $candidatePosition = new CandidatePosition;


    //     if ($request->hasFile('certificate_pdf')) {
    //         $fileName = Str::slug($data['position']). '.' . $request->file('certificate_pdf')->getClientOriginalExtension();

    //         $certificate_pdf = $request->file('certificate_pdf');
    //         $certificate_pdf_Path = $certificate_pdf->storeAs('certificate_pdf', $fileName, 'public');
    //     }

    //     $name = auth()->user()->firstname. ' '. auth()->user()->surname;

        // $candidatePosition->user_id = auth()->user()->id;
        // $candidatePosition->name = $name;
        // $candidatePosition->party = auth()->user()->party;
        // $candidatePosition->position = $data['position'];
        // $candidatePosition->status = 'Pending';
        // $candidatePosition->qualification = $certificate_pdf_Path;

        // $candidatePosition->save();

    //     return redirect('/candidate')->with('message', 'Your application have been submitted successfully, waiting for approval');
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        
        $data = $request->validate([
            'position' => 'required',
            'certificate_pdf' => ['required', new ImageValidationRule],
        ]);

        // Check if the user has already applied for this position
        $existingApplication = CandidatePosition::where('user_id', auth()->user()->id)
            ->where('position', $data['position'])
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this position, wait for approval.');
        }

        $candidatePosition = new CandidatePosition;

        if ($request->hasFile('certificate_pdf')) {
            $fileName = Str::slug($data['position']). '.' . $request->file('certificate_pdf')->getClientOriginalExtension();

            $certificateImage = $request->file('certificate_pdf');
            $certificateImagePath = $certificateImage->storeAs('images', $fileName, 'public');
        }

        $name = auth()->user()->firstname. ' '. auth()->user()->surname;

        // $candidate->user_id = auth()->user()->id;
        // $candidate->name = $name;
        // $candidate->position = $data['position'];
        // $candidate->status = 'Pending';
        // $candidate->qualification = $certificateImagePath;

        $candidatePosition->user_id = auth()->user()->id;
        $candidatePosition->name = $name;
        $candidatePosition->party = auth()->user()->party;
        $candidatePosition->position = $data['position'];
        $candidatePosition->status = 'Pending';
        $candidatePosition->qualification = $certificateImagePath;

        $candidatePosition->save();

        $candidatePosition->save();

        return redirect('/candidate')->with('message', 'Your account was created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CandidatePosition $candidate)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CandidatePosition $candidate)
    {
        return view('candidate.edit', ['candidate' => $candidate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CandidatePosition $candidate)
    {
        // dd($request->all());

        $data = $request->validate([
            'status' => 'required',
        ]);

        $candidate->status = $data['status'];

        $candidate->update();

        return redirect('/candidate-list')->with('message', 'Candidate Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidatePosition $candidate)
    {
        $candidate->delete();

        return redirect('/candidate-list')->with('message', 'Candidate Application deleted Successfully');
    }
}
