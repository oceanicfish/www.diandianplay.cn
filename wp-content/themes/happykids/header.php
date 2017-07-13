<?php
	/*
	 * The Header theme template.
	 *
	 * @package WordPress
	 * @subpackage HappyKids
	 * @since HappyKids v.3.0
	 */

	global $post;
	global $is_IE;

	$gen_sets = theme_get_option('general', 'gen_sets');
	$menu_merged = isset($gen_sets['_menu_type']) ? $gen_sets['_menu_type'] : '';
	$toggle_sidebar = isset($gen_sets['toggle-area']) ? $gen_sets['toggle-area'] : '';
	$show_top_panel = false;
	$_mobile_menu = $gen_sets['_mobile_menu'] == true ? 'touch_detect_on' : 'touch_detect_of';


?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo $_mobile_menu; ?>">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php 

		show_favicon(); 
		put_ganalytics_code();
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>
	</head>
		<?php if ( is_front_page() || is_home() ) : ?>
			<body <?php body_class( array('kids-front-page', show_skin()) ); ?>>
		<?php else : ?>
			<body <?php body_class( array('secondary-page', show_skin()) ); ?>>
		<?php endif; ?>

		<?php if ( function_exists('dynamic_sidebar') && is_active_sidebar($toggle_sidebar)){ ?>
			<!-- HEADER BEGIN -->
			<div class="top-panel">
				<div class="l-page-width clearfix">
					<div class="wrapper">		
						<?php 
							dynamic_sidebar($toggle_sidebar);
							$show_top_panel = true;
						 ?>
					</div>
				</div>
			</div><!--/ .top-panel-->						
		<?php } ?>

			
		<div class="kids-bg-level-1">

			<div class="bg-level-1"></div>
			
			<header id="kids_header">

				<div class="l-page-width clearfix">

					<ul class="kids_social">
						<?php 
							if ($show_top_panel) { echo ('<li class="openbtn"><a href="#"></a></li>'); }
					 		
					 		if ( cws_is_wpml_active()){
							echo "<li class='lang_bar'>";
								do_action('icl_language_selector');
							echo "</li>";
					 		}
					 		show_social();
							show_search_bar(); ?>
					</ul><!-- .kids_social -->
					<div class="kids_clear"></div>

					<?php show_logo(); ?>

					<nav id="kids_main_nav" <?php if($menu_merged) echo('class="merged" '); position_menu(); ?> >
						<div class="menu-button">
							<span class="menu-button-line"></span>
							<span class="menu-button-line"></span>
							<span class="menu-button-line"></span>
						</div>
<?php
							$menu_locations = get_nav_menu_locations();
							 if (isset($menu_locations['primary-menu']) ){
								wp_nav_menu( array(
									'after'  => '',
									'before'  => '',
									'theme_location'  => 'primary-menu',
									'container'       => '',
									'menu_class'      => '', 
									'menu_id'         => 'menu-main',
									'items_wrap'      => '<ul id="%1$s" class="clearfix flexnav %2$s" data-breakpoint="800"'.position_menu_ul_fix().'>%3$s</ul>'
								) );
							} else {
								echo '<h6 style="color:red;background-color:#fff;padding:10px;font-size:18px;margin: -6px 0 0;">Please assign the main menu: Appearance -> Menus -> Manage Locations</h6>';
							}
?>

					</nav><!-- #kids_main_nav -->

				</div><!--/ .l-page-width-->

			</header><!--/ #kids_header-->
	                        
	<!-- HEADER END -->