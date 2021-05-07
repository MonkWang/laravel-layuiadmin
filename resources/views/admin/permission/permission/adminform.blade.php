@extends('layouts.frame')
@section('content')
  <div class="layui-form" lay-filter="layuiadmin-form-admin" id="layuiadmin-form-admin" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">权限名称</label>
      <div class="layui-input-inline">
        <input type="text" name="loginname" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <input type="button" lay-submit lay-filter="LAY-user-front-submit" class="layui-btn" id="LAY-user-back-submit" value="确认">
    </div>
  </div>
@endsection
@section('content_script')
  <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
  <script>
  layui.use(['form'], function(){
    var $ = layui.$
    ,form = layui.form ;
  })
  </script>
@endsection