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
gulp.task('default', ['js', 'css', 'font']);


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
		browserify('./src/js/high-dom/admin.js', {
			paths: [
				'node_modules',
				'src/js'
			]
		}).bundle(),
		source('admin.js'),
		gulp.dest('dist/js/high-dom')
	], done);
});

gulp.task('js:low-dom-admin', function(done) {
	pump([
		browserify('./src/js/low-dom/admin.js', {
			paths: [
				'node_modules',
				'src/js'
			]
		}).bundle(),
		source('admin.js'),
		gulp.dest('dist/js/low-dom')
	], done);
});

gulp.task('js:minify', function(done) {
	pump([
		gulp.src([
			'dist/js/**/*.js',
			'!dist/js/**/*.min.js'
		]),
		minify({
			ext: {
				src: '.js',
				min: '.min.js'
			}
		}),
		gulp.dest('dist/js')
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
		gulp.src('src/css/**/*.scss'),
		sass({
			includePaths: [
				getFilePath('jquery-treetable'),
				getFilePath('chosen-js'),
				getFilePath('tether', '/../css'),
				getFilePath('bootstrap', '/../css'),
				getFilePath('summernote', '/../src/less')
			]
		}),
		gulp.dest('dist/css')
	], done);
});

gulp.task('css:minify', function(done) {
	pump([
		gulp.src([
			'dist/css/**/*.css',
			'!dist/css/**/*.min.css'
		]),
		cleanCss({
			keepSpecialComments: '0'
		}),
		rename(function(path) {
			path.extname = '.min.css';
		}),
		gulp.dest('dist/css')
	], done);
});


// Font tasks
//
gulp.task('font', function() {
	runSequence(
		'font:copy',
		'font:dist',
		function() {
			done();
		}
	);
});

gulp.task('font:copy', function(done) {
	pump([
		gulp.src([
			getFilePath('summernote', 'font/summernote.eot'),
			getFilePath('summernote', 'font/summernote.ttf'),
			getFilePath('summernote', 'font/summernote.woff')
		]),
		gulp.dest('src/css/font')
	], done);
});

gulp.task('font:dist', function(done) {
	pump([
		gulp.src([
			'./src/font/summernote.eot',
			'./src/font/summernote.ttf',
			'./src/font/summernote.woff'
		]),
		gulp.dest('dist/css/font')
	]);
});

// Helper Functions
//
function getModulePath(moduleName) {
	var normalizeEntryPoint = require.resolve(moduleName);
	var normalizeDir = path.dirname(normalizeEntryPoint);
	return normalizeDir;
}

function getFilePath(moduleName, filePath) {
	filePath || (filePath = '');
	var modulePath = getModulePath(moduleName);
	return modulePath+filePath;
}
