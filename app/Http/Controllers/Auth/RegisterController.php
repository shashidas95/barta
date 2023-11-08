<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegistrationRequest;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    // public function register(RegistrationRequest $request)
    // {
    //     // dd($request);
    //     // $data = $request->all();
    //     // dd($data);
    //     // $validated = $request->validated();
    //     // dd($validated);

    // }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
            "username" => "required|string|max:50",
        ])->validate();
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // $validated = $validator->validated();
        // $validated = $validator->safe()->only("name", "email");
        // $validated = $validator->safe()->except("username");
        // dd($validated);
    }
}
