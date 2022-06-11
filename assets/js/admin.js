var selected_input_product = 0;
jQuery(document).ready(function () {
    console.log('ready');
    
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