

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dist/layuiadmin/layui/css/layui.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('dist/layuiadmin/style/admin.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('dist/layuiadmin/style/login.css')); ?>" media="all">
    <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/axios.js')); ?>"></script>
</head>
<body>

<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>登入</h2>
            <p> </p>
        </div>
        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>

        <?php else: ?>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                <input type="text" name="name" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input" value="12345678">
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
                        <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="<?php echo e(captcha_src()); ?>" onclick="this.src='<?php echo e(captcha_src()); ?>'+Math.random()" title="点击图片重新获取验证码">
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item" style="margin-bottom: 20px;">
                <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
                <a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
            </div>
        </div>
            <?php endif; ?>
    </div>

    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2018</p>
    </div>
</div>
<script src="<?php echo e(asset('dist/layuiadmin/layui/layui.js')); ?>"></script>
<script src="<?php echo e(asset('js/selfjs.js')); ?>"></script>
<script>
    let obj = {
        module: ['form']
    }
    $.selfLayui(obj)
    layui.use('form', function(){
        var $ = layui.$
            ,setter = layui.setter
            ,admin = layui.admin
            ,form = layui.form
            ,router = layui.router()
            ,search = router.search;
        form.render();
        //提交
        form.on('submit(LAY-user-login-submit)', function(obj){
            $.selfPost('<?php echo e(route("admin.login")); ?>', obj.field)
        });
    });
</script>
</body>
</html><?php /**PATH /Users/amber/Desktop/php/wjlaravel/resources/views/auth/login.blade.php ENDPATH**/ ?>