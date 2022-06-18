var selected_input_product = 0;
var selected_input_product_scaner = 0;
var searched_product_invoice = '';

function show_invoice_contact_modal() {
    jQuery('#invoice-contact-modal').css('display', 'block');
}
function close_invoice_contact_modal() {
    jQuery('#invoice-contact-modal').css('display', 'none');
}

function save_form_invoice_contact_modal() {
    var title = jQuery('#invoice-contact-title').val();
    var eq_number = jQuery('#invoice-contact-ech-number').val();
    var post_code = jQuery('#invoice-contact-postal-code').val();
    var nah_code = jQuery('#invoice-contact-nash-code').val();
    var tel = jQuery('#invoice-contact-tel').val();
    var address = jQuery('#invoice-contact-address').val();

    if (title.length == 0) {
        alert('عنوان نباید خالی بماند');
        return;
    }

    jQuery.ajax({
        url: admin_woo_object.ajaxurl,
        data: {
            action: 'admin_woo_save_contact',
            form_title: title,
            form_eq_number: eq_number,
            form_post_code: post_code,
            form_nah_code: nah_code,
            form_tel: tel,
            form_address: address
        },
        dataType: 'json',
        type: 'POST',
        success: function (result) {
            if(result.state==1)
            {
                alert('با موفقیت ثبت شد');
                close_invoice_contact_modal();
            }
            else{
                alert('خطا در ثبت اطلاعات');
            }
        }
    });
}

jQuery(document).ready(function () {



    function custom_invoice_init() {
        if (jQuery('#acf-field_62a413fba2192')) {

            var html = '';
            html += '<div class="invoice-box-btn">';
            html += '<a class="invoice-btn" onclick="show_invoice_contact_modal()" href="#">' + 'جدید';
            html += '</a>';
            html += '</div>';
            jQuery('#acf-field_62a413fba2192').parent().parent().append(html);
        }
    }

    custom_invoice_init();

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

        var ex = jQuery('.acf-table td.title-product-list');
        jQuery('.acf-table td.title-product-list .title-label').remove();
        var i = 0;

        for (i = 0; i < ex.length; i++) {
            var title = jQuery(ex[i]).children().eq(0).children().eq(0).children().eq(0).val();
            jQuery(ex[i]).children().eq(0).children().eq(0).children().eq(0).css('display', 'none');
            var label = '<div class="title-label">';
            label += title;
            label += '</div>';
            jQuery(ex[i]).children().eq(0).children().eq(0).append(label);
        }



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

    function item_scaner_invoice($sku = '') {

        var ex = jQuery('.acf-table td');
        var i = 0;
        var el = 0;

        for (i = 0; i < ex.length; i++) {
            if (jQuery(ex[i]).attr("data-name")) {
                if (jQuery(ex[i]).attr("data-name") == 'kala') {
                    if (jQuery(ex[i]).children().eq(0).children().eq(0).children('input').eq(0).attr('data-sku') == $sku) {
                        el = ex[i];
                    }
                }
            }

        }
        if (el == 0) {
            var row = jQuery('.table-kala .acf-clone .acf-row').eq(0);
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).val('');
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).attr('disabled', 'true');
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).attr('data-sku', $sku);
            row.children('td').eq(2).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(8).children().eq(0).children().eq(0).children().eq(0).val(0);
            jQuery('.acf-button').click();
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).val('');
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).attr('data-sku', '');
            row.children('td').eq(1).children().eq(0).children().eq(0).children().eq(0).val('1');
            row.children('td').eq(2).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(3).children().eq(0).children().eq(0).children().eq(0).val('');
            row.children('td').eq(4).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(5).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(6).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(7).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(8).children().eq(0).children().eq(0).children().eq(0).val(0);
        }
        else {
            var count_in = jQuery(el).next().children().eq(0).children().eq(0).children().eq(0);
            count_in.val(parseInt(count_in.val()) + 1);
        }

    }
    function item_price_select_invoice(price, title, id) {

        var ex = jQuery('.acf-table td');
        var i = 0;
        var el = 0;

        for (i = 0; i < ex.length; i++) {
            if (jQuery(ex[i]).attr("data-name")) {
                if (jQuery(ex[i]).attr("data-name") == 'kala') {
                    if (jQuery(ex[i]).children().eq(0).children().eq(0).children('input').eq(0).val() == title) {
                        el = ex[i];
                    }
                }
            }

        }
        if (el == 0) {
            var row = jQuery('.table-kala .acf-clone .acf-row').eq(0);
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).val(title);
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).attr('disabled', 'true');
            row.children('td').eq(2).children().eq(0).children().eq(0).children().eq(0).val(price).trigger('change');
            row.children('td').eq(8).children().eq(0).children().eq(0).children().eq(0).val(id);
            jQuery('.acf-button').click();
            row.children('td').eq(0).children().eq(0).children().eq(0).children().eq(0).val('');
            row.children('td').eq(1).children().eq(0).children().eq(0).children().eq(0).val('1');
            row.children('td').eq(2).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(3).children().eq(0).children().eq(0).children().eq(0).val('');
            row.children('td').eq(4).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(5).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(6).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(7).children().eq(0).children().eq(0).children().eq(0).val(0);
            row.children('td').eq(8).children().eq(0).children().eq(0).children().eq(0).val(0);
        }
        else {
            var count_in = jQuery(el).next().children().eq(0).children().eq(0).children().eq(0);
            count_in.val(parseInt(count_in.val()) + 1);
        }

    }
    jQuery(document).on('click', '.item-price', function () {
        var obj = jQuery(this);
        var price = obj.attr('data-price');
        var title = obj.attr('data-title');
        var id = obj.attr('data-id');
        item_price_select_invoice(price, title, id);
        obj.parent().remove();
    });
    var timeout_search_invoice = 0;
    jQuery(document).on('keyup', '#acf-field_62a81b5b2f159', function () {
        if (jQuery(this)) {
            timeout_search_invoice++;
            var timeout_search_invoice_count = timeout_search_invoice;
            selected_input_product_scaner = 0;
            if (Number.isInteger(parseInt(jQuery(this).val()))) {

                var scaner = parseInt(jQuery(this).val());
                if (jQuery(this).val().length == 7) {
                    console.log('scanner');
                    item_scaner_invoice(scaner);
                    jQuery(this).val('');
                    selected_input_product_scaner = 1;
                }
            }

            if (selected_input_product_scaner == 1) {
                selected_input_product_scaner = 0;
                return;
            }
            setTimeout(() => {
                jQuery(this).parent().css('position', 'relative');
                jQuery(this).parent().append('<img  class="invoice-loader-img" src="' + admin_woo_object.invoice_assets_plugin_url + 'img/loader.gif" />');
                if (timeout_search_invoice_count != timeout_search_invoice) {
                    // console.log(timeout_search_invoice_count + ' ' + timeout_search_invoice);
                    return;
                }
                selected_input_product = 1;
                var search_word = jQuery(this).val();
                var obj = jQuery(this);
                if (searched_product_invoice == search_word) {
                    // return;
                }
                searched_product_invoice = search_word;
                obj.parent().children('.list-price').remove();
                //   console.log(obj.val());
                jQuery.ajax({
                    url: admin_woo_object.ajaxurl,
                    data: {
                        action: 'admin_woo_search_product',
                        s: search_word
                    },
                    dataType: 'json',
                    type: 'POST',
                    success: function (result) {

                        jQuery('.invoice-loader-img').remove();
                        if (result.is_sku == 1) {
                            obj.val('');
                            var price = result.data[0].price;
                            var title = result.data[0].title;
                            var id = result.data[0].id;
                            item_price_select_invoice(price, title, id);
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

    setInterval(function () {

        var ex = jQuery('.acf-table td');
        var i = 0;
        var el = 0;

        for (i = 0; i < ex.length; i++) {

            if (jQuery(ex[i]).attr("data-name")) {
                if (jQuery(ex[i]).attr("data-name") == 'kala') {

                    let rowi = jQuery(ex[i]).parent();

                    var sku = jQuery(ex[i]).children().eq(0).children().eq(0).children('input').eq(0).attr('data-sku');

                    if (sku) {
                        var val = jQuery(ex[i]).children().eq(0).children().eq(0).children('input').eq(0).val();
                        if (sku.length > 0 && val.length == 0) {

                            jQuery.ajax({
                                url: admin_woo_object.ajaxurl,
                                data: {
                                    action: 'admin_woo_search_product',
                                    s: sku
                                },
                                dataType: 'json',
                                type: 'POST',
                                success: function (result) {

                                    if (result.is_sku == 1) {
                                        var price = result.data[0].price;
                                        var title = result.data[0].title;
                                        var id = result.data[0].id;

                                        rowi.children('td').eq(0).children().eq(0).children().eq(0).children('input').eq(0).val(title);
                                        rowi.children('td').eq(2).children().eq(0).children().eq(0).children().eq(0).val(price).trigger('change');
                                        rowi.children('td').eq(8).children().eq(0).children().eq(0).children().eq(0).val(id);
                                    }
                                }
                            });
                        }
                    }

                }
            }

        }
    }, 3000);

    jQuery(".acf-table").on('change', 'input', function () {

        if (jQuery(this)) {
            var obj = jQuery(this);
            var index = obj.parent().parent().parent().index();
            //   console.log(index);
            if (index == 1 || index == 2 || index == 4) {
                if(index==1)
                {
                    if (Number.isInteger(parseInt(obj.val()))) {
                        if(parseInt(obj.val())<1)
                        {
                            obj.val(1);
                        }
                    }
                    else
                    {
                        obj.val(1);
                    }                   
                }
                cal_td_inputs_invoice(obj.parent().parent().parent().parent());
            }

        } else {
            selected_input_product = 0;
        }

    });


});