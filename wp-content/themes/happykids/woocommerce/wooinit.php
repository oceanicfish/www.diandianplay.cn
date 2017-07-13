<?php 


//Declare Woo Support
	add_theme_support('woocommerce');	
	
// Display n products per page. 
	
	$gen_sets = theme_get_option('general', 'gen_sets');
	$gen_items_per_page = ( isset($gen_sets['_gen_woo_ipp']) ) ? $gen_sets['_gen_woo_ipp'] : 9;
	$items_per_page = 'return ' . $gen_items_per_page . ';';
	add_filter( 'loop_shop_per_page', create_function( '$cols', $items_per_page ), 20 );
	
//disable woocomerece stylesheets
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );	

//declare woocomerece custom theme stylesheets
function wp_enqueue_woocommerce_style(){
    wp_register_style( 'woocommerce', get_template_directory_uri() . '/woocommerce/css/woocommerce.css', array('styles') );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'woocommerce' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );
	
// Change the breadcrumb delimiter from '/' to '>'
	add_filter( 'woocommerce_breadcrumb_defaults', 'my_change_breadcrumb_delimiter' );
	function my_change_breadcrumb_delimiter( $defaults ) {
		$defaults['delimiter'] = ' > ';
		return $defaults;
	}
	
//Reposition WooCommerce breadcrumb 
	function woocommerce_remove_breadcrumb(){
	remove_action( 
		'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	}
	add_action(
		'woocommerce_before_main_content', 'woocommerce_remove_breadcrumb'
	);

	function woocommerce_custom_breadcrumb(){
		woocommerce_breadcrumb();
	}
	add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );	
	
//Remove Page tile from the Archive 

	function override_page_title() {
		return false;
	}
	add_filter('woocommerce_show_page_title', 'override_page_title');

	
// Hook in on activation
	add_action( 'activate_woocommerce/woocommerce.php', 'happykids_woocommerce_image_dimensions', 10 );
	add_action( 'after_switch_theme', 'happykids_woocommerce_image_dimensions');

// Remove closing a from product buttons
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

//Define image sizes
	function happykids_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '250',	// px
		'height'	=> '250',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
}
define( 'TINVWL_PARTNER', 'creaws' ); //Add referral arg to all admin links.
define( 'TINVWL_CAMPAIGN', 'happykids' ); //Add utm_campaign arg to all admin links. Optional.	

?>