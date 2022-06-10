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
            'name' => _x('مشتری', 'plural'),
            'singular_name' => _x('مشتری', 'singular'),
            'menu_name' => _x('مشتری', 'admin menu'),
            'name_admin_bar' => _x('مشتری', 'admin bar'),
            'add_new' => _x('ثبت مشتری جدید', 'add new'),
            'add_new_item' => "ثبت مشتری جدید",
            'new_item' => "مشتری جدید",
            'edit_item' => "ویرایش مشتری",
            'view_item' => "مشاهده مشتری",
            'all_items' => "همه مشتری ها",
            'search_items' => "جستجوی مشتری",
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
