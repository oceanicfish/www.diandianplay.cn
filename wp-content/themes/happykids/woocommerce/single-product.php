<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	get_header(); 
	$gen_sets = theme_get_option('general', 'gen_sets');
	$gen_side_r = ( isset($gen_sets['_sidebar_main_woo_r']) ) ? $gen_sets['_sidebar_main_woo_r'] : false;
	$gen_side_l = ( isset($gen_sets['_sidebar_main_woo_l']) ) ? $gen_sets['_sidebar_main_woo_l'] : false;
	$woo_template = ( isset($gen_sets['_gen_woo_template_select']) ) ? $gen_sets['_gen_woo_template_select'] : '';

	$show_slider = isset($gen_sets['_gen_slider_select']) ? $gen_sets['_gen_slider_select'] : '';
	$slogan_sidebar = isset($gen_sets['slogan-area']) ? $gen_sets['slogan-area'] : '';
	$benefits_sidebar = isset($gen_sets['benefits-area']) ? $gen_sets['benefits-area'] : '';


	$page_custom = theme_get_post_custom();
	$page_crumbs = ( isset($gen_sets['_gen_breadcrumbs']) ) ? $gen_sets['_gen_breadcrumbs'] : 'show';

	switch ($woo_template) {
		case 'sb_right':
		case 'sb_left':
			$woo_style = "single-sidebar";
			break;
		case 'sb_double':
			$woo_style = "double-sidebar";
			break;
		default:
			$woo_style = "";
			break;
	};
?>
	<?php if (is_front_page()) : ?>
		
		<div class="bg-level-2-page-width-container ">
			<div class="bg-level-2 first-part" id="bg-level-2"></div>
			<div class="l-page-width">
				<?php 
					if ($show_slider){
						get_template_part('slider');
					}else {
						echo '<div class="theme_without_slider"></div>';
					}
				?>
			</div><!-- .l-page-width -->
			<div class="bg-level-2 second-part" id="bg-level-2"></div>
		</div>
	<?php endif; ?>

</div><!-- .bg-level-1 -->
	<div id="kids_middle_container"><!-- .content -->
		<div class="kids_top_content">
			<div class="kids_top_content_middle <?php if (is_front_page()) echo 'homepage'; ?>">
			<?php if (is_front_page()) : ?>
				<div class="l-page-width">
				<?php 
				if ( function_exists('dynamic_sidebar') &&  is_active_sidebar($slogan_sidebar)){
					echo '<div class="slogan">';
					dynamic_sidebar($slogan_sidebar);
					echo '</div>';

				} ?>
				<section class="kids_posts_container clearfix">
				<?php 
				if ( function_exists('dynamic_sidebar') &&  is_active_sidebar($benefits_sidebar)){
					echo '<div class="widget_wrapper">';
					dynamic_sidebar($benefits_sidebar);
					echo '</div>';
				}
				?>
				</section>
				</div>
				<div class="bottom-border"></div>
			<?php else: ?>
				<div class="header_container <?php if ($page_crumbs == 'hide') echo ('nocrumbs') ?>">
					<div class="l-page-width">
						<?php if (!is_front_page()) : ?> 
								<h1> <?php woocommerce_page_title(); ?> </h1> 
						<?php endif; ?>
						<?php 
							if ($page_crumbs == 'show'){ ?>
								<ul id="breadcrumbs">									
									<?php do_action('woo_custom_breadcrumb'); ?>
								</ul>
							<?php } ?>
					</div>
				</div>
			<?php endif; ?>
		</div><!-- .kids_top_content_middle -->
	</div>
		
	<div class="bg-level-2-full-width-container kids_bottom_content">
			<div class="bg-level-2-page-width-container no-padding">
				<!-- ***************** - START WooCommerce integration - *************** -->	
				<div class="kids_bottom_content_container">
					<div class="page-content">
						<div class="bg-level-2 first-part"></div>
						<div class="container l-page-width">
						
							<div class="entry-container <?php echo($woo_style); ?>">
								<?php if(($woo_template == 'sb_double' || $woo_template == 'sb_left') && function_exists('dynamic_sidebar') && $gen_side_l) {
										echo ('<aside id="sidebar-left">');
										dynamic_sidebar($gen_side_l);
										echo ("</aside>");
									};
								?>
							<main class="shop">
							<?php
								/**
								 * woocommerce_before_main_content hook
								 *
								 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
								 * @hooked woocommerce_breadcrumb - 20
								 */
								remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
								do_action('woocommerce_before_main_content');
							?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php
								/**
								 * woocommerce_after_main_content hook
								 *
								 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
								 */
								do_action('woocommerce_after_main_content');
							?>


							</main>

								<?php if(($woo_template == 'sb_double' || $woo_template == 'sb_right') && function_exists('dynamic_sidebar') && $gen_side_r) {
										echo ('<aside id="sidebar-right">');
										dynamic_sidebar($gen_side_r);
										echo ("</aside>");
									};
								?>
								<div class="kids_clear"></div>
							</div><!-- .entry-container -->
						</div>
						<div class="bg-level-2 second-part"></div>
					</div>
					<!-- ***************** - END Image floating - *************** -->	
				</div><!-- .bottom_content_container -->				
			</div>
			<div class="content_bottom_bg"></div>
		</div>
	</div><!-- .end_content -->
	
	
<?php get_footer('shop'); ?>