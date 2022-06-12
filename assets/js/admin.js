var selected_input_product = 0;
jQuery(document).ready(function () {

    function selected_contact_invoic(obj) {
        jQuery.ajax({
            url: admin_woo_object.ajaxurl,
            data: {
                action: 'admin_woo_request_seller',
                seller_id: obj.val()
            },
            dataType: 'json',
            type: 'POST',
            success: function (result) {
                obj.parent().children('.desc-contact').remove();
                var html = '';
                html += '<div class="desc-contact" style="padding:2px">';

                html += '<div style="padding:2px">';
                html += 'شماره اقتصادی'+' : '+result.data.ech_number;
                html += '</div>';

                html += '<div style="padding:2px">';
                html += 'شماره ثبت / شناسه ملی'+' : '+result.data.nash_code;
                html += '</div>';

                html += '<div style="padding:2px">';
                html += 'کدپستی'+' : '+result.data.postal_code;
                html += '</div>';

                html += '<div style="padding:2px">';
                html += 'تلفن'+' : '+result.data.tel;
                html += '</div>';

                
                html += '<div style="padding:2px">';
                html += 'آدرس'+' : '+result.data.address;
                html += '</div>';

                html += '</div>';

                obj.parent().append(html);
            }
        });
    }

    jQuery(document).on('change', '#acf-field_62a413c2a2191', function () {
        var obj = jQuery(this);
        selected_contact_invoic(obj);
    });

    jQuery(document).on('change', '#acf-field_62a413fba2192', function () {
        var obj = jQuery(this);
        selected_contact_invoic(obj);
    });

    jQuery(".acf-table").on('click', '.item-price', function () {
        var obj = jQuery(this);


        obj.parent().parent().children('input').eq(0).val(obj.attr('data-price'));
        obj.parent().parent().parent().parent().next().next().children().eq(0).children().eq(0).children().eq(0).val(obj.attr('data-title'));

        obj.parent().remove();
    });
    jQuery(".acf-table").on('change', 'select', function () {

        if (jQuery(this)) {
            selected_input_product = 1;
            var product_id = jQuery(this).val();
            var obj = jQuery(this);
            console.log(obj.val());
            jQuery.ajax({
                url: admin_woo_object.ajaxurl,
                data: {
                    action: 'admin_woo_request_price',
                    product_id: product_id
                },
                dataType: 'json',
                type: 'POST',
                success: function (result) {
                    obj.parent().parent().next().next().children().eq(0).children().eq(0).children('.list-price').remove();
                    obj.parent().parent().next().next().next().next().children().eq(0).children().eq(0).children().eq(0).val(obj.attr('data-title'));

                    if (result.data.length > 1) {
                        var i = 0;
                        var html = '<div class="list-price">';
                        for (i = 0; i < result.data.length; i++) {
                            html += '<div data-price="' + result.data[i].price + '" data-title="' + result.data[i].title + '" class="item-price">' + result.data[i].title + ' - ' + result.data[i].price + '</div>';
                        }
                        html += '</div>';
                        obj.parent().parent().next().next().children().eq(0).children().eq(0).append(html);
                    }
                    else {
                        obj.parent().parent().next().next().children().eq(0).children().eq(0).children().eq(0).val(result.data[0].price);

                    }
                }
            });
        } else {
            selected_input_product = 0;
        }

    });
});