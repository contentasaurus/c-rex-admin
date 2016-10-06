
//
// Gulpfile
//


var gulp = require('gulp');
var pump = require('pump');
var minify = require('gulp-minify');
var browserify = require('browserify');
var runSequence = require('run-sequence');
var source = require('vinyl-source-stream');


gulp.task('default', ['js']);

gulp.task('js', function(done) {
	runSequence(
		[
			'js:high-dom-admin',
			'js:low-dom-admin',
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
