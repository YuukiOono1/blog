<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserDeleteMail;
use App\Mail\UserUpdateMail;

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
            })->paginate(6);

        return view('users.show', ['user' => $user, 'posts' => $posts]);
    }

    public function edit(User $user, Request $request)
    {
        $data = $request->all();
        $request->session()->put($data); 

        return view('users.edit', ['user' => $user, 'data' => $data]);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = session()->all();
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->save();
        $to = $user->email;
        $new_name = $user->name;
        $new_email = $user->email;
        Mail::to($to)->send(new UserUpdateMail($new_name, $new_email));
        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        $to = $user->email;
        Mail::to($to)->send(new UserDeleteMail());
        return redirect()->route('users.show', ['user' => $user]);
    }
}
