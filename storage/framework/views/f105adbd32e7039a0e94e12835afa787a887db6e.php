<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" lay-href="home/console.html">
            <span>layuiAdmin</span>
        </div>

        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="layui-nav-item">
                    <a href="javascript:;" lay-tips="主页">
                        <i class="layui-icon layui-icon-home"></i>
                        <cite><?php echo e($menu->name); ?></cite>
                    </a>
                    <dl class="layui-nav-child">
                        <?php $__empty_2 = true; $__currentLoopData = $menu->child_hasMany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <dd>
                                <a lay-href="<?php echo e(route($m->route)); ?>"><?php echo e($m->name); ?></a>
                            </dd>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                        <?php endif; ?>
                    </dl>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>

        </ul>
    </div>
</div><?php /**PATH /Users/amber/Desktop/php/wjlaravel/resources/views/layouts/left.blade.php ENDPATH**/ ?>