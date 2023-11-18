<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileFormRequest;

class ProfileController extends Controller
{
    public function profile()
    {
        // $user = Auth::user();
        //$email = $user->email;
        return view("auth.profile");
    }
    public function editProfile(Request $request, $userId)
    {
        // Fetch the user data based on a condition, for example, using the user's email
        $user = DB::table('users')->where('id', '=', $userId)->first();

        // Extract the user ID
        $id = $user->id;

        return view("auth.edit-profile", compact("id"));
    }
    public function updateProfile(UpdateProfileFormRequest $request, $id)
    {
        $validated = $request->validated();
        $user = Auth::user();
        if ($user->image) {
            Storage::delete('/storage/app/profile-images/' . $user->image);
        }
        $profileImage = time() . '.' . $request->image->extension();
        // dd($request->image->getMimeType());
        $request->image->move(public_path('profile-images'), $profileImage);
        // dd($id=$user->id);
        DB::table("users")->where('id', $user->id)
            ->update([
                'fname' => $validated['fname'],
                'lname' => $validated['lname'],
                'image' => $profileImage,
                'email' => $validated['email'],
                'password' =>
                Hash::make($validated['password']),
                'bio' => $validated['bio'],
            ]);
        return redirect()->route('profile')->with('success', 'Profile Updated successfully');
    }
    public function showProfile()
    {

    }
}
