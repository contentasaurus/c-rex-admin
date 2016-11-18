(function(uuid){function Confetti() {
	this.selectors = {
		'button' : 'button',
		'img' : 'img'
	};

	this.config = {
		wrapper_class : '',
		img_url: ''
	};

	this.init = function() {
		this.log('Initializing');
		this.on('click', 'button', this.onButtonClick);
	};

	this.onButtonClick = function(e) {
		this.log('onButtonClick');
		this.select('img').toggle();
	};
}

module.exports = Component(Confetti, [
	Events,
	Log
]);})("cd0291c67-9c7b-11e6-9506-04019a288d01");