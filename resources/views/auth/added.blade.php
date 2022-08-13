@extends('layouts.logout')

@section('content')

<div id="login">
  <div class="login-form">
    <h3>{{$username}}さん</h3>
    <h4>ようこそ！AtlasSNSへ！</h4>
    <p>ユーザー登録が完了しました。<br>
    早速ログインをしてみましょう。</p>

      <div class="login-btn">
        <a href="/login">ログイン画面へ</a>
      </div>

  </div>
</div>

@endsection