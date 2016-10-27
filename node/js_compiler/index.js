
//
// JS Compiler
//

const browserify = require('browserify');
const NodePhpProcess = require('node-php-process');
const jsonToFiles = require('./json-to-js-files');

const defaults = {
	compile_path : '.',
	compile_folder : 'temp',
	init_script_name : 'init_script__'
};
var options = defaults;
var full_script_path = '';
var compile_folder = '';

var nodePhpProcess = new NodePhpProcess(onProcessHandle);

function onProcessHandle(data) {
	options = Object.assign(options, data.options);
	compile_folder = `${options.compile_path}/js_compiler/${options.compile_folder}`;
	full_script_path =`${compile_folder}/${options.init_script_name}`;
	jsonToFiles(compile_folder, data.modules, onJsonToFilesDone);
}

function onJsonToFilesDone() {
	var options = {
		paths:  [
			'node_modules', 
			compile_folder
		],
		noParse: [
			'jquery'
		]
	};

	browserify(options);
		.add(full_script_path);
		.bundle(function(err, done){
			console.log(err);
			done();
		})
		.pipe(process.stdout);
};
