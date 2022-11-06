<!-------------------
サイト
------------------->

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MY PROFILE</title>
    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
@if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
@auth
<a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
@else
<a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

@if (Route::has('register'))
<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
@endif
@endauth
</div>
@endif
            
<div id="app">
<!--view-component></!--view-component>-->
</div>

@foreach($works as $work)
<tr>
<td>{{$work->id}}</td>
<td>{{$work->name}}</td>
<td>{{$work->content}}</td>
</tr>
@endforeach

<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>