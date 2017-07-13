
jQuery(document).ready(function($){

var pageType = $("#_pagetype_check").val();
	if (pageType == "page"){
		$("#cws_page_general .meta_content .meta-box-item").hide();
		$("#cws_page_general .meta_content ._page_check").show();

		var page_value = $("#_page_templ").val();
		if ( page_value == "double" ){
			$(".meta_content ._sidebar_double").addClass('sideActive');
		}else if ( page_value == "left" || page_value == "right" ){
			$(".meta_content ._sidebar_name").addClass('sideActive');
		}
	}else if (pageType == "blog"){
		$("#cws_page_general .meta_content .meta-box-item").hide();
		$("#cws_page_general .meta_content ._blog_check").show();

		var blog_value = $("#_blog_templ").val();
		if ( blog_value == "one" || blog_value == "two" ){
			$(".meta_content ._sidebar_name").addClass('sideActive');
		}else if ( blog_value == "double" ){
			$(".meta_content ._sidebar_double").addClass('sideActive');
		}
	}else if (pageType == "port"){
		$("#cws_page_general .meta_content .meta-box-item").hide();
		$("#cws_page_general .meta_content ._port_check").show();

		var port_value = $("#_page_port_templ").val();
		if ( port_value == "1col" ){
			$(".meta_content ._sidebar_name").show();
		}
	}else {
		$("#cws_page_general .meta_content .meta-box-item").hide();
	}

	$("#_pagetype_check").live("change" , function(){
		var pageType = $("#_pagetype_check").val();
		if (pageType == "page"){
			$("#cws_page_general .meta_content .meta-box-item").hide();
			$("#cws_page_general .meta_content ._page_check").slideDown();
		}else if (pageType == "blog"){
			$("#cws_page_general .meta_content .meta-box-item").hide();
			$("#cws_page_general .meta_content ._blog_check").slideDown();
		}else if (pageType == "port"){
			$("#cws_page_general .meta_content .meta-box-item").hide();
			$("#cws_page_general .meta_content ._port_check").slideDown();
		}else if (pageType == "gall"){
			$("#cws_page_general .meta_content .meta-box-item").hide();
			$("#cws_page_general .meta_content ._gallery_check").slideDown();
		}else if (pageType == "cform"){
			$("#cws_page_general .meta_content .meta-box-item").hide();
			$("#cws_page_general .meta_content ._cform_check").slideDown();
		}else {
			$("#cws_page_general .meta_content .meta-box-item").slideUp();
		}
	});

//page type `Page` js
	$("#_page_templ").live("change" , function(){
		var cws_page_layout = $(this).val();
		$(".meta_content .sub_page_templ").removeClass('sideActive');
		$(".meta_content .sub_page_templ").hide();
		cws_get_page_layout(cws_page_layout);
	});
	var cws_page_layout = $("#_page_templ").val();
	cws_get_page_layout(cws_page_layout);
//page type `Page` js END

//page type `Blog` js
	$("#_blog_templ").live("change" , function(){
		var cws_blog_layout = $(this).val();
		$(".meta_content .sub_page_templ").removeClass('sideActive');
		$(".meta_content .sub_page_templ").hide();
		cws_get_page_layout(cws_blog_layout);
	});
	var cws_blog_layout = $("#_blog_templ").val();
	cws_get_page_layout(cws_blog_layout);
//page type `Blog` js END

//page type `Portfolio` js
	$("#_portf_templ").live("change" , function(){
		var cws_portf_layout = $(this).val();
		$(".meta_content .sub_page_templ").removeClass('sideActive');
		$(".meta_content .sub_page_templ").hide();
		cws_get_page_layout(cws_portf_layout);
	});
	var cws_portf_layout = $("#_portf_templ").val();
	cws_get_page_layout(cws_portf_layout);
//page type `Portfolio` js END

//page type `Image Blog Posts` js
	$("#cws_single.postbox ").slideDown();
	if ($('#post-format-0').is( ":checked" ) || $('#post-format-image').is( ":checked" ))
			$('#cws_single').find('.meta-box-item').eq(0).slideUp();

	$('#post-formats-select input').click(function(){
		var id = $(this).attr('id');
		$("#cws_single.postbox ").slideDown();
		if ($('#post-format-video').is( ":checked" )) {
				$('#cws_single').find('.meta-box-item').eq(0).slideDown();
			}
		else {
				$('#cws_single').find('.meta-box-item').eq(0).slideUp();
			}
	});
//page type `Image Blog Posts` js END

function cws_get_page_layout (cws_sb_layout){
	var	sb_value = cws_sb_layout;
	switch (sb_value){
		case "sb_right" :
			$(".meta_content ._sidebar_right").show();
			break;
		case "sb_left" :
			$(".meta_content ._sidebar_left").show();
			break;
		case "sb_double" :
			$(".meta_content ._sidebar_left").show();
			$(".meta_content ._sidebar_right").show();
			break;
	}
}

});

/* widgets */
jQuery(document).ready(function() {
//	simple_select_2_init();
	invokeSelect2();
	pinterest_layout_select();
	jQuery(".redux-image-select#cws-mb-sb_layout .redux-image-select").live('click',pinterest_layout_select);
});

function format(item){
	return item.text;
}

function simple_select_2_init (){
	jQuery('select[id^="widget-cws"]:not(.icons)').each(function(){
		var id = jQuery(this).attr('id');
		if (id.indexOf("__i__") == -1) {
			jQuery(this).select2({
				allowClear: true,
				placeholder: "",
				formatResult: format,
				formatSelection: format,
				escapeMarkup: function(m) { return m; }
			});
		}
	});
}

function pinterest_layout_select () {		/* dependencies between sb_layout and pinterest cols count */
	jQuery(".redux-image-select#cws-mb-sb_layout").each( function (){
		var choice, sb_layout;
		jQuery(this).find("input[type='radio']").each(function (){
			if(jQuery(this).attr('checked') != undefined){
				choice = jQuery(this).attr('value');
			}
		});
		if ( ['left','right'].indexOf(choice)!=-1 ){
			 sb_layout = "single";
		}
		else if ( choice == 'both' ){
			sb_layout = 'double';
		}
		else{
			sb_layout = choice;
		}
		blog_layout_controller( choice );
		var data = { "single":{restricted_cols_count : [4], show_siblings : true} , "double":{restricted_cols_count : [3,4], show_siblings : false} };
		pinterest_layout_controller( data, sb_layout );
	});
}

function pinterest_layout_controller (data, sb_layout){
	var data = data[sb_layout];
	var pinterest_options = jQuery(".redux-image-select#cws-mb-pinterest_layout>.redux-image-select");
		if (data == undefined){
			pinterest_options.each(function (){
					jQuery(this).show();
			});
		}
		else{
			var restricted = data['restricted_cols_count'];
			var min = restricted[0];
			var restricted_values_selector = "";
			for (var i=0;i<restricted.length;i++){
				if (restricted[i]<min){
					min = restricted[i];
				}
				restricted_values_selector += "input[type='radio'][value='" + restricted[i] + "']";
				if (i<restricted.length-1){
					restricted_values_selector += ",";
				}
			}
			var max_allowed = min - 1;
			if (max_allowed<2){
				return;
			}
			var show_siblings = data['show_siblings'];
			pinterest_options.each(function (){
				var processed_options = jQuery(this).find(restricted_values_selector);
				if (processed_options.length>0){
					if (show_siblings){
						jQuery(this).hide().siblings().show();
					}
					else{
						jQuery(this).hide();
					}
					for (var i=0; i<processed_options.length; i++){
						if (jQuery(processed_options[i]).attr("checked")){
							var val = parseInt(jQuery(processed_options[i]).attr("value"));
							if (val>max_allowed){
								jQuery(processed_options[i]).removeAttr("checked").parents("label").removeClass("redux-image-select-selected");
								pinterest_options.find("input[type='radio'][value='" + max_allowed + "']").attr("checked","checked").parents("label").addClass("redux-image-select-selected");
							}
						}
					}
				}
			});
		}
}

function blog_layout_controller (choice){
	var is_blog = false;
	if ( choice == 'default' ){
		jQuery(".redux-image-select#cws-mb-pinterest_layout").parents("tr").hide();
		jQuery(".redux-image-select#cws-mb-blogtype").find("[name='cws-mb-blogtype']").removeAttr("checked").parent().removeClass("redux-image-select-selected");
		jQuery(".redux-image-select#cws-mb-blogtype").find("[name='cws-mb-blogtype'][value='medium']").attr("checked","checked").parent().addClass("redux-image-select-selected");
		jQuery(".redux-image-select#cws-mb-blogtype").parents("tr").hide();
	}
	else{
		if ( jQuery("[name='cws-mb-sb_override']").attr("checked") != undefined ){
			is_blog = true;
			if (is_blog){
				jQuery(".redux-image-select#cws-mb-blogtype").parents("tr").show();
				var selected = jQuery(".redux-image-select#cws-mb-blogtype").find("[name='cws-mb-blogtype'][checked='checked']");
				if ( ( selected.attr('value') == 'pinterest' ) && ( is_blog ) ){
					jQuery(".redux-image-select#cws-mb-pinterest_layout").parents("tr").show();
				}
			}
		}
	}
}

function addIconToSelectFa(icon) {
	if ( icon.hasOwnProperty( 'id' ) ) {
		return "<span><i class='fa fa-" + icon.id + " fa-2x'></i>" + "&nbsp;&nbsp;" + icon.id.toUpperCase() + "</span>";
	}
}

function invokeSelect2() {
	jQuery('.show_icon_options').live('change', function (){
		if (jQuery(this).prop("checked")){
			jQuery(this).parents(".widget-content").find(".icon-options").show(300);
		}
		else{
			jQuery(this).parents(".widget-content").find(".icon-options").hide(300);
		}
	});

	jQuery('select[id*="dept"],select[id^="cws-pb"]').each(function() {
		var id = jQuery(this).attr('id');
		var wp_content_len = jQuery(this).parents('#wp-content-wrap').length;
		if (id.indexOf("__i__") == -1 && !wp_content_len) {
			jQuery(this).select2();
		}
	});

	jQuery('.meta_group select').each(function(){
		var id = jQuery(this).attr('id');
		if (id.indexOf("__i__") == -1) {
			jQuery(this).select2({
				allowClear: true,
				placeholder: "",
				formatResult: format,
				formatSelection: format,
				escapeMarkup: function(m) { return m; }
			});
		}
	});

	jQuery('.reset_icon_options').live('click',function (e){
		e.preventDefault();
		var icon_parents = jQuery(this).parents(".icon-options");
		icon_parents.find(".icons,.image").attr("value","");
		icon_parents.find(".icons").select2("val","");
		icon_parents.find("img[id*='title_img']").attr('src','');
		icon_parents.find("a[id^='remov']").hide(300);
		icon_parents.find("a[id^='media']").show(300);
	})

	jQuery('select[id^="cws-clinico"],select.icons').each(function() {
		var id = jQuery(this).attr('id');
		if (id.indexOf("__i__") == -1) {
			if (-1 !== id.indexOf("_fa")) {
				jQuery(this).select2({
					allowClear: true,
					placeholder: " ",
					formatResult: addIconToSelectFa,
					formatSelection: addIconToSelectFa,
					escapeMarkup: function(m) { return m; }
				});
			} else {
				jQuery(this).select2();
			}
		}
	});

	jQuery('.widget-content li.redux-image-select').click(function()
	{
		var _this = jQuery(this);
		_this.addClass("selected").siblings().removeClass("selected");
		_this.children("input").prop('checked',true).siblings().prop('checked',false);
		var ind = _this.index();
		var opt_group = _this.parents(".widget-content").find(".image-part").children(".img-wrapper");
		var current_opt = opt_group.eq(ind);
		var other_opts = current_opt.siblings();
		other_opts.fadeOut( 150, function (){
			current_opt.fadeIn( 150 );
		});
	});

	jQuery('a[id^="media"]').live("click", function() {
		var _this = jQuery(this).attr('id').substring(6);
		var media_editor_attachment_backup = wp.media.editor.send.attachment;
		window['tb_remove_'] = window['tb_remove'];
		delete window['tb_remove'];
		// temporary remove this one from window object since wp tries to execute it in send_to_editor
		// we'll return it back later
		window['tb_remove'] = null;
		wp.media.editor.send.attachment = function(props, attachment) {
			jQuery('#'+_this).attr("value", attachment.id);
			var url= '';
			if (attachment.sizes.thumbnail == undefined){
				url=attachment.sizes.full.url;
			}
			else{
				url=attachment.sizes.thumbnail.url;
			}
			jQuery('img#img-'+_this).attr("src", url).show();
			jQuery('a#media-' + _this).hide(300);
			jQuery('a#remov-' + _this).show(300);
			wp.media.editor.send.attachment = media_editor_attachment_backup;
			return;
		}
		window.send_to_editor = function () { return; }
		wp.media.editor.open(this);
	});

	jQuery('a[id^="remov"]').live("click",function()
	{
		var _this = jQuery(this).attr('id').substring(6);
		jQuery("#"+_this).attr("value", '');
		jQuery('img#img-'+_this).toggle();
		jQuery('a#remov-' + _this).hide(300);
		jQuery('a#media-' + _this).show(300);
	});
}

jQuery(document).ajaxSuccess(function(e, xhr, settings) {
	var widget_id = 'cws';
	if( settings.data !== undefined) {
		if (settings.data.search('widget-id=' + widget_id) != -1 ) {
			invokeSelect2();
		}
		if (settings.data.search('action=add-tag') != -1) {
			if (settings.data.search('taxonomy=cws-staff-dept') != -1) {
				// just added tags to dept
				jQuery('img#img-dept-img').attr("src",'');
				jQuery('#dept-img').attr("value", '');
				jQuery('a#remov-dept-img').hide(300);
				jQuery('a#media-dept-img').show(300);
				jQuery('select[id^=cws-clinico]').select2('val', 'All');
			}
			if (settings.data.search('taxonomy=cws-staff-procedures') != -1) {
				jQuery('select[id^="cws-clinico"]').select2('val', 'All');
				jQuery('input[id^="cws-clinico"]').val('');
			}
		}
	}
});

