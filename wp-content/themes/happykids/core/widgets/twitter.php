<?php
	/**
	 * Twitter Widget Class
	 */
class CWS_Widget_Tweets extends WP_Widget {

		function __construct() {
			// Instantiate the parent object
			parent::__construct( false, THEME_NAME . __(' - Twitter', 'happykids') );
		}

	function widget($args, $instance) {

		extract($args);
		extract($instance);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : "";
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4; // default value
		$visible_num = isset( $instance['visible_num'] ) ? absint( $instance['visible_num'] ) : 2;

		echo $before_widget;

		$shortcode = "[twitter tweets='$number' visible='$visible_num' title='$title' before_title='$before_title' after_title='$after_title' sidebar='true' ]";

		echo do_shortcode( $shortcode );

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['visible_num'] = (int)$new_instance['visible_num'];

		return $instance;
	}

	function form( $instance ) {
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		$visible_num = isset( $instance['visible_num'] ) ? absint( $instance['visible_num'] ) : 2;
		$title 	= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Twitter';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __('Title:', 'happykids'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number') ?>"><?php _e( 'Tweets to show:', 'happykids' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('visible_num') ?>"><?php _e( 'Tweets per slide:', 'happykids' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'visible_num' ); ?>" name="<?php echo $this->get_field_name( 'visible_num' ); ?>" type="text" value="<?php echo $visible_num; ?>" /></p>

<?php
	}
}
?>