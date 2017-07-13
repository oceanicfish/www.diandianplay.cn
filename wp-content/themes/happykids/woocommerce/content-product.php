<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>
	<div class="sale-wrapper"><?php woocommerce_show_product_loop_sale_flash(); ?></div>
	<div class="content-wrapper">
		<figure>
			<?php $is_lightbox_off = ( isset($gen_sets['_woo_lightbox_disabled']) ) ? $gen_sets['_woo_lightbox_disabled'] : false; 
				if ($is_lightbox_off) :?>
					<a href="<?php the_permalink(); ?>" class="kids_picture" title="<?php the_title(); ?>">
				<?php else : ?>	
					<a href="<?php echo( wp_get_attachment_url( get_post_thumbnail_id() )); ?>" data-rel="prettyPhoto" class="prettyPhoto kids_picture" title="<?php echo(esc_attr( get_the_title( get_post_thumbnail_id() ) ) ); ?>">	
				<?php endif; ?>	
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			woocommerce_template_loop_product_thumbnail()
		?></a>
		</figure>
	</div>

		<a href="<?php the_permalink(); ?>"><div class="title"><?php the_title(); ?></div></a>
	<?php
	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
