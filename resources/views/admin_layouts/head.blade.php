<!-------------------
home head
------------------->
@section('head_admin')
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Vue Laravel SPA') }}</title>
<!-- Styles -->
<link href="{{ mix('/css/app_admin.css') }}" rel="stylesheet">
</head>
@endsection