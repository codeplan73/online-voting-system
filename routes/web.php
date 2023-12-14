<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CandidatePositionController;
use App\Http\Controllers\CandidateAuthController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

use App\Models\Party;
use App\Models\Position;
use App\Models\User;
use App\Models\CandidatePosition;
use App\Models\Vote;
use App\Models\VoteDateTime;
use App\Models\Election;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/admin', [PagesController::class, 'admin'])->name('admin');


Route::get('/dashboard', function () {
    $users = User::all();
    $candidatePosition = CandidatePosition::all();
    $confirmedApplication = CandidatePosition::where('status', 'Approved')->get();
    $party = Party::all();

    return view('dashboard', [
        'users' => $users,
        'candidatePosition' => $candidatePosition,
        'confirmedApplication' => $confirmedApplication,
        'party' => $party,
    ]);
    
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // party
    Route::get('/party', [PartyController::class, 'index'])->name('party.list');
    Route::get('/party-create', [PartyController::class, 'create'])->name('party.create');
    Route::post('/party', [PartyController::class, 'store'])->name('party.register');
    Route::get('/party/{party}/edit', [PartyController::class, 'edit'])->name('party.edit');
    Route::put('/party/{party}', [PartyController::class, 'update'])->name('party.update');
    Route::delete('/party/{party}', [PartyController::class, 'destroy'])->name('party.delete');
    
    
    // position
    Route::get('/position', [PositionController::class, 'index'])->name('position.list');
    Route::get('/position-create', [PositionController::class, 'create'])->name('position.create');
    Route::post('/position', [PositionController::class, 'store'])->name('position.register');
    Route::get('/position/{position}/edit', [PositionController::class, 'edit'])->name('position.edit');
    Route::put('/position/{position}', [PositionController::class, 'update'])->name('position.update');
    Route::delete('/position/{position}', [PositionController::class, 'destroy'])->name('position.delete');


    // candidates
    Route::get('candidate-list', [CandidatePositionController::class, 'list'])->name('candidate.list');

    Route::get('candidate', [CandidatePositionController::class, 'index'])->name('candidate.list');
    Route::get('candidate/{candidate}/edit', [CandidatePositionController::class, 'edit'])->name('candidate.edit');
    Route::put('candidate/{candidate}', [CandidatePositionController::class, 'update'])->name('candidate.update');
    Route::delete('candidate/{candidate}', [CandidatePositionController::class, 'destroy'])->name('candidate.delete');

    // ellection
    Route::get('/election', [ElectionController::class, 'index'])->name('election.index');
    Route::get('/election-create', [ElectionController::class, 'create'])->name('election.create');
    Route::post('/election', [ElectionController::class, 'store'])->name('election.store');
    Route::get('/election/{election}/edit', [ElectionController::class, 'edit'])->name('election.edit');
    Route::put('/election/{election}', [ElectionController::class, 'update'])->name('election.update');
    Route::delete('/election/{election}', [ElectionController::class, 'destroy'])->name('election.delete');

    // vote
    Route::get('/voter-vote', [VoteController::class, 'showVotersVoting'])->name('vote.showVotersVoting');
    Route::post('/voter-vote', [VoteController::class, 'storeVoterVote'])->name('vote.storeVoterVote');
    
    // results
    Route::get('/result-voter', [ResultController::class, 'indexVoter'])->name('result.indexVoter');
    Route::post('/result-voter', [ResultController::class, 'storeResult'])->name('result.storeResult');
    Route::get('/show-result-voter', [ResultController::class, 'showResultVoter']);
});


Route::get('/candidate-login', [CandidateAuthController::class, 'showLogin'])->name('candidate.showLogin');
Route::post('/candidate-login', [CandidateAuthController::class, 'login'])->name('candidate.login');

Route::get('/candidate-register', [CandidateAuthController::class, 'showRegister'])->name('candidate.showRegister');
Route::post('/candidate-register', [CandidateAuthController::class, 'register'])->name('candidate.register');


Route::middleware(['auth:candidate'])->group(function () {
    Route::get('/candidate', [CandidateAuthController::class, 'home'])->name('candidate.home');
    Route::get('candidate-create', [CandidatePositionController::class, 'create'])->name('candidate.create');
    Route::post('candidate', [CandidatePositionController::class, 'store'])->name('candidate.create-position');

    Route::get('/candidate-logout', [CandidateAuthController::class, 'logout'])->name('candidate.logout');


    // vote
    // Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
    Route::get('/candidate-vote', [VoteController::class, 'showCandidateVoting'])->name('vote.showCandidateVoting');
    Route::post('/vote', [VoteController::class, 'storeCandidateVote'])->name('vote.storeCandidateVote');

    Route::get('/vote/{vote}/edit', [VoteController::class, 'edit'])->name('vote.edit');
    Route::put('/vote/{vote}', [VoteController::class, 'update'])->name('vote.update');
    Route::delete('/vote/{vote}', [VoteController::class, 'destroy'])->name('vote.delete');

    // result
    Route::get('/result', [ResultController::class, 'index'])->name('result.index');
    Route::post('/result', [ResultController::class, 'store'])->name('result.store');
    Route::get('/show-result', [ResultController::class, 'showResult']);
});

require __DIR__.'/auth.php';
