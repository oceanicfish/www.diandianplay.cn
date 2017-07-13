var dept_data = [];

function cws_shortcode_init() {
	var $=jQuery;
	var dept_select = $('select#cws-mb-dept\\[\\]');
	var dept_open = $('select#cws-mb-deptopen\\[\\]');
	var dept_len = dept_open.length;

	$(document).ready(function() {
		if (dept_open.length) {
			for (var i=0; i < dept_open[0].length; i++) {
				var el = new Object();
				el.id = dept_open[0].options[i].value;
				el.text = dept_open[0].options[i].text;
				dept_data.push(el);
				delete el;
			}
		}

		$("select[id^=cws-mb]").each( function() {
			var lastchars = this.name.substr(this.name.length - 4, 3);
			if ('-fa' === lastchars) {
				debugger
				$(this).select2({
					formatResult: fa_format,
					formatSelection: fa_format,
					triggerChange: true,
					allowClear: true,
					escapeMarkup: function(m) { return m; }
				});
			}
			else {
				$(this).select2();
			}
		});

		$("input[data-default-color]").each(function(){
			$(this).wpColorPicker();
		});

		dept_select.on('select2-removing', function(e) {
			for (var i = 0; i < dept_open[0].length; i++) {
				if (dept_open[0].options[i].value == e.val)
				{
					dept_open[0].options[i].selected = false;
					var data_arr = dept_open.select2("data");
					for (var j=0; j<data_arr.length; j++) {
						if (data_arr[j].id == e.val) {
							data_arr.splice(j, 1); // because of first empty value
							break;
						}
					}
					dept_open.select2("data", data_arr);
					dept_open[0].remove(i);
					break;
				}
			}
			// now check if dept_select is about to become empty and
			// fill dept_open withh all the data in this case
			var selected_count = 0;
			for (i = 0; i < dept_select[0].length; i++) {
				selected_count += dept_select[0].options[i].selected ? 1 : 0;
			}
			if (selected_count == 1) {
				// load with inital data
				for (i = 0; i < dept_data.length; i++) {
					var opt = document.createElement('option');
					opt.value = dept_data[i].id;
					opt.innerHTML = dept_data[i].text;
					dept_open[0].appendChild(opt);
				}
			}
		});

		dept_select.on('select2-selecting', function(e) {
			var selected_count = 0;
			for (i = 0; i < dept_select[0].length; i++) {
				selected_count += dept_select[0].options[i].selected ? 1 : 0;
			}
			if (!selected_count) {
				//dept_open.select2("data", null);
				dept_open.empty();
			}
			var opt = document.createElement('option');
			opt.value = e.object.id;
			opt.innerHTML = e.object.text;
			dept_open[0].appendChild(opt);
		});

		$("select[id^=cws-mb]").each( function() {
			var lastchars = this.name.substr(this.name.length - 3, 3);
			if ('-fa' === lastchars) {
				$(this).select2({
					formatResult: fa_format,
					formatSelection: fa_format,
					triggerChange: true,
					allowClear: true,
					escapeMarkup: function(m) { return m; }
			});
			}
			else {
				$(this).select2();
			}
		});

		$("input[data-default-color]").each(function(){
			$(this).wpColorPicker();
		});

	});

	function fa_format (state) {
		if (!state.id) return state.text; // optgroup
		var fa_class = state.id.replace(/ /g, '-');
		var ret = '<i class="fa fa-' + fa_class + ' fa-2x"></i>&nbsp;' + state.text;
		return ret;
	}

	if ($("#cws-mb-fa").length) {
		$(document).ready(function() {
			var sel = "";
			$.each(fa_array,function(i){
				sel += '<option value="'+fa_array[i]+'">'+fa_array[i]+'</option>';
			});

			$("#cws-mb-fa").append(sel);
		});
	}

	if ($("#cws-mb-fa-back").length) {
		$(document).ready(function() {
			var sel = "";
			$.each(fa_back_array,function(i){
				sel += '<option value="' + fa_back_array[i] + '">'+fa_back_array[i]+'</option>';
			});

			$("#cws-mb-fa-back").append(sel);
		});
	}

	$('#cws_insert_button').click( function() {
		var code_start='';
		var code_end='';

		var type = $('#cws-shortcode-type').val();
		var selection = decodeURIComponent( $('#cws-shortcode-selection').val() );

		switch (type) {
			case 'quote':
				var atts = {};
				atts['photo'] = $('#img-cws-mb-photo').attr("src");
				atts['author'] = $('#cws-mb-author').val();
				var text = $('#cws-mb-text').val();
				code_start = "";
				if (text.length){
					code_start += '[quote ' + print_shortcode_atts( atts ) + ']' + text + '[/quote]';
				}
			break
			case 'embed':
				var atts = {};
				var url = $('#cws-mb-url').val();
				atts['width'] = $('#cws-mb-width').val();
				atts['height'] = $('#cws-mb-height').val();
				code_start = '[embed ' + print_shortcode_atts( atts ) + ']' + url + '[/embed]';
			break
			case 'progress':
				var atts = {};
				atts['title'] = $('#cws-mb-title').val();
				atts['progress'] = $('#cws-mb-progress').val();
				atts['color'] = $('#cws-mb-color').val();
				var shortcode_atts = print_shortcode_atts( atts );
				code_start = shortcode_atts.length ? '[progress ' + shortcode_atts + ' /]' : '';
			break
			case 'alert':
				var atts = {};
				atts['title'] = $('#cws-mb-title').val();
				atts['type'] = $('#cws-mb-type').val();
				var text = $('#cws-mb-text').val();
				var close = $('input[name=cws-mb-close_type').is(":checked") ? " close=1" : "";
				var fa = $('#cws-mb-fa').val();
				var bg_color = $('#cws-mb-bg_color').val();
				var custom_code = $('input[name=cws-mb-custom').is(":checked") ? " custom=1 bg_color=" + bg_color + (fa ? ' fa_code=' + fa : '' ) : "";
				console.log(custom_code);
				var shortcode_atts = print_shortcode_atts( atts );
				code_start = '[alert ' + shortcode_atts  + close + custom_code + ' ]' + text + '[/alert]';
			break
			case 'fa':
				var fa = $('#cws-mb-fa').val().replace(/ /g, '-');
				if (!fa) break;
				var size = $('#cws-mb-size').val();
				var custom = $('[name="cws-mb-custom_color"]').is(":checked");
				var color = $('#cws-mb-color').val();
				var bg_color = $('#cws-mb-bg_color').val();
				var custom_color_args = custom ? " custom_color=1 color=" + color + " bg_color=" + bg_color : "";
				code_start = '[fa fa_code=' + fa + ' size=' + size + custom_color_args + ' /]';
			break
			case 'mark':
				var atts = {};
				atts['color'] = $('#cws-mb-color').val();
				atts['bg_color'] = $('#cws-mb-bgcolor').val();
				code_start = '[mark ' + print_shortcode_atts(atts) + ' ]' + selection + '[/mark]';
			break
			case 'portfolio':
				var atts = {};
				atts['cols'] = $('#cws-mb-cols').val();
				atts['cats'] = '';
				var fcats = $('#cws-mb-cat\\[\\]').val()
				if (undefined !== fcats && null !== fcats) {
					atts['cats'] = $('#cws-mb-cat\\[\\]').val();
				}
				atts['usecarousel'] = $('input[name=cws-mb-usecarousel]').is(':checked') ? '1' : '';
				atts['img_popup'] = $('input[name=cws-mb-img_popup]').is(':checked') ? '1' : '';
				atts['title'] = $('input[name=cws-mb-title]').val();
				atts['more'] = $('input[name=cws-mb-show_rmore_button]').is(':checked') ? '1' : '';
				atts['postspp'] = $('#cws-mb-posts').val();
				atts['button'] = $('input[name=cws-mb-button]').val();
				atts['img_width'] = $('input[name=cws-mb-img_width]').val();
				atts['img_height'] = $('input[name=cws-mb-img_height]').val();
				atts['txt_length'] = $('input[name=cws-mb-txt_length]').val();
				atts['hide_text'] = $('input[name=cws-mb-hide_text]').is(':checked') ? '1' : '';
				code_start = "[portfolio " + print_shortcode_atts(atts) + " /]";
			break
			case 'tweets':
				var title = $('#cws-mb-title').val();
				var num = $('#cws-mb-num').val();
				var num_vis = $('#cws-mb-num_vis').val();
				code_start = '[twitter tweets=' + num + ' visible=' + num_vis + ' title="' + title + '"/]';
			break
			case 'cws_cta':
				var atts = {};
				atts['icon'] = $('#cws-mb-fa').val();
				atts['title'] = $('#cws-mb-title').val();
				atts['button_text'] = $('#cws-mb-button_text').val();
				atts['link'] = $('#cws-mb-link').val();
				var text = $('#cws-mb-text').val();
				code_start = '[cws_cta ' + print_shortcode_atts( atts ) + ']' + text + '[/cws_cta]';
			break
			case 'cws_button':
				var type = $('#cws-mb-type').val();
				var size = $('#cws-mb-size').val();
				var text = $('#cws-mb-text').val();
				var fa = $('#cws-mb-fa').val();
				var link = $('#cws-mb-link').val();
				var custom_color = $('[name=\'cws-mb-custom_color\']').is(':checked');
				var button_color = $('#cws-mb-button_color').val();
				var text_color = $('#cws-mb-text_color').val();
				var icon_color = $('#cws-mb-icon_color').val();
				code_start = '[cws_button type=' + type + ' size=' + size + ' link=' + link + (fa ?  ' fa_code=' + fa : "" ) + ' ';
				if (custom_color){
					code_start += 'custom_color=1 button_color=' + button_color + ' text_color=' + text_color + ' icon_color=' + icon_color + ' '
				}
				code_start += ']' + text + '[/cws_button]'
			break
			case 'shortcode_blog':
				var atts = {};
				atts['title'] = $('input[name=cws-mb-title]').val();
				atts['cols'] = $('#cws-mb-cols').val();
				atts['cats'] = '';
				var fcats = $('#cws-mb-cats\\[\\]').val()
				if (undefined !== fcats && null !== fcats) {
				 	atts['cats'] = $('#cws-mb-cats\\[\\]').val();
				}
				atts['postspp'] = $('#cws-mb-posts').val();
				atts['usecarousel'] = $('input[name=cws-mb-usecarousel]').is(':checked') ? '1' : '';
				atts['img_popup'] = $('input[name=cws-mb-img_popup]').is(':checked') ? '1' : '';
				atts['img_width'] = $('input[name=cws-mb-img_width]').val();
				atts['img_height'] = $('input[name=cws-mb-img_height]').val();
				atts['txt_length'] = $('input[name=cws-mb-txt_length]').val();
				atts['hide_date'] = $('input[name=cws-mb-hide_date]').is(':checked') ? '1' : '';
				atts['hide_footer'] = $('input[name=cws-mb-hide_footer]').is(':checked') ? '1' : '';
				atts['hide_meta'] = $('input[name=cws-mb-hide_meta]').is(':checked') ? '1' : '';
				atts['button'] = $('input[name=cws-mb-button]').val();
				code_start = "[shortcode_blog " + print_shortcode_atts(atts) + " /]";
			break
			case 'shortcode_carousel':
				var title = $('#cws-mb-title').val();
				var columns = $('#cws-mb-carousel_cols').val();
				var autoplay = $('input[name=cws-mb-carousel_autop]').is(':checked') ? '1' : '';
				var autop_speed = $('#cws-mb-carousel_autop_speed').val();

				code_start += "[shortcode_carousel" + ( title ? " title='" + title + "'" : "") + ( autoplay ? " autoplay='1' autoplay_speed='" + autop_speed + "'" : "") + ( columns ? " column='" + columns + "'" : "")+ "]" + selection + "[/shortcode_carousel]"
			break
		}
		if(window.tinyMCE) {
			window.tinyMCE.activeEditor.selection.setContent(code_start + code_end);
			if (window['tb_remove_']) {
				window['tb_remove'] = window['tb_remove_'];
				delete window['tb_remove_']; // this one doesn't work somehow
				window['tb_remove_'] = null;
			}
			tb_remove();
		}

		return false;
	});
}

function print_shortcode_atts(atts){
	out = "";
	jQuery.each( atts, function ( index, value ){
		out += print_shortcode_attr( index, value );
	});
	return out;
}

function print_shortcode_attr (name,value){
	if (value) return " " + name + "='" + value + "'";
	else return "";
}

var fa_array = ["",
"glass",
"music",
"search",
"envelope-o",
"heart",
"star",
"star-o",
"user",
"film",
"th-large",
"th",
"th-list",
"check",
"times",
"search-plus",
"search-minus",
"power-off",
"signal",
"cog",
"trash-o",
"home",
"file-o",
"clock-o",
"road",
"download",
"arrow-circle-o-down",
"arrow-circle-o-up",
"inbox",
"play-circle-o",
"repeat",
"refresh",
"list-alt",
"lock",
"flag",
"headphones",
"volume-off",
"volume-down",
"volume-up",
"qrcode",
"barcode",
"tag",
"tags",
"book",
"bookmark",
"print",
"camera",
"font",
"bold",
"italic",
"text-height",
"text-width",
"align-left",
"align-center",
"align-right",
"align-justify",
"list",
"outdent",
"indent",
"video-camera",
"picture-o",
"pencil",
"map-marker",
"adjust",
"tint",
"pencil-square-o",
"share-square-o",
"check-square-o",
"arrows",
"step-backward",
"fast-backward",
"backward",
"play",
"pause",
"stop",
"forward",
"fast-forward",
"step-forward",
"eject",
"chevron-left",
"chevron-right",
"plus-circle",
"minus-circle",
"times-circle",
"check-circle",
"question-circle",
"info-circle",
"crosshairs",
"times-circle-o",
"check-circle-o",
"ban",
"arrow-left",
"arrow-right",
"arrow-up",
"arrow-down",
"share",
"expand",
"compress",
"plus",
"minus",
"asterisk",
"exclamation-circle",
"gift",
"leaf",
"fire",
"eye",
"eye-slash",
"exclamation-triangle",
"plane",
"calendar",
"random",
"comment",
"magnet",
"chevron-up",
"chevron-down",
"retweet",
"shopping-cart",
"folder",
"folder-open",
"arrows-v",
"arrows-h",
"bar-chart",
"twitter-square",
"facebook-square",
"camera-retro",
"key",
"cogs",
"comments",
"thumbs-o-up",
"thumbs-o-down",
"star-half",
"heart-o",
"sign-out",
"linkedin-square",
"thumb-tack",
"external-link",
"sign-in",
"trophy",
"github-square",
"upload",
"lemon-o",
"phone",
"square-o",
"bookmark-o",
"phone-square",
"twitter",
"facebook",
"github",
"unlock",
"credit-card",
"rss",
"hdd-o",
"bullhorn",
"bell",
"certificate",
"hand-o-right",
"hand-o-left",
"hand-o-up",
"hand-o-down",
"arrow-circle-left",
"arrow-circle-right",
"arrow-circle-up",
"arrow-circle-down",
"globe",
"wrench",
"tasks",
"filter",
"briefcase",
"arrows-alt",
"users",
"link",
"cloud",
"flask",
"scissors",
"files-o",
"paperclip",
"floppy-o",
"square",
"bars",
"list-ul",
"list-ol",
"strikethrough",
"underline",
"table",
"magic",
"truck",
"pinterest",
"pinterest-square",
"google-plus-square",
"google-plus",
"money",
"caret-down",
"caret-up",
"caret-left",
"caret-right",
"columns",
"sort",
"sort-desc",
"sort-asc",
"envelope",
"linkedin",
"undo",
"gavel",
"tachometer",
"comment-o",
"comments-o",
"bolt",
"sitemap",
"umbrella",
"clipboard",
"lightbulb-o",
"exchange",
"cloud-download",
"cloud-upload",
"user-md",
"stethoscope",
"suitcase",
"bell-o",
"coffee",
"cutlery",
"file-text-o",
"building-o",
"hospital-o",
"ambulance",
"medkit",
"fighter-jet",
"beer",
"h-square",
"plus-square",
"angle-double-left",
"angle-double-right",
"angle-double-up",
"angle-double-down",
"angle-left",
"angle-right",
"angle-up",
"angle-down",
"desktop",
"laptop",
"tablet",
"mobile",
"circle-o",
"quote-left",
"quote-right",
"spinner",
"circle",
"reply",
"github-alt",
"folder-o",
"folder-open-o",
"smile-o",
"frown-o",
"meh-o",
"gamepad",
"keyboard-o",
"flag-o",
"flag-checkered",
"terminal",
"code",
"reply-all",
"star-half-o",
"location-arrow",
"crop",
"code-fork",
"chain-broken",
"question",
"info",
"exclamation",
"superscript",
"subscript",
"eraser",
"puzzle-piece",
"microphone",
"microphone-slash",
"shield",
"calendar-o",
"fire-extinguisher",
"rocket",
"maxcdn",
"chevron-circle-left",
"chevron-circle-right",
"chevron-circle-up",
"chevron-circle-down",
"html5",
"css3",
"anchor",
"unlock-alt",
"bullseye",
"ellipsis-h",
"ellipsis-v",
"rss-square",
"play-circle",
"ticket",
"minus-square",
"minus-square-o",
"level-up",
"level-down",
"check-square",
"pencil-square",
"external-link-square",
"share-square",
"compass",
"caret-square-o-down",
"caret-square-o-up",
"caret-square-o-right",
"eur",
"gbp",
"usd",
"inr",
"jpy",
"rub",
"krw",
"btc",
"file",
"file-text",
"sort-alpha-asc",
"sort-alpha-desc",
"sort-amount-asc",
"sort-amount-desc",
"sort-numeric-asc",
"sort-numeric-desc",
"thumbs-up",
"thumbs-down",
"youtube-square",
"youtube",
"xing",
"xing-square",
"youtube-play",
"dropbox",
"stack-overflow",
"instagram",
"flickr",
"adn",
"bitbucket",
"bitbucket-square",
"tumblr",
"tumblr-square",
"long-arrow-down",
"long-arrow-up",
"long-arrow-left",
"long-arrow-right",
"apple",
"windows",
"android",
"linux",
"dribbble",
"skype",
"foursquare",
"trello",
"female",
"male",
"gratipay",
"sun-o",
"moon-o",
"archive",
"bug",
"vk",
"weibo",
"renren",
"pagelines",
"stack-exchange",
"arrow-circle-o-right",
"arrow-circle-o-left",
"caret-square-o-left",
"dot-circle-o",
"wheelchair",
"vimeo-square",
"try",
"plus-square-o",
"space-shuttle",
"slack",
"envelope-square",
"wordpress",
"openid",
"university",
"graduation-cap",
"yahoo",
"google",
"reddit",
"reddit-square",
"stumbleupon-circle",
"stumbleupon",
"delicious",
"digg",
"pied-piper",
"pied-piper-alt",
"drupal",
"joomla",
"language",
"fax",
"building",
"child",
"paw",
"spoon",
"cube",
"cubes",
"behance",
"behance-square",
"steam",
"steam-square",
"recycle",
"car",
"taxi",
"tree",
"spotify",
"deviantart",
"soundcloud",
"database",
"file-pdf-o",
"file-word-o",
"file-excel-o",
"file-powerpoint-o",
"file-image-o",
"file-archive-o",
"file-audio-o",
"file-video-o",
"file-code-o",
"vine",
"codepen",
"jsfiddle",
"life-ring",
"circle-o-notch",
"rebel",
"empire",
"git-square",
"git",
"hacker-news",
"tencent-weibo",
"qq",
"weixin",
"paper-plane",
"paper-plane-o",
"history",
"circle-thin",
"header",
"paragraph",
"sliders",
"share-alt",
"share-alt-square",
"bomb",
"futbol-o",
"tty",
"binoculars",
"plug",
"slideshare",
"twitch",
"yelp",
"newspaper-o",
"wifi",
"calculator",
"paypal",
"google-wallet",
"cc-visa",
"cc-mastercard",
"cc-discover",
"cc-amex",
"cc-paypal",
"cc-stripe",
"bell-slash",
"bell-slash-o",
"trash",
"copyright",
"at",
"eyedropper",
"paint-brush",
"birthday-cake",
"area-chart",
"pie-chart",
"line-chart",
"lastfm",
"lastfm-square",
"toggle-off",
"toggle-on",
"bicycle",
"bus",
"ioxhost",
"angellist",
"cc",
"ils",
"meanpath",
"buysellads",
"connectdevelop",
"dashcube",
"forumbee",
"leanpub",
"sellsy",
"shirtsinbulk",
"simplybuilt",
"skyatlas",
"cart-plus",
"cart-arrow-down",
"diamond",
"ship",
"user-secret",
"motorcycle",
"street-view",
"heartbeat",
"venus",
"mars",
"mercury",
"transgender",
"transgender-alt",
"venus-double",
"mars-double",
"venus-mars",
"mars-stroke",
"mars-stroke-v",
"mars-stroke-h",
"neuter",
"genderless",
"facebook-official",
"pinterest-p",
"whatsapp",
"server",
"user-plus",
"user-times",
"bed",
"viacoin",
"train",
"subway",
"medium",
"y-combinator", 
"optin-monster", 
"opencart", 
"expeditedssl", 
"battery-full", 
"battery-three-quarters", 
"battery-half", 
"battery-quarter", 
"battery-empty", 
"mouse-pointer", 
"i-cursor", 
"object-group", 
"object-ungroup", 
"sticky-note", 
"sticky-note-o", 
"cc-jcb", 
"cc-diners-club", 
"clone", 
"balance-scale",
"hourglass-o",
"hourglass-start",
"hourglass-half",
"hourglass-end",
"hourglass",
"hand-rock-o",
"hand-paper-o",
"hand-scissors-o",
"hand-lizard-o",
"hand-spock-o",
"hand-pointer-o",
"hand-peace-o",
"trademark",
"registered",
"creative-commons",
"gg",
"gg-circle",
"tripadvisor",
"odnoklassniki",
"odnoklassniki-square",
"get-pocket",
"wikipedia-w",
"safari",
"chrome",
"firefox",
"opera",
"internet-explorer",
"television",
"contao",
"500px",
"amazon",
"calendar-plus-o",
"calendar-minus-o",
"calendar-times-o",
"calendar-check-o",
"industry",
"map-pin",
"map-signs",
"map-o",
"map",
"commenting",
"commenting-o",
"houzz",
"vimeo",
"black-tie",
"fonticons",
"reddit-alien",
"edge",
"credit-card-alt",
"codiepie",
"modx",
"fort-awesome",
"usb",
"product-hunt",
"mixcloud",
"scribd",
"pause-circle",
"pause-circle-o",
"stop-circle",
"stop-circle-o",
"shopping-bag",
"shopping-basket",
"hashtag",
"bluetooth",
"bluetooth-b",
"percent"
];

var fa_back_array = [
"envelope-o",
"star-o",
"trash-o",
"file-o",
"clock-o",
"play-circle-o",
"picture-o",
"pencil-square-o",
"share-square-o",
"check-square-o",
"times-circle-o",
"check-circle-o",
"bar-chart-o",
"heart-o",
"lemon-o",
"square-o",
"bookmark-o",
"hdd-o",
"files-o",
"floppy-o",
"comment-o",
"comments-o",
"lightbulb-o",
"bell-o",
"file-text-o",
"building-o",
"hospital-o",
"circle-o",
"folder-o",
"folder-open-o",
"smile-o",
"frown-o",
"meh-o",
"keyboard-o",
"flag-o",
"star-half-o",
"calendar-o",
"minus-square-o",
"sun-o",
"moon-o",
"dot-circle-o",
"plus-square-o",
"file-pdf-o",
"file-word-o",
"file-excel-o",
"file-powerpoint-o",
"file-photo-o",
"file-picture-o",
"file-image-o",
"file-zip-o",
"file-archive-o",
"file-sound-o",
"file-audio-o",
"file-movie-o",
"file-video-o",
"file-code-o",
"send-o",
"paper-plane-o",
"soccer-ball-o",
"futbol-o",
"newspaper-o",
"bell-slash-o",
];