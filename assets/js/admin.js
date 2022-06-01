(function ($) {
    $(document).ready(function () {

    });

})(jQuery);

var invoice_auto_select_clicked = 0;

function invoice_auto_select_hide() {
    var x = document.getElementsByClassName("auto-select");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
}

function invoice_auto_select_input(obj) {
    invoice_auto_select_clicked = 1;
    invoice_auto_select_hide();
    jQuery("#" + obj.attr("target-id") + "_box_auto .auto-select").css('display', 'block');
}

function invoice_modal_form_click() {
    if (invoice_auto_select_clicked == 0) {
        invoice_auto_select_hide();
    }
    invoice_auto_select_clicked = 0;
}

function invoice_auto_select_item(obj) {


    jQuery("#" + obj.attr("target-id") + "_box_auto" + " #" + obj.attr("target-id")).val(obj.attr("value"));

    jQuery("#" + obj.attr("target-id") + "_box_auto" + " #" + obj.attr("target-id") + "_auto_complete").val(obj.attr("title"));
    invoice_auto_select_hide();
}

function invoice_auto_select_item_key_down(obj) {
    console.log(obj.val());
    admin_woo_base_ajax({
        'action': 'admin_woo_model_select_auto',
        'table': obj.attr('model-table'),
        'where': obj.attr('model-where'),
        'label': obj.attr('model-label'),
        'name': obj.attr('target-id'),
        'value': obj.val()
    }, function (result) {
        console.log(result);
        jQuery("#" + obj.attr("target-id") + "_box_auto .auto-select").html(result.html);
    });
}