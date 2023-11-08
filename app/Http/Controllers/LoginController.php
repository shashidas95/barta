<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;

class LoginController extends Controller
{
    // public function loginPage(Request $request)
    // {

    //     return view("login");
    // }
    // public function login()
    // {

    //     return view("login");
    // }
    public function registerPage(RegisterFormRequest $request)
    {


        return view("register");
    }
    public function register(RegisterFormRequest $request)
    {

        // dd($request->all());
        $validated = $request->validate([]);
        dd($validated);
    }
    // public function profilePage()
    // {

    //     return view("profile");
    // }
    // public function profile(Request $request)
    // {

    //     return view("profile");
    // }
}
