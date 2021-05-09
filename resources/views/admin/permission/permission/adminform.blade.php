@extends('layouts.frame')
@section('content')
  <form action="javascript:void(0)" id="form"
        data-module="form"
        data-event="submitEvent"
        data-argu="{url: '{{route('admin.permission.permission.adminform')}}',
        elem: 'form'}">
  <div class="layui-form" lay-filter="layuiadmin-form-admin" id="layuiadmin-form-admin" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">权限名称</label>
      <div class="layui-input-inline">
        <input type="text" name="name" lay-verify="required" placeholder="请输入权限名称"
               autocomplete="off" class="layui-input" value="{{$permission->name??''}}">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">路由</label>
      <div class="layui-input-inline">
        <input type="text" name="route" lay-verify="required" placeholder="请输入路由"
               autocomplete="off" class="layui-input" value="{{$permission->route??''}}">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">选择平台</label>
      <div class="layui-input-block">
        <input type="radio" name="guard_name" value="web" title="总台" checked>
        <input type="radio" name="guard_name" value="merchant" title="商户" @if(isset($permission->guard_name) && $permission->guard_name == 'merchant') checked @endif >
        <input type="radio" name="guard_name" value="store" title="店铺" @if(isset($permission->guard_name) && $permission->guard_name == 'store') checked @endif>
      </div>
    </div>
    <div class="layui-form-item">
      @if($permission)
        <input type="hidden" name="id" value="{{$permission->id}}">
      @endif
      <input type="button" lay-submit lay-filter="form" class="layui-btn" value="确认">
    </div>
  </div>
  </form>
@endsection
@section('content_script')

  <script>
    $.selfLayui({})
  </script>
@endsection