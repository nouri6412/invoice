<div class="loading-ajax">
    <img src="<?php echo  esc_attr(ADMIN_WOO_INVOICE_URI); ?>assets/img/loader.gif" />
</div>
<div onclick="invoice_modal_form_click();" class="modal fade invoice-model-form invoice-main" id="invoice-model-form" tabindex="-1"  aria-labelledby="invoice-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 id="invoice-modal-title" class="modal-title"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">بستن</button>
                </div>

            </div>
        </div>
    </div>
</div>