<?php

/**
 * Auto create .css file from Theme Options
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_StaticCss
{

    public $scss;
    
    function __construct()
    {
        global $smof_data;
        
        /* scss */
        $this->scss = new scssc();
        
        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');
             
        /* generate css over time */
        if (isset($smof_data['dev_mode']) && $smof_data['dev_mode']) {
            $this->generate_file();
        } else {
            /* save option generate css */
            add_action("redux/options/smof_data/saved", array(
                $this,
                'generate_file'
            ));
        }
    }

    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $smof_data;
        if (! empty($smof_data)) {
            
            /* write options to scss file */
            file_put_contents(get_template_directory() . '/assets/scss/options.scss', $this->css_render(), LOCK_EX); // Save it
            
            /* minimize CSS styles */
            if (!$smof_data['dev_mode']) {
                $this->scss->setFormatter('scss_formatter_compressed');
            }
            
            /* compile scss to css */
            $css = $this->scss_render();
            
            $file = "static.css";
            
            if(!empty($smof_data['presets_color']) && $smof_data['presets_color']){
                $file = "presets-".$smof_data['presets_color'].".css";
            }
            
            /* write static.css file */
            file_put_contents(get_template_directory() . '/assets/css/' . $file, $css, LOCK_EX); // Save it
        }
    }
    
    /**
     * scss compile
     * 
     * @since 1.0.0
     * @return string
     */
    public function scss_render(){
        /* compile scss to css */
        return $this->scss->compile('@import "master.scss"');
    }
    
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $cms_base;
        ob_start();
        /* custom css.  */ 
        echo esc_attr($smof_data['custom_css']);
        
        /* google fonts. */
        $cms_base->setGoogleFont($smof_data['google-font-1'], $smof_data['google-font-selector-1']);
        $cms_base->setGoogleFont($smof_data['google-font-2'], $smof_data['google-font-selector-2']);
        
        /* local fonts */
        $cms_base->setFontFace($smof_data['local-fonts-1'], $smof_data['local-fonts-selector-1']);
        $cms_base->setFontFace($smof_data['local-fonts-2'], $smof_data['local-fonts-selector-2']);
        /* forward options to scss. */
        
        echo '$primary_color:'.esc_attr($smof_data['primary_color']).';';
        /* ==========================================================================
           Start Header
        ========================================================================== */
            /* Header Top */
            if(!empty($smof_data['bg_header_top_color'])){
                echo "body #cshero-header-top {background-color:".esc_attr($smof_data['bg_header_top_color']).";}";
            }
            if(!empty($smof_data['header_top_color'])) {
                echo "body #cshero-header-top {color:".esc_attr($smof_data['header_top_color']).";}";
            }
            if(!empty($smof_data['header_top_padding'])) {
                echo "body #cshero-header-top {padding:".esc_attr($smof_data['header_top_padding']).";}";
            }
            if(!empty($smof_data['header_top_margin'])) {
                echo "body #cshero-header-top {margin:".esc_attr($smof_data['header_top_margin']).";}";
            }
            /* End Header Top */

            /* Header Main */
            if(!empty($smof_data['header_height'])) {
                echo "#cshero-header {
                    height:".esc_attr($smof_data['header_height']).";
                }";
            }
            if(!empty($smof_data['header_height'])) {
                echo "body {
                    margin-top:".esc_attr($smof_data['header_height']).";
                }";
            }
            if(!empty($smof_data['header_height'])){
                echo "#cshero-header-logo a {
                    line-height:".esc_attr($smof_data['header_height']).";
                }";
            }
            if(!empty($smof_data['main_logo_height'])) {
                echo "#cshero-header-logo a img {
                    max-height:".esc_attr($smof_data['main_logo_height']).";
                }";
            }
            if(!empty($smof_data['header_padding'])) {
                echo "body #cshero-header {padding:".esc_attr($smof_data['header_padding']).";}";
            }
            if(!empty($smof_data['header_margin'])) {
                echo "body #cshero-header {margin:".esc_attr($smof_data['header_margin']).";}";
            }
            if(!empty($smof_data['bg_header']['rgba'])) {
                echo "#cshero-header {
                    background-color:".esc_attr($smof_data['bg_header']['rgba']).";
                }";
            }
            /* End Header Main */
            
            /* Sticky Header */
            if(!empty($smof_data['menu_sticky_height'])) {
                echo "#cshero-header.header-fixed {
                    height:".esc_attr($smof_data['menu_sticky_height']).";
                }";
            }
            if(!empty($smof_data['menu_sticky_height'])) {
                echo "body.fixed-margin-top {
                    margin-top:".esc_attr($smof_data['menu_sticky_height']).";
                }";
            }
            if(!empty($smof_data['bg_sticky_header'])){
                echo "#cshero-header.cshero-main-header.header-fixed {
                    background-color:".esc_attr($smof_data['bg_sticky_header']['rgba']).";
                }";
            }
            if(!empty($smof_data['sticky_logo_height'])) {
                echo "#cshero-header.header-fixed #cshero-header-logo a img {
                    max-height:".esc_attr($smof_data['sticky_logo_height']).";
                }";
            }
            if(!empty($smof_data['menu_sticky_height'])) {
                echo "#cshero-header.header-fixed #cshero-header-logo a, 
                #cshero-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li {
                    line-height:".esc_attr($smof_data['menu_sticky_height']).";
                }";
            }
            if(!empty($smof_data['menu_icon_font_size'])){
                echo "#cshero-header.cshero-main-header .menu-main-menu > li > a i {
                    font-size:".esc_attr($smof_data['menu_icon_font_size']).";
                }";
            }
            if(!empty($smof_data['sticky_menu_icon_font_size'])){
                echo "#cshero-header.cshero-main-header.header-fixed .menu-main-menu > li > a i {
                    font-size:".esc_attr($smof_data['sticky_menu_icon_font_size'])." !important;
                }";
            }
            if(!empty($smof_data['stick_menu_fontsize_first_level'])){
                echo "#cshero-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li > a,
                      #cshero-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > ul > li > a {
                    font-size:".esc_attr($smof_data['stick_menu_fontsize_first_level']).";
                }";
            }
            if(!empty($smof_data['sticky_menu_fontsize_sub_level'])){
                echo "#cshero-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li ul li a,
                      #cshero-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > ul > li ul li a {
                    font-size:".esc_attr($smof_data['sticky_menu_fontsize_sub_level']).";
                }";
            }
            /* End Sticky Header */

            /* Main Menu */
            echo '@media(min-width: 992px) {';
                if($smof_data['menu_position'] == '1') {
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu,
                    #cshero-header-navigation .main-navigation div.nav-menu > ul {
                        text-align: left;
                    }";
                }
                if($smof_data['menu_position'] == '2') {
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu,
                    #cshero-header-navigation .main-navigation div.nav-menu > ul {
                        text-align: right;
                    }";
                }
                if(!empty($smof_data['menu_color_first_level'])) {
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu > li > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > ul > li > a {
                        color:".esc_attr($smof_data['menu_color_first_level']).";
                        font-size:".esc_attr($smof_data['menu_fontsize_first_level']).";
                        padding:".esc_attr($smof_data['menu_padding_first_level']).";
                        margin:".esc_attr($smof_data['menu_margin_first_level']).";
                        line-height:".esc_attr($smof_data['header_height']).";
                    }";
                }
                if(!empty($smof_data['menu_color_first_level'])) {
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu > li.menu-item-has-children > .cs-menu-toggle {
                        color:".esc_attr($smof_data['menu_color_first_level']).";
                    }";
                }
                if(!empty($smof_data['header_height'])){
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu > li,
                          #cshero-header-navigation .main-navigation .menu-main-menu > ul > li {
                        line-height:".esc_attr($smof_data['header_height']).";
                    }";
                }
                if(!empty($smof_data['menu_color_hover_first_level'])) {
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu > li > a:hover,
                          #cshero-header-navigation .main-navigation .menu-main-menu >ul > li > a:hover {
                        color:".esc_attr($smof_data['menu_color_hover_first_level']).";
                    }";
                }
                if(!empty($smof_data['menu_color_active_first_level'])) {
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > ul > li.current-menu-item > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > ul > li.current-menu-ancestor > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > ul > li.current_page_item > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > ul > li.current_page_ancestor > a {
                            color:".esc_attr($smof_data['menu_color_active_first_level']).";
                    }";
                }
                if(!empty($smof_data['menu_first_level_uppercase'])) {
                    echo "#cshero-header-navigation .main-navigation .menu-main-menu > li > a,
                          #cshero-header-navigation .main-navigation .menu-main-menu > ul > li > a {
                        text-transform: uppercase;
                    }";
                }
            echo '}';
            /* End Main Menu */
            
            /* Main Menu Header Fixed Only Page */
            if(!empty($smof_data['menu_color_first_level'])) {
                echo "#cshero-header.cshero-main-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li > a {
                    color:".esc_attr($smof_data['menu_color_first_level']).";
                }";
            }
            if(!empty($smof_data['menu_color_hover_first_level'])) {
                echo "#cshero-header.cshero-main-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li > a:hover {
                    color:".esc_attr($smof_data['menu_color_hover_first_level']).";
                }";
            }
            if(!empty($smof_data['menu_color_active_first_level'])) {
                echo "#cshero-header.cshero-main-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
                      #cshero-header.cshero-main-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
                      #cshero-header.cshero-main-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
                      #cshero-header.cshero-main-header.header-fixed #cshero-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a {
                        color:".esc_attr($smof_data['menu_color_active_first_level']).";
                }";
            }
            /* End  Main Menu Header Fixed Only Page */
            /* Sub Menu */
            if(!empty($smof_data['menu_color_sub_level'])){
                echo "#cshero-header-navigation .main-navigation .menu-main-menu > li ul a,
                      #cshero-header-navigation .main-navigation .menu-main-menu > ul > li ul a {
                    color:".esc_attr($smof_data['menu_color_sub_level']).";
                    font-size:".esc_attr($smof_data['menu_fontsize_sub_level']).";
                    background-color:".esc_attr($smof_data['menu_bg_color_sub_level']).";
                }";
            }
            if(!empty($smof_data['menu_color_hover_sub_level'])){
                echo "#cshero-header-navigation .main-navigation .menu-main-menu > li ul a:hover,
                      #cshero-header-navigation .main-navigation .menu-main-menu > li ul a:focus,
                      #cshero-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-item a,
                      #cshero-header-navigation .main-navigation .menu-main-menu > ul > li ul a:hover,
                      #cshero-header-navigation .main-navigation .menu-main-menu > ul > li ul a:focus,
                      #cshero-header-navigation .main-navigation .menu-main-menu > ul > li ul li.current-menu-item a {
                        color:".esc_attr($smof_data['menu_color_hover_sub_level']).";
                        background-color:".esc_attr($smof_data['menu_bg_color_hover_sub_level']).";
                }";
            }
            if(!empty($smof_data['menu_border_color_bottom'])){
                echo "#cshero-header-navigation .main-navigation li ul li a {
                    border-bottom: 1px solid ".esc_attr($smof_data['menu_item_border_color']).";
                }";
            }
            /* End Sub Menu */

            /* Page Title Margin & Padding */
            if(!empty($smof_data['page_title_padding'])){
                echo "body .page-title{padding:".esc_attr($smof_data['page_title_padding']).";}";
            }
            if(!empty($smof_data['page_title_margin'])){
                echo "body .page-title{margin:".esc_attr($smof_data['page_title_margin']).";}";
            }

        /* ==========================================================================
           End Header
        ========================================================================== */

        /* ==========================================================================
           Start Body
        ========================================================================== */
            /* All Slector - Color Primary */
            if(!empty($smof_data['primary_color'])) {
                echo ".wg-title,
                .entry-blog .entry-date,
                .cms-blog-layout1 .cms-blog-header .cms-blog-date,
                .entry-blog .entry-meta i,
                #secondary [class*='widget_'] ul li a:hover, 
                #secondary [class*='widget-'] ul li a:hover:before,
                #secondary [class*='widget_'] ul li a:hover:before, 
                #secondary [class*='widget-'] ul li a:hover:before,
                .entry-blog .entry-meta ul li.detail-author a,
                .entry-blog .entry-meta ul li a:hover {
                    color:".esc_attr($smof_data['primary_color']).";
                }";
            }
            if(!empty($smof_data['primary_color'])) {
                echo ".navigation .page-numbers:hover,
                .navigation .prev.page-numbers:hover:before,
                .navigation .next.page-numbers:hover:after,
                .navigation .page-numbers.current {
                    background:".esc_attr($smof_data['primary_color']).";
                }";
            }
            /* End All Slector - Color Primary */

            /* All Slector - Color Kndergarten */
            if(!empty($smof_data['kindergarten_color'])){
                echo ".wg-title:before {
                    background-color:".esc_attr($smof_data['kindergarten_color']).";
                }";
            }
            
            /* End All Slector - Color Kndergarten */

            /* All Slector -  Color Secondary */
            if(!empty($smof_data['secondary_color'])) {
                echo ".page-sub-title {
                    color:".esc_attr($smof_data['secondary_color']).";
                }";
            }
            /* End All Slector - Color Secondary */

            /* All Slector - Background Color Secondary */
            if(!empty($smof_data['secondary_color'])) {
                echo ".entry-blog .entry-date, .cms-blog-layout1 .cms-blog-header .cms-blog-date,
                body .mejs-controls .mejs-time-rail .mejs-time-current, 
                body .mejs-controls .mejs-time-rail .mejs-time-loaded, 
                body .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
                    background-color:".esc_attr($smof_data['secondary_color']).";
                }";
            }
            /* End All Slector - Background Color Secondary */

            /* Body Margin + Padding */
            if(!empty($smof_data['body_padding'])){
                echo "body #page{padding:".esc_attr($smof_data['body_padding']).";}";
            }
            if(!empty($smof_data['body_margin'])){
                echo "body #page{margin:".esc_attr($smof_data['body_margin']).";}";
            }
            if(!empty($smof_data['container_padding'])){
                echo "body #page #main {padding:".esc_attr($smof_data['container_padding']).";}";
            }
            if(!empty($smof_data['container_margin'])){
                echo "body #page #main {margin:".esc_attr($smof_data['container_margin']).";}";
            }
            /* Title Style Color */
            if(!empty($smof_data['column_style']) && $smof_data['column_style'] == 'title-primary-color'){
                echo ".title-primary-color .wpb_text_column > wpb_wrapper h3 {
                    border-bottom: 1px solid ".esc_attr($smof_data['title-primary-color']).";
                }";
            }
            if(!empty($smof_data['column_style']) && $smof_data['column_style'] == 'title-secondary-color'){
                echo ".title-secondary-color .wpb_text_column > wpb_wrapper h3 {
                    border-bottom: 1px solid ".esc_attr($smof_data['title-secondary-color']).";
                }";
            }
        /* ==========================================================================
           End Body
        ========================================================================== */
        
        /* ==========================================================================
           Start Footer
        ========================================================================== */
            /* Footer Top */
            if(!empty($smof_data['footer_margin'])) {
                echo "footer #cshero-footer-top{margin:".esc_attr($smof_data['footer_margin']).";}";
            }
            if(!empty($smof_data['footer_padding'])) {
                echo "footer #cshero-footer-top{padding:".esc_attr($smof_data['footer_padding']).";}";
            }
            if(!empty($smof_data['footer_top_color'])) {
                echo "#cshero-footer-top {
                    color:".esc_attr($smof_data['footer_top_color']).";
                }";
            }
            if(!empty($smof_data['footer_headding_color'])) {
                echo "#cshero-footer-top .wg-title {
                    color:".esc_attr($smof_data['footer_headding_color']).";
                }";
            }
            if(!empty($smof_data['footer_headding_color'])) {
                echo "#cshero-footer-top .wg-title:before {
                    background-color:".esc_attr($smof_data['footer_headding_color']).";
                }";
            }
            if(!empty($smof_data['footer_top_link_color'])) {
                echo "#cshero-footer-top a {
                    color:".esc_attr($smof_data['footer_top_link_color']).";
                }";
            }
            if(!empty($smof_data['footer_top_link_color_hover'])){
                echo "#cshero-footer-top a:hover {
                    color:".esc_attr($smof_data['footer_top_link_color_hover']).";
                }";
            }
            /* End Footer Top */

            /* Footer Bottom */
            if(!empty($smof_data['footer_botton_margin'])){
                echo "footer #cshero-footer-bottom{margin:".esc_attr($smof_data['footer_botton_margin']).";}";
            }
            if(!empty($smof_data['footer_botton_padding'])){
                echo "footer #cshero-footer-bottom{padding:".esc_attr($smof_data['footer_botton_padding']).";}";
            }
            if(!empty($smof_data['footer_bottom_color'])){
                echo "#cshero-footer-bottom {
                    color:".esc_attr($smof_data['footer_bottom_color']).";
                }";
            }
            /* End Footer Bottom */
        /* ==========================================================================
           End Footer
        ========================================================================== */
        
        /* ==========================================================================
           Start Button
        ========================================================================== */
            /** Button Default **/
            if(!empty($smof_data['btn_default_color'])){
                echo ".btn , button, .button, input[type='submit'] {
                    font-size:".esc_attr($smof_data['button_font_size']).";
                    color:".esc_attr($smof_data['btn_default_color'])." !important;
                    background-color:".esc_attr($smof_data['btn_default_bg_color']).";
                    border-style: solid;
                    border-width:".esc_attr($smof_data['btn_default_border_width']).";
                    border-color: ".esc_attr($smof_data['btn_default_border_color']).";
                    padding-top:".esc_attr($smof_data['btn_default_padding_top']).";
                    padding-right:".esc_attr($smof_data['btn_default_padding_right']).";
                    padding-bottom:".esc_attr($smof_data['btn_default_padding_bottom']).";
                    padding-left:".esc_attr($smof_data['btn_default_padding_left']).";
                    -webkit-border-radius:".esc_attr($smof_data['btn_default_border_radius']).";
                       -moz-border-radius:".esc_attr($smof_data['btn_default_border_radius']).";
                        -ms-border-radius:".esc_attr($smof_data['btn_default_border_radius']).";
                         -o-border-radius:".esc_attr($smof_data['btn_default_border_radius']).";
                            border-radius:".esc_attr($smof_data['btn_default_border_radius']).";
                }";
            }
            if(!empty($smof_data['btn_default_color_hover'])) {
                echo ".btn:hover, button:hover, .button:hover, input[type='submit']:hover,.btn:focus, button:focus, .button:focus, input[type='submit']:focus {
                    color:".esc_attr($smof_data['btn_default_color_hover'])." !important;
                    background-color:".esc_attr($smof_data['btn_default_bg_color_hover']).";
                    border-color:".esc_attr($smof_data['btn_default_border_color_hover']).";
                }";
            }
            /** Button Primary **/
            if(!empty($smof_data['btn_primary_color'])){
                echo ".btn.btn-primary {
                    color:".esc_attr($smof_data['btn_primary_color'])." !important;
                    background-color:".esc_attr($smof_data['btn_primary_bg_color']).";
                    border-style: solid;
                    border-width:".esc_attr($smof_data['btn_primary_border_width']).";
                    border-color:".esc_attr($smof_data['btn_primary_border_color']).";
                    padding-top:".esc_attr($smof_data['btn_primary_padding_top']).";
                    padding-right:".esc_attr($smof_data['btn_primary_padding_right']).";
                    padding-bottom:".esc_attr($smof_data['btn_primary_padding_bottom']).";
                    padding-left:".esc_attr($smof_data['btn_primary_padding_left']).";
                    -webkit-border-radius:".esc_attr($smof_data['btn_primary_border_radius']).";
                       -moz-border-radius:".esc_attr($smof_data['btn_primary_border_radius']).";
                        -ms-border-radius:".esc_attr($smof_data['btn_primary_border_radius']).";
                         -o-border-radius:".esc_attr($smof_data['btn_primary_border_radius']).";
                            border-radius:".esc_attr($smof_data['btn_primary_border_radius']).";
                }";
            }
            if(!empty($smof_data['btn_primary_color_hover'])) {
                echo ".btn.btn-primary:hover, .btn.btn-primary:focus {
                    color:".esc_attr($smof_data['btn_primary_color_hover'])." !important;
                    background-color:".esc_attr($smof_data['btn_primary_bg_color_hover']).";
                    border-color:".esc_attr($smof_data['btn_primary_border_color_hover']).";
                }";
            }
            if($smof_data['button_text_uppercase'] == '1') {
                echo ".btn , button, .button, input[type='submit'] {
                    text-transform: uppercase;
                }";
            }
        /* ==========================================================================
           End Button
        ========================================================================== */

        /* ==========================================================================
           Start Blog
        ========================================================================== */
        if(!empty($smof_data['secondary_color'])){
            echo ".entry-blog .entry-date .arow-date, .cms-blog-layout1 .cms-blog-header .cms-blog-date .arow-date {
                border-color: transparent ".esc_attr($smof_data['secondary_color'])." ".esc_attr($smof_data['secondary_color'])." transparent;
            }";
        }
        if(!empty($smof_data['kindergarten_color'])){
            echo ".entry-blog .entry-meta {
                border-bottom: 1px solid ".esc_attr($smof_data['kindergarten_color']).";
            }";
        }
        if(!empty($smof_data['kindergarten_color'])){
            echo ".entry-blog .entry-meta ul:before {
                background-color: ".esc_attr($smof_data['kindergarten_color']).";
            }";
        }
        if(!empty($smof_data['primary_color'])){
            echo ".entry-gallery .carousel-control {
                background: ".esc_attr($smof_data['primary_color']).";
            }";
        }
        if(!empty($smof_data['secondary_color'])){
            echo ".entry-blog .entry-gallery .carousel-control:hover .fa {
                color: ".esc_attr($smof_data['secondary_color']).";
            }";
        }
        /* ==========================================================================
          End Blog
        ========================================================================== */

        /* ==========================================================================
           Start sidebar
        ========================================================================== */
            /* Widget Tags */
            if(!empty($smof_data['primary_color'])){
                echo ".tagcloud a {
                    background-color:".esc_attr($smof_data['primary_color']).";
                    border: 1px solid ".esc_attr($smof_data['primary_color']).";
                }";
            }
            if(!empty($smof_data['secondary_color'])){
                echo ".tagcloud a:hover {
                    background-color:".esc_attr($smof_data['secondary_color']).";
                    color:".esc_attr($smof_data['primary_color']).";
                }";
            }
            /* End Widget Tags */
        /* ==========================================================================
           Start sidebar
        ========================================================================== */
        return ob_get_clean();
    }
}

new CMSSuperHeroes_StaticCss();