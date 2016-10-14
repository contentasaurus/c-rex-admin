
//
// JSON-TO-JS-FILES
//

const fs = require('fs-extra');
const path = require('path');

function JsonToJsFiles(rootPath, json, done) {
	this.init = () => {
		this.rootPath = rootPath;
		this.json = json;

		fs.stat(this.rootPath, this.onRootPathCheck);
	};

	this.onRootPathCheck = (err, stats) => {
		if(err) {
			fs.mkdir(this.rootPath, this.onMkdir);
			return;
		}

		if(stats.isDirectory()) {
			fs.remove(this.rootPath, () => {
				fs.mkdir(this.rootPath, this.onMkdir);
			});
		}
	};

	this.onMkdir = () => {
		this.processModules();
	};

	this.processModules = () => {
		var modules = this.json;
		var keys = Object.keys(modules);
		var writeCount = 0;

		keys.forEach( (key) => {
			fs.writeFile(this.rootPath+'/'+key+'.js', modules[key], (err) => {
				writeCount++;

				if(writeCount >= keys.length) {
					done();
				}
				
				if(err) {
					throw err;
					return;
				}
			});
		});
	};

	this.init();
}

module.exports = JsonToJsFiles;
