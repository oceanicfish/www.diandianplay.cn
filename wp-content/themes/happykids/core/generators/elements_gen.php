<?php
/**
 * Theme Options Elements Generator.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 1.0
 * @version     3.3.0
 */	
	class elementsGenerator {

		function text($item) {
			extract($this->option_atts(array(
				"id" => "",
				"desc" => "",
				"default" => "",
				"value" => "",
				"size" => "",
				"class"=> "",
				"placeholder"=> "",
				"styles"=> "",
			), $item));

			$class = isset($class) ? ' class="'.$class.'"':'';
			$default = isset($item['default']) ? $item['default'] : '';
			$value = isset($value) ? sanitize_text_field($value) : '';
			if (!$value && $default) $value = $default;
			$size = isset($size) ? $size : '';
			$styles = isset($styles) ? $styles : '';
			$desc = isset($desc) ? '<lable>' . $desc . '</lable>' : '';

			echo '<div style="'.$styles.'">
					<input'.$class.' name="' . $id . '" id="' . $id . '" type="text" maxlength="' . $size . '" value="' . $value . '" placeholder="'. $placeholder .'" />' . $desc . '
				  </div>';
		}

		function button($item) {
			extract($this->option_atts(array(
				"id" => "",
				"default" => "",
				"class" => "",
				"styles"=> "",
			), $item));

			$class = isset($class) ? ' class="creaws_form_button '.$class.'"' : 'class="creaws_form_button"';
			$default = isset($item['default']) ? $item['default'] : '';
			$button_text = isset($item['button_text']) ? $item['button_text'] : '';
			$link = isset($item['link']) ? $item['link'] : '#';
			$icon = isset($item['icon']) ? '<i class="fa fa-'.$item['icon'].'"></i>' : '';
			$styles = isset($styles) ? $styles : '';

			echo '<a href="'.$link.'" '. $class .' '. $styles .'>'. $icon . $button_text .'</a>';
		}

		function col_cont($item) {
			extract($this->option_atts(array(
				"id" => "",
				"col_cont" => "",
				"class" => "",
			), $item));
			$col_cont = isset($col_cont) ? ' class="'.$col_cont.'"':'';

			echo '<div>';
		}

		function textarea($item) {
			extract($this->option_atts(array(
				"id" => "",
				"default" => "",
				"value" => "",
				"rows" => "7",
				"class"=> "",
				"placeholder" => ""
			), $item));
			$class = $class?' class="'.$class.'"':'';

			$holder = isset($item['placeholder']) ? $item['placeholder'] : __('Message', 'happykids');

			echo '<textarea'.$class.' rows="' . $rows . '" name="' . $id . '" id="' . $id . '" type="textarea" placeholder="'.$holder.'">' . esc_textarea($value) . '</textarea>';
		}


		function select($item){

			extract($this->option_atts(array(
				"default" => "",
				"styles"=> "",
			), $item));

			$selected_value = isset ($item['value']) ? $item['value'] : '';
			if (!$selected_value) $selected_value = $default;

			$class = isset ($item['class']) ? $item['class'] : '';
			if ('icons' === $class) {
				$select_content = cws_print_fa_select($selected_value);
			} else {
				$select_content = '';
				foreach ($item['options'] as $option => $option_value) {
					$selected = ($selected_value == $option) ? ' selected="selected"' : '';
					$select_content .= '<option value="'. $option .'" '. $selected .'>'. $option_value .'</option>';
				}
			}

			$style = empty($item['styles']) ? '' : 'style="'.$item['styles'].'"';
			$select_description = isset($item['desc']) ? $item['desc'] : '';

			echo <<<SELECT
				<div {$style}>
					<select name="{$item['id']}" id="{$item['id']}" class="{$class}" data-type="select">
						{$select_content}
					</select>
					<span class="select_box"></span>
					<label>{$select_description}</label>
				</div>
SELECT;
		}

		function checkbox($item){
			extract($this->option_atts(array("default" => "", "value" => ""), $item));

			$default = isset($default) ? $default : '';
			$value = isset($value) ? $value : $default;
			$checker = '';

			if( $value ){
				$checker = ' checked="checked" ';
			}

			$description = ( isset($item['desc']) && $item['desc'] ) ? $item['desc'] : '';
			echo <<<CHECKBOX
					<div class="menu_option_item_container checkbox_item">
						<div class="_check">
							<input type="checkbox" id="{$item['id']}" {$checker} name="{$item['id']}" data-type="checkbox" data-default="{$default}" />
							<label for="{$item['id']}">{$description}</label>
						</div>
					</div>
CHECKBOX;
		}

		function color_picker($item) {
			extract($this->option_atts(array(
				"id" => "",
				"default" => "",
				"value" => "",
				"size" => "10",
				"class" => "",
				"desc" => "",
			), $item));

			$class = isset($class) ? ' class="'.$class.'"':'';
			$default = isset($item['default']) ? $item['default'] : '';
			$value = isset($value) ? $value : '';
			if (!$value && $default) $value = $default;
			$size = isset($size) ? $size : '';

			$class = $class?' class="'.$class.'"':'';

			$desc = $desc? $desc :'';

			echo '<div class="color-input-wrap"><input class="cws_colorpicker" name="' . $id . '" id="' . $id . '" type="text" size="' . $size . '" value="' . $value . '" /><div class="desc">'.$desc.'</div></div>';
		}

		function sidebar_name_select ($item){
			global $wp_registered_sidebars;
			$selected_value = $item['value'] ? $item['value'] : '';
			$empty = '<option value="empty">' . __("--- Select Sidebar ---", 'happykids') . '</option>';
			$select_content = $empty;

			foreach( $wp_registered_sidebars  as $sidebar => $name ){
				$selected = ($selected_value == $name['id']) ? ' selected="selected"' : '';
				$select_content .= '<option value="'. $name['id'] .'" '. $selected .'>'. $name['name'] .'</option>';
			}
			$item_class = isset($item['class']) ? $item['class'] : '';
			echo <<<SIDEBAR_NAME_SELECT
					<div class="menu_option_item_container {$item_class}">
						<select name="{$item['id']}" id="{$item['id']}" data-type="select">
							{$select_content}
						</select>
					</div>
SIDEBAR_NAME_SELECT;
		}

		function slide_cat_select($item){
			$selected_value = $item['value'] ? $item['value'] : '';
			$select_content = '';
			$select_all	= '';
			$no_tax = '';
			$terms = get_terms('slideshow_category');
			if (!$terms){$no_tax = '<option value="none">' . __("--No Categories--", 'happykids') . '</option>';}

			foreach(get_terms('slideshow_category') as $cur_term){
				$selected = ($selected_value == $cur_term->slug) ? ' selected="selected"' : '';
				$select_content .= '<option value="'. $cur_term->slug .'" '. $selected .'>'. $cur_term->name .'</option>';
				$select_all = '<option value="">'. __("All", 'happykids') . '</option>';
			}
			echo <<<SLIDE_CAT_SELECT
					<div class="menu_option_item_container {$item['class']}">
						<select name="{$item['id']}" id="{$item['id']}" data-type="select">
							{$no_tax}
							{$select_all}
							{$select_content}
						</select>
						{$item['desc']}
					</div>
SLIDE_CAT_SELECT;
		}

		function pattern_select($item){
			$selected_value = $item['value'] ? $item['value'] : $item['default'];
			$select_content = '';
			$options = $item['options'];

			foreach($options as $key => $value){
				$select_content .= '<li><a class="'. $key .'" title="'. $value .'"></a></li>';
			}
			echo <<<PATTERN_SELECT
					<div class="menu_option_item_container">
						<div class="kids_theme_control_panel">
							<div id="patterns">
								<ul>
								{$select_content}
								</ul>
							</div>
							<input type="hidden" value="{$selected_value}" name="{$item['id']}" id="{$item['id']}" />
						</div>
						<script type="text/javascript">
							jQuery(document).ready(function($){
								$("#patterns a").each(function(){
									var savedVal = $("#{$item['id']}").val();
									var aClass = $(this).attr("class");
									if (savedVal == aClass){
										$(this).parent().addClass("active");
									}
								});

								$("#patterns a").click(function(){
									$("#patterns a").parent().removeClass("active");
									$(this).parent().addClass("active");
									var value = $(this).attr("class");
									$("#{$item['id']}").val(value);
								});
							});
						</script>
					</div>
PATTERN_SELECT;
		}

		function color_select($item){
			$selected_value = $item['value'] ? $item['value'] : $item['default'];
			$select_content = '';
			$options = $item['options'];

			foreach($options as $key => $value){
				$select_content .= '<li><a class="'. $key .'" title="'. $value .'"></a><span class="active_skin"></span></li>';
			}
			echo <<<COLOR_SELECT
					<div class="menu_option_item_container">
						<div class="kids_theme_control_panel">
							<div id="color_schema">
								<ul>
								{$select_content}
								</ul>
							</div>
							<input type="hidden" value="{$selected_value}" name="{$item['id']}" id="{$item['id']}" />
						</div>
						<script type="text/javascript">
							jQuery(document).ready(function($){
								$("#color_schema a").each(function(){
									var savedVal = $("#{$item['id']}").val();
									var aClass = $(this).attr("class");
									if (savedVal == aClass){
										$(this).parent().addClass("active");
									}
								});

								$("#color_schema a").click(function(){
									$("#color_schema a").parent().removeClass("active");
									$(this).parent().addClass("active");
									var value = $(this).attr("class");
									$("#{$item['id']}").val(value);
								});
							});
						</script>
					</div>
COLOR_SELECT;
		}

		function sidebars_list($item){
			$selected_value = $item['value'] ? $item['value'] : '';

			echo <<<SIDEBARS_LIST
				<div class="menu_option_item_container">
					<div class="two-column"><input type="text" value="" class="sidebars_list_formatter"/></div>
					<div class="two-column"><a herf="#" class="creaws_form_button" id="_add_sidebar">Add Sidebar</a></div>
					<div class="creaws_sidebars">
					</div>
					<input type="hidden" value="{$selected_value}" id="{$item['id']}" name="{$item['id']}" />
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function($){

						var slideItems = $("#{$item['id']}").val();
						var elementsList = slideItems.split("|");

						for (var key in elementsList){
    						var val = elementsList [key];
    						if (val){
    							$(".creaws_sidebars").append("<div class='one-column'><div class=\"creaws_sidebar_items two-column\" data-attr=\""+ val +"\"><p>" + val + "</p><a href=\"#\" class=\"creaws_x fa fa-times\"></a></div></div>");
    						}
						}

						$("#_add_sidebar").click(function(){
							var sideName = $(".sidebars_list_formatter").val();
							var sideList = $("#{$item['id']}").val();

							if (sideList && sideName){
								$("#{$item['id']}").val(sideList + "|" + sideName);
							}else if (sideName){
								$("#{$item['id']}").val("|" + sideName);
							}
							if (sideName){
								$(".creaws_sidebars").append("<div class='one-column'><div class=\"creaws_sidebar_items two-column\" data-attr=\""+ sideName +"\"><p>" + sideName + "</p><a href=\"#\" class=\"creaws_x fa fa-times\"></a></div></div>");
							}
							$(".sidebars_list_formatter").val("");
						});

						$(".creaws_x").live('click', function(){
							var sideName = $(this).parent().attr("data-attr");
							var sideList = $("#{$item['id']}").val();
							var deleteResult = sideList.replace( "|" + sideName, "" );
							$("#{$item['id']}").val(deleteResult);

							$(this).parent().remove();
						});
					});
				</script>

SIDEBARS_LIST;

		}

		function slide_port_select($item){
			$selected_value = $item['value'] ? explode(',',$item['value']) : '';
			$select_content = '';
			$select_all	= '';
			$no_tax = '';
			$terms = get_terms('portfolio_category');
			if (!$terms){$no_tax = '<option value="none">'. __("--No Categories--", 'happykids') . '</option>';}

			foreach($terms as $cur_term){
				$selected = (is_array($selected_value) && in_array($cur_term->slug, $selected_value )) ? ' selected="selected"' : '';
				$select_content .= '<option value="'. $cur_term->slug .'" '. $selected .'>'. $cur_term->name .'</option>';
				$select_all = '<option value="">'. __("All", 'happykids') . '</option>';
			}
			echo <<<SLIDE_PORT_SELECT
					<div class="menu_option_item_container {$item['class']}">
						<select multiple name="{$item['id']}[]" id="{$item['id']}" data-type="select">
							{$no_tax}
							{$select_all}
							{$select_content}
						</select>
						{$item['desc']}
					</div>
SLIDE_PORT_SELECT;
		}

		function slide_blog_select($item){
			$selected_value = $item['value'] ? $item['value'] : '';
			$select_content = '';
			$select_all	= '';
			$no_tax = '';
			$terms = get_terms('category');
			if (!$terms){$no_tax = '<option value="none">'. __("--No Categories--", 'happykids') . '</option>';}

			foreach($terms as $cur_term){
				$selected = ($selected_value == $cur_term->slug) ? ' selected="selected"' : '';
				$select_content .= '<option value="'. $cur_term->slug .'" '. $selected .'>'. $cur_term->name .'</option>';
				$select_all = '<option value="">'. __("All", 'happykids') . '</option>';
			}
			echo <<<SLIDE_BLOG_SELECT
					<div class="menu_option_item_container {$item['class']}">
						<select name="{$item['id']}" id="{$item['id']}" data-type="select">
							{$no_tax}
							{$select_all}
							{$select_content}
						</select>
						{$item['desc']}
					</div>
SLIDE_BLOG_SELECT;
		}
	function editor($item) {
		extract($this->option_atts(array(
			"id" => "",
			"default" => "",
			"value" => "",
		), $item));

		$settings = array(
							"wpautop" => true,
							"media_buttons" => true
						);

		echo '<div class="cws_a_editor">';
			wp_editor($value,$id,$settings);
		echo '</div>';
	}

		function uploader($item){

			extract($this->option_atts(array(
				"preview_width" => "",
				"preview_height" => "",
			), $item));

			if (isset($item['value']) && $item['value'] != '') {
				// $medup_val = stripslashes($item['value']);
				// $medup_val = str_replace ("\"", "&quot;", $medup_val);
				$medup_val = esc_url($item['value']);

			} else {
				$medup_val = '';
			}

			if ($medup_val && ($item['preview'] == 'show')){
					if ($preview_height || $preview_width){
						$thumb_obj = bfi_thumb( $medup_val, array('width' => $preview_width, 'height' => $preview_height, 'crop' => true) );
						$preview_img = $thumb_obj[0];
						$preview = '<div class="two-column" style="vertical-align:top"><div class="'. $item['id'] .'-preview uploader_preview"><img src="' . $preview_img . '" alt="'.$item['name'].'" /></div></div>';
					}else {
						$preview = '<div class="two-column" style="vertical-align:top"><div class="'. $item['id'] .'-preview uploader_preview"><img src="'. $medup_val .'" alt="'. $item['name'] .'" /></div></div>';
					}
			}else{
				$preview = '';
			}
			$description = ( isset($item['desc']) && $item['desc'] ) ? $item['desc'] : '';
			$gen_set = theme_get_option('general', 'gen_sets');
			$is_active_hdpi = empty ($gen_set[$item['id'].'-ppi']) ? false : true ;
			$checker = '';
			if( $is_active_hdpi ){
			 	$checker = ' checked="checked" ';
			 }

			$hdpi = ( isset($item['ppi']) && $item['ppi'] ) ? $item['ppi'] : '';
			$hdpi = ($hdpi == "show") ? '<input type="checkbox" id="' . $item['id'] . '-ppi" name="' . $item['id'] . '-ppi" data-type="checkbox" '. $checker .' style="float:left; margin-top: 5px;">
							<label for="' . $item['id'] . '-ppi" style="float:left; margin-top: 4px;">this is a high-DPI image</label>' : '';
			echo <<<UPLOADER
					<div class="uploader_wrap">
					<div class="two-column">
						<div class="uploader" style="text-align:right">
							<input type="text" name="{$item['id']}" id="{$item['id']}" value="{$medup_val}" readonly="readonly"/>
							{$hdpi}
							<input type="button" class="button" name="{$item['id']}_c-button" id="{$item['id']}_c-button" value="Clear" />
							<input type="button" class="button media_upload_button" name="{$item['id']}_u-button" id="{$item['id']}_u-button" value="Upload" />
							<div class="description">{$description}</div>
						</div>
					</div>{$preview}
					<script type="text/javascript">
						// media uploader start
						jQuery(document).ready(function($){
						  var _custom_media = true,
						      _orig_send_attachment = wp.media.editor.send.attachment;
						  $('#{$item['id']}_u-button').click(function(e) {
						    var send_attachment_bkp = wp.media.editor.send.attachment;
						    var button = $(this);
						    var id = button.attr('id').replace('_button', '');
						    _custom_media = true;
						    wp.media.editor.send.attachment = function(props, attachment){
						      if ( _custom_media ) {
						        $('#{$item['id']}').val(attachment.url);
						        $('.{$item['id']}-preview.uploader_preview img').attr('src',attachment.url);
						      } else {
						        return _orig_send_attachment.apply( this, [props, attachment] );
						      };
						    }
						    window.send_to_editor = function () { return; }
						    wp.media.editor.open(button);
						    return false;
						  });
						  $('.add_media').on('click', function(){
						    _custom_media = false;
						  });

							$('#{$item['id']}_c-button').click(function(){
								$('#{$item['id']}').val('');
								$('.{$item['id']}-preview img').remove();
								$('.{$item['id']}-preview').append('<img src="{$item['default']}" alt="{$item['name']}" />');
							});

						});
						// media uploader ends
					</script>
					</div>
UPLOADER;
		}

		function option_atts($pairs, $atts){
			$atts = (array)$atts;
			$out = array();
			foreach($pairs as $name => $default) {
				if ( array_key_exists($name, $atts) )
					$out[$name] = $atts[$name];
				else
					$out[$name] = $default;
			}
			return $out;
		}

		function font_select($item){
?>
			<div class="font_cont">
				<?php
					echo isset($item['desc']) ? $item['desc'] : '';
					global $Fonts;
					$font_list = $Fonts->build_admin_font_selector();
					$font_size = isset($item['font_size']) ? $item['font_size'] : 16;
					$selected_value = isset($item['value']) ? $item['value'] : $item['default'];
					$subsets = isset($font_list['Goggle fonts'][$selected_value]['subsets']) ? $font_list['Goggle fonts'][$selected_value]['subsets'] : null;
					$variants = isset($font_list['Goggle fonts'][$selected_value]['variants']) ? $font_list['Goggle fonts'][$selected_value]['variants'] : '400';
				 ?>
				<select name="<?php echo $item['id']; ?>" id="<?php echo $item['id']; ?>" class="gfont_select two-column" data-gfontajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">
					<option value="<?php echo $item['default'] ?>"><?php _e("--- Select font ---", 'happykids'); ?> </option>
					<?php
					foreach ($font_list as $option => $option_value) { ?>
						<optgroup label="<?php echo $option; ?>">
						<?php foreach ($option_value as $font) {
							if (!is_array($font)) { ?>
							<option data-gfonttype="<?php echo $option; ?>" data-subsets="<?php print_r($subsets); ?>" data-variants="<?php print_r($variants); ?>" value="<?php echo $font; ?>" <?php if ($selected_value == $font) { echo 'selected="selected"'; } ?>><?php echo $font; ?></option>
						<?php }
						 } ?>
						</optgroup>
						<?php
					}
				  ?>
				</select>
				<?php
				$gen_set = theme_get_option('general', 'gen_sets');
				$selected_subset = isset($gen_set[$item['id'].'-subset']) ? $gen_set[$item['id'].'-subset'] : "latin";
				?>
				<div class="two-column">
					<select name="<?php echo $item['id'].'-subset'; ?>" id="<?php echo $item['id'].'-subset'; ?>" class="gfont_subset_select two-column">
						<option value="<?php echo $item['id'] ?>" disabled><?php _e("--- Subset ---", 'happykids'); ?> </option>
					  <?php
						foreach ($subsets as $subset) { ?>
								<option value="<?php echo $subset; ?>" <?php if ($selected_subset == $subset) { echo 'selected="selected"'; } ?>><?php echo $subset; ?></option>
							<?php } ?>
					</select>

					<?php
					$selected_variant = isset($gen_set[$item['id'].'-variant']) ? $gen_set[$item['id'].'-variant'] : "regular";
					?>
					<select name="<?php echo $item['id'].'-variant'; ?>" id="<?php echo $item['id'].'-variant'; ?>" class="gfont_variant_select two-column">
						<option value="<?php echo $item['id'] ?>" disabled><?php _e("--- Font variant ---", 'happykids'); ?> </option>
					  <?php
						foreach ($variants as $variant) { ?>
								<option value="<?php echo $variant; ?>" <?php if ($selected_variant == $variant) { echo 'selected="selected"'; } ?>><?php echo $variant; ?></option>
							<?php } ?>
					</select>
				</div>
				<?php
				$default_f_size = isset($item['font_size']) ? $item['font_size'] : 19;
				$selected_f_size = isset($gen_set[$item['id'].'-font_size']) ? $gen_set[$item['id'].'-font_size'] : $default_f_size;
				echo '<input name="' . $item['id'] . '-font_size" id="' . $item['id'] . '-font_size" type="text" value="' . $selected_f_size . '" title = "' . __('Font Size (px)', 'happykids') . '" />';

				$default_line_height = isset($item['line_height']) ? $item['line_height'] : 1.5;
				$selected_line_height = isset ($gen_set[$item['id'].'-line_height']) ? $gen_set[$item['id'].'-line_height'] : $default_line_height;
				echo '<input name="' . $item['id'] . '-line_height" id="' . $item['id'] . '-line_height" type="text" value="' . $selected_line_height . '" title = "' . __('Line height (em)', 'happykids') . '" />';

				$default_f_color = isset($item['font_color']) ? $item['font_color'] : '#fff';
				$selected_f_color = isset($gen_set[$item['id'].'-color']) ? $gen_set[$item['id'].'-color'] : $default_f_color;
				echo '<input class="cws_colorpicker" name="' . $item['id'] . '-color" id="' . $item['id'] . '-color" type="text" value="' . $selected_f_color . '" />';
				?>
				<div class="gfont_preview" <?php if( $selected_value ) echo ' style="font-size:'. $selected_f_size .'px; font-family:'. $selected_value .'; color:'. $selected_f_color .'; line-height:'. $selected_line_height .'em";'; ?>> <?php _e("Grumpy wizards make toxic brew for the evil Queen and Jack.", 'happykids'); ?> </div>
			</div>
<?php
		}

	}

?>