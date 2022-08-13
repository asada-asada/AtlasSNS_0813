@extends('layouts.logout')

@section('content')

<div id="login">


    <div class="login-form">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <p>新規ユーザー登録</p>
        {!! Form::open() !!}

        <div class="login-form-label">
            {{ Form::label('user name') }}
        </div>
        {{ Form::text('username',null,['class' => 'input']) }}

        <div class="login-form-label">
            {{ Form::label('mail address') }}
        </div>
        {{ Form::text('mail',null,['class' => 'input']) }}

        <div class="login-form-label">
            {{ Form::label('password') }}
        </div>
        {{ Form::password('password',null,['class' => 'input']) }}

        <div class="login-form-label">
            {{ Form::label('password confirm') }}
        </div>
        {{ Form::password('password_confirmation',null,['class' => 'input']) }}

        <div class="btn">
            {{ Form::submit('REGISTER') }}
        </div>

        <p><a href="/login">ログイン画面へ戻る</a></p>

        {!! Form::close() !!}
    </div>
</div>


@endsection
