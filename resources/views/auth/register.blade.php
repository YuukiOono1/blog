@extends('layouts')

@section('title', 'ユーザー登録')

@section('content')
<section class="form-elegant">

    <!-- Grid row -->
    <div class="row mt-4">

        <!-- Grid column -->
        <div class="mx-auto col-md-9 col-lg-7 col-xl-5">

            <!--Form without header-->
            <div class="card">

                <div class="card-body">

                    <!--Header-->
                    <div class="text-center">
                        <h3 class="dark-grey-text mb-5"><strong>新規登録</strong></h3>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="md-form">
                            <input type="text" id="name" name="name" class="@error('name') is-valid @enderror form-control" required value="{{ old('name') }}">
                            <label for="name">名前</label>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="md-form">
                            <input type="email" id="email" name="email" class="@error('email') is-valid @enderror form-control" required value="{{ old('email') }}">
                            <label for="email">メールアドレス</label>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="md-form">
                            <input type="password" id="password" name="password" class="@error('password') is-valid @enderror form-control" required>
                            <label for="password">パスワード</label>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="md-form">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="@error('password_confirmation') is-valid @enderror form-control" required>
                            <label for="password_confirmation">パスワード(確認)</label>
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn default-color btn-block btn-rounded z-depth-1a"><span class="white-text">新規登録</span></button>
                    </form>
                </div>

             </div>
            <!--/Form without header-->

        </div>
        <!-- Grid column -->

    </div>
    <!-- Grid row -->
</section>
@endsection