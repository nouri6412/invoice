<?php
add_filter('manage_invoice-contact_posts_columns', 'smashing_filter_posts_invoice_contact_columns');
function smashing_filter_posts_invoice_contact_columns($columns)
{

    $cols = [];
    foreach ($columns as $key => $col) {
        if ($key == "date") {
            $cols['status'] = 'وضعیت';
            $cols['rate'] = 'درجه';
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
}, 10, 2);
