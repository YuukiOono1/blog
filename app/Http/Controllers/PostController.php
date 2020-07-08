<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // キーワード取得
        $keyword = $request->input('keyword');
        
        // キーワードがあれば
        if (isset($keyword))
        {
            // 全角のスペースを半角にする
            $word = str_replace("　", " ", $keyword);

            // スペースを除く
            $keywords = explode(" ", $word);

            $posts = Post::where(function($query) use($keywords){

                foreach($keywords as $keyword) {
                    // DBに対する命令
                    $query->orwhere('title', 'like', "%" .$keyword. "%")
                        ->orwhere('body', 'like', "%" .$keyword. "%");
                }

                return $query;
            })->paginate(6);

        // キーワードがなければ
        } else {
            $posts = Post::orderby('created_at', 'desc')
                            ->paginate(6);
        }
        
        return view('posts.index', ['posts' => $posts, 'keyword' => $keyword]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->file_name = base64_encode(file_get_contents($request->file_name)); // バイナリデータとしてDBに保存
        $post->user_id = $request->user()->id;
        $post->save();

        // カテゴリーを配列で取得、例えば[PHP, Python, Ruby]
        $categories_name = $request->input('categories');
        foreach ($categories_name as $category_name) {
            // null許容
            if ($category_name == null) {
                continue;
            } else {
                // DBに存在するかどうか
                $category = Category::firstOrCreate([
                    'name' => $category_name
                ]);
            $category_ids[] = $category->id;
            }
        }
        // 中間テーブルとカテゴリーテーブルに値を挿入
        $post->category()->attach($category_ids);
        
        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]); 
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->file_name = base64_encode(file_get_contents($request->file_name)); // バイナリデータとしてDBに保存
        $post->user_id = $request->user()->id;
        $post->save();

        // すでにあるカテゴリーの削除
        $post->category()->detach();
        // カテゴリーを配列で取得、例えば[PHP, Python, Ruby]
        $categories_name = $request->input('categories');
        foreach ($categories_name as $category_name) {
            // null許容
            if ($category_name == null) {
                continue;
            } else {
                // DBに存在するかどうか
                $category = Category::firstOrCreate([
                    'name' => $category_name
                ]);
            $category_ids[] = $category->id;
            }
        }
        // 中間テーブルとカテゴリーテーブルに値を挿入
        $post->category()->attach($category_ids);

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
