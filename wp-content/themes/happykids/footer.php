<?php
/*
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage HappyKids
 * @since HappyKids 3.0
 */

	$gen_sets = theme_get_option('general', 'gen_sets');

	$type = isset( $gen_sets["_widget_type"] ) ? $gen_sets["_widget_type"] : 'type-1';
	$footer_sidebar = isset($gen_sets['footer-area']) ? $gen_sets['footer-area'] : '';
	$footer_copyrights_sidebar = isset($gen_sets['footer_copyrights-area']) ? $gen_sets['footer_copyrights-area'] : '';
	$show_social_footer = isset($gen_sets['_show_social_footer']) ? $gen_sets['_show_social_footer'] : '';

?>
    <!-- FOOTER BEGIN -->
    	
  		<?php if ( is_active_sidebar($footer_sidebar) ) : ?>
			<div class="kids_bottom_container footer">
				<div class="l-page-width">
					<div class="wrapper">
						<?php dynamic_sidebar($footer_sidebar); ?>
					</div><!-- /wrapper -->
				</div><!--/ l-page-width-->
			</div><!-- .kids_bottom_container -->
		<?php endif; ?>

  		<?php 

  			$show_wpml_footer = cws_is_wpml_active() ? true : false;
  			if ( is_active_sidebar($footer_copyrights_sidebar) || $show_social_footer || $show_wpml_footer ) : ?>
			<div class="kids-footer-copyrights footer">
			 <div class="l-page-width  clearfix">
			 	
				<div class="wrapper">
					<?php dynamic_sidebar($footer_copyrights_sidebar); ?>
					<div class="kids_social_wrapper">
					<?php 
					if ($show_social_footer || $show_wpml_footer) : ?>
						<ul class="kids_social">
							<?php if($show_social_footer) { show_social(); } ?>
						</ul>							
						<?php if($show_wpml_footer) : ?>
							<?php 
							$ret = '';
								global $wpml_language_switcher;
								$slot = $wpml_language_switcher->get_slot( 'statics', 'footer' );	
								$template = $slot->get_model();
								$ret = $slot->is_enabled();
						
								$class_wpml = '';
								if(isset($template['template']) && !empty($template['template'])){
									if($template['template'] == 'wpml-legacy-vertical-list'){
										$class_wpml = 'wpml_language_switch lang_bar '. $template['template'];
									}
									else{
										$class_wpml = 'wpml_language_switch horizontal_bar '.$template['template'];
									}						
								}else{
									$class_wpml = 'lang_bar';
								}

					 		 	if ( cws_is_wpml_active() && !empty($ret) ){
					 		 		echo "<div class='" . esc_attr($class_wpml) . "'>";
					 		 			do_action( 'wpml_footer_language_selector'); 
					 		 		echo "</div>";
					 		 	}
							 ?>
				 		<?php endif; ?>	
					<?php endif; ?>
					</div>
				</div>
			 </div>
			 <div class="dark-mask"></div>
			</div>
		<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="js/selectivizr-and-extra-selectors.min.js"></script>
	<![endif]-->

	<script type="text/javascript">	
		var blogurl = '<?php echo home_url(); ?>';
		var themeUrl = '<?php echo THEME_URI; ?>';

		jQuery(document).ready(function($){
			$('.entry-container .widget').addClass('<?php echo $type; ?>');
			$('.entry-container .widget.type-2').each(function(){
				var checker = $(this).find('h3').text();
				if ( checker == '' ){
					$(this).removeClass('type-2');
				}
			});
		});
	</script>

	<?php wp_footer(); ?>
	</body>
</html>