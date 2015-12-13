// GULP DEPENDENCIES
// ----------------------------------------------------------------------------
var gulp         = require('gulp-help')(require('gulp'));
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
var scsslint     = require('gulp-scss-lint');

// GULP TASKS.
// ----------------------------------------------------------------------------

gulp.task('styles', 'Transform the scss files to css', function() {
    return sass('./resources/assets/scss/*.scss', { style: 'expanded' })
        .pipe(autoprefixer('last 2 version'))
        .pipe(gulp.dest('./public/css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('./public/css'))
        .pipe(notify({ message: 'Styles task complete' }));
});

// Lint the scss resources,
// This function is depended on.
// the scss_lint gem.
// You can install it with the following command:
//
// gem install scss_lint
gulp.task('scss-lint', 'Lint the scss files.', function() {
    return gulp.src('./resources/assets/scss/*.scss')
        .pipe(scsslint());
});

// Clean the assets directories.
gulp.task('clean', 'Empty the public assets folders', function() {
    return del(['./public/styles']);
});

// Gulp default task.
// You can simply run it with `gulp`
gulp.task('default', 'Gulp his default task', ['clean'], function() {
    gulp.start('styles');
});

// Watch for changes.
gulp.task('watch', 'Watch for changes' function() {
    // Watch .scss files.
    gulp.watch('./resources/assets/scss/*.scss', ['styles']);
});
