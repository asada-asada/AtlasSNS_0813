<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="トップページ" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="/public/images/atlas.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- Bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
</head>

<body>
    <div id="login">
        <header>
            <div class="head">

                    <div class="head-logo">
                        <a href="/top"><img src="{{ asset('images/atlas.png') }}" alt="ロゴ" class="logo"></a>
                    </div>

                    <div class="head-contents">
                        <div class="head-username">
                            <h4>{{Auth::user()->username}}さん</h4>
                        </div>

                        <div class="accordion-container">
                            <div class="accordion-title"></div>
                        </div>

                        <div class="head-icon">
                            <img src="{{ asset('storage/images/' . Auth::user()->images) }}" width="auto" height="50px" alt="アイコン" class="accordion-img">
                        </div>
                    </div>

                    <div class="accordion-content">
                        <ul>
                            <li><a href="/top">HOME</a></li>
                            <li><a href="/profile">プロフィール編集</a></li>
                            <li><a href="/logout">ログアウト</a></li>
                        </ul>
                    </div>

            </div>
        </header>



        <div id="row">
            <div id="container">
                @yield('content')
            </div >
            <div id="side-bar">
                <div id="follow">
                    <p>{{Auth::user()->username}}さんの</p>
                    <div>
                        <p>フォロー数 {{ Auth::user()->follows()->count() }}名</p>
                    </div>

                    <div>
                        <p class="btn"><a href="/follow-list">フォローリスト</a></p><br>
                    </div>

                    <div>
                        <p>フォロワー数 {{ Auth::user()->followers()->count() }}名</p>
                    </div>
                    <div>
                    <p class="btn"><a href="/follower-list">フォロワーリスト</a></p><br>
                    </div>
                </div>

                <p class="search-btn"><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
        <footer>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="{{ asset('js/script.js') }}"></script>
        <script src="JavaScriptファイルのURL"></script>
    </div>
</body>
</html>
