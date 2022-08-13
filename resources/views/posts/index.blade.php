@extends('layouts.login')

@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }} ">

<!-- 投稿フォーム -->
<div class="post-container">

    <div class="post-icon">
       <img src="{{ asset('storage/images/' . Auth::user()->images) }}" width="auto" height="30px" alt="アイコン" class="post-icon">
    </div>

    <div class="form-group">
        {!! Form::open(['url' => 'post/create']) !!}
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}

        <input type="image" class="btn btn-success pull-right" img src="{{asset('images/post.png')}}" height="100px">
        {!! Form::close() !!}
    </div>

</div>

<!--  -->

<div class="post-contents">
    @foreach ($list as $list)
    @if(auth()->user()->isFollowing($list->user->id))
    <ul class="post-area">

        <li><img src="{{ asset('storage/images/' . $list->user->images) }}" width="50px" height="auto" alt="アイコン"></li>

        <div class="post-main">
            <div class="post-name">
                <li>{{ $list->user->username}}</li>
                <li>{{ $list->created_at }}</li>
            </div>

            <div class="post-text">
                <li>{{ $list->post }}</li>
            </div>

            @if(Auth::id() == $list->user_id)
                <div class="trash-btn-area">
                    <li>
                        <span>
                        <a class="js-modal-open" post="{{ $list->post }}" post_id="{{ $list->id }}" href="" >
                        <img src="{{asset('images/edit.png')}}" height="30px"></a>
                        </span>

                        <span>
                        <a class="trash-btn" href="/post/{{$list->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="{{ asset('images/trash.png')}}" height="30px" alt="delete"></a>
                        </span>
                    </li>
                </div>
            @endif
        </div>

    </ul>


        @endif
    @endforeach
</div>


<!-- 編集モーダル -->
    <div class="js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <form action="/update" method="post">
                <input type="text" class="post" name="post">

                <!-- 隠しデータ -->
                <input type="hidden" class="post_id" name="post_id">

                <input type="image" class="btn btn-success pull-right" img src="{{asset('images/edit.png')}}" height="30px">
                {{csrf_field()}}
            </form>
        </div>
    </div>


@endsection