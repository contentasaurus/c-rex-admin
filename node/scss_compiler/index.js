
//
// SCSS Compiler
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

var 
	Promise = require('bluebird'),
	fs = require('fs-extra'),
	sass = require('node-sass'),
	postcss = require('postcss'),
	cssnano = require('cssnano'),
	autoprefixer = require('autoprefixer'),
	NodePhpProcess = require('node-php-process'),
	jsonToFiles = require('./json-to-scss-files'),

	cleaner = postcss([ autoprefixer({ 
		add: false, 
		browsers: [
			'last 2 versions',
			'iOS 8',
			'IE 10',
			'IE 11'
		] }) 
	]),
	prefixer = postcss([ autoprefixer ]),
	minifier = postcss([ cssnano ]),
	defaults = {
		compiler_path : '.',
		compile_folder : 'temp',
		init_script_name : 'init_script__'
	},
	options = defaults,
	full_script_path = '',
	compile_folder = '',
	output_path = '',
	prefixed,
	minified
;

var nodePhpProcessInst = new NodePhpProcess(onProcessHandle);

function onProcessHandle(err, data) {
	addError(err);
	addMessage('beginning process');

	options = Object.assign(options, data.options);

	var 
		compiler_path = options.compiler_path,
		compile_folder = options.compile_folder,
		init_script_name = options.init_script_name,
		output_path_root = options.output_path,
		filename = options.filename
	;

	compile_folder = `${compiler_path}/scss_compiler/${compile_folder}`;
	full_script_path =`${compile_folder}/${init_script_name}.scss`;
	output_path = `${output_path_root}/${filename}.css`;
	output_min_path = `${output_path_root}/${filename}.min.css`;
	
	jsonToFiles(compile_folder, data.modules, onJsonToFilesDone);
}

function onJsonToFilesDone(err, data) {
	addError(err);
	addMessage('directories outputted');

	sass.render({
		file: full_script_path
	}, onSassRenderDone);
};

function onSassRenderDone(err, result) {
	addError(err);
	addMessage('sass compiled');

	cleaner
		.process(result.css)
		.then(function (cleaned) {
			addMessage('css cleaned');
			return prefixer.process(cleaned.css);
		})
		.then(function (result) {
			addMessage('css prefixed');
			prefixed = result;
			return result;
		})
		.then(function(result) {
			addMessage(`output: unminified css to ${output_path}`);
			return outputFile(output_path, prefixed);
		})
		.then(function(result) {
			return new Promise(function(resolve, reject) {
				try {	
					minifier
						.process(prefixed, {
							from: output_path,
							to: output_min_path
						})
						.then(function(result){
							addMessage(`output: minified css to ${output_min_path}`);
							resolve(result);
						})
					;
				}
				catch(err) {
					addError(err);
					reject(err);
				}
			});
		})
		.then(function(minified) {
			return outputFile(output_min_path, minified);
		})
		.then(function() {
			addMessage('scss compilation complete');
			respond();
		})
		.catch(function(err) {
			addError(err);
			respond();
		})
	;
}

function outputFile(file, contents) {
	return new Promise(function(resolve, reject) {
		fs.outputFile(file, contents, function(err) {
			if(err) {
				reject(err);
			}
			else {
				resolve();
			}
		});
	});
}
