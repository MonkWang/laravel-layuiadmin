<?php $__env->startSection('content'); ?>
    <div id="self-lable" data-module="table" data-render="table">
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
      </div>
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-role" data-type="batchdel">删除</button>
          <a href="<?php echo e(route('admin.permission.role.roleform')); ?>">
            <button class="layui-btn">添加</button>
          </a>
        </div>
        <table id="table1" class="layui-table"
               data-argu="{url:'<?php echo e(route("admin.permission.role.list")); ?>'
               ,elem:'#table1'
               ,key: 'id'
               ,update: '<?php echo e(route('admin.permission.role.roleform')); ?>'
               }" lay-filter="table1">
          <tr style="display: none">
            <col data-col="{field:'id', title:'ID', width:80}"></col>
            <col data-col="{field:'name', title:'名称', width:200}"></col>
            <col data-col="{field:'', title:'操作', width:200}"></col>
          </tr>
        </table>
      </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content_script'); ?>
    <script src="<?php echo e(asset('js/selfjs.js')); ?>"></script>
    <script>
        $.selfLayui({})
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frame', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/amber/Desktop/php/wjlaravel/resources/views/admin/permission/role/list.blade.php ENDPATH**/ ?>