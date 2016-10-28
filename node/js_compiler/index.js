
//
// JS Compiler
//

const fs = require('fs-extra');
const uglify = require('uglify-js');
const browserify = require('browserify');

const jsonToFiles = require('./json-to-js-files');
const NodePhpProcess = require('node-php-process');

const defaults = {
	compile_path : '.',
	compile_folder : 'temp',
	init_script_name : 'init_script__'
};
var options = defaults;
var script_path = '';
var compile_folder = '';
var output_path = '';
var output_min_path = '';

var nodePhpProcess = new NodePhpProcess(onProcessHandle);

function onProcessHandle(data) {
	options = Object.assign(options, data.options);
	compile_folder = `${options.compile_path}/js_compiler/${options.compile_folder}-${options.filename}`;
	script_path =`${compile_folder}/${options.init_script_name}`;
	output_path = `${options.output_path}/${options.filename}.js`;
	output_min_path = `${options.output_path}/${options.filename}.min.js`;
	jsonToFiles(compile_folder, data.modules, onJsonToFilesDone);
}

function onJsonToFilesDone() {
	var opts = {
		paths : [
			'node_modules', 
			compile_folder
		]
	};

	fs.ensureFile(output_path, function(err){
		if(err) {
			console.log(err);
		}
		else {
			fs.ensureFile(output_min_path, function(err){
				if(err) {
					console.log(err);
				}
				else {
					var jsWriteStream = fs.createWriteStream(output_path);
					var onBundle = function(err, done){
						if(err){
							console.log(err);
						}
					};

					browserify(opts)
						.add(script_path)
						.bundle(onBundle)
						.pipe(jsWriteStream)
						.on('finish', function(){
							var result = uglify.minify(output_path);
							fs.writeFile(output_min_path, result.code, 'utf8');
						})
					;
				}
			});
		}
	});
};
