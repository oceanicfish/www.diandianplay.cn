<?php

	add_action('init', 'cws_shortcodes_button');

	function cws_shortcodes_button() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}
	}

?>