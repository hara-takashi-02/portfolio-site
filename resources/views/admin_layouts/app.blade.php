<!-------------------
homeベース
------------------->

<!doctype html>
<html lang="ja">
@yield('head_admin')
<body class="adminPage js-body">
<div id="app" class="taskApp">
@yield('header_admin')
@yield('content_admin')
</div>
@yield('footer_admin')
</body>
</html>