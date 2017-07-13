<?php 
$config = array(
	'title' => __('Post Options', 'happykids'),
	'id' => 'cws_single',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(

	array(
		"name" => __('Video', 'happykids'),
		"desc" => '',
		"id" => "_format_video",
		"type" => "textarea",
		"default" => "",
		"placeholder" => __('Embedded video block', 'happykids')
	),
	array(
		"desc" => __('disable hover effect for this item.', 'happykids'),
		"id" => "_disable_blog_post_item_lightbox",
		"default" => false,
		"type" => "checkbox",
	),	
	array(
		"name" => __('Blog Post Author Data', 'happykids'),
		"desc" => __('Show or hide author name and photo.', 'happykids'),
		"id" => "_blog_post_author_data",
		"type" => "select",
		"default" => '',
		"options" => array(
						"empty" => __('--- Select option ---', 'happykids'), 
						"show" => __('Show Author Data', 'happykids'),
						"hide" => __('Hide Author Data', 'happykids')
					)
	),
);
new metaboxesGenerator($config,$options);