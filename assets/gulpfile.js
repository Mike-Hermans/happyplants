var browserSync = require('browser-sync').create();
var cleanCss    = require('gulp-clean-css');
var gulp        = require('gulp');
var sass        = require('gulp-sass');

gulp.task('sass', function () {
    return gulp.src('./sass/main.scss')
        .pipe(sass())
        .pipe(cleanCss({
            keepSpecialComments: false
        }))
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream());
});

gulp.task('watch', function () {
    browserSync.init({
        proxy: 'happyplants.dev'
    });
    gulp.watch('./sass/**/*.scss', ['sass']);
    gulp.watch("../*.php").on('change', browserSync.reload);
    gulp.watch("./assets/js/*.js").on('change', browserSync.reload);
});

gulp.task('default', function() {
    gulp.start('sass');
});