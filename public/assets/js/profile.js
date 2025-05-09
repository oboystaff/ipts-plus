(function () {
    "use strict"

    var textPresetVal = new Choices('#choices-text-preset-values', {
        allowHTML: true,
    });

    var lightboxVideo = GLightbox({
        selector: '.glightbox'
    });
    lightboxVideo.on('slide_changed', ({ prev, current }) => {
        console.log('Prev slide', prev);
        console.log('Current slide', current);

        const { slideIndex, slideNode, slideConfig, player } = current;
    });

})();