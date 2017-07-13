<?php
global $smof_data;
/** @var $this WPBakeryShortCode_VC_Row */
extract( shortcode_atts( array(
    'el_class' => '',
    'row_id' => '',
	'animation' => '',
	'full_width' => false,
	'bg_style' => '',
	'bd_p_speed' => 0.1,
	'bg_video_mp4' => '',
	'bg_video_webm' => '',
    'row_data' => '',
	'row_color' => '',
    'row_head_color' => '',
    'row_link_color' => '',
    'row_link_color_hover' => '',
    'overlay_row' => '',
    'overlay_color' => '',
    'overlay_opacity' => '0.6',
    'background_color_row' => '',
    'background_color_row_left' => '',
    'background_color_row_right' => '',
    'row_arrow' => '',
    'arrow_position' => '',
    'arrow_color' => '',
	'css' => '',
), $atts ) );
$row_style = ''; $video_style = '';
/* Row ID */
if($row_id){
    $row_id = "id=$row_id";
}
/* Row Color */
if($row_color){
    $row_style .= "color:$row_color;";
}
/* Overlay Row */
$html_overlay_row = '';
if($overlay_row == 'yes') {
    $html_overlay_row .= '<div class="cms-overlay-color" style="background-color: '.esc_attr($overlay_color).'; opacity: '.esc_attr($overlay_opacity).';"></div>';
}
$class_overlay_row = '';
if($overlay_row == 'yes') {
    $class_overlay_row .= 'row-overlay-color';
}
/* End Overlay Row */
/* Custom Background Color */
$html_custom_bg_color = '';
if($background_color_row == 'yes') {
    $html_custom_bg_color .= '<div class="cms-custom-bg-left" style="background-color: '.esc_attr($background_color_row_left).';"></div><div class="cms-custom-bg-right" style="background-color: '.esc_attr($background_color_row_right).';"></div>';
}
$class_custom_bg_color = '';
if($background_color_row == 'yes') {
    $class_custom_bg_color .= 'row-custom-bg-color';
}
/* End Custom Background Color */
/* Row Arrow */
$html_row_arrow = '';
$class_row_arrow = '';
if($row_arrow == 'yes') {
    $class_row_arrow .= 'row-arrow';
}
if(($row_arrow == 'yes') && ($arrow_position == 'top')) {
    $class_row_arrow .= ' row-arrow-top';
    $html_row_arrow .= '<span class="cms-row-arrow" style="border-top-color: '.esc_attr($arrow_color).';"></span>';
}
if(($row_arrow == 'yes') && ($arrow_position == 'bottom')) {
    $class_row_arrow .= ' row-arrow-bottom';
    $html_row_arrow .= '<span class="cms-row-arrow" style="border-bottom-color: '.esc_attr($arrow_color).';"></span>';
}
/* End Row Arrow */
/* Link Color */
$link_style = "";
$uqid = uniqid();
$class_link = ' .cshero_'.$uqid;
if($row_link_color || $row_link_color_hover || $row_head_color){
    $link_style .= '<style type="text/css" scoped>';
    if($row_head_color){
        $link_style .= esc_attr($class_link)." h1,".esc_attr($class_link)." h2,".esc_attr($class_link)." h3,".esc_attr($class_link)." h4,".esc_attr($class_link)." h5,".esc_attr($class_link)." h6 {color: ".esc_attr($row_head_color)."}";
    }
    if($row_link_color){
        $link_style .= esc_attr($class_link)." a{color: ".esc_attr($row_link_color)."}";
    }
    if($row_link_color_hover){
        $link_style .= esc_attr($class_link)." a:hover{color: ".esc_attr($row_link_color_hover)."}";
    }
    $link_style .= '</style>';
}
/* End Link Color */
/* Background effect */
$bg_effect = '';
if($bg_style == 'bg-effect-lg'){
    $bg_effect = "bg-effect-lg";
}
/* Class Animation For Row */
if ($animation) {
    wp_enqueue_script( 'waypoints');
    $animation .= '  wpb_animate_when_almost_visible wpb_'.esc_attr($animation);
}
/* Row Full Width */
$class_full_width = '';
if($full_width) {
    $class_full_width = 'cms-row-full-width';
}
/** BG Style Image */
switch ($bg_style){
    case 'img_parallax':
        if($smof_data['paralax']){
            $el_class .= " cms_parallax";
            $row_data .= ' data-speed = "'.esc_attr($bd_p_speed).'"';
            $row_style .= "background-position: 50% 0;background-attachment:fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;";
        }
        break;
    case 'img_fixed':
        $row_style .= "background-attachment:fixed;background-repeat: no-repeat;";
        break;
    case 'hvideo':
        $el_class .= "row-bg-video";
        $video_style = '<div class="cms-bg-video">'.do_shortcode('[video autoplay="on" loop="on" preload="none" height="0" width="0" mp4="'.esc_url($bg_video_mp4).'" webm="'.esc_url($bg_video_webm).'"]').'</div>';
        break;
}
$class_img_fixed = '';
if ($bg_style == 'img_fixed') {
    $class_img_fixed = 'background-image-fixed';
}
$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row cshero_'. $uqid. ' ' .esc_attr($class_full_width). ' ' .esc_attr($bg_effect). ' ' .esc_attr($class_img_fixed). ' ' .esc_attr($class_row_arrow). ' ' .esc_attr($class_custom_bg_color). ' ' .esc_attr($class_overlay_row). ' ' . ( $this->settings( 'base' ) === 'cms_row_inner' ? 'cms_inner ' : '' ) . get_row_css_class() .esc_attr($animation) . esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$style = ' style ="'.$row_style.'"';  //$this->buildStyle();
?>
<div <?php echo esc_attr( $row_id ); ?> class="<?php echo esc_attr( $css_class ); ?>"<?php echo ''.$row_data; ?><?php echo ''.$style; ?>>
    <?php echo ''.$link_style; ?>
    <?php echo ''.$video_style; ?>
    <?php echo ''.$html_overlay_row; ?>
    <?php echo ''.$html_custom_bg_color; ?>
    <?php echo ''.$html_row_arrow; ?>
    <?php if(!$full_width): ?><div class="container"><div class="row"><?php endif ; ?>
    <?php if($full_width): ?><div class="no-container"><div class="row"><?php endif ; ?>
    <?php echo wpb_js_remove_wpautop( $content ); ?>
    <?php if(!$full_width): ?></div></div><?php endif ; ?>
    <?php if($full_width): ?></div></div><?php endif ; ?>
</div>
