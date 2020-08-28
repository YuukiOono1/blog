<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin'); // ミドルウェアを追加
    }

    public function index()
    {
        $posts = Post::orderby('new_id', 'asc')->get();
        return view('admin.index', ['posts' => $posts]);
    }

    public function sort(Request $request)
    {
        // 元々のidを配列で
        $id = Post::pluck('id');
        for ($i = 0; $i < count($request->new_ids); $i++) { // 11回回す
            $post = Post::find($request->new_ids[$i]); // モデルの取得[id番目]
            $post->new_id = $id[$i]; // 記事のid
            $post->save();
         }
         return redirect()->route('admin.index');
    }

    public function show(Post $post)
    {
        return view('admin.show', ['post' => $post]);
    }
}
