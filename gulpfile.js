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
 */

// dependencies

var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer'); // CSS prefixes
var cleanCSS = require('gulp-clean-css'); // CSS minifier
var concat = require('gulp-concat'); // concatenate files
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps'); // CSS debugging
var rename = require('gulp-rename'); // File renamer
var uglify = require('gulp-uglify'); // JS minifier

// source directories

// do this in JS file so this script can be run from child theme
var jsSrc = [
  // we use the unminified versions
  // and then minify them
  // so that we can debug them using sourcemaps
//  './vendor/enquire/dist/enquire.js',
//  './vendor/responsive-nav/responsive-nav.js',
//  './vendor/jquery.mobile.custom/jquery.mobile.custom.js',
  //'./vendor/jquery-ui-1.12.1.custom/jquery-ui.js', // accordion
  './js/wpdtrt__parent.js'
];
var phpDir = '**/*.php';
var scssDir = './scss/wpdtrt__parent.scss';

// target directories

var cssDir = './css/';
var jsDir = './js';

// tasks

gulp.task('css', function () {
  return gulp
    .src(scssDir)
    //.pipe(sourcemaps.init()) // not for production as adds many kb
    .pipe(sass({outputStyle: 'expanded'}))
    .pipe(autoprefixer({
        cascade: false
    }))
    //.pipe(cleanCSS({compatibility: 'ie8'}))
    //.pipe(sourcemaps.write()) // not for production as adds many kb
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(cssDir));
});

gulp.task('js', function () {
  return gulp
    .src(jsSrc)
    .pipe(concat('frontend.js'))
    //.pipe(sourcemaps.init()) // not for production as adds many kb
    .pipe(uglify())
    //.pipe(sourcemaps.write()) // not for production as adds many kb
    .pipe(gulp.dest(jsDir));
});

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

gulp.task( 'default', ['css','js', 'php'] );

