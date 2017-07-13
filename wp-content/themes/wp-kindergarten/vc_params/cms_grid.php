<?php
	$params = array(
		array(
			"type" => "dropdown",
			"heading" => __("Title Size",THEMENAME),
			"param_name" => "cms_title_size",
			"value" => array(
					"H2" => "h2",
					"H3" => "h3",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6"
			),
			"template" => array("cms_grid--layout-team-1.php","cms_grid--layout-testimonial-layout-1.php","cms_grid--layout-blog-1.php")
		)
	);
	vc_remove_param('cms_grid','cms_template');
	$cms_template_attribute = array(
		'type' => 'cms_template_img',
	    'param_name' => 'cms_template',
	    "shortcode" => "cms_grid",
	    "heading" => __("Shortcode Template",THEMENAME),
	    "admin_label" => true,
	    "group" => __("Template", THEMENAME),
		);
	vc_add_param('cms_grid',$cms_template_attribute);
?>