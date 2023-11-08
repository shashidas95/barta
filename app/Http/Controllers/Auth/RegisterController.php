<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(RegistrationRequest $request)
    {
        // dd($request);
        // $data = $request->all();
        // dd($data);
        $validated = $request->validated();
        dd($validated);
        // Validation has passed; you can now create a new user
        // DB::table('users')->insert([
        //     'name' => $validated->input('name'),
        //     'username' =>$validated->input('username'),
        //     'email' => $validated->input('email'),
        //     'password' => bcrypt($validated->input('password')),
        // ]);
        // auth()->login($user);

        // return redirect('/login');
    }
}
