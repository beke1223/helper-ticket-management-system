<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\GithubAuthController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use OpenAI\Laravel\Facades\OpenAi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
    // $users=DB::select("select * from users "); //db facade
    // DB::insert("insert into users ( name , email, password) values (?,?,?)",['asebekalu','adad5454','8877']);
    return view('welcome');

    // $users=User::where('id',1)->first();


    // dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
});

require __DIR__ . '/auth.php';

Route::get('/auth/redirect', [GithubAuthController::class, 'GithubAuthUser'])->name("auth.redirect");

Route::get('/auth/callback', [GithubAuthController::class, 'GithubAuthentication'])->name("auth.callback");

Route::get('/openai', [AvatarController::class,'createAvatar'])->name('profile.avatar.ai');



Route::middleware('auth')->group(function () {
    // Route::get("/ticket/create",[TicketController::class,'create'])->name('ticket.create');
    // Route::post("/ticket/create",[TicketController::class,'store'])->name('ticket.store');

    Route::resource('/ticket', TicketController::class);
});
