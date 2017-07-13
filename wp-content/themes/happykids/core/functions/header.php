<?php

	function show_logo() {
		$gen_sets = theme_get_option('general', 'gen_sets');
		$logo_url = isset($gen_sets['_logo']) ? $gen_sets['_logo'] : '';
		$is_logo_hdpi = isset($gen_sets['_logo-ppi']) ? $gen_sets['_logo-ppi'] : '';

		$logo_align = isset( $gen_sets["_gen_logo_align"] ) ? $gen_sets["_gen_logo_align"] : '';
		$logo_w = isset($gen_sets['_logo_w']) ? $gen_sets['_logo_w'] : '';
		$logo_h = isset($gen_sets['_logo_h']) ? $gen_sets['_logo_h'] : '';

		$logo_it = isset($gen_sets['_logo_it']) ? $gen_sets['_logo_it'] : '';
		$logo_ir = isset($gen_sets['_logo_ir']) ? $gen_sets['_logo_ir'] : '';
		$logo_il = isset($gen_sets['_logo_il']) ? $gen_sets['_logo_il'] : '';
		$logo_ib = isset($gen_sets['_logo_ib']) ? $gen_sets['_logo_ib'] : '';

		$logo_url_result = '';
		if ( $logo_url ){
			$logo_url = esc_url($logo_url);
			if ( $logo_w || $logo_h ) {
				$img_settings =  $logo_w ? ( $logo_h ? array( 'width' => $logo_w, 'height' => $logo_h, 'crop' => true ) : array( 'width' => $logo_w, 'crop' => true )) : ( $logo_h ? array( 'height' => $logo_h, 'crop' => true ) : '');
				$thumb_obj = bfi_thumb( $logo_url, $img_settings, false );
				$logo_url_result = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
			} else {
				$logo_url_result = $is_logo_hdpi ? cws_hdpi_to_ldpi_url($logo_url, false) : 'src="'. esc_url($logo_url) .'" data-no-retina';
			}
		}

		if ($logo_align == 'center'){
				$logo_align = 'text-align:center;';
			} elseif($logo_align == 'right'){
				$logo_align = 'float:right;';
			} else{
				$logo_align = 'float:left;';
		}
		
		$logo_style = '';
		if ($logo_it || $logo_ir || $logo_il || $logo_ib){
			if ($logo_it) $logo_style .= 'margin-top:'. $logo_it .'px;';
			if ($logo_ir) $logo_style .= 'margin-right:'. $logo_ir .'px;';
			if ($logo_il) $logo_style .= 'margin-left:'. $logo_il .'px;';
			if ($logo_ib) $logo_style .= 'margin-bottom:'. $logo_ib .'px;';
		}

		if (!empty($logo_url_result)) {
			echo '<div id="kids_logo_block" style="'.$logo_align.' '. $logo_style .'" ><a id="kids_logo_text" href="'. home_url() .'"><img '. $logo_url_result .' alt="'. get_bloginfo('name') .'" title="'. get_bloginfo('name') .'" /></a></div>';
		} else {
			echo '<div id="kids_logo_block" style="'.$logo_align.' '. $logo_style .'" ><h1 class="site-title"><a id="kids_logo_text" href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) . '</a></h1></div>';
		}
	}

	function position_menu() {
		$gen_sets = theme_get_option('general', 'gen_sets');

		$menu_align = isset( $gen_sets["_gen_menu_align"] ) ? $gen_sets["_gen_menu_align"] : '';
		$menu_it = isset($gen_sets['_menu_it']) ? $gen_sets['_menu_it'] : '';

		$menu_style = 'style="';
		if ($menu_align == 'center'){
				$menu_style .= 'margin-left:auto;margin-right:auto;text-align:center;';
			} elseif($menu_align == 'right'){
				$menu_style .= 'float:right; text-align:right;';
			} else{
				$menu_style .= 'float:left; text-align:left;';
		}
		
		if (!empty ($menu_it)){
			$menu_style .= ' padding-top:'.$menu_it.'px;';
		}
		$menu_style .= '"';
		echo $menu_style;
	}

	function position_menu_ul_fix() {
		$gen_sets = theme_get_option('general', 'gen_sets');

		$menu_align = isset( $gen_sets["_gen_menu_align"] ) ? $gen_sets["_gen_menu_align"] : '';

		if ($menu_align == 'center'){
			$menu_align = 'style="display:inline-block"';
			return $menu_align;
		}
	}
	

	function show_skin(){
		$gen_sets = theme_get_option('general', 'gen_sets');
		$skin_color = isset($gen_sets['_theme_skin_color']) ? $gen_sets['_theme_skin_color'] : '';
		$skin_pattern = isset($gen_sets['_theme_skin_pattern']) ? $gen_sets['_theme_skin_pattern'] : '';
		$_custom_pattern = isset($gen_sets['_theme_load_pattern']) ? $gen_sets['_theme_load_pattern'] : '';

		if ($skin_color == '') $skin_color = 't-blue';
		if ($skin_pattern == '') $skin_pattern = 't-pattern-1';
		if ($_custom_pattern) $skin_pattern = 't-custom-pattern';
		if ($skin_pattern == 't-pattern-0'){
			$result = $skin_color;
		}else{
			$result = $skin_color . ' ' . $skin_pattern;
		}
 		return $result;
	}

	function show_favicon(){
		$gen_sets = theme_get_option('general', 'gen_sets');
		$favicon = isset($gen_sets['_fav']) ? $gen_sets['_fav'] : '';
		$thumb_obj = bfi_thumb(esc_url($favicon), array('width' => 32, 'width' => 32, 'crop' => true));
		$fav_icon = $thumb_obj[0];
		if ($favicon) echo '<link rel="shortcut icon" href="'. $fav_icon .'" />';
	}

	function show_social(){
		$gen_sets = theme_get_option('general', 'gen_sets');
		$soc_net_count = 1;
		while (isset($gen_sets['_soc_net_'.$soc_net_count])){
			 if ( !empty($gen_sets['_soc_net_'.$soc_net_count]) ){
				echo '<li><a href="'. esc_url($gen_sets['_soc_net_'.$soc_net_count]) .'" title="'. $gen_sets['_soc_net_'.$soc_net_count.'_net_title'] .'" target="_blank"><i class="fa fa-'. $gen_sets['_soc_net_'.$soc_net_count.'_fa_icon'] .' fa-2x"></i></a><span style="background-color:'. $gen_sets['_soc_net_'.$soc_net_count.'_hover_color'] .';"></span></li>';
			 }
			$soc_net_count++; 
		}
	
	}
	function show_search_bar(){
		$gen_sets = theme_get_option('general', 'gen_sets');
		$show_panel = isset($gen_sets['_show_search_panel']) ? $gen_sets['_show_search_panel'] : '';
		if ($show_panel) {
			echo '<li class="search"><a href="#" title="'.__("Search", 'happykids').'"></a><span></span></li><li>';
			get_search_form();
			echo('</li>');
		}
	}

	function put_ganalytics_code(){
		$gen_sets = theme_get_option('general', 'gen_sets');
		$ganalytics = isset($gen_sets['_ganalytics']) ? $gen_sets['_ganalytics'] : '';

		if ($ganalytics) echo stripslashes($ganalytics);
	}

?>