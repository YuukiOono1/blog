@extends('layouts')

@section('title', '詳細画面')

@section('content')
<div class="mt-4 mx-auto d-flex align-items-center w-75">
  <div class="card">
    <img src="data:image/png;base64,{{ $post->file_name }}" class="card-img-top" height=500 alt="file_name">
    <div class="card-body">
      <h5 class="card-title">{{ $post->title }}</h5>
      <p class="card-text mt-3">{{ $post->body }}</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">{{ $post->created_at->format('Y/m/d') }}</small>
    </div>
  </div>
</div>
@endsection
