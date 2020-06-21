@extends('layouts')

@section('title', '一覧画面')

@section('content')
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
                <p class="card-text">{{ mb_substr($post->body, 0, 100) }}・・・</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                    {{ $post->created_at->format('Y/m/d')}}
                </small>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $posts->links() }}
@endsection