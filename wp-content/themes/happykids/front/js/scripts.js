// User agent detect --> Begin

/****************** PB ********************/

function cws_tabs_init (){
	jQuery.fn.cws_tabs = function (){
		jQuery(this).each(function (){
			var parent = jQuery(this);
			var tabs = parent.find("[role='tab']");
			var tab_items_container = parent.find("[role='tabpanel']").parent();
			tabs.each(function(){
				jQuery(this).on("click", function (){
					var active_ind = jQuery(this).siblings(".active").eq(0).attr("tabindex");
					jQuery(this).addClass("active").siblings().removeClass("active");
					var item = tab_items_container.find("[tabindex='"+this.tabIndex+"']");
					item.siblings("[tabindex='"+active_ind+"']").eq(0).fadeToggle("150",'swing',function(){
						item.fadeToggle("150");
					});
				});
			});
		});
	}
}

function cws_accordion_init (){
	jQuery.fn.cws_accordion = function () {
		jQuery(this).each(function (){
			var sections = jQuery(this).find(".accordion_section");
			sections.each( function (index, value){
				var section_index = index;
				jQuery(this).find(".accordion_title").on("click", function (){
					jQuery(this).siblings(".accordion_content").slideDown("300");
					sections.eq(section_index).addClass("active");
					sections.eq(section_index).siblings().removeClass("active").find(".accordion_content").slideUp("300");
				});
			});
		});
	}
}

function cws_toggle_init (){
	jQuery.fn.cws_toggle = function ( item_class, opener_class, toggle_section_class ){
		var i=0;
		jQuery(this).each( function (){
			i++;
			var sections = jQuery(this).find("."+item_class);
			var j=0;
			sections.each( function (index, value){
				j++;
				var section_index = index;
				jQuery(this).find("."+opener_class).eq(0).on("click", function (){
					if (!sections.eq(section_index).hasClass("active")){
						sections.eq(section_index).addClass("active");
						sections.eq(section_index).find("."+toggle_section_class).eq(0).slideDown("300");
					}
					else{
						sections.eq(section_index).removeClass("active");
						sections.eq(section_index).find("."+toggle_section_class).eq(0).slideUp("300");
					}
				});
			});
		});
	}
}

function isotope_init (){
	var container = jQuery('.portfolio .grid.isotope');
	jQuery(container).isotope({
  		itemSelector: '.iso-item',
		transitionDuration: '0.6s',
		transformsEnabled:false,
	});

	jQuery('.recent_projects .grid.isotope').isotope({
  		itemSelector: '.iso-item',
		transitionDuration: '0.6s',
		transformsEnabled:false,
	});
}

function update_grid ( old_items, new_items, div_grid ){
	div_grid.append( new_items );
	div_grid.isotope( 'remove', old_items ).isotope('layout');
	var img_loader = imagesLoaded( div_grid );
	img_loader.on ('always', function (){
		div_grid.isotope( 'appended', new_items);
		div_grid.isotope('layout');
		});
	//div_grid.isotope( { sortBy:'cat' } );
	div_grid.isotope('updateSortData').isotope();
	}

function init_pretty_photo() {
	jQuery('a.prettyPhoto[data-rel^="prettyPhoto"]').prettyPhoto({deeplinking:false}).each(function() {
		if (!(jQuery(this).children(".kids_curtain")).length) {
			jQuery(this).append('<span class="kids_curtain">&nbsp;</span>');
		}
	});
}

function cws_lang_text (){
	if(jQuery(".kids_social .lang_bar").length){
		jQuery(".kids_social .lang_bar>div ul a").each(function(){
			if (!jQuery(".kids_social .lang_bar>div ul a>span.icl_lang_sel_native").length) {
				if(jQuery(this).text().replace(/\s+/g, '').length){
					jQuery(this).append("<span>"+jQuery(this).text().trim()+"</span>")
				};
			};
		})
	}
}

function cws_patern_width (){
	if (jQuery(".bg-level-2").length) {
		jQuery(".page-content>.bg-level-2").width((jQuery(".page-content").width() - jQuery(".page-content>.l-page-width").width())/2 -20);
		jQuery(".bg-level-2-page-width-container>.bg-level-2").width((jQuery(".bg-level-2-page-width-container").width() - jQuery(".bg-level-2-page-width-container>.l-page-width").width())/2 -20);
	};
	if (jQuery(".bg-level-2-page-width-container>.l-page-width>.kids_slider_bg").length) {
		jQuery(".bg-level-2-page-width-container").addClass("with-slider");
	};
}

/* Twitter --> Begin */
function widget_carousel_init (){

	if (jQuery("html").attr('dir') == 'rtl') {
		directRTL =  'rtl'
	}else{
		directRTL =  'ltr'
	};

	jQuery(".widget_carousel").filter(function(){return !jQuery(this).parents("aside").length}).each(function(){
		jQuery(this).owlCarousel({
			direction: directRTL,
			singleItem:true,
			slideSpeed:300,
			navigation: false,
			pagination: false
		});
		var owl = jQuery(this);
		jQuery(this).parents(".cws-widget").find(".widget_carousel_nav").each(function (){
			jQuery(this).children(".next").click(function(){
				owl.trigger('owl.next');
			})
			jQuery(this).children(".prev").click(function (){
				owl.trigger('owl.prev');
			});
		});
		jQuery(this).parents(".widget").find(".widget_carousel_nav").each(function (){
			jQuery(this).children(".next").click(function(){
				owl.trigger('owl.next');
			})
			jQuery(this).children(".prev").click(function (){
				owl.trigger('owl.prev');
			});
		});
	});

	jQuery("aside .widget_carousel").each(function(){
		jQuery(this).owlCarousel({
			direction: directRTL,
			singleItem:true,
			slideSpeed:300,
			navigation: false,
			pagination: true
		});
	});
}
/* Twitter --> End */

function cws_touch_button_click(){
	jQuery(document).on("click" , "#kids_main_nav ul li>span" , function(){		
		if (jQuery(this).hasClass("opened")) {
			jQuery(this).removeClass("opened");
		}else{
			jQuery(this).addClass("opened");
		}
	})
	jQuery(document).on("click" , "#kids_main_nav .menu-button" , function(){		
		if (jQuery(this).hasClass("opened")) {
			jQuery(this).removeClass("opened");
		}else{
			jQuery(this).addClass("opened");
		}
	})

}

jQuery(document).ready(function (){
	/* init plugins */
	cws_touch_button_click()
	cws_patern_width ();
	cws_lang_text ();
	cws_tabs_init ();
	cws_accordion_init ();
	cws_toggle_init ();
	cws_progress_bar_init ();
	shiping_calc_button();
	widget_carousel_init();
	wp_image_popup();
	/* \init plugins */
	jQuery(".single_bar").cws_progress_bar();
	jQuery(".cws_widget_content.tab_widget").cws_tabs();
	jQuery(".cws_widget_content.accordion_widget").cws_accordion();
	jQuery(".cws_widget_content.toggle_widget,.services").cws_toggle("accordion_section","accordion_title","accordion_content");
});

jQuery(window).load(function (){
	isotope_init();
});

jQuery(window).resize(function(){
	cws_patern_width ();
});

function getScrollBarWidth () {
    var inner = document.createElement('p');
    inner.style.width = '100%';
    inner.style.height = '200px';

    var outer = document.createElement('div');
    outer.style.position = 'absolute';
    outer.style.top = '0px';
    outer.style.left = '0px';
    outer.style.visibility = 'hidden';
    outer.style.width = '200px';
    outer.style.height = '150px';
    outer.style.overflow = 'hidden';
    outer.appendChild (inner);

    document.body.appendChild (outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2)
        w2 = outer.clientWidth;
    document.body.removeChild (outer);

    return (w1 - w2);
};

var original_bg_image_width, original_bg_image_height;


/* Footer image color change --> Begin */

    var original_footer_image_bg_color;
    var original_footer_image_border_color;
    var setFooterImageColors = function($footer_image_wrapper) {
        $footer_image_wrapper.css({
            backgroundColor : '',
            borderColor : ''
        });
        original_footer_image_bg_color = $footer_image_wrapper.css('backgroundColor');
        original_footer_image_border_color = $footer_image_wrapper.css('border-left-color');
    }

/* Footer image color change --> End */

jQuery(document).ready(function($) {

/* ######################### DOM READY - Begin ######################### */
	$(".creaws_widget_cform").validate();

/* Contact Page error handlers --> Begin */


	$(".contact_Form").validate({
	  rules: {
		contactName: "required",
		cptch_number: "required",
		comments: "required",
		email: {
		  required: true,
		  email: true
		}
	  },
	  messages: {
		contactName: "Please specify your name",
		comments: "Please type in your message",
		cptch_number: "Please fill out this field!",
		email: {
		  required: "We need your email address to contact you",
		  email: "Your email address must be in the format of name@domain.com"
		}
	  }
	});

/* Contact Page error handlers --> End */

/* Cloud */

$(".widget.type-3 h3.widget-title").append("<div class='cloud-element-1'></div><div class='cloud-element-2'></div><div class='cloud-element-3'></div>")


/* NivoSlider --> Begin */

    if ($('#kids-slider.nivoSlider').length) {
        $('#kids-slider.nivoSlider').nivoSlider({
            controlNav: true,
            pauseTime:10000,
            directionNav: true,
            directionNavHide: false,
            prevText: '',
            nextText: ''
        });
        var $nivoControlGroup = $('.nivo-prevNav, .nivo-nextNav, .nivo-controlNavWrapperLeftBg');
        $nivoControlGroup.hover(function() {fadeInControl($nivoControlGroup)}, function() {fadeOutControl($nivoControlGroup)});
    }

/* NivoSlider --> End */

/* AnythingSlider --> Begin */

	if ($('.flexslider').length) {
	  $('.flexslider').flexslider({
	    animation: "slide",
		controlNav: true
	  });

	}

/* AnythingSlider --> End */

/* Social Icons --> Begin */
	if ($('.kids_social').length) {
		$('.kids_social>li').not($('#search-form').parent('li'), this).hover(function() {
			$(this).children('span').stop(true,false).animate({
				height: "100%",
				opacity: "1"
			}, 'normal');
		}, function() {
			$(this).children('span').stop(true,false).animate({
				height: "0",
				opacity: "0"
			}, 'normal');
		});
	};

/* Social Icons --> End */

/* Top Panel --> Begin */

	var $panel = $(".top-panel .l-page-width");

	$('.openbtn').on('click','a',function(e) {

		var $target = $(e.target);

		if($target.hasClass('hide')) {
			$panel.stop(true,false).animate({
				opacity: '0'
			},200);
			$target.blur();
		}

		$panel.slideToggle(600, function(){

			$target.toggleClass('hide');

			if($(this).css('display') == 'block') {
				$(this).stop(true,false).animate({
					opacity:'1'
				},200);
			} else {
				$(this).stop(true,false).animate({
					opacity:'0'
				},200);
			}
		});

		e.preventDefault();
	});

/* Top Panel --> End */

/* Search Form --> Begin */

	var sform = $('.kids_social #search-form');

	$('li.search a').toggle(
		function () {
			$(this).parent().addClass('hide');
			sform.parent().addClass('hide');
			sform.parent().animate({
				opacity : 1
			}, 'normal').show();
			sform.parent().find('#s').focus();
		},
		function () {
			$(this).parent().removeClass('hide');
			sform.parent().removeClass('hide');
			var sValue = sform.find('#s').val();
			if (sValue){
				sform.find('#search-submit').click();
			}
			sform.parent().animate({
				opacity : 0
			}, 'normal');
		}
	);

/* Search Form --> End */

/* Slider control fade --> Begin */

    function fadeInControl($controlGroup) {
        $controlGroup.stop(true,true).animate({opacity : 1}, 400);
    }
    function fadeOutControl($controlGroup) {
        $controlGroup.stop(true,true).animate({opacity : 0.3}, 400);
    }

/* Slider control fade --> End */

/* Camera --> Begin */

	if ($("#camera_wrap").length) {
		$('#camera_wrap').camera({
			height: '43.7%',
			loader: 'pie',
			pagination: true,
			thumbnails: false,
			barDirection:false,
			mobileAutoAdvance: true,
			hover:false,
			navigation:true,
			opacityOnGrid:false,
			playPause:false,
			navigationHover:false,
			minHeight: '100px'
		});
	}

/* Camera --> End */

/* jCarousel --> Begin */

	$(".projects_carousel").each(function (){
		var flag = false;
		$(this).children().each(function (){
			if ($(this).hasClass("woocommerce")){
				carousel_init(($(this).find("ul.products")),4);
				flag = true;
			}
		});
		if (!flag){
			carousel_init(this,$(this).attr("data-carousel-column"));
		}
	})

	$(".shortcode_carousel").each(function (){
		var col_num = jQuery(this).attr("data-carousel-column")
		if (!col_num) {
			col_num = 4;
		};
		var autoplay = jQuery(this).attr("data-autoplay")
		if (!autoplay) {
			autoplay = false;
		};		
		var flag = false;
		if (!flag){
			carousel_init($(this).find(".carousel_content>*:not(.woocommerce)"),col_num, autoplay);
		}
	})

	$(".shortcode_carousel").each(function (){
		var autoplay = jQuery(this).attr("data-autoplay")
		if (!autoplay) {
			autoplay = false;
		};			
		var flag = false;
		if (!flag){
			carousel_init($(this).find("ul.products"),4,autoplay);
		}
	})

function carousel_init (target,col,autoplay){
	if (jQuery("html").attr('dir') == 'rtl') {
		directRTL =  'rtl'
	}else{
		directRTL =  'ltr'
	};
	if (jQuery(target).parents(".double-sidebar").length) {
		switch (true) { // invariant TRUE instead of variable foo
	    case col >= 4:
	    	col = 2;
	        col_v = 2;
	        col_vi = 2;
	        break;
	    case col == 3:
	    	col = 2;
	        col_v = 2;
	        col_vi = 2;
	        break;
	    case col >= 2:
	        col_v = 2;
	        col_vi = 2;
	        break;
	    case col >= 1:
	        col_v = 1;
	        col_vi = 1;
	        break;
	    default:
	        col_v = 2;
	        col_vi = 2;
		}
	}else{
		if (jQuery(target).parents(".single-sidebar").length) {
			switch (true) { // invariant TRUE instead of variable foo
		    case col >= 4:
		    	col = 3;
		        col_v = 3;
		        col_vi = 2;
		        break;
		    case col == 3:
		    	col = 3;
		        col_v = 3;
		        col_vi = 2;
		        break;
		    case col >= 2:
		        col_v = 2;
		        col_vi = 2;
		        break;
		    case col >= 1:
		        col_v = 1;
		        col_vi = 1;
		        break;
		    default:
		        col_v = 3;
		        col_vi = 2;
			}
		}else{
			switch (true) { // invariant TRUE instead of variable foo
			    case col >= 4:
			        col_v = 4;
			        col_vi = 3;
			        break;
			    case col == 3:
			        col_v = 3;
			        col_vi = 3;
			        break;
			    case col >= 2:
			        col_v = 2;
			        col_vi = 2;
			        break;
			    case col >= 1:
			        col_v = 1;
			        col_vi = 1;
			        break;
			    default:
			        col_v = 4;
			        col_vi = 3;
			}
		}

	}

	$(target).owlCarousel({
		direction: directRTL,
		items: col,
		itemsDesktop: false,
		itemsDesktopSmall: [1173,col_v],
		itemsTablet: [964,col_vi],
		itemsTabletSmall: [750,1],
		navigation: true,
		navigationText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		pagination: false,
		autoPlay: autoplay
	});
}

  if($('.minigallery-list .minigallery').length) {
	$(".minigallery-list .minigallery").jCarouselLite({
		btnNext: ".next",
		btnPrev: ".prev",
		scroll: 3,
		visible: 9,
		speed: 400,
		mouseWheel: true,
		circular:false,
		easing: "easeInOutCubic"
	});
  }

  if($('.minigallery-list2 .minigallery').length) {
	$(".minigallery-list2 .minigallery").jCarouselLite({
		btnNext: ".next2",
		btnPrev: ".prev2",
		scroll: 3,
		visible: 9,
		speed: 400,
		mouseWheel: true,
		circular:false,
		easing: "easeInOutCubic"
	});
  }

/* jCarousel --> End */

/* Search form --> Begin */

    var $search_form = $('#kids_search_form');
    var $search_wrapper = $search_form.find('.kids_search_wrapper');
    var $search_input = $search_form.find('input');

    $search_form.hover(function() {
        $search_wrapper.stop(true,true).fadeIn(600);
		$search_wrapper.find('input[type=text]').focus();
    },function() {
        if ($search_input.is(":focus")) {
            $search_wrapper.stop(true,true).fadeOut(400);
        } else {
            $search_input.blur(function() {
                $search_wrapper.stop(true,true).fadeOut(400);
                $search_input.unbind('blur');
            });
        }
    });

/* Search form --> End */

/* Main navigation --> Begin */



/* Main navigation --> End */

/* Pretty photo popup --> Begin */

	if($('.prettyPhoto').length) {

		(function() {
			$('a.prettyPhoto').prettyPhoto().each(function() {
				if (!($(this).children(".kids_curtain")).length) {
					$(this).append('<span class="kids_curtain">&nbsp;</span>');
				}
			});
		})();

	}

/* Pretty photo popup --> End */

/* To top --> Begin */

	(function() {
		var extend = {
				button      : '#kids-back-top',
				text        : 'Back to Top',
				min         : 200,
				fadeIn      : 400,
				fadeOut     : 400,
				speed		: 800,
				easing		: 'easeOutQuint'
			}

		$('body').append('<div id="' + extend.button.substring(1) + '"><a href="#top" title="' + extend.text + '"><span></span></a></div>');

		$(window).scroll(function() {
			var pos = $(window).scrollTop();

			if (pos > extend.min) {
				$(extend.button).fadeIn(extend.fadeIn);
			}
			else {
				$(extend.button).fadeOut (extend.fadeOut);
			}

		});

		var pos = $(window).scrollTop();

		if (pos > extend.min) {
			$(extend.button).fadeIn(extend.fadeIn);
		}
		else {
			$(extend.button).fadeOut (extend.fadeOut);
		}

		$(extend.button).add(extend.backToTop).click(function(e){
			$('html, body').animate({scrollTop : 0}, extend.speed, extend.easing);
			e.preventDefault();
		});

	})();

/* end Back to Top */

/* To top --> End */

/* Bottom container images --> Begin */

    setFooterImageColors($('#kids_bottom_container .kids_image_wrapper'));

    if ($('#kids_bottom_container .kids_image_wrapper').length) {
        $('#kids_bottom_container .kids_image_wrapper').hover(function() {
            $(this).stop(true,true).animate({backgroundColor : "#ddf0f7", borderColor : "#ddf0f7"}, 600);
        },function() {
            $(this).stop(true,true).animate({backgroundColor : original_footer_image_bg_color, borderColor : original_footer_image_border_color}, 400);
        });
    }

/* Bottom container images --> End */


/* Pricing Tables --> Begin */

	(function() {

		if($('.pricing-table').length) {

			var pt = $('.pricing-table .column', this);
				pt.find('li:even:not(.footer_row):not(.header_row)').addClass('even');
				pt.first().addClass('first');
				pt.last().addClass('last');
				pt.find('li:not(.header_row):first').css('padding-top','2.2em');
				pt.find('li:not(.footer_row):last').css('padding-bottom','2.2em');
			var ptFirst = $('.pricing-table .column:first-child');
			var ptLast = $('.pricing-table .column:last-child');
				ptFirst.find('li:not(.footer_row):not(.header_row)').css('border-left', '2px solid #98c2e1');
				ptLast.find('li:not(.footer_row):not(.header_row)').css('border-right', '2px solid #98c2e1');
				$('.pricing-table .column:last-child').find('.footer_row').addClass('footer_border');

		}

	})();


/* Pricing Tables --> End */

/* Accordion --> Begin */

	if($('ul.accordion').length) {
		$('ul.accordion').accordion({autoHeight:false,header:".opener",collapsible:true,event:"click",heightStyle: "content"});
	}

	if($('.widget_categories ul').length) {
		$('.widget_categories ul').accordion({autoHeight:false,header:".opener",collapsible:true,event:"click"});
	}

	if($('ul.highlighter').length) {
		$('ul.highlighter').accordion({active:'.selected',autoHeight:false,header:"a",collapsible:true,event:"click"});
	}

	if($('.widget_nav_menu ul').length) {
		$('.widget_nav_menu ul').accordion({autoHeight:false,header:".opener",collapsible:true,event:"click"});
	}

	//////////////////////////////

		$('.widget_nav_menu ul>li:has(ul)').each(function(index){
			$(this).find('ul').hide();
			$(this).append('<span class="catappendspan"></span>');
			$(this).click(function(e){
				e.stopPropagation();
				var childrenFunction = $(this).children('ul.sub-menu');
				$(this).children('.catappendspan').toggleClass('active');
				childrenFunction.slideToggle();
			});
		});

	//////////////////////////////
	//////////////////////////////

		$('.widget_categories>ul>li:has(ul)').each(function(index){
			$(this).find('ul').hide();
			$(this).append('<span class="catappendspan"></span>');
			$(this).click(function(e){
				e.stopPropagation();
				var childrenFunction = $(this).children('ul.children');
				$(this).children('.catappendspan').toggleClass('active');
				childrenFunction.slideToggle();
			});
		});

	//////////////////////////////

/* Accordion --> End */

/* Tabs --> Begin */

	$('.tabs:not(.wc-tabs)').each( function () {
		//When page loads...

		$(this).children("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(this).parent().children(".tab_container").children(".tab_content:first").show(); //Show first tab content

		//On Click Event
		var parent = this;
		$(this).children("ul.tabs li").click(function() {

			$(parent).children("ul.tabs li").removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(parent).parent().children().children(".tab_content").hide(); //Hide all tab content

			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(parent).parent().find(activeTab).fadeIn('slow'); //Fade in the active ID content
			return false;
		});
	} );

/* Tabs --> End */

/* Toggle --> Begin */

	if($('.toggle_container').length) {
		$(".toggle_container").hide();

		$("div.trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle("slow");
			return false;
		});
	}

/* Toggle --> End */


	if (jQuery("a[data-rel]").length) {
		jQuery('a[data-rel]').each(function() {jQuery(this).attr('rel', jQuery(this).data('rel'));});
	}

	if($('.splitter').length) {
		$('.splitter').lavaLamp({fx: "easeOutCubic", speed: 400});
	}


/* Tables --> Begin */

	if($('.custom-table').length) {

		$('.custom-table thead tr th:first-child,.custom-table2 thead tr th:first-child').addClass('radius-left');
		$('.custom-table thead tr th:last-child, .custom-table2 thead tr th:last-child').addClass('radius-right');
		$('.custom-table tbody tr td:last-child, .custom-table2 tbody tr td:last-child').addClass('noborder');

	}

/* Tables --> End */

/* Box close --> Begin */

	function handler(event) {

		var $target = $(event.target);

		if($target.is('.close-box')) {
			var $box = $target.parent();
			$box.animate({opacity: '0'}, 500, function() {
				$(this).slideUp(500, function() {
					$(this).remove();
				});
			});
		}

	}

	$('.message_box').click(handler);

/* Box close --> End */

/*Responsive */

	$(".flexnav").flexNav();

/* Recent Posts arrows fix */

	$(".camera_pag").wrapAll('<div class="camera_pagination"></div>').wrapAll('<div class="camerapag_left"></div>').wrapAll('<div class="camerapag_right"></div>');

	$(".flex-control-nav").wrapAll('<div class="camera_pagination_wrapper"></div>').wrapAll('<div class="camera_pagination"></div>').wrapAll('<div class="camerapag_left"></div>').wrapAll('<div class="camerapag_right"></div>').wrapAll('<div class="camera_pag"></div>');

/*Responsive --> End */


});// ######################### DOM READY - END #########################

/* Pretty photo gallery fix --> Begin */
	jQuery(function($) { init_pretty_photo(); });
/* Pretty photo gallery fix --> End */


/* PROGRESS BAR */

function cws_progress_bar_init (){
	jQuery.fn.cws_progress_bar = function (){
		jQuery(this).each( function (){
			var el = jQuery(this);
			var done = false;
			if (!done) done = progress_bar_controller(el);
			jQuery(window).scroll(function (){
				if (!done) done = progress_bar_controller(el);
			});
		});
	}
}

function progress_bar_controller (el){
	is_visible_init ()
	if (el.is_visible()){
		var progress = el.find(".progress");
		var value = parseInt( progress.attr("data-value") );
		var width = parseInt(progress.css('width').replace(/%|(px)|(pt)/,""));
		var ind = el.find(".indicator");
		var progress_interval = setInterval( function(){
			width ++;
			progress.css("width", width+"%");
			ind.text(width);
			if (width == value){
				clearInterval(progress_interval);
			}
		}, 5);
		return true;
	}
	return false;
}

function is_visible_init (){
	jQuery.fn.is_visible = function (){
		return ( jQuery(this).offset().top >= jQuery(window).scrollTop() ) && ( jQuery(this).offset().top <= jQuery(window).scrollTop() + jQuery(window).height() );
	}
}

function wp_image_popup(flag){
	if(jQuery("img[class*='wp-image']").parent("a").length){
		jQuery("img[class*='wp-image']").each(function(){
			var img_width = jQuery(this).width();
			var img_height = jQuery(this).height();

			if (!jQuery(this).hasClass("url")) {
				jQuery(this).parent("a").addClass("prettyPhoto");
			};

			jQuery(this).parent("a").addClass("wp-image-popup").attr("title" , "").append('<span class="kids_curtain">&nbsp;</span>').width(img_width)

			if(jQuery(this).hasClass("aligncenter")){
				jQuery(this).parent("a").addClass("aligncenter");
			}
			if(jQuery(this).hasClass("alignleft")){
				jQuery(this).parent("a").addClass("alignleft");
			}
			if(jQuery(this).hasClass("alignright")){
				jQuery(this).parent("a").addClass("alignright");
			}

		})
		
	}
}

function shiping_calc_button(){
	if(jQuery(".woocommerce-page .shipping_calculator .shipping-calculator-button").length){
		jQuery(".woocommerce-page .shipping_calculator .shipping-calculator-button").addClass("alt");
		jQuery(".woocommerce-page .shipping_calculator .shipping-calculator-button").click(function(){
			jQuery(this).toggleClass("active");
		})
	}

}


	/**/
	/* MARK */
	/**/
	jQuery(document).ready(function ($){
		$(".stars").ready(function (){
			var rtl = typeof cws_is_rtl == 'function' ? cws_is_rtl() : false;
			var stars_active = false;
			$(".woocommerce .stars").on("mouseover", function(){
				if (!stars_active){
					$(this).find("span:not(.stars-active)").append("<span class='stars-active' data-set='no'>&#xf005;&#xf005;&#xf005;&#xf005;&#xf005;</span>");
					stars_active = true;
				}
			});
			$(".woocommerce .stars").on("mousemove", function (e){
				var width = $(this).width();
				var cursor = e.pageX;
				var ofs = $(this).offset().left;
				var fill = rtl ? width - ( cursor - ofs ) : cursor - ofs;
				var persent = Math.round(100*fill/width);
				$(".woocommerce .stars .stars-active").css("width",String(persent)+"%");
				$(".stars-active").removeClass("fixed-mark")
			});
			$(".woocommerce .stars").on("click", function (e){
				var width = $(this).width();
				var cursor = e.pageX;
				var ofs = $(this).offset().left;
				var fill = rtl ? width - ( cursor - ofs ) : cursor - ofs;
				var persent = Math.ceil( Math.round( 100 * ( fill/width ) ) / 20 ) * 20;
				var mark = $(this).find(".stars-active");
				mark.css('width',String(persent)+"%");
				mark.attr("data-set",String(persent));
			});
			$(".woocommerce .stars").on("mouseleave", function (e){
				var mark = $(this).find(".stars-active");
				if (mark.attr("data-set") == "no"){
					mark.css("width","0");
				}
				else{
					var persent = mark.attr("data-set");
					mark.css("width",String(persent)+"%");
					$(".stars-active").addClass("fixed-mark");
				}
			});
		});
	})

/* MARK */

/* portfolio */
jQuery('.page-content').on('click', '.pagenavi.gl a', function (e){
	/*if (ios) {
		jQuery(".toggle_sidebar .switcher").off("click");
	}*/
	PortfolioPage( e, 0 );
});

jQuery('.page-content').on('change', 'div[class*="iso-column"] select.filter', function (e){
	/*if (ios) {
		jQuery(".toggle_sidebar .switcher").off("click");
	}*/
	PortfolioPage( e, 1 );
});

function PortfolioPage( e, type ) {
	var gallery = document.querySelector('.grid.isotope');
	if (gallery) {
		e.preventDefault();
		var aurl = gallery.dataset['ajax'];
		var ppp = gallery.dataset['ppp'];
		var cols = gallery.dataset['cols'];	
		var page_match = !type ? e.target.href.match(/paged=(\d+)/i) : null;
		var page = page_match ? page_match[1] : '1';
		var filter =  document.querySelector('select.filter') ? document.querySelector('select.filter').value : '*';
		var dta = new Array( page, filter, ppp, cols);

		jQuery.ajax({ url: aurl,
			data: {	action: dta	},
			type: 'post',
			filter: filter,
			'cache': 'true',
			success: function(data) {
				var gallery = document.body.getElementsByClassName('grid')[0]; // can be only one gallery
				var gall_parent = gallery.parentNode;
				var pagenavi = gall_parent.parentNode.querySelector('.pagenavi.gl');
				//gall_parent.removeChild(gallery);
				var div_grid = jQuery('.grid');
				var new_items = jQuery('.iso-item', jQuery('<div>'+data+'</div>'));
				var old_items = div_grid.isotope('getItemElements');
				var new_pagination = jQuery('.pagenavi.gl', jQuery('<div>'+data+'</div>'));

				if (pagenavi) {
					gall_parent.removeChild(pagenavi);
				}
				var clrfx = gall_parent.querySelectorAll('.kids_clear');
				for (var i=0; i<clrfx.length;i++) {
					//gall_parent.removeChild(clrfx[i]);
				}
				//gall_parent.innerHTML = gall_parent.innerHTML + data;
				//init_portfolio();
				update_grid(old_items, new_items, div_grid);
				if (Boolean(new_pagination.length)){
					new_pagination.fadeOut('1');
					div_grid.parent().append(new_pagination);
					div_grid.parent().find(".pagenavi.gl").fadeIn("600");
				} else {
					div_grid.parent().find(".pagenavi.gl").fadeOut("300");
				}
				jQuery('img').each(function(){new RetinaImage(this);});
				init_pretty_photo();
				jQuery('html, body').animate({
					scrollTop: jQuery(".portfolio").offset().top - 20
				}, 1000);
				var filter = this.filter ? this.filter : '*';
				if (document.querySelector('div[class*="iso-column"] select.filter')) {
					document.querySelector('div[class*="iso-column"] select.filter').value = filter;
				}			
			}
		});
		e.stopPropagation();
	}
}

