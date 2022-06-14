<?php
class Admin_Woo_Invoice_Core
{
    function init()
    {
        $supports = array(
            'title', // post title
            'thumbnail', // featured images
            'custom-fields', // custom fields
            'post-formats', // post formats
        );

        $labels = array(
            'name' => _x('خریدار', 'plural'),
            'singular_name' => _x('خریدار', 'singular'),
            'menu_name' => _x('خریدار', 'admin menu'),
            'name_admin_bar' => _x('خریدار', 'admin bar'),
            'add_new' => _x('ثبت خریدار جدید', 'add new'),
            'add_new_item' => "ثبت خریدار جدید",
            'new_item' => "خریدار جدید",
            'edit_item' => "ویرایش خریدار",
            'view_item' => "مشاهده خریدار",
            'all_items' => "همه خریدار ها",
            'search_items' => "جستجوی خریدار",
            'not_found' => "یافت نشد"
        );

        $args = array(
            'supports' => $supports,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'invoice-contact'),
            'has_archive' => true,
            'hierarchical' => false,
        );
        register_post_type('invoice-contact', $args);

        ////


        $supports = array(
            'title', // post title
            'thumbnail', // featured images
            'custom-fields', // custom fields
            'post-formats', // post formats
        );

        $labels = array(
            'name' => _x('فروشنده', 'plural'),
            'singular_name' => _x('فروشنده', 'singular'),
            'menu_name' => _x('فروشنده', 'admin menu'),
            'name_admin_bar' => _x('فروشنده', 'admin bar'),
            'add_new' => _x('ثبت فروشنده جدید', 'add new'),
            'add_new_item' => "ثبت فروشنده جدید",
            'new_item' => "فروشنده جدید",
            'edit_item' => "ویرایش فروشنده",
            'view_item' => "مشاهده فروشنده",
            'all_items' => "همه فروشنده ها",
            'search_items' => "جستجوی فروشنده",
            'not_found' => "یافت نشد"
        );

        $args = array(
            'supports' => $supports,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'invoice-seller'),
            'has_archive' => true,
            'hierarchical' => false,
        );
        register_post_type('invoice-seller', $args);

        ////

        $supports = array(
            'title', // post title
            'thumbnail', // featured images
            'custom-fields', // custom fields
            'post-formats', // post formats
        );

        $labels = array(
            'name' => _x('پیش فاکتور', 'plural'),
            'singular_name' => _x('پیش فاکتور', 'singular'),
            'menu_name' => _x('پیش فاکتور', 'admin menu'),
            'name_admin_bar' => _x('پیش فاکتور', 'admin bar'),
            'add_new' => _x('ثبت پیش فاکتور جدید', 'add new'),
            'add_new_item' => "ثبت پیش فاکتور جدید",
            'new_item' => "پیش فاکتور جدید",
            'edit_item' => "ویرایش پیش فاکتور",
            'view_item' => "مشاهده پیش فاکتور",
            'all_items' => "همه پیش فاکتور ها",
            'search_items' => "جستجوی پیش فاکتور",
            'not_found' => "یافت نشد"
        );

        $args = array(
            'supports' => $supports,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'invoice-form'),
            'has_archive' => true,
            'hierarchical' => false,
        );
        register_post_type('invoice-form', $args);
    }

    function my_custom_template($single)
    {

        global $post;

        /* Checks for single template by post type */
        if ($post->post_type == 'invoice-form') {
            return ADMIN_WOO_INVOICE_View . 'invoice.php';
        }

        return $single;
    }
    function scripts()
    {
        wp_enqueue_script(
            'admin_woo_ajax_script',
            ADMIN_WOO_INVOICE_URI . 'assets/js/admin.js',
            array('jquery'),
            1,
            true
        );

        wp_localize_script('admin_woo_ajax_script', 'admin_woo_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'invoice_assets_plugin_url' => ADMIN_WOO_INVOICE_URI . 'assets/'
        ));
    }
    function style()
    {
?>
        <style>
            .acf-input .acf-input-wrap {
                position: relative;
                overflow: initial;
            }

            .acf-input .acf-input-wrap .list-price {
                position: absolute;
                top: 30px;
                border: 1px solid #b3b0b0;
                width: 100%;
                padding: 5px;
                background: #fff;
                z-index: 1000;
            }

            .acf-input .acf-input-wrap .list-price .item-price {
                margin-bottom: 4px;
                padding: 2px;
                cursor: pointer;
                display: flex;
            }

            .acf-input .acf-input-wrap .list-price .item-price .item-price-img {}

            .acf-input .acf-input-wrap .list-price .item-price .item-price-img img {
                width: 60px;
                height: 60px;
                object-fit: cover;
            }

            .acf-input .acf-input-wrap .list-price .item-price .item-price-title {
                padding: 8px;
            }

            .acf-input .acf-input-wrap .list-price .item-price .item-price-price {
                padding: 8px;
            }

            .acf-input .acf-input-wrap .list-price .item-price:hover {
                background-color: #eee;
            }

            .acf-button {
                width: 0;
                padding: 0 !important;
                border: 0 !important;
            }
            .invoice-loader-img{
                position: absolute;
    left: 2px;
    width: 21px;
    top: 4px;
            }
        </style>
<?php
    }

    function request_price()
    {
        $product_id = $_POST['product_id'];
        $product = wc_get_product($product_id);

        // $regular_price = $product->get_regular_price();

        // $sale_price = $product->get_sale_price();

        $json = [];

        if ($product->is_type('variable')) {
            $variation_id = $product->get_children();

            foreach ($variation_id as $id) {
                $_product       = new WC_Product_Variation($id);
                $variation_data = $_product->get_variation_attributes();

                foreach ($variation_data as $key => $data) {

                    $json[] = ["title" => $data, "price" => $_product->get_price()];
                }
            }
        } else {
            $price = $product->get_price();
            $json[] = ["title" => "عادی", "price" => $price];
        }


        echo json_encode([
            'success'       => true,
            'data'          => $json
        ]);

        die();
    }
    function search_product()
    {
        $s = $_POST['s'];
        $s = trim($s);
        $json = [];
        if (strlen($s) > 0) {

            $args = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'meta_key' => '_sku',
                'meta_value' => $s,
                'posts_per_page' => 10
            );
            $the_query = new WP_Query($args);
            $count = $the_query->post_count;

            if ($count == 0) {
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    "s" => $s,
                    'posts_per_page' => 10
                );
                $the_query = new WP_Query($args);
            }



            while ($the_query->have_posts()) :
                $the_query->the_post();
                $product_id = get_the_ID();

                $product = wc_get_product($product_id);



                if ($product->is_type('variable')) {
                    $variation_id = $product->get_children();

                    foreach ($variation_id as $id) {
                        $_product       = new WC_Product_Variation($id);
                        $variation_data = $_product->get_variation_attributes();

                        foreach ($variation_data as $key => $data) {

                            $json[] = ["title" => get_the_title() . ' ' . $data, "price" => $_product->get_price(), 'id' => $product_id, 'img' => get_the_post_thumbnail_url()];
                        }
                    }
                } else {
                    $price = $product->get_price();
                    $json[] = ["title" => get_the_title(), "price" => $price, 'id' => $product_id, 'img' => get_the_post_thumbnail_url()];
                }

            endwhile;
        }

        $is_sku = 0;
        if (is_numeric($s) && count($json) == 1) {
            $is_sku = 1;
        }
        echo json_encode([
            'success'       => true,
            'is_sku'       => $is_sku,
            'data'          => $json
        ]);

        die();
    }

    function request_seller()
    {
        $ID = $_POST['seller_id'];

        $json = [];
        $json["title"] = get_the_title($ID);
        $json["ech_number"] = get_field('ech_number', $ID);
        $json["postal_code"] = get_field('postal_code', $ID);
        $json["nash_code"] = get_field('nash_code', $ID);
        $json["tel"] = get_field('tel', $ID);
        $json["address"] = get_field('address', $ID);

        echo json_encode([
            'success'       => true,
            'data'          => $json
        ]);

        die();
    }
}


$Admin_Woo_Invoice_Core = new Admin_Woo_Invoice_Core;

add_filter('single_template', [$Admin_Woo_Invoice_Core, 'my_custom_template']);

add_action('init', [$Admin_Woo_Invoice_Core, 'init']);
add_action('admin_enqueue_scripts', array($Admin_Woo_Invoice_Core, "scripts"));

add_action('admin_footer', array($Admin_Woo_Invoice_Core, "style"));

add_action('wp_ajax_admin_woo_request_price', array($Admin_Woo_Invoice_Core, 'request_price'));
add_action('wp_ajax_admin_woo_search_product', array($Admin_Woo_Invoice_Core, 'search_product'));
add_action('wp_ajax_admin_woo_request_seller', array($Admin_Woo_Invoice_Core, 'request_seller'));


$result = add_role(
    'guest_author_1',
    'مسئول شعبه',
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);

$result = add_role(
    'guest_author_2',
    'مسئول انبار',
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);

$result = add_role(
    'guest_author_3',
    'مسئول تامین',
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);

$result = add_role(
    'guest_author_4',
    'مدیر محصول',
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);

$result = add_role(
    'guest_author_5',
    'مدیر فروش',
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);

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
add_filter('acf/fields/post_object/query', 'custom_search_product_invoice', 10, 3);
