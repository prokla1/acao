$(document).ready(function(){
    //Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
    Galleria.run('#fotos', {
        transition: 'fade',
        autoplay: 3000,
        imageCrop: false,
    });
});