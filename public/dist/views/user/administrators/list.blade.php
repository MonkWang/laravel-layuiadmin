@extends('layouts.frame')
@section('content')
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">登录名</label>
            <div class="layui-input-block">
              <input type="text" name="loginname" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">手机</label>
            <div class="layui-input-block">
              <input type="text" name="telphone" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
              <input type="text" name="email" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">角色</label>
            <div class="layui-input-block">
              <select name="role">
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
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="LAY-user-back-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>
      
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-admin" data-type="batchdel">删除</button>
          <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加</button>
        </div>
        
        <table id="LAY-user-back-manage" lay-filter="LAY-user-back-manage"></table>  
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
 <script src="{{asset('dist/layuiadmin/layui/layui.js')}}"></script>
  <script>
  layui.config({
    base: '../../../dist/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'useradmin', 'table'], function(){
    var $ = layui.$
    ,form = layui.form
    ,table = layui.table;

    //管理员管理
    table.render({
      elem: '#LAY-user-back-manage'
      ,url: layui.setter.base + 'json/useradmin/mangadmin.js' //模拟接口
      ,cols: [[
        {type: 'checkbox', fixed: 'left'}
        ,{field: 'id', width: 80, title: 'ID', sort: true}
        ,{field: 'loginname', title: '登录名'}
        ,{field: 'telphone', title: '手机'}
        ,{field: 'email', title: '邮箱'}
        ,{field: 'role', title: '角色'}
        ,{field: 'jointime', title: '加入时间', sort: true}
        ,{field: 'check', title:'审核状态', templet: '#buttonTpl', minWidth: 80, align: 'center'}
        ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-useradmin-admin'}
      ]]
      ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-user-back-manage)', function(obj){
      var data = obj.data;
      if(obj.event === 'del'){
        layer.prompt({
          formType: 1
          ,title: '敏感操作，请验证口令'
        }, function(value, index){
          layer.close(index);
          layer.confirm('确定删除此管理员？', function(index){
            console.log(obj)
            obj.del();
            layer.close(index);
          });
        });
      }else if(obj.event === 'edit'){
        var tr = $(obj.tr);

        layer.open({
          type: 2
          ,title: '编辑管理员'
          ,content: '../../../views/user/administrators/adminform.html'
          ,area: ['420px', '420px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
                    ,submitID = 'LAY-user-back-submit'
                    ,submit = layero.find('iframe').contents().find('#'+ submitID);

            //监听提交
            iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
              var field = data.field; //获取提交的字段

              //提交 Ajax 成功后，静态更新表格中的数据
              //$.ajax({});
              table.reload('LAY-user-front-submit'); //数据刷新
              layer.close(index); //关闭弹层
            });

            submit.trigger('click');
          }
          ,success: function(layero, index){

          }
        })
      }
    });
    
    //监听搜索
    form.on('submit(LAY-user-back-search)', function(data){
      var field = data.field;
      //执行重载
      table.reload('LAY-user-back-manage', {
        where: field
      });
    });
  
    //事件
    var active = {
      batchdel: function(){
        var checkStatus = table.checkStatus('LAY-user-back-manage')
        ,checkData = checkStatus.data; //得到选中的数据
        if(checkData.length === 0){
          return layer.msg('请选择数据');
        }
        
        layer.prompt({
          formType: 1
          ,title: '敏感操作，请验证口令'
        }, function(value, index){
          layer.close(index);
          
          layer.confirm('确定删除吗？', function(index) {
            table.reload('LAY-user-back-manage');
            layer.msg('已删除');
          });
        }); 
      }
      ,add: function(){
        layer.open({
          type: 2
          ,title: '添加管理员'
          ,content: '{{route('user.administrators.adminform')}}'
          ,area: ['420px', '420px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
            ,submitID = 'LAY-user-back-submit'
            ,submit = layero.find('iframe').contents().find('#'+ submitID);

            //监听提交
            iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
              var field = data.field; //获取提交的字段
              
              //提交 Ajax 成功后，静态更新表格中的数据
              //$.ajax({});
              table.reload('LAY-user-front-submit'); //数据刷新
              layer.close(index); //关闭弹层
            });
            submit.trigger('click');
          }
        }); 
      }
    }  
    $('.layui-btn.layuiadmin-btn-admin').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
  });
  </script>
@endsection

