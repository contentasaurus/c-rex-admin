
//
// Node PHP Process
//

function NodePhpProcess(handler) {
	this.data = '';

	this.init = () => {
		if(handler) {
			this.handle = handler;
		}
		else {
			throw new Error('No handler defined');
		}

		process.stdin.on('data', this.onData);
		process.stdin.on('end', this.onEnd);
	};

	this.onData = (chunk) => {
		this.data += chunk;
	};

	this.onEnd = () => {
		this.data = JSON.parse(this.data);
		this.handle(this.data);
	};

	this.init();
}

module.exports = NodePhpProcess;
