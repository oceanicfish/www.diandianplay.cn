<?php 
/**
 * Archive template
 *
 * @package WordPress
 * @subpackage HappyKids
 * @since HappyKids 3.0
 */
	get_header(); 
	$gen_sets = theme_get_option('general', 'gen_sets');
	$gen_crumbs = ( isset($gen_sets['_gen_breadcrumbs']) ) ? $gen_sets['_gen_breadcrumbs'] : 'show';
	$show_slider = isset($gen_sets['_gen_slider_select']) ? $gen_sets['_gen_slider_select'] : '';
	$slogan_sidebar = isset($gen_sets['slogan-area']) ? $gen_sets['slogan-area'] : '';
	$benefits_sidebar = isset($gen_sets['benefits-area']) ? $gen_sets['benefits-area'] : '';

	$page_custom = theme_get_post_custom();
	$page_crumbs = ( isset($page_custom['_breadcrumbs']) ) ? $page_custom['_breadcrumbs'] : $gen_crumbs;

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
				<?php 
				$hide_crumbs = false;
				if (($page_crumbs == 'empty' && $gen_crumbs == 'hide') || ( $page_crumbs == 'hide')){
					$hide_crumbs = true;
				} ?>
				<div class="header_container <?php if ($hide_crumbs) echo ('nocrumbs') ?>">
					<div class="l-page-width">
						<?php 	if (!is_front_page()) echo '<h1>' . get_the_archive_title() . '</h1>';
								if (!$hide_crumbs){ ?>
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
						<?php if (!is_front_page()) echo '<div class="bg-level-2 first-part"></div>'; ?>
						<div class="container l-page-width">
							<?php
								if ( 'portfolio' == get_post_type() ){
									get_template_part('portfolio');
								} else { 
									get_template_part('blog');
								}
							?>
						</div>
						<?php if (!is_front_page()) echo '<div class="bg-level-2 second-part"></div>'; ?>
					</div>
					<!-- ***************** - END Image floating - *************** -->	
				</div><!-- .bottom_content_container -->				
			</div>
			<div class="content_bottom_bg"></div>
		</div>
	</div><!-- .end_content -->
	
<?php get_footer(); ?>