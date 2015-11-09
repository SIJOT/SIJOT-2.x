'use strict';

// GULP DEPENDENCIES
// -------------------------------------------
var gulp = require('gulp-help')(require('gulp'));
var sass = require('gulp-ruby-sass');

// Tasks
// -------------------------------------------
gulp.task('sass', function () {
    return sass('./resources/assets/scss/*.scss')
        .on('error', sass.logError)
        .pipe(gulp.dest('./public/css'));
});

gulp.task('move', function() {
    gulp.src('./resources/assets/fonts/*')
        .pipe(gulp.dest('./public/fonts'));
});