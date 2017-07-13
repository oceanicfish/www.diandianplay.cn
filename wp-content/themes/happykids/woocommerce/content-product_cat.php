<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

 // Store column count for displaying the grid
$gen_sets = theme_get_option('general', 'gen_sets');
$gen_template = ( isset($gen_sets['_gen_woo_template_select']) ) ? $gen_sets['_gen_woo_template_select'] : 'right';
if ($gen_template == 'full'){
	 $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
} else {
	 $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
}

// Increase loop count
$woocommerce_loop['loop']++;
?>
<li <?php wc_product_cat_class( '', $category ); ?>>
	<div class="content-wrapper">
		<figure>

			<?php
			/**
			 * woocommerce_before_subcategory hook.
			 *
			 * @hooked woocommerce_template_loop_category_link_open - 10
			 */
			 do_action( 'woocommerce_before_subcategory', $category ); ?>

			<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" >
				<?php 
					/**
					 * woocommerce_before_subcategory_title hook
					 *
					 * @hooked woocommerce_subcategory_thumbnail - 10
					 */
					do_action( 'woocommerce_before_subcategory_title', $category );
				?>
			</a>
		</figure>
	</div>
			<div class="title">
				<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">			
				<?php
					echo $category->name;
					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
				?>
				</a>
			</div>
		<?php
			if($category->description) { ?> 
			<div class="cat-description">
				<?php echo ($category->description);  ?> 
			</div>	
			<?php }
		?>
	</a>

	<?php 
		/**
		 * woocommerce_after_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_close - 10
		 */
		do_action( 'woocommerce_after_subcategory', $category ); ?>
</li>
