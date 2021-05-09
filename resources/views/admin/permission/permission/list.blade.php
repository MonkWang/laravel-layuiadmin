@extends('layouts.frame')
@section('content')
    <div id="self-lable" data-module="form,table" data-render="table" data-event="submitEvent">
        <form action="javascript:void(0)" id="LAY-user-back-search">
            <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">权限名</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" placeholder="请输入" autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-admin lay-submit" lay-submit lay-filter="LAY-user-back-search"
                                data-argu="{table:'table', filter:'LAY-user-back-search',url:'{{route("admin.permission.permission.list")}}'}">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-admin" data-type="batchdel">删除</button>
                <a href="{{route('admin.permission.permission.adminform')}}">
                    <button class="layui-btn layuiadmin-btn-admin">添加</button>
                </a>
            </div>

            <table class="layui-table" id="table"
                   data-argu="{url:'{{route("admin.permission.permission.list")}}'
               ,elem:'table'
               ,key: 'id'
               ,update: '{{route("admin.permission.permission.adminform")}}'
               ,del:'{{route('admin.permission.permission.delete')}}'}"
                   data-filter="table">
                <tr style="display: none">
                    <col data-col="{field:'id', title:'id', width:80}"></col>
                    <col data-col="{field:'name', title: '名称'}"></col>
                    <col data-col="{field:'route', title: '路由'}"></col>
                    <col data-col="{field:'guard_name', title: '平台'}"></col>
                    <col data-col="{field:'', title: '操作'}"></col>
                <tr/>
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

