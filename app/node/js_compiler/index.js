
//
//
//

const browserify = require('browserify');
const NpmPhpProcess = require('node-php-process');
const jsonToFiles = require('./json-to-js-files');

var npmNodeProcess = new NpmPhpProcess((data) => {
	jsonToFiles('./compile_scripts', data.modules, onJsonToFilesDone);
});

var onJsonToFilesDone = () => {
	var options = {
		paths:  [
			'node_modules', 
			'compile_scripts'
		]
	};

	browserify(options)
		.add('./compile_scripts/__init_script__.js')
		.bundle()
		.pipe(process.stdout);
};
