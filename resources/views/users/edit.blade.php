@extends('layouts')

@section('title', '確認画面')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
            @method('PATCH')
            @csrf
            <h1 class="dark-grey-text text-center mb-5"><strong>入力確認</strong></h1>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">ユーザーネーム</th>
                        <td>{{ $data["name"] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">メールアドレス</th>
                        <td>{{ $data["email"] }}</td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn default-color btn-block btn-rounded z-depth-1a"><span class="white-text">更新する</span></button>
        </form>
        <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-4">
            <a href="{{ route("users.show", ['user' => Auth::id()]) }}">マイページに戻る</a>
        </p>
    </div>
</div>
@endsection