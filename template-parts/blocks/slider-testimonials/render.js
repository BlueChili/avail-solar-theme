(function($){

    /**
     * initializeBlock
     *
     * Custom JavaScript for Block: slider-testimonials.
     *
     *
     */
    var initializeBlock = function( $block ) {
        const swiper = new Swiper('.swiper-slider-testimonials', {
            loop: true,
            speed: 600,
            slidesPerView: 1.1,
            spaceBetween: 20,
            lazy: false,
            watchOverflow: true,
            autoHeight: false,
            centeredSlides: true,
            breakpoints: {
                // when window width is >= 992px
                768: {
                    slidesPerView: 2.1,
                },
                1200: {
                    slidesPerView: 2.5,
                    spaceBetween: 40,
                },
            },
            navigation: {
                nextEl: ".testimonials-slider-button-next",
                prevEl: ".testimonials-slider-button-prev",
            },
            pagination: {
                el: ".swiper-testimonials-slider-pagination",
                clickable: true,
            },
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.swiper-slider-testimonials').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=slider-testimonials', initializeBlock );
    }

})(jQuery);