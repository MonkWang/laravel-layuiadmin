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

let method = {
    tableRender : function(obj, attr){
        let token = document.head.querySelector('meta[name="csrf-token"]')
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
        console.log(attr);
        obj.on('submit('+ attr.elem +')', function(data){
            let params = new FormData(document.getElementById(attr.elem));
            $.selfPost(attr.url, params);
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
                    } else if(typeof href === "string" || res.data.href != undefined){
                        window.location.href = href;
                    }
                }
            })
        }).catch(error=>{
            console.log(error)
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
                        method.tableRender(table, attr)
                    })
                }
                //table的事件
                if(event && event.toolbarEvent.length > 0){
                    event.toolbarEvent.forEach(function(attr){
                        method.toolbarEvent(table, attr);
                    })
                }
            }

            if(modules.indexOf('form') > -1){
                let form = layui.form;
                //form的事件
                if(event && event.submitEvent.length > 0){
                    event.submitEvent.forEach(function(attr){
                        method.submitEvent(form, attr);
                    })
                }
            }

            if(modules.indexOf('laydate') > -1){
                let laydate = layui.laydate;
                if(render && render.dateRender.length > 0){
                    render.dateRender.forEach(function(attr){
                        method.dateRender(laydate, attr)
                    })
                }
            }

            if(modules.indexOf('upload') > -1){
                let upload = layui.upload;
                if(render && render.uploadRender.length > 0){
                    render.uploadRender.forEach(function(attr){
                        method.uploadRender(upload, attr);
                    })
                } else {
                    let uploadRender = $('form#form').find("[lay-uploadRender$='true']");
                    uploadRender.each(function(k,v){
                        let button = $(v).data('argu');
                        buttons = eval('(' + button + ')');
                        method.uploadRender(upload, buttons);
                    });
                }
            }
        })
    }
})
