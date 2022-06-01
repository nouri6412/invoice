function admin_woo_base_ajax(data, callback) {
    console.log(admin_woo_object);
    data["page"]=admin_woo_object.page;
    console.log(data);
    jQuery.ajax({
        url: admin_woo_object.ajaxurl,
        data: data,
        dataType: 'json',
        type: 'POST',
        success: callback,
        beforeSend: function () {
            jQuery('.loading-ajax').show();
        },
        complete: function () {
            jQuery('.loading-ajax').hide();
        }
    });
}


function admin_woo_model_insert() {
    admin_woo_base_ajax({
        'action': 'admin_woo_model_insert',
        'test': 'hello test ajax'
    }, function (result) {
       // console.log(result);
    });
}