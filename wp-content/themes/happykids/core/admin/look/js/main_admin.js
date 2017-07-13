jQuery(document).ready(function($){

	cws_tabs_init ();
	cws_font_color_switcher ()
	jQuery(".tabs_section").cws_tabs();

	jQuery(".cws_colorpicker").wpColorPicker();

	jQuery('.font_cont .gfont_preview').css('background-color', getContrastColour(jQuery('.font_cont .cws_colorpicker').val()));


	jQuery('.cws_colorpicker').wpColorPicker({
		change: function(event, ui) {
			jQuery(this).val(ui.color.toString());
			typographySelect(jQuery(this));
		}
	});


	var windowWidht = $('body').outerWidth();
	var windowHeight = ($('#adminmenuback').outerHeight() + 28);


// Google Font Preview
	$('.gfont_select').on('input', function(){

		var font_value = $(this).val();
		var ajax_url = $(this).attr('data-gfontajax');
		var sample = $(this).parent().find('.gfont_preview');
		var subset_select = $(this).parent().find('.gfont_subset_select');
		var variant_select = $(this).parent().find('.gfont_variant_select');
		subset_select.empty();
		variant_select.empty();
		var font_type = $(this).find(':selected').attr('data-gfonttype');

		if( font_type != 'System fonts' ){
			$.post(ajax_url,{ action: 'get_font_admin_preview_ajax', font_selected : font_value }, function(fn){
				if(fn) {
					jQuery('head').append('<link rel="stylesheet" type="text/css" href="' + fn.url + '" >');
					sample.css('font-family', font_value);
					if (typeof fn.subsets !== 'undefined') {
						for (var key in fn.subsets) {
							subset_select.append(new Option(fn.subsets[key], fn.subsets[key]));
						}
					}
					if (typeof fn.variants !== 'undefined') {
						for (var key in fn.variants) {
							(fn.variants[key] == 'regular') ? variant_select.append(new Option(fn.variants[key], fn.variants[key], true, true)) : variant_select.append(new Option(fn.variants[key], fn.variants[key]));						
						}
					}
				}
			}, 'json');
		}else{
			sample.css('font-family', font_value);
		}

	});

	$('.gfont_select').change();
// Google Font Preview

// Admin page sidebar
	$('#creaws_content ._cws_controls_general').show();
	$('#creaws_aside #_cws_controls_general').parent().addClass('active');

	$('#creaws_aside a').click(function(){
		var sidebar = $(this).attr('id');

		$('#creaws_content section.common_display_none').hide();
		$('#creaws_content .'+sidebar).show();
		$('#creaws_aside a').parent().removeClass('active');
		$(this).parent().addClass('active');

	});
// Admin page sidebar END

					var pageType = $("#_pagetype_check").val();
						if (pageType == "page"){
							$("#page_general .meta_content .meta-box-item").hide();
							$("#page_general .meta_content ._page_check").show();
						}else if (pageType == "blog"){
							$("#page_general .meta_content .meta-box-item").hide();
							$("#page_general .meta_content ._blog_check").show();
						}else if (pageType == "port"){
							$("#page_general .meta_content .meta-box-item").hide();
							$("#page_general .meta_content ._port_check").show();
						}else if (pageType == "gall"){
							$("#page_general .meta_content .meta-box-item").hide();
							$("#page_general .meta_content ._gallery_check").show();
						}else if (pageType == "cform"){
							$("#page_general .meta_content .meta-box-item").hide();
							$("#page_general .meta_content ._cform_check").show();
						}

						$("#_pagetype_check").live("change" , function(){
							var pageType = $("#_pagetype_check").val();
							if (pageType == "page"){
								$("#page_general .meta_content .meta-box-item").hide();
								$("#page_general .meta_content ._page_check").show();
							}else if (pageType == "blog"){
								$("#page_general .meta_content .meta-box-item").hide();
								$("#page_general .meta_content ._blog_check").show();
							}else if (pageType == "port"){
								$("#page_general .meta_content .meta-box-item").hide();
								$("#page_general .meta_content ._port_check").show();
							}else if (pageType == "gall"){
								$("#page_general .meta_content .meta-box-item").hide();
								$("#page_general .meta_content ._gallery_check").show();
							}else if (pageType == "cform"){
								$("#page_general .meta_content .meta-box-item").hide();
								$("#page_general .meta_content ._cform_check").show();
							}
						});

	//page type `Portfolio` js
						$("#_page_port_templ").live("change" , function(){
							var port_value = $(this).val();
							if ( port_value == "1col" ){
								$(".meta_content ._sidebar_name").show();
							}else {
								$(".meta_content .sub_page_templ").hide();
							}
						});
						var port_value = $("#_page_port_templ").val();
						if ( port_value == "1col" ){
							$(".meta_content ._sidebar_name").show();
						}else {
							$(".meta_content .sub_page_templ").hide();
						}
	//page type `Portfolio` js END

	//page type `Gallery` js
						$("#_gall_templ").live("change" , function(){
							var port_value = $(this).val();
							if ( port_value == "with_sidebar" ){
								$(".meta_content ._sidebar_name").show();
							}else {
								$(".meta_content .sub_page_templ").hide();
							}
						});
						var port_value = $("#_gall_templ").val();
						if ( port_value == "with_sidebar" ){
							$(".meta_content ._sidebar_name").show();
						}else {
							$(".meta_content .sub_page_templ").hide();
						}
	//page type `Gallery` js END

// Reset
	$('#cws_reset').click(function(){
		$('.creaws_popUp').hide();
		$('.creaws_cover_all').addClass("active");
		$('.popUp_confirm').fadeIn(800);
	});

	// Dialogs

	$('.creaws_ok_button.alert').click(function(){
		$('.creaws_cover_all').removeClass("active");
	});

	$('.creaws_ok_button.decline').click(function(){
		$('.creaws_cover_all').removeClass("active");
	});


	$('.creaws_ok_button.confirm').click(function(){

		var defaults = {
			"_logo": "",
			"_logo_w": "",
			"_logo_h": "",
			"_gen_logo_align": "left",
			"_logo_il" : "",
			"_logo_ir" : "",
			"_logo_it" : "",
			"_logo_ib" : "",
			"_fav" : "",
			"_ganalytics" : "",
			"_theme_purchase_code" : "",
			"_gen_menu_align" : "right",
			"_menu_type" : "",
			"_menu_it" : "",
			"_mobile_menu" : "",
			"_widget_type" : "type-2",
			"_gen_breadcrumbs" : "show",
			"_theme_skin_color" : "#8fc0ea",
			"_theme_skin_second_color" : "#fcf5d5",
			"_theme_skin_third_color" : "#fee6b4",
			"_theme_footer_color" : "#3185cb",
			"_theme_menu_color" : "#3185cb",
			"_theme_menu_hover_color" : "#ff633c",
			"_theme_skin_pattern" : "t-pattern-1",
			"_theme_load_pattern" : "",
			"_theme_header_pattern" : "",
			"_theme_footer_image" : "",
			"_footer_padding" : "",
			"toggle-area" : "",
			"footer-area" : "",
			"footer_copyrights-area" : "",
			"_gen_template_select" : "sb_none",
			"_sidebar_main_l" : "",
			"_sidebar_main" : "",
			"_sidebar_search" : "",
			"_sidebar_404" : "",
			"_blog_template_select" : "sb_none",
			"_sidebar_main_blog_l" : "",
			"_sidebar_main_blog_r" : "",
			"_blog_author_data" : "show",
			"_gen_portf_select" : "sb_none",
			"_sidebar_portf_l" : "",
			"_sidebar_portf_r" : "",
			"_gen_port_ipp" : "10",
			"_gen_port_butt_show" : "show",
			"_gen_port_butt_txt" : "Read More",
			"_gen_woo_template_select" : "sb_none",
			"_sidebar_main_woo_l" : "",
			"_sidebar_main_woo_r" : "",
			"_gen_woo_ipp" : "9",
			"_what_slider_select" : "img_slider",
			"_slider_shortcode" : "[rev_slider homepage]",
			"_gen_slider_image" : "",
			"_gen_video_host" : "",
			"_slider_video" : "",
			"_gen_video_autoplay" : "",
			"slogan-area" : "",
			"benefits-area" : "",
			"_menu_gfont" : "Lobster Two",
			"_menu_gfont-font_size" : "19",
			"_menu_gfont-line_height" : "1.5",
			"_menu_gfont-color" : "#fff",
			"_headers_gfont" : "Lobster Two",
			"_headers_gfont-font_size" : "32",
			"_headers_gfont-line_height" : "1.25",
			"_headers_gfont-color" : "#3185cb",
			"_text_gfont" : "Lato",
			"_text_gfont-font_size" : "16",
			"_text_gfont-line_height" : "1.375",
			"_text_gfont-color" : "#a2825c",
			"cws_post_under_cat" : "",
			"_blog_tpl_archive" : "",
			"_cws_search" : "",
			"cws_post_under_tags" : "",
			"_comments_no_comments" : "",
			"_comments_one_comment" : "",
			"_comments_x_comments" : "",
			"_comments_password" : "",
			"_comments_older" : "",
			"_comments_newer" : "",
			"_comments_closed" : "",
			"_comments_reply" : "",
			"_comments_edit" : "",
			"_comments_form_name" : "",
			"_comments_form_email" : "",
			"_comments_form_web" : "",
			"_comments_submit" : "",
			"_tr_paginat_page" : "",
			"_404_not_found" : "",
			"_404_unfortunately" : "",
			"_tr_nothing_search" : "",
			"_tr_all" : "",
			"_tr_moar" : "",
			"_port_admin_item" : "",
			"_show_search_panel" : "",
			"_show_social_footer" : "",
			"_pretty_social" : "",
			"twt_name" : "",
			"twt_ck" : "",
			"twt_cs" : "",
			"twt_ut" : "",
			"twt_us" : "",
			"_soc_net_1_net_title" : "",
			"_soc_net_1" : "",
			"_soc_net_1_fa_icon" : "",
			"_soc_net_1_hover_color" : "",

			"_soc_net_2_net_title" : "",
			"_soc_net_2" : "",
			"_soc_net_2_fa_icon" : "",
			"_soc_net_2_hover_color" : "",

			"_soc_net_3_net_title" : "",
			"_soc_net_3" : "",
			"_soc_net_3_fa_icon" : "",
			"_soc_net_3_hover_color" : "",

			"_soc_net_4_net_title" : "",
			"_soc_net_4" : "",
			"_soc_net_4_fa_icon" : "",
			"_soc_net_4_hover_color" : "",

			"_soc_net_5_net_title" : "",
			"_soc_net_5" : "",
			"_soc_net_5_fa_icon" : "",
			"_soc_net_5_hover_color" : "",

			"_soc_net_6_net_title" : "",
			"_soc_net_6" : "",
			"_soc_net_6_fa_icon" : "",
			"_soc_net_6_hover_color" : "",


			};//, "_gen_template_select", "_sidebar_main", "_sidebar_main_l", "_gen_breadcrumbs", "_sidebar_404", "_widget_type", "_theme_skin_color", "_theme_skin_pattern", "_menu_gfont", "_headers_gfont", "_text_gfont", "_gen_video_host", "_gen_slider_select", "_slider_video", "_gen_slogan", "_gen_video_autoplay", "_what_slider_select", "_cam_slider_caption", "_gen_slider_image", "_gen_slide_cat", "_gen_port_butt_show", "_gen_port_butt_txt", "_yt_color", "_yt_theme", "_vim_color", "_vim_header", "_vimeo", "_flickr", "_facebook", "_cform_emails", "_gen_gmap", "_ganalytics", "_mmf_color", "_cth_color", "_ct_color", "_h1_size", "_h2_size", "_h3_size", "_h4_size", "_h5_size", "_h6_size", "_content_fsize", "_content_lineheight", "cws_mt_", "_cws_mt", "_sidebar_search", "_cws_mt", "_logo_h", "_logo_w", "_logo_it", "_logo_ir", "_logo_il", "_logo_ib", "cws_post_under_cat", "cws_post_under_tags", "_comments_no_comments", "_comments_one_comment", "_comments_x_comments", "_comments_password", "_comments_older", "_comments_newer", "_comments_closed", "_comments_reply", "_comments_form_name", "_comments_form_email", "_comments_form_web", "_comments_submit", "_home_top", "_home_bottom", "_rss", "_gen_port_ipp", "_gen_gall_ipp", "_blog_template_select", "_sidebar_main_blog_l", "_sidebar_main_blog_r", "_columns", "_pretty_social", "_tr_paginat_page", "_contact_htfu", "_tr_ver_code", "_tr_send", "_404_not_found", "_404_unfortunately", "_please_en_name", "_invalid_email", "_verif_wrong", "_was_sent", "_em_from_form", "_tr_message", "_comments_edit", "_tr_mess_sussess", "_tr_send_later", "_tr_nothing_search", "_cws_search", "_tr_all", "_tr_moar", "_theme_skin_pallow", "_camera_caption_color", "_camera_caption_txt_color", "_theme_load_pattern", "_show_top_panel", "_port_admin_item", "_camera_pagination", "_gen_slogan_divider"];

		for (var key in defaults){
			var val = defaults [key];
			$('#' + key).val(val);
		}

		$('[data-default="1"]').each(function(){
			$(this).val(1);
			$(this).attr("checked", true);
		});


		$('.creaws_popUp').fadeOut();
		$('.popUp_reset').fadeIn();
	});

	$('.creaws_ok_button.okay').click(function(){
		$('#creaws_save_confirm').removeClass("active");
		$('.creaws_popUp').parent().removeClass("active");
		$('.creaws_cover_all').removeClass("active");
	});

	// Dialogs END

//Reset END

setTimeout(function(){
	$("#creaws_save_confirm").removeClass("active");
}, 3000)

});

function cws_font_color_switcher (){
	jQuery(".font_cont").each(function(){


	})
}

function cws_tabs_init (){
	jQuery.fn.cws_tabs = function (){
		jQuery(this).each(function (){
			var parent = jQuery(this);
			var tabs = parent.find(".tabs>*");
			var tab_items_container = parent.find(".tabs-item");
			jQuery(tab_items_container).find(">div").hide();//Hide all tab content

			jQuery(tab_items_container).find("[tabs-index='"+jQuery(tabs).parent().find(".active").attr("tabs-index")+"']").show();

			tabs.each(function(){
				jQuery(this).on("click", function (){

					var active_ind = jQuery(this).siblings(".active").eq(0).attr("tabs-index");
					jQuery(this).addClass("active").siblings().removeClass("active");
					var item = tab_items_container.find("[tabs-index='"+jQuery(this).attr('tabs-index')+"']");

					item.siblings("[tabs-index='"+active_ind+"']").eq(0).fadeToggle(200,'swing',function(){
						item.fadeToggle(200);
					});
				});
			});
		});
	}
}





function typographySelect(selector) {
	var mainID = jQuery(selector).attr('id');
	var color = jQuery('#' + mainID + '.cws_colorpicker').val();
	if (color) {
		jQuery('#' + mainID + '').parents(".font_cont").find(".gfont_preview").css('color', color);
		jQuery('#' + mainID + '').parents(".font_cont").find('.gfont_preview').css('background-color', getContrastColour(color));
	}

}
function getContrastColour(hexcolour) {
	// default value is black.
	retVal = '#444444';
	// In case - for some reason - a blank value is passed.
	// This should *not* happen.  If a function passing a value
	// is canceled, it should pass the current value instead of
	// a blank.  This is how the Windows Common Controls do it.  :P
	if (hexcolour.length > 4) {
		if (hexcolour !== '') {
			// Replace the hash with a blank.
			hexcolour = hexcolour.replace('#', '');

			var r = parseInt(hexcolour.substr(0, 2), 16);
			var g = parseInt(hexcolour.substr(2, 2), 16);
			var b = parseInt(hexcolour.substr(4, 2), 16);
			var res = ((r * 299) + (g * 587) + (b * 114)) / 1000;
			// Instead of pure black, I opted to use WP 3.8 black, so it looks uniform.  :) - kp
			retVal = (res >= 128) ? '#444444' : '#ffffff';
		}
	}else{
		if (hexcolour !== '') {
			// Replace the hash with a blank.
			hexcolour = hexcolour.replace('#', '');

			var r = parseInt(hexcolour.substr(0, 1), 16);
			var g = parseInt(hexcolour.substr(1, 1), 16);
			var b = parseInt(hexcolour.substr(2, 1), 16);
			var res = ((r * r * 299) + (g * g * 587) + (b * b * 114)) / 1000;
			// Instead of pure black, I opted to use WP 3.8 black, so it looks uniform.  :) - kp
			retVal = (res >= 128) ? '#444444' : '#ffffff';
		}
	}

	return retVal;
}
