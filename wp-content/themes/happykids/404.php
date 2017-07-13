<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 3.0
 * @version     3.2.7
 */

get_header();
	$gen_sets = theme_get_option('general', 'gen_sets');
	$page_crumbs = ( isset($gen_sets['_gen_breadcrumbs']) ) ? $gen_sets['_gen_breadcrumbs'] : 'show';
	$gen_side_r = ( isset($gen_sets['_sidebar_404']) ) ? $gen_sets['_sidebar_404'] : false;

	if(function_exists('dynamic_sidebar') && $gen_side_r != "empty"){
		$blog_style = "single-sidebar";
	} else {
		$blog_style = "";
	}


?>

</div><!-- .bg-level-1 -->
	<div id="kids_middle_container"><!-- .content -->
		<div class="kids_top_content"> <!-- .middle_cloud -->
			<div class="kids_top_content_head">
				<div class="kids_top_content_head_body"></div>
			</div><!-- .kids_top_content_head -->

			<div class="kids_top_content_middle">
				<div class="header_container <?php if ($page_crumbs == 'hide') echo ('nocrumbs') ?>">
					<div class="l-page-width">
						<?php echo '<h1>404</h1>';
							if ($page_crumbs == 'show'){ ?>
								<ul id="breadcrumbs">									
									<?php theme_breadcrumbs(); ?>
								</ul>
							<?php } ?>
					</div>
				</div>
			</div><!-- .kids_top_content_middle -->
			<div class="kids_top_content_footer"></div><!-- .end_middle_cloud -->
		</div><!-- .end_middle_cloud  -->
		
	<div class="bg-level-2-full-width-container kids_bottom_content">
			<div class="bg-level-2-page-width-container no-padding">
				<div class="kids_bottom_content_container">
						<!-- ***************** - START Image floating - *************** -->
					<div class="page-content">

						<div class="bg-level-2 first-part"></div>

						<div class="container l-page-width">
							<div class="entry-container <?php echo($blog_style); ?>">
								<main>
									<div class="holder404">
										<div class="e404"><h1>404</h1>
											<div class="title_error">
												<span><?php __('Error', 'happykids'); ?></span>
												<div><?php multitranslate(__("page not found", 'happykids'), "_404_not_found"); ?></div>
											</div>
										</div>

										<div class="kids_clear"></div>
										<div class="description_error">
											<?php multitranslate(__("Unfortunately, this page is absent or unavailable", 'happykids'), "_404_unfortunately"); ?>. <br />
										</div>
									</div><!--/ 404-holder-->
								</main>
								<?php if(function_exists('dynamic_sidebar') && $gen_side_r) {
										echo ('<aside id="sidebar-right">');
										dynamic_sidebar($gen_side_r);
										echo ("</aside>");
									};
								?>								
								<div class="kids_clear"></div>
							</div><!-- .entry-container -->
						</div>

						<div class="bg-level-2 second-part"></div>

						 <!-- ***************** - END Image floating - *************** -->	
					</div>

				</div><!-- .bottom_content_container -->
			</div>
			<div class="content_bottom_bg"></div>
		</div>

	</div><!-- .end_content -->
	
<?php get_footer(); ?>