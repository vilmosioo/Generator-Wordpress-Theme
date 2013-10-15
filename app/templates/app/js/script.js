'use strict';

/*
* on document load script 
*/
jQuery(document).ready(function() {

});

/*
* Basic JS module pattern
*/
var APP = (function (app, $) {

	app.init = function(){
		var i = 0;
		console.log(i);
		// add some code
	}

	// add more code here

	return app;
}(APP || {}, jQuery));

jQuery(document).ready(APP.init);