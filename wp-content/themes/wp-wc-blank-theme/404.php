<?php get_header();?>
<?php woocommerce_breadcrumb(); ?>
<?php $home = home_url( '/' ); ?>
    <h1>404</h1>
    <a class="slink" title="Back to Home" href="<?php echo esc_url($home); ?>" rel="home">Back to Home</a>
<?php dynamic_sidebar('sidebar-widget');?>    
<?php get_footer();?>