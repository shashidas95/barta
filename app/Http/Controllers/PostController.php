<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function showPosts()
    {

        // $users = DB::table('users')
        //     ->join('users', 'users.id', '=', 'posts.user_id')
        //     ->select('users.*', 'posts.*') // Adjust the columns you want to select
        //     ->get();
        $users = DB::table('users as u')
            ->join('posts as p', 'u.id', '=', 'p.user_id')
            ->select('u.*', 'p.*')
            ->get();

        $posts = DB::table('posts')->orderBy("created_at", "desc")->paginate(10);
        return view("post.posts", compact("posts", "users"));
    }
    public function create(Request $request)
    {
        $users = DB::table("users")->orderBy("created_at", "desc")->get();
        $posts = DB::table("posts")->orderBy("created_at", "desc")->get();

        return view("post.create", compact("users", "posts"));
    }
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $imageName = time() . '.' . $request->photo_path->extension();
        $request->photo_path->move(public_path('images'), $imageName);

        // $request->image->move(public_path('images'), $imageName);
        // public/images/file.png
        // $request->image->storeAs('images', $imageName);
        // storage/app/images/file.png
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
    public function edit(Request $request)
    {
    }
    public function update(Request $request)
    {
    }
    public function destroyPost(Request $request)
    {
    }
}
