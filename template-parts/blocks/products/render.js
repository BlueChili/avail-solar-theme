(function($){

    /**
     * initializeBlock
     *
     * Custom JavaScript for Block: products.
     *
     *
     */
    var initializeBlock = function( $block ) {
        $('.cat-list_item').on('click', function() {
            $('.cat-list_item').removeClass('active');
            $(this).addClass('active');
          
            $.ajax({
              type: 'POST',
              url: '/wp-admin/admin-ajax.php',
              dataType: 'html',
              data: {
                action: 'filter_products',
                term_id: $(this).data('id'),
              },
              beforeSend:function(xhr){
                $('#result').addClass('loading');
              },
              success: function(res) {
                $('#result').html(res);
                $('#result').removeClass('loading');
              }
            })
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.gp-products').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=products', initializeBlock );
    }

})(jQuery);