<?php get_header();?>
    <?php woocommerce_breadcrumb(); ?>
    <?php $home = home_url( '/' ); ?>
    <?php woocommerce_breadcrumb(); ?>
    <h1>404</h1>
    <a class="slink" title="Back to Home" href="<?php echo esc_url($home); ?>" rel="home">Back to Home</a>
<?php get_footer();?>