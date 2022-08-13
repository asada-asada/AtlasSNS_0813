@extends('layouts.logout')

@section('content')

<div id="login">

    {!! Form::open() !!}
    <div class="login-form">
        <p>AtlasSNSへようこそ</p>

        <div class="login-form-label">
            {{ Form::label('mail address') }}
        </div>
        {{ Form::text('mail',null,['class' => 'input']) }}

        <div class="login-form-label">
            {{ Form::label('password') }}
        </div>
        {{ Form::password('password',['class' => 'input']) }}

        <div class="btn">
        {{ Form::submit('LOGIN') }}
        </div>

        <p><a href="/register">新規ユーザーの方はこちら</a></p>
    </div>
    {!! Form::close() !!}
</div>


@endsection