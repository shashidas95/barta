<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/practise', function () {

    return view('welcome');
});
Route::get('/', function () {
    $user = Auth::user();
   // $email = $user->email;
    return view('layouts.app', compact('user'));
});

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.action');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
//profile routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit/{id}', [ProfileController::class, 'editProfile'])->name('editProfile');
    Route::post('/profile/update/{id}', [ProfileController::class, 'updateProfile'])->name('updateProfile');
});
Route::get('/posts', [PostController::class,'showPosts'])->name('post.show');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post', [PostController::class, 'store'])->name('post.store');

Route::post('/posts/edit/{id}', [PostController::class,'editPost'])->name('post.edit');
Route::post('/posts/update/{id}', [PostController::class,'updatePost'])->name('post.update');

