<!-------------------
home header
------------------->
@section('header_admin')
<!--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
<div class="c-widset">
<a class="navbar-brand" href="{{ url('/') }}">
{{ config('app.name', 'Laravel') }}
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav me-auto">
</ul>
<ul class="navbar-nav ms-auto">
@guest
@if (Route::has('login'))
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
</li>
@endif

@if (Route::has('register'))
<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif
@else
<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
{{ Auth::user()->name }}
</a>

<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
{{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
</div>
</li>
@endguest
</ul>
</div>

</div>
</nav>-->
<header class="l-header">
    <div class="l-header__head">
        <div class="c-widset">
            <h1 class="c-item title">LARAVEL_ADMIN</h1>
            <p class="c-item btns">
                <a class="c-btn" href="/">SITE</a>
                <router-link class="c-btn" v-bind:to="{ name: 'task.list' }">LIST</router-link>
            </p>
            <!--<a href="#">Hara Takashi ▼</a>-->

            <div class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                @php
                if(Auth::user()->type == 0){$istype = "編集可";}else{$istype = "閲覧のみ";};
                @endphp
                    {{ Auth::user()->name }} : {{ $istype }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="c-burgerBtn" id="js-hamburger-btn">
        <div>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="c-burgerMenu" id="js-hamburger-gnav">
        <div class="c-burgerMenu-inner">
            <ul>
                <li class="topWorKs"><a href="#adminWorks">WORKS</a></li>
                <li class="topSkills"><a href="#adminskills">SKILLS</a></li>
                <li class="topProducts"><a href="#adminProducts">PRODUCT</a></li>
                <li class="topProfile"><a href="#adminProfile">PROFILE</a></li>
                <li class="topHistorys"><a href="#adminHistorys">HISTORYS</a></li>
            </ul>
        </div>
    </div>
</header>
@endsection