/**
 layuiAdmin std 构建
*/

var pkg = require('./package.json');

var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');
var header = require('gulp-header');
var del = require('del');
const { series } = require('gulp');

//获取参数
var note = [
  '/** <%= pkg.name %>-v<%= pkg.version %> <%= pkg.license %> License */\n <%= js %>'
  ,{pkg: pkg, js: ';'}
]

,destDir = './public/dist' //构建的目标目录

//任务
,task = {
  //压缩 JS
  minjs: function(){
    var src = [
      './resources/layuiadmin/**/*.js'
      ,'!./resources/layuiadmin/json/**/*.js'
      ,'!./resources/layuiadmin/layui/**/*.js'
      ,'!./resources/layuiadmin/config.js'
      ,'!./resources/layuiadmin/lib/extend/echarts.js'
    ];

    return gulp.src(src).pipe(uglify())
     .pipe(header.apply(null, note))
    .pipe(gulp.dest(destDir + '/layuiadmin'));
  }

  //压缩 CSS
  ,mincss: function(){
    var src = [
      './resources/layuiadmin/**/*.css'
      ,'!./resources/layuiadmin/layui/**/*.css'
    ]
     ,noteNew = JSON.parse(JSON.stringify(note));

    noteNew[1].js = '';

    return gulp.src(src).pipe(minify({
      compatibility: 'ie7'
    })).pipe(header.apply(null, noteNew))
    .pipe(gulp.dest(destDir + '/layuiadmin'));
  }

  //复制文件夹
  ,mv: function(){
    gulp.src('./resources/layuiadmin/json/**/*')
    .pipe(gulp.dest(destDir + '/layuiadmin/json'));

    gulp.src('./resources/layuiadmin/lib/extend/echarts.js')
    .pipe(gulp.dest(destDir + '/layuiadmin/lib/extend'));

    gulp.src('./resources/layuiadmin/config.js')
    .pipe(gulp.dest(destDir + '/layuiadmin'));

    gulp.src('./resources/layuiadmin/tpl/**/*')
    .pipe(gulp.dest(destDir + '/layuiadmin/tpl'));

    gulp.src('./resources/layuiadmin/style/res/**/*')
    .pipe(gulp.dest(destDir + '/layuiadmin/style/res'));

    gulp.src('./resources/layuiadmin/style/res/*')
    .pipe(gulp.dest(destDir + '/layuiadmin/style/res'));

    return gulp.src('./resources/views/**/*')
    .pipe(gulp.dest(destDir + '/views'));
  }

  //复制 layui
  ,layui: function(){
    return gulp.src('./resources/layuiadmin/layui/**/*')
    .pipe(gulp.dest(destDir + '/layuiadmin/layui'))
  }
};

//清理
gulp.task('clear', function(cb) {
  return del([ destDir + '/*'], cb);
});

gulp.task('minjs', task.minjs);
gulp.task('mincss', task.mincss);
gulp.task('mv', task.mv);
gulp.task('layui', task.layui);

gulp.task('src', function(){ //命令：gulp src
  return gulp.src('./dev-src/**/*')
  .pipe(gulp.dest('./src'));
});

//构建核心源文件
gulp.task('default', series('clear', 'src', function(){ //命令：gulp
  for(var key in task){
    task[key]();
  }
}));





