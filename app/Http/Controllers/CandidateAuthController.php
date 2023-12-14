<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CandidatePosition;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\Party;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class CandidateAuthController extends Controller
{
    public function home()
    {
        $positions = CandidatePosition::where('user_id', auth()->user()->id)->get();
        return view('candidate.dashboard', ['positions' => $positions]);
    }

    public function showLogin()
    {
        return view('auth-candidate.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]); 

        if (Auth::guard('candidate')->attempt($credentials)) {
            return redirect()->intended('/candidate');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        
    }

    public function showRegister()
    {
        $parties = Party::all();
        return view('auth-candidate.register', ['parties' => $parties]);
    }

    public function register(Request $request)
    { 
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Candidate::class],
            'party' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'contact' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $dob = Carbon::parse($request['dob']);
        $today = Carbon::now();
        $age = $dob->diffInYears($today);

        $candidate = Candidate::create([
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'email' => $request->email,
            'party' => $request->party,
            'dob' => $request->dob,
            'age' => $age,
            'contact' => $request->contact,
            'address' => $request->address,
            'gender' => $request->gender,
            'level' => 'Candidate',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($candidate));

        return redirect('candidate-login')->with('message', 'Your account was created successfully');
    }

    public function logout()
    {
        Auth::guard('candidate')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('candidate.showLogin');
    }
}
 