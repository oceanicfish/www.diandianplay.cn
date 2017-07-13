<?php
global $cms_base;
/* get local fonts. */
$local_fonts = is_admin() ? $cms_base->getListLocalFontsName() : array() ;

/**
 * Header Options
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Header', THEMENAME),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => __('Layouts', THEMENAME),
            'subtitle' => __('select a layout for header', THEMENAME),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/header/h-default.png'
            )
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'header_height',
            'type' => 'text',
            'title' => 'Header Height',
            'default' => '186px'
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        ),
        array(
            'subtitle' => __('enable sticky mode for menu.', THEMENAME),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => __('Sticky Header', THEMENAME),
            'default' => false,
        ),
         array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'menu_sticky_height',
            'type' => 'text',
            'title' => 'Sticky Header Height',
            'default' => '80px',
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Tablets.', THEMENAME),
            'id' => 'menu_sticky_tablets',
            'type' => 'switch',
            'title' => __('Sticky Tablets', THEMENAME),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Mobile.', THEMENAME),
            'id' => 'menu_sticky_mobile',
            'type' => 'switch',
            'title' => __('Sticky Mobile', THEMENAME),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/* Header Top */

$this->sections[] = array(
    'title' => __('Header Top', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable header top.', THEMENAME),
            'id' => 'enable_header_top',
            'type' => 'switch',
            'title' => __('Enable Header Top', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_top_margin',
            'type' => 'text',
            'title' => 'Header Top Margin',
            'default' => '',
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_top_padding',
            'type' => 'text',
            'title' => 'Header Top Padding',
            'default' => '',
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        )
    )
);

/* Logo */
$this->sections[] = array(
    'title' => __('Logo', THEMENAME),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => __('Select Logo', THEMENAME),
            'subtitle' => __('Select an image file for your logo.', THEMENAME),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            )
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'main_logo_height',
            'type' => 'text',
            'title' => 'Logo Height',
            'default' => '129px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'sticky_logo_height',
            'type' => 'text',
            'title' => 'Sticky Logo Height',
            'default' => '60px'
        )
    )
);

/* Menu */
$this->sections[] = array(
    'title' => __('Menu', THEMENAME),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Menu position.',
            'id' => 'menu_position',
            'options' => array(
                1 => 'Menu Left',
                2 => 'Menu Right',
            ),
            'type' => 'select',
            'title' => 'Menu Position',
            'default' => '2'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'menu_padding_first_level',
            'type' => 'text',
            'title' => 'Menu Padding - First Level',
            'default' => '0 15px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'menu_margin_first_level',
            'type' => 'text',
            'title' => 'Menu Margin - First Level',
            'default' => '0'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'menu_fontsize_first_level',
            'type' => 'text',
            'title' => 'Menu Font Size - First Level',
            'default' => '22px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'menu_fontsize_sub_level',
            'type' => 'text',
            'title' => 'Menu Font Size - Sub Level',
            'default' => '18px'
        ),
        array(
            'subtitle' => __('enable sub menu border bottom.', THEMENAME),
            'id' => 'menu_border_color_bottom',
            'type' => 'switch',
            'title' => __('Border Bottom Menu Item Sub Level', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => __('Enable mega menu.', THEMENAME),
            'id' => 'menu_mega',
            'type' => 'switch',
            'title' => __('Mega Menu', THEMENAME),
            'default' => true,
        ),
        array(
            'subtitle' => __('Enable menu first level uppercase.', THEMENAME),
            'id' => 'menu_first_level_uppercase',
            'type' => 'switch',
            'title' => __('Menu First Level Uppercase', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'menu_icon_font_size',
            'type' => 'text',
            'title' => 'Menu Icon Font Size',
            'default' => '34px'
        )
    )
);

/* Stick Menu */
$this->sections[] = array(
    'title' => __('Stick Menu', THEMENAME),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'stick_menu_fontsize_first_level',
            'type' => 'text',
            'title' => 'Stick Menu Font Size - First Level',
            'default' => '18px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'sticky_menu_fontsize_sub_level',
            'type' => 'text',
            'title' => 'Sticky Menu Font Size - Sub Level',
            'default' => '16px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'sticky_menu_icon_font_size',
            'type' => 'text',
            'title' => 'Sticky Menu Icon Font Size',
            'default' => '24px'
        ),
    )
);

/**
 * Page Title
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Page Title & BC', THEMENAME),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id' => 'page_title_layout',
            'title' => __('Layouts', THEMENAME),
            'subtitle' => __('select a layout for page title', THEMENAME),
            'default' => '5',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
                '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
                '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
                '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
                '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
            )
        ),
        array(
            'id'       => 'page_title_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'page title background with image, color, etc.', THEMENAME ),
            'output'   => array('.page-title'),
            'default'   => array(
                'background-color'=>'#6e4692',
                'background-image'=> get_template_directory_uri().'/assets/images/bg-vector-lg.png',
                'background-repeat'=>'no-repeat',
                'background-size'=>'cover',
                'background-attachment'=>'',
                'background-position'=>'center center'
            )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'page_title_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '0 0 70px'
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'page_title_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => '50px 0'
        )
    )
);
/* Page Title */
$this->sections[] = array(
    'icon' => 'el-icon-podcast',
    'title' => __('Page Title', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => __('Typography', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', THEMENAME),
            'default' => array(
                'color' => '#fff',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Dosis',
                'google' => true,
                'font-size' => '42px',
                'line-height' => '42px',
                'text-align' => 'center'
            )
        ),
    )
);
/* Breadcrumb */
$this->sections[] = array(
    'icon' => 'el-icon-random',
    'title' => __('Breadcrumb', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('The text before the breadcrumb home.', THEMENAME),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => __('Breadcrumb Home Prefix', THEMENAME),
            'default' => 'Home'
        ),
        array(
            'id' => 'breacrumb_typography',
            'type' => 'typography',
            'title' => __('Typography', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #breadcrumb-text','.page-title #breadcrumb-text ul li a'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', THEMENAME),
            'default' => array(
                'color' => '',
            )
        ),
    )
);

/**
 * Body
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Body', THEMENAME),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'subtitle' => __('Set layout boxed default(Wide).', THEMENAME),
            'id' => 'body_layout',
            'type' => 'switch',
            'title' => __('Boxed Layout', THEMENAME),
            'default' => false,
        ),
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'body background with image, color, etc.', THEMENAME ),
            'output'   => array('body'),
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'body_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'body_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);

/**
 * Content
 * 
 * Archive, Pages, Single, 404, Search, Category, Tags .... 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Content', THEMENAME),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'container_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Container background with image, color, etc.', THEMENAME ),
            'output'   => array('#main'),
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'container_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '0 0 80px'
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'container_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);

/**
 * Page Loadding
 * 
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Page Loadding', THEMENAME),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable page loadding.', THEMENAME),
            'id' => 'enable_page_loadding',
            'type' => 'switch',
            'title' => __('Enable Page Loadding', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => 'Select Style Page Loadding.',
            'id' => 'page_loadding_style',
            'type' => 'select',
            'options' => array(
                '1' => 'Style 1',
                '2' => 'Style 2'
            ),
            'title' => 'Page Loadding Style',
            'default' => 'style-1',
            'required' => array( 0 => 'enable_page_loadding', 1 => '=', 2 => 1 )
        )     
    )
);

/**
 * Footer
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Footer', THEMENAME),
    'icon' => 'el-icon-credit-card',
);

/* Footer top */
$this->sections[] = array(
    'title' => __('Footer Top', THEMENAME),
    'icon' => 'el-icon-fork',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer top.', THEMENAME),
            'id' => 'enable_footer_top',
            'type' => 'switch',
            'title' => __('Enable Footer Top', THEMENAME),
            'default' => true,
        ),
        array(
            'id'       => 'footer_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'footer background with image, color, etc.', THEMENAME ),
            'output'   => array('footer #cshero-footer-top'),
            'default'   => array(
                'background-color'=>'#6e4692',
                'background-image'=> get_template_directory_uri().'/assets/images/bg-vector-lg.png',
                'background-repeat'=>'repeat',
                'background-size'=>'contain',
                'background-attachment'=>'',
                'background-position'=>'center center'
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '',
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => '65px 0',
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        )
    )
);

/* footer botton */
$this->sections[] = array(
    'title' => __('Footer Botton', THEMENAME),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer bottom.', THEMENAME),
            'id' => 'enable_footer_bottom',
            'type' => 'switch',
            'title' => __('Enable Footer Botton', THEMENAME),
            'default' => false,
        ),
        array(
            'id'       => 'footer_botton_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'background with image, color, etc.', THEMENAME ),
            'output'   => array('footer #cshero-footer-bottom'),
            'default'   => array(),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_botton_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '',
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_botton_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => '',
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable button back to top.', THEMENAME),
            'id' => 'footer_botton_back_to_top',
            'type' => 'switch',
            'title' => __('Back To Top', THEMENAME),
            'default' => true,
        )
    )
);

/**
 * Button Option
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Button', THEMENAME),
    'icon' => 'el el-bold',
    'fields' => array(
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'button_font_size',
            'type' => 'text',
            'title' => 'Button Font Size',
            'default' => '18px'
        ),
        array(
            'subtitle' => __('Enable button uppercase.', THEMENAME),
            'id' => 'button_text_uppercase',
            'type' => 'switch',
            'title' => __('Button Text Uppercase', THEMENAME),
            'default' => false,
        )
    )
);

/* Button Default */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Default', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_default_padding_top',
            'type' => 'text',
            'title' => __('Button Default - Padding Top', THEMENAME),
            'default' => '16px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_default_padding_right',
            'type' => 'text',
            'title' => __('Button Default - Padding Right', THEMENAME),
            'default' => '50px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_default_padding_bottom',
            'type' => 'text',
            'title' => __('Button Default - Padding Bottom', THEMENAME),
            'default' => '16px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_default_padding_left',
            'type' => 'text',
            'title' => __('Button Default - Padding Left', THEMENAME),
            'default' => '50px'
        ),
        array(
            'subtitle' => __('in pixels: Ex 1px 1px 1px 1px.', THEMENAME),
            'id' => 'btn_default_border_width',
            'type' => 'text',
            'title' => __('Button Default - Border Width', THEMENAME),
            'default' => '2px'
        ),
        array(
            'subtitle' => __('in pixels: Ex 5px.', THEMENAME),
            'id' => 'btn_default_border_radius',
            'type' => 'text',
            'title' => __('Button Default - Border Radius', THEMENAME),
            'default' => '3px'
        )
    )
);

/* Button Primary */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Primary', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_primary_padding_top',
            'type' => 'text',
            'title' => __('Button Primary - Padding Top', THEMENAME),
            'default' => '16px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_primary_padding_right',
            'type' => 'text',
            'title' => __('Button Primary - Padding Right', THEMENAME),
            'default' => '50px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_primary_padding_bottom',
            'type' => 'text',
            'title' => __('Button Primary - Padding Bottom', THEMENAME),
            'default' => '16px'
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'btn_primary_padding_left',
            'type' => 'text',
            'title' => __('Button Primary - Padding Left', THEMENAME),
            'default' => '50px'
        ),
        array(
            'subtitle' => __('in pixels: Ex 1px 1px 1px 1px.', THEMENAME),
            'id' => 'btn_primary_border_width',
            'type' => 'text',
            'title' => __('Button Primary - Border Width', THEMENAME),
            'default' => '2px'
        ),
        array(
            'subtitle' => __('in pixels: Ex 5px.', THEMENAME),
            'id' => 'btn_primary_border_radius',
            'type' => 'text',
            'title' => __('Button Primary - Border Radius', THEMENAME),
            'default' => '5px'
        )
    )
);
/**
 * Styling
 * 
 * css color.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Styling', THEMENAME),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => __('set color main color.', THEMENAME),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => __('Primary Color', THEMENAME),
            'default' => '#6e4692'
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => __('Secondary Color', THEMENAME),
            'default' => '#ffdd00'
        ),
        array(
            'id' => 'kindergarten_color',
            'type' => 'color',
            'title' => __('Kindergarten Color', THEMENAME),
            'default' => '#5fcde3'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', THEMENAME),
            'id' => 'link_color',
            'type' => 'color',
            'title' => __('Link Color', THEMENAME),
            'output'  => array('a'),
            'default' => '#6f4792'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', THEMENAME),
            'id' => 'link_color_hover',
            'type' => 'color',
            'title' => __('Link Color Hover', THEMENAME),
            'output'  => array('a:hover'),
            'default' => '#9c9c9c'
        )
    )
);

/** Header Top Color **/
$this->sections[] = array(
    'title' => __('Header Top Color', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set background color header top.', THEMENAME),
            'id' => 'bg_header_top_color',
            'type' => 'color',
            'title' => __('Background Color', THEMENAME),
            'default' => ''
        ),
        array(
            'subtitle' => __('Set color header top.', THEMENAME),
            'id' => 'header_top_color',
            'type' => 'color',
            'title' => __('Font Color', THEMENAME),
            'default' => ''
        )
    )
);

/** Header Main Color **/
$this->sections[] = array(
    'title' => __('Header Main Color', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for header background color.', THEMENAME),
            'id' => 'bg_header',
            'type' => 'color_rgba',
            'title' => __('Header Background Color', THEMENAME),
            'default' => array('color'=>'#fff','alpha'=>'0.8', 'rgba'=>'rgba(255,255,255,0.8)')
        )
    )
);

/** Sticky Header Color **/
$this->sections[] = array(
    'title' => __('Sticky Header', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for sticky header.', THEMENAME),
            'id' => 'bg_sticky_header',
            'type' => 'color_rgba',
            'title' => __('Sticky Background Color', THEMENAME),
            'default' => array('color'=>'#fff','alpha'=>'0.8', 'rgba'=>'rgba(255,255,255,0.8)'),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/** Menu Color **/

$this->sections[] = array(
    'title' => __('Menu Color', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the text color of first level menu items.', THEMENAME),
            'id' => 'menu_color_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color - First Level', THEMENAME),
            'default' => '#575656'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', THEMENAME),
            'id' => 'menu_color_hover_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - First Level', THEMENAME),
            'default' => '#6e4692'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', THEMENAME),
            'id' => 'menu_color_active_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Active - First Level', THEMENAME),
            'default' => '#6e4692'
        ),
        array(
            'subtitle' => __('Controls the text color of sub level menu items.', THEMENAME),
            'id' => 'menu_color_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color - Sub Level', THEMENAME),
            'default' => '#575656'
        ),
        array(
            'subtitle' => __('Controls the text hover color of sub level menu items.', THEMENAME),
            'id' => 'menu_color_hover_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - Sub Level', THEMENAME),
            'default' => '#6e4692'
        ),
        array(
            'subtitle' => __('Controls the text background color of sub level menu items.', THEMENAME),
            'id' => 'menu_bg_color_sub_level',
            'type' => 'color',
            'title' => __('Menu Background Color - Sub Level', THEMENAME),
            'default' => '#f5f5f5'
        ),
        array(
            'subtitle' => __('Controls the text background color hover of sub level menu items.', THEMENAME),
            'id' => 'menu_bg_color_hover_sub_level',
            'type' => 'color',
            'title' => __('Menu Background Color Hover - Sub Level', THEMENAME),
            'default' => '#e9e9e9'
        ),
        array(
            'subtitle' => __('Controls the border color of sub level menu items.', THEMENAME),
            'id' => 'menu_item_border_color',
            'type' => 'color',
            'title' => __('Border Color - Sub Level', THEMENAME),
            'default' => '',
            'required' => array( 0 => 'menu_border_color_bottom', 1 => '=', 2 => 1 )
        )
    )
);

/** Button Color **/

$this->sections[] = array(
    'title' => __('Button Color', THEMENAME),
    'icon' => 'el el-bold',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the button text color.', THEMENAME),
            'id' => 'btn_default_color',
            'type' => 'color',
            'title' => __('Button Default - Font Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', THEMENAME),
            'id' => 'btn_default_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Font Color Hover', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_default_bg_color',
            'type' => 'color',
            'title' => __('Button Default - Background Color', THEMENAME),
            'default' => '#3bbcd6'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_default_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Background Color Hover', THEMENAME),
            'default' => '#ffde0a'
        ),
        array(
            'subtitle' => __('Controls the button border color.', THEMENAME),
            'id' => 'btn_default_border_color',
            'type' => 'color',
            'title' => __('Button Default - Border Color', THEMENAME),
            'default' => '#1a9eb9'
        ),
        array(
            'subtitle' => __('Controls the button border hover color.', THEMENAME),
            'id' => 'btn_default_border_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Border Color Hover', THEMENAME),
            'default' => '#f0ba00'
        ),
        array(
            'subtitle' => __('Controls the button text color.', THEMENAME),
            'id' => 'btn_primary_color',
            'type' => 'color',
            'title' => __('Button Primary - Font Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', THEMENAME),
            'id' => 'btn_primary_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Font Color Hover', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_primary_bg_color',
            'type' => 'color',
            'title' => __('Button Primary - Background Color', THEMENAME),
            'default' => '#765197'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_primary_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Background Color Hover', THEMENAME),
            'default' => '#765197'
        ),
        array(
            'subtitle' => __('Controls the button border color.', THEMENAME),
            'id' => 'btn_primary_border_color',
            'type' => 'color',
            'title' => __('Button Primary - Border Color', THEMENAME),
            'default' => '#5c367c'
        ),
        array(
            'subtitle' => __('Controls the button border hover color.', THEMENAME),
            'id' => 'btn_primary_border_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Border Color Hover', THEMENAME),
            'default' => '#5c367c'
        )
    )
);

/** Footer Top Color **/
$this->sections[] = array(
    'title' => __('Footer Top Color', THEMENAME),
    'icon' => 'el-icon-chevron-up',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', THEMENAME),
            'id' => 'footer_top_color',
            'type' => 'color',
            'title' => __('Footer Top Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title color footer top.', THEMENAME),
            'id' => 'footer_headding_color',
            'type' => 'color',
            'title' => __('Footer Headding Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title link color footer top.', THEMENAME),
            'id' => 'footer_top_link_color',
            'type' => 'color',
            'title' => __('Footer Link Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title link color footer top.', THEMENAME),
            'id' => 'footer_top_link_color_hover',
            'type' => 'color',
            'title' => __('Footer Link Color Hover', THEMENAME),
            'default' => '#ffffff'
        )
    )
);

/** Footer Bottom Color **/
$this->sections[] = array(
    'title' => __('Footer Bottom Color', THEMENAME),
    'icon' => 'el-icon-chevron-down',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', THEMENAME),
            'id' => 'footer_bottom_color',
            'type' => 'color',
            'title' => __('Footer Bottom Color', THEMENAME),
            'default' => ''
        )
    )
);

/**
 * Typography
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Typography', THEMENAME),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => __('Body Font', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'default' => array(
                'color' => '#9c9c9c',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Dosis',
                'google' => true,
                'font-size' => '18px',
                'line-height' => '26px',
                'text-align' => ''
            ),
            'subtitle' => __('Typography option with each property can be called individually.', THEMENAME),
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => __('H1', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h1'),
            'units' => 'px',
            'default' => array(
                'color' => '#6f4792',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Amatic SC',
                'google' => true,
                'font-size' => '62px',
                'line-height' => '72px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => __('H2', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h2'),
            'units' => 'px',
            'default' => array(
                'color' => '#6f4792',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Amatic SC',
                'google' => true,
                'font-size' => '53px',
                'line-height' => '58px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => __('H3', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h3'),
            'units' => 'px',
            'default' => array(
                'color' => '#6f4792',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Amatic SC',
                'google' => true,
                'font-size' => '48px',
                'line-height' => '54px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => __('H4', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h4'),
            'units' => 'px',
            'default' => array(
                'color' => '',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Dosis',
                'google' => true,
                'font-size' => '34px',
                'line-height' => '34px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => __('H5', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h5'),
            'units' => 'px',
            'default' => array(
                'color' => '',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Dosis',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '26px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => __('H6', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h6'),
            'units' => 'px',
            'default' => array(
                'color' => '',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Dosis',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '18px',
                'text-align' => ''
            )
        )
    )
);

/* Extra Font */
$this->sections[] = array(
    'title' => __('Extra Fonts', THEMENAME),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => __('Font 1', THEMENAME),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '700',
                'font-family' => 'Dosis'
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => 'body .btn, #secondary .wg-title, #comments .comments-title, #comments .comment-reply-title, .cms-recent-post-wrapper .cms-recent-details .title',
        ),
        array(
            'id' => 'google-font-2',
            'type' => 'typography',
            'title' => __('Font 2', THEMENAME),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '700',
                'font-family' => 'Amatic SC'
            )
        ),
        array(
            'id' => 'google-font-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '#cshero-footer-top .wg-title',
        ),
    )
);

/* local fonts. */
$this->sections[] = array(
    'title' => __('Local Fonts', THEMENAME),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'local-fonts-1',
            'type'     => 'select',
            'title'    => __( 'Fonts 1', THEMENAME ),
            'options'  => $local_fonts,
            'default'  => 'MyriadPro-Semibold',
        ),
        array(
            'id' => 'local-fonts-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '.cms-pricing-wrapper .cms-pricing-content ul li span',
            'required' => array(
                0 => 'local-fonts-1',
                1 => '!=',
                2 => ''
            )
        ),
        array(
            'id'       => 'local-fonts-2',
            'type'     => 'select',
            'title'    => __( 'Fonts 2', THEMENAME ),
            'options'  => $local_fonts,
            'default'  => '',
        ),
        array(
            'id' => 'local-fonts-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
            'required' => array(
                0 => 'local-fonts-2',
                1 => '!=',
                2 => ''
            )
        )
    )
);

/**
 * Custom CSS
 * 
 * extra css for customer.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Custom CSS', THEMENAME),
    'icon' => 'el-icon-bulb',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => __('CSS Code', THEMENAME),
            'subtitle' => __('create your css code here.', THEMENAME),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
);
/**
 * Animations
 *
 * Animations options for theme. libs css, js.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Animations', THEMENAME),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'subtitle' => __('Enable animation mouse scroll...', THEMENAME),
            'id' => 'smoothscroll',
            'type' => 'switch',
            'title' => __('Smooth Scroll', THEMENAME),
            'default' => false
        ),
        array(
            'subtitle' => __('Enable animation parallax for images...', THEMENAME),
            'id' => 'paralax',
            'type' => 'switch',
            'title' => __('Images Paralax', THEMENAME),
            'default' => true
        ),
    )
);
/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Optimal Core', THEMENAME),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => __('no minimize , generate css over time...', THEMENAME),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => __('Dev Mode (not recommended)', THEMENAME),
            'default' => false
        )
    )
);