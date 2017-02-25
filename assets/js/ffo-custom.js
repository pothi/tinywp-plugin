var tinyfontA = new FontFaceObserver("Libre Franklin");

Promise.all([tinyfontA.load(null, 15000)]).then(function () {
	document.documentElement.className += " webfonts-loaded";
}, function () {
	console.info("Web font could not be loaded in time. Falling back to system fonts.");
});
