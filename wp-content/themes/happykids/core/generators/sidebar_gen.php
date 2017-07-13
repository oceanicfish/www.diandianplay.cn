<?php
/**
 * Sidebar Generator.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 1.0
 * @version     3.2.9
 */

	function cws_register_sidebars(){

		$gen_sets = theme_get_option('general', 'gen_sets');
		$custom_sidebars = isset( $gen_sets['_sidebars_list'] ) ? $gen_sets['_sidebars_list'] : '';
		if ( function_exists('register_sidebars') ) {
			register_sidebar(array(
				'name'=>'Right Sidebar',
				'id' => 'sidebar-1',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			));
			register_sidebar(array(
				'name'=>'Left Sidebar',
				'id' => 'sidebar-2',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			));
			register_sidebar(array(
				'name'=>'Footer',
				'id' => 'sidebar-3',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			));

			if(!empty($custom_sidebars)){
				$sidebars_arr = explode("|", $custom_sidebars);
				$i = 3;
				foreach ($sidebars_arr as $sidebar) {
					$i++;
					if ( function_exists('register_sidebar') )
						register_sidebar(array('name'=>$sidebar,
							'id' => 'sidebar-' . $i,
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<h3 class="widget-title">',
							'after_title' => '</h3>'
						));
				}
			}

		}
	}

?>