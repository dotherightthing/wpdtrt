/**
 * Gulp Task Runner
 * Compile, concatenate and minify front-end resources
 *
 * @example gulp default
 * @example gulp css
 * @example gulp js
 * @example gulp php
 *
 * @package DTRT Framework - Theme
 * @since 0.1.0
 * @version 0.1.0
 *
 * To run from a child theme:
 * gulp --gulpfile ../wpdtrt/gulpfile.js --cwd ./
 */

// dependencies

var gulp = require('gulp');

var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var csso = require('postcss-csso');
var pxtorem = require('postcss-pxtorem');

var importjs = require('gulp-importjs'); // js imports
var rename = require('gulp-rename'); // File renamer
var sass = require('gulp-sass');
var uglify = require('gulp-uglify'); // JS minifier

// parent theme source directories

var jsSrc = './js/*.jsrc';
var scssSrc = './scss/*.scss';

var cssDir = './css/';
var jsDir = './js';
var phpDir = '**/*.php';

// tasks

gulp.task('css', function () {

  var processors = [
      autoprefixer({
        cascade: false
      }),
      csso({
        debug: false,
        restructure: false,
        sourceMap: false
      }),
      pxtorem({
        rootValue: 16,
        unitPrecision: 5,
        propList: [
          'font',
          'font-size',
          'padding',
          'padding-top',
          'padding-right',
          'padding-bottom',
          'padding-left',
          'margin',
          'margin-top',
          'margin-right',
          'margin-bottom',
          'margin-left',
          'bottom',
          'top',
          'max-width'
        ],
        selectorBlackList: [],
        replace: false,
        mediaQuery: true,
        minPixelValue: 0
      })
  ];

  return gulp
    .src(scssSrc)
    .pipe(sass({outputStyle: 'expanded'}))
    .pipe(postcss(processors))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(cssDir));
});

gulp.task('js', function () {
  return gulp
    .src( jsSrc )
    .pipe( importjs() )
    //.pipe( uglify() )
    .pipe( rename({ extname: '.min.js' }) )
    .pipe( gulp.dest( jsDir ) );
});

/*
gulp.task('php', function () {
  return gulp
    .src([phpDir])

    // validate PHP
    // The linter ships with PHP
    .pipe(phplint())
    .pipe(phplint.reporter(function(file){
      var report = file.phplintReport || {};

      if (report.error) {
        console.log(report.message+' on line '+report.line+' of '+report.filename);
      }
    }));
});
*/

gulp.task( 'default', ['css','js'] );

