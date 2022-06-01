<?php
class Admin_Woo_Invoice_Entity extends Admin_Woo_Invoice_Base_Class
{
    var $model = [];
    var $model_name = "";
    var $opt = 'list';
    var $title_page = '';

    public function __construct($type, $op = 'list')
    {
        $this->model_name = $type;
        $this->opt = $op;
    }
    
    public function render()
    {
        global $wpdb, $ViewData;
        $this->model = $this->model_obj->model_obj;

        $this->post();

        if ($this->opt == "list") {
            $this->view('model/list');
        } elseif ($this->opt == "create") {
            $this->view('model/form');
        }
    }

    public function post()
    {
        if (isset($_POST["submit_model"])) {
            $Admin_Woo_Invoice_Ajax_Form = new Admin_Woo_Invoice_Ajax_Form;
            $Admin_Woo_Invoice_Ajax_Form->submit($this->model);
        }
    }
}
