<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) 
    {
        // 記事に紐づいたユーザーの情報を取得
        $user = User::find($id);

        // ユーザーに紐づいた記事を作成順に表示, ページネーションできない・・
        $posts = $user->post
            ->sortby('created_at');
        //  ->paginate(1)
        
        return view('users.show', ['user' => $user, 'posts' => $posts]);

        // カテゴリーの詳細と同じで、 下記のようにならないの何故？
        // public function show(User $user) {
                // 処理
        // }
    }
}
