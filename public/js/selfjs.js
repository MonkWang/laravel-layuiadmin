loadBefore();


var baseRenders = {
    tableRender : function(obj, attr){
        let token = document.head.querySelector('meta[name="csrf-token"]')
        let colArr = attr.cols;

        for(i=0;i<colArr.length;i++){
            for(var key in colArr[i]){
                if(colArr[i][key] == '操作'){
                    colArr[i].templet = obj=>{
                        let templateHtml = ''
                        if(attr.update != undefined){
                            templateHtml += '<a href="'+attr.update+'?'+attr.key+'='+obj.id+'">' +
                                '<input type="button" class="layui-btn layui-btn-sm" value="更新">' +
                                '</a> '
                        }
                        if(attr.del != undefined){
                            templateHtml += '<a href="'+attr.del+'?'+attr.key+'='+obj.id+'">' +
                                '<input type="button" class="layui-btn layui-btn-sm layui-btn-danger" value="删除">' +
                                '</a>';
                        }
                        return templateHtml;
                    }
                }
            }
        }

        obj.render({
            elem: attr.elem,
            method: 'post',
            url: attr.url,
            where: {_token: token.content},
            page: true,
            toolbar: attr.toolbar != undefined ? attr.toolbar : false,
            defaultToolbar: attr.defaultToolbar != undefined ? attr.defaultToolbar : false,
            cols:[colArr]
        })
    },
    dateRender: function(obj, attr){
        obj.render({
            elem: attr.elem,
            type: attr.datetime ? attr.range : 'datetime',
            range: attr.range ? attr.range : false
        })
    },
    uploadRender: function(obj, attr){
        let token = document.head.querySelector('meta[name="csrf-token"]')
        obj.render({
            elem: attr.elem, //绑定元素
            url: attr.url,
            multiple: attr.multiple ? attr.multiple : false,
            data: {_token: token.content},
            done: attr.done ? attr.done : function(res){},
            accept: attr.accept,
            exts:  attr.exts,
            error: function(err){
                layer.msg('上传错误', {time:1000});
            }
        })
    },
}

let baseEvent = {
    submitEvent: function(obj, attr, table){
        if(!attr.url){
            layer.msg('form表单 url未设置');
            return false;
        }
        obj.on('submit('+ attr.filter +')', function(data){
            $.selfPost(attr.url, data.field);
            if(attr.table){
                table.reload('table', {where:data.field})
            }
        })
    },
    toolbarEvent: function(obj, attr){
        obj.on('toolbar('+attr.filter+')', function(data){
            // let status = obj.checkStatus(data.config.id);
            switch (data.event){
                case 'add':
                    window.location.href=attr.url;
            }
        })
    }
}

let eventMiddleware = {
    toolbarEvent: function (table){
        let element = $('div#self-lable').find("table.layui-table")
        element.each(function(k, v){
            // if(attr.toolbar)
            // methods.toolbarEvent(table, attr);
        })
    }
}

let renderMiddleware = {
    tableRender: function(table){
        let tableRender = $('div#self-lable').find("table.layui-table");
        tableRender.each(function (k, v){
            let arguement = $(v).data('argu');
            let arguements = eval('(' + arguement + ')');
            let cols = $(v).find('col');
            arguements.cols = [];
            cols.each(function(k,v){
                arguements.cols[k] = eval('('+ $(v).attr('data-col') +')')
            })
            baseRenders.tableRender(table, arguements);
        })
    },
    formRender: function(){

    }
}

let getBase = {
    getModule: function(){
        let laymodule = $('div#self-lable').data('module');
        if(laymodule != undefined){
            laymodule = laymodule.split(',');
            return laymodule;
        }
        throw new Error('未发现可用的module')
    },
    getRender: function (){
        let layRender = $('div#self-lable').data('render');
        if(layRender != undefined){
            layRender = layRender.split(',');
            return layRender;
        }
    },
    getEvent: function (){
        let layEvent = $('div#self-lable').data('event');
        if(layEvent != undefined){
            layEvent = layEvent.split(',');
            return layEvent;
        }
    },
}

$.extend({
    selfPost: function (url, params, href = null){
        let token = document.head.querySelector('meta[name="csrf-token"]');
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        if(token){
            axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        } else {
            console.error('CSRF token not found');
        }

        axios.post(url, params).then(res=>{
            layer.msg(res.data.msg, {time:1000}, function(){
                console.log(res.data.code)
                if(res.data.code == 200){
                    if(typeof href === 'boolean'){
                        window.location.reload();
                    } else if(res.data.href != undefined){
                        window.location.href = res.data.href;
                    }
                }
            })
        }).catch(error=>{
            layer.msg('请求错误');
            console.log(error.response.data);
        })
    },

    selfLayui: function(){
        var modules = getBase.getModule(),
            render = getBase.getRender(),
            event = getBase.getEvent();

        layui.use(modules, function (){
            if(modules.indexOf('table')> -1){
                var table = layui.table;
                // table的渲染
                renderMiddleware.tableRender(table);
                //table事件
                if(event && event.indexOf('toolbar') > -1){
                    eventMiddleware.toolbarEvent(table)
                }
            }

            if(modules.indexOf('form') > -1){
                var form = layui.form;
                //form的事件
                if(event && event.indexOf('submitEvent') > -1){
                    let forms = $('div#self-lable').find('button.lay-submit');
                    forms.each(function (k, v){
                        arguments = $(v).data('argu') ? eval('('+ $(v).data('argu') +')') : (console.log('表单缺少参数'));
                        if(arguments.table){
                            baseEvent.submitEvent(form, arguments, table)
                        } else {
                            baseEvent.submitEvent(form, arguments)
                        }

                    })
                }
            }

            if(modules.indexOf('laydate') > -1){
                let laydate = layui.laydate;
                if(render && render.dateRender.length > 0){
                    render.dateRender.forEach(function(attr){
                        methods.dateRender(laydate, attr)
                    })
                } else {
                    let dateRender = $('form#form').find("[lay-dateRender$='true']");
                    dateRender.each(function (k, v){
                        let arguement = $(v).data('argu');
                        let arguements = eval('(' + arguement + ')');
                        methods.dateRender(upload, arguements);
                    })
                }
            }

            if(modules.indexOf('upload') > -1){
                let upload = layui.upload;
                if(render && render.uploadRender.length > 0){
                    render.uploadRender.forEach(function(attr){
                        methods.uploadRender(upload, attr);
                    })
                } else {
                    let uploadRender = $('form#form').find("[lay-uploadRender$='true']");
                    uploadRender.each(function(k,v){
                        let arguement = $(v).data('argu');
                        let arguements = eval('(' + arguement + ')');
                        methods.uploadRender(upload, arguements);
                    });
                }
            }
        })
    },
    selfLayerMsg: function(obj){

    },

    selfLayerOpen: function(obj){
        let tableRender = obj.tableRender != undefined ? obj.tableRender : '';
        layui.use('layer', function (){
            let layer = layui.layer;
            layer.open({
                type: 1,  //0、信息框，默认，1、页面层，2、iframe层，3、加载层，4、tips层
                title: false, //不显示标题
                btn: ['确定', '取消'], //仅信息框模式显示
                btnAlign: 'r', //仅信息框模式显示: l 左对齐，c 居中对齐，r 右对齐
                closeBtn: 1,  //两种风格的关闭按钮，通过配1和2展示，如不显示则为 0
                shade: 0,
                shadeClose: true, //是否点击遮罩关闭
                time: 0,   //自动关闭所需毫秒, 默认不自动关闭。单位是毫秒
                content: $('.layer_notice'), //dom、url 若是捕获的元素则最好放在body外层，否则可能被其它元素影响;
                success: function(layero, index){   // 层弹出后的成功回调方法,success有两个参数，分别是当前层DOM当前层索引index

                },
                cancel: function(){   //右上角关闭按钮触发的回调
                    layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', {time: 5000, icon:6});
                }
            })
        })
    },

    selfLayerPrompt: function (obj){
        layui.use('layer', function (){
            let layer = layui.layer;
            layer.prompt({
                formType: 2,
                value: '初始值',
                title: '请输入值',
                area: ['800px', '350px'] //自定义文本域宽高
            }, function(value, index, elem){    //yes携带value 表单值index 索引elem 表单元素
                alert(value); //得到value
                layer.close(index);
            });
        })
    },

    selfLayerConfirm: function (obj){
        layui.use('layer', function (){
            let layer = layui.layer;
            layer.confirm(obj.msg, {btn: obj.btn}, obj.done);
        })
    }
})


function loadScript(url, callback) {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = url;
    document.getElementById("javascript").appendChild(script);
    script.onload = function () {
        callback();
    }
}

function loadBefore(){
    if (typeof jQuery === 'undefined')
        throw new Error('AdminLTE requires jQuery')

    if(typeof axios === 'undefined')
        throw new Error('selfjs requires axios')

    if(typeof layui === 'undefined')
        loadScript('dist/layuiadmin/layui/layui.js')

    if(typeof layer === 'undefined')
        throw new Error('selfjs requires layer')
}

var tableAction = {
    add: function(url){
        return '<a href="'+url+'"><button class="layui-btn layui-btn-sm">添加</button></a> '
    },
}

