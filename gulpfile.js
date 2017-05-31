var gulp         = require('gulp'),
    browserSync  = require('browser-sync').create(),
    merge        = require('merge'),
    scsslint     = require('gulp-scss-lint'),
    sass         = require('gulp-sass')
    cleanCSS     = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    rename       = require('gulp-rename'),
    runSequence  = require('run-sequence');

var configLocal   = require('./gulp-config.json'),
    configDefault = {
      src: {
        scss: './src/scss',
        js: './src/js'
      },
      dist: {
        css: './static/css',
        js: './static/js',
        font: './static/fonts'
      },
      packages: './node_modules',
      sync: false,
      syncTarget: 'http://localhost/'
    },
    config = merge(configDefault, configLocal);

gulp.task('move-components-font-awesome', function() {
  gulp.src(config.packages + '/font-awesome/fonts/**/*')
    .pipe(gulp.dest(config.dist.font + '/font-awesome/'));
});

gulp.task('components', [
  'move-components-font-awesome'
]);

gulp.task('scss-lint', function() {
  gulp.src(config.src.scss + '/**/*.scss')
    .pipe(scsslint({
      'maxBuffer': 40 * 1024
    }));
});

var buildCSS = function(src, filename, dest) {
  dest = dest || config.dist.css;

  return gulp.src(src)
    .pipe(sass({
      includePaths: [config.packages, config.src.scss]
    }).on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(autoprefixer({
      cascade: false
    }))
    .pipe(rename(filename))
    .pipe(gulp.dest(dest))
    .pipe(browserSync.stream());
};

gulp.task('scss-build-frontend', function() {
  return buildCSS(config.src.scss + '/style.scss', 'style.min.css');
});

gulp.task('scss-build', ['scss-lint', 'scss-build-frontend']);

gulp.task('watch', function() {
  if (config.sync) {
    browserSync.init({
      proxy: {
        target: config.syncTarget
      }
    });
  }

  gulp.watch(config.src.scss + '/**/*.scss', ['scss-build']);
});

gulp.task('default', function() {
  runSequence('components', ['scss-build']);
});
