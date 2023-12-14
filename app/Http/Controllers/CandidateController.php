<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use Illuminate\Http\Request;

use App\Rules\PdfDocValidationRule;
use App\Rules\ImageValidationRule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::where('user_id', auth()->user()->id)->get();
        return view('candidate.index', ['candidates' => $candidates]);
    }

    public function list()
    {
        $candidates = Candidate::all();
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
    //     $data = $request->validate([
    //         'position' => 'required',
    //         'certificate_pdf' => ['required', new PdfDocValidationRule],
    //     ]);    

    //     // Check if the user has already applied for this position
    //     $existingApplication = Candidate::where('user_id', auth()->user()->id)
    //         ->where('position', $data['position'])
    //         ->first();

    //     if ($existingApplication) {
    //         return back()->with('error', 'You have already applied for this position, wait for approval.');
    //     }

    //     $candidate = new Candidate;

    //     if ($request->hasFile('certificate_pdf')) {
    //         $fileName = Str::slug($data['position']). '.' . $request->file('certificate_pdf')->getClientOriginalExtension();

    //         $certificate_pdf = $request->file('certificate_pdf');
    //         $certificate_pdf_Path = $certificate_pdf->storeAs('certificate_pdf', $fileName, 'public');
    //     }

    //     $candidate->user_id = auth()->user()->id;
    //     $candidate->name = auth()->user()->name;
    //     $candidate->position = $data['position'];
    //     $candidate->status = 'Pending';
    //     $candidate->qualification = $certificate_pdf_Path;

    //     $candidate->save();

    //     return redirect('/candidate')->with('message', 'E-Book created successfully');
    // }

    public function store(Request $request)
    {
        dd($request->all());
        
        $data = $request->validate([
            'position' => 'required',
            'certificate_image' => ['required', new ImageValidationRule],
        ]);

        // Check if the user has already applied for this position
        $existingApplication = Candidate::where('user_id', auth()->user()->id)
            ->where('position', $data['position'])
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this position, wait for approval.');
        }

        $candidate = new Candidate;

        if ($request->hasFile('certificate_image')) {
            $fileName = Str::slug($data['position']). '.' . $request->file('certificate_image')->getClientOriginalExtension();

            $certificateImage = $request->file('certificate_image');
            $certificateImagePath = $certificateImage->storeAs('images', $fileName, 'public');
        }

        $candidate->user_id = auth()->user()->id;
        $candidate->name = auth()->user()->name;
        $candidate->position = $data['position'];
        $candidate->status = 'Pending';
        $candidate->qualification = $certificateImagePath;

        $candidate->save();

        return redirect('/candidate')->with('message', 'Application submitted successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        return view('candidate.edit', ['candidate' => $candidate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
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
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return redirect('/candidate-list')->with('message', 'Candidate Application deleted Successfully');
    }
}
