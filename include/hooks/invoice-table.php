<?php


add_action('restrict_manage_posts', 'admin_posts_filter_restrict_manage_posts_by_author');
/**
 * Create the drop down
 *
 * @return void
 */
function admin_posts_filter_restrict_manage_posts_by_author()
{
    if (current_user_can('guest_author_5') || current_user_can('administrator')) {
        if (isset($_GET['post_type']) && 'invoice-form' == $_GET['post_type']) {

            $id=0;
            if(isset($_GET['bcust_id']))
            {
                $id=$_GET['bcust_id'];
            }
            wp_dropdown_users(array(
                'show_option_all' => 'نمایش همه',
                'name' => 'bcust_id',
                'selected' => $id
            ));
        }
    }
}

add_filter('parse_query', 'modify_query_to_filter_by_author');
/**
 * Filter by author
 * @param  (wp_query object) $query
 *
 * @return Void
 */
function modify_query_to_filter_by_author($query)
{
    global $pagenow;
    if (
        isset($_GET['post_type'])
        && 'invoice-form' == $_GET['post_type']
        && is_admin() &&
        $pagenow == 'edit.php'
    ) {
        if (isset($_GET['bcust_id'])&&$_GET['bcust_id'] != '') {
            $query->query_vars['author'] = $_GET['bcust_id'];
        } else {
            $user_id = get_current_user_id();
            $query->query_vars['author'] = $user_id;
        }
    }

    if (isset($_GET["contact_id"])) {
        $search = array();

        $search["relation"] = "AND";
        $search[] =           array(
            'key' => 'contact',
            'value' => $_GET["contact_id"],
            'compare' => '='
        );
        $query->query_vars['meta_query'] = $search;
    }
}




add_filter('manage_invoice-form_posts_columns', 'smashing_filter_posts_columns');
function smashing_filter_posts_columns($columns)
{

    $cols = [];
    foreach ($columns as $key => $col) {
        if ($key == "date") {
            $cols['contact'] = 'خریدار';
            $cols['note'] = 'یادداشت';
        }
        $cols[$key] = $col;
    }

    return $cols;
}


add_action('manage_invoice-form_posts_custom_column', function ($column_key, $post_id) {
    if ($column_key == 'contact') {
        $contact = get_field('contact', $post_id);
    
        if(isset($contact->ID))
        {
            echo '<a target="_blank" href="invoice-contact?p=' .$contact->ID . '">' . $contact->post_title . '</a>';

        }
        else
        {
            echo '<a target="_blank" href="invoice-contact?p=' .$contact . '">' . get_the_title($contact) . '</a>';

        }
    }
    if ($column_key == 'note') {
        $note = get_post_meta($post_id, 'note', true);
        echo $note;
    }
}, 10, 2);
