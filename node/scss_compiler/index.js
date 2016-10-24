
//
// SCSS Compiler
//

var sass = require('node-sass');
const postcss = require('postcss');
const autoprefixer = require('autoprefixer');
const NodePhpProcess = require('node-php-process');
const jsonToFiles = require('./json-to-scss-files');

const cleaner = postcss([ autoprefixer({ 
	add: false, 
	browsers: [
		'last 2 versions',
		'iOS 8'
	] }) 
]);
const prefixer = postcss([ autoprefixer ]);
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
	compile_folder = `${options.compile_path}/scss_compiler/${options.compile_folder}`;
	full_script_path =`${compile_folder}/${options.init_script_name}.scss`;

	jsonToFiles(compile_folder, data.modules, onJsonToFilesDone);
}

function onJsonToFilesDone() {
	var options = {
		paths:  [
			'node_modules', 
			compile_folder
		]
	};
	
	sass.render({
		file: full_script_path
	}, onSassRenderDone);
};

function onSassRenderDone(err, result) {
	if(!err) {
		cleaner
			.process(result.css)
			.then(function (cleaned) {
				return prefixer.process(cleaned.css);
			})
			.then(function (result) {
				process.stdout.write(result.css);
			});
	}
}
