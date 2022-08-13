<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    // フォロワー投稿リスト表示
    public function showFollowerPosts()
    {
        // フォローされているユーザーのidを取得
        $followed_id = Auth::user()->followers()->pluck('following_id');
        // dd($followed_id);

        $users = User::whereIn('users.id',$followed_id)->get();

        // フォローされているユーザーのidを元に投稿内容を取得
        $posts = Post::with('user')->whereIn('posts.user_id', $followed_id)->get();
        // dd($posts);

        return view('follows.followerList', compact('posts','users'));
        }


    // フォロー投稿リスト表示
    public function showFollowPosts()
    {
        // フォローしているユーザーのidを取得
        //
        $following_id = Auth::user()->follows()->pluck('followed_id');
        // dd($following_id);

        //
        $users = User::whereIn('users.id',$following_id)->get();

        // フォローしているユーザーのidを元に投稿内容を取得
        $posts = Post::with('user')->whereIn('posts.user_id',$following_id)->get();
        // dd($posts);

        return view('follows.followList', compact('posts','users'));

    }



}
