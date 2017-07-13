<?php
/**
 * Google Fonts file for Theme Options preview page
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 3.0
 * @version     3.2.9
 */
	class Get_Fonts {

		var $standard_fonts;
		var $saved_fonts;
		var $google_fonts;
		var $g_fonts_json;

		function __construct(){
			$this->g_fonts_json = include ( THEME_FONT_DIR . '/fonts.php');
			$this->set_standard_fonts();
		}

		function set_standard_fonts(){
			$standard_fonts = array(
				'Arial',
				'Tahoma',
				'Verdana',
				'Georgia',
				'FreeSans',
				'Lucida Sans Unicode',
				'Trebuchet MS'
			);
			$this->standard_fonts = $standard_fonts;
		}

		function build_admin_font_selector(){
			$font_names_to_return = array();
			$standard_fonts	 = $this->standard_fonts;
			$g_font_array_full = $this->g_fonts_json;


			if (is_array($standard_fonts)) {
				foreach ($standard_fonts as $font) {
					$font_names_to_return['System fonts'][] = $font;
				}
			}

			if (is_array($g_font_array_full['items'])) {
				foreach ($g_font_array_full['items'] as $key => $font) {
					$font_names_to_return['Goggle fonts'][] = $font['family'];
					$font_names_to_return['Goggle fonts'][$font['family']]['subsets'] = $font['subsets'];
					$font_names_to_return['Goggle fonts'][$font['family']]['variants'] = $font['variants'];
				}
			}
			return $font_names_to_return;
		}

	}

	global $Fonts;

	$Fonts = new Get_Fonts;

	add_action('wp_ajax_get_font_admin_preview_ajax','font_admin_preview_ajax');
	add_action( 'wp_ajax_nopriv_get_font_admin_preview_ajax', 'font_admin_preview_ajax' );

	function font_admin_preview_ajax(){

		global $Fonts;
		$font_list = $Fonts->build_admin_font_selector();

		$font_selected = $_POST['font_selected'];
		$subsets = isset($font_list['Goggle fonts'][$font_selected]['subsets']) ? $font_list['Goggle fonts'][$font_selected]['subsets'] : null;
		$variants = isset($font_list['Goggle fonts'][$font_selected]['variants']) ? $font_list['Goggle fonts'][$font_selected]['variants'] : null;

		$font_url = array('url'=>'//fonts.googleapis.com/css?family=' . str_replace(' ', '+' , $font_selected));
		if (!empty($subsets)) {
			$font_url['subsets'] = $subsets;
		}
		if (!empty($variants)) {
			$font_url['variants'] = $variants;
		}

		die(json_encode($font_url));

	}

?>