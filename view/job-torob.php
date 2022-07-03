<?php
$type = "";
global $wpdb;



if (isset($_GET["type"])) {
    $type = $_GET["type"];
}

if ($type == "step1") {
    $word = '';

    $table = $wpdb->prefix . "search_word_torob";
    $date = date('Y-m-d H:i:s', strtotime(date("Y-m-d") . ' - 7 days'));
   // $sql = "SELECT id,word_search from $table where fetch_date is null or fetch_date < '" . $date . "' order by fetch_date limit 1 ";
   $sql = "SELECT id,word_search from $table order by fetch_date limit 1 ";

    $results = $wpdb->get_results($sql, 'ARRAY_A');

    if (count($results) > 0) {
        $word = $results[0]['word_search'];
        $str_fetch = file_get_contents('https://one-api.ir/torob/?token=950071:62b828c9f410d7.97991171&action=search&q=' . trim($word));
        $json = json_decode($str_fetch, true);
        
        if (is_array($json) && isset($json["status"]) && $json["status"] == 200) {
          
            $sql = "update  $table set result_search='" . $str_fetch . "', fetch_date='" . date('Y-m-d H:i:s') . "' where id = '".$results[0]['id']."' ";
            $query_result       = $wpdb->query($sql);
        
            foreach ($json["result"] as $item) {
             
                $table = $wpdb->prefix . "search_product_torob";
                $sql = "insert into  $table (word_id,word_search,result_search,fetch_date) values('".$results[0]['id']."','".$item["name1"]."','" . json_encode($item) . "','" . date('Y-m-d H:i:s') . "') ";
                $query_result       = $wpdb->query($sql);
             //   echo   $sql . '<br>';
               // break;
            }
        }
    }
} else if ($type == "step2") {
}
