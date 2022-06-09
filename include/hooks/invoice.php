<?php
class Admin_Woo_Invoice_Hook_Invoice extends Admin_Woo_Invoice_Base_Class
{
    public function __construct()
    {
    }

    function form()
    {
        global $wpdb;

        $this->view("invoice/form");
    }
}
$Admin_Woo_Invoice_Hook_Invoice = new Admin_Woo_Invoice_Hook_Invoice;
add_action('before_invoice_field_form_', array($Admin_Woo_Invoice_Hook_Invoice, 'form'), 10, 1);