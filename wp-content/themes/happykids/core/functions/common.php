<?php

	global $theme_options;

//preprocess shortcodes without striping out wpautop/wptexturize
	function pre_process_shortcode( $content, $shortcode_name = null, $shortcode_function = null ) {
		global $shortcode_tags;
		// Backup current registered shortcodes and clear them all out
		$orig_shortcode_tags = $shortcode_tags;
		$shortcode_tags = array();
		add_shortcode( $shortcode_name, $shortcode_function);
		// Do the shortcode (only the one above is registered)
		$content = do_shortcode($content);
		// Put the original shortcodes back
		$shortcode_tags = $orig_shortcode_tags;
		return $content;
	}

	// add_filter('the_content', 'pre_process_shortcode', 7);
//preprocess shortcode END

//get options from pages & posts metaboxes
	function theme_get_option($page, $name = NULL) {
		global $theme_options;
		if ($name != NULL && $name != 'gen_sets') {
			if (isset($theme_options[$page][$name])) {
				return $theme_options[$page][$name];
			} else {
				return false;
				// return 'no data here!';
			}
		}elseif($name == 'gen_sets'){
			if (isset($theme_options[$page])) {
				return $theme_options[$page];
			}else {
				return false;
			}
		}
	}

//get options END

	function theme_set_option($page, $name, $value) {
		global $theme_options;
		$theme_options[$page][$name] = $value;

		update_option(THEME_SLUG . '_' . $page, $theme_options[$page]);
	}

	function theme_is_enabled($value, $default = false) {
		if(is_bool($value)){
			return $value;
		}
		switch($value){
			case '1'://for theme compatibility
			case 'true':
				return true;
			case '-1'://for theme compatibility
			case 'false':
				return false;
			case '0':
			case '':
			default:
				return $default;
		}
	}

	function theme_get_excluded_pages(){
		$excluded_pages = theme_get_option('general', 'excluded_pages');
		$excluded_pages_with_childs = '';
		$home = theme_get_option('homepage','home_page');
		if (! empty($excluded_pages)) {
			foreach($excluded_pages as $parent_page_to_exclude) {
				if ($excluded_pages_with_childs) {
					$excluded_pages_with_childs .= ',' . $parent_page_to_exclude;
				} else {
					$excluded_pages_with_childs = $parent_page_to_exclude;
				}
				$descendants = get_pages('child_of=' . $parent_page_to_exclude);
				if ($descendants) {
					foreach($descendants as $descendant) {
						$excluded_pages_with_childs .= ',' . $descendant->ID;
					}
				}
			}
			if($home){
				$excluded_pages_with_childs .= ',' .$home;
			}
		} else {
			$excluded_pages_with_childs = $home;
		}
		return $excluded_pages_with_childs;
	}

	if(!function_exists("get_queried_object_id")){

		function get_queried_object_id(){
			global $wp_query;
			return $wp_query->get_queried_object_id();
		}
	}

	function is_blog() {
		global $is_blog;

		if($is_blog == true){return true;}
		$blog_page_id = theme_get_option('blog','blog_page');

		if(empty($blog_page_id)){
			return false;
		}

		if(wpml_get_object_id($blog_page_id,'page') == get_queried_object_id()){
			$is_blog = true;
			return true;
		}

		return false;
	}

	function is_shortcode_preview() {
		if(defined('DOING_AJAX') && isset($_GET['action']) && $_GET['action']=='theme-shortcode-preview'){
			return true;
		}else{
			return false;
		}
	}

	function theme_get_superlink($link, $default=false){
		if(!empty($link)){
			$link_array = explode('||',$link);
			switch($link_array[0]){
				case 'page':
					return get_page_link($link_array[1]);
				case 'cat':
					return get_category_link($link_array[1]);
				case 'post':
					return get_permalink($link_array[1]);
				case 'portfolio':
					return get_permalink($link_array[1]);
				case 'manually':
					return $link_array[1];
			}
		}
		return $default;
	}

	################################################################
	function theme_get_post_custom ( $id = null ){
		if( $id == null ){
			global $post;
			if($post){
				$id = $post->ID;
				}
		}

		if ($post_custom = get_post_custom($id)){
			$return_array = array();
			foreach ( $post_custom as $key => $value ){
				$return_array[$key] = $value[0];
			}
			return $return_array;
		}
	}

	function theme_search_form( $form ) {

	    $form = '<form role="search" id="search-form" method="get" action="' . home_url( '/' ) . '" >
					<input type="text" value="' . get_search_query() . '" name="s" id="s" />
					<input class="button medium button-style1" type="submit" id="search-submit" value="'. multitranslate(__("Search", 'happykids'), "_cws_search", false) .'" />
				</form>';

	    return $form;
	}

add_filter( 'get_search_form', 'theme_search_form' );

	function theme_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt);
	}
	add_filter('wp_trim_excerpt', 'theme_excerpt_more');

	function theme_widget_text_shortcode($content) {
		$content = do_shortcode($content);
		$new_content = '';
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ($pieces as $piece) {
			if (preg_match($pattern_contents, $piece, $matches)) {
				$new_content .= $matches[1];
			} else {
				$new_content .= do_shortcode($piece);
			}
		}

		return $new_content;
	}
	// Allow Shortcodes in Sidebar Widgets
	add_filter('widget_text', 'theme_widget_text_shortcode');

	function the_excerpt_max_charlength( $charlength, $echo = true  ){
		$excerpt = get_the_excerpt();
		$charlength++;

		if (!$echo){
			if ( strlen( $excerpt ) > $charlength ) {
				$subex = substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					return substr( $subex, 0, $excut );
				} else {
					return $subex .'...';
				}
					return '...';
			}else {
				return $excerpt;
			}
		}else{
			if ( strlen( $excerpt ) > $charlength ) {
				$subex = substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					echo substr( $subex, 0, $excut );
				} else {
					echo $subex .'...';
				}
					echo '...';
			}else{
				echo $excerpt;
			}
		}

	}

	//video functions
	function theme_youtube_parser( $content = null, $width = null, $height = null, $autoplay = null, $color = null, $theme = null ){
		$gen_sets = theme_get_option('general', 'gen_sets');
		$yt_color = isset( $gen_sets["_yt_color"] ) ? $gen_sets["_yt_color"] : '';
		$yt_theme = isset( $gen_sets["_yt_theme"] ) ? $gen_sets["_yt_theme"] : '';

		$content = trim($content);
		if(!$color) $color = 'white';
		if(!$theme) $theme = 'light';

		if($autoplay == 'on') $autoplay = 1;
		if(!$autoplay) $autoplay = 0;

		return '<iframe type="text/html" width="'. $width .'" height="'. $height .'" src="https://www.youtube-nocookie.com/embed/'. $content .'?wmode=transparent&autoplay='. $autoplay .'&color='. $color .'&theme='. $theme .'" frameborder="0" allowfullscreen></iframe>';
	}

	function theme_vimeo_parser( $content = null, $width = null, $height = null, $autoplay = null, $color = null, $title = null, $portrait = null, $badge = null ){
		$gen_sets = theme_get_option('general', 'gen_sets');
		$vim_color = isset( $gen_sets["_vim_color"] ) ? $gen_sets["_vim_color"] : '';

		$params = '';
		if ($title == 'on'){
			$params .= '?title=1';
		}else{
			$params .= '?title=0';
		}
		if ($color){
			$color = preg_replace('/^#/', '' , $color);
			$params .= '&amp;color=' . $color;
		}else{
			$params .= '&amp;color=508CF9';
		}
		if ($autoplay == 'on'){
			$params .= '&amp;autoplay=1';
		}else{
			$params .= '&amp;autoplay=0';
		}
		if ($portrait == 'on'){
		$params .= '&amp;portrait=1';
		}else{
		$params .= '&amp;portrait=0';
		}
		if ($badge == 'on'){
			$params .= '&amp;badge=1';
		}else{
			$params .= '&amp;badge=0';
		}
		$content = trim($content);
		return '<iframe width="'. $width .'" height="'. $height .'" src="http://player.vimeo.com/video/'. $content . $params  .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	}
	//video functions END

	function tiny_output($output){
		if ($output){
			$output = stripslashes($output);
			$output = do_shortcode($output);
			// $output = my_formatter($output);
			echo $output;
		}
	}

	function findchild($term, $taxonomy){
		$terms = get_term_by('slug', $term, $taxonomy);
		$children = get_term_children($terms->term_id, $taxonomy);

		return $children;
	}

	function theme_getImgSrc( $src )
	{
		$html = $src;
		$expression = '/<img[^>]+src=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/';

		preg_match_all( $expression, $html, $matches );

		$url_list = array();
		foreach ($matches[2] as $key => $value) {
			if (($value && strpos($value, '.jpg'))||($value && strpos($value, '.png'))||($value && strpos($value, '.gif'))) {
				$url_list[] = $value;
			}
		}

		return $url_list;
	}

	add_filter('post_gallery', 'cws_rgallery', 10, 2);

	function cws_rgallery($output, $attr){
	    global $post, $wp_locale;

	    static $instance = 0;
	    $instance++;

	    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	    if ( isset( $attr['orderby'] ) ) {
	        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	        if ( !$attr['orderby'] )
	            unset( $attr['orderby'] );
	    }

	    extract(shortcode_atts(array(
	        'order'      => 'ASC',
	        'orderby'    => 'menu_order ID',
	        'id'         => $post ? $post->ID : 0,
	        'link'		 => '',
	        'itemtag'    => 'dl',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 4,
	        'size'       => 'medium',
	        'include'    => '',
	        'exclude'    => ''
	    ), $attr));

	    $id = intval($id);
	    if ( 'RAND' == $order )
	        $orderby = 'none';

	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }

	    if ( empty($attachments) )
	        return '';

	    if ( is_feed() ) {
	        $output = "\n";
	        foreach ( $attachments as $att_id => $attachment )
	            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
	        return $output;
	    }

	    $itemtag = tag_escape($itemtag);
	    $captiontag = tag_escape($captiontag);
	    $columns = intval($columns);
	    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	    $float = is_rtl() ? 'right' : 'left';

	    $selector = "ngallery-{$instance}";

	    $output = apply_filters('gallery_style', "
	        <style type='text/css'>
	            .ngallery{
					margin-left: -2%;
				}
				.ngallery dd{
					margin-bottom: 0;
				}
				.ngallery .content-wrapper figure,
				.ngallery .content-wrapper figure img{
					width: 100%;
					margin: 0;
					box-sizing: border-box;
					-webkit-box-sizing: border-box;
					-moz-box-sizing: border-box;
					-ms-box-sizing: border-box;
				}
				.ngallery .content-wrapper figure>a{
					display:block;
				}
				.ngallery>.gallery-item{
					float: left;
					margin-left: 2%;
					margin-bottom: 2%;
				}
				.ngallery.column-1>.gallery-item{
					width: 98%;
				}
				.ngallery.column-2>.gallery-item{
					width: 48%;
				}
				.ngallery.column-3>.gallery-item{
					width: 31.333%;
				}
				.ngallery.column-4>.gallery-item{
					width: 23%;
				}
				.ngallery.column-5>.gallery-item{
					width: 18%;
				}
				.ngallery.column-6>.gallery-item{
					width: 14.66%;
				}
				.ngallery.column-7>.gallery-item{
					width: 12.28%;
				}
				.ngallery.column-8>.gallery-item{
					width: 10.5%;
				}
				.ngallery.column-9>.gallery-item{
					width: 9.11%;
				}

				.ngallery.column-2>.gallery-item:nth-child(2n+3),
				.ngallery.column-3>.gallery-item:nth-child(3n+4),
				.ngallery.column-4>.gallery-item:nth-child(4n+5),
				.ngallery.column-5>.gallery-item:nth-child(5n+6),
				.ngallery.column-6>.gallery-item:nth-child(6n+7),
				.ngallery.column-7>.gallery-item:nth-child(7n+8),
				.ngallery.column-8>.gallery-item:nth-child(8n+9),
				.ngallery.column-9>.gallery-item:nth-child(9n+10){
					clear: left;
				}

				@media screen and (max-width: 980px){
					.ngallery.column-5>.gallery-item,
					.ngallery.column-6>.gallery-item,
					.ngallery.column-7>.gallery-item,
					.ngallery.column-8>.gallery-item,
					.ngallery.column-9>.gallery-item{
						width: 23%;
					}
					.ngallery.column-5>.gallery-item:nth-child(5n+6),
					.ngallery.column-6>.gallery-item:nth-child(6n+7),
					.ngallery.column-7>.gallery-item:nth-child(7n+8),
					.ngallery.column-8>.gallery-item:nth-child(8n+9),
					.ngallery.column-9>.gallery-item:nth-child(9n+10){
						clear: none;
					}
					.ngallery.column-5>.gallery-item:nth-child(4n+5),
					.ngallery.column-6>.gallery-item:nth-child(4n+5),
					.ngallery.column-7>.gallery-item:nth-child(4n+5),
					.ngallery.column-8>.gallery-item:nth-child(4n+5),
					.ngallery.column-9>.gallery-item:nth-child(4n+5){
						clear: left;
					}
				}
				@media screen and (max-width: 767px){
					.ngallery{
						margin-left: 0;
					}
					.ngallery.column-2>.gallery-item,
					.ngallery.column-3>.gallery-item,
					.ngallery.column-4>.gallery-item,
					.ngallery.column-5>.gallery-item,
					.ngallery.column-6>.gallery-item,
					.ngallery.column-7>.gallery-item,
					.ngallery.column-8>.gallery-item,
					.ngallery.column-9>.gallery-item{
						width: 100%;
						margin-left: 0;
					}
					.ngallery.column-3>.gallery-item:nth-child(4n+5),
					.ngallery.column-4>.gallery-item:nth-child(4n+5),
					.ngallery.column-5>.gallery-item:nth-child(4n+5),
					.ngallery.column-6>.gallery-item:nth-child(4n+5),
					.ngallery.column-7>.gallery-item:nth-child(4n+5),
					.ngallery.column-8>.gallery-item:nth-child(4n+5),
					.ngallery.column-9>.gallery-item:nth-child(4n+5){
						clear: none;
					}
					.ngallery.column-3>.gallery-item:nth-child(2n+3),
					.ngallery.column-4>.gallery-item:nth-child(2n+3),
					.ngallery.column-5>.gallery-item:nth-child(2n+3),
					.ngallery.column-6>.gallery-item:nth-child(2n+3),
					.ngallery.column-7>.gallery-item:nth-child(2n+3),
					.ngallery.column-8>.gallery-item:nth-child(2n+3),
					.ngallery.column-9>.gallery-item:nth-child(2n+3){
						clear: left !important;
					}


				}
	        </style>
	        <!-- see gallery_shortcode() in wp-includes/media.php -->
	        <div id='$selector' class='ngallery clearfix column-".$columns." galleryid-{$id}'>");

	    $i = 0;

	    $rand = rand(1,200);

	    foreach ( $attachments as $id => $attachment ) {
	        $thumb_link = wp_get_attachment_image_src($id, $size);
	        $full_link = isset($attr['link']) ? wp_get_attachment_url( $id ) : wp_get_attachment_url( $id );
	        $id = $post ? $post->ID : '0';
	        switch ($link) {
	        	case 'none':
	        		$img_link = '<img src="'.$thumb_link[0].'" alt="" />';
	        		break;
	        	case 'file':
	        		$img_link = '<a href="'.$full_link.'"><img src="'.$thumb_link[0].'" alt="" /></a>';
	        		break;
	        	default:
	        		$img_link = '<a href="'.$full_link.'" data-rel="prettyPhoto['. $id.$rand.']" class="prettyPhoto kids_picture">
	        			<img src="'.$thumb_link[0].'" alt="" /></a>';
	        		break;
	        }

	        $output .= "<{$itemtag} class='gallery-item'>";
	        $output .= "
	            <{$icontag} class='gallery-icon '>
	            	<div class='content-wrapper'>
	            		<figure>
	                		$img_link
	            		</figure>
	                </div>
	            </{$icontag}>";
	        if ( $captiontag && trim($attachment->post_excerpt) ) {
	            $output .= "
	                <{$captiontag} class='gallery-caption'>
	                " . wptexturize($attachment->post_excerpt) . "
	                </{$captiontag}>";
	        }
	        $output .= "</{$itemtag}>";
	    }

	    $output .= "
	        </div>\n";

	    return $output;
	}

?>