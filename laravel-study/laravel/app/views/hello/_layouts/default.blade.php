<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>laravel 4 模板视图</title>

    @include('hello._partials.assets')

</head>
<body>

<header>

    <nav>@include('hello._partials.navi')</nav>
</header>
@yield('main')
</body>
</html>