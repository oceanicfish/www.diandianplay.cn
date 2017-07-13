<?php
add_action( 'init', 'cms_counter_integrateWithVC' );
if(!function_exists('cms_counter_integrateWithVC')){
    function cms_counter_integrateWithVC(){
	    vc_map(
            array(
                "name" => __("CMS Counter", THEMENAME),
                "base" => "cms_counter",
                "class" => "vc-cms-counter",
                "category" => __("CmsSuperheroes Shortcodes", THEMENAME),
                "params" => array( 
			        array(
			            "type" => "heading",
			            "heading" => __("Counter",THEMENAME),
			            "param_name" => "heading_1",
			            "group" => __("Counters Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Title Counter",THEMENAME),
			            "param_name" => "title1",
			            "value" => "",
			            "description" => __("Title Of Item",THEMENAME),
			            "group" => __("Counters Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Description",THEMENAME),
			            "param_name" => "description_counter",
			            "value" => "",
			            "group" => __("Counters Settings", THEMENAME),
			            'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_counter--layout-1.php",
								"cms_counter--layout-2.php",
								"cms_counter--layout-3.php"
								)
			            	),
			        ),
			        array(
			            "type" => "dropdown",
			            "heading" => __("Counter Type",THEMENAME),
			            "param_name" => "type1",
			            "value" => array(
			            	"Zero",
			            	"Random"
			            	),
			            "group" => __("Counters Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Digit",THEMENAME),
			            "param_name" => "digit1",
			            "value" => "69",
			            "group" => __("Counters Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Suffix",THEMENAME),
			            "param_name" => "suffix1",
			            "value" => "",
			            "group" => __("Counters Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Extra Class",THEMENAME),
			            "param_name" => "class",
			            "value" => "",
			            "group" => __("Template", THEMENAME)
			        ),
			    	array(
						'type' => 'cms_template_img',
					    'param_name' => 'cms_template',
					    "shortcode" => "cms_counter",
					    "heading" => __("Shortcode Template",THEMENAME),
					    "admin_label" => true,
					    "group" => __("Template", THEMENAME),
					),
			        array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon Counter', THEMENAME ),
						'param_name' => 'icon1',
			            'value' => '',
						'settings' => array(
							'emptyIcon' => true, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'description' => __( 'Select icon from library.', THEMENAME ),
						"group" => __("Template", THEMENAME),
						"dependency"=> array("element"=>"cms_template", "value" => "cms_counter--layout-2.php")
					),
                    array(
						"type" => "dropdown",
						"heading" => __("Title Size",THEMENAME),
						"param_name" => "cms_title_size",
						"value" => array(
								"H2" => "h2",
								"H3" => "h3",
								"H4" => "h4",
								"H5" => "h5",
								"H6" => "h6"
						),
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_counter--layout-1.php",
								"cms_counter--layout-2.php",
								"cms_counter--layout-3.php"
								)
			            	),
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Counter Text Box Color",THEMENAME),
						"param_name" => "cms_counter_text_color",
						"value" => "",
						"group" => __("Template", THEMENAME)
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Counter Boder Color",THEMENAME),
						"param_name" => "cms_counter_border_color",
						"value" => "",
						"group" => __("Template", THEMENAME)
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Counter Background Color",THEMENAME),
						"param_name" => "cms_counter_bg_color",
						"value" => "",
						"group" => __("Template", THEMENAME)
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Counter Title Color",THEMENAME),
						"param_name" => "cms_counter_title_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_counter--layout-1.php",
								"cms_counter--layout-2.php",
								"cms_counter--layout-3.php"
								)
			            	),
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Counter Content Color",THEMENAME),
						"param_name" => "cms_counter_content_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_counter--layout-1.php",
								"cms_counter--layout-2.php",
								"cms_counter--layout-3.php"
								)
			            	),
					),
                )
            )
        );
    }
}
