@extends('layouts.frame')
@section('content')
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-inline">
            角色筛选
          </div>
          <div class="layui-inline">
            <select name="rolename" lay-filter="LAY-user-adminrole-type">
              <option value="-1">全部角色</option>
              <option value="0">管理员</option>
              <option value="1">超级管理员</option>
              <option value="2">纠错员</option>
              <option value="3">采购员</option>
              <option value="4">推销员1</option>
              <option value="5">运营人员</option>
              <option value="6">编辑</option>
            </select>
          </div>
        </div>
      </div>
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-role" data-type="batchdel">删除</button>
          <button class="layui-btn layuiadmin-btn-role" data-type="add">添加</button>
        </div>
      
        <table id="LAY-user-back-role" lay-filter="LAY-user-back-role"></table>  
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
 <script src="../../../dist/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '../../../dist/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'useradmin', 'table'], function(){
    var $ = layui.$
    ,form = layui.form
    ,table = layui.table;

    //角色管理
    table.render({
      elem: '#LAY-user-back-role'
      ,url: layui.setter.base + 'json/useradmin/role.js' //模拟接口
      ,cols: [[
        {type: 'checkbox', fixed: 'left'}
        ,{field: 'id', width: 80, title: 'ID', sort: true}
        ,{field: 'rolename', title: '角色名'}
        ,{field: 'limits', title: '拥有权限'}
        ,{field: 'descr', title: '具体描述'}
        ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-useradmin-admin'}
      ]]
      ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-user-back-role)', function(obj){
      var data = obj.data;
      if(obj.event === 'del'){
        layer.confirm('确定删除此角色？', function(index){
          obj.del();
          layer.close(index);
        });
      }else if(obj.event === 'edit'){
        var tr = $(obj.tr);

        layer.open({
          type: 2
          ,title: '编辑角色'
          ,content: '../../../views/user/administrators/roleform.html'
          ,area: ['500px', '480px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
                    ,submit = layero.find('iframe').contents().find("#LAY-user-role-submit");

            //监听提交
            iframeWindow.layui.form.on('submit(LAY-user-role-submit)', function(data){
              var field = data.field; //获取提交的字段

              //提交 Ajax 成功后，静态更新表格中的数据
              //$.ajax({});
              table.reload('LAY-user-back-role'); //数据刷新
              layer.close(index); //关闭弹层
            });

            submit.trigger('click');
          }
          ,success: function(layero, index){

          }
        })
      }
    });

    //搜索角色
    form.on('select(LAY-user-adminrole-type)', function(data){
      //执行重载
      table.reload('LAY-user-back-role', {
        where: {
          role: data.value
        }
      });
    });
  
    //事件
    var active = {
      batchdel: function(){
        var checkStatus = table.checkStatus('LAY-user-back-role')
        ,checkData = checkStatus.data; //得到选中的数据

        if(checkData.length === 0){
          return layer.msg('请选择数据');
        }
        
        layer.confirm('确定删除吗？', function(index) {
          table.reload('LAY-user-back-role');
          layer.msg('已删除');
        });
      },
      add: function(){
        layer.open({
          type: 2
          ,title: '添加新角色'
          ,content: 'roleform.html'
          ,area: ['500px', '480px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
            ,submit = layero.find('iframe').contents().find("#LAY-user-role-submit");

            //监听提交
            iframeWindow.layui.form.on('submit(LAY-user-role-submit)', function(data){
              var field = data.field; //获取提交的字段
              
              //提交 Ajax 成功后，静态更新表格中的数据
              //$.ajax({});              
              table.reload('LAY-user-back-role');
              layer.close(index); //关闭弹层
            });  
            
            submit.trigger('click');
          }
        }); 
      }
    }  
    $('.layui-btn.layuiadmin-btn-role').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
  });
  </script>
@endsection

