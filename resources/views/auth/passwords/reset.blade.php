@extends('layouts')

@section('title', 'パスワード再設定')

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
                        <h3 class="dark-grey-text mb-5"><strong>パスワードを新しくする</strong></h3>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="md-form">
                            <label for="password">新しいパスワード</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>

                        <div class="md-form">
                            <label for="password_confirmation">新しいパスワード（確認用）</label>
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn default-color btn-block btn-rounded z-depth-1a"><span class="white-text">送信</span></button>
                    </form>
                    <!--Footer-->
                </div>

             </div>
            <!--/Form without header-->

        </div>
        <!-- Grid column -->

    </div>
    <!-- Grid row -->
</section>
@endsection
