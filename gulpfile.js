'use strict';

const { src, dest, watch, series } = require('gulp');
const concat = require('gulp-concat');
const del = require('del');
const eslint = require('gulp-eslint');
const minify = require('gulp-minify');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');


// Test if Gulp is installed.
function defaultTask (cb) {
  cb();
}


// CSS stylesheet

function watchStyles (done) {
  watch('scss/**/*.scss', series(generateStyles));
  done();
}

function generateStyles () {
  return src([
    'scss/**/*.scss',
    '!scss/vendor/ucla-bruin-components/**',
    '!scss/vendor/ucla-wp/**'
    ])
    .pipe(sourcemaps.init())
    .pipe(sass.sync({ outputStyle: 'expanded' }).on('error', sass.logError))
    .pipe(concat('ucla-ps.css'))
    .pipe(sourcemaps.write(''))
    .pipe(dest('css'));
}

function compressStyles () {
  return src([
      'scss/**/*.scss',
      '!scss/vendor/ucla-bruin-components/**',
      '!scss/vendor/ucla-wp/**'
      ])
    .pipe(sourcemaps.init())
    .pipe(sass.sync({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(concat('ucla-ps.min.css'))
    .pipe(sourcemaps.write(''))
    .pipe(dest('css'));
}



// Scripts

function watchScripts (done) {
  watch('src/js/*.js', series(generateScripts, lintScripts));
  done();
}

function lintScripts () {
  return src('src/js/*.js')
    .pipe(eslint())
    .pipe(eslint.format());
}

function generateScripts () {
  return src('src/js/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('ucla-ps-scripts.js'))
    .pipe(minify({
      ext: {
        src: '.js',
        min: '.min.js'
      },
    }))
    .pipe(sourcemaps.write(''))
    .pipe(dest('js'));
}



// Clean unnecessary files

function cleanUp () {
  return del([
    'public/js/*',
    'public/css/*'
  ]);
}



// gulp
exports.default = defaultTask;

// gulp watch
exports.watch = series(
  watchScripts,
  cleanUp,
  generateScripts,
  generateStyles
);

// gulp build
exports.build = series(
  cleanUp,
  generateScripts,
  generateStyles,
  compressStyles
);

// gulp production
exports.production = series(
  cleanUp,
  generateScripts,
  generateStyles,
  compressStyles
);
