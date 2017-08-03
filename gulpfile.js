var gulp = require('gulp');
var concat = require("gulp-concat");
var uglify = require("gulp-uglify");
var cssmin = require("gulp-cssmin");
var stripCssComments = require('gulp-strip-css-comments');
var imagemin  = require('gulp-imagemin');
var pngquant = require('gulp-pngquant');

gulp.task('default', ['scripts', 'styles', 'fonts' ,'images','less'], function() {});

gulp.task('scripts', function () {
    gulp.src([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/jquery.maskedinput/src/jquery.maskedinput.js',
        'node_modules/sweetalert2/dist/sweetalert2.js'
    ])
        .pipe(uglify())
        .pipe(concat('script.min.js'))
        .pipe(gulp.dest('./resource/js/'));
});

gulp.task('styles', function () {
    gulp.src([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/sweetalert2/dist/sweetalert2.min.css',
        'node_modules/font-awesome/css/font-awesome.min.css'

    ])
        .pipe(concat('style.min.css'))
        .pipe(stripCssComments({all: true}))
        .pipe(cssmin())
        .pipe(gulp.dest('./resource/css/'));
});

gulp.task('fonts', function () {
    gulp.src([
        'node_modules/bootstrap/dist/fonts/*.**',
        'node_modules/font-awesome/fonts/*.**'
    ]).pipe(gulp.dest('./resource/fonts/'));
});

gulp.task('less', function () {
    gulp.src([
        'node_modules/font-awesome/less/*.**'

    ]).pipe(gulp.dest('./resource/less/'));
});

gulp.task('images', function () {
    gulp.src([
    ])
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('./resource/images/'));
});


