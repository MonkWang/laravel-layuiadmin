

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 控制台主页一</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('dist/layuiadmin/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('dist/layuiadmin/style/admin.css')}}" media="all">
    <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">

    @yield('content')

    </div>
</div>

<script>
    layui.config({
        base: '../../dist/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'console']);
</script>
@yield('content_script')
</body>
</html>
