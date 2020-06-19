@extends('layouts')

@section('title', '一覧画面')

@section('content')
<div class="row row-cols-2 row-cols-md-3">
    @foreach ($posts as $post)
    <div class="col mb-4 mt-4">
        <!-- Card -->
        <div class="card">

            <!--Card image-->
            <div class="view overlay">
                <img class="card-img-top" src="" alt="image">
                <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!--Card content-->
            <div class="card-body">
                <!--Title-->
                <h4 class="card-title">{{ $post->title }}</h4>
                <!--Text-->
                <p class="card-text">{{ $post->body }}</p>
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
@endsection