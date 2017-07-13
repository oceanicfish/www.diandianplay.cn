<?php
/**
 * Portfolio Template.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 3.0.0
 * @version     3.3.6
 */
	if(!empty($_POST['action'])) {
		require_once('../../../wp-config.php');
		$action = $_POST['action'];
		$page = intval( $action[0] );
		$filter = $action[1];
		$ppp = $action[2];
		$pid = $action[3];
		render_portfolio($page, true, $filter, $ppp, $pid);
		die();
	} else {
		render_portfolio(1, false, get_query_var('portfolio_category'), null, null);
	}

	function render_portfolio($paged, $bAjax = false, $filter, $ppp, $pid) {
		$gen_sets = theme_get_option('general', 'gen_sets');
		$gen_but_hide = ( isset($gen_sets['_port_butt_hide']) ) ? $gen_sets['_port_butt_hide'] : '';
		$gen_button_show = ( isset($gen_sets['_gen_port_butt_show']) ) ? $gen_sets['_gen_port_butt_show'] : '';
		$gen_button_txt = ( isset($gen_sets['_gen_port_butt_txt']) ) ? $gen_sets['_gen_port_butt_txt'] : '';
		$gen_ipp = isset($gen_sets['_gen_port_ipp']) ? $gen_sets['_gen_port_ipp'] : '';

		if ($ppp) {
			$ipp = $ppp;
			$post_port = explode(',', $filter);
			$page_custom = theme_get_post_custom($pid);
			if (!empty($page_custom['_port_cat'])) {
				// this goes to filter list
				$categories = explode(',', $page_custom['_port_cat']);
				if ('*' === $filter) {
					$post_port = $categories;
				}
			}
		} else {
			$page_custom = theme_get_post_custom();
			$post_port = !empty($page_custom['_port_cat']) ? $page_custom['_port_cat'] : '*';
			$post_port = empty($filter) ? explode(',', $post_port)  : $filter;

			$custom_ipp = isset($page_custom['_port_ipp']) ? $page_custom['_port_ipp'] : '';
			$ipp = $custom_ipp ? $custom_ipp : $gen_ipp;
			global $post;
			$pid = $post->ID;
		}

		$bUseFilter = isset($page_custom['_port_cat_filter']) ? $page_custom['_port_cat_filter'] : '';

		$cols = isset($page_custom['_port_templ']) ? $page_custom['_port_templ'] : 'four';
		$gen_side_r = ( isset($gen_sets['_sidebar_portf_r']) ) ? $gen_sets['_sidebar_portf_r'] : false;
		$gen_side_l = ( isset($gen_sets['_sidebar_portf_l']) ) ? $gen_sets['_sidebar_portf_l'] : false;
		$default_page_template = ( isset($gen_sets['_gen_portf_select']) ) ? $gen_sets['_gen_portf_select'] : 'sb_none';

		$custom_sidebar_l = ( empty($page_custom['_sidebar_left']) || ($page_custom['_sidebar_left'] == "empty")) ? $gen_side_l : $page_custom['_sidebar_left'];
		$custom_sidebar_r = ( empty($page_custom['_sidebar_right']) || ($page_custom['_sidebar_right'] == "empty")) ? $gen_side_r : $page_custom['_sidebar_right'];
		$page_template = ( isset($page_custom['_portf_templ']) ) ? ( ($page_custom['_portf_templ'] == "sb_default") ? $default_page_template : $page_custom['_portf_templ']) : $default_page_template;

		switch ($cols) {
			case 'one':
				$img_width = 1150;
				$text_length = 310;
				if ($page_template == "sb_right" || $page_template == "sb_left"){
					$img_width = $img_width - 300;
				} else if($page_template == "sb_double"){
					$img_width = $img_width - 600;
				};
				break;
			case 'two':
				$img_width = 550;
				$text_length = 150;
				if ($page_template == "sb_right" || $page_template == "sb_left"){
					$img_width = $img_width - 150;
				} else if($page_template == "sb_double"){
					$img_width = $img_width - 300;
				};
				break;
			case 'three':
				$img_width = 350;
				$text_length = 105;
				if ($page_template == "sb_right" || $page_template == "sb_left" || $page_template == "sb_double"){
					$img_width = $img_width - 100;
				};
				break;
			case 'four':
				$img_width = 250;
				$text_length = 80;
				break;
			default:
				$img_width = 250;
				$text_length = 100;
				break;
		}

		switch ($page_template) {
			case 'sb_right':
			case 'sb_left':
				$page_style = "single-sidebar";
				break;
			case 'sb_double':
				$page_style = "double-sidebar";
				break;
			default:
				$page_style = "";
				break;
		}

		$f_portf_img_settings = array( 'width' => $img_width, 'crop' => true );

		if ( !empty($post_port) && $post_port[0] !== '*' ) {
			$categories = empty($categories) ? $post_port : $categories;
			$query_array = array(
				'post_type' =>  'portfolio',
				'posts_per_page' => $ipp,
				'paged' => $paged,
				'tax_query' => array(
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'slug',
							'terms' => $post_port,
							//'operator' => 'IN'
						)
				)
			);
		} else {
			$query_array = array(
				'posts_per_page' => $ipp,
				'paged' => $paged,
				'post_type' =>  'portfolio',
			);
		}
	if (!$bAjax) {
	?>
 	<div class="entry-container <?php echo($page_style); ?>">
	<?php if(($page_template == 'sb_double' || $page_template == 'sb_left') && function_exists('dynamic_sidebar') && $custom_sidebar_l) {
			echo ('<aside id="sidebar-left">');
			dynamic_sidebar($custom_sidebar_l);
			echo ("</aside>");
		};
	?>
	<main>
		<div class="portfolio iso-column iso-<?php echo $cols; ?>-column">
	<?php if ('on' === $bUseFilter) : ?>
			<div class="filter-wrapper">
				<select class="filter">
				<?php
					echo '<option value="*" selected>'. __('All', 'happykids') .'</option>';
					if (empty($categories)) {
						$categories = get_terms('portfolio_category', array('hide_empty' => false));
						foreach ( $categories as $cat ) {
							$selected = ($cat->slug == $filter) ? ' selected' : '';
							echo '<option value="' . $cat->slug . '"' . $selected . '>' . $cat->name . "</option>\n";
						}
					} else {
						foreach ( $categories as $cat ) {
							$selected = ($cat == $filter) ? ' selected' : '';
							$gtb = get_term_by('slug', $cat, 'portfolio_category', ARRAY_A);
							echo '<option value="' . $cat . '"' . $selected . '>' . $gtb['name'] . "</option>\n";
						}
					}
				?>
				</select>
			</div>
	<?php endif;

		// $bAjax	?>
		<div class="grid isotope" <?php echo 'data-ajax="' . THEME_URI . '/portfolio.php"'?>
			<?php echo 'data-ppp="' . $ipp . '"'?>
			<?php echo 'data-cols="' . $pid . '"'?>
		>

				<?php
}
					$query_port = new WP_Query( $query_array );
					while($query_port->have_posts()){ $query_port->the_post();
						$f_image_id = get_post_thumbnail_id(get_the_id());
						$image = wp_get_attachment_image_src($f_image_id, 'full', true);

						$the_cat = get_the_terms( get_the_ID() , 'portfolio_category');
						$categories = '';
						if(is_array($the_cat))
							foreach($the_cat as $cur_term) {
								$categories .= $cur_term->slug . ' ';
							}

							$page_custom = theme_get_post_custom();
							$button_show = ( isset($page_custom['_port_butt_show']) ) ? $page_custom['_port_butt_show'] : '';
							$button_link = ( isset($page_custom['_port_butt_link']) ) ? $page_custom['_port_butt_link'] : '';
							$button_txt = ( isset($page_custom['_port_butt_txt']) ) ? $page_custom['_port_butt_txt'] : '';
							$enable_popup_link = ( isset($page_custom['_img_port_butt_link']) ) ? $page_custom['_img_port_butt_link'] : '';
							$custom_popup = isset($page_custom['_port_popup_link']) ? $page_custom['_port_popup_link'] : '';
							$disable_lightbox = ( isset($page_custom['_disable_portf_item_lightbox']) ) ? $page_custom['_disable_portf_item_lightbox'] : '';
							if (!$button_txt) $button_txt = $gen_button_txt;
							if ($button_show == 'empty') $button_show = $gen_button_show;

				?>

					<div data-categories="<?php echo $categories; ?>" class="iso-item">

						<div class="content-wrapper">
							<figure>
								<?php

								if (empty($f_image_id)) {
									$thumb_path_hdpi = "src='". esc_url( $image[0] ) . "' data-no-retina";
								} else {
									$thumb_obj = bfi_thumb( $image[0], $f_portf_img_settings, false );
									$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
								}

								$img_tag = "<img $thumb_path_hdpi alt='" . get_post_meta($f_image_id, '_wp_attachment_image_alt', true) . "' />";
								
								$lightbox_wrapper = $enable_popup_link ? 'class="kids_link"' : 'class="prettyPhoto kids_picture" data-rel="prettyPhoto[portfolio]"';
								$lightbox_url = $custom_popup ? esc_url($custom_popup) : ($enable_popup_link ? get_the_permalink() : esc_url($image[0]));

								if ($disable_lightbox){
									echo ($img_tag);
								} else {
									echo('<a title="' . get_the_title() . '" ' . $lightbox_wrapper . ' href="' . $lightbox_url .'">' . $img_tag );
									if ($enable_popup_link) echo ('<span class="kids_curtain">&nbsp;</span>');
									echo ('</a>');
								}
								?>
							</figure>

						</div><!--/ content-wrapper-->

						<div class="gallery-text">
							<div class="title"><a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<p><?php the_excerpt_max_charlength($text_length); ?></p>
						</div>
						<div class="post-footer">
	<?php
							if ($button_show == 'show'){
									$button_text = $button_txt;
								if ( empty($button_link) ) {
									$link = get_the_permalink();
									$target = '';
								} else {
									$link = $button_link;
									$target = '" target="_blank';
								}
	?>
								<a href="<?php echo $link . $target; ?>" class="cws_button"><?php echo $button_text; ?></a>
	<?php 				} ?>
						</div><!--/ post-footer-->

						<div class="kids_clear"></div>

					</div>

				<?php
					}
					wp_reset_postdata();
	 	if (!$bAjax) {
	 			?>

		</div><!-- grid isotope -->
		<?php } ?>
		<?php
			cws_portfolio_pagination('pagenavi gl', $query_port);

			if (!$bAjax) {
		?>
	</div><!-- .gl_col_ -->
	<?php 			comments_template(); ?>	
	</main>
		<?php
		}
			if(($page_template == 'sb_double' || $page_template == 'sb_right') && function_exists('dynamic_sidebar') && $custom_sidebar_r) {
				echo ('<aside id="sidebar-right">');
				dynamic_sidebar($custom_sidebar_r);
				echo ("</aside>");
			};
		?>
	</div> <!-- .entry-container -->
	<?php }

function cws_portfolio_pagination($class = '', $_query = null, $num_pages = 9, $stepLink = 9, $echo = true) {

	/* ================ Settings ================ */
	$text_num_page = multitranslate(__("Page", 'happykids'), "_tr_paginat_page", false).' ({current} of {last})';
	$dotright_text = __('...', 'happykids');
	$dotright_text2 = __('...', 'happykids');
	$backtext = __('Prev', 'happykids');
	$nexttext = __('Next', 'happykids');
	$first_page_text = '';
	$last_page_text = '';
	/* ============== Settings END ============== */

	if (!$_query) {
		global $wp_query;
		$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
		$paged = (int) $wp_query->query_vars['paged'];
		$max_page = $wp_query->max_num_pages;
	}else {
		$posts_per_page = (int) $_query->query_vars['posts_per_page'];
		$paged = (int) $_query->query_vars['paged'];
		$max_page = $_query->max_num_pages;
	}

	if($max_page <= 1 ) return false;

	if(empty($paged) || $paged == 0) $paged = 1;

	$pages_to_show = intval($num_pages);
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);

	$start_page = $paged - $half_page_start;
	$end_page = $paged + $half_page_end;

	if($start_page <= 0) $start_page = 1;
	if(($end_page - $start_page) != $pages_to_show_minus_1) $end_page = $start_page + $pages_to_show_minus_1;
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if($start_page <= 0) $start_page = 1;

	$out='';
		$out.= "<div class='" . $class . "'>\n";

			if ($text_num_page) {
				$text_num_page = preg_replace ('!{current}|{last}!','%s',$text_num_page);
				$out.= sprintf ("<span class='pages'>$text_num_page</span>",$paged,$max_page);
			}

			if ($backtext && $paged!=1){
				$out.= '<a class="prevpostslink" href="paged='.($paged-1).'">'.$backtext.'</a>';
			}elseif($backtext){
				$out.= '<a class="prevpostslink pagenavi_no_click" href="#" style="cursor:default;">'.$backtext.'</a>';
			}

			if ($start_page >= 2 && $pages_to_show < $max_page) {

				if($dotright_text && $start_page!=2) $out.= '<span class="extend page">'.$dotright_text.'</span>';
			}

			for($i = $start_page; $i <= $end_page; $i++) {
				if($i == $paged) {
					$out.= '<span class="current">'.$i.'</span>';
				} else {

					$out.= '<a class="page" href="paged='.$i.'">'.$i.'</a>';
				}
			}

			if ($stepLink && $end_page < $max_page){
				for($i=$end_page+1; $i<=$max_page; $i++) {
					if($i % $stepLink == 0 && $i!==$num_pages) {
						if (++$dd == 1) $out.= '<span class="extend page">'.$dotright_text2.'</span>';
						$out.= '<a class="page" href="paged='.$i.'">'.$i.'</a>';
					}
				}
			}

			if ($end_page < $max_page) {
				if($dotright_text && $end_page!=($max_page-1)) $out.= '<span class="extend page">'.$dotright_text2.'</span>';

			}

			if ($nexttext && $paged!=$end_page){
				$out.= '<a class="nextpostslink" href="paged='.($paged+1).'">'.$nexttext.'</a>';
			}elseif($nexttext){
				$out.= '<a class="nextpostslink pagenavi_no_click" href="#" style="cursor:default;">'.$nexttext.'</a>';
			}

		$out.= "</div>" . "\n";

	wp_reset_query();

	if ($echo) echo $out;
	else return $out;
}
	?>
