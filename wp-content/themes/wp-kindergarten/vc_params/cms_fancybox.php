<?php
/*Fancybox*/
add_action( 'init', 'cms_fancybox_integrateWithVC' );
if(!function_exists('cms_fancybox_integrateWithVC')){
    function cms_fancybox_integrateWithVC(){
        vc_map(
            array(
                "name" => __("CMS Fancy Box", THEMENAME),
                "base" => "cms_fancybox",
                "class" => "vc-cms-fancy-boxes",
                "category" => __("CmsSuperheroes Shortcodes", THEMENAME),
                "params" => array(
                    array(
			            "type" => "textfield",
			            "heading" => __("Title",THEMENAME),
			            "param_name" => "title",
			            "value" => "",
			            "description" => __("Title Of Fancy Icon Box",THEMENAME),
			            "group" => __("General Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Description",THEMENAME),
			            "param_name" => "description",
			            "value" => "",
			            "description" => __("Description Of Fancy Icon Box",THEMENAME),
			            "group" => __("General Settings", THEMENAME)
			        ),
			        array(
			            "type" => "dropdown",
			            "heading" => __("Content Align",THEMENAME),
			            "param_name" => "content_align",
			            "value" => array(
			            	"Default" => "default",
			            	"Left" => "left",
			            	"Right" => "right",
			            	"Center" => "center"
			            	),
			            "group" => __("General Settings", THEMENAME)
			        ),
			        /* Start Items */
			        array(
			            "type" => "heading",
			            "heading" => __("Fancy Box",THEMENAME),
			            "param_name" => "heading_1",
			            "group" => __("Fancy Icon Settings", THEMENAME)
			        ),
			        array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon Item', THEMENAME ),
						'param_name' => 'icon1',
			            'value' => '',
						'settings' => array(
							'emptyIcon' => true, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'description' => __( 'Select icon from library.', THEMENAME ),
						"group" => __("Fancy Icon Settings", THEMENAME)
					),
					array(
			            "type" => "attach_image",
			            "heading" => __("Image Item",THEMENAME),
			            "param_name" => "image1",
			            "group" => __("Fancy Icon Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Title Item",THEMENAME),
			            "param_name" => "title1",
			            "value" => "",
			            "description" => __("Title Of Item",THEMENAME),
			            "group" => __("Fancy Icon Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Content Item",THEMENAME),
			            "param_name" => "description1",
			            "group" => __("Fancy Icon Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Link",THEMENAME),
			            "param_name" => "button_link1",
			            "value" => "#",
			            "description" => __("",THEMENAME),
			            "group" => __("Fancy Icon Settings", THEMENAME)
			        ),
			        /* End Items */
			        array(
			            "type" => "dropdown",
			            "heading" => __("Button Type",THEMENAME),
			            "param_name" => "button_type",
			            "value" => array(
			            	"Button" => "button",
			            	"Text" => "text"
			            	),
			            "group" => __("Buttons Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Text",THEMENAME),
			            "param_name" => "button_text",
			            "value" => "",
			            "description" => __("",THEMENAME),
			            "group" => __("Buttons Settings", THEMENAME)
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Extra Class",THEMENAME),
			            "param_name" => "class",
			            "value" => "",
			            "description" => __("",THEMENAME),
			            "group" => __("Template", THEMENAME)
			        ),
			        array(
						'type' => 'cms_template_img',
					    'param_name' => 'cms_template',
					    "shortcode" => "cms_fancybox",
					    "heading" => __("Shortcode Template",THEMENAME),
					    "admin_label" => true,
					    "group" => __("Template", THEMENAME),
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
								"cms_fancybox.php",
								"cms_fancybox--layout-1.php",
								"cms_fancybox--layout-2.php", 
								"cms_fancybox--layout-3.php"
								)
			            	),
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Icon - Color",THEMENAME),
						"param_name" => "cms_fancybox_icon_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox.php",
								"cms_fancybox--layout-2.php", 
								"cms_fancybox--layout-3.php"
								)
			            	),
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Icon - Border Color",THEMENAME),
						"param_name" => "cms_fancybox_boder_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox.php",
								"cms_fancybox--layout-2.php", 
								"cms_fancybox--layout-3.php"
								)
			            	),
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Icon - Background Color",THEMENAME),
						"param_name" => "cms_fancybox_bg_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox.php",
								"cms_fancybox--layout-2.php", 
								"cms_fancybox--layout-3.php"
								)
			            	),
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Icon - Title Color",THEMENAME),
						"param_name" => "cms_fancybox_title_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox.php",
								"cms_fancybox--layout-2.php", 
								"cms_fancybox--layout-3.php"
								)
			            	),
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Icon - Content Color",THEMENAME),
						"param_name" => "cms_fancybox_content_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox.php",
								"cms_fancybox--layout-2.php", 
								"cms_fancybox--layout-3.php"
								)
			            	),
					),
				    array(
			            "type" => "dropdown",
			            "heading" => __("Custom Color Text More Info",THEMENAME),
			            "param_name" => "text_more_info",
			            "value" => array(
			            	'No' => '',
			            	'Yes' => 'yes'
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
				    array(
			            "type" => "colorpicker",
			            "heading" => __("Color",THEMENAME),
			            "param_name" => "text_more_info_color",
			            'dependency' => array(
			            	"element"=>"text_more_info",
			            	"value"=>array(
								"yes"
								)
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
			        array(
			            "type" => "colorpicker",
			            "heading" => __("Color Hover",THEMENAME),
			            "param_name" => "text_more_info_color_hover",
			            'dependency' => array(
			            	"element"=>"text_more_info",
			            	"value"=>array(
								"yes"
								)
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
			        array(
			            "type" => "dropdown",
			            "heading" => __("Custom Color Button More Info",THEMENAME),
			            "param_name" => "button_more_info",
			            "value" => array(
			            	'No' => '',
			            	'Yes' => 'yes'
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
				    array(
			            "type" => "colorpicker",
			            "heading" => __("Border Color",THEMENAME),
			            "param_name" => "button_more_info_border_color",
			            'dependency' => array(
			            	"element"=>"button_more_info",
			            	"value"=>array(
								"yes"
								)
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
			        array(
			            "type" => "colorpicker",
			            "heading" => __("Border Color Hover",THEMENAME),
			            "param_name" => "button_more_info_border_color_hover",
			            'dependency' => array(
			            	"element"=>"button_more_info",
			            	"value"=>array(
								"yes"
								)
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
			        array(
			            "type" => "colorpicker",
			            "heading" => __("Background Color",THEMENAME),
			            "param_name" => "button_more_info_bg_color",
			            'dependency' => array(
			            	"element"=>"button_more_info",
			            	"value"=>array(
								"yes"
								)
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
			        array(
			            "type" => "colorpicker",
			            "heading" => __("Background Color Hover",THEMENAME),
			            "param_name" => "button_more_info_bg_color_hover",
			            'dependency' => array(
			            	"element"=>"button_more_info",
			            	"value"=>array(
								"yes"
								)
			            	),
			            "group" => __("Template", THEMENAME)
			        ),
					/* Option Layout 1 */
					array(
						"type" => "colorpicker",
						"heading" => __("Content - Background Color",THEMENAME),
						"param_name" => "cms_fancybox_bg_content_color",
						"value" => "",
						"group" => __("Template", THEMENAME),
						'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox--layout-1.php"
								)
			            	),
					),
					array(
				        "type" => "textfield",
				        "class" => "",
				        "heading" => __("Months Old", THEMENAME),
				        "param_name" => "months_old",
				        "value" => '',
				        "group" => __("Template", THEMENAME),
				        'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox--layout-1.php"
								)
			            	),
				    ),
				    array(
				        "type" => "textfield",
				        "class" => "",
				        "heading" => __("Class Size", THEMENAME),
				        "param_name" => "class_size",
				        "value" => '',
				        'dependency' => array(
			            	"element"=>"cms_template",
			            	"value"=>array(
								"cms_fancybox--layout-1.php"
								)
			            	),
				        "group" => __("Template", THEMENAME)
				    )
                )
            )
        );
    }
}
