<?php
add_action('update_postmeta', function ( $meta_id, $object_id, $meta_key, $meta_value) {

    if($meta_key=='contact')
    {
            $rate = get_field('rate', $meta_value);
            if($rate=="سرنخ")
            {
                update_post_meta($meta_value, 'rate', 'فرصت');
            }
    }
}, 10, 4);

add_action('add_post_meta', function ( $object_id, $meta_key, $_meta_value) {

    if($meta_key=='contact')
    {
            $rate = get_field('rate', $_meta_value);
            if($rate=="سرنخ")
            {
                update_post_meta($_meta_value, 'rate', 'فرصت');
            }
    }
}, 10, 3);


