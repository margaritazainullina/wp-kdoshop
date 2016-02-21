;(function ($) {

    $(function() {

        //function box_size(ref, classname, classname2  ) {
        function box_size(ref, classname) {
            var element_width = ref.width();

            //if(classname2 == '') classname2 = 'cbfc-circular-countdown-container-320';


            ref.removeClass(classname);
            //ref.removeClass(classname2);
            //ref.find( 'p.cbfc-circular-type-time').removeClass( 'cbfc-circular-txt-clr' );

            if (element_width >= 480) {
                ref.removeClass(classname);
            }
            else if (element_width < 480) {
                ref.addClass(classname);

            }
            /*
            if (element_width >= 320) {
                ref.removeClass(classname2);
            }
            else if (element_width < 320) {
                ref.addClass(classname2);

            }
            */


        }


        if ( $('.countdowns-dashboard').length ) {
            $('.countdowns-dashboard').each( function(index) {
                $this = $( this );

                box_size($this, 'cbfc-light-countdowns-480');
                $( window).resize(function () {
                    box_size($this, 'cbfc-light-countdowns-480');
                });
                var cbfcDate = $this.data('date').split('/'),
                    cbfcHour = $this.data('hour'),
                    cbfcMinute = $this.data('min');
                $this.countDown({
                    targetDate: {
                        'day':      cbfcDate[1],
                        'month':    cbfcDate[0],
                        'year':     cbfcDate[2],
                        'hour':     cbfcHour,
                        'min':      cbfcMinute,
                        'sec':      0
                    },
                    omitWeeks: true
                });
            } );
        }

        if ( $('.cbfc-kkcountdown').length ) {
            $('.cbfc-kkcountdown').each( function(index) {
                $this = $( this );
                /*var cbfcDate = $this.data('date').split('/'),
                 cbfcHour = $this.data('hour'),
                 cbfcMinute = $this.data('min');*/
                $this.kkcountdown({
                    dayText		: ' ' + kkc.kkc_day + ' ',
                    daysText 	: ' ' + kkc.kkc_days + ' ',
                    hoursText	: ' ' + kkc.kkc_hr + ' ',
                    minutesText	: ' ' + kkc.kkc_min + ' ',
                    secondsText	: ' ' + kkc.kkc_sec,
                    displayZeroDays : true,
                    rusNumbers  :   false
                });
            } );
        }

        if ( $('.cbfc-circular-countdown').length ) {
            $('.cbfc-circular-countdown').each( function(index) {
                $this = $( this );
                box_size($this, 'sud');
                var cbfcDate = $this.data('date').split('/'),
                    cbfcHour = $this.data('hour'),
                    cbfcMinute = $this.data('min'),
                    cbfcSecBorderClr = $this.data('sec-border-clr'),
                    cbfcMinBorderClr = $this.data('min-border-clr'),
                    cbfcHourBorderClr = $this.data('hour-border-clr'),
                    cbfcDaysBorderClr = $this.data('days-border-clr');


                // Place your public-facing JavaScript here
                $( '#' + $this.attr( 'id' ) ).final_countdown({
                    now: Date.now()/1000,
                    end: new Date(cbfcDate[2], cbfcDate[0]-1, cbfcDate[1], cbfcHour, cbfcMinute, 0).getTime()/1000,
                    selectors: {
                        value_seconds: '.cbfc-circular-clock-seconds .cbfc-circular-val',
                        canvas_seconds: 'cbfc-circular-canvas-seconds' + ( index + 1 ),
                        value_minutes: '.cbfc-circular-clock-minutes .cbfc-circular-val',
                        canvas_minutes: 'cbfc-circular-canvas-minutes' + ( index + 1 ),
                        value_hours: '.cbfc-circular-clock-hours .cbfc-circular-val',
                        canvas_hours: 'cbfc-circular-canvas-hours' + ( index + 1 ),
                        value_days: '.cbfc-circular-clock-days .cbfc-circular-val',
                        canvas_days: 'cbfc-circular-canvas-days' + ( index + 1 )
                    },
                    seconds: {
                        borderColor: cbfcSecBorderClr,
                        borderWidth: '6'
                    },
                    minutes: {
                        borderColor: cbfcMinBorderClr,
                        borderWidth: '6'
                    },
                    hours: {
                        borderColor: cbfcHourBorderClr,
                        borderWidth: '6'
                    },
                    days: {
                        borderColor: cbfcDaysBorderClr,
                        borderWidth: '6'
                    }
                });
            } );
        }
    });
})(jQuery)