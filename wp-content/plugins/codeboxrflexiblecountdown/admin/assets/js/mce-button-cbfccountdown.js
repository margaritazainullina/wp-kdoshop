
(function() {
	tinymce.PluginManager.add('cbfccountdown', function( cbfc_editor, url ) {
        var sh_tag = 'cbfccountdown';
		//helper functions 
		function getAttr(s, cbfc_n) {
			cbfc_n = new RegExp( ' ' + cbfc_n + '=\"([^\"]+)\"', 'g').exec(s);
			return cbfc_n ?  window.decodeURIComponent(cbfc_n[1]) : '';
		};

		function html( cls, data ,con) {
			//var placeholder = url + '/img/' + getAttr(data,'type') + '.jpg';
			var placeholder = url + '/img/cbfccountdown.png';
			var data = window.encodeURIComponent( data );
			var content = window.encodeURIComponent( con );
			return '<img src="' + placeholder + '" class="mceItem ' + cls + '" ' + 'data-sh-attr="' + data + '" data-sh-content="'+ con+'" data-sh-shorttag="'+sh_tag+'" data-mce-resize="false" data-mce-placeholder="1" />';
		}

		function replaceShortcodes( content ) {
			return content.replace( /\[cbfccountdown([^\]]*)\]([^\]]*)\[\/cbfccountdown\]/g, function( all,attr,con) {
				return html( 'wp-cbfccountdown', attr , con);
			});

		}

		function restoreShortcodes( content ) {
			return content.replace( /(?:<p(?: [^>]+)?>)*(<img [^>]+>)(?:<\/p>)*/g, function( match, image ) {
				var data        = getAttr( image, 'data-sh-attr' );
				var con         = getAttr( image, 'data-sh-content' );
                var shorttag    = getAttr(image, 'data-sh-shorttag');

				if ( data && sh_tag ==  shorttag) {
					return '<p>[' + sh_tag + data + ']' + con + '[/'+sh_tag+']</p>';
				}
				return match;
			});
		}

		//add popup
		cbfc_editor.addCommand('cbfccountdown_popup', function(ui, v) {
			//setup defaults
            var type = 'light',
                date = hour = minute = numclr = resnumclr = numbgclr = secbclr = minbclr = hourbclr = daysbclr = bgclr = fontclr = textclr = restextclr = textbgclr = kkfsize = kkfclr = kktextclr = null;
            if ( v.type != null ) {
                type = v.type;
            }

            if ( v.date != null ) {
                date = v.date;
            }

            if ( v.hour != null ) {
                hour = v.hour;
            }

            if ( v.minute != null ) {
                minute = v.minute;
            }

            /*if ( v.numclr != null ) {
                numclr = v.numclr;
            }

            if ( v.resnumclr != null ) {
                resnumclr = v.resnumclr;
            }

            if ( v.numbgclr != null ) {
                numbgclr = v.numbgclr;
            }

            if ( v.secbclr != null ) {
                secbclr = v.secbclr;
            }

            if ( v.minbclr != null ) {
                minbclr = v.minbclr;
            }

            if ( v.hourbclr != null ) {
                hourbclr = v.hourbclr;
            }

            if ( v.daysbclr != null ) {
                daysbclr = v.daysbclr;
            }

            if ( v.bgclr != null ) {
                bgclr = v.bgclr;
            }

            if ( v.fontclr != null ) {
                fontclr = v.fontclr;
            }

            if ( v.textclr != null ) {
                textclr = v.textclr;
            }

            if ( v.restextclr != null ) {
                restextclr = v.restextclr;
            }

            if ( v.textbgclr != null ) {
                textbgclr = v.textbgclr;
            }

            if ( v.kkfsize != null ) {
                kkfsize = v.kkfsize;
            }

            if ( v.kkfclr != null ) {
                kkfclr = v.kkfclr;
            }

            if ( v.kktextclr != null ) {
                kktextclr = v.kktextclr;
            }*/

            /*
			var header = '';
			if (v.header)
				header = v.header;
			var footer = '';
			if (v.footer)
				footer = v.footer;


			var content = '';
			if (v.content)
				content = v.content;
            */

			cbfc_editor.windowManager.open( {


				title: cbfc_editor.getLang( 'cbfccountdown.title' ),
				body: [
                    {
                        type:   'listbox',
                        name:   'type',
                        label:  cbfc_editor.getLang( 'cbfccountdown.type_label' ),
                        value:  type,
                        'values': [
                            {text: 'Light', value: 'light'},
                            {text: 'Circular', value: 'circular'},
                            {text: 'KK', value: 'kk'}
                        ],
                        tooltip: cbfc_editor.getLang( 'cbfccountdown.type_tooltip' )
                    }, {
						type:       'textbox',
						name:       'date',
						label:      cbfc_editor.getLang( 'cbfccountdown.date_label' ),
						value:      date,
						tooltip:    cbfc_editor.getLang( 'cbfccountdown.date_tooltip' )
					}, {
						type:       'textbox',
						name:       'hour',
						label:      cbfc_editor.getLang( 'cbfccountdown.hour_label' ),
						value:      hour,
						tooltip:    cbfc_editor.getLang( 'cbfccountdown.hour_tooltip' )
					}, {
						type:       'textbox',
						name:       'minute',
						label:      cbfc_editor.getLang( 'cbfccountdown.minute_label' ),
						value:      minute,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.minute_tooltip' )
					}/*, {
						type:       'textbox',
						name:       'numclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.numclr_label' ),
						value:      numclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.numclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'resnumclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.resnumclr_label' ),
						value:      resnumclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.resnumclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'numbgclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.numbgclr_label' ),
						value:      numbgclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.numbgclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'secbclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.secbclr_label' ),
						value:      secbclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.secbclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'minbclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.minbclr_label' ),
						value:      minbclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.minbclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'hourbclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.hourbclr_label' ),
						value:      hourbclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.hourbclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'daysbclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.daysbclr_label' ),
						value:      daysbclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.daysbclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'bgclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.bgclr_label' ),
						value:      bgclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.bgclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'fontclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.fontclr_label' ),
						value:      fontclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.fontclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'textclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.textclr_label' ),
						value:      textclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.textclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'restextclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.restextclr_label' ),
						value:      restextclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.restextclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'textbgclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.textbgclr_label' ),
						value:      textbgclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.textbgclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'kkfsize',
						label:      cbfc_editor.getLang( 'cbfccountdown.kkfsize_label' ),
						value:      kkfsize,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.kkfsize_tooltip' )
					}, {
						type:       'textbox',
						name:       'kkfclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.kkfclr_label' ),
						value:      kkfclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.kkfclr_tooltip' )
					}, {
						type:       'textbox',
						name:       'kktextclr',
						label:      cbfc_editor.getLang( 'cbfccountdown.kktextclr_label' ),
						value:      kktextclr,
                        tooltip:    cbfc_editor.getLang( 'cbfccountdown.kktextclr_tooltip' )
					}*/
				],
                onpostRender: function(e) {

                    var parentIdNum = parseInt( e.target._id.split( "_" )[1] );
                    var dateInputId = ( parentIdNum + 3 );

                    if ( jQuery( '#mceu_' + dateInputId ).length ) {
                        jQuery( '#mceu_' + dateInputId ).datepicker();
                    }

                    /*
                    for ( var i = 6; i <= 20; i++ ) {
                        var inputIdNum = ( parentIdNum + i );
                        if ( jQuery( '#mceu_' +  inputIdNum ).length ) {
                            jQuery( '#mceu_' + inputIdNum ).on( 'focus', function() {
                                var $this = jQuery( this );
                                $this.ColorPicker( {
                                    onSubmit: function(hsb, hex, rgb, el) {
                                        jQuery(el).val( '#' + hex);
                                        jQuery(el).ColorPickerHide();
                                    },

                                    onHide: function (colpkr) {
                                        //$(colpkr).fadeIn(500);
                                        return false;
                                    },

                                    onShow: function (colpkr) {
                                        jQuery( '.colorpicker' ).slideUp( 200 );
                                        jQuery(colpkr).slideDown( 500 );
                                        return false;
                                    },

                                    onBeforeShow: function () {
                                        $this.ColorPickerSetColor( $this.val() );
                                    }
                                } );

                                var widt = false;
                                $this.bind( 'click' , function() {
                                    jQuery( '#' + $this.data('colorpickerId') ).stop().animate({height: widt ? 0 : 173}, 200);
                                    widt = !widt;
                                });
                            } );
                        }
                    }
                    */
                },

				onsubmit: function( e ) {
                    
                    //jQuery( '.colorpicker' ).hide();
					var shortcode_str = '[' + sh_tag + ' type="'+e.data.type+'"';

                    //if set date insert to shortcode
                    if ( typeof e.data.date != null && e.data.date.length )
                        shortcode_str += ' date="' + e.data.date + '"';

                    //if set hour insert to shortcode
                    if ( typeof e.data.hour != null && e.data.hour.length )
                        shortcode_str += ' hour="' + e.data.hour + '"';

                    //if set minute insert to shortcode
                    if ( typeof e.data.minute != null && e.data.minute.length )
                        shortcode_str += ' minute="' + e.data.minute + '"';

                    //if set numclr insert to shortcode
                    /*if ( typeof e.data.numclr != null && e.data.numclr.length )
                        shortcode_str += ' numclr="' + e.data.numclr + '"';

                    //if set numclr insert to shortcode
                    if ( typeof e.data.resnumclr != null && e.data.resnumclr.length )
                        shortcode_str += ' resnumclr="' + e.data.resnumclr + '"';

                    //if set numclr insert to shortcode
                    if ( typeof e.data.numbgclr != null && e.data.numbgclr.length )
                        shortcode_str += ' numbgclr="' + e.data.numbgclr + '"';

                    //if set secbclr insert to shortcode
                    if ( typeof e.data.secbclr != null && e.data.secbclr.length )
                        shortcode_str += ' secbclr="' + e.data.secbclr + '"';

                    //if set minbclr insert to shortcode
                    if ( typeof e.data.minbclr != null && e.data.minbclr.length )
                        shortcode_str += ' minbclr="' + e.data.minbclr + '"';

                    //if set hourbclr insert to shortcode
                    if ( typeof e.data.hourbclr != null && e.data.hourbclr.length )
                        shortcode_str += ' hourbclr="' + e.data.hourbclr + '"';

                    //if set daysbclr insert to shortcode
                    if ( typeof e.data.daysbclr != null && e.data.daysbclr.length )
                        shortcode_str += ' daysbclr="' + e.data.daysbclr + '"';

                    //if set bgclr insert to shortcode
                    if ( typeof e.data.bgclr != null && e.data.bgclr.length )
                        shortcode_str += ' bgclr="' + e.data.bgclr + '"';

                    //if set fontclr insert to shortcode
                    if ( typeof e.data.fontclr != null && e.data.fontclr.length )
                        shortcode_str += ' fontclr="' + e.data.fontclr + '"';

                    //if set textclr insert to shortcode
                    if ( typeof e.data.textclr != null && e.data.textclr.length )
                        shortcode_str += ' textclr="' + e.data.textclr + '"';

                    //if set textclr insert to shortcode
                    if ( typeof e.data.restextclr != null && e.data.restextclr.length )
                        shortcode_str += ' restextclr="' + e.data.restextclr + '"';

                    //if set textclr insert to shortcode
                    if ( typeof e.data.textbgclr != null && e.data.textbgclr.length )
                        shortcode_str += ' textbgclr="' + e.data.textbgclr + '"';

                    //if set kkfsize insert to shortcode
                    if ( typeof e.data.kkfsize != null && e.data.kkfsize.length )
                        shortcode_str += ' kkfsize="' + e.data.kkfsize + '"';

                    //if set kkfclr insert to shortcode
                    if ( typeof e.data.kkfclr != null && e.data.kkfclr.length )
                        shortcode_str += ' kkfclr="' + e.data.kkfclr + '"';

                    //if set kktextclr insert to shortcode
                    if ( typeof e.data.kktextclr != null && e.data.kktextclr.length )
                        shortcode_str += ' kktextclr="' + e.data.kktextclr + '"';*/

					shortcode_str += '][/' + sh_tag + ']';
					//insert shortcode to tinymce
					cbfc_editor.insertContent( shortcode_str);
				},

                onClose: function(w) {
                    //jQuery( '.colorpicker' ).hide();
                }
                //autoScroll: true,
                //width:500,
                //height:500,
                //'scroll-y':'scroll'



			});
        });

		//add button
		cbfc_editor.addButton('cbfccountdown', {
			icon: 'cbfccountdown',
			tooltip: 'CBX Countdown Shortcode',
			onclick: function() {
				cbfc_editor.execCommand('cbfccountdown_popup','',{
					type:       'light',
                    date:       null,
                    hour:       null,
                    minute:     null/*,
                    numclr:     null,
                    resnumclr:     null,
                    numbgclr:     null,
                    secbclr:    null,
                    minbclr:    null,
                    hourbclr:   null,
                    daysbclr:   null,
                    bgclr:      null,
                    fontclr:    null,
                    textclr:    null,
                    restextclr:    null,
                    textbgclr:    null,
                    kkfsize:    null,
                    kkfclr:     null,
                    kktextclr:  null*/
				});
			}
		});

		//replace from shortcode to an image placeholder
		cbfc_editor.on('BeforeSetcontent', function(event) {
			event.content = replaceShortcodes( event.content );
		});

		//replace from image placeholder to shortcode
		cbfc_editor.on('GetContent', function(cbfc_event){
            cbfc_event.content = restoreShortcodes(cbfc_event.content);
		});

		//open popup on placeholder double click
		cbfc_editor.on('DblClick',function(e) {
			var cls  = e.target.className.indexOf('wp-cbfccountdown');
			if ( e.target.nodeName == 'IMG' && e.target.className.indexOf('wp-cbfccountdown') > -1 ) {
				var title = e.target.attributes['data-sh-attr'].value;
				    title = window.decodeURIComponent(title);

				var content = e.target.attributes['data-sh-content'].value;
				cbfc_editor.execCommand('cbfccountdown_popup','',{
                    // format [ key: getAttr(title, 'key') ]
					//type: getAttr( title, 'type' )
					type:       getAttr( title, 'type' ),
					date:       getAttr( title, 'date' ),
					hour:       getAttr( title, 'hour' ),
                    minute:     getAttr( title, 'minute' )/*,
                    numclr:     getAttr( title, 'numclr' ),
                    resnumclr:     getAttr( title, 'resnumclr' ),
                    numbgclr:     getAttr( title, 'numbgclr' ),
                    secbclr:    getAttr( title, 'secbclr' ),
                    minbclr:    getAttr( title, 'minbclr' ),
                    hourbclr:   getAttr( title, 'hourbclr' ),
                    daysbclr:   getAttr( title, 'daysbclr' ),
                    bgclr:      getAttr( title, 'bgclr' ),
                    fontclr:    getAttr( title, 'fontclr' ),
                    textclr:    getAttr( title, 'textclr' ),
                    restextclr:    getAttr( title, 'restextclr' ),
                    textbgclr:    getAttr( title, 'textbgclr' ),
                    kkfsize:    getAttr( title, 'kkfsize' ),
                    kkfclr:     getAttr( title, 'kkfclr' ),
                    kktextclr:  getAttr( title, 'kktextclr' )*/
				});
			}
		});
	});
})();