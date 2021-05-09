<?php $__env->startSection('content'); ?>
  <form action="javascript:void(0)" id="form"
        data-module="form"
        data-event="submitEvent"
        data-argu="{url: '<?php echo e(route('admin.permission.permission.adminform')); ?>',
        elem: 'form'}">
  <div class="layui-form" lay-filter="layuiadmin-form-admin" id="layuiadmin-form-admin" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">权限名称</label>
      <div class="layui-input-inline">
        <input type="text" name="name" lay-verify="required" placeholder="请输入权限名称"
               autocomplete="off" class="layui-input" value="<?php echo e($permission->name??''); ?>">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">路由</label>
      <div class="layui-input-inline">
        <input type="text" name="route" lay-verify="required" placeholder="请输入路由"
               autocomplete="off" class="layui-input" value="<?php echo e($permission->route??''); ?>">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">选择平台</label>
      <div class="layui-input-block">
        <input type="radio" name="guard_name" value="web" title="总台" checked>
        <input type="radio" name="guard_name" value="merchant" title="商户" <?php if(isset($permission->guard_name) && $permission->guard_name == 'merchant'): ?> checked <?php endif; ?> >
        <input type="radio" name="guard_name" value="store" title="店铺" <?php if(isset($permission->guard_name) && $permission->guard_name == 'store'): ?> checked <?php endif; ?>>
      </div>
    </div>
    <div class="layui-form-item">
      <?php if($permission): ?>
        <input type="hidden" name="id" value="<?php echo e($permission->id); ?>">
      <?php endif; ?>
      <input type="button" lay-submit lay-filter="form" class="layui-btn" value="确认">
    </div>
  </div>
  </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_script'); ?>

  <script>
    $.selfLayui({})
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frame', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/amber/Desktop/php/wjlaravel/resources/views/admin/permission/permission/adminform.blade.php ENDPATH**/ ?>