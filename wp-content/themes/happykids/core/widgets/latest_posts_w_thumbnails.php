<?php
	/**
	 * Latest Posts Widget Class
	 */
	class CWS_Widget_Latest_Posts extends WP_Widget {

		function __construct() {
			// Instantiate the parent object
			parent::__construct( false,  THEME_NAME . __(' - Latest Posts with thumbnails', 'happykids') );

		}

		function widget( $args, $instance ){
			extract($args);
			$title = apply_filters('widget_title', $instance['title'] );
			$head = '';

			if($title && $title != '') $head = '<h3 class="widget-title">' . $title . '</h3>';

			global $post;
			$category = ( ! empty( $instance['category'] ) ) ? absint( $instance['category'] ) : 0;
			$post_query = array( 'numberposts' => 3, 'cat' => $category );
			if( $instance['num_to_show'] ) $post_query['numberposts'] = $instance['num_to_show'];
			if( $instance['show_date'] ) $post_query['show_date'] = $instance['show_date'];
			$show_date = $instance['show_date'] ? $instance['show_date'] : false;

			$myposts = get_posts( $post_query );

			echo $before_widget;
			echo '<div class="latest-posts-widget">' . $head . '<div class="widget-content"><ul>';

			//$myposts = get_posts( $post_query );

			foreach( $myposts as $post ){

				$f_image_id = get_post_thumbnail_id(get_the_id());
				$thumbnail = wp_get_attachment_image_src($f_image_id, 'full', true);

				setup_postdata($post);

				echo '<li>';

				if ( has_post_thumbnail() ) {
					echo '<div class="kids_image_wrapper ">';

					echo '<a href="'. $thumbnail[0] .'" class="prettyPhoto kids_mini_picture"  data-rel="prettyPhoto[rpwt]">';

					$f_img_settings =  array('width' => 70, 'height' => 70, 'crop' => true);
					$thumb_obj = bfi_thumb( $thumbnail[0], $f_img_settings, false );
					$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? "src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
					echo '<img ' . $thumb_path_hdpi . ' width="70" height="70" alt="' . get_post_meta($f_image_id, '_wp_attachment_image_alt', true) . '"></a></div>';
				}

				echo '<div class="kids_post_content"><h4><a href="' . get_permalink() . '">'. get_the_title() . '</a></h4>';
				if ( $show_date ) {
					echo '<p>'. the_excerpt_max_charlength(25) .'</p>';
					echo ('<p class="time-post">' . get_the_date() .'</p>');
				} else {
					echo '<p>'. the_excerpt_max_charlength(40) .'</p>';
				}	
				echo '</div></li>';

			}  wp_reset_postdata();

			echo '</ul></div></div>' . $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);
			$instance['num_to_show'] = strip_tags($new_instance['num_to_show']);
			$instance['category'] = (int) $new_instance['category'];
			$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;


			return $instance;
		}

		function form( $instance ) {
			$title = isset($instance['title']) ? $instance['title'] : '';
			$num_to_show = isset($instance['num_to_show']) ? $instance['num_to_show'] : '';
			$category  = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : 0;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
			$cats = get_terms( 'category' );
	?>
				<p><label>Title: <input name="<?php echo $this->get_field_name('title'); ?>"
			type="text" value="<?php echo $title; ?>" /></label></p>
				</p>

		<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php __('Category:', 'happykids'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
		<option value="0"><?php __('All Categories', 'happykids'); ?></option>
		<?php
		foreach ( $cats as $cat ) {
			echo '<option value="' . intval( $cat->term_id ) . '"'
				. selected( $instance['category'], $cat->term_id, false )
				. '>' . $cat->name . "</option>\n";
		}
		?>
		</select>

		<p><label>Posts to show:</label>
		<select name="<?php echo $this->get_field_name('num_to_show'); ?>">
		<?php
			for ( $i = 0; $i <= 8; $i++){
				echo ' <option ';
				if ($num_to_show == $i){echo 'selected="selected"';}
				echo ' value="'. $i .'">' . $i .'</option>';
			}
		?>
		</select></p>
		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e('Show post date', 'happykids'); ?></label></p>

				<?php
		}
	}

?>