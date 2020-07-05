@extends('layouts')

@section('title', '詳細画面')

@section('content')
<div class="mt-4 mb-4 align-items-center">
  <div class="card">
    <img src="data:image/png;base64,{{ $post->file_name }}" class="card-img-top" height=500 alt="file_name">
    <div class="card-body">
      <h5 class="card-title">{{ $post->title }}</h5>
      <p class="card-text mt-3">{{ $post->body }}</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">
        {{ $post->created_at->format('Y/m/d') }}
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
@endsection
