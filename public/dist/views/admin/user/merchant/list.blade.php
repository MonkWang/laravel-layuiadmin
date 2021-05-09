@extends('layouts.frame')
@section('content')
  <form action="javascript:void(0)" id="form" data-module="form,table">
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">

        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
              <input type="text" name="username" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-user-front-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-useradmin" data-type="batchdel">删除</button>
          <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
        </div>
        <table class="layui-table" id="table" data-argu="{elem:'#table', action:['update','del'],url:'{{route("admin.user.merchant.list")}}', cols:[
          {checkbox:true, fixed:'left'},
          {field:'name', title:'联系人', width:150},
          {field:'phone', title:'手机号'},
          {field:'操作',width: 160}
        ]}">
        </table>
        <script type="text/html" id="imgTpl"> 
          <img style="display: inline-block; width: 50%; height: 100%;" src= { d.avatar }>
        </script>
      </div>
  </form>
@endsection
@section('content_script')
  <script src="{{asset('js/selfjs.js')}}"></script>
  <script>
    $.selfLayui({})
  </script>
@endsection
