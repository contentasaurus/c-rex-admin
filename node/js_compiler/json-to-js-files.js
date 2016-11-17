
//
// JSON-TO-JS-FILES
//

const fs = require('fs-extra');
const path = require('path');

function JsonToJsFiles(rootPath, json, done) {
	this.init = () => {
		this.rootPath = rootPath;
		this.json = json;

		fs.emptyDir(this.rootPath, this.onMkdir);
	};

	this.onMkdir = (err) => {
		if(err) {
			done(err);
			return;
		}

		this.processModules();
	};

	this.processModules = () => {
		var modules = this.json;
		var keys = Object.keys(modules);
		var writeCount = 0;
		
		keys.forEach( (key) => {
			fs.writeFile(this.rootPath+'/'+key+'.js', modules[key], function(err) {
				writeCount++;

				if(writeCount == keys.length) {
					done(err, {
						'writeCount' : writeCount
					});
				}
			});
		});
	};

	this.init();
}

module.exports = JsonToJsFiles;
