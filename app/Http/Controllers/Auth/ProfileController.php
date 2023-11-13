<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileFormRequest;

class ProfileController extends Controller
{
    public function profile()
    {
       // $user = Auth::user();
        //$email = $user->email;
        return view("auth.profile" );
    }
    public function editProfile(Request $request)
    {
        $user = Auth::user();
        return view("partials.edit-profile", compact("user"));
    }
    public function updateProfile(UpdateProfileFormRequest $request, $id)
    {
        $validated = $request->validated();
        $user = Auth::user();
        

        DB::table("users")->where($id, $user->id)
            ->update([
                'fname' => $validated['fname'],
                'lname' => $validated['lname'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'bio' => $validated['bio'],
            ]);
        return redirect()->route('profile')->with('success', 'Profile Updated successfully');
    }
}
