<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultiStepFormController extends Controller
{
    public function step1()
    {
        return view('step1');
    }

    public function step1Post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Store the user's name and email in the session for later use
        session(['name' => $request->name, 'email' => $request->email]);

        return redirect('/multi-step-form/step2');
    }

    public function step2()
    {
        return view('step2');
    }

    public function step2Post(Request $request)
    {
        // Additional validation for step 2, if needed

        // Retrieve the user's name and email from the session
        $name = session('name');
        $email = session('email');

        // Handle step 2 data and store it if necessary
        $request->validate([
            'phone' => 'string|required',
        ]);
        session()->push('phone', $request->phone);
        return redirect('/multi-step-form/submit');
    }

    public function submit()
    {
        // Retrieve the user's name and email from the session
        $name = session('name');
        $email = session('email');
        $phone = session('phone');

        // Perform any final processing

        // Display the flash message
        session()->flash('message', "Thank you, $name! Your email address ($email) and $phone has been recorded.");

        // Reset the session data
        session()->forget('name');
        session()->forget('email');
        session()->forget('phone');

        return view('final');
    }
}
