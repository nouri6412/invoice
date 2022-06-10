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
}



$Admin_Woo_Invoice_Core = new Admin_Woo_Invoice_Core;

add_filter('single_template', [$Admin_Woo_Invoice_Core, 'my_custom_template']);

add_action('init', [$Admin_Woo_Invoice_Core, 'init']);



