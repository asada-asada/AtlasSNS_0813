<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Post;
use App\User;



class UsersController extends Controller
{
    //
    public function profile(){

        $users = Auth::user();

        return view('users.profile',[
            'users' => $users,
        ]);
    }

    //ユーザー検索
    public function search(Request $request){
        //ログインユーザー以外のユーザー全部引っ張ってくる
        $users = User::where("id" , "!=" , Auth::user()->id)->paginate(10);
        //検索フォームに入力があったら検索
        if($request -> search){
            //search.blade>検索フォーム>name属性“search”をキーワードにする
            $keyword = $request -> search;
            //users変数を「User::get()」から定義し直す
            $users=User::where('username','LIKE',"%{$keyword}%")->get();
            //
        }

        //検索キーワード表示
        $keyword = $request -> search;
        return view('users.search',
        ['users' => $users ,'keyword' => $keyword]);
    }



    // ログアウトしてログインページに戻る
    public function logout(Request $request){
        Auth::logout();
        return redirect('login');
    }

    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }


    public function show(User $user, Tweet $tweet, Follower $follower)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $tweet->getUserTimeLine($user->id);
        $tweet_count = $tweet->getTweetCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        return view('top', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }


    //プロフィール編集
    public function profileUpdate(Request $request ,User $user)
    {
        // dd($request);
        //inputのpassword
        $password = $request->password;

        $request->validate([
            'username' => 'required|string|max:12|min:2',
            'mail' => 'unique:users,mail,'.Auth::user()->mail.',mail',
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required|string|min:8|max:20|same:password',
            'bio' => 'max:150',
            'profile_image' => 'mimes:jpeg,jpg,bmp,png,gif,svg'
        ]);

        // \DB::table('users')
        // ->where('id', $request -> id)
        // ->update([
        //     'username'=>$request->username,
        //     'mail'=>$request->mail,
        //     'password'=>bcrypt($password),
        //     'bio'=>$request->bio,
        // ]);

        $user=User::findOrFail(Auth::id());
        // dd($user);
        $user->username = $request->username;
        if(Auth::user()->mail != $request->mail){
            $user->mail = $request->mail;
        }
        $user->password = bcrypt($request->password);
        $user->bio = $request->bio;
        $user->save();






        //profile_imageがあった時
        if(!empty($request->profile_image)){
            $image = $request -> file('profile_image');
            $path = $image -> store('public/images');

            \DB::table('users')
            ->where('id', $request -> id)
            ->update([
                'images'=>basename($path)
            ]);
        }


        return redirect('/profile')->with('message','更新完了');

    }




    //他ユーザーのプロフィール表示
    public function users($id)
    {
        $users = User::where('users.id',$id)->first();
        $posts = Post::where('posts.user_id',$id)->get();

        return view('users.users',compact('users','posts'));
    }


};