<!-- For Single Products -->
<?php get_header();?>
    <?php woocommerce_breadcrumb(); ?>
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <?php 
        global $product;
        if ( $product->is_type( 'variable' ) ) {
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_simple_add_to_cart', 35 );
            add_action( 'woocommerce_single_product_summary', 'woocommerce_variable_add_to_cart', 35 );
            add_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
            add_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
        }
    ?>
    <?php the_content();?>
    <?php endwhile; endif;?>
<?php dynamic_sidebar('sidebar-widget');?>
<?php get_footer();?>