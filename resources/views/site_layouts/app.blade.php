<!-------------------
homeベース
------------------->

<!DOCTYPE html>
<html lang="ja">
@yield('head_site')
<body class="indexPage js-body">

@if (Route::has('login'))
<div class="c-info">
@auth
<a href="{{ url('/home') }}" class="">HOME</a>
@else
<a href="{{ route('login') }}" class="">LOGIN</a>
@if (Route::has('register'))
<a href="{{ route('register') }}" class="">/ REGISTER</a>
@endif
@endauth
<!--<span class="info_login">ゲスト用ログイン【user】guest 【pass】password</span>-->
</div>
@endif

<div class="c-particle"></div>
@yield('header_site')
@yield('content_site')
<!-- topに戻る -->
<div class="pageTopWrap">
<div class="pageTop js_backtop">
</div>
</div>
@yield('footer_site')
</body>

</html>