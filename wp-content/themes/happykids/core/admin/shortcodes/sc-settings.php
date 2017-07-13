<?php
global $cws_shortcode_attr;
$price_categories = array();
$cws_shortcode_attr = array(
	'quote'=>array(
		'options'=>array(
			array(
				'id' => 'photo',
				'title' => __('Image', 'happykids'),
				'type' => 'media_library'
			),
			array(
				'id' => 'text',
				'title' => __('Quote text','happykids'),
				'type' => 'textarea',
				'w' => '75%',
				'rows' => '3'
			),
			array(
				'id' => 'author',
				'title' => __('Author','happykids'),
				'desc' => '',
				'type' => 'text',
				'w' => '75%'
			),
		)
	),
	'cws_cta'=>array(
		'options'=>array(
			array(
				'id' => 'fa',
				'title' => __('Icon','happykids'),
				'desc' => __('Icon', 'happykids'),
				'type' => 'select',
				'default' => '',
				'w' => '50%'
			),
			array(
				'id' => 'title',
				'title' => __('Title','happykids'),
				'type' => 'text',
				'w' => '50%'
			),
			array(
				'id' => 'text',
				'title' => __('Text','happykids'),
				'type' => 'textarea',
				'rows' => '5',
				'w' => '50%'
			),
			array(
				'id' => 'button_text',
				'title' => __('Button','happykids'),
				'type' => 'text',
				'w' => '50%'
			),
			array(
				'title' => __('Button URL','happykids'),
				'id' => 'link',
				'type' => 'text',
				'w' => '50%'
			)
		)
	),
	'embed' => array(
		'options' => array(
			array(
				'id' => 'url',
				'title' => __('Video/Audio url','happykids'),
				'type' => 'textarea',
				'rows' => '2'
			),
			array(
				'id' => 'width',
				'title' => __('Width','happykids'),
				'type' => 'text',
				'w' => '25%'
			),
			array(
				'id' => 'height',
				'title' => __('Height','happykids'),
				'type' => 'text',
				'w' => '25%'
			),
		)
	),
	'progress' => array(
		'options' => array(
			array(
				'id' => 'title',
				'title' => __('Title','happykids'),
				'type' => 'text',
				'w' => '50%'
			),
			array(
				'id' => 'progress',
				'title' => __('Percentage','happykids'),
				'desc' => __('From 0 to 100','happykids'),
				'type' => 'range',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'w' => '50%'
			),
			array(
				'id' => 'color',
				'title' => __('Color', 'happykids'),
				'type' => 'color',
				'default' => '',
				'w' => '50%'
			)
		)
	),
	'alert' => array(
		'options' => array(
			array(
				'id' => 'type',
				'title' => __('Type','happykids'),
				'desc' => __('Info Box Type','happykids'),
				'type' => 'select',
				'source' => array(
					'question' => __('Question','happykids'),
					'warning' => __('Warning','happykids'),
					'alert' => __('Alert','happykids'),
					'error' => __('Error','happykids'),
					'success' => __('Success','happykids'),
					'notice' => __('Notice','happykids'),
					),
				'default' => 'notice',
				'w' => '50%'
			),
			array(
				'id' => 'title',
				'title' => __('Title','happykids'),
				'type' => 'text',
				'w' => '50%'
			),
			array(
				'id' => 'text',
				'title' => __('Text','happykids'),
				'type' => 'textarea',
				'rows' => '3',
				'w' => '50%'
			),
			array(
				'id' => 'close_type',
				'title' => __('This box is closable','happykids'),
				'type' => 'check',
				'source' => array( '' => '' ),
				'default' => array(false),
				'w' => '50%'
			),
			array('id' => 'custom',
				  'desc' => __('Customize box', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hide'=>array('bg_color','fa')
			),
			array('id' => 'bg_color',
				  'desc' => __('Box Color','happykids'),
				  'type' => 'color',
				  'default' => '#fff',
				  'w' => '20%',
				  'hidden' => true
			),
			array('id' => 'fa',
				  'desc' => __('Icon','happykids'),
				  'type' => 'select',
				  'default' => '',
				  'w' => '100%',
				  'hidden' => true
			)
		)
	),
	'cws_button' => array(
		'options' => array(
			array('id' => 'type',
				  'desc' => __('Button type','happykids'),
				  'type' => 'select',
				  'source' => array(
				   		'default' => __('Rounded', 'happykids'),
				   		'square' => __('Square', 'happykids')
				   		),
				  'default' => 'default',
				  'w' => '50%'
			),
			array('id' => 'size',
				  'desc' =>__('Button size','happykids'),
				  'type' => 'select',
				  'source' => array(
				  		'large' => __('Large', 'happykids'),
				  		'medium' => __('Medium', 'happykids'),
				  		'small' => __('Small', 'happykids'),
				  		'mini' => __('Mini', 'happykids')
				  ),
				  'default' => 'medium',
				  'w' => '50%'),
			array('id' => 'text',
				  'desc' =>__('Text','happykids'),
				  'type' => 'text',
				  'default' => '',
				  'w' => '50%'),
			array(
				'id' => 'fa',
				'title' => __('Icon','happykids'),
				'desc' => __('Icon','happykids'),
				'type' => 'select',
				'w' => '50%'
			),
			array('id' => 'link',
				  'desc' =>__('URL','happykids'),
				  'type' => 'text',
				  'default' => '#',
				  'w' => '50%'),
			array('id' => 'custom_color',
				  'desc' => __('Customize button', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hide'=>array('button_color','text_color','icon_color')
				  ),
			array('id' => 'button_color',
				  'desc' => __('Button Color','happykids'),
				  'type' => 'color',
				  'default' => '#3185cb',
				  'w' => '20%',
				  'hidden' => true
				  ),
			array('id' => 'icon_color',
				  'desc' => __('Icon Color','happykids'),
				  'type' => 'color',
				  'default' => '#fff',
				  'w' => '20%',
				  'hidden' => true
				  ),
			array('id' => 'text_color',
				  'desc' => __('Text Color','happykids'),
				  'type' => 'color',
				  'default' => '#fff',
				  'w' => '20%',
				  'hidden' => true
				)
		)
	),
	'tweets' => array(
		'options' => array(
			array(
				'id' => 'title',
				'title' => __('Title','happykids'),
				'type' => 'text',
				'w' => '50%',
			),
			array(
				'id' => 'num',
				'title' => __('Number of tweets','happykids'),
				'type' => 'text',
				'default' => '4',
				'w' => '50%',
			),
			array(
				'id' => 'num_vis',
				'title' => __('Tweets per slide','happykids'),
				'type' => 'text',
				'default' => '2',
				'w' => '50%',
			),
		)
	),
	'fa' => array(
		'options' => array(
			array(
				'id' => 'fa',
				'title' => __('Icon','happykids'),
				'desc' => __('Icon','happykids'),
				'type' => 'select',
				'w' => '50%'
			),
			array(
				'id' => 'size',
				'title' => __('Size', 'happykids'),
				'desc' => __('Icon Size', 'happykids'),
				'type' => 'select',
				'source' => array(
					'1x' => '1x',
					'2x' => '2x',
					'3x' => '3x',
					'4x' => '4x',
					'5x' => '5x'
					),
				'default' => '2x',
				'w' => '50%',
			),
			array(
				'id' => 'custom_color',
				'title' => __('Customize','happykids'),
				'type' => 'check',
				'source' => array(
					'' => '',
					),
				'default' => array(false),
				'hide' => array('color','bg_color','border_color')
			),
			array(
				'id' => 'color',
				'title' => __('Text color','happykids'),
				'type' => 'color',
				'default' => '#008fd5',
				'w' => '20%',
				'hidden' => true
			),
			array(
				'id' => 'bg_color',
				'title' => __('Background color','happykids'),
				'type' => 'color',
				'default' => '#fff',
				'w' => '20%',
				'hidden' => true
			),
		)
	),
	'mark' => array(
		'options' => array(
			array(
				'id' => 'color',
				'title' => __('Text color','happykids'),
				'type' => 'color',
				'default' => '#fff',
				'w' => '25%'
			),
			array(
				'id' => 'bgcolor',
				'title' => __('Text background','happykids'),
				'type' => 'color',
				'default' => '#4db1e2', // this should be adjusted to the theme's current color scheme
				'w' => '25%'
			),
		)
	),
	'portfolio' => array(
		'options' => array(
			array(
				'id' => 'title',
				'title' => __('Title','happykids'),
				'type' => 'text',
				'w' => '50%'
			),
			array(
				'id' => 'cols',
				'title' => __('Columns','happykids'),
				'desc' => __('Columns','happykids'),
				'type' => 'select',
				'source' => array(
					'1' => __('One', 'happykids'),
					'2' => __('Two', 'happykids'),
					'3' => __('Three', 'happykids'),
					'4' => __('Four', 'happykids'),
					),
				'default' => '2',
				'w' => '50%'
			),
			array(
				'id' => 'cat',
				'title' => __('Categories','happykids'),
				'desc' => __('Categories','happykids'),
				'type' => 'select',
				'select' => 'multiple',
				'source' => 'category_portfolio_category',
				'w' => '50%'
			),
			array(
				'id' => 'posts',
				'title' => __('Items to load','happykids'),
				'type' => 'text',
				'w' => '100px'
			),
			array(
				'id' => 'usecarousel',
				'title' => __('Display as carousel', 'happykids'),
				'type' => 'check',
				'toggle' => array('carousel_title'),
				'source' => array('' => ''),
				'default' => array(true),
			),
			array('id' => 'portf_customize',
				  'desc' => __('Customize shortcode output', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hide'=>array('img_popup', 'img_width', 'img_height', 'txt_length', 'hide_text', 'hide_footer', 'show_rmore_button')
			),			
			array(
				'id' => 'img_popup',
				'title' => __('Enable Lightbox', 'happykids'),
				'type' => 'check',
				'source' => array('' => ''),
				'default' => array(true),
				'hidden' => true				
			),
			array(
				'id' => 'img_width',
				'title' => __('Image width','happykids'),
				'type' => 'text',
				'w' => '50%',
				'hidden' => true
			),	
			array(
				'id' => 'img_height',
				'title' => __('Image height','happykids'),
				'type' => 'text',
				'w' => '50%',
				'hidden' => true
			),
			array(
				'id' => 'hide_text',
				'title' => __('Hide title and description text', 'happykids'),
				'type' => 'check',
				'source' => array('' => ''),
				'default' => array(false),
				'hidden' => true				
			),			
			array(
				'id' => 'txt_length',
				'title' => __('Post text lenght','happykids'),
				'type' => 'text',
				'w' => '50%',
				'hidden' => true
			),			
			array('id' => 'show_rmore_button',
				  'desc' => __('Show More button', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hidden' => true,
				  'hide'=>array('button')
			),
			array('id' => 'button',
				  'desc' => __('Button name','happykids'),
				  'type' => 'text',
				  'w' => '50%',
				  'hidden' => true
			),
		),
	),
	'shortcode_carousel' => array(
		'options' => array(
			array(
				'id' => 'title',
				'title' => __('Title','happykids'),
				'type' => 'text',
				'default' => '',
				'w' => '50%',
			),
			array('id' => 'carousel_autop',
				  'desc' => __('Autoplay', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hide'=>array('carousel_autop_speed')
			),			
			array(
				'id' => 'carousel_autop_speed',
				'title' => __('Autoplay Speed (in milliseconds)','happykids'),
				'type' => 'text',
				'default' => '1000',
				'hidden' => true
			),			
			array(
				'id' => 'carousel_cols',
				'title' => __('Columns','happykids'),
				'desc' => __('Columns','happykids'),
				'type' => 'select',
				'source' => array(
					'1' => __('One', 'happykids'),
					'2' => __('Two', 'happykids'),
					'3' => __('Three', 'happykids'),
					'4' => __('Four', 'happykids'),
					),
				'default' => '4',
				'w' => '50%'
			),			
		),
	),
	'shortcode_blog' => array(
		'options' => array(
			array(
				'id' => 'title',
				'title' => __('Title','happykids'),
				'type' => 'text',
				'w' => '50%'
			),
			array(
				'id' => 'cols',
				'title' => __('Columns','happykids'),
				'desc' => __('Columns','happykids'),
				'type' => 'select',
				'source' => array(
					'1' => __('One', 'happykids'),
					'2' => __('Two', 'happykids'),
					'3' => __('Three', 'happykids'),
					'4' => __('Four', 'happykids'),
					),
				'default' => '2',
				'w' => '50%'
			),
			array(
				'id' => 'cats',
				'title' => __('Categories','happykids'),
				'desc' => __('Categories','happykids'),
				'type' => 'select',
				'select' => 'multiple',
				'source' => 'categories',
				'w' => '50%'
			),
			array(
				'id' => 'posts',
				'title' => __('Items to load','happykids'),
				'type' => 'text',
				'w' => '100px'
			),			
			array(
				'id' => 'usecarousel',
				'title' => __('Display as carousel', 'happykids'),
				'type' => 'check',
				'toggle' => array('carousel_title'),
				'source' => array('' => ''),
				'default' => array(true),
			),
			array('id' => 'blog_customize',
				  'desc' => __('Customize shortcode output', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hide'=>array('img_popup', 'img_width', 'img_height', 'txt_length', 'diplay_date', 'hide_footer', 'hide_meta', 'button')
			),
			array(
				'id' => 'img_popup',
				'title' => __('Enable Lightbox', 'happykids'),
				'type' => 'check',
				'toggle' => array('carousel_title'),
				'source' => array('' => ''),
				'default' => array(true),
				'hidden' => true
			),
			array(
				'id' => 'img_width',
				'title' => __('Image width','happykids'),
				'type' => 'text',
				'w' => '50%',
				'hidden' => true
			),	
			array(
				'id' => 'img_height',
				'title' => __('Image height','happykids'),
				'type' => 'text',
				'w' => '50%',
				'hidden' => true
			),
			array(
				'id' => 'txt_length',
				'title' => __('Post text lenght','happykids'),
				'type' => 'text',
				'w' => '50%',
				'hidden' => true
			),
			array('id' => 'hide_date',
				  'desc' => __('Hide date section', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hidden' => true
			),
			array('id' => 'hide_footer',
				  'desc' => __('Hide footer section', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hidden' => true
			),	
			array('id' => 'hide_meta',
				  'desc' => __('Hide meta section', 'happykids'),
				  'type' => 'check',
				  'source' => array( '' => '' ),
				  'default' => array(false),
				  'w' => '50%',
				  'hidden' => true
			),						
			array('id' => 'button',
				  'desc' => __('Button name','happykids'),
				  'type' => 'text',
				  'w' => '50%',
				  'hidden' => true
			),
		),
	),
);

// parse_options( ['options'], null, 'widget-' . $this->id_base, $this->number, '', false);
function parse_options ($options, $value, $prefix, $id_postfix = '', $parent = '', $usetd) {
	$output = '';
	$is_widget = false;
	$pre_prefix = 'cws-';
	if ('widget' == substr($prefix,0, 6) ) {
		$pre_prefix = 'class="widefat" ';
		$is_widget = true;
	}
	if (!empty($parent)) {
		$prefix = $prefix . '-' . $parent;
	}
	global $opt_attr;
	global $opt;
	$opt = $options;
	foreach($options as $attr) {
		$is_group = false;
		$opt_attr = $attr;
		$is_hidden = isset($attr['hidden']) ? $attr['hidden'] : false;
		if ($usetd)
			$output .= $is_hidden ? '<tr class="hidden" style="display:none;">' : '<tr>';
			//$output .= '<tr>';

			$width = isset($attr['w']) ? $attr['w'] : '';
			$title = isset($attr['title']) ? $attr['title'] : '';
			$current_value = isset($attr['default']) ? $attr['default'] : null;

			$style_width = !empty($width) ? ' style="width:' . $width . '"' : '';

			if ($usetd) {
				$output .= '<td>';
				if (!empty($value) && !isset($current_value)) {
					$current_value = $value;
				}
			}
			else {
				$is_group = true;
				// group
				$id = 'cws-mb-' . $parent . '-' . $attr['id'];
				if (!empty($value[$id])) {
					$current_value = $value[$id];
				}

				$output .= '<div class="group"';
				if (!empty($title))	{
					$title .= ':';
				}

				$inline_style = isset($attr['clear']) ? 'clear:both;' : '';

				$inline_style .= (isset($attr['hidden']) && true == $attr['hidden']) ? 'display:none;' : '';

				$inline_style .= !empty($width) ? 'width:' . $width . ';' : '';

				$output .= !empty($inline_style) ? ' style="'.$inline_style.'"' : '';


				$output .= '>';
			}

			if (!empty($title) && 'select' != $attr['type'])	{
				$output .= '<label for="'. $pre_prefix .'-'. $prefix . '-'. $attr['id'] . $id_postfix .'">' . $title . '</label>';
			}
			if ( isset($attr['desc']) ) {
				$output .= '<div class="desc">' . $attr['desc'] . '</div>';
			}

			if ($usetd)
				$output .= '</td><td>';
			elseif ($title)
				$output .= '&nbsp;&nbsp;';

			if ($is_widget) {
				//$unique_name = $prefix.'-'. $attr['id']; // . $id_postfix;
				// $prefix - widget-cws-services
				// $id_postfix - instance number
				$unique_name = $prefix .'['.$id_postfix.']['. $attr['id'] .']';
				$unique_id = $prefix .'-'.$id_postfix.'-'. $attr['id'];
				$name_id = ' name="'. $unique_name .'" id="'.	$unique_name .'"';
			} else {
				$unique_name = $pre_prefix . $prefix.'-'. $attr['id'] . $id_postfix;
				$name_id = ' name="'. $unique_name .'" id="'. $unique_name .'"';
			}

			if ( isset($attr['disabled']) && (true === $attr['disabled']) ) {
				$name_id .= ' disabled';
			}

			switch ($attr['type']) {
				case 'button':
					$output .= '<input type="button" class="button"' . $name_id . ' value="' . $attr['value'] . '" ' . $style_width . '/>';
				break;
				case 'image_select':
					if (isset($attr['options'])) {
						//$hidden = isset($attr['options']) ? ' style="display:'. ($attr['hidden'] ? 'none' : 'block') .';"' : '';
						$output .= '<ul class="redux-image-select"' . $name_id . '>';
						$options = $attr['options'];
						$attr_id = $attr['id'];
						$i = 0;
						foreach ($options as $k=>$v) {
							$i++;
							$output .= '<li class="redux-image-select">';
							$output .= '<label for="' . $attr_id . '_' . $i . '"' . ( $current_value == $k ? ' class="redux-image-select-selected"' : '' ) . '>';
							$js_onlick = gen_onclick($v, $prefix, 'show', $is_group);
							$output .= '<div class="cws_img_select_wrap">';
								$output .= '<input type="radio" ' .
									( !empty($js_onlick) ? $js_onlick . ' ' : '') .
									( $current_value == $k ? 'checked="checked"' : '' ) .
									' id="' . $attr_id . '_' . $i . '" name="' . $unique_name . '" value="'.$k.'">';
								$output .= '<img src="'.$v['img'].'" alt="'.$v['title'].'">';
							$output .= '</div>';
							$output .= '<div>'.$v['title'].'</div>';
							$output .= '</label></li>';
						}
						$output .= '</ul>';
					}
					break;
				case 'select':
					$multiple = '';
					if (isset($attr['select']) && $attr['select'] === 'multiple') {
						$multiple = ' multiple';
						if ($is_widget) {
							$name_id = ' name="'. $unique_name .'[]" id="'.	$unique_id .'[]"';
						}
						else {
							$name_id = ' name="'. $unique_name .'[]" id="'. $unique_name .'[]"';
						}
					}
					$output .= '<select' . $multiple . $name_id . $style_width . ' data-placeholder="'.$title.'">';
					if (isset($attr['source']) ) {
						$source = array();
						if (is_string($attr['source'])) {
							$cat = $attr['source'];
							if ('category_' == substr($cat, 0, 9)) {
								$cat_source_attr = isset($attr['source_args']) ? $attr['source_args'] : null;
								$source = get_taxonomy_array(substr($cat, 9), $cat_source_attr);
							} else {
								switch ($cat) {
									case 'price_categories':
										$source = get_price_categories();
									break;
									case 'team_categories':
										$source = get_taxonomy_array('cws-team-dept');
									break;
									case 'portfolio_categories':
										$source = get_taxonomy_array('cws-portfolio-type');
									break;
									case 'categories':
										$source = get_taxonomy_array('category');
									break;
									case 'sidebars':
										$source = get_sidebars_array();
									break;
									default:
										// by default we assume it's just a function we should call
										require_once(TEMPLATEPATH . '/framework/rc/inc/fields/select/fa-icons.php');
										$so = call_user_func_array($cat, array());
										$source = array_combine($so, $so);
								}
							}
						}
						else {
							$source =  $attr['source'];
						}
						$output .= '<option value=""></option>';
						foreach($source as $k=>$v) {
							$selected = '';
							if (is_array($current_value)) {
								$selected = in_array($k, $current_value) ? ' selected="selected"' : '';
							}
							else {
								$selected = ($k == $current_value ? ' selected="selected"' : '' );
							}
							$output .= '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
						}
					}
					$output .= '</select>';
				break;

				case 'range':
					$output .= '<input type="range"' . $name_id;
					$output .= ' value="' . $current_value . '" min="' . ( $attr["min"] ? $attr["min"] : "0" ) . '" max="' . ( $attr["max"] ? $attr["max"] : "100" ) . '" step="' . ( $attr["step"] ? $attr["step"] : "1" ) . '" onchange="document.getElementById(\''.$unique_name.'-range\').value=this.value" oninput="document.getElementById(\''.$unique_name.'-range\').value=this.value"';
					$output .= $style_width . '/><input type="text" value="" id="'.$unique_name.'-range">';
				break;

				case 'color':
					$output .= '<input type="text"' . $name_id;
					$output .= ' value="' . $current_value . '" data-default-color="' . $current_value . '"';
					$output .= $style_width . '/>';
				break;

				case 'check':
					$i = 0;
					foreach($attr['source'] as $k=>$v) {
						$js_onlick = '';
						$group_prefix = '';
						if (isset($attr['toggle'])) {
							$js_onlick = ' onclick="var input;';
							foreach ($attr['toggle'] as $control_name) {
								$js_onlick .= 'input = document.getElementById(\'cws-'. $group_prefix . $prefix.'-'. $control_name . $id_postfix .'\');';
								$js_onlick .= 'if(input){input.disabled = !this.checked;}';
							}
							$js_onlick .= '"';
						} elseif ( isset($attr['hide']) ) {
							$js_onlick = gen_onclick($attr, $group_prefix . $prefix, 'toggle', $is_group);
						}
						$output .= '<input type="checkbox"' . $name_id . ' name="cws-' . $group_prefix . $prefix.'-' . $attr['id'] . '" value="' . $k . '"' . ($current_value[$i] ? ' checked' : '' ) . $js_onlick . '>' . $v . '</input>&nbsp;';
						$i++;
					}
				break;

				case 'radio':
					foreach($attr['source'] as $k=>$v) {
						$output .= '<input type="radio" name="cws-'.$prefix.'-' . $attr['id'] . '" value="' . $k . '"' . ($k==$current_value ? ' checked' : '' ) . '>' . $v . '</input>&nbsp;';
					}
				break;

				case 'text':
					$val = '';
					if (!empty($current_value)) {
						$val = ' value="' . $current_value . '"';
					}
					$output .= '<input type="text"' . $name_id . $val . $style_width . '/>';
				break;

				case 'textarea':
					$val = '';
					if (!empty($current_value)) {
						$val = $current_value;
					}
					$output .= '<textarea' . $name_id . '" rows="' . $attr['rows'] . '"' . $style_width . '>' . $val . '</textarea>';
					$value = '';
				break;

				case 'group':
					$output .= parse_options($attr['source'], $value, $prefix, $id_postfix, $attr['id'], false);
				break;

				case 'media_library':
					$output .= "<img id='img-" . $unique_name . "'" . "class='selected_media' />";
					$output .= "<a id='media-" . $unique_name . "'>" . __("Select Image", 'happykids') . "</a><a id='remov-" . $unique_name . "' style='display:none;'>" . __("Remove Image", 'happykids') . "</a>";
				break;

			}
			if ($usetd) {
				$output .= '</td>';
				$output .= '</tr>';
			}
			else {
				$output .= '</div>';
			}
		}
	return $output;
}

function gen_onclick($options, $prefix, $operation = 'toggle', $group = false) {
	$js_onlick = ' onclick="';
	if (isset($options['show'])) {
		$controls = $options['show'];
		$js_onlick .= 'jQuery(\'';
		$i = 0;
		foreach ($controls as $control_name) {
			$js_onlick .= $i ? ',' : '';
			$control_name = str_replace('[]', '\\\\[\\\\]', $control_name);
			$js_onlick .= '#cws-'. $prefix.'-'. $control_name;
			$i++;
		}
		$js_onlick .= '\').parents(\'tr\').show(500);';
	}
	if (isset($options['hide'])) {
		$controls = $options['hide'];
		$js_onlick .= 'jQuery(\'';
		$i = 0;
		foreach ($controls as $control_name) {
			$js_onlick .= $i ? ',' : '';
			$control_name = str_replace('[]', '\\\\[\\\\]', $control_name);
			$js_onlick .= '#cws-'. $prefix.'-'. $control_name;
			$i++;
		}
		$method = $operation == 'toggle' ? 'toggle' : 'hide';
		if ($group){
			$js_onlick .= '\')' . '.parents(\'.group\').' . $method . '(500);';
		}
		else{
			$js_onlick .= '\')' . '.parents(\'tr\').' . $method . '(500);';
		}
	}
	$js_onlick .= '"';
	return $js_onlick;
}

function search_id($arr, $field)
{
	$depend = null;
	foreach ($arr as $data)
	{
		if ($data['id'] == $field && isset($data['depend'])) {
			$depend = $data['depend'];
			$depend = $depend[0];
		}
		if ($depend) {
			if ($data['id'] == $depend)
				return $data;
		}
	}
}

function cws_shortcode_html_gen ($options_array, $id, $value, $id_postfix = '', $ispopup = true, $prefix = 'mb' ) {

	$output = '';

	if(@$options_array[$id]) {
		$output .= '<table class="mb-table">';
		if ($ispopup) {
			$output .= '<th colspan=2 class="shortcode-name">Shortcode: <span>' . $id . '</span></th>';
		}
		$output .= parse_options($options_array[$id]['options'], $value, $prefix, $id_postfix, '', true);

		$output .= '</table>';
	}
	return $output;
}

function get_price_categories () {
	global $wpdb;
	$get_price_categories = array();
	$cats = (array) $wpdb->get_results("SELECT t.term_id, t.name, t.slug
		FROM $wpdb->terms as t INNER JOIN
			(select tt.term_id FROM wp_term_taxonomy AS tt INNER JOIN
				(SELECT tr.term_taxonomy_id FROM $wpdb->term_relationships AS tr INNER JOIN
					(SELECT tr.object_id, tr.term_taxonomy_id FROM $wpdb->term_relationships AS tr
						WHERE tr.term_taxonomy_id =
						(SELECT tt.term_taxonomy_id FROM $wpdb->term_taxonomy AS tt WHERE tt.term_id =
							(SELECT t.term_id FROM $wpdb->terms AS t WHERE t.slug = \"post-format-table\")
						)
					)	AS temp ON tr.object_id = temp.object_id
					WHERE tr.term_taxonomy_id <> temp.term_taxonomy_id AND tr.term_taxonomy_id <> 1
					GROUP BY tr.term_taxonomy_id
				) as rels ON tt.term_taxonomy_id = rels.term_taxonomy_id
			) as cats ON t.term_id = cats.term_id");
	foreach ($cats as $k=>$v) {
		$get_price_categories[$v->slug] = $v->name;
	}
	return $get_price_categories;
}

function get_taxonomy_array($tax, $args = '') {
	if (!empty($args)) {
		$args .= '&';
	}
	$args .= 'hide_empty=0';
	$terms = get_terms($tax, $args);
	$ret = array();
	foreach ($terms as $k=>$v) {
		$ret[$v->slug] = $v->name;
	}
	return $ret;
}

function get_sidebars_array() {
	global $wp_registered_sidebars;
	$ret = array();
	foreach ( (array) $wp_registered_sidebars as $k=>$v) {
		$ret[$v['id']] = $v['name'];
	}
	return $ret;
}

/*
SELECT tr.term_taxonomy_id
FROM wp1_term_relationships AS tr
INNER JOIN (
SELECT tr.object_id, tr.term_taxonomy_id
FROM wp1_term_relationships AS tr
WHERE tr.term_taxonomy_id = (SELECT tt.term_taxonomy_id
	FROM wp1_term_taxonomy AS tt
	WHERE tt.term_id = (SELECT t.term_id
		FROM wp1_terms AS t
		WHERE t.slug = "post-format-table")
		)
	) AS temp ON tr.object_id = temp.object_id
WHERE tr.term_taxonomy_id <> temp.term_taxonomy_id AND tr.term_taxonomy_id <> 1
GROUP BY tr.term_taxonomy_id
*/