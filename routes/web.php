<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MultiStepFormController;

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

// Route::get('/', function (Request $request) {
//     //    dd( Session::all());
//     // session()->put('name', 'rashi');
//     // session(["team" => [
//     //     "s",
//     //     "r",
//     //     "h",
//     // ]]);
//     // session()->push('team', 'shash');
//     // session()->forget(['team', 'name']);
//     // session()->flush();
//     // echo session()->increment('visitors');

//     return view('register');
// });

// Route::get('/login', [LoginController::class, 'loginPage']);
// Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'registerPage']);
Route::post('/register', [LoginController::class, 'register']);
// Route::get('/profile/edit', [LoginController::class, 'profilePage']);
// Route::post('/profile', [LoginController::class, 'profile']);
