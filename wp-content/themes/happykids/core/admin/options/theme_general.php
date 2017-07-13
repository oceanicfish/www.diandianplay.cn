<?php
/**
 * Theme Options Config file.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 1.0
 * @version     3.3.0
 */

$options = array(
	array("type" => "start"),

//CWS SIDEBAR START

		array(
			"type" => "cws_sidebar",
			"options" => array(
						"_cws_controls_general" => __('General Settings', 'happykids'),
						"_cws_controls_appearence" => __('Display Options', 'happykids'),
						"_cws_controls_styling_options" => __('Styling Options', 'happykids'),
						"_cws_controls_sidebars" => __('Layout Options', 'happykids'),
						"_cws_controls_homepage" => __('HomePage', 'happykids'),
						"_cws_controls_fonts" => __('Fonts', 'happykids'),
						"_cws_controls_translations" => __('Translations', 'happykids'),
						"_cws_controls_socials" => __('Socials', 'happykids'),
						"_cws_controls_help" => __('Help', 'happykids'),
					)
		),

//CWS SIDEBAR END

// CWS CONTENT START

		array("type" => "creaws_content"),


// General section
			array( "type" => "creaws_section", "class" => "_cws_controls_general tabs_section", "id" => "General"),


				array("type" => "creaws_tabs_link"),

					array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" , "name" => __('General Settings', 'happykids')),

				array("type" => "creaws_tabs_link_end"),

				array("type" => "creaws_tab_item"),

					array('type' => "creaws_tab_begin" , "tab_index" => "1"),

						array(
							"name" => __("Logo", 'happykids'),
							"id" => "_logo",
							"default" => "",
							"ppi" => "show",
							"preview" => "show",
							"type" => "uploader",
						),	
						array('type' => "col_cont",
								"name" => __("Logo Dimensions", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"class" => "logo-dimensions",
								"column" => "one",
								),	
								array('type' => "col_cont",
										"col_cont" => "col_cont",
										"id" => "col_cont",
										"column" => "two",
								),		
										array(		
											"id" => "_logo_w",
											"class" => "logo-dim logo-width",
											"type" => "text",
											"styles" => "width: 110px;",
											"size" => "3",
											"placeholder" => __("Width (px)", 'happykids'),
											"default" => ""
										),
										array(
											"id" => "_logo_h",
											"class" => "logo-dim logo-height",
											"type" => "text",
											"styles" => "width: 110px;",
											"size" => "3",
											"placeholder" => __("Height (px)", 'happykids'),
											"default" => ""
										),
								array("type" => "col_cont_end"),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Logo Position ", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
									"id" => "_gen_logo_align",
									"column" => "two",
									"label" => "",
									"default" => "left",
									"type" => "select",
									"options" => array(
													"left" => __('Left', 'happykids'),
													"center" => __('Center', 'happykids'),
													"right" => __('Right', 'happykids'),
												),
								),

						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Logo Spacing", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								"class" => "logo-position",
								),
								array(				
									"align" => "center",
									"class" => "logo-margin logo-margin-top",
									"id" => "_logo_it",
									"type" => "text",
									"styles" => "width: 60px;",
									"size" => "3",
									"placeholder" => "Top (px)",
									"default" => ""
								),
								array(									
									"id" => "_logo_il",
									"class" => "logo-margin logo-margin-left",
									"type" => "text",
									"styles" => "width: 60px;",
									"size" => "3",
									"placeholder" => "Left (px)",
									"default" => ""
								),
								array(
									
									"id" => "_logo_ir",
									"class" => "logo-margin logo-margin-right",
									"align" => "right",
									"type" => "text",
									"styles" => "width: 60px;",
									"size" => "3",
									"placeholder" => "Right (px)",
									"default" => ""
								),
								array(									
									"id" => "_logo_ib",
									"class" => "logo-margin logo-margin-bottom",
									"align" => "center",
									"type" => "text",
									"styles" => "width: 60px;",
									"size" => "3",
									"placeholder" => "Bottom (px)",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array(
							"name" => __("Favicon", 'happykids'),
							"id" => "_fav",
							"default" => "",
							"preview" => "show",
							"type" => "uploader"
						),
						array(
							"name" => __("Google analytics code", 'happykids'),
							
							"id" => "_ganalytics",
							"default" => '',
							"placeholder" => __('Paste your Google Analytics (or other) tracking code here.', 'happykids'),
							"type" => "textarea",
							"class" => ""
						),
						array(
						     "name" => __("Theme update", 'happykids'),
						     "desc" => __("Please insert your Item Purchase Code to get latest theme updates.", 'happykids'),
						     "id" => "_theme_purchase_code",
						     "type" => "text",
						     "styles" => "width: 320px;",
						     "placeholder" => "Item purchase code goes here",
						     "default" => ""
						    ),
						array("name" => '', "type" => "serv_buttons" ),

					array('type' => "creaws_tab_end" ),

				array("type" => "creaws_tab_item_end"),

			array( "type" => "creaws_section_end"),
// General section END

// Appearance section
			array( "type" => "creaws_section", "class" => "_cws_controls_appearence tabs_section", "id" => "Appearence"),

				array("type" => "creaws_tabs_link"),

					array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" ,"name" => "Display Options"),

				array("type" => "creaws_tabs_link_end"),


				array("type" => "creaws_tab_item"),

					array('type' => "creaws_tab_begin" , "tab_index" => "1"),

					array('type' => "col_cont",
								"name" => __("Menu Position", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

							array(						
								"id" => "_gen_menu_align",
								"label" => "",
								"default" => "right",
								"type" => "select",
								"column" => "two",
								"options" => array(
												"right" => __('Right', 'happykids'),
												"center" => __('Center', 'happykids'),
												"left" => __('Left', 'happykids'),
											),
							),
							array(
								"desc" => __("Use merged menu items", 'happykids'),
								"id" => "_menu_type",
								"default" => false,
								"type" => "checkbox",
								"column" => "two",
							),

					array("type" => "col_cont_end"),
					array(
						"id" => "_menu_it",
						"name" => __("Menu Top Spacing", 'happykids'),
						"column" => "one",
						"type" => "text",
						"styles" => "width: 60px;",
						"size" => "3",
						"placeholder" => "px",
						"default" => ""
					),

					array(
						"name" => __("Enable mobile menu on all touch-enabled devices", 'happykids'),
						"id" => "_mobile_menu",
						"default" => true,
						"type" => "checkbox",
						"column" => "one",
					),

					array('type' => "col_cont",
								"name" => __("Widget Style", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

							array(
								"id" => "_widget_type",
								"default" => "type-1",
								"type" => "select",
								"column" => "two",
								"options" => array(
												"type-1" => __('Generic', 'happykids'),
												"type-2" => __('Chamomiles', 'happykids'),
												"type-3" => __('Clouds & Chamomiles', 'happykids')
											)
							),

					array("type" => "col_cont_end"),

					array('type' => "col_cont",
								"name" => __("Breadcrumbs", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

							array(								
								"id" => "_gen_breadcrumbs",
								"column" => "two",
								"label" => "",
								"default" => "show",
								"type" => "select",
								"options" => array(
												"show" => __('Show crumbs', 'happykids'),
												"hide" => __('Hide crumbs', 'happykids'),
											),
							),

					array("type" => "col_cont_end"),


				array('type' => "creaws_tab_end" ),

			array("type" => "creaws_tab_item_end"),

		array( "type" => "creaws_section_end"),
// Appearance section END
// Styling Options section
		array( "type" => "creaws_section", "class" => "_cws_controls_styling_options tabs_section", "id" => "Stylings"),

			array("type" => "creaws_tabs_link"),

				array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" ,"name" => __('Colors', 'happykids')),

				array("type" => "creaws_content_title", "tab_index" => "2" ,"name" => __('Patterns & Graphics', 'happykids')),

			array("type" => "creaws_tabs_link_end"),

			array("type" => "creaws_tab_item"),

				array('type' => "creaws_tab_begin" , "tab_index" => "1"),

					array('type' => "col_cont",
							"name" => __("Theme color", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "one",
								"desc" => __("Main color (Default: #8fc0ea)", 'happykids'),
								"id" => "_theme_skin_color",
								"default" => "#8fc0ea",
								"type" => "color_picker"
							),
							array(
								"column" => "one",
								"desc" => __("Secondary color (Default: #fcf5d5)", 'happykids'),
								"id" => "_theme_skin_second_color",
								"default" => "#fcf5d5",
								"type" => "color_picker"
							),
							array(
								"column" => "one",
								"desc" => __("Outline color (Default: #fee6b4)", 'happykids'),
								"id" => "_theme_skin_third_color",
								"default" => "#fee6b4",
								"type" => "color_picker"
							),		
							array(
								"column" => "one",
								"desc" => __("Footer color (Default: #3185cb)", 'happykids'),
								"id" => "_theme_footer_color",
								"default" => "#3185cb",
								"type" => "color_picker"
							),
					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"name" => __("Menu, buttons, widget header colors", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "one",
								"desc" => __("Color (Default: #3185cb)", 'happykids'),
								"id" => "_theme_menu_color",
								"default" => "#3185cb",
								"type" => "color_picker"
							),		
							array(
								"column" => "one",
								"desc" => __("Hover color (Default: #ff633c)", 'happykids'),
								"id" => "_theme_menu_hover_color",
								"default" => "#ff633c",
								"type" => "color_picker"
							),	
					array("type" => "col_cont_end"),
				
				array('type' => "creaws_tab_end" ),

				array('type' => "creaws_tab_begin" , "tab_index" => "2"),

					array(
						"name" => __("Patterns", 'happykids'),
						
						"id" => "_theme_skin_pattern",
						"default" => "t-pattern-1",
						"type" => "pattern_select",
						"options" => array(
										"t-pattern-0" => "Disable patterns",
										"t-pattern-1" => "Baloons",
										"t-pattern-2" => "Stars",
										"t-pattern-3" => "Feathers",
										"t-pattern-4" => "Dandelion",
										"t-pattern-5" => "Dragonflies",
										"t-pattern-6" => "Butterflies",
										"t-pattern-7" => "Paper planes",
										"t-pattern-8" => "Owls",
										"t-pattern-9" => "Gifts",
									)
					),
					array(
						"name" => __("Upload and use custom pattern", 'happykids'),
						"id" => "_theme_load_pattern",
						"default" => "",
						"ppi" => "show",
						"preview" => "show",
						"preview_width" => '110',
						"preview_height" => '110',
						"type" => "uploader"
					),
					array(
						"name" => __("Header clouds", 'happykids'),
						"id" => "_theme_header_pattern",
						"default" => "",
						"preview" => "show",
						"ppi" => "show",
						"preview_width" => '110',
						"preview_height" => '110',
						"type" => "uploader"
					),
					array(
						"name" => __("Footer image", 'happykids'),
						"id" => "_theme_footer_image",
						"default" => "",
						"preview" => "show",
						"ppi" => "show",						
						"preview_width" => '110',
						"preview_height" => '110',
						"type" => "uploader"
					),
					array(
						"id" => "_footer_padding",
						"name" => __("Footer bottom spacing (px)", 'happykids'),
						"column" => "one",
						"type" => "text",
						"styles" => "width: 90px;",
						"size" => "3",
						"default" => '0'
					),	
				
				array('type' => "creaws_tab_end" ),

			array("type" => "creaws_tab_item_end"),

		array( "type" => "creaws_section_end"),
// Styling Options end
// Layout Options section
			array( "type" => "creaws_section" , "class" => "_cws_controls_sidebars tabs_section"),

				array("type" => "creaws_tabs_link"),

					array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" ,"name" => __('Header & Footer', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "2" , "name" => __('Page', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "3" , "name" => __('Blog', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "4" , "name" => __('Portfolio', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "5" , "name" => __('WooCommerce', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "6" , "name" => __('Sidebars', 'happykids')),

				array("type" => "creaws_tabs_link_end"),

				array("type" => "creaws_tab_item"),

					array('type' => "creaws_tab_begin" , "tab_index" => "1"),

						array('type' => "col_cont",
								'name' => __('Top toggle area', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
									'id' => 'toggle-area',
									"column" => "two",
									"type" => "sidebar_name_select",
									'desc' => __('Shows widgets of this sidebar in the top panel.', 'happykids'),
									'width' => '250px',
									),

						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								'name' => __('Footer area', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									'id' => 'footer-area',
									"type" => "sidebar_name_select",
									"column" => "two",
									'width' => '250px',
									),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								'name' => __('Copyrights area', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									'id' => 'footer_copyrights-area',
									"type" => "sidebar_name_select",
									"column" => "two",
									'width' => '250px',
									),	
						array("type" => "col_cont_end"),						

					array('type' => "creaws_tab_end" ),

					array('type' => "creaws_tab_begin", "tab_index" => "2"),

						array('type' => "col_cont",
								"name" => __('Defaul Layout', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
									"column" => "two",
									"id" => "_gen_template_select",
									"default" => "sb_none",
									"type" => "select",
									"options" => array(
												"sb_none" => __('Full width', 'happykids'),
												"sb_right" => __('Right sidebar', 'happykids'),
												"sb_left" => __('Left sidebar', 'happykids'),
												"sb_double" => __('Double sidebars', 'happykids'),
												),
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Left Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
										"column" => "two",
										"id" => "_sidebar_main_l",
										"default" => '',
										"type" => "sidebar_name_select",
										"class" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Right Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(	
										"column" => "two",									
										"id" => "_sidebar_main",
										"default" => 2,
										"type" => "sidebar_name_select",
										"class" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Search page sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",									
									"id" => "_sidebar_search",
									"type" => "sidebar_name_select",
									"default" => "2",
									"class" => ""
									),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Page 404 sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_sidebar_404",
									"type" => "sidebar_name_select",
									"default" => "",
									"class" => ""
								),
						array("type" => "col_cont_end"),

					array('type' => "creaws_tab_end" ),

					array('type' => "creaws_tab_begin" , "tab_index" => "3" , ),

						array('type' => "col_cont",
								"name" => __('Default Layout', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(								
									"id" => "_blog_template_select",
									"column" => "two",
									"default" => "sb_right",
									"type" => "select",
									"options" => array(
													"sb_none" => __('Full width', 'happykids'),
													"sb_right" => __('Right sidebar', 'happykids'),
													"sb_left" => __('Left sidebar', 'happykids'),
													"sb_double" => __('Double sidebars', 'happykids')
												),
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Left Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(	
										"column" => "two",							
										"id" => "_sidebar_main_blog_l",
										"default" => 2,
										"type" => "sidebar_name_select",
										"class" => ""
								),

						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Right Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(		
										"column" => "two",								
										"id" => "_sidebar_main_blog_r",
										"default" => 3,
										"type" => "sidebar_name_select",
										"class" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Author Data', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
									"column" => "two",
									"desc" => __('Show or hide author name and photo.', 'happykids'),
									"id" => "_blog_author_data",
									"type" => "select",
									"default" => 'hide',
									"options" => array(
													"show" => __('Show Author Data', 'happykids'),
													"hide" => __('Hide Author Data', 'happykids')
												)
								),
						array("type" => "col_cont_end"),

					array('type' => "creaws_tab_end" ),

					array('type' => "creaws_tab_begin", "tab_index" => "4" , ),

						array('type' => "col_cont",
								"name" => __('Defaul Layout', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(	
									"column" => "two",							
									"id" => "_gen_portf_select",
									"default" => "sb_none",
									"type" => "select",
									"options" => array(
												"sb_none" => __('Full width', 'happykids'),
												"sb_right" => __('Right sidebar', 'happykids'),
												"sb_left" => __('Left sidebar', 'happykids'),
												"sb_double" => __('Double sidebars', 'happykids'),
												),
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Left Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
										"column" => "two",
										"id" => "_sidebar_portf_l",
										"default" => '',
										"type" => "sidebar_name_select",
										"class" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Right Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
										"column" => "two",
										"id" => "_sidebar_portf_r",
										"default" => 2,
										"type" => "sidebar_name_select",
										"class" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Items per page", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_gen_port_ipp",
									"default" => 6,
									"type" => "text"
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("More button", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_gen_port_butt_show",
									"type" => "select",
									"default" => 'show',
									"options" => array(
													"show" => __('Show button', 'happykids'),
													"hide" => __('Hide button', 'happykids')
												)
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Button name", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_gen_port_butt_txt",
									"default" => __('Read more', 'happykids'),
									"type" => "text"
								),
						array("type" => "col_cont_end"),
						array('type' => "col_cont",
								"name" => __("Portfolio slug:", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "permalink_slug",
									"default" => '',
									"type" => "text"
								),
						array("type" => "col_cont_end"),						

					array('type' => "creaws_tab_end" ), 

					array('type' => "creaws_tab_begin", "tab_index" => "5"  ),

						array('type' => "col_cont",
								"name" => __('Defaul Layout', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_gen_woo_template_select",
									"default" => "right",
									"type" => "select",
									"options" => array(
													"sb_none" => __('Full width', 'happykids'),
													"sb_right" => __('Right sidebar', 'happykids'),
													"sb_left" => __('Left sidebar', 'happykids'),
													"sb_double" => __('Double sidebars', 'happykids')
												),
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Left Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
							array(
									"column" => "two",
									"id" => "_sidebar_main_woo_l",
									"default" => 2,
									"type" => "sidebar_name_select",
									"class" => ""
							),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Right Sidebar', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
										"column" => "two",
										"id" => "_sidebar_main_woo_r",
										"default" => 2,
										"type" => "sidebar_name_select",
										"class" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Items per page", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_gen_woo_ipp",
									"default" => 9,
									"type" => "text"
								),
						array("type" => "col_cont_end"),
						array(
							"desc" => __("Link product images to the details page instead of showing the popup images.", 'happykids'),
							"id" => "_woo_lightbox_disabled",
							"default" => false,
							"type" => "checkbox",
							"column" => "one",
						),						

					array('type' => "creaws_tab_end" ),

					array('type' => "creaws_tab_begin" , "tab_index" => "6" , ),

						array(
							"name" => __("Generate a new sidebar", 'happykids'),
							"id" => "_sidebars_list",
							"type" => "sidebars_list",
							"default" => ""
						),

					array('type' => "creaws_tab_end" ),

				array("type" => "creaws_tab_item_end"),

			array( "type" => "creaws_section_end"),
// Layout Options section END

// Google Fonts section
		array( "type" => "creaws_section", "class" => "_cws_controls_fonts tabs_section"),

			array("type" => "creaws_tabs_link"),

				array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" , "name" => __('Fonts', 'happykids')),

			array("type" => "creaws_tabs_link_end"),

			array("type" => "creaws_tab_item"),

				array('type' => "creaws_tab_begin" , "tab_index" => "1"),

					array(
						"name" => __("Menu font", 'happykids'),
						"id" => "_menu_gfont",
						"default" => "Lobster Two",
						"font_color" => "#fff",
						"font_size" => 19,
						"line_height" => 1.5,
						"type" => "font_select"
					),
					array(
						"name" => __("Header font", 'happykids'),
						"id" => "_headers_gfont",
						"default" => "Lobster Two",
						"font_color" => "#3185cb",
						"font_size" => 32,
						"line_height" => 1.125,
						"type" => "font_select"
					),
					array(
						"name" => __("Text font", 'happykids'),
						"id" => "_text_gfont",
						"default" => "Lato",
						"font_color" => "#a2825c",
						"font_size" => 16,
						"line_height" => 1.375,					
						"type" => "font_select"
					),

				array('type' => "creaws_tab_end" ),

			array("type" => "creaws_tab_item_end"),

		array( "type" => "creaws_section_end"),
// Goole fonts section END

// Homepage section
			array( "type" => "creaws_section", "class" => "_cws_controls_homepage tabs_section"),

				array("type" => "creaws_tabs_link"),

					array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" , "name" => __('Slider Settings', 'happykids')),

				array("type" => "creaws_tabs_link_end"),

				array("type" => "creaws_tab_item"),

					array('type' => "creaws_tab_begin" , "tab_index" => "1"),

						array('type' => "col_cont",
								"name" => __("Slider type:", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
									"column" => "two",
									"id" => "_what_slider_select",
									"default" => "img_slider",
									"type" => "select",
									"options" => array(
													"img_slider" => __('Image Slider', 'happykids'),
													"video" => __('Video file', 'happykids'),
													"image" => __('Static image', 'happykids'),
													"none" => __('Hide slider', 'happykids')
												)
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
							"name" => "Slider's shortcode",
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
								array(
									"column" => "two",
									"id" => "_slider_shortcode",
									"default" => "",
									"type" => "text"
								),
						array("type" => "col_cont_end"),
						array(
							"name" => __("Static image", 'happykids'),
							"id" => "_gen_slider_image",
							"default" => "",
							"preview" => "show",
							"preview_width" => '250',
							"preview_height" => '100',
							"type" => "uploader"
						),

						array('type' => "col_cont",
								"name" => __('Video source', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_gen_video_host",
									"type" => "select",
									"options" => array(
													"youtube" => __('YouTube', 'happykids'),
													"vimeo" => __('Vimeo', 'happykids')
												)
								),
								array(
									"column" => "two",
									"placeholder" => __("Video ID", 'happykids'),
									"id" => "_slider_video",
									"default" => "",
									"type" => "text"
								),
								array(
									"desc" => __("AutoPlay Video", 'happykids'),
									"id" => "_gen_video_autoplay",
									"default" => "",
									"type" => "checkbox",
									'column' => 'one'
								),								
						array("type" => "col_cont_end"),
						array('type' => "col_cont",
								'name' => __('Slogan area', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
									'id' => 'slogan-area',
									"column" => "two",
									"type" => "sidebar_name_select",
									'desc' => __('Shows widgets of this sidebar under the slider, on the Home Page.', 'happykids'),
									'width' => '250px',
									),	

						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								'name' => __('Benefits area', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),

								array(
									'id' => 'benefits-area',
									"column" => "two",
									"type" => "sidebar_name_select",
									'desc' => __('Shows widgets of this sidebar under the slogan, on the Home Page.', 'happykids'),
									'width' => '250px',
									),

						array("type" => "col_cont_end"),


					array('type' => "creaws_tab_end" ),

				array("type" => "creaws_tab_item_end"),

			array( "type" => "creaws_section_end"),
// Homepage section END

// Localization section
			array( "type" => "creaws_section", "class" => "_cws_controls_translations tabs_section"),

				array("type" => "creaws_tabs_link"),

					array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" , "name" => __('Blog', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "2" , "name" => __('Comments', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "3" , "name" => __('Pages', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "4" , "name" => __('Portfolio', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "5" , "name" => __('Breadcrumbs', 'happykids')),

				array("type" => "creaws_tabs_link_end"),

				array("type" => "creaws_tab_item"),

					array('type' => "creaws_tab_begin" , "tab_index" => "1"),

						array('type' => "col_cont",
								"name" => __('Category', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(									
									"column" => "two",
									"id" => "cws_post_under_cat",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Archive', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_blog_tpl_archive",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Search', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),			
								array(
									"column" => "two",
									"id" => "_cws_search",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Tags', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),	
								array(
									"column" => "two",
									"id" => "cws_post_under_tags",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),
					array('type' => "creaws_tab_end" ),

					array('type' => "creaws_tab_begin" , "tab_index" => "2"),	

						array('type' => "col_cont",
								"name" => __('No Comments', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_no_comments",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('One Comment', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_one_comment",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('% Comments', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_x_comments",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Password protected comments text', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_password",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Older Comments', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_older",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Newer Comments', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_newer",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Comments are closed', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_closed",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Leave a comment', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_reply",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Edit', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_edit",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Name', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_form_name",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Email Address', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_form_email",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Website URL', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_form_web",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Submit comment', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_comments_submit",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

					array('type' => "creaws_tab_end" ),

					array('type' => "creaws_tab_begin" , "tab_index" => "3"),

						array('type' => "col_cont",
								"name" => __('Page', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_tr_paginat_page",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Page not found', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_404_not_found",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('404 Page text', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_404_unfortunately",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Nothing found', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_tr_nothing_search",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

					array('type' => "creaws_tab_end" ),
					array('type' => "creaws_tab_begin" , "tab_index" => "4"),
						array('type' => "col_cont",
								"name" => __('All (Used in Portfolio filter)', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_tr_all",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __('Portfolio "Read more" text', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(									
									"column" => "two",
									"id" => "_tr_moar",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),
					array('type' => "creaws_tab_end" ),

					array('type' => "creaws_tab_begin" , "tab_index" => "5"),
						array('type' => "col_cont",
								"name" => __('Home', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "_home_slug",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "Home",
									"default" => ""
								),
						array("type" => "col_cont_end"),														
						array('type' => "col_cont",
								"name" => __('Portfolio singular name', 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"desc" => __('(i.e. "Portfolio item", used in breadcrumbs)', 'happykids'),
									"id" => "_port_admin_item",
									"type" => "text",
									"styles" => "",
									"size" => "",
									"placeholder" => "",
									"default" => ""
								),
						array("type" => "col_cont_end"),

					array('type' => "creaws_tab_end" ),							

				array("type" => "creaws_tab_item_end"),

			array( "type" => "creaws_section_end"),
// Localization section END

// General Fonts section
			array( "type" => "creaws_section", "class" => "_cws_controls_socials tabs_section"),

				array("type" => "creaws_tabs_link"),

					array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" , "name" => __('Socials settings', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "2" , "name" => __('Twitter', 'happykids')),
					array("type" => "creaws_content_title", "tab_index" => "3"  , "name" => __('Social Networks', 'happykids')),

				array("type" => "creaws_tabs_link_end"),

				array("type" => "creaws_tab_item"),

					array('type' => "creaws_tab_begin" , "tab_index" => "1"),
						array(
							"desc" => "Show the Search Bar",
							
							"id" => "_show_search_panel",
							"default" => true,
							"type" => "checkbox"
						),
						array(
							"desc" => "Show social networks in footer",
							"id" => "_show_social_footer",
							"default" => "",
							"type" => "checkbox"
						),				
						array(
							"desc" => "Show social links in PrettyPhoto popups",
							"id" => "_pretty_social",
							"default" => "",
							"type" => "checkbox"
						),
					array('type' => "creaws_tab_end" ), 

					array('type' => "creaws_tab_begin" , "tab_index" => "2"),

						array('type' => "col_cont",
								"name" => __("Username", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "twt_name",
									"default" => "",
									"type" => "text"
								),	
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Consumer Key", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "twt_ck",
									"default" => "",
									"type" => "text"
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Consumer Secret", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "twt_cs",
									"default" => "",
									"type" => "text"
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Access Token", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "twt_ut",
									"default" => "",
									"type" => "text"
								),
						array("type" => "col_cont_end"),

						array('type' => "col_cont",
								"name" => __("Access Token Secret", 'happykids'),
								"col_cont" => "col_cont",
								"id" => "col_cont",
								"column" => "one",
								),
								array(
									"column" => "two",
									"id" => "twt_us",
									"default" => "",
									"type" => "text"
								),
						array("type" => "col_cont_end"),

					array('type' => "creaws_tab_end" ), 

					array('type' => "creaws_tab_begin" , "tab_index" => "3"),

					array('type' => "col_cont",
							"name" => __("Social Network 1", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"name" => '',
								"placeholder" => __('Title of the social network', 'happykids'),
								"id" => "_soc_net_1_net_title",
								"default" => "",
								"type" => "text"
							),
							array(
								"column" => "two",
								"placeholder" => __('Paste your url here.', 'happykids'),
								"id" => "_soc_net_1",
								"default" => "",
								"type" => "text"
							),
					array("type" => "col_cont_end"),
					array('type' => "col_cont",
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"options" => array('' => ''),
								"class" => "icons",								
								"id" => "_soc_net_1_fa_icon",
								"default" => '',
								"type" => "select"
							),
							array(
								"column" => "two",
								"name" => '',
								"desc" => __('Hover color', 'happykids'),
								"id" => "_soc_net_1_hover_color",
								"default" => "",
								"type" => "color_picker"
							),
					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"name" => __("Social Network 2", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"name" => '',
								"column" => "two",
								"placeholder" => __('Title of the social network', 'happykids'),
								"id" => "_soc_net_2_net_title",
								"default" => "",
								"type" => "text"
							),
							array(
								"column" => "two",
								"placeholder" => __('Paste your url here.', 'happykids'),
								"id" => "_soc_net_2",
								"default" => "",
								"type" => "text"
							),
					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"options" => array('' => ''),
								"class" => "icons",								
								"id" => "_soc_net_2_fa_icon",
								"default" => '',
								"type" => "select"
							),
							array(
								"name" => '',
								"column" => "two",
								"desc" => __('Hover color', 'happykids'),
								"id" => "_soc_net_2_hover_color",
								"default" => "",
								"type" => "color_picker"
							),

					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"name" => __("Social Network 3", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"name" => '',
								"column" => "two",
								"placeholder" => __('Title of the social network', 'happykids'),
								"id" => "_soc_net_3_net_title",
								"default" => "",
								"type" => "text"
							),
							array(
								"column" => "two",
								"placeholder" => __('Paste your url here.', 'happykids'),
								"id" => "_soc_net_3",
								"default" => "",
								"type" => "text"
							),

					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"options" => array('' => ''),
								"class" => "icons",								
								"id" => "_soc_net_3_fa_icon",
								"default" => '',
								"type" => "select"
							),
							array(
								"name" => '',
								"column" => "two",
								"desc" => __('Hover color', 'happykids'),
								"id" => "_soc_net_3_hover_color",
								"default" => "",
								"type" => "color_picker"
							),
					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"name" => __("Social Network 4", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"name" => '',
								"placeholder" => __('Title of the social network', 'happykids'),
								"id" => "_soc_net_4_net_title",
								"default" => "",
								"type" => "text"
							),
							array(
								"column" => "two",
								"placeholder" => __('Paste your url here.', 'happykids'),
								"id" => "_soc_net_4",
								"default" => "",
								"type" => "text"
							),

					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"options" => array('' => ''),
								"class" => "icons",								
								"id" => "_soc_net_4_fa_icon",
								"default" => '',
								"type" => "select"
							),
							array(
								"column" => "two",
								"name" => '',
								"desc" => __('Hover color', 'happykids'),
								"id" => "_soc_net_4_hover_color",
								"default" => "",
								"type" => "color_picker"
							),
					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"name" => __("Social Network 5", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"name" => '',
								"placeholder" => __('Title of the social network', 'happykids'),
								"id" => "_soc_net_5_net_title",
								"default" => "",
								"type" => "text"
							),
							array(
								"column" => "two",
								"placeholder" => __('Paste your url here.', 'happykids'),
								"id" => "_soc_net_5",
								"default" => "",
								"type" => "text"
							),

					array("type" => "col_cont_end"),
					array('type' => "col_cont",
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"options" => array('' => ''),
								"class" => "icons",								
								"id" => "_soc_net_5_fa_icon",
								"default" => '',
								"type" => "select"
							),
							array(
								"column" => "two",
								"name" => '',
								"desc" => __('Hover color', 'happykids'),
								"id" => "_soc_net_5_hover_color",
								"default" => "",
								"type" => "color_picker"
							),
							
					array("type" => "col_cont_end"),

					array('type' => "col_cont",
							"name" => __("Social Network 6", 'happykids'),
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"name" => '',
								"placeholder" => __('Title of the social network', 'happykids'),
								"id" => "_soc_net_6_net_title",
								"default" => "",
								"type" => "text"
							),
							array(
								"column" => "two",
								"placeholder" => __('Paste your url here.', 'happykids'),
								"id" => "_soc_net_6",
								"default" => "",
								"type" => "text"
							),

					array("type" => "col_cont_end"),
					array('type' => "col_cont",
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),
							array(
								"column" => "two",
								"options" => array('' => ''),
								"class" => "icons",								
								"id" => "_soc_net_6_fa_icon",
								"default" => '',
								"type" => "select"
							),
							array(
								"column" => "two",
								"name" => '',
								"desc" => __('Hover color', 'happykids'),
								"id" => "_soc_net_6_hover_color",
								"default" => "",
								"type" => "color_picker"
							),						
					array("type" => "col_cont_end"),

				array('type' => "creaws_tab_end" ),

			array("type" => "creaws_tab_item_end"),

		array( "type" => "creaws_section_end"),
// General fonts section END
// Help section
		array( "type" => "creaws_section", "class" => "_cws_controls_help tabs_section"),

			array("type" => "creaws_tabs_link"),

				array("type" => "creaws_content_title", "class" => "active" , "tab_index" => "1" , "name" => __('Help', 'happykids')),

			array("type" => "creaws_tabs_link_end"),

			array("type" => "creaws_tab_item"),

				array('type' => "creaws_tab_begin" , "tab_index" => "1"),

					array('type' => "col_cont",
							"name" => 'Test help caption',
							"col_cont" => "col_cont",
							"id" => "col_cont",
							"column" => "one",
							),

							array(
								"button_text" => 'Help online',
								"id" => "_Help_online",
								"default" => "",
								"type" => "button",
								"link" => "http://help.cwsthemes.com/happykids/",
								"icon" => "life-bouy", 
								"class" => "button_cont",
							),	
							array(
								"button_text" => 'Help video',
								"id" => "_Help_video",
								"default" => "",
								"type" => "button",
								"link" => "https://www.youtube.com/user/cwsvideotuts/playlists",
								"icon" => "video-camera",
								"class" => "button_cont",
							),	

					array("type" => "col_cont_end"),

				array('type' => "creaws_tab_end" ),

			array("type" => "creaws_tab_item_end"),

		array( "type" => "creaws_section_end"),


// Help section end
	array("type" => "creaws_content_end"),

// CWS CONTENT END

array("type" => "end"),

//CWS END
);

return array(
	'name' => 'general',
	'options' => $options
);

