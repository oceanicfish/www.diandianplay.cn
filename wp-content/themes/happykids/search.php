<?php
/**
 * Search Results template.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 3.0
 * @version     3.2.7
 */


	get_header();
	$gen_sets = theme_get_option('general', 'gen_sets');
	$gen_side_r = ( isset($gen_sets['_sidebar_search']) ) ? $gen_sets['_sidebar_search'] : false;
	$show_slider = isset($gen_sets['_gen_slider_select']) ? $gen_sets['_gen_slider_select'] : '';
	$slogan_sidebar = isset($gen_sets['slogan-area']) ? $gen_sets['slogan-area'] : '';
	$benefits_sidebar = isset($gen_sets['benefits-area']) ? $gen_sets['benefits-area'] : '';

	$page_custom = theme_get_post_custom();
	$page_crumbs = ( isset($gen_sets['_gen_breadcrumbs']) ) ? $gen_sets['_gen_breadcrumbs'] : 'show';

	if(function_exists('dynamic_sidebar') && $gen_side_r != "empty"){
		$blog_style = "single-sidebar";
	} else {
		$blog_style = "";
	}
	$f_img_settings = array( 'width' => 370, 'crop' => true );
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
						<?php if (!is_front_page()) echo '<h1>' . __('Search Results for: ', 'happykids') . get_search_query() . '</h1>';

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
								<main class="blog">
				<?php
									if(have_posts()) :
										$keys_arr = explode(" ",$s);
									  while(have_posts()) : the_post(); ?>
				<?php
										$content = get_the_content();
										$content = preg_replace('/\[.*?(|title=\"(.*?)\".*?)\]/', '$2', $content);
										//$content = strip_shortcode_tag($content);
										$content = strip_tags($content);
										$title = get_the_title();

										$cont = '';
										$bFound = false;
										$contlen = mb_strlen($content);
										if (!empty($keys_arr[0])) {
											foreach ($keys_arr as $key) {
												$pos = 0;
												$key_len = mb_strlen($key);
												do {
													if ($contlen <= $pos) {	break; }
													$pos = mb_stripos($content, $key, $pos);
													if ($pos) {
														$start = ($pos > 50) ? $pos - 50 : 0;
														$temp = mb_substr($content, $start, $key_len + 100) . "...<br/>...";
														$cont .= $temp;
														$pos += $key_len + 50;
													}
												} while ($pos);
											}
										}

										if (mb_strlen($cont) > 0) {
											$bFound = true;
										}
										else {
											$cont = mb_substr($content, 0, $contlen < 100 ? $contlen : 100);
											if ($contlen > 100) {
												$cont .= '...';
											}
											$bFound = true;
										}

										if ($bFound) :

										$categories = get_the_category();
										$separator = ', ';
										$output = '';
										if($categories){
											foreach($categories as $category) {
												$output .= '<a class="link" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( multitranslate( __("View all posts in", 'happykids'), "_tr_view", false), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
											}
										}

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
											<article class="post-item" id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>

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

												<div class="post-entry clearfix">

													<?php
														if ( has_post_thumbnail()) {
															$f_image_id = get_post_thumbnail_id(get_the_id());
															$image = wp_get_attachment_image_src($f_image_id, 'full', true);

															$thumb_obj = bfi_thumb( $image[0], $f_img_settings, false );
															$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";


															?>
															<div class="content-wrapper alignleft">
																<figure>
																	<a class="prettyPhoto kids_picture" title="<?php the_title(); ?>" href="<?php echo esc_url($image[0]); ?>"><img class="pic" <?php echo ($thumb_path_hdpi); ?> alt="" /></a>
																</figure>
															</div><!--/ post-thumb-->

													<?php
														}
													?>

													<div class="entry">
														<div class="post-title">
															<a href="<?php the_permalink() ?>">
																<?php

																	$title  = get_the_title();
																	$keys= explode(" ",$s);
																	$title  = preg_replace('/('.implode('|', $keys) .')/iu',
																	'<span class="search-excerpt">\0</span>',
																	$title);

																	echo $title;
																?>
															</a>
														</div><!--/ post-title-->
														<?php

															$content  = get_the_content();
															$content = strip_shortcodes($content);
															if (strlen($cont) > 0) {
																$content = $cont;
															}
															$content  = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="search-excerpt">\0</span>', $content);
															echo $content;
														?>

													</div><!--/ entry-->

												</div><!--/ post-entry -->

												<div class="post-footer">
													<span class="l-float-right"><a href="<?php the_permalink(); ?>" class="more-link cws_button"> <?php multitranslate(__("Read more", 'happykids'), "_tr_moar"); ?> </a></span>
												<?php if($output) : ?>
													<div class="post_cats">
														<p><span><?php multitranslate(__('Category', 'happykids'), 'cws_post_under_cat'); ?>:</span><?php echo trim($output, $separator); ?></p>
													</div><!--/ post-cats -->
												<?php endif; ?>
												<?php if($tag_out) : ?>
													<div class="post_tags">
														<p><span><?php multitranslate(__('Tags:', 'happykids'), 'cws_post_under_tags'); ?></span>
															<?php echo trim($tag_out, $tag_separator); ?>
														</p>
													</div><!--/ post-tags -->
												<?php endif; ?>
													<div class="kids_clear"></div>

												</div><!--/ post-footer-->


											</article><!--/ post-item-->

										<?php endif; ?>

									<?php
										endwhile;
									else : // LOOP END
									?>

										<div class="holder404">
											<div class="description_error">
												<p>
													<?php multitranslate(__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'happykids'), '_tr_nothing_search' ); ?>
												</p>
											</div>
										</div>

									<?php endif; ?>
								<?php theme_pagination('pagenavi gl'); comments_template(); ?>
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
					</div>
					<!-- ***************** - END Image floating - *************** -->
				</div><!-- .bottom_content_container -->
			</div>
			<div class="content_bottom_bg"></div>
		</div>
	</div><!-- .end_content -->

<?php get_footer(); ?>