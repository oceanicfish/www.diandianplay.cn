<?php
/**
 * Register Custom Post - Portfolio.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 1.0
 * @version     3.3.0
 */	

	$gen_sets = theme_get_option('general', 'gen_sets');
	$permalink_slug = !empty($gen_sets['permalink_slug']) ? $gen_sets['permalink_slug'] : 'portfolio';

	register_post_type('portfolio', array(
		'labels' => array(
			'name' => __('Portfolio', 'happykids'),
			'singular_name' => multitranslate(ucfirst($permalink_slug), "_port_admin_item", false),
			'add_new' => __('Add New', 'happykids'),
			'add_new_item' =>__('Add New Item', 'happykids'),
			'edit_item' => __('Edit Item', 'happykids'),
			'new_item' => __('New Item', 'happykids'),
			'view_item' => __('View Item', 'happykids'),
			'search_items' => __('Search Items', 'happykids'),
			'not_found' =>  __('No item found', 'happykids'),
			'not_found_in_trash' => __('No items found in Trash', 'happykids'),
			'menu_name' => __('Portfolio', 'happykids'),
		),
		
		'singular_label' => __('Portfolio', 'happykids'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 8,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
		'has_archive' => true,
		'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => false),
		'can_export' => true,
		'show_in_nav_menus' => true,
	));

	//register taxonomy for portfolio
	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => __('Portfolio Categories', 'happykids'),
			'menu_name' => __('Categories', 'happykids'),
			'singular_name' => __('Portfolio Category', 'happykids')
		),
		'show_ui' => true,
	));
