(function($){

    /**
     * initializeBlock
     *
     * Custom JavaScript for Block: slider-logo.
     *
     *
     */
    var initializeBlock = function( $block ) {
        const swiper = new Swiper('.swiper-slider-logos', {
            loop: false,
            speed: 600,
            slidesPerView: 2,
            spaceBetween: 20,
            lazy: false,
            watchOverflow: true,
            autoHeight: false,
            autoplay: {
                delay: 2000,
            },
            breakpoints: {
                // when window width is >= 992px
                768: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 5,
                },
            }
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.swiper-slider-logos').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=slider-logo', initializeBlock );
    }

})(jQuery);