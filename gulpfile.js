
//
// Gulpfile
//

// Dependencies
//
var gulp = require('gulp');
var pump = require('pump');
var path = require('path');
var sass = require('gulp-sass');
var minify = require('gulp-minify');
var rename = require('gulp-rename');
var browserify = require('browserify');
var cleanCss = require('gulp-clean-css');
var runSequence = require('run-sequence');
var source = require('vinyl-source-stream');

// High Level Tasks
//
gulp.task('default', ['js', 'css']);

// JS Tasks
//
gulp.task('js', function(done) {
	runSequence(
		[
			'js:high-dom-admin',
			'js:low-dom-admin'
		], 
		'js:minify', 
		function() {
			done();
		}
	);
});

gulp.task('js:high-dom-admin', function(done) {
	pump([
		browserify('./public/src/js/high-dom/admin.js', {
			paths: [
				'node_modules',
				'public/src/js'
			]
		}).bundle(),
		source('admin.js'),
		gulp.dest('public/dist/js/high-dom')
	], done);
});

gulp.task('js:low-dom-admin', function(done) {
	pump([
		browserify('./public/src/js/low-dom/admin.js', {
			paths: [
				'node_modules',
				'public/src/js'
			]
		}).bundle(),
		source('admin.js'),
		gulp.dest('public/dist/js/low-dom')
	], done);
});


gulp.task('js:minify', function(done) {
	pump([
		gulp.src([
			'public/dist/js/**/*.js',
			'!public/dist/js/**/*.min.js'
		]),
		minify({
			ext: {
				src: '.js',
				min: '.min.js'
			}
		}),
		gulp.dest('public/dist/js')
	], done);
});


// CSS Tasks
//
gulp.task('css', function(done) {
	runSequence(
		'css:all',
		'css:minify', 
		function() {
			done();
		}
	);
});

gulp.task('css:all', function(done) {
	pump([
		gulp.src('public/src/css/**/*.scss'),
		sass({
			includePaths: [
				getCssPath('jquery-treetable'),
				getCssPath('chosen-js'),
				getCssPath('tether', '/../css'),
				getCssPath('bootstrap', '/../css')
			]
		}),
		gulp.dest('public/dist/css')
	], done);
});

gulp.task('css:minify', function(done) {
	pump([
		gulp.src([
			'public/dist/css/**/*.css',
			'!public/dist/css/**/*.min.css'
		]),
		cleanCss({
			keepSpecialComments: '0'
		}),
		rename(function(path) {
			path.extname = '.min.css';
		}),
		gulp.dest('public/dist/css')
	], done);
});

// Helper Functions
//
function getModulePath(moduleName) {
	var normalizeEntryPoint = require.resolve(moduleName);
	var normalizeDir = path.dirname(normalizeEntryPoint);
	return normalizeDir;
}

function getCssPath(moduleName, filePath) {
	filePath || (filePath = '');
	var modulePath = getModulePath(moduleName);
	// console.log('CssPath: ', modulePath+filePath);
	return modulePath+filePath;
}
