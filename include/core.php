<?php
class Admin_Woo_Invoice_Core
{
    var $entities = [];
    var $alerts = [];
    public function __construct()
    {
        add_action('admin_enqueue_scripts',  array($this, "styles"));
        add_action('admin_enqueue_scripts', array($this, "scripts"));
        add_action("admin_menu", array($this, "menu"));
        register_activation_hook(ADMIN_WOO_INVOICE_FILE, array($this, "install"));
    }

    public function run()
    {
    }

    public function add_alert($message, $type = "danger")
    {
        $this->alerts[] = ["message" => $message, "type" => $type];
    }

    public function get_alert()
    {
        return $this->alerts;
    }

    public function print_alert()
    {
        foreach ($this->alerts as $alert) {
?>
            <div class="alert alert-<?php echo esc_attr($alert["type"]); ?>">
                <?php echo esc_html($alert["message"]); ?>
            </div>

<?php
        }
    }

    public function styles()
    {

        wp_enqueue_style(
            'invoice-styles_font',
            ADMIN_WOO_INVOICE_URI . 'assets/css/font-awesome.min.css',
            array(),
            1.0
        );

        wp_enqueue_style(
            'invoice-styles_date',
            ADMIN_WOO_INVOICE_URI . 'assets/css/DatePicker.css',
            array(),
            1.0
        );

        wp_enqueue_style(
            'invoice-styles_bootstrap',
            ADMIN_WOO_INVOICE_URI . 'assets/css/bootstrap.min.css',
            array(),
            1.0
        );

        wp_enqueue_style(
            'invoice-styles-bootstrap-rtl',
            ADMIN_WOO_INVOICE_URI . 'assets/css/bootstrap.rtl.css',
            array(),
            1.0
        );

        wp_enqueue_style(
            'invoice-styles',
            ADMIN_WOO_INVOICE_URI . 'assets/css/admin.css',
            array(),
            1.0
        );
    }

    public function scripts()
    {
        global $wp_query;

        wp_enqueue_script(
            'admin_woo_script_bootstrap',
            ADMIN_WOO_INVOICE_URI . 'assets/js/bootstrap.min.js',
            array('jquery'),
            1,
            true
        );

        wp_enqueue_script(
            'admin_woo_script',
            ADMIN_WOO_INVOICE_URI . 'assets/js/admin.js',
            array('jquery'),
            1,
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
            'admin_woo_ajax_script',
            ADMIN_WOO_INVOICE_URI . 'assets/js/ajax.js',
            array('jquery'),
            1,
            true
        );

        wp_enqueue_script(
            'admin_woo_ajax_script_form',
            ADMIN_WOO_INVOICE_URI . 'assets/js/form.js',
            array('jquery'),
            1,
            true
        );

        wp_localize_script('admin_woo_ajax_script', 'admin_woo_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'page' => isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '',
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages
        ));
    }


    public function dashboard()
    {
        $Admin_Woo_Invoice_Home = new Admin_Woo_Invoice_Home;
        $Admin_Woo_Invoice_Home->home();
    }
    public function setting()
    {
        $Admin_Woo_Invoice_Setting = new Admin_Woo_Invoice_Setting;
        $Admin_Woo_Invoice_Setting->render();
    }

    public function define_bank()
    {
        $entity =  $this->get_entity("bank");
        $entity->render();
    }


    public function define_contact()
    {
        $entity =  $this->get_entity("contact");
        $entity->render();
    }

    public function define_cost()
    {
        $entity =  $this->get_entity("cost");
        $entity->render();
    }

    public function insert_cost()
    {
        $entity =  $this->get_entity("insert_cost");
        $entity->render();
    }

    public function report_cost()
    {
        $entity =  $this->get_entity("report_cost");
        $entity->render();
    }

    public function report_bank()
    {
        $entity =  $this->get_entity("report_bank");
        $entity->render();
    }

    public function report_income()
    {
        $entity =  $this->get_entity("report_income");
        $entity->render();
    }

    public function report_debt()
    {
        $entity =  $this->get_entity("report_debt");
        $entity->render();
    }

    public function define_income()
    {
        $entity =  $this->get_entity("income");
        $entity->render();
    }

    public function insert_income()
    {
        $entity =  $this->get_entity("insert_income");
        $entity->render();
    }

    public function insert_debt()
    {
        $entity =  $this->get_entity("insert_debt");
        $entity->render();
    }

    public function insert_demand()
    {
        $entity =  $this->get_entity("insert_demand");
        $entity->render();
    }

    public function insert_pay()
    {
        $entity =  $this->get_entity("insert_pay");
        $entity->render();
    }


    public function insert_cash()
    {
        $entity =  $this->get_entity("insert_cash");
        $entity->render();
    }

    public function menu()
    {


        add_menu_page('فاکتور ادمین', 'فاکتور ادمین', 'manage_options', 'admin-invoice-dashboard', array($this, "dashboard"), 'dashicons-money-alt');
        add_submenu_page('admin-invoice-dashboard', 'داشبورد حسابداری', 'داشبورد حسابداری', 'manage_options', 'admin-invoice-dashboard', array($this, "dashboard"));

        add_submenu_page('admin-invoice-dashboard', 'تنظیمات', 'تنظیمات', 'manage_options', 'admin-invoice-setting', array($this, "setting"));

        add_submenu_page('admin-invoice-dashboard', 'تعاریف بانک', 'تعاریف بانک', 'manage_options', 'admin-invoice-define-bank', array($this, "define_bank"));


        add_submenu_page('admin-invoice-dashboard', '  تعاریف طرف حساب / اشخاص / شرکت', 'تعاریف طرف حساب / اشخاص / شرکت', 'manage_options', 'admin-invoice-define-contact', array($this, "define_contact"));


        add_submenu_page('admin-invoice-dashboard', 'تعاریف درآمد', 'تعاریف درآمد', 'manage_options', 'admin-invoice-define-income',  array($this, "define_income"));


        add_submenu_page('admin-invoice-dashboard', 'تعاریف هزینه', 'تعاریف هزینه', 'manage_options', 'admin-invoice-define-cost',  array($this, "define_cost"));





        add_submenu_page('admin-invoice-dashboard', 'ثبت هزینه', 'ثبت هزینه', 'manage_options', 'admin-invoice-insert_cost', array($this, "insert_cost"));
        add_submenu_page('admin-invoice-dashboard', 'ثبت درآمد', 'ثبت درآمد', 'manage_options', 'admin-invoice-insert_income', array($this, "insert_income"));
        add_submenu_page('admin-invoice-dashboard', 'ثبت بدهکار', 'ثبت بدهکار  ', 'manage_options', 'admin-invoice-insert_debt', array($this, "insert_debt"));
        add_submenu_page('admin-invoice-dashboard', 'ثبت طلبکار', 'ثبت طلبکار', 'manage_options', 'admin-invoice-insert_demand', array($this, "insert_demand"));
        add_submenu_page('admin-invoice-dashboard', 'پرداخت نقدی ', 'پرداخت نقدی ', 'manage_options', 'admin-invoice-insert_pay', array($this, "insert_pay"));
        add_submenu_page('admin-invoice-dashboard', 'دریافت نقدی', 'دریافت نقدی', 'manage_options', 'admin-invoice-insert_cash', array($this, "insert_cash"));
        add_submenu_page('admin-invoice-dashboard', 'گزارش موجودی بانک', 'گزارش موجودی بانک', 'manage_options', 'admin-invoice-report_bank', array($this, "report_bank"));
        add_submenu_page('admin-invoice-dashboard', 'گزارش هزینه', 'گزارش هزینه', 'manage_options', 'admin-invoice-report_cost', array($this, "report_cost"));
        add_submenu_page('admin-invoice-dashboard', 'گزارش درآمد', 'گزارش درآمد', 'manage_options', 'admin-invoice-report_income', array($this, "report_income"));
        add_submenu_page('admin-invoice-dashboard', 'گزارش بدهی ها و مطالبه ها', 'گزارش بدهی ها و مطالبه ها', 'manage_options', 'admin-invoice-report_debt', array($this, "report_debt"));





        $this->add_entity(mbm_invoice\tools::get_model_from_url());
        //add_submenu_page('admin-invoice-dashboard', '', '', 'manage_options', '', array($this,"define_bank"));

    }

    public function get_entity($model_in)
    {

        return $this->entities[$model_in];
    }

    public function add_entity($model_in, $type = "list")
    {
        global $wpdb;

        $entity = new Admin_Woo_Invoice_Entity($model_in, $type);

        $Admin_Woo_Invoice_Models = new Admin_Woo_Invoice_Models;

        $model = $Admin_Woo_Invoice_Models->get_model($model_in);

        if (count($model) == 0) {
            return;
        }

        $Admin_Woo_Invoice_Models_List = new Admin_Woo_Invoice_Models_List(
            array(
                "model" => $model_in,
                "model_obj" => $model,
                "model_table_name" => $wpdb->prefix . "invoice_model",
                "where" => " and type_id='" . $model["id"] . "'"
            )
        );

        $option = 'per_page';
        $args   = [
            'label'   => $model["label"],
            'default' => 5,
            'option'  => $model_in . 's_per_page'
        ];

        add_screen_option($option, $args);

        $entity->model_obj = $Admin_Woo_Invoice_Models_List;

        $entity->title_page = sprintf('لیست %s', $model["label"]);

        $this->entities[$model_in] = $entity;
    }

    public function install()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $sql = new Admin_Woo_Invoice_Sql_Scripts;
        dbDelta($sql->get_install_script());
    }
}