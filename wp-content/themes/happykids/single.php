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
	$gen_side_r = ( isset($gen_sets['_sidebar_main_blog_r']) ) ? $gen_sets['_sidebar_main_blog_r'] : false;
	$gen_side_l = ( isset($gen_sets['_sidebar_main_blog_l']) ) ? $gen_sets['_sidebar_main_blog_l'] : false;
	$blog_template = ( isset($gen_sets['_blog_template_select']) ) ? $gen_sets['_blog_template_select'] : 'sb_right';
	$show_slider = isset($gen_sets['_gen_slider_select']) ? $gen_sets['_gen_slider_select'] : '';
	$slogan_sidebar = isset($gen_sets['slogan-area']) ? $gen_sets['slogan-area'] : '';
	$benefits_sidebar = isset($gen_sets['benefits-area']) ? $gen_sets['benefits-area'] : '';
	$page_crumbs = ( isset($gen_sets['_gen_breadcrumbs']) ) ? $gen_sets['_gen_breadcrumbs'] : 'show';
	$gen_author_data = isset($gen_sets['_blog_author_data']) ? $gen_sets['_blog_author_data'] : '';

	$page_custom = theme_get_post_custom();
	$local_post_author_data = ( isset($page_custom['_blog_post_author_data']) ) ? $page_custom['_blog_post_author_data'] : '';
	$video = ( isset($page_custom['_format_video']) ) ? $page_custom['_format_video'] : '';
	$disable_lightbox = ( isset($page_custom['_disable_blog_post_item_lightbox']) ) ? $page_custom['_disable_blog_post_item_lightbox'] : '';



	$img_width = 1062;
	switch ($blog_template) {
		case 'sb_right':
		case 'sb_left':
			$blog_style = "single-sidebar";
			$img_width = $img_width - 300;
			break;
		case 'sb_double':
			$blog_style = "double-sidebar";
			$img_width = $img_width - 600;
			break;
		default:
			$blog_style = "";
			break;
	};
	$f_img_settings = array( 'width' => $img_width, 'crop' => true );
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
							<div class="entry-container <?php echo($blog_style); ?>">
								<?php if(($blog_template == 'sb_double' || $blog_template == 'sb_left') && function_exists('dynamic_sidebar') && $gen_side_l) {
										echo ('<aside id="sidebar-left">');
										dynamic_sidebar($gen_side_l);
										echo ("</aside>");
									};
								?>
								<main class="blog">
									<div class="post-item">
										<?php if(have_posts()) :  while(have_posts()) : the_post();
											$categories = get_the_category();
												$separator = ', ';
												$output = '';
												if($categories){
													foreach($categories as $category) {
														$output .= '<a class="link" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( multitranslate(__("View all posts in", 'happykids'), "_tr_view", false), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
													}
												}
											$author = get_the_author();
											$author_id = $post->post_author;

											$tags = get_the_tags();
												$tag_out = '';
												$tag_separator = ', ';
														if($tags){
															$trance = multitranslate(__("Tag", 'happykids'), "_tr_tag", false);
															foreach ($tags as $tag){
																$tag_link = get_tag_link($tag->term_id);
																$tag_link = esc_url($tag_link);
																
																$tag_out .= "<a href='{$tag_link}' title='{$trance}' class='link'>{$tag->name}</a>" . $tag_separator;
															}
														}
													?>

												<div class="post-meta">
													<div class="post-date">
														<span class="day"><?php the_time('j'); ?></span>
														<span class="month"><?php the_time('M.Y'); ?></span>
													</div><!--/ post-date-->
													<?php 
													$num_comments = get_comments_number();
													if ( comments_open() && $num_comments != 0 ) : ?>
														<div class="post-comments"><a href="<?php comments_link(); ?>"><span><?php echo ($num_comments); ?></span> <?php multitranslate(__("Comments", 'happykids'), "_comments_x_comments"); ?></a></div>
													<?php endif; ?>	
												</div><!--/ post-meta-->

												<div class="post-entry">
													<div>

													<?php
														$post_custom = theme_get_post_custom();
														$video = ( isset($post_custom['_format_video']) ) ? $post_custom['_format_video'] : '';
														if ( $video ) { ?>
															<div class="content-wrapper alignleft">
																<figure style="width: <?php echo($img_width);?>px; height: <?php echo($img_width*0.5625); ?>px">
																	<?php echo $video; ?>
																</figure>
															</div><!--/ post-thumb-->
														<?php } elseif ( has_post_thumbnail()) {
																		$f_image_id = get_post_thumbnail_id(get_the_id());
																		$image = wp_get_attachment_image_src($f_image_id, 'full', true); 
																?>
															<div class="content-wrapper alignleft">
																<figure>
																<?php 
																	$post_img = (cws_get_img_width($image[0]) < $img_width ) ? cws_get_img_width($image[0]) : null;

																	if (empty($f_image_id) || $post_img) {
																		$thumb_path_hdpi = "src='". esc_url( $image[0] ) . "' data-no-retina";
																	} else {
																		$thumb_obj = bfi_thumb( $image[0], $f_img_settings, false );
																		$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
																	}
																	if($disable_lightbox || $post_img) { ?>
																	<img class="pic" <?php echo($thumb_path_hdpi); ?> alt="<?php echo (get_post_meta($f_image_id, '_wp_attachment_image_alt', true)); ?>" />
																<?php } else { ?>																
																	<a class="prettyPhoto kids_picture" title="<?php the_title(); ?>" href="<?php echo esc_url($image[0]); ?>"><img class="pic" <?php echo($thumb_path_hdpi); ?> alt="<?php echo (get_post_meta($f_image_id, '_wp_attachment_image_alt', true)); ?>" /></a>
																<?php } ?>
																</figure>
															</div><!--/ post-thumb-->
														<?php } ?>

													<div class="entry">
														<?php the_content(); ?>
														<?php wp_link_pages( array( 
														'before' => '<div class="pagenavi">' . __( 'Pages:', 'happykids' ), 
														'after' => '</div>',
														'link_before' => '<span class="page">',
														'link_after'  => '</span>',
														'highlight'   => 'b'
														) ); ?>
													</div><!--/ entry--> 

													</div>

												</div><!--/ post-entry -->

												<?php if(($gen_author_data == "show" && $local_post_author_data != "hide") || ($local_post_author_data == "show")) : ?>
													<div class="post-footer clearfix">
													<span class="l-float-right author-info"><span class="author"><?php echo $author; ?></span><?php echo get_avatar($author_id , '47' ); ?></span>

													<div class="post_cats">
														<span><?php multitranslate(__('Category', 'happykids'), 'cws_post_under_cat'); ?>: </span><?php echo trim($output, $separator); ?></p>
													</div><!--/ post-cats -->


													<?php if($tag_out) : ?>
														<div class="post_tags">
															<p><span><?php multitranslate(__('Tags:', 'happykids'), 'cws_post_under_tags'); ?></span>
																<?php echo trim($tag_out, $tag_separator); ?>
															</p>
														</div><!--/ post-tags -->
													<?php endif; ?>

												<?php else : ?>	
													<div class="post-footer">
														<div class="post_cats">
															<p><span><?php multitranslate(__('Category', 'happykids'), 'cws_post_under_cat'); ?>: </span><?php echo trim($output, $separator); ?></p>
														</div><!--/ post-cats -->

													<?php if($tag_out) : ?>
														<div class="post_tags">
															<p><span><?php multitranslate(__('Tags:', 'happykids'), 'cws_post_under_tags'); ?></span>
																<?php echo trim($tag_out, $tag_separator); ?>
															</p>
														</div><!--/ post-tags -->
													<?php endif; ?>
												<?php endif; ?>

										<?php endwhile; endif; ?>
									</div>
									<?php comments_template(); ?>	
								</main>
								<?php if(($blog_template == 'sb_double' || $blog_template == 'sb_right') && function_exists('dynamic_sidebar') && $gen_side_r) {
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