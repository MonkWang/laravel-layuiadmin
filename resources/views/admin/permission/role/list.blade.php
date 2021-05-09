@extends('layouts.frame')
@section('content')
    <div id="self-lable" data-module="table" data-render="table">
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
      </div>
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-role" data-type="batchdel">删除</button>
          <a href="{{route('admin.permission.role.roleform')}}">
            <button class="layui-btn">添加</button>
          </a>
        </div>
        <table id="table1" class="layui-table"
               data-argu="{url:'{{route("admin.permission.role.list")}}'
               ,elem:'#table1'
               ,key: 'id'
               ,update: '{{route('admin.permission.role.roleform')}}'
               }" lay-filter="table1">
          <tr style="display: none">
            <col data-col="{field:'id', title:'ID', width:80}"></col>
            <col data-col="{field:'name', title:'名称', width:200}"></col>
            <col data-col="{field:'', title:'操作', width:200}"></col>
          </tr>
        </table>
      </div>
    </div>
    @endsection
@section('content_script')
    <script src="{{asset('js/selfjs.js')}}"></script>
    <script>
        $.selfLayui({})
    </script>
@endsection

