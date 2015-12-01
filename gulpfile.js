// GULP DEPENDENCIES
// ----------------------------------------------------------------------------
var gulp         = require('gulp');
var sass         = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss    = require('gulp-minify-css');
var jshint       = require('gulp-jshint');
var concat       = require('gulp-concat');
var uglify       = require('gulp-uglify');
var imageMin     = require('gulp-imagemin');
var notify       = require('gulp-notify');
var rename       = require('gulp-rename');
var cache        = require('gulp-cache');
var del          = require('del');

// GULP TASKS.
// ----------------------------------------------------------------------------
gulp.task('styles', function() {
    return sass('./resources/assets/scss/*.scss', { style: 'expanded' })
        .pipe(autoprefixer('last 2 version'))
        .pipe(gulp.dest('./public/css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('./public/css'))
        .pipe(notify({ message: 'Styles task complete' }));
});

// Clean the assets directories.
gulp.task('clean', function() {
    return del(['./public/styles']);
});

// Gulp default task.
// You can simply run it with `gulp`
gulp.task('default', ['clean'], function() {
    gulp.start('styles');
});

gulp.task('watch', function() {
    // Watch .scss files.
    gulp.watch('./resources/assets/scss/*.scss', ['styles']);
});

