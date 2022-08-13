@extends('layouts.login')

@section('content')
@csrf

<div class="follow-list">
    <h2 class="page-header">Follow List</h2>

    <div class="icon-list">
        @foreach($users as $user)
            <a href="/users/{{$user->id}}"><img src="{{ asset('storage/images/' . $user->images) }}" width="50px" height="auto" alt="アイコン"></a>
        @endforeach
    </div>
</div>

<div class="post-contents">
    @foreach ($posts as $post)
        <ul class="post-area">

            <td><a href="/users/{{$user->id}}"><img src="{{ asset('storage/images/' . $post->user->images) }}" width="50px" height="auto" alt="アイコン"></a></td>

            <div class="post-main">
                <div class="post-name">
                    <li>{{ $post->user->username}}</li>
                    <li>{{ $post->created_at }}</li>
                </div>

                <div class="post-text">
                    <li>{{ $post->post }}</li>
                </div>
            </div>

        </ul>
    @endforeach
</div>

@endsection