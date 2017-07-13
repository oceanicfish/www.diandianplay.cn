<?php

/**
 * Auto create css from Meta Options.
 * 
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_DynamicCss
{

    function __construct()
    {
        add_action('wp_head', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {
        global $smof_data, $cms_base;
        $css = $this->css_render();
        if (! $smof_data['dev_mode']) {
            $css = $cms_base->compressCss($css);
        }
        echo '<style type="text/css" data-type="cms_shortcodes-custom-css">'.$css.'</style>';
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $cms_meta;
        ob_start();
        
        /* ==========================================================================
           Start Header
        ========================================================================== */
            /* Header Fixed Only Page */
            if (is_page() && !empty($cms_meta->_cms_header_fixed_bg_color)) {
                echo "#cshero-header.header-fixed-page {
                    background-color: ".esc_attr($cms_meta->_cms_header_fixed_bg_color).";
                }";
            }
            if (is_page() && !empty($cms_meta->_cms_header_fixed_bg_color)) {
                echo "#cshero-header.header-fixed-page {
                    background-color: ".esc_attr($cms_meta->_cms_header_fixed_bg_color).";
                }";
            }
            /* End Header Fixed Only Page */

            /* Menu Fixed Only Page */
            if (is_page() && !empty($cms_meta->_cms_header_fixed_menu_color)) {
                echo "#cshero-header.header-fixed-page #cshero-header-navigation .main-navigation #menu-main-menu > li > a {
                    color: ".esc_attr($cms_meta->_cms_header_fixed_menu_color).";
                }";
            }
            if (is_page() && !empty($cms_meta->_cms_header_fixed_menu_color_hover)) {
                echo "#cshero-header.header-fixed-page #cshero-header-navigation .main-navigation #menu-main-menu > li > a:hover {
                    color: ".esc_attr($cms_meta->_cms_header_fixed_menu_color_hover).";
                }";
            }
            if (is_page() && !empty($cms_meta->_cms_header_fixed_menu_color_active)) {
                echo "#cshero-header.header-fixed-page #cshero-header-navigation .main-navigation #menu-main-menu > li.current-menu-item > a,
                    #cshero-header.header-fixed-page #cshero-header-navigation .main-navigation #menu-main-menu > li.current-menu-ancestor > a,
                    #cshero-header.header-fixed-page #cshero-header-navigation .main-navigation #menu-main-menu > li.current_page_item > a,
                    #cshero-header.header-fixed-page #cshero-header-navigation .main-navigation #menu-main-menu > li.current_page_ancestor > a {
                    color: ".esc_attr($cms_meta->_cms_header_fixed_menu_color_active).";
                }";
            }
            /* End Menu Fixed Only Page */
            /* Start Page Title */
            if (is_page() && !empty($cms_meta->_cms_page_title_margin)) {
                echo "body #page .page-title {
                    margin: ".esc_attr($cms_meta->_cms_page_title_margin).";
                }";
            }
            /* End Page Title */
        /* ==========================================================================
           End Header
        ========================================================================== */
        return ob_get_clean();
    }
}

new CMSSuperHeroes_DynamicCss();