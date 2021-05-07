@extends('layouts.frame')
@section('content')
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">

      </div>
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-role" data-type="batchdel">删除</button>
          <a href="{{route('admin.permission.role.roleform')}}">
            <button class="layui-btn">添加</button>
          </a>
        </div>
        <table class="layui-table" lay-data="{url:'{{route("admin.permission.role.list")}}',method:'post', page:true, id:'LAY-user-back-manage'}" lay-filter="LAY-user-back-manage">
          <thead>
          <tr>
            <th lay-data="{field:'id', width:80}">ID</th>
            <th lay-data="{field:'name', width:200}">角色名称</th>
            <th lay-data="{field:'name', width:200, toolbar: '#table-useradmin-admin'}">操作</th>
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
    @endsection
@section('content_script')
 <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
@endsection

