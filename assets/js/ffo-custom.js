var librelight = new FontFaceObserver("Libre Franklin", {
    weight: 300,
});

var libre = new FontFaceObserver("Libre Franklin", {
    weight: 400,
});

var libreitalic = new FontFaceObserver("Libre Franklin", {
    weight: 400,
    style: 'italic',
});

var librebold = new FontFaceObserver("Libre Franklin", {
    weight: 600,
});

var libreextrabold = new FontFaceObserver("Libre Franklin", {
    weight: 800,
});

Promise.all([
        librelight.load(),
        libre.load(),
        libreitalic.load(),
        librebold.load(),
        libreextrabold.load()
    ]).then(function () {
    document.documentElement.className += " webfonts-loaded";
}, function () {
    console.log('Web Font is not available after waiting 3 seconds');
});
