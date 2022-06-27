<?php
add_filter('manage_invoice-contact_posts_columns', 'smashing_filter_posts_invoice_contact_columns');
function smashing_filter_posts_invoice_contact_columns($columns)
{

    $cols = [];
    foreach ($columns as $key => $col) {
        if ($key == "date") {
            $cols['status'] = 'وضعیت';
            $cols['rate'] = 'درجه';
            $cols['pre-invoice'] = ' پیش فاکتورها';
            $cols['main-invoice'] = '  فاکتورها';
        }
        $cols[$key] = $col;
    }

    return $cols;
}


add_action('manage_invoice-contact_posts_custom_column', function ($column_key, $post_id) {
    if ($column_key == 'status') {
        $status = get_field('status', $post_id);
        echo $status;
    }
    if ($column_key == 'rate') {
        $rate = get_post_meta($post_id, 'rate', true);
        echo $rate;
    }
    if ($column_key == 'pre-invoice') {
        echo '<a target="_blank" href="'.admin_url().'edit.php?post_type=invoice-form&contact_id='.$post_id.'">نمایش</a>';

    }
    if ($column_key == 'main-invoice') {
        echo '<a target="_blank" href="'.admin_url().'edit.php?post_type=invoice-form-main&contact_id='.$post_id.'">نمایش</a>';

    }
}, 10, 2);
