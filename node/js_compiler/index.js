
//
// JS Compiler
//

var response = {
	'errors' : [],
	'messages' : []
};

function respond() {
	process.stdout.write(JSON.stringify(response));
}

function addMessage(msg) {
	response.messages.push(msg);
}

function addError(err) {
	if(err) response.errors.push(err);
}

// ====

addMessage('started');

var
	// Promise = require('bluebird'),
	fs = require('fs-extra'),
	uglify = require('uglify-js'),
	browserify = require('browserify'),
	jsonToFiles = require('./json-to-js-files'),
	NodePhpProcess = require('node-php-process'),
	webpack = require('webpack')
;
addMessage('packages loaded');

var 
	defaults = {
		compiler_path : '.',
		init_script_name : 'init_script__'
	}, 
	options = defaults,
	entryFile = '',
	modulesPath = '',
	outputPath = '',
	outputFilename = '',

	compiler_path = '',
	output_path = '',
	filename = '',
	init_script_name = ''
;
addMessage('variables defined');

var nodePhpProcess = new NodePhpProcess(onProcessHandle);

function onProcessHandle(err, data) {
	addError(err);
	addMessage('onProcessHandle');

	options = Object.assign(options, data.options);

	compiler_path = options.compiler_path;
	output_path = options.output_path;
	filename = options.filename;
	init_script_name = options.init_script_name;

	modulesPath = `${compiler_path}/js_compiler/temp-${filename}`;
	outputPath = `${output_path}`;
	entryFile = `${init_script_name}`;
	outputFilename = `${filename}.js`;

	addMessage('modulesPath: ' + modulesPath);
	addMessage('outputPath: ' + outputPath);
	addMessage('entryFile: ' + entryFile);
	addMessage('outputFilename: ' + outputFilename);

	jsonToFiles(modulesPath, data.modules, onJsonToFilesDone);
}

function onJsonToFilesDone(err, data) {
	addError(err);
	addMessage('onJsonToFilesDone');
	addMessage(`writeCount: ${data.writeCount}`);

	webpack({
		entry: entryFile,
		output: {
			path: outputPath,
			filename: outputFilename
		},
		resolve: {
			modulesDirectories: [
				modulesPath,
				'node_modules'
			]
		}
	}, onJsPack);
}

function onJsPack(err, stats) {
	addError(err);
	addMessage('pack completed');
	respond();
}
