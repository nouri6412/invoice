var selected_input_product = 0;
jQuery(document).ready(function () {
    jQuery("td .acf-input").on('change', 'select', function () {
        if (jQuery(this) && selected_input_product == 0) {
            selected_input_product = 1;
            var product_id = jQuery(this).val();

            jQuery.ajax({
                url: admin_woo_object.ajaxurl,
                data: {
                    action: 'admin_woo_request_price',
                    product_id: product_id
                },
                dataType: 'json',
                type: 'POST',
                success: function (result) {
                    console.log(result);
                    //  jQuery(this).parent().parent().next().next().children().eq(0).children().eq(0).children().eq(0).val(5200);
                }
            });
        } else {
            selected_input_product = 0;
        }

    });
});