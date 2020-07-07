@extends('layouts')

@section('title', '更新画面')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card-body pt-0">
                <div class="card-text">
                    <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="md-form">
                            <label>タイトル</label>
                            <input type="text" name="title" class="form-control @error('email') is-valid @enderror" required value="{{ $post->title }}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label>画像</label><br>
                        <input type="file" id="file_name" name="file_name">
                        <div class="form-group mt-4">
                            <label>タグ</label><br>
                            <input type="text" name="category" value="{{ old('post-category->name') }}">
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleFormControlTextarea1">本文</label>
                            <textarea class="form-control rounded-0 @error('body') is-valid @enderror" name="body" id="exampleFormControlTextarea1" rows="14" required>{{ $post->body }}</textarea>
                            @error('body')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn default-color btn-block"><span class="white-text">更新する</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection