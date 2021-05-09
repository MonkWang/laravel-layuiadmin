<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" lay-href="home/console.html">
            <span>layuiAdmin</span>
        </div>

        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            @forelse($menus as $menu)
                <li class="layui-nav-item">
                    <a href="javascript:;" lay-tips="主页">
                        <i class="layui-icon layui-icon-home"></i>
                        <cite>{{$menu->name}}</cite>
                    </a>
                    <dl class="layui-nav-child">
                        @forelse($menu->child_hasMany as $m)
                            <dd>
                                <a lay-href="{{route($m->route)}}">{{$m->name}}</a>
                            </dd>
                        @empty
                        @endforelse
                    </dl>
                </li>
            @empty
            @endforelse

        </ul>
    </div>
</div>