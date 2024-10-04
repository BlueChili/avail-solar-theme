<div class="col d-flex">
    <div class="card p-4 p-lg-5 product" data-aos="fade-up" data-aos-duration="1000">
        <?php
        $product_id = get_the_ID();
        $product_image = get_field( 'product_image', $product_id );
        if ( $product_image ) {
            echo avasol_generate_image_size( $product_image, '500', '500', 'center', 'img-fluid mb-4', false );
        }; ?>
        <?php if ( $product_manufacturer = get_field( 'product_manufacturer', $product_id ) ) : ?>
            <div class="product--manufacturer mb-1"><?= $product_manufacturer; ?></div>
        <?php endif; ?>
        <div class="h6 mb-0"><?= get_the_title(); ?></div>
    </div>
</div>