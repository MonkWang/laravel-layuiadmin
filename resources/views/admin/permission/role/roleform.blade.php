@extends('layouts.frame')
@section('content')
  <form action="javascript:void(0)" id="roleform">
  <div class="layui-form" lay-filter="layuiadmin-form-role" id="layuiadmin-form-role" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">角色</label>
      <div class="layui-input-inline">
        <input type="text" name="name" lay-verify="required" placeholder="请输入角色"
               autocomplete="off" class="layui-input" value="{{$role->name??''}}">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">选择平台</label>
      <div class="layui-input-block">
        <input type="radio" name="guard_name" value="web" title="总台" checked>
        <input type="radio" name="guard_name" value="merchant" title="商户" @if($role->guard_name == 'merchant') checked @endif >
        <input type="radio" name="guard_name" value="store" title="店铺" @if($role->guard_name == 'store') checked @endif>
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
        <textarea type="text" name="description" lay-verify="required" autocomplete="off" class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      @if($role)
        <input type="hidden" name="id" value="{{$role->id}}">
      @endif
      <button class="layui-btn" lay-submit lay-filter="LAY-user-role-submit" id="LAY-user-role-submit">提交</button>
    </div>
  </div>
  </form>
@endsection
@section('content_script')
  <script src="{{asset('js/selfjs.js')}}"></script>
  <script>
      let params = new FormData(document.getElementById('roleform'));
      $.selfPost("{{route('admin.permission.role.roleform')}}")
  </script>
@endsection
