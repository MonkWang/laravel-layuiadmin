@extends('layouts.frame')
@section('content')
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">ID</label>
            <div class="layui-input-block">
              <input type="text" name="id" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
              <input type="text" name="username" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
              <input type="text" name="email" placeholder="请输入" autocomplete="off" class="layui-input">
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
          <a href="{{route('admin.user.store.storeform')}}">
            <button class="layui-btn layuiadmin-btn-useradmin" id="self-add" data-type="add">添加</button>
          </a>
        </div>
        <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>
        <script type="text/html" id="imgTpl"> 
          <img style="display: inline-block; width: 50%; height: 100%;" src= { d.avatar }>
        </script> 
        <script type="text/html" id="table-useradmin-webuser">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
      </div>
@endsection
@section('content_script')
  <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
  <script>
  layui.use(['form','table'], function() {
    var $ = layui.$
        , form = layui.form
        , table = layui.table;
    let token = document.head.querySelector('meta[name="csrf-token"]');
    //用户管理
    table.render({
      elem: '#LAY-user-manage'
      , url: "{{route('admin.user.store.list')}}" //模拟接口
      , method: 'post'
      , where: {_token: token.content}
      , cols: [[
        {type: 'checkbox', fixed: 'left'}
        , {field: 'id', width: 100, title: 'ID', sort: true}
        , {field: 'username', title: '用户名', minWidth: 100}
        , {field: 'avatar', title: '头像', width: 100, templet: '#imgTpl'}
        , {field: 'phone', title: '手机'}
        , {field: 'email', title: '邮箱'}
        , {field: 'sex', width: 80, title: '性别'}
        , {field: 'ip', title: 'IP'}
        , {field: 'jointime', title: '加入时间', sort: true}
        , {title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
      ]]
      , page: true
      , limit: 30
      , height: 'full-220'
      , text: '对不起，加载出现异常！'
    });
  })
  </script>
@endsection
