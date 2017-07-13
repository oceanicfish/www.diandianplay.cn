<?php 
/**
 * Index template
 *
 * @package WordPress
 * @subpackage HappyKids
 * @since HappyKids 3.0
 */
	get_header(); 
	$gen_sets = theme_get_option('general', 'gen_sets');
	$show_slider = isset($gen_sets['_what_slider_select']) ? $gen_sets['_what_slider_select'] : 'none';
	$slogan_sidebar = isset($gen_sets['slogan-area']) ? $gen_sets['slogan-area'] : '';
	$benefits_sidebar = isset($gen_sets['benefits-area']) ? $gen_sets['benefits-area'] : '';
?>
	<div class="bg-level-2-page-width-container ">
		<div class="bg-level-2 first-part" id="bg-level-2"></div>
		<div class="l-page-width">
			<?php
				if ($show_slider == 'none'){
					echo '<div class="theme_without_slider"></div>';
				}else {
					get_template_part('slider');
				}
			?>
		</div><!-- .l-page-width -->
		<div class="bg-level-2 second-part" id="bg-level-2"></div>
	</div>
</div><!-- .bg-level-1 -->
	<div id="kids_middle_container"><!-- .content -->
		<div class="kids_top_content">
			<div class="kids_top_content_middle homepage">
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
			</div><!-- .kids_top_content_middle -->
		</div>
		
		<div class="bg-level-2-full-width-container kids_bottom_content">
			<div class="bg-level-2-page-width-container no-padding">
				<div class="kids_bottom_content_container">
					<!-- ***************** - START Image floating - *************** -->
					<div class="page-content">
						<div class="container l-page-width">
							<?php
								get_template_part('blog');
							?>
						</div>
					</div>
					<!-- ***************** - END Image floating - *************** -->	
				</div><!-- .bottom_content_container -->				
			</div>
			<div class="content_bottom_bg"></div>
		</div>
	</div><!-- .end_content -->
	
<?php get_footer(); ?>
