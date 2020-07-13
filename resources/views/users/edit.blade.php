@extends('layouts')

@section('title', 'ユーザー名更新')

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
                        <h3 class="dark-grey-text mb-5"><strong>ユーザーネームの変更</strong></h3>
                        <p>変更前の名前 : {{ $user->name }}</h>
                    </div>

                    <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                        @method('PATCH')
                        @csrf
                        <div class="md-form">
                            <input type="text" id="name" name="name" class="@error('name') is-valid @enderror form-control" required value="{{ old('name') }}">
                            <label for="name">変更する名前</label>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn default-color btn-block btn-rounded z-depth-1a"><span class="white-text">変更</span></button>
                    </form>
                    <!--Footer-->
                    <div class="modal-footer mx-5 pt-3 mb-1">
                        <a href="{{ route("users.show", ['user' => Auth::id()]) }}" class="blue-text ml-1">マイページへ戻る</a>
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