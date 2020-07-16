@extends('layouts')

@section('title', 'マイページ')

@section('content')
<div class="card mt-3">
    @if (Auth::id() === $user->id )
    <div class="mx-auto mt-4">
        <h1>マイページ</h1>
    </div>
    @endif
    <div class="card-body mx-auto">
        <i class="fas fa-user-circle fa-3x"></i>
    </div>
    <div class="mx-auto">
        <p class="lead">{{ $user->name }}</p>
    </div>

    @if (Auth::id() === $user->id)
    <!-- Nav tabs -->
    <ul class="nav nav-tabs md-tabs nav-justified grey lighten-2" role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-muted" data-toggle="tab" href="#panel555" role="tab">
            <i class="fas fa-user-circle pr-2"></i>登録情報</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted" data-toggle="tab" href="#panel666" role="tab">
            <i class="fas fa-edit pr-2"></i>記事一覧</a>
        </li>
    </ul>
    <!-- Nav tabs -->
    @endif
</div>

<!-- Tab panels -->
<div class="tab-content">

    <!-- Panel 1 -->
    <div class="tab-pane fade in show active" id="panel555" role="tabpanel">
        <!-- Card -->
        <div class="card mt-4">
            <div class="card-body">
                <form method="GET" action="{{ route('users.edit', ['user' => $user]) }}">
                    @csrf
                    <div class="md-form mb-4">
                        <label>名前</label>
                        <input type="text" id="name" name="name" class="@error('name') is-valid @enderror form-control" required value="{{ $user->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md-form mb-4">
                        <label>メールアドレス</label>
                        <input type="email" id="email" name="email" class="@error('email') is-valid @enderror form-control" required value="{{ $user->email }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn default-color btn-block btn-rounded z-depth-1a"><span class="white-text">入力内容を確認する</span></button>
                    <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-4">
                        <a href="{{ route('password.request') }}">パスワードを変更される方はこちら</a>
                    </p>
                    <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}">
                        <a class="text-danger">退会する方はこちら</a>
                    </p>

                    <!-- modal -->
                    <div id="modal-delete-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        ユーザーを退会しますか？（投稿した記事も削除されます）
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                        <button type="submit" class="btn btn-danger">削除する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                </form>
            </div>
        </div>
    </div>
    <!-- Panel 2 -->
    <div class="tab-pane fade" id="panel666" role="tabpanel">

        <div class="row row-cols-2 row-cols-md-3">
            @foreach ($posts as $post)
            <div class="col mb-4 mt-4">
                <!-- Card -->
                <div class="card h-100">

                    <!--Card image-->
                    <div class="view overlay">
                        <!--バイナリデータとして表示-->
                        <a href="{{ route('posts.show', ['post' => $post]) }}">
                            <img class="card-img-top" src="data:image/png;base64, {{ $post->file_name }}" height=200 alt="image">
                        </a>
                    </div>

                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <a href="{{ route('posts.show', ['post' => $post]) }}">
                            <h4 class="card-title mt-2">{{ $post->title }}</h4>
                        </a>
                        <!--Text-->
                        <p class="card-text">{{ mb_substr($post->body, 0, 50) }}・・・</p>
                        <!--Category-->
                        @foreach($post->category as $category)
                            <a href="{{ route('categories.show', ['category' => $category]) }}" class="rounded p-1 border border-dark text-muted">#{{ $category->name }}</a>
                        @endforeach
                        <!--User-->
                        <p class="mt-3">
                            <a href="{{ route('users.show', ['user' => $post->user]) }}" class="float-left text-muted"><i class="fas fa-user-circle fa-lg mr-2"></i>{{ $post->user->name }}</a>
                        </p>
                    </div>

                    <div class="card-footer">
                        <small class="text-muted float-left">
                            {{ $post->created_at->format('Y/m/d')}}
                        </small>

                        @if (Auth::id() === $post->user_id)
                            <!-- dropdown -->
                            <small class="dropdown float-right">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-edit"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('posts.edit', ['post' => $post]) }}">
                                        記事を更新する
                                    </a>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                                        記事を削除する
                                    </a>
                                </div>
                            </small>
                            <!-- dropdown -->

                            <!-- modal -->
                            <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                {{ $post->title }}を削除します。本当によろしいですか？
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                                <button type="submit" class="btn btn-danger">削除する</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
</div>
@endsection