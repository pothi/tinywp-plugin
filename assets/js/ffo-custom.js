var tinyfontA = new FontFaceObserver("Libre Franklin");

tinyfontA.load().then(function() {
    document.documentElement.className += " webfonts-loaded";
}, function() {
    console.log('Web Font is not available after waiting 3 seconds');
});
