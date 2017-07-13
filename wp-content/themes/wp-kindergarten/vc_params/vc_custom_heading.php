<?php
/**
 * Add custom headding params
 * 
 * @author Fox
 * @since 1.0.0
 */

vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Custom Heading Style", THEMENAME),
    "admin_label" => true,
    "param_name" => "cms_custom_headding",
    "value" => array(
        "Default" => "",
        "Style 1 - Title Line Bottom" => "cms-title-line-bottom"
    )
));
