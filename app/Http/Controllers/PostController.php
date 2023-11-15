<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function showPosts()
    {
        $posts = DB::table('posts')->orderBy("created_at", "desc")->paginate(10);
        return view("post", compact(""));
    }
    public function create(Request $request)
    {
        return view("post.create");
    }
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe()->only(['name', 'email']);

        $post = DB::table("posts")->insert([
        "user_id" => $validated["user_id"],
        'content' => $validated['content'],
        ]);
        return redirect('/posts');
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
