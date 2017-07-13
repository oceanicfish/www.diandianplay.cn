<?php
/**
 * Add tabs params
 * 
 * @author Fox
 * @since 1.0.0
 */
vc_add_param("vc_tab", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => __("Tab Background Color", THEMENAME),
    "param_name" => "cms_tab_bg_color",
    "value" => ""
));
vc_add_param("vc_tab", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => __("Tab Border Color", THEMENAME),
    "param_name" => "cms_tab_border_color",
    "value" => ""
));
vc_add_param("vc_tab", array(
    "type" => "textfield",
    "heading" => __("Tab Icon", THEMENAME),
    "param_name" => "cms_tab_icon"
));
