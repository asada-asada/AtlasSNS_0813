@extends('layouts.login')

@section('content')


@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif

<div class="profile-content">


    <div class="profile-edit">

        <div class="profile-img">
            <img src="{{ asset('storage/images/' . Auth::user()->images) }}" width="50px" height="auto" alt="アイコン">
        </div>

        <form action="/profile-update" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input">
                <label>username</label>
                <input name="username" type="text" value="{{ $users -> username }}" autocomplete="off">
            </div>

            <div class="input">
                <label>mail address</label>
                <input name="mail" type="email" value="{{ $users -> mail }}" autocomplete="off">
            </div>

            <div class="input">
                <label>password</label>
                <input name="password" type="password" placeholder="" autocomplete="off">
            </div>

            <div class="input">
                <label>password confirm</label>
                <input name="password_confirmation" type="password" placeholder="新しいパスワード再入力" autocomplete="off">
            </div>

            <div class="input">
                <label>bio</label>
                <textarea class="textarea" name="bio" style="resize :none;" value="{{ $users -> bio }}" autocomplete="off" rows="1"></textarea>
            </div>

            <div class="input">
                <label>icon image</label>
                <input type="file" name="profile_image" accept="image/*">
            </div>


            <h2>{{ session('message') }}</h2>


            <input type="hidden" name="id" value="{{ Auth::id() }}">
            <input type="submit" value="更新">
        </form>
    </div>

</div>
@endsection