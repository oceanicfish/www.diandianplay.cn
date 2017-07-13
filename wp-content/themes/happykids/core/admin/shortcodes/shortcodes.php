<?php

global $cws_shortcodes;
$cws_shortcodes = array ('cws_progress', 'embed', 'alert', 'cws_button', 'quote', 'fa', 'dropcap', 'mark', 'portfolio', 'cws_cta', 'news', 'tweets', 'shortcode_carousel', 'shortcode_blog');

function add_plugin($plugin_array) {
	global $cws_shortcodes;
	$plugin_array['cws_tmce'] = get_template_directory_uri() .'/core/admin/shortcodes/cws_tmce.js';
	//$plugin_array['table'] = THEME_URI .'/core/tmcetable/plugin.js';
	return $plugin_array;
}

function add_button() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin');
		add_filter('mce_buttons_3', 'register_button3');
	}
}
add_action('init', 'add_button');

function cws_shortcodes_admin_init( $hook ) {
	if( 'post.php' != $hook && 'post-new.php' != $hook ) {
		return;
	}
	wp_enqueue_style( 'wp-color-picker');
	wp_enqueue_script( 'wp-color-picker');
}
add_action('admin_enqueue_scripts', 'cws_shortcodes_admin_init');

// Add Shortcode
function progress_shortcode( $attr ) {
	extract( shortcode_atts(array('progress' => '50', 'title' => null, 'color' => null), $attr )	);
	return '<div class="single_bar ' . ( $title ? 'with_title' : '' ) . '">' . ( $title ? '<div class="title">' . $title . '</div>' : '' ) . '<div class="scale"><div class="progress" data-value="' . $progress . '"' . ( $color ? ' style="background-color:' . $color . ';"' : '' ) . '></div></div></div>';
}
add_shortcode( 'progress', 'progress_shortcode' );

function quote_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(
		array(
			'photo' => null,
			'author' => '',
		), $atts));
	return cws_testimonial_renderer($photo, $content, $author);
}
add_shortcode( 'quote', 'quote_shortcode' );

function shortcode_alert($atts, $content = null) {
	extract(shortcode_atts(
		array(
			'type' => 'notice',
			'title' => null,
			'e_style' => null,
			'close' => null,
			'custom' => null,
			'bg_color' => null,
			'fa_code' => null,
		), $atts));
	return '<div class="message_box ' . ( $custom ? "custom" : $type  . '-box ' ) . ( $close ? ' close' : "" ) . ($custom ? ( $fa_code ? "" : " no-icon" ) :"") .'" '.( $bg_color ? 'style="background-color:rgb('. cws_Hex2RGB($bg_color) .');"' : "" ).' >' . ( $close ? '<span class="close-box"></span>' : "" ) . ( $fa_code ? '<i class="box-icon fa' . (' fa-' . $fa_code). '" style="color:'. $bg_color .';  text-shadow: rgb('. cws_text_shadow_gen_mask($bg_color) .') 1px 1px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 2px 2px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 3px 3px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 4px 4px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 5px 5px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 6px 6px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 7px 7px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 8px 8px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 9px 9px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 10px 10px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 11px 11px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 12px 12px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 13px 13px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 14px 14px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 15px 15px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 16px 16px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 17px 17px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 18px 18px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 19px 19px,
    rgb('. cws_text_shadow_gen_mask($bg_color) .') 20px 20px; "></i>' : "" ) . ( $title ? "<div class='message_box_header'>" . $title . "</div>" : "" ) . "<p>" . do_shortcode($content) . "</p>" . '</div>';
}
add_shortcode('alert', 'shortcode_alert');

// Font-Awesome shortcode
function shortcode_fa($attr, $content = null) {
	extract(shortcode_atts(
		array(
			'fa_code' => null,
			'size' => null,
			'custom_color' => null,
			'color' => null,
			'bg_color' => null,
		), $attr));
	$custom_color_settings = $custom_color ? " style='color:$color; background-color:$bg_color;'" : "";
	$out = "<i class='soc_icon fa fa-" . $fa_code . " fa-" . $size . ( $custom_color ? " custom_color" : "" ) . "'" . $custom_color_settings . "></i>";
	return $out;
}
add_shortcode('fa', 'shortcode_fa');

function shortcode_mark($attr, $content = null) {
	extract(shortcode_atts(array(
		'color' => '',
		'bg_color' => '',
	), $attr));
	//$class = '';
	$output = '<mark';
	if ( $color || $bgcolor ) {
		$output .= ' style="' . ( $color ? 'color: ' . $color . ';' : '') . ($bg_color ? ' background-color: ' . $bg_color . ';' : '') . '"';
	}
	$output .= '>';
	$output .= $content;
	$output .= '</mark>';
	return $output;
}
add_shortcode('mark', 'shortcode_mark');

function shortcode_dropcap($attr, $content = null) {
	return "<span class='dropcap'>" . $content . "</span>";
}
add_shortcode('dropcap', 'shortcode_dropcap');


function register_button3($buttons) {
	global $cws_shortcodes;
	$buttons = array_merge((array)$buttons, (array)$cws_shortcodes );
	return $buttons;
}

// outputs description post
function shortcode_cws_cta($attr, $content = null) {
	extract(shortcode_atts(
		array(
			'icon' => null,
			'img' => null,			
			'title' => null,
			'button_text' => __('Click Here', 'happykids'),
			'link' => "#",
			'target' => null		
		), $attr));
	$output = '<div class="cws-widget callout_widget clearfix ' . ( ($icon || $img) ? "with_icon" : "" ) . '">';
	$output .= $img  ? "<div class='icons_part icon_frame img_icon'><img src=" . $img . "></div>" : "";	
	$output .= $icon ? "<div class='icons_part icon_frame'><i class='fa fa-" . $icon . "'></i></div>" : "";
	$target = $target ? "target = '_blank' " : "";		
	$output .= "<div class='content_wrapper'><div class='text_part'>" . ( $title ? "<div class='title'>$title</div>" : "" ) . do_shortcode($content) . "</div><div class='button_part'><a class='cws_button large' href='$link' " . $target . ">$button_text</a></div></div>";
	$output .= '</div>';

	return $output;
}
add_shortcode('cws_cta', 'shortcode_cws_cta');

function shortcode_current_year() { return date("Y"); }
add_shortcode('current-year', 'shortcode_current_year');

function shortcode_site_title() { return get_bloginfo('name'); }
add_shortcode('site-title', 'shortcode_site_title');

function shortcode_site_tagline() { return get_bloginfo('description'); }
add_shortcode('site-tagline', 'shortcode_site_tagline');

function shortcode_site_url() { return home_url(); }
add_shortcode('site-url', 'shortcode_site_url');

function shortcode_wpurl() { return site_url(); }
add_shortcode('wp-url', 'shortcode_wpurl');

function shortcode_twitter($attr) {
	extract(shortcode_atts(
		array(
			'tweets' => 4,
			'visible' => 2,
			'before_widget' => "<div class='cws-widget'>",
			'after_widget' => "</div>",
			'before_title' => "<div class='widget-title'><span>",
			'after_title' => "</span></div>",
			'sidebar' => false,
			'title' => ''
		), $attr));
	$visible = intval($visible);
	$tweets_n = intval($tweets);
	$out = '';
	$twt_obj = cws_getTweets($tweets);
	if ($twt_obj && is_array($twt_obj)) {
		if (!array_key_exists('error', $twt_obj)) {
			$is_carousel = ($visible < $tweets ? true : false);
			$out .= $sidebar ? "" : $before_widget;
			$out .= "<div class='cws-widget-content '>";

			if ($is_carousel):
				$out .= "<div class='carousel_header clearfix'>";
				$out .= count($twt_obj) ? "<div class='widget_carousel_nav'><i class='prev fa fa-angle-left'></i><i class='next fa fa-angle-right'></i></div>" : "" ;
			endif;
			$out .= !empty( $title ) ? $before_title . $title . $after_title : "";
			if ($is_carousel) $out .= "</div>";
			if ($is_carousel) $out .= "<div class='carousel_content cws_tweets'>";

			$out .= '<ul class="latest_tweets ' . ($is_carousel ? ' widget_carousel' : '' ) . '">';
			if ($twt_obj) {
				$i = 0;
				foreach ($twt_obj as $tweets) {
					if ( $i == 0 ) {
						$out .= '<li><ul>';
					}
					$strtime = strtotime($tweets['created_at']);
					$tweet_text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $tweets['text']);
					$tweet_text = preg_replace('/#([\\d\\w]+)/', '<a href="http://twitter.com/search?q=%23$1&amp;src=hash">$0</a>', $tweet_text);
					if (strlen($tweet_text) > 0) {
						$out .= '<li class="clearfix"><div class="icon_frame"><i class="fa fa-twitter fa-2x"></i></div><div>';
						$out .= '<p>' . $tweet_text . '</p>';
						$out .= '<span class = "date">' . date('M d, Y', $strtime) . '</span>';
						$out .= '</div></li>';
					}
					$i++;
					if ($i == $visible) {
						$out .= '</ul></li>';
						$i = 0;
					}
					$tweets_n--;
					if ( !$tweets_n ) {
						break;
					}
				}
				if ( ( $i != $visible ) && ( $i != 0 ) ) {
					$out .= '</ul></li>';
				}
			} else {
				$out .= '<li>' . __( 'Twitter API keys and tokens are not set.', 'happykids' ) . '</li>';
			}
			$out .= '</ul>';
			if ($is_carousel) $out .= "</div>";
			$out .= '</div>';
			$out .=  $sidebar ? "" : $after_widget;
		} else {
			$out = $twt_obj['error'];
		}
	} else if (isset($twt_obj->errors)) {
		$out = $twt_obj->errors[0]->message;
	} else {
		$out =  __( 'Twitter response: ', 'happykids' ) . $twt_obj;
	}
	return $out;
}
add_shortcode('twitter', 'shortcode_twitter');

function shortcode_button($atts, $content){
	extract( shortcode_atts(array(
			'type' => 'default',
			'size' => 'medium',
			'link' => '#',
			'target' => null,
			'custom_color' => null,
			'button_color' => null,
			'text_color' => null,
			'fa_code' => null,
			'icon_color' => null
		),$atts ));
	$class = $type ? ( $type != 'default' ? $type . " " : "" ) : "";
	$class .= $size ? ( $size != 'medium' ? $size . " " : "" ) : "";
	$fa_icon = $fa_code ? '<i class="button-icon fa fa-' . $fa_code . '" '. ( $custom_color ? " style='color:" . $icon_color . "'" : "" ) .' ></i>' : "";
	$class .= $custom_color ? "custom_color " : "";
	$target = $target ? "target = '_blank' " : "";
	$out = "<a href='$link' ". $target ." class='cws_button " . $class . "'" . ( $custom_color ? " style='background:" . $button_color . ";" . " color:" . $text_color . "'" . " data-icon-color='" . $icon_color . "'" : "" ) . ">" . do_shortcode($content) . $fa_icon . "</a>";
	return $out;
}
add_shortcode('cws_button', 'shortcode_button');

function shortcode_cws_portfolio($atts = array()) {
	extract(shortcode_atts(array(
		'title' => '',
		'cols' => '4',
		'cats' => '',
		'postspp' => '-1',
		'usecarousel' => 0,
		'img_popup' => 1,
		'img_width' => '',
		'img_height' => '',
		'hide_text' => 0,
		'txt_length' => '',
		'button' => '',
		'more' => 0

	), $atts));
	switch ($cols) {
		case '1':
			$t_cols = "one";
			$default_img_width = 1150;
			break;
		case '2':
			$t_cols = "two";
			$default_img_width = 550;
			break;
		case '3':
			$t_cols = "three";
			$default_img_width = 350;
			break;
		case '4':
			$t_cols = "four";
			$default_img_width = 250;
			break;
		default:
			$t_cols = "four";
			$default_img_width = 250;
			break;
	};
	$img_width = empty($img_width) ? $default_img_width : $img_width;
	$iso_column = 'iso-'.$t_cols.'-column iso-column';
	$coef_text = 16/$cols;
	$chars_to_display = empty($txt_length) ? (20*$coef_text) : $txt_length;

	empty($img_height) ? $f_img_settings = array( 'width' => $img_width, 'crop' => true ) : $f_img_settings = array( 'width' => $img_width, 'height' => $img_height, 'crop' => true );
	$carousel_wrapper = $usecarousel ? "" : $iso_column;
	$wrapper = '<div class="recent_projects '. $carousel_wrapper .'">';
	$wrapper .= empty($title) ? "" : '<h3 class="section-title">'.$title.'</h3>';
	$wrapper .= $usecarousel ? '<div class="projects_carousel clearfix" data-carousel-column="'.$cols.'">' : '<div class="grid isotope">';

	$wrapEnd = '</div><!--/ .projects-carousel --></div><!--/ .work-carousel-->';
	$cats_array = explode(',', $cats);
	$query_array_tax = array(
		array(
			'taxonomy' => 'portfolio_category',
			'field' => 'slug',
			'terms' => $cats_array,
			'operator' => 'IN'
		)
	);
	$query_array = array(
		'posts_per_page' => $postspp,
		'post_type' => 'portfolio',
		'tax_query' => $query_array_tax
	);

	if ($cats == '' || $cats == 'all'){
		$query_port = new WP_Query( array('post_type' => 'portfolio', 'posts_per_page' => $postspp ) );
	}else {
		$query_port = new WP_Query( $query_array );
	}
	$data_id = 1;
	$slideOutput = '';

	while($query_port->have_posts()){
		$query_port->the_post();
		$f_image_id = get_post_thumbnail_id(get_the_id());
		$image = wp_get_attachment_image_src($f_image_id, 'full', true);

		$prettyPhotoLink = $image[0];
		if (empty($f_image_id)) {
			$thumb_path_hdpi = "src='". esc_url( $image[0] ) . "' data-no-retina";
		} else {
			$thumb_obj = bfi_thumb( $image[0], $f_img_settings, false );
			$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
		}

		$image = has_post_thumbnail() ? '<img '. $thumb_path_hdpi .' alt="' . get_post_meta($f_image_id, "_wp_attachment_image_alt", true) . '" />' : '';		

		$page_custom = theme_get_post_custom();
		$video = ( isset($page_custom['_port_popup_link']) ) ? $page_custom['_port_popup_link'] : '';

		$the_cat = get_the_terms( get_the_ID() , 'portfolio_category');
		$categories = '';
		if(is_array($the_cat))
		foreach($the_cat as $cur_term){
			$categories .= $cur_term->slug .' ';
		}

		$_button_out = '';
		$gen_sets = theme_get_option('general', 'gen_sets');
		$gen_button_default_txt = ( isset($gen_sets['_gen_port_butt_txt']) ) ? $gen_sets['_gen_port_butt_txt'] : '';
		$button = empty($button) ?  $gen_button_default_txt : $button;
		$_show_button = isset($page_custom['_port_butt_show']) ? $page_custom['_port_butt_show'] : '';
		$_button_text = empty($page_custom['_port_butt_txt']) ? $button : $page_custom['_port_butt_txt'];
		$is_direct_link = isset($page_custom['_img_port_butt_link']) ? $page_custom['_img_port_butt_link'] : '';
		if ($is_direct_link) {
			$emb_code = 'class="kids_link"';
			$emb_code_span = '<span class="kids_curtain">&nbsp;</span>';
		} else {
			$emb_code = 'data-rel="prettyPhoto[rs_projects]" class="prettyPhoto kids_picture"';
			$emb_code_span = '';
		}


		$projPermalink = get_permalink();
		$_link = isset($page_custom['_port_butt_link']) ? $page_custom['_port_butt_link'] : '';
		if (!$_link) $_link = $projPermalink;
		if ($more && ($_show_button == 'empty' || $_show_button == 'show')) {
			$_button_out = '<div><a href="'. $_link .'" class="cws_button">'. $_button_text .'</a></div>';
		}

		$img_url = $video ? $video : $prettyPhotoLink;
		$img_wrapper = $image ? ($img_popup ? '<div class="content-wrapper"><figure><a '.$emb_code.' href="'. $img_url .'" title="'. get_the_title() .'">'.$image.' '.$emb_code_span .'</a></figure></div>' : '<div class="content-wrapper"><figure>'.$image.'</figure></div>') : '';
		$slideOutput .= $hide_text ? '<div class="iso-item">'. $img_wrapper .'</div>' : '<div class="iso-item">'. $img_wrapper .'<div class="gallery-text"><div class="title">'. get_the_title() .'</div><p>'. the_excerpt_max_charlength($chars_to_display, false) .'</p></div>'.$_button_out.'</div>';

		$data_id++;
	} // end while
	wp_reset_postdata();

	$to_return = $wrapper . $slideOutput . $wrapEnd;
	return $to_return;
}
add_shortcode('portfolio', 'shortcode_cws_portfolio');

function cws_shortcode_blog ( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => '',
		'cols' => '2',
		'cats' => '',
		'postspp' => '-1',
		'usecarousel' => 0,
		'img_popup' => 0,
		'img_width' => 185,
		'img_height' => '',
		'txt_length' => 200,
		'hide_date' => 0,
		'hide_footer' => 0,
		'hide_meta' => 0,
		'button' => __('Read More', 'happykids'),

	), $atts));
	switch ($cols) {
		case '1':
			$t_cols = "one";
			break;
		case '2':
			$t_cols = "two";
			break;
		case '3':
			$t_cols = "three";
			break;
		case '4':
			$t_cols = "four";
			break;
		default:
			$t_cols = "four";
			break;
	};
	$iso_column = 'iso-'.$t_cols.'-column iso-column';
	$coef_text = 16/$cols;
	empty($img_height) ? $f_img_settings = array( 'width' => $img_width, 'crop' => true ) : $f_img_settings = array( 'width' => $img_width, 'height' => $img_height, 'crop' => true );
	$carousel_wrapper = $usecarousel ? "" : $iso_column;
	$wrapper = '<div class="recent_projects '. $carousel_wrapper .'">';
	$wrapper .= empty($title) ? "" : '<h3 class="section-title">'.$title.'</h3>';
	$wrapper .= $usecarousel ? '<div class="projects_carousel blog clearfix" data-carousel-column="'.$cols.'">' : '<div class="blog grid isotope">';

	$wrapEnd = '</div><!--/ .projects-carousel --></div><!--/ .work-carousel-->';

	$posts_per_page = empty($postspp) ? '' : $postspp;

	$slideOutput = '';

	if (!empty($cats)){
		$cats_array = explode(',', $cats);
		$query_array = array(
			'post_type' =>  'post',
			'posts_per_page' => $posts_per_page,
			'tax_query' => array(
						array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $cats_array,
						'operator' => 'IN'
						)
			)
		);
	}else{
		$query_array = array(
			'posts_per_page' => $posts_per_page,
			'post_type' =>  'post',
		);
	}

	$loop_cont = 0;

	$_query = new WP_Query($query_array);

	if( $_query->have_posts() ) :  while( $_query->have_posts() ) : $_query->the_post();

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
						$tag_out .= '<a href="'.$tag_link.'" title="'.$trance.'" class="link">'.$tag->name.'</a>' . $tag_separator;
					}
				}

			$slideOutput .= '<div class="iso-item"><div class="post-item">';
			if(!$hide_date){
				$num_comments = get_comments_number();
				$commnets_wrapper =  ($num_comments == 0) ? '' : '<div class="post-comments"><a href="'.get_comments_link().'"><span>'. $num_comments .'</span>'.multitranslate(__("Comments", 'happykids'), "_comments_x_comments", false).'</a></div>';
				$slideOutput .= '<div class="post-meta">
					<div class="post-date">
						<span class="day"> '.get_the_time('j').'</span>
						<span class="month">'.get_the_time('M.Y').'</span>
					</div>' . $commnets_wrapper .
				'</div>';
			}

			$slideOutput .= '<div class="post-entry">';

			if ( has_post_thumbnail()) {
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true);
				$thumb_obj = bfi_thumb( $image[0], $f_img_settings, false );
				$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
				$img_wrapper = '<img class="pic" ' . $thumb_path_hdpi . ' alt="" />';
				$lightbox_wrapper = $img_popup ? '<a data-rel="prettyPhoto[lt_posts]" class="prettyPhoto kids_picture" title="'.get_the_title().'" href="'.esc_url($image[0]).'">'.$img_wrapper.'</a>' : '<a href="'.get_permalink().'">' . $img_wrapper . '</a>';
				$slideOutput .= '<div class="content-wrapper alignleft">
					<figure>
						'.$lightbox_wrapper.'
					</figure>
				</div>';
			}
			$post_cont = mb_substr(get_the_excerpt(), 0, $txt_length);
			$slideOutput .= '<div class="entry">
								<div class="post-title">
									<a href="'.get_permalink().'">'.get_the_title().'</a>
								</div>'.$post_cont.' ...</div>
							</div>';
			if(!$hide_footer){
				$slideOutput .= '
				<div class="post-footer">
					<span class="l-float-right"><a href="'.get_permalink().'" class="more-link cws_button">
					'.multitranslate(__("Read more", "happykids"), "_tr_moar", false).'</a></span>';
				if(!$hide_meta) {
					$slideOutput .= '<div class="post_cats">
						<p><span>'.multitranslate(__("Category", "happykids"), "cws_post_under_cat", false).':</span>'.trim($output, $separator).'</p>
					</div>';
				}
				if($tag_out && !$hide_meta){
					$slideOutput .= '<div class="post_tags">
						<p><span>'.multitranslate(__("Tags:", "happykids"), "cws_post_under_tags", false).'</span>
							'.trim($tag_out, $tag_separator).'</p>
					</div>';
				}
				$slideOutput .=	'<div class="kids_clear"></div></div></div></div>';
			} else {
				$slideOutput .=	'<div class="kids_clear"></div></div></div>';
			}
			$loop_cont++;
		endwhile; endif; // LOOP END

		wp_reset_query();
	$to_return = $wrapper . $slideOutput . $wrapEnd;
	return $to_return;
}
add_shortcode('shortcode_blog', 'cws_shortcode_blog');

function cws_shortcode_carousel ( $atts = array(), $content){
	extract (shortcode_atts(array(
			'title' => '',
			'autoplay' => '',
			'autoplay_speed' => '1000',				
			'column' => '1',
		), $atts));

	$section_atts = ' data-carousel-column='. (int) $column;
	$section_atts .= ($autoplay == '1' && !empty( $autoplay_speed )) ? ' data-autoplay="'.$autoplay_speed.'"' : '';		
	$section_class = 'shortcode_carousel';	
	$section_class .= ($autoplay == '1') ? " autoplay" : "";

	$out .= "<div class='$section_class'" . ( ! empty( $section_atts ) ? $section_atts : '' ) . '>';
	$out .= !empty($title) ? "<div class='carousel_header clearfix'>" : "";
	$out .= !empty($title) ? "<div class='widget-title'>$title</div>" : "";
	$out .= !empty($title) ?"</div>" : "";
	$out .= "<div class='carousel_content'>" . do_shortcode( $content ) . "</div>";
	$out .= "</div>";
	return $out;
}
add_shortcode('shortcode_carousel', 'cws_shortcode_carousel');

function cws_testimonial_renderer($thumbnail, $text, $author) {
	ob_start();
	?>
	<div class="testimonial clearfix<?php echo $thumbnail ? '' : 'testimonial-alt' ?>">
		<div>
			<?php 

			if($thumbnail){
				$thumb_obj = bfi_thumb( $thumbnail, array("width"=>100), false );
				$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
				echo $thumbnail ? "<img ". $thumb_path_hdpi ." alt />" : "";
			}
			?>
			<p>
				<?php echo $text; ?>
			</p>
		</div>
		<div class="author">
			<?php echo $author ? $author : ""; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

if ( !function_exists ("cws_pricecol_renderer") ) {
	function cws_pricecol_renderer($args, $content) {
		$args = shortcode_atts(
			array(
				'ishilited' => false,
				'title' => '',
				'encouragement' => '',
				'currency' => '',
				'price' => '',
				'price_description' => '',
				'order_url' => '',
				'button_text' => '',
			), $args);
		extract ($args);
		$out = '';
		$out .= $ishilited ? '<div class="active-ribbon"></div>' : '';
		$out .= '<div>';
		$out .= '<div class="pricing_table_header">';
		empty($title) ? $out .= '' : $out .= '<div class="title">'. $title .'</div>';
		empty($encouragement) ? $out .= '' : $out .= '<div class="encouragement">'. $encouragement .'</div>';
		$out .= '</div>';
		$out .= '<div class="price_part">';
		(empty($currency) && empty($price) && empty($price_description)) ? $out .= '' : $out .= '<span class="price_container">';
		empty($currency) ? $out .= '' : $out .= '<span class="currency">'. $currency .'</span>';
		empty($price) ? $out .= '' : $out .= '<span class="price">'. $price .'</span>';
		empty($price_description) ? $out .= '' : $out .= '<span class="price_description">'. $price_description .'</span>';
		(empty($currency) && empty($price) && empty($price_description)) ? $out .= '' : $out .= '</span>';
		$out .= '</div>';
		$out .= '<div class="content_part">';
		$out .= do_shortcode($content);
		$out .= '</div>';
		$out .= '<div class="button_part"><a href="'. $order_url .'" class="cws_button button_text pricing_table_button">'. $button_text .'</div></a>';
		$out .= '</div>';
		return $out;
	}
}	
?>