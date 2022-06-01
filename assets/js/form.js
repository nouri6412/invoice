function admin_woo_model_form(model_name,model_id) {
    admin_woo_base_ajax({
        'action': 'admin_woo_model_form',
        'model_name':model_name,
        'model_id': model_id,
    }, function (result) {
        console.log(result);
        jQuery('.invoice-model-form .modal-body').html(result.html);
        jQuery('.invoice-model-form .modal-header').html(result.title);
    });
}