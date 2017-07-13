<?php

	$gen_sets = theme_get_option('general', 'gen_sets');
	$gen_side_r = ( isset($gen_sets['_sidebar_main']) ) ? $gen_sets['_sidebar_main'] : false;
	$gen_side_l = ( isset($gen_sets['_sidebar_main_l']) ) ? $gen_sets['_sidebar_main_l'] : false;
	$default_page_template = ( isset($gen_sets['_gen_template_select']) ) ? $gen_sets['_gen_template_select'] : 'sb_none';

	$page_custom = theme_get_post_custom();
	$custom_sidebar_l = ( empty($page_custom['_sidebar_left']) || ($page_custom['_sidebar_left'] == "empty")) ? $gen_side_l : $page_custom['_sidebar_left'];
	$custom_sidebar_r = ( empty($page_custom['_sidebar_right']) || ($page_custom['_sidebar_right'] == "empty")) ? $gen_side_r : $page_custom['_sidebar_right'];
	$page_template = ( isset($page_custom['_page_templ']) ) ? ( ($page_custom['_page_templ'] == "sb_default") ? $default_page_template : $page_custom['_page_templ']) : $default_page_template;

	switch ($page_template) {
		case 'sb_right':
		case 'sb_left':
			$page_style = "single-sidebar";
			break;
		case 'sb_double':
			$page_style = "double-sidebar";
			break;
		default:
			$page_style = "";
			break;
	};
?>

<div class="entry-container <?php echo($page_style); ?>">
	<?php if(($page_template == 'sb_double' || $page_template == 'sb_left') && function_exists('dynamic_sidebar') && $custom_sidebar_l) {
			echo ('<aside id="sidebar-left">');
			dynamic_sidebar($custom_sidebar_l);
			echo ("</aside>");
		};
	?>

	<?php if(have_posts()) :  while(have_posts()) : the_post(); ?>

		<main>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 
			'before' => '<div class="pagenavi">' . __( 'Pages:', 'happykids' ), 
			'after' => '</div>',
			'link_before' => '<span class="page">',
			'link_after'  => '</span>',
			'highlight'   => 'b'
			) ); ?>
			<?php comments_template(); ?> 
		</main>

	<?php endwhile; endif;// LOOP END ?>

	<?php if(($page_template == 'sb_double' || $page_template == 'sb_right') && function_exists('dynamic_sidebar') && $custom_sidebar_r) {
			echo ('<aside id="sidebar-right">');
			dynamic_sidebar($custom_sidebar_r);
			echo ("</aside>");
		};
	?>

	<div class="kids_clear"></div>
</div><!-- .entry-container -->