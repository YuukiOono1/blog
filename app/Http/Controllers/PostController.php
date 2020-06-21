<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
                        ->paginate(6);

        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->file_name = base64_encode(file_get_contents($request->file_name)); // バイナリデータとしてDBに保存
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]); 
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->file_name = base64_encode(file_get_contents($request->file_name)); // バイナリデータとしてDBに保存
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }
}
