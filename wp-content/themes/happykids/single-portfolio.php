<?php
/**
 * Single post
 *
 * @package WordPress
 * @subpackage HappyKids
 * @since HappyKids 3.0
 */

	get_header(); 
	$gen_sets = theme_get_option('general', 'gen_sets');
	$gen_side_r = ( isset($gen_sets['_sidebar_portf_r']) ) ? $gen_sets['_sidebar_portf_r'] : false;
	$gen_side_l = ( isset($gen_sets['_sidebar_portf_l']) ) ? $gen_sets['_sidebar_portf_l'] : false;
	$default_page_template = ( isset($gen_sets['_gen_portf_select']) ) ? $gen_sets['_gen_portf_select'] : 'sb_none';
	$show_slider = isset($gen_sets['_gen_slider_select']) ? $gen_sets['_gen_slider_select'] : '';
	$slogan_sidebar = isset($gen_sets['slogan-area']) ? $gen_sets['slogan-area'] : '';
	$benefits_sidebar = isset($gen_sets['benefits-area']) ? $gen_sets['benefits-area'] : '';

	$page_custom = theme_get_post_custom();
	$page_crumbs = ( isset($gen_sets['_gen_breadcrumbs']) ) ? $gen_sets['_gen_breadcrumbs'] : 'show';
	$disable_lightbox = ( isset($page_custom['_disable_portf_item_lightbox']) ) ? $page_custom['_disable_portf_item_lightbox'] : '';
							
	$video = ( isset($page_custom['_port_popup_link']) ) ? $page_custom['_port_popup_link'] : '';	

	$img_width = 1150;
	switch ($default_page_template) {
		case 'sb_right':
		case 'sb_left':
			$page_style = "single-sidebar";
			$img_width = $img_width - 300;
			break;
		case 'sb_double':
			$page_style = "double-sidebar";
			$img_width = $img_width - 600;
			break;
		default:
			$page_style = "";
			break;
	};
	$f_portf_img_settings = array( 'width' => $img_width, 'crop' => true );
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
						<?php if (!is_front_page()) echo '<h1>' . get_the_title() . '</h1>';
							if ($page_crumbs == 'show'){ ?>
								<ul id="breadcrumbs">									
									<?php theme_breadcrumbs(); ?>
								</ul>
							<?php } ?>
					</div>
				</div>
			<?php endif; ?>
		</div><!-- .kids_top_content_middle -->
	</div>
		
	<div class="bg-level-2-full-width-container kids_bottom_content">
			<div class="bg-level-2-page-width-container no-padding">
				<div class="kids_bottom_content_container">
					<!-- ***************** - START Image floating - *************** -->
					<div class="page-content">
						<div class="bg-level-2 first-part"></div>
						<div class="container l-page-width">
							<div class="entry-container <?php echo($page_style); ?>">
								<?php if(($default_page_template == 'sb_double' || $default_page_template == 'sb_left') && function_exists('dynamic_sidebar') && $gen_side_l) {
										echo ('<aside id="sidebar-left">');
										dynamic_sidebar($gen_side_l);
										echo ("</aside>");
									};
								?>
								<main class="portfolio">
									<div class="post-item">
										<?php the_category(', '); ?>
									<!-- <div class="post-item"> -->

										<?php if(have_posts()) :  while(have_posts()) : the_post(); ?>

										<?php
											$f_image_id = get_post_thumbnail_id(get_the_id());
											$image = wp_get_attachment_image_src($f_image_id, 'full', true);											
										?>

										<div class="post-entry">

											<div>

											<div class="content-wrapper">
												<figure>
													<?php 
													$cws_img_width = cws_get_img_width($image[0]);
													$post_img = ($cws_img_width < $img_width ) ? $cws_img_width : null;
													if (!($disable_lightbox || $post_img)) : ?>
														<a title="<?php the_title(); ?>" data-rel="prettyPhoto" class="prettyPhoto <?php if ($video) { echo ("pfVideo");} ?> kids_picture" href="<?php if ($video) {echo esc_url($video);} else { echo esc_url($image[0]); } ?>">
													<?php endif; ?>

													<?php

													if (empty($f_image_id) || $post_img) {
														$thumb_path_hdpi = "src='". esc_url( $image[0] ) . "' data-no-retina";
													} else {
														$thumb_obj = bfi_thumb( $image[0], $f_portf_img_settings, false );
														$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
													}

													?>

													<img class="pic" <?php echo( $thumb_path_hdpi ); ?> alt="<?php echo (get_post_meta($f_image_id, '_wp_attachment_image_alt', true)); ?>" />
													
													<?php if (!($disable_lightbox || $post_img)) : ?>
														</a>
													<?php endif; ?>
												</figure>
											</div><!--/ post-thumb-->

											<div class="entry">
												<?php the_content(); ?>
											</div><!--/ entry--> 
											</div>

										</div><!--/ post-entry -->

										<div class="clearfix"></div><!--/ post-footer-->

									<?php endwhile; endif; ?>

									<!-- </div> -->										
									</div>
									<?php comments_template(); ?>	
								</main>
								<?php if(($default_page_template == 'sb_double' || $default_page_template == 'sb_right') && function_exists('dynamic_sidebar') && $gen_side_r) {
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
	
<?php get_footer(); ?>