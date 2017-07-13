 <?php
/**
 * Theme Options Generator.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 1.0
 * @version     3.3.0
 */
	class optionGenerator {
		var $name;
		var $options;
		var $saved_options;
		var $generator;

		function __construct($name, $options, $defaults = null) {
			require_once (THEME_GENERATORS . '/elements_gen.php');
			$this->generator = new elementsGenerator();

			$this->name = $name;
			$this->options = $options;

			$this->save_options();
			$this->render();
		}

		function save_options() {
			$options = get_option(THEME_SLUG . '_' . $this->name);

			if (isset($_POST['save_theme_options'])) {
				foreach($this->options as $value) {
					if (isset($value['id']) && ! empty($value['id'])) {
						if (isset($_POST[$value['id']])) {
							switch($value['type']){
								case 'toggle':
									if($_POST[$value['id']] == 'true'){
										$options[$value['id']] = true;
									}else{
										$options[$value['id']] = false;
									}
									break;
								case 'font_select':
									$options[$value['id']] = $_POST[$value['id']];
									$options[$value['id'].'-subset'] = $_POST[$value['id'].'-subset'];
									$options[$value['id'].'-variant'] = $_POST[$value['id'].'-variant'];
									$options[$value['id'].'-color'] = $_POST[$value['id'].'-color'];
									$options[$value['id'].'-font_size'] = $_POST[$value['id'].'-font_size'];
									$options[$value['id'].'-line_height'] = $_POST[$value['id'].'-line_height'];
									break;
								case 'uploader':
									$options[$value['id']] = $_POST[$value['id']];
									$options[$value['id'].'-ppi'] = isset($_POST[$value['id'].'-ppi']) ? $_POST[$value['id'].'-ppi'] : false;
									break;
								case 'textarea':
									$options[$value['id']] = $_POST[$value['id']];
									break;
								default:
									$options[$value['id']] = esc_html(stripcslashes($_POST[$value['id']]));
							}
						} else {
							if ($value['type'] == 'multiselect') {
								$options[$value['id']] = array();
							} else {
								$options[$value['id']] = false;
							}
						}
					}
					if (isset($value['process']) && function_exists($value['process'])) {
						$options[$value['id']] = $value['process']($value,$options[$value['id']]);
					}
				}

				echo '
						<div id="creaws_save_confirm" class="creaws_cover_all active">
							<div class="creaws_popUp popUp_success">
								<p class="creaws_message_done">Settings were successfully saved!</p>
								<div class="creaws_ok_button_wrapper">
									<a class="creaws_ok_button okay"><i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>';

				if ($options != $this->options) {
					update_option(THEME_SLUG . '_' . $this->name, $options);
					global $theme_options;
					$theme_options[$this->name] = $options;
				}

			}

			$this->saved_options = $options;

		}

		function render() {
			echo '<div class="theme-options">';
			echo '<form method="post" action="">';

			foreach($this->options as $option) {
				$this->renderOption($option);
			}

			echo '</form>';
			echo '</div>';
		}

		function renderOption($option){

			global $post;
			if(isset($option['id'])){
				if (isset($this->saved_options[$option['id']])) {
					if( is_string($this->saved_options[$option['id']])){
						$option['value'] = stripslashes($this->saved_options[$option['id']]);
					}else{
						$option['value'] = $this->saved_options[$option['id']];
					}
				}else{
					if(isset($option['default'])){
						$option['value'] = $option['default'];
					}else{
						$option['value'] = '';
						$option['default'] = '';
					}
				}
			}
			if (isset($option['prepare']) && function_exists($option['prepare'])) {
				$option = $option['prepare']($option);
			}
			if (method_exists($this->generator, $option['type'])) {


				$separator = empty($option['name']) ? '' : 'separate';
				$column = empty($option['column']) ? '' : $option['column'].'-column';
				$class = empty($option['class']) ? '' : $option['class'];
				$align  = empty($option['align']) ? '' : 'style="text-align:'.$option['align'].';"';
				$name = isset($option['name']) ? $option['name'] : '';

				$title = empty($separator) ? '<div class="'. $class .' ' . $separator . ' '.$column.'">' : '<div class="'. $class .' ' . $separator . ' '.$column.'"><h4><label for="'.$option['id'].'">' . $name . '</label></h4>';

				echo $title;


				$this->generator->{$option['type']}($option);
				echo '</div>';
			}elseif (method_exists($this, $option['type'])) {
				$this->{$option['type']}($option);
			}
		}

		function title($item) {
			echo '<h2>' . $item['name'] . '</h2>';
			if (isset($item['desc'])) {
				echo '<p>' . $item['desc'] . '</p>';
			}
		}

		function start($item) {
			echo '<div class="cws_page">
					<div class="siteTop">
						<div id="creaws_main">';
		}

		function end($item) {
			echo '<div class="clear"></div>
					</div>
				</div>';
			echo '</div>
					<div class="creaws_cover_all">
						<div class="creaws_popUp popUp_reset">
							<p class="creaws_message_done">All settings were successfully reset. <br>Don\'t forget to save the changes.</p>
							<div class="creaws_ok_button_wrapper">
								<a class="creaws_ok_button okay resetwasok"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="creaws_popUp popUp_confirm">
							<p class="creaws_message_done">Are you sure you want to reset all settings to defaults?</p>
   							<div class="creaws_ok_button_wrapper">
								<a class="creaws_ok_button confirm">Yes</a>
								<a class="creaws_ok_button decline">No</a>
							</div>
						</div>
					</div>';
		}

		function serv_buttons(){
			echo '<div class="separate"><h4><label for="">' . __('Theme Maintenance', 'happykids'). '</label></h4>';
			echo '<div style="padding: 0 20px 0px;">';
			echo '<a href="'. admin_url() .'/import.php" style="margin-right: 6px;margin-bottom: 6px;" class="creaws_form_button">' . __('Demo Import', 'happykids') . '</a>';
			echo '<a href="#" id="cws_reset" class="creaws_form_button">' . __('Reset to defaults', 'happykids') . '</a>';
			echo "</div></div>";
		}

function button_list($item){
			echo '<div id="cws_button_list"><ul class="top_ul">';
		}
			function shortcodes_item($item){
				$id = isset($item['id']) ? $item['id'] : '';
				$name = isset($item['name']) ? $item['name'] : '';
				$opts = isset($item['options']) ? $item['options'] : '';

				$sublist = '';
				$dt_list = '';

				if ($opts && is_array($opts)){
					$sublist = '<ul class="sub_ul">';
					foreach ($opts as $arr_name => $arr_vals) {

						if ( $arr_vals && is_array($arr_vals) ){

							$dt_list = '<ul class="sub_ul_codes">';

								foreach ($arr_vals as $key => $value) {
									$dt_list .= '<li><a href="#" data-attr="'. $value .'">'. $key .'</a></li>';
								}

							$dt_list .= '</ul>';
						}elseif ( is_string($arr_vals) ) {
							$dt_list = '<a class="noarray_link" href="#" data-attr="'. $arr_vals .'"></a>';
						}

						$sublist .= '<li>'. $arr_name . $dt_list .'</li>';
					}

					$sublist .= '</ul>';
				}else{
					$sublist .= '<a class="noarray_link" href="#" data-attr="'. $opts .'"></a>';
				}

				echo '<li>'. $name . $sublist .'</li>';
			}

			function shortcodes_separator(){
				echo '<hr>';
			}

		function button_list_end(){
			echo '</ul></div>';
		}

		function cws_sidebar($item){
			$ops = isset($item['options']) ? $item['options'] : '';

			echo '<aside id="creaws_aside">
					<div id="creaws_admin_header">
						<div id="creaws_logo"><a href="http://themeforest.net/user/CreativeWS"></a></div>
					</div>

					<nav>
						<ul>';

							$i = 1;

							foreach ($ops as $ids => $texts) {
								echo '<li><a id="'. $ids .'" class="creaws_icon'. $i .'" href="#">'. $texts .'</a></li>';

								$i++;
							}

			echo		'</ul>
					</nav>
					<div class="clear"></div>
					<!-- End of Left Part of Site with List of Buttons -->
				</aside>';
		}

		function creaws_content(){
			echo '<main>
					<div class="main-content">
						<div id="creaws_section">
							<div id="creaws_content">
								<div id="creaws_form_buttons">
									<input class="creaws_form_button" type="submit" value="Save Changes" name="save_theme_options" style="width: 20%; height: 33px;">
							    </div>';

		}

		function creaws_tabs_link(){
			echo '<div class="tabs">';
		}

		function creaws_tabs_link_end(){
			echo '<div class="clear"></div></div><!-- end tabs link -->';
		}

		function creaws_tab_item(){
			echo '<div class="tabs-item">';
		}

		function creaws_tab_item_end(){
			echo '</div><!-- end tabs-item link -->';
		}

		function creaws_content_title($item){
			$tab_index = isset($item['tab_index']) ? $item['tab_index'] : '';
			$class = isset($item['class']) ? 'class="' . $item['class'] .'"' : '';



			echo '<h1 '.$class.' tabs-index="'.$tab_index.'">'. $item['name'] .'</h1>';
		}

		function creaws_content_end(){

			echo '<div class="clear"></div>
				</div>
			</div></main>';
		}

		function creaws_section($item){
			echo '<section class="common_display_none '. $item['class'] .'">';
		}

		function creaws_tab_begin($item){
			$tabs_index = isset($item['tab_index']) ?  $item['tab_index']  : '';

			echo '<div tabs-index="'.$tabs_index.'">';
		}

		function creaws_tab_end(){
			echo '</div>';
		}

		function creaws_section_end(){
			echo '</section>';
		}






		function col_cont_end(){
			echo '</div><!-- dfd -->';
		}



		function col_half(){
			echo '<div class="column-6">';
		}

		function col_half_end(){
			echo '</div>';
		}





	}

?>