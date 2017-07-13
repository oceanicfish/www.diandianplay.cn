<?php
/**
 * Blog template.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 3.0
 * @version     3.2.8
 */

	$gen_sets = theme_get_option('general', 'gen_sets');
	$gen_side_r = ( isset($gen_sets['_sidebar_main_blog_r']) ) ? $gen_sets['_sidebar_main_blog_r'] : false;
	$gen_side_l = ( isset($gen_sets['_sidebar_main_blog_l']) ) ? $gen_sets['_sidebar_main_blog_l'] : false;
	$default_blog_template = ( isset($gen_sets['_blog_template_select']) ) ? $gen_sets['_blog_template_select'] : 'sb_right';

	$page_custom = theme_get_post_custom();
	$custom_sidebar_l = ( empty($page_custom['_sidebar_left']) || ($page_custom['_sidebar_left'] == "empty")) ? $gen_side_l : $page_custom['_sidebar_left'];
	$custom_sidebar_r = ( empty($page_custom['_sidebar_right']) || ($page_custom['_sidebar_right'] == "empty")) ? $gen_side_r : $page_custom['_sidebar_right'];
	$blog_template = ( isset($page_custom['_blog_templ']) ) ? ( ($page_custom['_blog_templ'] == "sb_default") ? $default_blog_template : $page_custom['_blog_templ']) : $default_blog_template;
	$blog_img_width = ( isset($page_custom['_blog_img_width']) ) ? $page_custom['_blog_img_width'] : 1048;

	switch ($blog_template) {
		case 'sb_right':
		case 'sb_left':
			$blog_style = "single-sidebar";
			$sbr_width = 300;
			break;
		case 'sb_double':
			$blog_style = "double-sidebar";
			$sbr_width = 600;
			break;
		default:
			$blog_style = "";
			$sbr_width = 0;
			break;
	};

	switch ($blog_img_width) {
		case 'blog_img_small':
			$img_width = 185;
			break;
		case 'blog_img_medium':
			$img_width = 370;
			break;
		case 'blog_img_fwidth':
			$img_width = 1048 - $sbr_width;
			break;		
		default:
			$img_width = 370;
			break;
	}
	$f_img_settings = array( 'width' => $img_width, 'crop' => true );

	$blog_cat = isset($page_custom['_blog_cat']) ? $page_custom['_blog_cat'] : '';
	
	$is_blog_on_fpage = "paged";
	if (is_front_page() && !is_home()){
		$is_blog_on_fpage = "page";
	}

	$cat = get_query_var('cat');
	$tag = get_query_var('tag');
	$author = get_query_var('author');
	
	if ($blog_cat){
		$query_array = array(
			'post_type' =>  'post',
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var($is_blog_on_fpage),
			'tax_query' => array(
						array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $blog_cat,
						'operator' => 'IN'
						)
			)
		);
	} elseif (!empty($cat)) {
		$query_array = array(
			'post_type' =>  'post',
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var($is_blog_on_fpage),
			'cat' => $cat,
		);
	} elseif (!empty($tag)) {
		$query_array = array(
			'post_type' =>  'post',
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var($is_blog_on_fpage),
			'tag' => $tag,
		);
	 } elseif (!empty($author)) {
		$query_array = array(
			'post_type' =>  'post',
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var($is_blog_on_fpage),
			'author' => $author,
		);
	 } elseif (is_date()) {
		$query_array = array(
			'post_type' =>  'post',
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var($is_blog_on_fpage)
		);	
		$year = cws_get_date_part( 'y' );
		$month = cws_get_date_part( 'm' );
		$day = cws_get_date_part( 'd' );
		if ( !empty( $year ) ){
			$query_array['year'] = $year;
		}
		if ( !empty( $month ) ){
			$query_array['monthnum'] = $month;
		}
		if ( !empty( $day ) ){
			$query_array['day'] = $day;
		}
	} else{
		$query_array = array(
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var($is_blog_on_fpage),
			'post_type' =>  'post',
		);
	}	
?>

<div class="entry-container <?php echo($blog_style); ?>">
	<?php if(($blog_template == 'sb_double' || $blog_template == 'sb_left') && function_exists('dynamic_sidebar') && $custom_sidebar_l) {
			echo ('<aside id="sidebar-left">');
			dynamic_sidebar($custom_sidebar_l);
			echo ("</aside>");
		};
	?>

	<main class="blog">

	<?php if (is_category()) { echo category_description(); } ?>

	<?php if(is_page() && have_posts()) :  while(have_posts()) : the_post(); ?>
			<?php the_content(); ?>
	<?php endwhile; endif; ?>

<?php
	$loop_cont = 0;
	
	$r = new WP_Query( $query_array );

	if( $r->have_posts() ) :  while( $r->have_posts() ) : $r->the_post();
		
		global $more;
		$more = 0;

		$categories = get_the_category();
		$separator = ', ';
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<a class="link" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( multitranslate( "View all posts in", "_tr_view", false), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}
		}

		$tags = get_the_tags();
		$tag_out = '';
		$tag_separator = ', ';
				if($tags){
					$trance = multitranslate("Tag", "_tr_tag", false);
					foreach ($tags as $tag){
						$tag_link = get_tag_link($tag->term_id);
						$tag_link = esc_url($tag_link);
						
						$tag_out .= "<a href='{$tag_link}' title='{$trance}' class='link'>{$tag->name}</a>" . $tag_separator;
					}
				}
?>
		<div class="post-item">

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

				<?php
					$post_custom = theme_get_post_custom();
					$video = ( isset($post_custom['_format_video']) ) ? $post_custom['_format_video'] : '';
					$disable_lightbox = ( isset($post_custom['_disable_blog_post_item_lightbox']) ) ? $post_custom['_disable_blog_post_item_lightbox'] : '';
					
					if ( $video ) { ?>
						<div class="content-wrapper alignleft">
							<figure style="width: <?php echo($img_width);?>px; height: <?php echo($img_width*0.5625); ?>px">
								<?php echo $video; ?>
							</figure>
						</div><!--/ post-thumb-->
					<?php } elseif ( has_post_thumbnail()) {
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true); ?>
						
						<div class="content-wrapper alignleft">
							<figure>
							<?php 
								$thumb_obj = bfi_thumb( $image[0], $f_img_settings, false );
								$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";

								if($disable_lightbox) { ?>
									<img class="pic" <?php echo ($thumb_path_hdpi); ?> alt="<?php the_title(); ?>" />
								<?php } else { ?>
									<a class="prettyPhoto kids_picture" title="<?php the_title(); ?>" href="<?php echo esc_url($image[0]); ?>"><img class="pic" <?php echo ($thumb_path_hdpi); ?> alt="<?php the_title(); ?>" /></a>
							<?php } ?>
							</figure>
						</div><!--/ post-thumb-->
					<?php } ?>

				<div class="entry">
					<div class="post-title">
						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</div><!--/ post-title-->
					<?php if ( ! has_excerpt() ) {
						      the_content();
						} else { 
						      the_excerpt();
						}
					?>	
				</div><!--/ entry--> 

			</div><!--/ post-entry -->

			<div class="post-footer">
				<span class="l-float-right"><a href="<?php the_permalink(); ?>" class="more-link cws_button"> <?php multitranslate(__("Read more", 'happykids'), "_tr_moar"); ?> </a></span>
				<div class="post_cats">
					<p><span><?php multitranslate(__('Category', 'happykids'), 'cws_post_under_cat'); ?>:</span><?php echo trim($output, $separator); ?></p>
				</div><!--/ post-cats -->

			<?php if($tag_out) : ?>
				<div class="post_tags">
					<p><span><?php multitranslate(__('Tags:', 'happykids'), 'cws_post_under_tags'); ?></span>
						<?php echo trim($tag_out, $tag_separator); ?>
					</p>
				</div><!--/ post-tags -->
			<?php endif; ?>
				<div class="kids_clear"></div>

			</div><!--/ post-footer-->

		</div><!--/ post-item-->

	<?php
			$loop_cont++;
		endwhile; endif; // LOOP END

		wp_reset_query();
		theme_pagination('pagenavi', $r); 
		comments_template(); ?>
	</main>

	<?php if(($blog_template == 'sb_double' || $blog_template == 'sb_right') && function_exists('dynamic_sidebar') && $custom_sidebar_r) {
			echo ('<aside id="sidebar-right">');
			dynamic_sidebar($custom_sidebar_r);
			echo ("</aside>");
		};
	?>
	<div class="kids_clear"></div>
</div><!-- .entry-container -->