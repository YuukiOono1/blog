<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) 
    {
        // 記事に紐づいたユーザーの情報を取得
        $user = User::find($id);

        // ユーザー紐づいた記事の一覧を作成順に表示
        $posts = Post::with('user')->orderBy('created_at', 'desc')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('name', $user->name);
            })->paginate(1);

        return view('users.show', ['user' => $user, 'posts' => $posts]);

        // カテゴリーの詳細と同じで、 下記のようにならないの何故？
        // public function show(User $user) {
                // 処理
        // }
    }
}
