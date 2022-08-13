@extends('layouts.login')
<link rel="stylesheet" href="{{ asset('css/style.css') }} ">

@section('content')

<div class="users-content">
    <div class="users-img">
        <img src="{{ asset('storage/images/' . $users->images) }}" width="50px" height="auto" alt="アイコン"></a>
    </div>

    <div class="users-name">
        <h2>name　　　{{$users->username}}<br>
        bio　　　　{{$users->bio}}</h2>
    </div>

    <div class="users-f-btn">
        @if (auth()->user()->isFollowing($users->id))
            <form action="{{ route('unfollow', ['user' => $users->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger">フォロー解除</button>
            </form>

        @else
            <form action="{{ route('follow', ['user' => $users->id]) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">フォローする</button>
            </form>
        @endif
    </div>

</div>





<div class="post-contents">
    @foreach ($posts as $post)
        <ul class="post-area">

            <div><img src="{{ asset('storage/images/' . $post->user->images) }}" width="50px" alt="アイコン"></a></div>

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