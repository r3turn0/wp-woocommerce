<?php get_header();?>
    <?php woocommerce_breadcrumb(); ?>
    <h1>Search Results for: <span>"<?php echo get_search_query(); ?>"</span></h1>
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <?php the_content();?>
    <?php endwhile; endif;?>
<?php get_footer();?>