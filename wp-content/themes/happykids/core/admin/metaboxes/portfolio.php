<?php
$config = array(
	'title' => __('Portfolio Options', 'happykids'),
	'id' => 'cws_portfolio',
	'pages' => array('portfolio'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		"name" => __("Show Read More button", 'happykids'),
		"desc" => '',
		"id" => "_port_butt_show",
		"type" => "select",
		"default" => 'empty',
		"options" => array(
						"empty" => __('Default', 'happykids'),
						"show" => __('Show', 'happykids'),
						"hide" => __('Hide', 'happykids'),
					)
	),
	array(
		"name" => __("Button name", 'happykids'),
		"desc" => '',
		"id" => "_port_butt_txt",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __("Button URL", 'happykids'),
		"desc" => '',
		"id" => "_port_butt_link",
		"default" => "",
		"type" => "text"
	),
	array(
		"desc" => __('disable hover effect for this item.', 'happykids'),
		"id" => "_disable_portf_item_lightbox",
		"default" => false,
		"type" => "checkbox",
	),	
	array(
		"name" => __("Custom URL (optional)", 'happykids'),
		"desc" => __('Pictures, videos etc', 'happykids'),
		"id" => "_port_popup_link",
		"default" => "",
		"type" => "textarea"
	),
	array(
		"name" => '',
		"desc" => __('use direct link instead of the popup.', 'happykids'),
		"id" => "_img_port_butt_link",
		"default" => false,
		"type" => "checkbox",
	),
);
new metaboxesGenerator($config,$options);