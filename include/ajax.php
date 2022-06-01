<?php
class Admin_Woo_Invoice_Ajax
{
    function model_insert()
    {
        $output = 'ok';

        echo json_encode([
            'success'       => true,
            'html'          => $output,
            'max_num_pages' => 1
        ]);
        die();
    }

    function select_auto()
    {
        global $wpdb;

        $table = "";
        $where = "";
        $value = "";
        $label = "";
        $name = "";

        if (isset($_POST["value"])) {
            $value = sanitize_text_field($_POST["value"]);
        }

        if (isset($_POST["table"])) {
            $table = sanitize_text_field($_POST["table"]);
        }

        if (isset($_POST["where"])) {
            $where = sanitize_text_field($_POST["where"]);
        }

        if (isset($_POST["label"])) {
            $label = sanitize_text_field($_POST["label"]);
        }

        if (isset($_POST["name"])) {
            $name = sanitize_text_field($_POST["name"]);
        }


        $where = $where . " and " . $label . " like '%" . esc_sql($value) . "%' ";
        
       $sql="select * from $table where 1=1 " . $where . " limit 100 ";

        $query_string       = $wpdb->prepare($sql, array());
        $items       = $wpdb->get_results($query_string, ARRAY_A);

        $ret = '';

        foreach ($items  as $item) {
            $ret .= sprintf('<div target-id="%s" onclick="invoice_auto_select_item(jQuery(this));" class="auto-select-item"  value="%s" title="%s">%s</div>', $name, $item["id"], $item[$label],  $item[$label]);
        }

        if(count($items)==0)
        {
            $ret .= sprintf('<div  class="auto-select-item"  value="%s" title="%s">%s</div>',  0, 'موردی یافت نشد','موردی یافت نشد');

        }

        echo json_encode([
            'success'       => true,
            'html'          => $ret,
            'sql'          => '',
            'max_num_pages' => 1
        ]);
        die();
    }
}
$Admin_Woo_Invoice_Ajax = new Admin_Woo_Invoice_Ajax;
//add_action( 'wp_ajax_nopriv_ajax_submit_like', 'submit' );
add_action('wp_ajax_admin_woo_model_insert', array($Admin_Woo_Invoice_Ajax, 'model_insert'));
add_action('wp_ajax_admin_woo_model_select_auto', array($Admin_Woo_Invoice_Ajax, 'select_auto'));

foreach (glob(ADMIN_WOO_INVOICE_Include . "ajax/*.php") as $filename) {
    require $filename;
}
