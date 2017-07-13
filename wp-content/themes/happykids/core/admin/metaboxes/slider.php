<?php
$config = array(
	'title' => __('Slide Options', 'happykids'),
	'id' => 'cws_slideshow',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		"name" => __('Slide link/Gallery popup link', 'happykids'),
		"id" => "_slide_link",
		"default" => "",
		"type" => "text"		
	),
	array(
		"name" => '',
		"desc" => __('<b>Use direct link instead of the popup:</b><br>Please note: This option is available only for Galleries', 'happykids'),
		"id" => "_img_gall_butt_link",
		"default" => false,
		"type" => "checkbox",
	),
	array(
		"name" => __('Slide Caption', 'happykids'),
		"id" => "_slide_capt",
		"default" => "",
		"type" => "textarea"		
	),
);
new metaboxesGenerator($config,$options);