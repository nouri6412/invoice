<?php
add_filter('acf/fields/post_object/query', 'custom_search_product_invoice', 10, 3);
function custom_search_product_invoice($args, $field, $post_id)
{
    $search = array();
    if (is_numeric($args["s"])) {
        $search["relation"] = "OR";
        $search[] =           array(
            'key' => '_sku',
            'value' => $args["s"],
            'compare' => 'like'
        );
        $args["s"] = '';
        $args["meta_query"] = $search;
    }

    return $args;
}