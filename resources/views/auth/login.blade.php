@extends('layouts')

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
                        <h3 class="dark-grey-text mb-5"><strong>ログイン</strong></h3>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="md-form">
                            <input type="email" id="email" name="email" class="@error('email') is-valid @enderror form-control" required value="{{ old('email') }}">
                            <label for="email">メールアドレス</label>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="md-form">
                            <input type="password" id="password" name="password" class="@error('passwords') is-valid @enderror form-control" required>
                            <label for="password">パスワード</label>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn default-color btn-block btn-rounded z-depth-1a"><span class="white-text">ログイン</span></button>
                    </form>
                    <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> or Sign up
                        with:</p>

                    <!--Footer-->
                    <div class="modal-footer mx-5 pt-3 mb-1">
                        <p class="font-small grey-text d-flex justify-content-end">Already a member? <a href="#" class="blue-text ml-1">
                        Sign In</a></p>
                    </div>

                </div>

             </div>
            <!--/Form without header-->

        </div>
        <!-- Grid column -->

    </div>
    <!-- Grid row -->
</section>
@endsection
