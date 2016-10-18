
//
//
//

const browserify = require('browserify');
const NpmPhpProcess = require('node-php-process');
const jsonToFiles = require('./json-to-js-files');

const defaults = [
	compile_path : './',
	compile_folder : 'compile_scripts',
	init_script_name : '__init_script__.js'
];
var options = defaults;
var full_script_path = '';


var npmNodeProcess = new NpmPhpProcess(onProcessHandle);

function onProcessHandle(data) {
	Object.assign(data.options, defaults);
	full_script_path ='${options.compile_path}/${options.compile_folder}/${options.init_script_name}';
	jsonToFiles(full_script_path, data.modules, onJsonToFilesDone);
}

function onJsonToFilesDone() {
	var options = {
		paths:  [
			'node_modules', 
			options.compile_folder
		]
	};

	browserify(options)
		.add(full_script_path)
		.bundle()
		.pipe(process.stdout);
};
