<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\Position;
use App\Models\User;
use App\Models\Vote;
use App\Models\VoteDateTime;

class HomeController extends Controller
{
    public function index()
    {
        dd('this is cool');
        return view('dashboard');
    }
}
