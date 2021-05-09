@extends('layouts.frame')
@section('content')
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">权限名</label>
            <div class="layui-input-block">
              <input type="text" name="loginname" placeholder="请输入" autocomplete="off" class="layui-input">
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
          <a href="{{route('admin.permission.permission.adminform')}}">
          <button class="layui-btn layuiadmin-btn-admin">添加</button>
          </a>
        </div>

        <table class="layui-table" lay-data="{url:'{{route("admin.permission.permission.list")}}',method:'post', page:true, id:'LAY-user-back-manage'}" lay-filter="LAY-user-back-manage">
          <thead>
          <tr>
            <th lay-data="{field:'id', width:80}">ID</th>
            <th lay-data="{field:'name', width:200}">权限名称</th>
            <th lay-data="{field:'name', width:200, toolbar: '#table-useradmin-admin'}">操作</th>
          </tr>
          </thead>
        </table>
        <script type="text/html" id="buttonTpl">
            <button class="layui-btn layui-btn-xs">已审核</button>
        </script>
        <script type="text/html" id="table-useradmin-admin">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="del">
            <i class="layui-icon layui-icon-edit"></i>编辑
          </a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">
              <i class="layui-icon layui-icon-delete"></i>删除
            </a>
        </script>
      </div>
@endsection
@section('content_script')
 <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
@endsection

