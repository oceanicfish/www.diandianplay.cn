<?php
	/**
	 * Video Widget Class
	 */
	class CWS_Widget_Video extends WP_Widget {

		function __construct() {
			parent::__construct( false, THEME_NAME . __(' - Video', 'happykids') );
		}

		function widget( $args, $instance ){
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			$head = '';
			$gen_sets = theme_get_option('general', 'gen_sets');

			$yt_color = ( isset($gen_sets['_yt_color']) ) ? stripslashes($gen_sets['_yt_color']) : '';
			$yt_theme = ( isset($gen_sets['_yt_theme']) ) ? stripslashes($gen_sets['_yt_theme']) : '';
			$vim_color = ( isset($gen_sets['_vim_color']) ) ? stripslashes($gen_sets['_vim_color']) : '';
			$vim_title = isset($gen_sets['_vim_header']) ? stripslashes($gen_sets['_vim_header']) : '';
			$video_id = isset($instance['video_id']) ? $instance['video_id'] : '';
			$v_type = isset($instance['v_type']) ? $instance['v_type'] : '';
			$v_width = isset($instance['v_width']) ? $instance['v_width'] : 260;
			$v_height = isset($instance['v_height']) ? $instance['v_height'] : 200;

			if ($v_type == 'youtube') $parser_return = theme_youtube_parser($video_id, $v_width, $v_height, null, $yt_color, $yt_theme);
			if ($v_type == 'vimeo') $parser_return = theme_vimeo_parser($video_id, $v_width, $v_height, null, $vim_color, $vim_title);

			if($title && $title != '') $head = '<h3 class="widget-title">' . $title . '</h3>';
			$rand = rand(1,200);
			$v_style = 'style="padding-bottom: ' . ceil(($v_height / $v_width)*100) . '%";';
			echo $args['before_widget'];
			echo $head;
			echo '<div class="widget-content"><div class="widget_video">';
			echo '<div class="kids_video_wrapper">
						 <figure ' .$v_style. '>' .$parser_return . '</figure>
						 </div>
						<div class="kids_clear"></div>
					</div></div>' .
				$args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['video_id'] = strip_tags($new_instance['video_id']);
			$instance['v_type'] = strip_tags($new_instance['v_type']);
			$instance['v_width'] = strip_tags($new_instance['v_width']);
			$instance['v_height'] = strip_tags($new_instance['v_height']);

			return $instance;

		}

		function form( $instance ){

			$title = isset($instance['title']) ? $instance['title'] : '';
			$video_id = isset($instance['video_id']) ? $instance['video_id'] : '';
			$v_type = isset($instance['v_type']) ? $instance['v_type'] : '';
			$v_width = isset($instance['v_width']) ? $instance['v_width'] : 260;
			$v_height = isset($instance['v_height']) ? $instance['v_height'] : 200;
			$v_hosts = array('youtube' => 'Youtube', 'vimeo' => 'Vimeo');

		?>
		<div class="testimonial_item_container">
			<p>
				<label><?php _e('Title:', 'happykids'); ?> <input name="<?php echo $this->get_field_name('title')?>" type="text" value="<?php echo $title; ?>" style="width: 208px; margin-left: 53px" /></label></p>
				<label><?php _e('Video source:', 'happykids'); ?></label>
				<select name="<?php echo $this->get_field_name('v_type'); ?>">';
<?php
					foreach( $v_hosts as $key => $value ){
						echo '<option ';
						if ($v_type == $key) echo 'selected="selected"';
						echo ' value="'. $key .'">' . $value .'</option>';
					}
?>
				</select><br>
				<p><label><?php _e('Source ID:', 'happykids'); ?> <input name="<?php echo $this->get_field_name('video_id')?>" type="text" value="<?php echo $video_id; ?>" style="width: 208px; margin-left: 21px" /></label></p>
				<p><label><?php _e('Width(px):', 'happykids'); ?><input name="<?php echo $this->get_field_name('v_width')?>" type="text" value="<?php echo $v_width; ?>" style="width: 65px; margin-left: 22px" /></label>
				<label><?php _e('Height(px):', 'happykids'); ?> <input name="<?php echo $this->get_field_name('v_height')?>" type="text" value="<?php echo $v_height; ?>" style="width: 65px; margin-left: 5px" /></label></p>
		</div>

		<?php

		}

	}

?>