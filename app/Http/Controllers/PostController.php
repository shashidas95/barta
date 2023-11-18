<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function showPosts()
    {
        $users = DB::table('users as u')
            ->join('posts as p', 'u.id', '=', 'p.user_id')
            ->select('u.*', 'p.*')
            ->get();

        $posts = DB::table('posts')->orderBy("created_at", "desc")->get();

        return view("post.posts", compact("posts", "users"));
    }
    public function showPost()
    {
        $users = DB::table('users as u')
            ->join('posts as p', 'u.id', '=', 'p.user_id')
            ->select('u.*', 'p.*')
            ->get();
        return view("post.single-post", compact("users"));
    }
    public function createPost(Request $request)
    {
        $users = DB::table("users")->orderBy("created_at", "desc")->get();
        $posts = DB::table("posts")->orderBy("created_at", "desc")->get();

        return view("post.create", compact("users", "posts"));
    }
    public function storePost(StorePostRequest $request)
    {
        $validated = $request->validated();

        $imageName = time() . '.' . $request->photo_path->extension();
        $request->photo_path->move(public_path('images'), $imageName);

        try {
            DB::table("posts")->insert([
                'user_id' => $validated["user_id"],
                'photo_path' => $imageName,
                'content' => $validated['content'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return redirect()->route('post.show')->with('success', 'The post is created successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function editPost($id)
    {
        $user = Auth::user();
        //retrive post accoding to id
        $post = DB::table('posts')->find($id);
        // Check if the post exists
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }
        return view('post.edit', compact('post', 'user'));
    }



    public function updatePost(UpdatePostRequest $request, $id)
    {
        $validated = $request->validated();
        $user = Auth::user();

        try {
            // Handle image upload
            if ($request->hasFile('photo_path')) {
                // Delete the old image if it exists
                if ($user->photo_path) {
                    Storage::delete('/public/images/' . $user->photo_path);
                }

                // Upload the new image
                $imageName = time() . '.' . $request->photo_path->extension();
                $request->photo_path->move(public_path('images'), $imageName);
            } else {
                // If no new image is uploaded, use the existing one
                $imageName = $user->photo_path;
            }

            // Update the post
            DB::table("posts")->where('user_id', $user->id)->update([
                'user_id' => $validated["user_id"],
                'photo_path' => $imageName,
                'content' => $validated['content'],
                'updated_at' => now()
            ]);

            return redirect()->route('post.show')->with('success', 'The post is updated successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function deletePost($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        // If it's a GET request, display the confirmation form
        if (request()->isMethod('get')) {
            return view('post.delete', ['post' => $post]);
        }
        $user = Auth::user();
        // Check if the logged-in user is the author of the post
        if ($user->id !== $post->user_id) {
            return redirect()->route('post.show')->with('error', 'Unauthorized');
        }

        DB::table("posts")->where('user_id', $user->id)->delete();
        return redirect()->route('post.show')->with('success', 'Post deleted successfully');
    }
}
