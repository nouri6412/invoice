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


        ///////


        ////

        $supports = array(
            'title', // post title
            'thumbnail', // featured images
            'custom-fields', // custom fields
            'post-formats', // post formats
        );

        $labels = array(
            'name' => _x(' فاکتور', 'plural'),
            'singular_name' => _x(' فاکتور', 'singular'),
            'menu_name' => _x(' فاکتور', 'admin menu'),
            'name_admin_bar' => _x(' فاکتور', 'admin bar'),
            'add_new' => _x('ثبت  فاکتور جدید', 'add new'),
            'add_new_item' => "ثبت  فاکتور جدید",
            'new_item' => " فاکتور جدید",
            'edit_item' => "ویرایش  فاکتور",
            'view_item' => "مشاهده  فاکتور",
            'all_items' => "همه  فاکتور ها",
            'search_items' => "جستجوی فاکتور",
            'not_found' => "یافت نشد"
        );

        $args = array(
            'supports' => $supports,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'invoice-form-main'),
            'has_archive' => true,
            'hierarchical' => false,
        );
        register_post_type('invoice-form-main', $args);
    }

    function menu()
    {
        add_menu_page('گزارشات  فاکتور', 'گزارشات  فاکتور', 'manage_options', 'invoice-report-dashboard', array($this, "dashboard"), 'dashicons-money-alt');
        add_submenu_page('invoice-report-dashboard', 'گزارش پیش فاکتور', 'گزارش پیش فاکتور', 'manage_options', 'invoice-report-form', array($this, "pre_invoice_report"));
        add_submenu_page('invoice-report-dashboard', 'گزارش  فاکتور', 'گزارش  فاکتور', 'manage_options', 'invoice-report-form-main', array($this, "invoice_report"));
    }
    function dashboard()
    {
        # code...
    }
    function pre_invoice_report()
    {
        $this->report("invoice-form");
    }
    function invoice_report()
    {
        $this->report("invoice-form-main");
    }
    function report($invoice_type)
    {
        $title = "پیش";
        if ($invoice_type == "invoice-form-main") {
            $title = "";
        }
?>

        <style>
            .invoice-wrap {
                padding: 20px;
            }

            .invoice-wrap button {
                /* padding: 2px 6px 4px 6px;
    cursor: pointer; */
            }

            .invoice-wrap .postbox {
                padding: 10px;
            }

            .invoice-wrap .postbox .filter-box {
                display: flex;
            }

            .invoice-wrap .postbox .content-box {
                margin-top: 24px;
            }

            .invoice-wrap .postbox .invoice-field {
                margin-bottom: 15px;
                width: 30%;
                padding: 10px;
            }

            .invoice-wrap .postbox .invoice-field button {
                margin-top: 18px;
            }

            .invoice-wrap .postbox .invoice-field label {
                display: block;
            }

            .invoice-wrap .postbox .invoice-field input,
            .invoice-wrap .postbox .invoice-field select {
                width: 100%;
                margin-top: 5px;
                max-width: 100%;
            }
        </style>
        <div class="invoice-wrap">
            <h2>گزارش <?php echo $title ?> فاکتور</h2>
            <?php
            //  echo  mbm_invoice\tools::to_shamsi(date('Y-m-d'));
            ?>
            <div class="postbox">
                <div class="filter-box">
                    <div class="invoice-field">
                        <label for="report-type">نوع گزارش</label>
                        <input id="invoice-type" name="invoice-type" value="<?php echo $invoice_type; ?>" type="hidden" />
                        <select id="report-type" name="report-type">
                            <option value="1">تعداد <?php echo $title ?> فاکتور</option>
                            <option value="2">مبلغ <?php echo $title ?> فاکتور</option>
                        </select>
                    </div>
                    <div class="invoice-field">
                        <label>تعداد روز</label>
                        <input id="report-count" name="report-count" value="7" type="number" />
                    </div>
                    <div class="invoice-field">
                        <button class="button button-primary" id="generate_chart_invoice">گزارش</button>
                    </div>

                </div>

                <div class="content-box"></div>
                <div id="pwpc-chart-area"></div>
            </div>
        </div>

    <?php
    }

    function get_report()
    {
        $type = $_POST["type"];
        $count = $_POST["count"];
        $invoice_type = $_POST["invoice_type"];
        $user = $_POST["user"];
        $args = array(
            'post_type' => $invoice_type,
            'post_status' => 'publish',
            'orderby'   => 'date',
            'order'   => 'ASC',

            // 'meta_key' => '_sku',
            // 'meta_value' => '',
        );
        $the_query = new WP_Query($args);
        $count_post = $the_query->post_count;

        $titles = [];
        $values = [];

        $data = [];

        $index = 0;

        while ($the_query->have_posts()) :
            $the_query->the_post();



            // $date = mbm_invoice\tools::to_shamsi(
            //     get_the_date('Y-m-d')
            // );

            $date = get_the_date('Y-m-d');


            $pr = 1;

            if ($type == 2) {
                $pr =  get_post_meta(get_the_ID(), 'price_kol', true);
            }

            if (!is_numeric($pr)) {
                $pr = 0;
            }

            if (isset($data[$date])) {
                $data[$date] = $data[$date] + $pr;
            } else {
                $data[$date] = $pr;
                $index++;
            }

            if ($index >= $count) {
                break;
            }

        endwhile;

        foreach ($data as $key => $val) {
            $titles[] = $key;
            $values[] = $val;
        }

        echo json_encode([
            'titles'       => $titles,
            'values'          => $values
        ]);

        die();
    }

    function my_custom_template($single)
    {

        global $post;

        /* Checks for single template by post type */
        if ($post->post_type == 'invoice-form') {
            return ADMIN_WOO_INVOICE_View . 'invoice.php';
        }

        if ($post->post_type == 'invoice-contact') {
            return ADMIN_WOO_INVOICE_View . 'contact.php';
        }

        if ($post->post_type == 'invoice-seller') {
            return ADMIN_WOO_INVOICE_View . 'contact.php';
        }

        return $single;
    }
    function script()
    {
    ?>
        <div id="invoice-contact-modal" class="invoice-modal">
            <div class="modal-box">
                <div class="modal-box-header">
                    <h2>ثبت خریدار جدید</h2>
                </div>
                <div class="modal-box-body">
                    <div class="invoice-form">
                        <div class="invoice-form-field">
                            <label>عنوان</label>
                            <input id="invoice-contact-title" />
                        </div>
                        <div class="invoice-form-field">
                            <label>شماره اقتصادی</label>
                            <input id="invoice-contact-ech-number" />
                        </div>
                        <div class="invoice-form-field">
                            <label>شماره ثبت / شناسه ملی</label>
                            <input id="invoice-contact-nash-code" />
                        </div>
                        <div class="invoice-form-field">
                            <label>کد پستی</label>
                            <input id="invoice-contact-postal-code" />
                        </div>
                        <div class="invoice-form-field">
                            <label>تلفن</label>
                            <input id="invoice-contact-tel" />
                        </div>
                        <div class="invoice-form-field wide-100">
                            <label>آدرس</label>
                            <input id="invoice-contact-address" />
                        </div>
                    </div>
                </div>
                <div class="modal-box-footer">
                    <button id="invoice-contact-modal-save" style="float:right" class="invoice-btn" href="#" onclick="save_form_invoice_contact_modal()">ذخیره</button>
                    <button style="float:left" class="invoice-btn" href="#" onclick="close_invoice_contact_modal()">بستن</button>
                </div>
            </div>
        </div>
    <?php
    }
    function scripts()
    {

        wp_enqueue_style(
            'pantherius_wp_charts_style',
            ADMIN_WOO_INVOICE_URI . 'assets/css/pantherius_wp_charts.css'
        );

        wp_enqueue_style(
            'admin_woo-styles_date',
            ADMIN_WOO_INVOICE_URI . 'assets/css/DatePicker.css',
            array(),
            1.0
        );

        wp_enqueue_script(
            'jquery-chartjs',
            ADMIN_WOO_INVOICE_URI . 'assets/js/Chart.min.js',
            array('jquery'),
            '2.3.0',
            true
        );

        wp_enqueue_script(
            'pantherius_wp_charts_script',
            ADMIN_WOO_INVOICE_URI . 'assets/js/pantherius_wp_charts.js',
            array('jquery', 'jquery-chartjs'),
            '2.3.0',
            true
        );

        wp_enqueue_script(
            'admin_woo_script_date',
            ADMIN_WOO_INVOICE_URI . 'assets/js/DatePicker.js',
            array('jquery'),
            1,
            true
        );

        wp_enqueue_script(
            'admin_woo_script_jalali',
            ADMIN_WOO_INVOICE_URI . 'assets/js/jalali.js',
            array('jquery'),
            1,
            true
        );

        wp_enqueue_script(
            'admin_woo_ajax_script',
            ADMIN_WOO_INVOICE_URI . 'assets/js/admin-v7.js',
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
                cursor: pointer;
                display: flex;
                width: 50%;
                float: right;
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

            .invoice-loader-img {
                position: absolute;
                left: 2px;
                width: 21px;
                top: 4px;
            }

            .title-product-list input {
                width: 240px !important;
            }

            .title-product-list .title-label {}

            .invoice-modal {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                display: none;
            }

            .invoice-modal .modal-box {
                width: 50%;
                background-color: #fff;
                border: 1px dolid #000;
                box-shadow: 10px 10px 10px #b3b0b0;
                margin: auto;
                margin-top: 30px;
                padding: 30px;
            }

            .invoice-modal .modal-box .modal-box-header {
                padding: 10px 30px 10px 30px;
            }

            .invoice-modal .modal-box .modal-box-body {
                padding: 10px 30px 10px 30px;
            }

            .invoice-modal .modal-box .modal-box-footer {
                padding: 10px 30px 10px 30px;
            }

            .invoice-box-btn {}

            .invoice-btn {
                cursor: pointer;
                text-decoration: none;
                padding: 5px;
            }

            .invoice-form .invoice-form-field {
                margin-top: 10px;
            }

            .invoice-form .invoice-form-field label {
                display: block;
                font-weight: bold;
                margin: 0 0 3px;
                padding: 0;
            }

            .invoice-form .invoice-form-field input {
                width: 100%;
                padding: 4px 8px;
                margin: 0;
                box-sizing: border-box;
                font-size: 14px;
                line-height: 1.4;
            }
        </style>
<?php
    }

    function save_contact()
    {
        $message = '';
        $user_id = get_current_user_id();

        $title = $_POST["form_title"];
        $form_eq_number = $_POST["form_eq_number"];
        $form_post_code = $_POST["form_post_code"];
        $form_nah_code = $_POST["form_nah_code"];
        $form_tel = $_POST["form_tel"];
        $form_address = $_POST["form_address"];

        $args = array(
            'post_title'    => $title,
            'post_content'  => $message,
            'post_status'   => 'publish',
            'post_author'   => $user_id,
            'post_type'     => 'invoice-contact',
            'meta_input'    => array(
                'ech_number'         => $form_eq_number,
                'postal_code'         => $form_post_code,
                'nash_code'         => $form_nah_code,
                'tel'         => $form_tel,
                'address'         => $form_address,
            ),
        );

        $result = [];

        $post_id = wp_insert_post($args);
        if (!is_wp_error($post_id)) {
            $state = 1;
            $message = 'با موفقیت ثبت شد';
        } else {

            $state = 0;
            $message = 'خطا در ثبت اطلاعات';
        }


        echo json_encode([
            'state'       => $state,
            'message'          => $message
        ]);

        die();
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
                'post_type' => 'product_variation',
                'post_status' => 'publish',
                'meta_key' => '_sku',
                'meta_value' => $s,
                'posts_per_page' => 1
            );
            $the_query = new WP_Query($args);
            $count = $the_query->post_count;
            $sku = "";

            if ($count == 0) {
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'meta_key' => '_sku',
                    'meta_value' => $s,
                    'posts_per_page' => 6
                );
                $the_query = new WP_Query($args);
                $count = $the_query->post_count;
            } else {
                $is_sku = 1;
                $sku = $s;
            }



            if ($count == 0) {
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    "s" => $s,
                    'posts_per_page' => 6
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

                            $json[] = ["title" => get_the_title() . ' ' . $data, "sku" => $sku, "price" => $_product->get_price(), 'id' => $product_id, 'img' => get_the_post_thumbnail_url()];
                        }
                    }
                } else {
                    $price = $product->get_price();
                    $json[] = ["title" => get_the_title(), "price" => $price, "sku" => $sku, 'id' => $product_id, 'img' => get_the_post_thumbnail_url()];
                }

            endwhile;
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

add_action("admin_menu", array($Admin_Woo_Invoice_Core, "menu"));

add_action('admin_footer', array($Admin_Woo_Invoice_Core, "style"));
add_action('admin_footer', array($Admin_Woo_Invoice_Core, "script"));

add_action('wp_ajax_admin_woo_request_price', array($Admin_Woo_Invoice_Core, 'request_price'));
add_action('wp_ajax_admin_woo_save_contact', array($Admin_Woo_Invoice_Core, 'save_contact'));
add_action('wp_ajax_admin_woo_search_product', array($Admin_Woo_Invoice_Core, 'search_product'));
add_action('wp_ajax_admin_woo_request_seller', array($Admin_Woo_Invoice_Core, 'request_seller'));
add_action('wp_ajax_admin_woo_get_report', array($Admin_Woo_Invoice_Core, 'get_report'));





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




