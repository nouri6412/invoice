<?php
add_action('save_post_invoice-contact', function ($post_ID, $post, $update ) {
    $status = get_field('status', $post_ID);
    $rate = get_field('rate', $post_ID);


    if(strlen($status)==0)
    {
        update_post_meta( $post_ID, 'status', 'فعال' );
    }
    if(strlen($rate)==0)
    {
        update_post_meta( $post_ID, 'rate', 'سرنخ' );
    }

}, 10, 3);
