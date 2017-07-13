<?php
	/**
	 * Latest Posts Widget Class
	 */
class CWS_Widget_Benefits extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_cws_benefits', 'description' => __( 'Modified CWS Text widget', 'happykids') );
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('cws_benefits', __('CWS Benefits', 'happykids'), $widget_ops);
	}

	function widget( $args, $instance ) {

		extract( $args );
		extract( $instance );

		$title = apply_filters( 'widget_title', empty( $title ) ? '' : $title, $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $text ) ? '' : $text, $instance );
		$link = $instance['link'];
		$button = empty($instance['button']) ? __( 'More', 'happykids') : $instance['button'];

		echo $before_widget;

		/* ICON OUTPUT */
		$args = array("title_select"=>$title_select,"title_fa"=>$title_fa,"title_img"=>$title_img);
		cws_widget_icon_rendering($args);
		/* ICON OUTPUT */

		?>
		<div class="cws-widget-content benefits_widget">
			<?php if (isset( $title )) echo $before_title . $title . $after_title; ?>
			<aside class="text_part"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></aside>
			<?php echo !empty($link) ? do_shortcode('[cws_button type=default size=medium link="'.$link.'"]'.$button.'[/cws_button]') : ""; ?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link'] = $new_instance['link'];
		$instance['button'] = $new_instance['button'];
		/* ICON VARIABLES */
		$instance['title_select'] = $new_instance['title_select'];
		$instance['title_fa'] = strip_tags($new_instance['title_fa']);
		$instance['title_img'] = strip_tags($new_instance['title_img']);
		$instance['show_icon_options'] = $new_instance['show_icon_options'];
		/* ICON VARIABLES */
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		$link = isset($instance['link']) ? $instance['link']: '';
		$button = isset($instance['button']) ? $instance['button']: __( 'More', 'happykids');
		/* ICON VARIABLES */
		$title_select = isset( $instance['title_select'] ) ? strval($instance['title_select']) : 'fa';
		$title_fa = isset( $instance['title_fa'] ) ? strip_tags($instance['title_fa']) : '';
		$title_img = isset( $instance['title_img'] ) ? strval($instance['title_img']) : '';
		$display_none = ' style="display:none"';
		$thumb_url = $title_img ? '="' . wp_get_attachment_thumb_url($title_img) . '"' : '';
		$show_icon_options = isset($instance['show_icon_options']) ? $instance['show_icon_options'] : false;
		/* ICON VARIABLES */

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'happykids'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p>
		<input type="checkbox" class="show_icon_options" id="<?php echo $this->get_field_id('show_icon_options'); ?>" name="<?php echo $this->get_field_name('show_icon_options'); ?>" <?php echo $show_icon_options == 'on' ? 'checked' : ''; ?> />
		<label for="<?php echo $this->get_field_id('show_icon_options'); ?>"><?php _e("Show icon options", 'happykids'); ?></label>
		</p>

		<!-- ICON SELECTION -->
				<?php $args = array('title_select'=>$title_select,'title_fa'=>$title_fa,'title_img'=>$title_img,'thumb_url'=>$thumb_url,'display_none'=>$display_none,'show_icon_options'=>$show_icon_options,'_this'=>$this,'all'=>true);
				cws_widget_icon_selection($args);
				?>
		<!-- ICON SELECTION -->


		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;
		<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs', 'happykids'); ?></label></p>
		
		<p><input id="<?php echo $this->get_field_id('button') ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo $button; ?>" />
		<label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button name', 'happykids'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('link') ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo !empty($link) ? $link : ''; ?>" />
		<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Read more URL', 'happykids'); ?></label></p>
<?php
	}
}

?>