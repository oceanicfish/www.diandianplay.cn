<?php
/**
 * Theme Functions file.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 1.0
 * @version     3.3.6
 */

	define('THEME_COLOR', '#8fc0ea');
	define('THEME_COLOR_2', '#fcf5d5');
	define('THEME_COLOR_3', '#fee6b4');
	define('THEME_COLOR_FOOTER', '#3185cb');
	define('THEME_COLOR_MENU', '#3185cb');
	define('THEME_COLOR_MENU_HOVER', '#ff633c');

// Localization
	load_theme_textdomain('happykids', get_template_directory() . '/languages');

	if ( ! isset( $content_width ) ) $content_width = 896;
	require_once (TEMPLATEPATH . '/core/core.php'); //Main theme ini file

	$core = new cwsPrime();
	$core->init(array(
					'name' => 'HappyKids',
					'slug' => 'happykids',
					'version' => '3.0',
	));

// Check if WooCommerce is active
	if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
		require_once (TEMPLATEPATH . '/woocommerce/wooinit.php'); //WooCommerce Shop ini file
	};

// CWS PB settings
	function cws_get_pb_options() {
		return array(
			'modules' => array('text', 'tabs', 'accs', 'tcol', 'callout'),
			'callout' => array(
				'options' => array (
					'icon_selection' => true,
					)
			),
			'accs-title' => array(
			  'layout' => array(
			   'title' => array (
			    'title' => 'Title',
			    'type' => 'text',
			   ),
			   'istoggle' => array(
			    'title' => 'This is toggle:',
			    'type' => 'checkbox',
			   ),			   
			  )
			),				
		);
	}

// Add page titles

	function cws_wp_title_filter ( $title_text ) {
		$site_name = get_bloginfo( 'name' );
		$site_tagline = get_bloginfo( 'description' );
		if ( is_home() ) {
			$title_text = $site_name . " | " . $site_tagline;
		} else {
			$title_text .= $site_name;
		}
		return $title_text;
	}

	add_filter('wp_title', 'cws_wp_title_filter');


// clear <p>
	function cws_fix_shortcodes_autop($content){
				$array = array (
								'<p>[' => '[',
								']</p>' => ']',
								']<br />' => ']'
				);

				$content = strtr($content, $array);
				return $content;
	}
	add_filter('the_content', 'cws_fix_shortcodes_autop');

	add_filter( 'pre_set_site_transient_update_themes', 'cws_check_for_update' );

	function cws_check_for_update($transient) {
		if (empty($transient->checked)) { return $transient; }
		$gen_sets = theme_get_option('general', 'gen_sets');

		$theme_pc = isset($gen_sets['_theme_purchase_code']) ? $gen_sets['_theme_purchase_code'] : '';
		if (empty($theme_pc)) {
			add_action( 'admin_notices', 'cws_an_purchase_code' );
		}

		$result = wp_remote_get('http://up.creaws.com/products-updater.php?pc=' . $theme_pc . '&tname=' . THEME_SLUG);
		if (!is_wp_error( $result ) ) {
			if (200 == $result['response']['code'] && 0 != strlen($result['body']) ) {
				$resp = json_decode($result['body'], true);
				$theme = wp_get_theme(get_template());
				if ( version_compare( $theme->get('Version'), $resp['new_version'], '<' ) ) {
					$transient->response[THEME_SLUG] = $resp;
				}
			} else {
				unset($transient->response[THEME_SLUG]);
			}
		}
		return $transient;
	}

	function cws_an_purchase_code() {
		echo "<div class='update-nag'>".__('HappyKids theme notice: Please insert your Item Purchase Code to get the latest theme updates!', 'happykids') ."</div>";
	}

	require_once(TEMPLATEPATH . '/core/admin/shortcodes/shortcodes.php');

// Require installing pre-installed plugins
	require_once(TEMPLATEPATH . '/core/plugins.php');

// Custom color picker

	function cws_process_custom_theme_colors() {
	$gen_sets = theme_get_option('general', 'gen_sets');
	$new_css = file_get_contents( THEME_DIR . '/front/css/dynamic.css');
// colors
	$theme_c = isset($gen_sets['_theme_skin_color']) ? $gen_sets['_theme_skin_color'] : THEME_COLOR;
	$theme_c_s = isset($gen_sets['_theme_skin_second_color']) ? $gen_sets['_theme_skin_second_color'] : THEME_COLOR_2;
	$theme_c_t = isset($gen_sets['_theme_skin_third_color']) ? $gen_sets['_theme_skin_third_color'] : THEME_COLOR_3;
	$theme_c_f = isset($gen_sets['_theme_footer_color']) ? $gen_sets['_theme_footer_color'] : THEME_COLOR_FOOTER;
	$theme_c_m = isset($gen_sets['_theme_menu_color']) ? $gen_sets['_theme_menu_color'] : THEME_COLOR_MENU;
	$theme_c_m_h = isset($gen_sets['_theme_menu_hover_color']) ? $gen_sets['_theme_menu_hover_color'] : THEME_COLOR_MENU_HOVER;

	$replacements = array(
		'#cws_theme_color#' => $theme_c,
		'#cws_theme_color_rgb#' => cws_Hex2RGB($theme_c),
		'#cws_theme_color_middle#' => $theme_c_s,
		'#cws_theme_color_middle_rgb#' => cws_Hex2RGB($theme_c_s),
		'#cws_theme_color_middle_helper#' => $theme_c_t,
		'#cws_theme_color_middle_helper_rgb#' => cws_Hex2RGB($theme_c_t),
		'#cws_footer_color#' => $theme_c_f,
		'#cws_footer_color_rgb#' => cws_Hex2RGB($theme_c_f),
		'#cws_menu_color#' => $theme_c_m,
		'#cws_menu_color_rgb#' => cws_Hex2RGB($theme_c_m),
		'#cws_menu_color_hover#' => $theme_c_m_h,
		'#cws_menu_color_hover_rgb#' => cws_Hex2RGB($theme_c_m),
		'#cws_icon_long_shadow_rgb#' => cws_text_shadow_gen($theme_c_m)
	);
	foreach ( $replacements as $k => $v ){
		$new_css = str_replace( $k, $v, $new_css );
	}

// fonts
	$menu_gfont = ( isset($gen_sets['_menu_gfont']) ) ? $gen_sets['_menu_gfont'] : 'Lobster Two';
	$menu_font_color = isset($gen_sets['_menu_gfont-color']) ? $gen_sets['_menu_gfont-color'] : '#fff';
	$menu_font_subset = isset($gen_sets['_menu_gfont-subset']) ? $gen_sets['_menu_gfont-subset'] : 'latin';
	$menu_font_variant = isset($gen_sets['_menu_gfont-variant']) ? $gen_sets['_menu_gfont-variant'] : '400';
	$menu_font_size = isset($gen_sets['_menu_gfont-font_size']) ? $gen_sets['_menu_gfont-font_size'] : 19;
	$menu_line_height = isset($gen_sets['_menu_gfont-line_height']) ? $gen_sets['_menu_gfont-line_height'] : 1.5;

	$headers_gfont = ( isset($gen_sets['_headers_gfont']) ) ? $gen_sets['_headers_gfont'] : 'Lobster Two';
	$headers_font_color = isset($gen_sets['_headers_gfont-color']) ? $gen_sets['_headers_gfont-color'] : '#3185cb';
	$headers_font_subset = isset($gen_sets['_headers_gfont-subset']) ? $gen_sets['_headers_gfont-subset'] : 'latin';
	$headers_font_variant = isset($gen_sets['_headers_gfont-variant']) ? $gen_sets['_headers_gfont-variant'] : '400';
	$headers_font_size = isset($gen_sets['_headers_gfont-font_size']) ? $gen_sets['_headers_gfont-font_size'] : 32;
	$headers_line_height = isset($gen_sets['_headers_gfont-line_height']) ? $gen_sets['_headers_gfont-line_height'] : 1.125;

	$text_gfont = ( isset($gen_sets['_text_gfont']) ) ? $gen_sets['_text_gfont'] : '';
	$text_font_color = isset($gen_sets['_text_gfont-color']) ? $gen_sets['_text_gfont-color'] : '#a2825c';
	$text_font_subset = isset($gen_sets['_text_gfont-subset']) ? $gen_sets['_text_gfont-subset'] : 'latin';
	$text_font_variant = isset($gen_sets['_text_gfont-variant']) ? $gen_sets['_text_gfont-variant'] : '400';
	$text_font_size = isset($gen_sets['_text_gfont-font_size']) ? $gen_sets['_text_gfont-font_size'] : 16;
	$text_line_height = isset($gen_sets['_text_gfont-line_height']) ? $gen_sets['_text_gfont-line_height'] : 1.375;

	$import = cws_fonts_buil_import($menu_gfont, $menu_font_variant, $menu_font_subset);
	$import .= cws_fonts_buil_import($headers_gfont, $headers_font_variant, $headers_font_subset);
	$import .= cws_fonts_buil_import($text_gfont, $text_font_variant, $text_font_subset);

	$replacements = array(
		'#cws_menu_font_family#' => $menu_gfont . (strpos($menu_font_variant, 'talic') ? '; font-style: italic' : ''),
		'#cws_menu_font_color#' => $menu_font_color,
		'#cws_menu_font_size#' => $menu_font_size,
		'#cws_menu_line_height#' => $menu_line_height,

		'#headers_font_family#' => $headers_gfont . (strpos($headers_font_variant, 'talic') ? '; font-style: italic' : ''),
		'#headers_font_color#' => $headers_font_color,
		'#headers_font_size#' => $headers_font_size,
		'#headers_line_height#' => $headers_line_height,

		'#text_font_family#' => $text_gfont . (strpos($text_font_variant, 'talic') ? '; font-style: italic' : ''),
		'#text_font_color#' => $text_font_color,
		'#text_font_size#' => $text_font_size,
		'#text_line_height#' => $text_line_height
	);
	foreach ( $replacements as $k => $v ){
		$new_css = str_replace( $k, $v, $new_css );
	}

	$pretty_social = isset($gen_sets['_pretty_social']) ? $gen_sets['_pretty_social'] : '';
	$_custom_pattern = isset($gen_sets['_theme_load_pattern']) ? $gen_sets['_theme_load_pattern'] : '';
	$is_c_pattern_hdpi = isset($gen_sets['_theme_load_pattern-ppi']) ? $gen_sets['_theme_load_pattern-ppi'] : '';
	$_custom_pattern_header = isset($gen_sets['_theme_header_pattern']) ? $gen_sets['_theme_header_pattern'] : '';
	$is_c_p_header_hdpi = isset($gen_sets['_theme_header_pattern-ppi']) ? $gen_sets['_theme_header_pattern-ppi'] : '';
	$_custom_footer_image = isset($gen_sets['_theme_footer_image']) ? $gen_sets['_theme_footer_image'] : '';
	$is_c_f_img_hdpi = isset($gen_sets['_theme_footer_image-ppi']) ? $gen_sets['_theme_footer_image-ppi'] : '';
	$_custom_footer_padding = isset($gen_sets['_footer_padding']) ? $gen_sets['_footer_padding'] : '';


	if (!$pretty_social) $new_css .= ".pp_social {display:none;}\n";
	if ($_custom_footer_padding) $new_css .= ".page-content .container {padding-bottom: ". $_custom_footer_padding ."px;}\n";
	if ($_custom_footer_padding) $new_css .= ".kids_bottom_content .content_bottom_bg{height:". $_custom_footer_padding ."px}\n";

	if ($_custom_pattern && $is_c_pattern_hdpi) {
		$new_css.= ".t-custom-pattern .bg-level-2 {background-image: url(". cws_hdpi_to_ldpi_url($_custom_pattern, true) .");}\n";
	}elseif ($_custom_pattern){
		$new_css .= ".t-custom-pattern .bg-level-2 {background-image: url(". $_custom_pattern .");}\n";
	}

	if ($_custom_pattern_header && $is_c_p_header_hdpi) {
		$new_css .= ".bg-level-1 {background-image: url(". cws_hdpi_to_ldpi_url($_custom_pattern_header, true) .");}\n";
	}elseif ($_custom_pattern_header) {
		$new_css .= ".bg-level-1 {background-image: url(". $_custom_pattern_header .");}\n";
	}

	if ($_custom_footer_image && $is_c_f_img_hdpi) {
		$new_css .= ".kids_bottom_content .content_bottom_bg {background-image: url(". cws_hdpi_to_ldpi_url($_custom_footer_image, true) .");}\n";
	}elseif ($_custom_footer_image) {
		$new_css .= ".kids_bottom_content .content_bottom_bg {background-image: url(". $_custom_footer_image .");}\n";
	}

	/* retina ready */
	if ($is_c_pattern_hdpi || $is_c_p_header_hdpi || $is_c_f_img_hdpi) {	
		$new_css.= '@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
					only screen and (min--moz-device-pixel-ratio: 1.5),
					only screen and (-o-device-pixel-ratio: 3/2), 
					only screen and (min-device-pixel-ratio: 1.5) {';

						if ($_custom_pattern && $is_c_pattern_hdpi) $new_css.= ".t-custom-pattern .bg-level-2 {background-image: url(". $_custom_pattern ."); background-size: ". cws_hdpi_bg_size($_custom_pattern) ."px; }\n";
						if ($_custom_pattern_header && $is_c_p_header_hdpi) $new_css .= ".bg-level-1 {background-image: url(". $_custom_pattern_header ."); background-size: ". cws_hdpi_bg_size($_custom_pattern_header) ."px;}\n";
						if ($_custom_footer_image && $is_c_f_img_hdpi) $new_css .= ".kids_bottom_content .content_bottom_bg {background-image: url(". $_custom_footer_image ."); background-size: ". cws_hdpi_bg_size($_custom_footer_image) ."px;}\n";
		$new_css.= '}';
	}

	return ($import . $new_css);
	}

function cws_hdpi_to_ldpi_url($url, $bg_retina){
	$width = cws_get_img_width($url);
	$img_width = floor($width/2);
	$img_settings = array( 'width' => $img_width, 'crop' => true );
	if ($bg_retina) {
		$thumb_obj = bfi_thumb($url, $img_settings);
		$url = $thumb_obj[0];
	} else {
		$thumb_obj = bfi_thumb( $url, $img_settings, false );
		$url = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";	
	}

	return $url;
}

function cws_hdpi_bg_size($url){
	$width = cws_get_img_width($url);
	$img_width = floor($width/2);
	return $img_width;
}

function cws_get_img_width($url){
 	$p_id = attachment_url_to_postid($url);
 	list($src, $width, $height) = wp_get_attachment_image_src( $p_id, 'full', false );
	return $width;
}

function cws_Hex2RGB($hex) {
		$hex = str_replace('#', '', $hex);
		$color = '';

		if(strlen($hex) == 3) {
			$color = hexdec(substr($hex, 0, 1)) . ',';
			$color .= hexdec(substr($hex, 1, 1)) . ',';
			$color .= hexdec(substr($hex, 2, 1));
		}
		else if(strlen($hex) == 6) {
			$color = hexdec(substr($hex, 0, 2)) . ',';
			$color .= hexdec(substr($hex, 2, 2)) . ',';
			$color .= hexdec(substr($hex, 4, 2));
		}
		return $color;
	}

function cws_text_shadow_gen($hex) {
		$hex = str_replace('#', '', $hex);
		$color = '';

		if(strlen($hex) == 3) {
			$color = round(0.8*(hexdec(substr($hex, 0, 1)))) . ',';
			$color .= round(0.8*(hexdec(substr($hex, 1, 1)))) . ',';
			$color .= round(0.8*(hexdec(substr($hex, 2, 1))));
		}
		else if(strlen($hex) == 6) {
			$color = round(0.8*(hexdec(substr($hex, 0, 2)))) . ',';
			$color .= round(0.8*(hexdec(substr($hex, 2, 2)))) . ',';
			$color .= round(0.8*(hexdec(substr($hex, 4, 2))));
		}
		return $color;
	}

function cws_text_shadow_gen_mask($hex) {
		$hex = str_replace('#', '', $hex);
		$color = '';
		$coef = 0.85;

		if(strlen($hex) == 3) {
			$color = round($coef*(230+round((hexdec(substr($hex, 0, 1)))/10) ) ) . ',';
			$color .= round($coef*(230+round((hexdec(substr($hex, 1, 1)))/10) ) ) . ',';
			$color .= round($coef*(230+round((hexdec(substr($hex, 2, 1)))/10) ) );
		}
		else if(strlen($hex) == 6) {
			$color = round($coef*(230+round((hexdec(substr($hex, 0, 2)))/10) ) ) . ',';
			$color .= round($coef*(230+round((hexdec(substr($hex, 2, 2)))/10) ) ) . ',';
			$color .= round($coef*(230+round((hexdec(substr($hex, 4, 2)))/10) ) );
		}
		return $color;
	}

if (!function_exists('cws_fonts_buil_import')) {
	function cws_fonts_buil_import($f_family, $f_weight, $f_subset) {
			$standard_fonts = array('Arial', 'Tahoma', 'Verdana', 'Georgia', 'FreeSans', 'Lucida Sans Unicode', 'Trebuchet MS');
			$f_import = '';
			if ( ! in_array($f_family, $standard_fonts)){
				$f_family = str_replace(' ', '+' , $f_family);
				$f_weight = $f_weight ? ':' . $f_weight : '';
				$f_subset = $f_subset ? '&subset=' . $f_subset : '';
				$f_import = "@import url(//fonts.googleapis.com/css?family=" . $f_family . $f_weight . $f_subset . ");\n";
			}
			return $f_import;
		}
}

add_action('wp_head','hook_custom_css');

function hook_custom_css() {
	echo ('<style type="text/css">' . cws_process_custom_theme_colors() . '</style>');
	echo '<link rel="stylesheet" type="text/css" media="all" href="' . get_bloginfo( 'stylesheet_url' ) . '" />';	
	echo ("<script type='text/javascript'>
			function is_touch_device() {
					return (('ontouchstart' in window)
										|| (navigator.MaxTouchPoints > 0)
										|| (navigator.msMaxTouchPoints > 0));
				}
			if(jQuery('html').hasClass('touch_detect_on')){ if (is_touch_device()) {jQuery('html').addClass('touch_device');}else{jQuery('html').removeClass('touch_device');}}
		</script>"
	);
}

function cws_widget_icon_selection ($args){
	extract($args);
	ob_start(); ?>
	<section class="icon-options" <?php echo ((isset($show_icon_options)) && ($show_icon_options == "on")) ? "" : $display_none; ?>>
		<ul class="redux-image-select">
		<li class="redux-image-select <?php echo $title_select == 'fa' ? 'selected' : '' ?>">
			<input id="<?php echo $_this->get_field_id('fa'); ?>" name="<?php echo $_this->get_field_name('title_select'); ?>" type="radio" value="fa"  <?php echo $title_select == 'fa'  ? 'checked' : '' ?>><i class="fa fa-flag fa-2x"></i></li>
		<li class="redux-image-select <?php echo $title_select == 'img' ? 'selected' : '' ?>">
			<input id="<?php echo $_this->get_field_id('img'); ?>" name="<?php echo $_this->get_field_name('title_select'); ?>" type="radio" value="img" <?php echo $title_select == 'img' ? 'checked' : '' ?>><i class="fa fa-picture-o fa-2x"></i></li>
		</ul>
		<div class='image-part'>
			<div class="img-wrapper" <?php echo $title_select != 'fa' ? $display_none : '' ?>>
				<select class="icons" placeholder="<?php _e('Pick an icon for this widget', 'happykids'); ?>" data-placeholder="<?php _e('Pick an icon for this widget', 'happykids'); ?>" name="<?php echo $_this->get_field_name('title_fa'); ?>" id="<?php echo $_this->get_field_id('title_fa'); ?>">
					<?php
						echo cws_print_fa_select($title_fa);
					?>
				</select>
			</div>
			<div class="img-wrapper" <?php echo $title_select != 'img' ? $display_none : '' ?>>
				<p>
				<a id="media-<?php echo $_this->get_field_id('title_img'); ?>" <?php echo $title_img ? $display_none : ''; ?>><?php _e('Click here to select image', 'happykids'); ?></a>
				<a id="remov-<?php echo $_this->get_field_id('title_img'); ?>" <?php echo !$title_img ? $display_none : ''; ?>><?php _e('Remove this image', 'happykids'); ?></a>
				<input class="image" style="visibility:hidden;" readonly id="<?php echo $_this->get_field_id('title_img'); ?>" name="<?php echo $_this->get_field_name('title_img'); ?>" type="text" value="<?php echo esc_attr($title_img); ?>" />
				<img id="img-<?php echo $_this->get_field_id('title_img'); ?>" src<?php echo $thumb_url; ?> alt />
				</p>
			</div>
		</div>
		<div>
			<a class="reset_icon_options"><?php _e("Reset icon options", 'happykids'); ?></a>
		</div>
	</section>
	<?php ob_end_flush();
}

function cws_print_fa_select($fa_selected = '') {
	$output = '<option value=""></option>';
	$icons = get_all_fa_icons();
	foreach ($icons as $icon) {
		$selected = $icon == $fa_selected ? ' selected="selected"' : '';
		$output .= '<option value="' . $icon . '"' . $selected . '>' . $icon . '</option>';
	}
	return $output;
}

function cws_widget_icon_rendering ($args){
	extract($args);
	if (($title_select == 'fa') && (!empty($title_fa))) {
		echo '<div class="widget-icon icon"><i class="fa fa-' . $title_fa .' fa-3x"><span class="triangle"></span></i></div>';
	} else if (($title_select == 'img') && (!empty($title_img))) {

		$img_settings = array( 'width' => 88, 'crop' => true );
		$url = wp_get_attachment_url( $title_img );
		$thumb_obj = bfi_thumb( $url, $img_settings, false );
		$url = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
		echo '<div class="widget-icon pic"><img ' . $url . ' alt=""/></div>';
	}
}

// Get the tweets
require_once('core/functions/TwitterOAuth.php');

function cws_getTweets($count = 20) {
	$gen_sets = theme_get_option('general', 'gen_sets');
	$ck = isset($gen_sets['twt_ck']) ? $gen_sets['twt_ck'] : '';
	$cs = isset($gen_sets['twt_cs']) ? $gen_sets['twt_cs'] : '';
	$ut = isset($gen_sets['twt_ut']) ? $gen_sets['twt_ut'] : '';
	$us = isset($gen_sets['twt_us']) ? $gen_sets['twt_us'] : '';

	if (empty($ck) || empty($cs) || empty($ut) || empty($us)) {
		$res = null;
	} else {
		$config = array(
			'consumer_key' => trim( $gen_sets['twt_ck'] ),
			'consumer_secret' => trim( $gen_sets['twt_cs'] ),
			'oauth_token' => trim( $gen_sets['twt_ut'] ),
			'oauth_token_secret' => trim( $gen_sets['twt_us'] ),
			'output_format' => 'object'
		);

		// Instantiate TwitterOAuth class with set tokens
		$tw = new TwitterOAuth($config);
		$custom_usr_name = isset($gen_sets['twt_name']) ? $gen_sets['twt_name'] : '';
		$username = empty($custom_usr_name) ? false : $custom_usr_name;
		$params = array(
			'screen_name' => $username,
			'count' => $count,
			'exclude_replies' => false
		);
		$res = $tw->get('statuses/user_timeline', $params);
	}
	return $res;
}

// Check if WPML is active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') ){
	define('CWS_WPML_ACTIVE', true);
	$GLOBALS["wpml_settings"] = get_option("icl_sitepress_settings");
	global $icl_language_switcher;
}

function cws_is_wpml_active (){
	return defined("CWS_WPML_ACTIVE") && CWS_WPML_ACTIVE;
}


function cws_get_date_part ( $part = '' ){
	$part_val = '';
	$p_id = get_queried_object_id();
	$perm_struct = get_option( 'permalink_structure' );
	$use_perms = !empty( $perm_struct );
	$merge_date = get_query_var( 'm' );
	$match = preg_match( '#(\d{4})?(\d{1,2})?(\d{1,2})?#', $merge_date, $matches );
	switch ( $part ){
		case 'y':
			$part_val = $use_perms ? get_query_var( 'year' ) : ( isset( $matches[1] ) ? $matches[1] : '' );
			break;
		case 'm':
			$part_val = $use_perms ? get_query_var( 'monthnum' ) : ( isset( $matches[2] ) ? $matches[2] : '' );
			break;
		case 'd':
			$part_val = $use_perms ? get_query_var( 'day' ) : ( isset( $matches[3] ) ? $matches[3] : '' );
			break;
	}
	return $part_val;
}

add_filter( 'mce_buttons_2', 'happykids_mce_buttons_2' );

function happykids_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter( 'tiny_mce_before_init', 'happykids_tiny_mce_before_init' );

function happykids_tiny_mce_before_init( $settings ) {

	$settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';

	$style_formats = array(
	array( 'title' => 'HappyKids title', 'block' => 'div', 'classes' => 'widget-title'),
	array( 'title' => 'Borderless image', 'selector' => 'img', 'classes' => 'noborder' ),
	);
	// Before 3.1 you needed a special trick to send this array to the configuration.
	// See this post history for previous versions.
	$settings['style_formats'] = str_replace( '"', "'", json_encode( $style_formats ) );

	return $settings;
}

function get_all_fa_icons() {
	$faIcons = array(
"glass",
"music",
"search",
"envelope-o",
"heart",
"star",
"star-o",
"user",
"film",
"th-large",
"th",
"th-list",
"check",
"times",
"search-plus",
"search-minus",
"power-off",
"signal",
"cog",
"trash-o",
"home",
"file-o",
"clock-o",
"road",
"download",
"arrow-circle-o-down",
"arrow-circle-o-up",
"inbox",
"play-circle-o",
"repeat",
"refresh",
"list-alt",
"lock",
"flag",
"headphones",
"volume-off",
"volume-down",
"volume-up",
"qrcode",
"barcode",
"tag",
"tags",
"book",
"bookmark",
"print",
"camera",
"font",
"bold",
"italic",
"text-height",
"text-width",
"align-left",
"align-center",
"align-right",
"align-justify",
"list",
"outdent",
"indent",
"video-camera",
"picture-o",
"pencil",
"map-marker",
"adjust",
"tint",
"pencil-square-o",
"share-square-o",
"check-square-o",
"arrows",
"step-backward",
"fast-backward",
"backward",
"play",
"pause",
"stop",
"forward",
"fast-forward",
"step-forward",
"eject",
"chevron-left",
"chevron-right",
"plus-circle",
"minus-circle",
"times-circle",
"check-circle",
"question-circle",
"info-circle",
"crosshairs",
"times-circle-o",
"check-circle-o",
"ban",
"arrow-left",
"arrow-right",
"arrow-up",
"arrow-down",
"share",
"expand",
"compress",
"plus",
"minus",
"asterisk",
"exclamation-circle",
"gift",
"leaf",
"fire",
"eye",
"eye-slash",
"exclamation-triangle",
"plane",
"calendar",
"random",
"comment",
"magnet",
"chevron-up",
"chevron-down",
"retweet",
"shopping-cart",
"folder",
"folder-open",
"arrows-v",
"arrows-h",
"bar-chart",
"twitter-square",
"facebook-square",
"camera-retro",
"key",
"cogs",
"comments",
"thumbs-o-up",
"thumbs-o-down",
"star-half",
"heart-o",
"sign-out",
"linkedin-square",
"thumb-tack",
"external-link",
"sign-in",
"trophy",
"github-square",
"upload",
"lemon-o",
"phone",
"square-o",
"bookmark-o",
"phone-square",
"twitter",
"facebook",
"github",
"unlock",
"credit-card",
"rss",
"hdd-o",
"bullhorn",
"bell",
"certificate",
"hand-o-right",
"hand-o-left",
"hand-o-up",
"hand-o-down",
"arrow-circle-left",
"arrow-circle-right",
"arrow-circle-up",
"arrow-circle-down",
"globe",
"wrench",
"tasks",
"filter",
"briefcase",
"arrows-alt",
"users",
"link",
"cloud",
"flask",
"scissors",
"files-o",
"paperclip",
"floppy-o",
"square",
"bars",
"list-ul",
"list-ol",
"strikethrough",
"underline",
"table",
"magic",
"truck",
"pinterest",
"pinterest-square",
"google-plus-square",
"google-plus",
"money",
"caret-down",
"caret-up",
"caret-left",
"caret-right",
"columns",
"sort",
"sort-desc",
"sort-asc",
"envelope",
"linkedin",
"undo",
"gavel",
"tachometer",
"comment-o",
"comments-o",
"bolt",
"sitemap",
"umbrella",
"clipboard",
"lightbulb-o",
"exchange",
"cloud-download",
"cloud-upload",
"user-md",
"stethoscope",
"suitcase",
"bell-o",
"coffee",
"cutlery",
"file-text-o",
"building-o",
"hospital-o",
"ambulance",
"medkit",
"fighter-jet",
"beer",
"h-square",
"plus-square",
"angle-double-left",
"angle-double-right",
"angle-double-up",
"angle-double-down",
"angle-left",
"angle-right",
"angle-up",
"angle-down",
"desktop",
"laptop",
"tablet",
"mobile",
"circle-o",
"quote-left",
"quote-right",
"spinner",
"circle",
"reply",
"github-alt",
"folder-o",
"folder-open-o",
"smile-o",
"frown-o",
"meh-o",
"gamepad",
"keyboard-o",
"flag-o",
"flag-checkered",
"terminal",
"code",
"reply-all",
"star-half-o",
"location-arrow",
"crop",
"code-fork",
"chain-broken",
"question",
"info",
"exclamation",
"superscript",
"subscript",
"eraser",
"puzzle-piece",
"microphone",
"microphone-slash",
"shield",
"calendar-o",
"fire-extinguisher",
"rocket",
"maxcdn",
"chevron-circle-left",
"chevron-circle-right",
"chevron-circle-up",
"chevron-circle-down",
"html5",
"css3",
"anchor",
"unlock-alt",
"bullseye",
"ellipsis-h",
"ellipsis-v",
"rss-square",
"play-circle",
"ticket",
"minus-square",
"minus-square-o",
"level-up",
"level-down",
"check-square",
"pencil-square",
"external-link-square",
"share-square",
"compass",
"caret-square-o-down",
"caret-square-o-up",
"caret-square-o-right",
"eur",
"gbp",
"usd",
"inr",
"jpy",
"rub",
"krw",
"btc",
"file",
"file-text",
"sort-alpha-asc",
"sort-alpha-desc",
"sort-amount-asc",
"sort-amount-desc",
"sort-numeric-asc",
"sort-numeric-desc",
"thumbs-up",
"thumbs-down",
"youtube-square",
"youtube",
"xing",
"xing-square",
"youtube-play",
"dropbox",
"stack-overflow",
"instagram",
"flickr",
"adn",
"bitbucket",
"bitbucket-square",
"tumblr",
"tumblr-square",
"long-arrow-down",
"long-arrow-up",
"long-arrow-left",
"long-arrow-right",
"apple",
"windows",
"android",
"linux",
"dribbble",
"skype",
"foursquare",
"trello",
"female",
"male",
"gratipay",
"sun-o",
"moon-o",
"archive",
"bug",
"vk",
"weibo",
"renren",
"pagelines",
"stack-exchange",
"arrow-circle-o-right",
"arrow-circle-o-left",
"caret-square-o-left",
"dot-circle-o",
"wheelchair",
"vimeo-square",
"try",
"plus-square-o",
"space-shuttle",
"slack",
"envelope-square",
"wordpress",
"openid",
"university",
"graduation-cap",
"yahoo",
"google",
"reddit",
"reddit-square",
"stumbleupon-circle",
"stumbleupon",
"delicious",
"digg",
"pied-piper",
"pied-piper-alt",
"drupal",
"joomla",
"language",
"fax",
"building",
"child",
"paw",
"spoon",
"cube",
"cubes",
"behance",
"behance-square",
"steam",
"steam-square",
"recycle",
"car",
"taxi",
"tree",
"spotify",
"deviantart",
"soundcloud",
"database",
"file-pdf-o",
"file-word-o",
"file-excel-o",
"file-powerpoint-o",
"file-image-o",
"file-archive-o",
"file-audio-o",
"file-video-o",
"file-code-o",
"vine",
"codepen",
"jsfiddle",
"life-ring",
"circle-o-notch",
"rebel",
"empire",
"git-square",
"git",
"hacker-news",
"tencent-weibo",
"qq",
"weixin",
"paper-plane",
"paper-plane-o",
"history",
"circle-thin",
"header",
"paragraph",
"sliders",
"share-alt",
"share-alt-square",
"bomb",
"futbol-o",
"tty",
"binoculars",
"plug",
"slideshare",
"twitch",
"yelp",
"newspaper-o",
"wifi",
"calculator",
"paypal",
"google-wallet",
"cc-visa",
"cc-mastercard",
"cc-discover",
"cc-amex",
"cc-paypal",
"cc-stripe",
"bell-slash",
"bell-slash-o",
"trash",
"copyright",
"at",
"eyedropper",
"paint-brush",
"birthday-cake",
"area-chart",
"pie-chart",
"line-chart",
"lastfm",
"lastfm-square",
"toggle-off",
"toggle-on",
"bicycle",
"bus",
"ioxhost",
"angellist",
"cc",
"ils",
"meanpath",
"buysellads",
"connectdevelop",
"dashcube",
"forumbee",
"leanpub",
"sellsy",
"shirtsinbulk",
"simplybuilt",
"skyatlas",
"cart-plus",
"cart-arrow-down",
"diamond",
"ship",
"user-secret",
"motorcycle",
"street-view",
"heartbeat",
"venus",
"mars",
"mercury",
"transgender",
"transgender-alt",
"venus-double",
"mars-double",
"venus-mars",
"mars-stroke",
"mars-stroke-v",
"mars-stroke-h",
"neuter",
"genderless",
"facebook-official",
"pinterest-p",
"whatsapp",
"server",
"user-plus",
"user-times",
"bed",
"viacoin",
"train",
"subway",
"medium",
"y-combinator", 
"optin-monster", 
"opencart", 
"expeditedssl", 
"battery-full", 
"battery-three-quarters", 
"battery-half", 
"battery-quarter", 
"battery-empty", 
"mouse-pointer", 
"i-cursor", 
"object-group", 
"object-ungroup", 
"sticky-note", 
"sticky-note-o", 
"cc-jcb", 
"cc-diners-club", 
"clone", 
"balance-scale",
"hourglass-o",
"hourglass-start",
"hourglass-half",
"hourglass-end",
"hourglass",
"hand-rock-o",
"hand-paper-o",
"hand-scissors-o",
"hand-lizard-o",
"hand-spock-o",
"hand-pointer-o",
"hand-peace-o",
"trademark",
"registered",
"creative-commons",
"gg",
"gg-circle",
"tripadvisor",
"odnoklassniki",
"odnoklassniki-square",
"get-pocket",
"wikipedia-w",
"safari",
"chrome",
"firefox",
"opera",
"internet-explorer",
"television",
"contao",
"500px",
"amazon",
"calendar-plus-o",
"calendar-minus-o",
"calendar-times-o",
"calendar-check-o",
"industry",
"map-pin",
"map-signs",
"map-o",
"map",
"commenting",
"commenting-o",
"houzz",
"vimeo",
"black-tie",
"fonticons",
"reddit-alien",
"edge",
"credit-card-alt",
"codiepie",
"modx",
"fort-awesome",
"usb",
"product-hunt",
"mixcloud",
"scribd",
"pause-circle",
"pause-circle-o",
"stop-circle",
"stop-circle-o",
"shopping-bag",
"shopping-basket",
"hashtag",
"bluetooth",
"bluetooth-b",
"percent"
	);
	return $faIcons;
	}
?>