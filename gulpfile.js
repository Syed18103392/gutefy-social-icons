const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');

gulp.task('scss:compile', function () {
        return gulp.src('./public/extensions/**/*.scss')
                .pipe(sass().on('error', sass.logError))
                .pipe(autoprefixer())
                .pipe(concat('gf-social-icons-public.min.css'))
                .pipe(cleanCSS()) // Minify the CSS
                .pipe(gulp.dest('./assets/css'));
});
gulp.task('admin_scss:compile', function () {
        return gulp.src('./admin/**/*.scss')
                .pipe(sass().on('error', sass.logError))
                .pipe(autoprefixer())
                .pipe(concat('gf-social-icons-admin.min.css'))
                .pipe(cleanCSS()) // Minify the CSS
                .pipe(gulp.dest('./assets/css'));
});

gulp.task('admin_js:minify', function () {
        return gulp.src(['./admin/**/*.js', '!./admin/extensions/**/*customizer-admin.js'])
                .pipe(uglify())
                .pipe(concat('gf-social-icons-admin.min.js'))
                .pipe(gulp.dest('./assets/js'));
});
gulp.task('customizer_admin_js:minify', function () {
        return gulp.src(['./admin/extensions/**/*customizer-admin.js','./admin/controls/account-repeater-control/src/gf-social-icons-fontawsome.js'])
                .pipe(uglify())
                .pipe(concat('gf-social-icons-customizer-admin.min.js'))
                .pipe(gulp.dest('./assets/js'));
});

//public -----------------
gulp.task('js:minify', function () {
        return gulp.src('./public/extensions/**/*.js')
                .pipe(uglify())
                .pipe(concat('gf-social-icons-public.min.js'))
                .pipe(gulp.dest('./assets/js'));
});

gulp.task('watch', function () {
        gulp.watch('./admin/**/*.scss', gulp.series('admin_scss:compile'));
        gulp.watch('./public/extensions/**/*.scss', gulp.series('scss:compile'));
        gulp.watch('./public/extensions/**/*.js', gulp.series('js:minify'));
        gulp.watch(['./admin/**/*.js', '!./admin/extensions/**/*customizer-admin.js'], gulp.series('admin_js:minify'));
        gulp.watch(['./admin/extensions/**/*customizer-admin.js','./admin/controls/account-repeater-control/src/gf-social-icons-fontawsome.js'], gulp.series('customizer_admin_js:minify'));
});

// Default task to run both 'scss:compile' and 'js:minify' tasks when watching
gulp.task('default', gulp.parallel('watch', 'scss:compile', 'js:minify'));
