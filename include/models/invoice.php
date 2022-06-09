<?php
$this->models["invoice"] = [];
$this->models["invoice"]["id"] = "2";
$this->models["invoice"]["name"] = "invoice";
$this->models["invoice"]["label"] = "پیش فاکتور";
$this->models["invoice"]["primary_key"] = "id";
$this->models["invoice"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی ثبت",
        "sortable" => true,
        "in_table" => true,
        "in_form" => true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "بانک",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "in_table" => true,
        "type" => array("type" => "select", "select" => ["model"=> $wpdb->prefix . "invoice_model","where" => "type_id=1", "key" => "id", "label" => "title"], "size" => 50, "class" => "col-md-6")
    ),
    "contact" => array(
        "title" => "contact",
        "label" => "طرف حساب",
        "sortable" => true,
        "is_require" => true,
        "in_form" => true,
        "in_table" => true,
        "type" => array("type" => "select","auto-select"=>true, "select" => ["model"=> $wpdb->prefix . "invoice_model","where" => "type_id=2", "key" => "id", "label" => "title"], "size" => 50, "class" => "col-md-6")
    ),
    "mablagh" => array(
        "title" => "mablagh",
        "label" => "مبلغ پرداخت نقدی",
        "sortable" => true,
        "in_form" => true,
        "is_require" => true,
        "in_table" => true,
        "type" => array("type" => "text", "size" => 50, "class" => "col-md-6")
    ),
    "sanad_date" => array(
        "title" => "sanad_date",
        "label" => " تاریخ",
        "sortable" => true,
        "in_form" => true,
        "in_table" => true,
        "type" => array("type" => "date", "size" => 50, "class" => "col-md-6")
    ),
    "description" => array(
        "title" => "description",
        "label" => "توضیحات",
        "sortable" => true,
        "in_form" => true,
        "in_table" => true,
        "type" => array("type" => "textarea", "size" => 1000, "class" => "col-md-12")
    )
);
