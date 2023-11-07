<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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

Route::get('/', function (Request $request) {
    //    dd( Session::all());
    session()->put('name', 'rashi');
    // session(["team" => [
    //     "s",
    //     "r",
    //     "h",
    // ]]);
    // session()->push('team', 'shash');
    // session()->forget(['team', 'name']);
    // session()->flush();
    // echo session()->increment('visitors');

    return view('welcome');
});
// Route::get('/multi-step-form', [MultiStepFormController::class, 'step1']);
// Route::post('/multi-step-form', [MultiStepFormController::class, 'step1Post']);
// Route::get('/multi-step-form/step2', [MultiStepFormController::class, 'step2']);
// Route::post('/multi-step-form/step2', [MultiStepFormController::class, 'step2Post']);
// Route::post('/multi-step-form/submit',  [MultiStepFormController::class, 'submit']);
