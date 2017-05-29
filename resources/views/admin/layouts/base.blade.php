<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>@yield('title') - {{ lang('Laradmin') }}</title>
    @include('admin.layouts.style')
</head>
<body class="fixed-sidebar full-height-layout gray-bg">
@yield('content')
@include('admin.layouts.script')
</body>
</html>
