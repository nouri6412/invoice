<?php
class Admin_Woo_Invoice_Shared extends Admin_Woo_Invoice_Base_Class
{
    public function footer()
    {
        $this->view('shared/footer');
    }
    public function header()
    {
        $this->view('shared/header');
    }
}

$Admin_Woo_Invoice_Shared = new Admin_Woo_Invoice_Shared;
add_action('admin_footer', array($Admin_Woo_Invoice_Shared, 'footer'));
add_action('admin_header', array($Admin_Woo_Invoice_Shared, 'header'));
