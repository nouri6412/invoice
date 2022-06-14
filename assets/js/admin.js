var selected_input_product = 0;
jQuery(document).ready(function () {

    jQuery(window).keydown(function (event) {
        if (event.keyCode == 13) {

            if (jQuery(event.target).attr('id') == 'acf-field_62a81b5b2f159') {
                event.preventDefault();
                return false;
            }

        }
    });

    const numberFormatter = Intl.NumberFormat('en-US');
  //  jQuery('.table-kala .acf-input table tr td:last-child').css('display', 'none');
   // jQuery('.table-kala .acf-input table tr th:last-child').css('display', 'none');


    function selected_contact_invoic(obj, is_title = 0) {
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
                html += 'شماره اقتصادی' + ' : ' + result.data.ech_number;
                html += '</div>';

                html += '<div style="padding:2px">';
                html += 'شماره ثبت / شناسه ملی' + ' : ' + result.data.nash_code;
                html += '</div>';

                html += '<div style="padding:2px">';
                html += 'کدپستی' + ' : ' + result.data.postal_code;
                html += '</div>';

                html += '<div style="padding:2px">';
                html += 'تلفن' + ' : ' + result.data.tel;
                html += '</div>';


                html += '<div style="padding:2px">';
                html += 'آدرس' + ' : ' + result.data.address;
                html += '</div>';

                html += '</div>';

                if (is_title == 1) {
                    jQuery('#title').val(result.data.title);
                    jQuery('#title-prompt-text').addClass('screen-reader-text');

                }

                obj.parent().append(html);
            }
        });
    }

    function cal_td_inputs_invoice(obj = 0, is_sum = 1) {

        if (obj != 0) {
            var count = obj.children().eq(1).children().eq(0).children().eq(0).children().eq(0).val();

            var price = obj.children().eq(2).children().eq(0).children().eq(0).children().eq(0).val();
            obj.children().eq(3).children().eq(0).children().eq(0).children().eq(0).val(count * price);
            var sum_price = count * price;
            var discount = obj.children().eq(4).children().eq(0).children().eq(0).children().eq(0).val();
            obj.children().eq(5).children().eq(0).children().eq(0).children().eq(0).val(sum_price - discount);
            var sum = sum_price - discount;
            var tax_persent = jQuery('#acf-field_62a4145ea2194').val();
            var sum_tax = (sum * tax_persent) / 100;
            var sum_tax = Math.round(sum_tax);
            obj.children().eq(6).children().eq(0).children().eq(0).children().eq(0).val(sum_tax);
            var sum_1 = sum + sum_tax;
            obj.children().eq(7).children().eq(0).children().eq(0).children().eq(0).val(sum_1);
        }


        if (jQuery('#sum-tr-invoice')) {
            jQuery('#sum-tr-invoice').remove();
        }

        var td3 = jQuery('.acf-input .acf-table tr td:nth-child(4) .acf-input .acf-input-wrap input');

        var i = 0;
        var sum_td = 0;
        for (i = 0; i < td3.length; i++) {
            if (Number.isInteger(parseInt(jQuery(td3[i]).val()))) {
                sum_td += parseInt(jQuery(td3[i]).val());
            }
        }

        td3 = jQuery('.acf-input .acf-table tr td:nth-child(5) .acf-input .acf-input-wrap input');


        var sum_td_5 = 0;
        for (i = 0; i < td3.length; i++) {
            if (Number.isInteger(parseInt(jQuery(td3[i]).val()))) {
                sum_td_5 += parseInt(jQuery(td3[i]).val());
            }
        }

        td3 = jQuery('.acf-input .acf-table tr td:nth-child(6) .acf-input .acf-input-wrap input');


        var sum_td_6 = 0;
        for (i = 0; i < td3.length; i++) {
            if (Number.isInteger(parseInt(jQuery(td3[i]).val()))) {
                sum_td_6 += parseInt(jQuery(td3[i]).val());
            }
        }


        td3 = jQuery('.acf-input .acf-table tr td:nth-child(7) .acf-input .acf-input-wrap input');


        var sum_td_7 = 0;
        for (i = 0; i < td3.length; i++) {
            if (Number.isInteger(parseInt(jQuery(td3[i]).val()))) {
                sum_td_7 += parseInt(jQuery(td3[i]).val());
            }
        }

        td3 = jQuery('.acf-input .acf-table tr td:nth-child(8) .acf-input .acf-input-wrap input');


        var sum_td_8 = 0;
        for (i = 0; i < td3.length; i++) {
            if (Number.isInteger(parseInt(jQuery(td3[i]).val()))) {
                sum_td_8 += parseInt(jQuery(td3[i]).val());
            }
        }



        var html = '<tr id="sum-tr-invoice">';

        html += '<td>';
        html += 'جمع';
        html += '</td>';
        html += '<td>';
        html += '<div>';
        html += '<table class="acf-table acf-table-sum">';

        html += '<tr>';

        html += '<td>';
        html += '</td>';

        html += '<td>';
        html += '</td>';

        html += '<td>';
        html += '</td>';

        html += '<td>' + 'مبلغ کل';
        html += '</td>';

        html += '<td>' + 'مبلغ تخفیف';
        html += '</td>';

        html += '<td>' + 'مبلغ کل پس از تخفیف';
        html += '</td>';

        html += '<td>' + 'جمع مالیات و عوارض';
        html += '</td>';

        html += '<td>' + 'جمع مبلغ کل به علاوه مالیات و عوارض';
        html += '</td>';

        html += '<td>';
        html += '</td>';

        html += '</tr>';



        html += '<tr>';

        html += '<td>';
        html += '</td>';

        html += '<td>';
        html += '</td>';

        html += '<td>';
        html += '</td>';

        html += '<td>' + numberFormatter.format(sum_td);
        html += '</td>';

        html += '<td>' + numberFormatter.format(sum_td_5);
        html += '</td>';

        html += '<td>' + numberFormatter.format(sum_td_6);
        html += '</td>';

        html += '<td>' + numberFormatter.format(sum_td_7);
        html += '</td>';

        html += '<td>' + numberFormatter.format(sum_td_8);
        html += '</td>';

        html += '<td>';
        html += '</td>';

        html += '</tr>';
        html += '</table>';
        html += '</div>';
        html += '</td>';
        html += '</tr>';



        jQuery('.acf-repeater>table>tbody').append(html);
    }

    cal_td_inputs_invoice(0);

    jQuery(document).on('change', '#acf-field_62a413c2a2191', function () {
        var obj = jQuery(this);
        selected_contact_invoic(obj, 0);
    });

    jQuery(document).on('change', '#acf-field_62a413fba2192', function () {
        var obj = jQuery(this);
        selected_contact_invoic(obj, 1);
    });

    jQuery(document).on('click', '.item-price', function () {
        var obj = jQuery(this);

        var price = obj.attr('data-price');
        var title = obj.attr('data-title');
        var id = obj.attr('data-id');
       var row= jQuery('.table-kala .acf-clone .acf-row').eq(0);
       console.log(row.attr('class'));
       row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).val(title);
       row.children('td').eq(2).children().eq(0).children().eq(0).children().eq(0).val(price);
       row.children('td').eq(8).children().eq(0).children().eq(0).children().eq(0).val(id);
        obj.parent().remove();
        jQuery('.acf-button').click();
    });
    var timeout_search_invoice = 0;
    jQuery(document).on('keyup', '#acf-field_62a81b5b2f159', function () {
        if (jQuery(this)) {
            timeout_search_invoice++;
            var timeout_search_invoice_count = timeout_search_invoice;
            setTimeout(() => {
                if (timeout_search_invoice_count != timeout_search_invoice) {
                    console.log(timeout_search_invoice_count + ' ' + timeout_search_invoice);
                    return;
                }
                selected_input_product = 1;
                var search_word = jQuery(this).val();
                var obj = jQuery(this);
                obj.parent().children('.list-price').remove();
                console.log(obj.val());
                jQuery.ajax({
                    url: admin_woo_object.ajaxurl,
                    data: {
                        action: 'admin_woo_search_product',
                        s: search_word
                    },
                    dataType: 'json',
                    type: 'POST',
                    success: function (result) {

                        if (result.is_sku == 1) {

                        }
                        else {
                            var i = 0;
                            var html = '<div class="list-price">';
                            for (i = 0; i < result.data.length; i++) {
                                html += '<div data-id="' + result.data[i].id + '" data-price="' + result.data[i].price + '" data-title="' + result.data[i].title + '" class="item-price">';
                                html += '<div class="item-price-img"><img src="' + result.data[i].img + '"/></div>';
                                html += '<div class="item-price-title">' + result.data[i].title + '</div>';
                                html += '<div class="item-price-price">' + numberFormatter.format(result.data[i].price) + '</div>';
                                html += '</div>';
                            }
                            html += '</div>';
                            obj.parent().append(html);
                        }

                    }
                });
            }, 500);

        } else {
            selected_input_product = 0;
        }

    });

    jQuery(".acf-table").on('change', 'input', function () {

        if (jQuery(this)) {
            var obj = jQuery(this);
            var index = obj.parent().parent().parent().index();
            console.log(index);
            if (index == 1 || index == 2 || index == 4) {
                cal_td_inputs_invoice(obj.parent().parent().parent().parent());
            }

        } else {
            selected_input_product = 0;
        }

    });
   

});