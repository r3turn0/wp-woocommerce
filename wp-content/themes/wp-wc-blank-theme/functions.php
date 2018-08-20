<?php 
// Start functions.php

/* -------------- NAVWALKER CLASS -------------- */
require_once get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php';

add_action( 'after_setup_theme', 'SITENAME_setup' );
function SITENAME_setup() {
	load_theme_textdomain( 'SITENAME', get_template_directory() . '/languages' );

	// Enable if you prefer RSS feeds instead of email list based subscriptions
	//add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 840, 0 );
	add_image_size( 'landscape', 560, 420, true );
	add_image_size( 'portrait', 480, 640, true );
	add_image_size( 'square', 480, 480, true );

	global $content_width;

	if ( ! isset( $content_width ) ) $content_width = 640;
		register_nav_menus(
		array( 'main_menu' => __( 'Main Menu', 'SITENAME navigation' ) )
	);
}

/* -------------- QUEUE SCRIPTS -------------- */
add_action( 'wp_enqueue_scripts', 'SITENAME_load_scripts' );
function SITENAME_load_scripts()
{
	/* ------------ CSS ------------ */
	//wp_enqueue_style( 'font', '//fonts.googleapis.com/css?family=Titillium Web:300,400|Fira Sans:400,600');
	wp_enqueue_style( 'fontawesome-css',  get_template_directory_uri() . '/css/fontawesome/css/fontawesome-all.min.css');
	wp_enqueue_style( 'bootstrap-css',  get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css');
	wp_enqueue_style( 'owl-css',  get_template_directory_uri() . '/css/owl/owl.carousel.min.css');
	wp_enqueue_style( 'owl-theme-css',  get_template_directory_uri() . '/css/owl/owl.theme.default.min.css');
	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	wp_enqueue_style( 'SITENAME-css',  get_template_directory_uri() . '/css/SITENAME.css');

	/* ------------ SCRIPTS -------------- */
	// Queue site script after loading array dependencies in Wordpress CORE. List of Built in pacakages can be found here:
	// https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	wp_enqueue_script('bluebird-js', '//cdnjs.cloudflare.com/ajax/libs/bluebird/3.5.1/bluebird.min.js');
	wp_enqueue_script('polyfill-js', '//cdn.polyfill.io/v2/polyfill.min.js');
	wp_enqueue_script( 'popper-js', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery', 'jquery-ui-dialog'));
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() .'/js/bootstrap/bootstrap.min.js', array('popper-js'));
	wp_enqueue_script('owl-js', get_template_directory_uri() .'/js/owl/owl.carousel.min.js', array('bootstrap-js'));
	wp_enqueue_script('cookie-js', get_template_directory_uri() .'/js/cookie.min.js', array('owl-js'));
	wp_enqueue_script('SITENAME-js', get_template_directory_uri() .'/js/SITENAME.js', array('jquery', 'jquery-ui-core'));
}

add_action( 'widgets_init', 'SITENAME_widgets_init' );
function SITENAME_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar Widget', 'SITENAME' ),
		'id' => 'sidebar-widget',
		'before_widget' => '<div class="widget-container">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

/* ------------- COMMENTS ------------ */
add_action( 'comment_form_before', 'SITENAME_enqueue_comment_reply_script' );
function SITENAME_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

function SITENAME_custom_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}

add_filter( 'get_comments_number', 'SITENAME_comments_number' );
function SITENAME_comments_number( $count ) {
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

/* ------------- Show all categories ------------ */
add_filter( 'widget_categories_args', 'wpb_force_empty_cats' );
function wpb_force_empty_cats($cat_args) {
    $cat_args['hide_empty'] = 0;
    return $cat_args;
}

/* ------------ HEADER IMAGE ------------ */
function header_img_setup() {
	$defaults = array(
		'height' => 'auto',
        'width'  => 'auto',
		'flex-width'    => true,
		'flex-height'   => true,
	);
	add_theme_support( 'custom-header', $defaults );
}
add_action( 'after_setup_theme', 'header_img_setup' );

/* ------------ LOGO ------------ */
function logo_setup() {
    $defaults = array(
        'height'      => 'auto',
        'width'       => 'auto',
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'logo_setup' );

/* ------------ WooCommerce ------------ */
// REMOVE ALL HOOKS FIRST
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 15 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 25 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
remove_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10 );
// REARRANGE HOOKS
add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_simple_add_to_cart', 35 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 45 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
add_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 15 );
add_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 20 );
add_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 30 );

// End functions.php 
?>