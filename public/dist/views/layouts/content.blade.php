<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 角色管理 iframe 框</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('dist/layuiadmin/layui/css/layui.css')}}" media="all">
    <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/axios.js')}}"></script>
    <script src="{{asset('js/selfjs.js')}}"></script>
</head>
<body>
@yield('content')
@yield('content_script')
</body>
</html>