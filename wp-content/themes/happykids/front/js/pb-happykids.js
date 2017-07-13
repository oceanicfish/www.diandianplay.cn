		var preprocessContent = function (cont) {
			var first8chars = cont.substring(0, 8);
			var pCurrOffset = 0;
			var sc2look = ['one_half', 'one_third', 'one_fourth', 'one_fifth', 'two_thirds', 'three_fourth',
					'four_fifth'];
			var cols2config = ['2', '312', '413', '413', '321', '431', '431'];
			var colspans = ['6','4','3','3','8','9','9'];

			var sc2look_last = ['one_half_last', 'one_third_last', 'one_fourth_last', 'one_fifth_last', 'two_thirds_last', 'three_fourth_last',
					'four_fifth_last',];
			var dummy_col = { col: { 0: { name: -1, start: 0, end: 0 } } };
			//var row;// = {0: { col: { 0: { name: -1, start: 0, end: 0 } } } };
			var ri = -1, col_i=0;
			var row = {0: { }};
			var bInsideColumns = false;
			// here we need to fucking de-wpautop content, otherwise it would be a suicide to parse it
			cont = cont.replace(/<p>(\[(?:\/|).*?])(<\/p>|<br \/>\s(.*)<\/p>)/gm, "$1$3");
			cont = cont.replace(/(\[(?:\/|)[a-zA-z0-9_]+?\])(<\/p>|<br \/>\s)/g, "$2$1");
			var ret = cont;
			var last_col = false; // we need this flag to mark the last column closing bracket
			// to determine real start of one-column row, because inside there could be another shortcodes
			if (cont.length && '[cws-row' !== first8chars) {
				// now we check for certain shortcodes
				var pNextSc;
				var pEndBlock = 0;
				while (pCurrOffset < cont.length) {
					var pStartSC = cont.indexOf('[', pCurrOffset);
					if (-1 === pStartSC) {
						ri++;
						row[ri] = clone(dummy_col);
						row[ri].col[col_i].end = cont.length;
						break;
					}

					pCurrOffset = cont.indexOf(']', pStartSC+1);
					var shortcode_name = cont.substring(pStartSC+1, pCurrOffset).split(/\s+/)[0];
					pNextSc = sc2look.indexOf(shortcode_name);
					if (-1 !== pNextSc) {
						if (!bInsideColumns) {
							// we should finish this one
							// part before first sc should be treated as one row one column
							var a = pStartSC-1 - pEndBlock;
							if (a > 0) {
								ri++;
								row[ri] = clone(dummy_col);
								row[ri].col[col_i].end = pStartSC-1;
							}
							ri++;
							col_i = 0;
							row[ri] = clone(dummy_col);
							//row[ri].col[col_i].end =
						}
						bInsideColumns = true;
						pEndBlock = cont.indexOf('[/' + shortcode_name, pCurrOffset+1);

						row[ri].col[col_i] = {name: pNextSc, start: pCurrOffset+1, end: pEndBlock };
						col_i++;
					} else {
						pNextSc = sc2look_last.indexOf(shortcode_name);
						if (-1 !== pNextSc) {
							pEndBlock = cont.indexOf('[/' + shortcode_name, pCurrOffset+1);
							row[ri].col[col_i] = {name: pNextSc, start: pCurrOffset+1, end: pEndBlock };
							bInsideColumns = false;
							col_i = 0;
							last_col = true;
						} else {
							// unknown shortcode
							// !!! need to test
							pEndBlock = pCurrOffset+1;
						}
					}
					pCurrOffset = cont.indexOf(']', pEndBlock+1) + 1;
					pEndBlock = pCurrOffset; // save it for later use
					if (!bInsideColumns && !col_i && last_col) {
						// prepare for probable next row
						dummy_col.col[0].start = pCurrOffset;
					}
					last_col = false;
				}

				// now we should process row object and build a new compatible post
				var i;
				var out = '';
				var rowcols;
				for (var cols in row) {
					i = 0;
					switch ( Object.keys(row[cols]['col']).length ) {
						case 5:
						case 4:
							out  += '[cws-row cols=4]';
							break;
						case 3:
							var t3col1 = row[cols]['col']['0'].name;
							var t3col2 = row[cols]['col']['1'].name;
							if (t3col1 == 2 && t3col2 == 2) {
								// 1/4 + 1/4
								rowcols = '4112';
							} else if (t3col1 == 2 && t3col2 == 0) {
								// 1/4 + 2/4
								rowcols = '4121';
							} else if (t3col1 == 0 && t3col2 == 2) {
								// 2/4 + 1/4
								rowcols = '4211';
							} else {
								// 1/3 + 1/3 + 1/3
								rowcols = '3';
							}
							out  += '[cws-row cols=' + rowcols + ']';
							break;
						case 2:
							rowcols = cols2config[ row[cols]['col']['0'].name ];
							out  += '[cws-row cols=' + rowcols + ']';
							break;
						case 1:
							out += '[cws-row cols=1]';
							break;
					}
					var last_col = Object.keys(row[cols]['col']).length - 1;
					for (var col in row[cols]['col']) {
						var col_name = row[cols]['col'][col].name;
						var span;
						if (col_name != -1 ) {
							span = colspans[ col_name ];
						} else {
							span = '12';
						}
						if (col <= 3) {
							out += '[col span='+ span +']';
						}
						out += '[cws-widget type=text title=""]';
						out += cont.substring(row[cols]['col'][col].start, row[cols]['col'][col].end);
						out += '[/cws-widget]';
						if (col < 3 || parseInt(col) === last_col) {
							// since we drop the rest here, we should close it only after the last widget
							out += '[/col]';
						}
					}
					out += '[/cws-row]';
				}
				ret = out;
			}
			return ret;
		}