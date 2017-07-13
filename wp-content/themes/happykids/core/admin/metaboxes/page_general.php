<?php

	$settings = array(
		'title' => __('Page Options', 'happykids'),
		'id' => 'cws_page_general',
		'pages' => array('page'),
		'callback' => '',
		'context' => 'normal',
		'priority' => 'high',
	);
	$options = array(

	array("type" => "meta_group", "name" => ''),//page group

		array("type" => "meta_sidebar"),//page properties definition

			array(
				"name" => __("Page type", 'happykids'),
				"desc" => '',
				"id" => "_pagetype_check",
				"type" => "select",
				"options" => array(
								"page" => __("Page", 'happykids'),
								"blog" => __("Blog", 'happykids'),
								"port" => __("Portfolio", 'happykids')
							),
				"default" => "page",
			),

		array("type" => "meta_sidebar_end"),//page properties definition END

		array("type" => "meta_content"),//definition options
			array(
				"name" => __("Page template", 'happykids'),
				"desc" => '',
				"id" => "_page_templ",
				"type" => "select",
				"options" => array(
								"sb_default" => __('Default', 'happykids'),
								"sb_none" => __('Full width', 'happykids'),
								"sb_right" => __('Right sidebar', 'happykids'),
								"sb_left" => __('Left sidebar', 'happykids'),
								"sb_double" => __('Double sidebars', 'happykids'),
							),
				"default" => "sb_default",
				"class" => "_page_check"
			),
			array(
				"name" => __("Blog template", 'happykids'),
				"desc" => '',
				"id" => "_blog_templ",
				"type" => "select",
				"options" => array(
								"sb_default" => __('Default', 'happykids'),
								"sb_none" => __('Full width', 'happykids'),
								"sb_right" => __('Right sidebar', 'happykids'),
								"sb_left" => __('Left sidebar', 'happykids'),
								"sb_double" => __('Double sidebars', 'happykids'),
							),
				"default" => "sb_default",
				"class" => "_blog_check"
			),
			array(
				"name" => __('Page Layout', 'happykids'),
				"id" => "_portf_templ",
				"default" => "sb_none",
				"type" => "select",
				"options" => array(
							"sb_none" => __('Full width', 'happykids'),
							"sb_right" => __('Right sidebar', 'happykids'),
							"sb_left" => __('Left sidebar', 'happykids'),
							"sb_double" => __('Double sidebars', 'happykids'),
							),
				"class" => "_port_check"
			),
				array(
					"name" => "Select sidebar",
					"desc" => "",
					"id" => "_sidebar_name",
					"default" => '',
					"type" => "sidebar_name_select",
					"class" => "sub_page_templ _sidebar_name"
				),
				array(
					"name" => __('Left sidebar', 'happykids'),
					"desc" => '',
					"id" => "_sidebar_left",
					"default" => '',
					"type" => "sidebar_name_select",
					"class" => "sub_page_templ _sidebar_double _sidebar_left"
				),
				array(
					"name" => __('Right sidebar', 'happykids'),
					"desc" => '',
					"id" => "_sidebar_right",
					"default" => '',
					"type" => "sidebar_name_select",
					"class" => "sub_page_templ _sidebar_double _sidebar_right"
				),				
			array(
				"name" => __("Image width", 'happykids'),
				"desc" => '',
				"id" => "_blog_img_width",
				"type" => "select",
				"options" => array(
								"blog_img_small" => __('Small', 'happykids'),
								"blog_img_medium" => __('Medium', 'happykids'),
								"blog_img_fwidth" => __('Full-width', 'happykids'),
							),
				"default" => "blog_img_medium",
				"class" => "_blog_check"
			),
			array(
				"name" => __("Blog Category", 'happykids'),
				"desc" => '',
				"id" => "_blog_cat",
				"type" => "slide_blog_select",
				"options" => array("option1","option2"),
				"default" => '',
				"class" => "_blog_check"
			),
		
			array(
				"name" => __("Columns", 'happykids'),
				"desc" => '',
				"id" => "_port_templ",
				"type" => "select",
				"options" => array(
							"one" => __('1 column', 'happykids'),
							"two" => __('2 columns', 'happykids'),
							"three" => __('3 columns', 'happykids'),
							"four" => __('4 columns', 'happykids'),
							),
				"default" => 'four',
				"class" => "_port_check"
			),
			array(
				"name" => '',
				"desc" => __('Use filter', 'happykids'),
				"id" => "_port_cat_filter",
				"default" => false,
				"type" => "checkbox",
				"class" => "_port_check"
			),
			array(
				"name" => __("Category", 'happykids'),
				"desc" => '',
				"id" => "_port_cat",
				"type" => "slide_port_select",
				"options" => array("option1","option2"),
				"default" => '',
				"class" => "_port_check"
			),
			array(
				"name" => __("Items per page", 'happykids'),
				"desc" => '',
				"id" => "_port_ipp",
				"type" => "text",
				"default" => "",
				"class" => "_port_check"
			),

		array("type" => "meta_content_end"),//definition options END
			// array("type" => "page_js"),//js for page type select

	array("type" => "meta_group_end"),//definition options END


	array("type" => "meta_group", "name" => __("Other options", 'happykids')),// group

		array(
			"name" => __("Show Breadcrumbs", 'happykids'),
			"desc" => '',
			"id" => "_breadcrumbs",
			"label" => "Label",
			"default" => "",
			"type" => "select",
			"options" => array(
							"empty" => __('--- Select option ---', 'happykids'),
							"show" => __('Show crumbs', 'happykids'),
							"hide" => __('Hide crumbs', 'happykids'),
						),
		),
		array(
			"name" => __("Add Image Slider:", 'happykids'),
			"desc" => '',
			"id" => "_img_slider",
			"type" => "text",
			"default" => "",
		),		

	array("type" => "meta_group_end"),//definition options END
	);

new metaboxesGenerator($settings, $options);