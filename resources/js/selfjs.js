if (typeof jQuery === 'undefined') {
    throw new Error('AdminLTE requires jQuery')
}

if(typeof axios === 'undefined') {
    throw new Error('selfjs requires axios')
}

if(typeof layui === 'undefined') {
    throw new Error('selfjs requires layui')
}

if(typeof layer === 'undefined') {
    throw new Error('selfjs requires layer')
}

var methods = {
    tableRender : function(obj, attr){
        let token = document.head.querySelector('meta[name="csrf-token"]')
        console.log(obj);
        obj.render({
            elem: attr.elem,
            method: 'post',
            url: attr.url,
            where: {_token: token.content},
            page: true,
            toolbar: attr.toolbar ? attr.toolbar : false,
            defaultToolbar: attr.defaultToolbar ? attr.defaultToolbar : false,
            cols:[attr.cols]
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
    submitEvent: function(obj, attr){
        if(!attr.url){
            layer.msg('form表单 url未设置');
            return false;
        }
        console.log(attr);return false;
        obj.on('submit('+ attr.filter +')', function(data){
            let params = new FormData(document.getElementById(attr.elem));
            $.selfPost(attr.url, data);
        })
    },
    toolbarEvent: function(obj, attr){
        obj.on('toolbar('+attr.elem+')', function(data){
            // let status = obj.checkStatus(data.config.id);
            switch (data.event){
                case 'add':
                    window.location.href=attr.url;
            }
        })
    }
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
                if(res.data.code == 200){
                    if(typeof href === 'boolean'){
                        window.location.reload();
                    } else if(typeof href === "string"){
                        window.location.href = href;
                    }
                }
            })
        }).catch(error=>{
            layer.msg('请求错误');
            console.log(error.response.data);
        })
    },

    /**
     *
     * @param obj = {
     *     module: ['table', 'form','laydate'],
     *     render: {
     *         tableRender: [{
     *              el: '#el',
     *              toolbar: '',
     *              defaultToolbar: '',
     *              cols: [[{...}]],
     *         }],
     *         formRender: {
     *             submit: 'submit_btn',
     *         },
     *         dateRender: [{
     *             el: '#el',
     *             type: '',
     *             range: '',
     *         }],
     *         uploadRender: [{
     *              elem: '', //绑定元素
     *              url: '',
     *              multiple: '',
     *              done: done,
     *              error: error
     *         }]
     *     },
     *     event: {
     *          submitEvent: [{
     *              elem: 'submit_btn',
     *              url: ''
     *          }],
     *          toolbarEvent: [{
     *              elem: '',
     *              url: ''
     *          }]
     *     }
     * }
     */
    selfLayui: function(obj){
        let laymodule = $('form#form').data('module');
        if(laymodule != undefined){
            laymodule = laymodule.split(',');
        }
        var modules = obj.module ? obj.module : laymodule,
            render = obj.render,
            event = obj.event;

        layui.use(modules, function (){
            if(modules.indexOf('table')> -1){
                let table = layui.table;
                // table的渲染
                if(render && render.tableRender.length > 0){
                    render.tableRender.forEach(function(attr){
                        methods.tableRender(table, attr)
                    })
                } else {
                    let tableRender = $('form#form').find("[lay-tableRender$='true']");
                    tableRender.each(function (k, v){
                        let arguement = $(v).data('argu');
                        let arguements = eval('(' + arguement + ')');
                        console.log(arguements);return false;
                        methods.tableRender(upload, arguements);
                    })
                }
                //table的事件
                if(event && event.toolbarEvent.length > 0){
                    event.toolbarEvent.forEach(function(attr){
                        methods.toolbarEvent(table, attr);
                    })
                }
            }

            if(modules.indexOf('form') > -1){
                let form = layui.form;
                //form的事件
                if(event && event.submitEvent.length > 0){
                    event.submitEvent.forEach(function(attr){
                        methods.submitEvent(form, attr);
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
