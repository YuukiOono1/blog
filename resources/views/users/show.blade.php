@extends('layouts')

@section('title', 'マイページ')

@section('content')
<div class="card mt-3">
    @foreach($posts as $post)
        @if (Auth::id() === $post->user_id)
            <div class="mx-auto mt-4">
                <h1>マイページ</h1>
            </div>
        @endif
    @endforeach
    <div class="card-body mx-auto">
        <i class="fas fa-user-circle fa-3x"></i>
    </div>
    <div class="mx-auto">
        <p class="lead">{{ $user->name }}</p>
    </div>
    <div class="mx-auto mb-2">
        @foreach($posts as $post)
            @if (Auth::id() === $post->user_id)
                <a href="{{ route('users.edit', ['user' => $user]) }}" class="text-muted">ユーザーネームの変更 / </a>
                <a href="{{ route('password.request') }}" class="text-muted">パスワードの再設定 / </a>
                <a href="" class="text-muted">メールアドレスの変更 / </a>
                <a class="text-muted" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}">ユーザーの退会 / </a>
            @endif
        @endforeach
    </div>

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
                        ユーザーを退会しますか？（投稿した記事も削除されます)
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
</div>
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
@endsection