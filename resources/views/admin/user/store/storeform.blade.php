@extends('layouts.frame')
@section('content')
  <div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">用户名</label>
      <div class="layui-input-inline">
        <input type="text" name="username" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">手机号码</label>
      <div class="layui-input-inline">
        <input type="text" name="phone" lay-verify="phone" placeholder="请输入号码" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">邮箱</label>
      <div class="layui-input-inline">
        <input type="text" name="email" lay-verify="email" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">头像</label>
      <div class="layui-input-inline">
        <input type="text" name="avatar" lay-verify="required" placeholder="请上传图片" autocomplete="off" class="layui-input" >
      </div>
      <button style="float: left;" type="button" class="layui-btn" id="layuiadmin-upload-useradmin">上传图片</button> 
    </div>
    <div class="layui-form-item" lay-filter="sex">
      <label class="layui-form-label">选择性别</label>
      <div class="layui-input-block">
        <input type="radio" name="sex" value="男" title="男" checked>
        <input type="radio" name="sex" value="女" title="女">
      </div>
    </div>
    <div class="layui-form-item layui-hide">
      <input type="button" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-front-submit" value="确认">
    </div>
  </div>
@endsection
@section('content_script')
  <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
  <script>
  layui.use(['form', 'upload'], function(){
    var $ = layui.$
    ,form = layui.form
    ,upload = layui.upload ;
    
    upload.render({
      elem: '#layuiadmin-upload-useradmin'
      ,url: layui.setter.base + 'json/upload/demo.js'
      ,accept: 'images'
      ,method: 'get'
      ,acceptMime: 'image/*'
      ,done: function(res){
        $(this.item).prev("div").children("input").val(res.data.src)
      }
    });
  })
  </script>
@endsection