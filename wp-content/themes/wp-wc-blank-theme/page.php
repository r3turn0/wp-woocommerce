<!-- For Default Pages -->
<?php get_header();?>
    <?php woocommerce_breadcrumb(); ?>
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <?php the_content();?>
    <?php endwhile; endif;?>
<?php get_footer();?>