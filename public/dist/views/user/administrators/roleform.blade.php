@extends('layouts.frame')
@section('content')
  <div class="layui-form" lay-filter="layuiadmin-form-role" id="layuiadmin-form-role" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">角色</label>
      <div class="layui-input-block">
        <select name="rolename">
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
    <div class="layui-form-item">
      <label class="layui-form-label">权限范围</label>
      <div class="layui-input-block">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="内容系统">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="社区系统">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="用户">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="角色">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">具体描述</label>
      <div class="layui-input-block">
        <textarea type="text" name="descr" lay-verify="required" autocomplete="off" class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <button class="layui-btn" lay-submit lay-filter="LAY-user-role-submit" id="LAY-user-role-submit">提交</button>
    </div>
  </div>
@endsection
@section('content_script')
  <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
  <script>
    layui.use('form', function (){
      let form = layui.form;
      form.on('submit(LAY-user-role-submit)', function (data){
        let params = data.field;
        axios.post('{{route("role.administrators.roleform")}}',params).then(res=>{

        }).catch(err=>{

        })
        alert(33);
      })
    })
  </script>
@endsection
