

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 控制台主页一</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dist/layuiadmin/layui/css/layui.css')); ?>" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('dist/layuiadmin/style/admin.css')); ?>" media="all">
    <script src="<?php echo e(asset('js/axios.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
    <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>
</body>
<script src="<?php echo e(asset('dist/layuiadmin/layui/layui.js')); ?>"></script>
<script src="<?php echo e(asset('js/selfjs.js')); ?>"></script>
<?php echo $__env->yieldContent('content_script'); ?>
</html>

<?php /**PATH /Users/amber/Desktop/php/wjlaravel/resources/views/layouts/frame.blade.php ENDPATH**/ ?>