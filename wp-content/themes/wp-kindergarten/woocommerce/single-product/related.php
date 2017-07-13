<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$posts_per_page = 5;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

ob_start();
$date = time() . '_' . uniqid(true);

wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', 'jquery', '1.0', TRUE);
wp_register_script('jm-bxslider', get_template_directory_uri() . '/js/jquery.jm-bxslider.js', 'jquery', '1.0', TRUE);
wp_enqueue_script('bxslider');
wp_enqueue_script('jm-bxslider');

$products = new WP_Query($args);

if ($products->have_posts()) :
    ?>
    <div id="cs_carousel_product<?php echo esc_attr($date); ?>" class="cs-shop-hover cs-carousel cs-carousel-product show-header show-nav clear cs-related">
        <div class="cs-header">
            <h3 class="cs-title"><span><?php _e('Related Items', 'woocommerce'); ?></span></h3>
        </div>
        <div class="cs-content-related-items">
            <div class="cs-carousel-list">
                <div id="cs_carousel_product_<?php echo esc_attr($date); ?>" data-moveslides="1" data-auto="true" data-prevselector="#cs_carousel_product<?php echo esc_attr($date); ?> .prev" data-nextselector="#cs_carousel_product<?php echo esc_attr($date); ?> .next" data-touchenabled="1" data-controls="true" data-pager="false" data-pause="10000" data-auto="false" data-infiniteloop="true" data-adaptiveheight="true" data-speed="500" data-autohover="true" data-slidemargin="20" data-maxslides="4" data-minslides="1" data-slidewidth="150" data-slideselector="" data-easing="swing" data-usecss="" data-resize="1" class="slider jm-bxslider">

                    <?php while ($products->have_posts()) : $products->the_post(); ?>
                        <?php
                        global $product, $woocommerce_loop;

                        // Store loop count we're currently on
                        if (empty($woocommerce_loop['loop']))
                            $woocommerce_loop['loop'] = 0;

                        // Store column count for displaying the grid
                        $woocommerce_loop['columns'] = $columns;

                        // Ensure visibility
                        if (!$product || !$product->is_visible())
                            return;

                        // Extra post classes
                        $classes = array();

                        $classes[] = 'cs-carousel-item-full';
                        ?>
                        <div <?php post_class($classes); ?>>

                            <?php do_action('woocommerce_before_shop_loop_item'); ?>
                            <div class="cshero-carousel-item-wrap">
                                <div class="cshero-carousel-item">
                                    <div class="cshero-woo-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            do_action('woocommerce_before_shop_loop_item_title');
                                            ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="cshero-woo-meta">
                                    <div class="cshero-product-title">
                                        <h3><?php the_title(); ?></h3>
                                    </div>
                                    <div class="cshero-product-price">
                                        <?php
                                        do_action('woocommerce_after_shop_loop_item_title');
                                        ?>
                                    </div>
                                    <div class="cshero-add-to-cart">
                                        <?php do_action( 'woocommerce_after_shop_loop_item' );   ?>
                                    </div>
                                    <div class="cshero-view-detail">
                                        <a class="btn view-detail" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span>View Detail</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; // end of the loop.   ?>
                </div>
            </div>
            <div class="cshero-nav  center">
                <ul>
                    <li class="prev"></li>
                    <li class="next"></li>
                </ul>
                <div class="cs-line"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
