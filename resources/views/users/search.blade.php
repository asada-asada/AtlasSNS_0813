@extends('layouts.login')

@section('content')

    <div class="search-window">
        <div class="search-items">
            <form action="/search" method="get">
                {{ csrf_field() }}
                <input type="text" name="search" value="">
                <input type="image" class="btn btn-success pull-right" img src="{{asset('images/search.png')}}" height="70px">
            </form>
        </div>

            @if ($keyword)
            <div class="search-word">
                <p>検索ワード：{{$keyword}}</p>
            </div>
            @endif
    </div>

<div class="search-content">
    @foreach ($users as $user)
        <div class="search-result">

            <td><img src="{{ asset('storage/images/' . $user->images) }}" width="60px" height="auto" alt="アイコン"></td>
            <td>{{ $user->username }}</td>


            <!-- @if (auth()->user()->isFollowed($user->id))
                <div class="px-2">
                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                </div>
            @endif -->

            <div class="search-f-btn">
                @if (auth()->user()->isFollowing($user->id))
                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                    </form>

                @elseif (Auth::id() == $user->id)
                    <div class="search-auth"></div>

                @else
                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">フォローする</button>
                    </form>
                @endif
            </div>

        </div>
    @endforeach
</div>


@endsection


