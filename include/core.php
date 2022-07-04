<?php
class Admin_Woo_Invoice_Core
{
    public function __construct()
    {
        register_activation_hook(ADMIN_WOO_INVOICE_FILE, array($this, "install"));
    }
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
        add_submenu_page('invoice-report-dashboard', 'گزارش api', 'گزارش api', 'manage_options', 'invoice-fetch-report', array($this, "fetch_torob"));


        add_submenu_page('invoice-convert-1', 'تبدیل فاکتور', 'تبدیل  فاکتور', 'manage_options', 'invoice-convert', array($this, "invoice_convert"));
    }
    function dashboard()
    {
        # code...
    }
    function fetch_torob()
    {
        include ADMIN_WOO_INVOICE_View . 'report-fetch.php';
    }
    function invoice_convert()
    {
        $post_id = 0;
        if (isset($_GET["post_id"])) {
            $post_id = $_GET["post_id"];
        }
        if ($post_id > 0) {
            $user_id = get_current_user_id();
            $args = array(
                'post_title'    => get_the_title($post_id),
                'post_status'   => 'publish',
                'post_author'   => $user_id,
                'post_type'     => 'invoice-form-main',
                'meta_input'    => array(
                    'pre_form'         => $post_id
                ),
            );

            $result = [];

            $insert_id = wp_insert_post($args);
            if (!is_wp_error($insert_id)) {
                global $wpdb;
                $table     = $wpdb->prefix . "postmeta";

                $query_string       = $wpdb->prepare("insert into $table( post_id, meta_key, meta_value) select  %d, meta_key, meta_value from  $table  where post_id=%d ", array($insert_id, $post_id));
                $query_result       = $wpdb->query($query_string);
                wp_redirect(admin_url() . 'post.php?post=' . $insert_id . '&action=edit');
                exit;
            } else {

                $message = '<h2 style="color:red;">خطا در ثبت اطلاعات</h2>';
            }
        }
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
        include ADMIN_WOO_INVOICE_View . 'report.php';
    }
    function get_report_api()
    {
        global $wpdb;
        $table = "";
        $type = $_POST["type"];

        $status = 0;
        $data = [];
        $cols = [];

        if ($type == "1") {
            $table1 = $wpdb->prefix . "search_word_torob";
            $table = $wpdb->prefix . "search_product_torob";
            $sql = "SELECT a1.*,a2.word_search as search_word  from $table as a1 join $table1 a2 on a1.word_id=a2.id   order by a1.id";

            $cols[] = ["title" => "name1", "field" => "name1"];
            $cols[] = ["title" => "name2", "field" => "name2"];
            $cols[] = ["title" => "price", "field" => "price"];
            $cols[] = ["title" => "price_text", "field" => "price_text"];
            $cols[] = ["title" => "price_text_mode", "field" => "price_text_mode"];
            $cols[] = ["title" => "shop_text", "field" => "shop_text"];
            $cols[] = ["title" => "random_key", "field" => "random_key"];
            $cols[] = ["title" => "search_word", "field" => "search_word"];
            $cols[] = ["title" => "web_client_absolute_url", "field" => "web_client_absolute_url"];
            $cols[] = ["title" => "discount_info", "field" => "discount_info"];
            $cols[] = ["title" => "image_url", "field" => "image_url"];
            $cols[] = ["title" => "search_id", "field" => "search_id"];
            $cols[] = ["title" => "prk", "field" => "prk"];
         //   $cols[] = ["title" => "url", "field" => "url"];

            $results = $wpdb->get_results($sql, 'ARRAY_A');
            if (count($results) > 0) {
                $status = 1;

                foreach ($results as $item) {
                    $row = [];
                    $row["word"] = $item["word_search"];

                    $json = json_decode($item["result_search"],  true, 512, JSON_UNESCAPED_UNICODE);
                    $row["name1"] = json_decode('"' . str_replace("u", "\u", $json["name1"]) . '"');
                    $row["name2"] = json_decode('"' . str_replace("u", "\u", $json["name2"]) . '"');
                    $row["price"] = $json["price"];
                    $row["price_text"] = json_decode('"' . str_replace("u", "\u", $json["price_text"]) . '"');
                    $row["price_text_mode"] = $json["price_text_mode"];
                    $row["shop_text"] = json_decode('"' . str_replace("u", "\u", $json["shop_text"]) . '"');
                    $row["random_key"] = $json["random_key"];
                    $row["search_word"] = $item["search_word"];
                    $row["web_client_absolute_url"] ='https://torob.com'. $json["web_client_absolute_url"];
                    $row["discount_info"] = json_encode($json["discount_info"]);
                    $row["image_url"] = $json["image_url"];
                    $row["search_id"] = $item["search_id"];
                    $row["prk"] = $item["prk"];

                    $data[] = $row;
                }
            }
        } else {
            $table1 = $wpdb->prefix . "search_word_torob";
            $table = $wpdb->prefix . "search_product_torob";
            $sql = "SELECT a1.*,a2.word_search as search_word  from $table as a1 join $table1 a2 on a1.word_id=a2.id  where a1.fetch_result is not null and a1.fetch_result <> 'null' order by a1.id";

            $cols[] = ["title" => "name1", "field" => "name1"];
            $cols[] = ["title" => "name2", "field" => "name2"];
            $cols[] = ["title" => "search_word", "field" => "search_word"];
            $cols[] = ["title" => "price", "field" => "price"];
            $cols[] = ["title" => "price_text", "field" => "price_text"];
            $cols[] = ["title" => "price_text_mode", "field" => "price_text_mode"];
            $cols[] = ["title" => "shop_text", "field" => "shop_text"];
            $cols[] = ["title" => "random_key", "field" => "random_key"];
            $cols[] = ["title" => "web_client_absolute_url", "field" => "web_client_absolute_url"];
            $cols[] = ["title" => "discount_info", "field" => "discount_info"];
            $cols[] = ["title" => "image_url", "field" => "image_url"];

           // $cols[] = ["title" => "products_info", "field" => "products_info"];
            $cols[] = ["title" => "products_info_filtered_by_city", "field" => "products_info_filtered_by_city"];
            $cols[] = ["title" => "products_instore_info", "field" => "products_instore_info"];
            $cols[] = ["title" => "is_city_filter_visible", "field" => "is_city_filter_visible"];
            $cols[] = ["title" => "image_urls", "field" => "image_urls"];
            $cols[] = ["title" => "buy_box_price_text", "field" => "buy_box_price_text"];
            $cols[] = ["title" => "buy_box_button_text", "field" => "buy_box_button_text"];
            $cols[] = ["title" => "min_price", "field" => "min_price"];
            $cols[] = ["title" => "max_price", "field" => "max_price"];
            $cols[] = ["title" => "variants", "field" => "variants"];
            $cols[] = ["title" => "contents", "field" => "contents"];
            $cols[] = ["title" => "breadcrumbs", "field" => "breadcrumbs"];
            $cols[] = ["title" => "structural_specs", "field" => "structural_specs"];
            $cols[] = ["title" => "slug_name", "field" => "slug_name"];
            $cols[] = ["title" => "is_confirmed", "field" => "is_confirmed"];
            $cols[] = ["title" => "is_accessible", "field" => "is_accessible"];
            $cols[] = ["title" => "availability", "field" => "availability"];
            $cols[] = ["title" => "similar_listing", "field" => "similar_listing"];
            $cols[] = ["title" => "similar_products", "field" => "similar_products"];
            $cols[] = ["title" => "torob_category", "field" => "torob_category"];
            $cols[] = ["title" => "attributes", "field" => "attributes"];
            $cols[] = ["title" => "no_index", "field" => "no_index"];
            $cols[] = ["title" => "buy_box_button_link", "field" => "buy_box_button_link"];


            $results = $wpdb->get_results($sql, 'ARRAY_A');
            if (count($results) > 0) {
                $status = 1;

                foreach ($results as $item) {
                    $row = [];
                    $row["word"] = $item["word_search"];

                    $res = str_replace("u0", "\\u0", $item["fetch_result"]);

                    $json = json_decode($res,  true, 512, JSON_UNESCAPED_UNICODE);

                    $row["name1"] = $json["name1"];
                    $row["name2"] = $json["name2"];
                    $row["search_word"] = $item["search_word"];
                    $row["price"] = $json["price"];
                    $row["price_text"] = $json["price_text"];
                    $row["price_text_mode"] = $json["price_text_mode"];
                    $row["shop_text"] = $json["shop_text"];
                    $row["random_key"] = $json["random_key"];
                    $row["web_client_absolute_url"] = $json["web_client_absolute_url"];
                    $row["discount_info"] = json_encode($json["discount_info"]);
                    $row["image_url"] = $json["image_url"];
                  //  $row["products_info"] = json_encode($json["products_info"], JSON_UNESCAPED_UNICODE);
                    $row["products_info_filtered_by_city"] = json_encode($json["products_info_filtered_by_city"], JSON_UNESCAPED_UNICODE);
                    $row["products_instore_info"] = json_encode($json["products_instore_info"], JSON_UNESCAPED_UNICODE);
                    $row["is_city_filter_visible"] = $json["is_city_filter_visible"];
                    $row["image_urls"] = json_encode($json["image_urls"], JSON_UNESCAPED_UNICODE);
                    $row["buy_box_price_text"] = $json["buy_box_price_text"];
                    $row["buy_box_button_text"] = $json["buy_box_button_text"];
                    $row["min_price"] = $json["min_price"];
                    $row["max_price"] = $json["max_price"];
                    $row["variants"] = json_encode($json["variants"], JSON_UNESCAPED_UNICODE);
                    $row["contents"] = json_encode($json["contents"], JSON_UNESCAPED_UNICODE);
                    $row["breadcrumbs"] = json_encode($json["breadcrumbs"], JSON_UNESCAPED_UNICODE);
                    $row["structural_specs"] = json_encode($json["structural_specs"], JSON_UNESCAPED_UNICODE);
                    $row["slug_name"] = $json["slug_name"];
                    $row["is_confirmed"] = $json["is_confirmed"];
                    $row["is_accessible"] = $json["is_accessible"];
                    $row["availability"] = $json["availability"];
                    $row["similar_listing"] = $json["similar_listing"];
                    $row["similar_products"] = $json["similar_products"];
                    $row["torob_category"] = $json["torob_category"];
                    $row["no_index"] = $json["no_index"];
                    $row["max_price"] = $json["max_price"];
                    $row["buy_box_button_link"] = json_encode($json["buy_box_button_link"], JSON_UNESCAPED_UNICODE);

                    $data[] = $row;
                }
            }
        }


        echo json_encode([
            'status'       => $status,
            'cols'       => $cols,
            'data'          => $data
        ]);

        die();
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
        if ($post->post_type == 'invoice-form' || $post->post_type == 'invoice-form-main') {
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
    function my_custom_page_template($single)
    {

        global $post;

        if ($post->post_name == "job-fetch-torob") {
            return ADMIN_WOO_INVOICE_View . 'job-torob.php';
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

        if (isset($_GET["page"]) && $_GET["page"] == "invoice-fetch-report") {
            wp_enqueue_style(
                'tabulator_site_style',
                ADMIN_WOO_INVOICE_URI . 'assets/css/tabulator_site.css'
            );

            wp_enqueue_script(
                'admin_woo_script_xlsx',
                ADMIN_WOO_INVOICE_URI . 'assets/js/xlsx.full.min.js',
                array('jquery'),
                1,
                true
            );

            wp_enqueue_script(
                'admin_woo_script_jspdf',
                ADMIN_WOO_INVOICE_URI . 'assets/js/jspdf.umd.min.js',
                array('jquery'),
                1,
                true
            );

            wp_enqueue_script(
                'admin_woo_script_jspdf_plugin',
                ADMIN_WOO_INVOICE_URI . 'assets/js/jspdf.plugin.autotable.min.js',
                array('jquery'),
                1,
                true
            );

            wp_enqueue_script(
                'admin_woo_script_jspdf_tabulator',
                ADMIN_WOO_INVOICE_URI . 'assets/js/tabulator.min.js',
                array('jquery'),
                1,
                true
            );
        }



        wp_enqueue_script(
            'admin_woo_ajax_script',
            ADMIN_WOO_INVOICE_URI . 'assets/js/admin-v10.js',
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
        include ADMIN_WOO_INVOICE_View . 'style.php';
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

    public function install()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $sql = new Admin_Woo_Invoice_Sql_Scripts;
        dbDelta($sql->get_install_script());
    }
}


$Admin_Woo_Invoice_Core = new Admin_Woo_Invoice_Core;

add_filter('single_template', [$Admin_Woo_Invoice_Core, 'my_custom_template']);
add_filter('page_template', [$Admin_Woo_Invoice_Core, 'my_custom_page_template']);

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

add_action('wp_ajax_admin_woo_get_report_api', array($Admin_Woo_Invoice_Core, 'get_report_api'));





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
