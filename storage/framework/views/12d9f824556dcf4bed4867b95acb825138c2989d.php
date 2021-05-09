<?php $__env->startSection('content'); ?>
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">登录名</label>
            <div class="layui-input-block">
              <input type="text" name="loginname" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">手机</label>
            <div class="layui-input-block">
              <input type="text" name="telphone" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
              <input type="text" name="email" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">角色</label>
            <div class="layui-input-block">
              <select name="role">
                <option value="0">管理员</option>
                <option value="1">超级管理员</option>
                <option value="2">纠错员</option>
                <option value="3">采购员</option>
                <option value="4">推销员</option>
                <option value="5">运营人员</option>
                <option value="6">编辑</option>
              </select>
            </div>
          </div>
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="LAY-user-back-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>
      
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-admin" data-type="batchdel">删除</button>
          <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加</button>
        </div>

        <table class="layui-table" lay-data="{url:'<?php echo e(route("admin.permission.member.list")); ?>', method: 'post', where: {_token: '<?php echo e(csrf_token()); ?>'}, id:'LAY-user-back-manage'}" lay-filter="LAY-user-back-manage">
          <thead>
          <tr>
            <th lay-data="{field:'id', width:80, sort: true}">ID</th>
            <th lay-data="{field:'name', width:80}">用户名</th>
            <th lay-data="{field:'sex', width:80, sort: true}">性别</th>
            <th lay-data="{field:'telphone'}">手机</th>
            <th lay-data="{field:'role'}">角色</th>
            <th lay-data="{field:''}">操作</th>
          </tr>
          </thead>
        </table>
        <script type="text/html" id="buttonTpl">
            <button class="layui-btn layui-btn-xs">已审核</button>
        </script>
        <script type="text/html" id="table-useradmin-admin">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>

            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
      </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_script'); ?>
  <script src="<?php echo e(asset('dist/layuiadmin/layui/layui.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frame', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/amber/Desktop/php/wjlaravel/resources/views/admin/permission/admin/list.blade.php ENDPATH**/ ?>