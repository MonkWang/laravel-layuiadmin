/** -v  License */
 ;layui.define(function(t){var n=layui.$,e=(layui.layer,layui.laytpl,layui.setter,layui.view,layui.admin);e.events.logout=function(){e.req({url:"/logout",type:"post",data:{_token:n('meta[name="csrf-token"]').attr("content")},done:function(t){e.exit(function(){location.href="/login"})}})},t("common",{})});