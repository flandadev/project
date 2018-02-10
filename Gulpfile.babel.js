'use strict';

const stylus = require('gulp-stylus');
const gulp = require('gulp');
const browserSync = require('browser-sync');
const prefix = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const uglify = require('gulp-uglifycss');

const reload = browserSync.reload;
const paths = {
    public: {
        css: 'public/css',
        js: 'public/js'
    },
    dev: {
        sass: 'resources/assets/sass/*.sass',
        scss: 'resources/assets/sass/*.scss',
        stylus: 'resources/assets/styles/*.styl',
        js: 'resources/assets/js/**/*.js'
    }
}

gulp.task('prefix', function () {
  gulp.src(paths.public.css + '/**/*.css')
    .pipe(prefix(["last 8 version", "> 1%", "ie 8"]))
    .pipe(uglify())
    .pipe(gulp.dest(paths.public.css));
});

gulp.task('watch', () => {
    console.log('Watching');

    gulp.watch(paths.dev.sass, ['sass']);
    gulp.watch(paths.dev.scss, ['scss']);
    gulp.watch(paths.dev.stylus, ['stylus']);
})

gulp.task('stylus', () => {
    return gulp.src(paths.dev.stylus)
        .pipe(sourcemaps.init())
        .pipe(stylus())
        .pipe(rename((path) => {
            path.extname = '.min.css'
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.public.css))
        .pipe(browserSync.stream());
});
gulp.task('sass', () => {
    return gulp.src(paths.dev.sass)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(rename((path) => {
            path.extname = '.min.css'
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.public.css))
        .pipe(browserSync.stream());
});
gulp.task('scss', () => {
    return gulp.src(paths.dev.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(rename((path) => {
            path.extname = '.min.css'
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.public.css))
        .pipe(browserSync.stream());
});

gulp.task('default', ['stylus', 'sass', 'scss', 'prefix', 'watch'])
