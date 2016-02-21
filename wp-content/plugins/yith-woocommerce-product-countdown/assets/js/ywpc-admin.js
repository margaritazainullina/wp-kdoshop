// DATE PICKER FIELDS
jQuery(function ($) {

    $('.ywpc-dates input').datepicker({
        defaultDate    : '',
        dateFormat     : 'yy-mm-dd',
        numberOfMonths : 1,
        showButtonPanel: true,
        onSelect       : function (selectedDate) {
            var option = $(this).is('.ywpc_sale_price_dates_from') ? 'minDate' : 'maxDate';

            var instance = $(this).data('datepicker'),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings),
                value = $(this).val();

            if (option == 'minDate') {
                $('.ywpc_sale_price_dates_to').datepicker('option', option, date);
            } else {
                $('.ywpc_sale_price_dates_from').datepicker('option', option, date);
            }

            if ($(this).is('.ywpc_sale_price_dates_from')) {

                var now_date = new Date,
                    start_date = new Date(value),
                    checkbox = $('#_ywpc_enabled');

                if ((start_date > now_date) && !ywpc.pre_schedule) {
                    checkbox.attr('checked', false).prop('disabled', true);
                } else {
                    checkbox.prop('disabled', false);
                }

            }

            if ($(this).is('#_ywpc_sale_price_dates_from')) {

                $('.ywpc_sale_price_dates_from').val(value);

            } else {

                $('.ywpc_sale_price_dates_to').val(value);

            }

            $('.woocommerce_variation').addClass('variation-needs-update');

        }

    });

    $(document).ready(function () {

        if (!ywpc.pre_schedule) {

            var now_date = new Date,
                start_date = new Date($('#_ywpc_sale_price_dates_from, .ywpc_sale_price_dates_from').val()),
                checkbox = $('#_ywpc_enabled');

            if ((start_date > now_date)) {
                checkbox.attr('checked', false).prop('disabled', true);
            }

        }


    });

});
