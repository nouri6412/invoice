<?php
class Admin_Woo_Invoice_Models
{
    var $models=[];
    public function __construct()
    {
        global $wpdb;
        foreach (glob(ADMIN_WOO_INVOICE_Include."models/*.php") as $filename)
        {
            include $filename;
        }

        $in_urls=[];
        $in_urls=apply_filters("mbm_invoice_models_url",$in_urls);
        foreach($in_urls as $item)
        {
            if(strlen($item)>0)
            {
                foreach (glob($item."models/*.php") as $filename)
                {
                    include $filename;
                }
            }  
        }

    }
    public function get_model($model)
    {
        //var_dump($this->models);
        if(isset($this->models[$model]))
        {
            $mod=apply_filters("filter_mbm_invoice_get_model_".$model,$this->models[$model]);
            return $mod;
        }
        return [];
    }
    
}