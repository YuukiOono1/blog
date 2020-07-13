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
                        <h3 class="dark-grey-text mb-5"><strong>パスワードの再設定</strong></h3>
                    </div>

                    @if (session('status'))
                    <div class="card-text alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="md-form">
                            <input type="email" id="email" name="email" class="@error('email') is-valid @enderror form-control" required>
                            <label for="name">メールアドレス</label>
                            @error('name')
                                <div class="alert alert-danger">{{ $email }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn default-color btn-block btn-rounded z-depth-1a"><span class="white-text">送信</span></button>
                    </form>
                    <!--Footer-->
                    <div class="modal-footer mx-5 pt-3 mb-1">
                        <a href="{{ route('users.show', ['user' => Auth::id()]) }}" class="blue-text ml-1">マイページへ戻る</a>
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
