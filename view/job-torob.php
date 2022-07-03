<?php
$type = "";
global $wpdb;

$token = "950071:62b828c9f410d7.97991171";

if (isset($_GET["type"])) {
    $type = $_GET["type"];
}

if ($type == "step1") {
    $word = '';

    $table = $wpdb->prefix . "search_word_torob";
    $date = date('Y-m-d H:i:s', strtotime(date("Y-m-d") . ' - 7 days'));
    $sql = "SELECT id,word_search from $table where fetch_date is null or fetch_date < '" . date("Y-m-d") . "' order by fetch_date limit 1 ";
    // $sql = "SELECT id,word_search from $table order by fetch_date limit 1 ";

    $results = $wpdb->get_results($sql, 'ARRAY_A');

    if (count($results) > 0) {
        $word = $results[0]['word_search'];
        $str_fetch = file_get_contents('https://one-api.ir/torob/?token=' . $token . '&action=search&q=' . trim($word));
        $json = json_decode($str_fetch, true);

        if (is_array($json) && isset($json["status"]) && $json["status"] == 200) {

            $sql = "update  $table set result_search='" . $str_fetch . "', fetch_date='" . date('Y-m-d H:i:s') . "' where id = '" . $results[0]['id'] . "' ";
            $query_result       = $wpdb->query($sql);

            $table = $wpdb->prefix . "search_product_torob";
            foreach ($json["result"] as $item) {

                $sql1 = "delete  from $table where  word_search='" . $item["name1"] . "'";
                $query_result       = $wpdb->query($sql1);


                $sql = "insert into  $table (word_id,word_search,search_id,prk,result_search) values('" . $results[0]['id'] . "','" . $item["name1"] . "','" . $item["search_id"] . "','" . $item["prk"] . "','" . json_encode($item) . "') ";
                $query_result       = $wpdb->query($sql);
                //   echo   $sql . '<br>';
                // break;
            }
        }
    }
} else if ($type == "step2") {
    for ($x = 0; $x < 5; $x++) {
        $word = '';

        $table = $wpdb->prefix . "search_product_torob";
        $date = date('Y-m-d H:i:s', strtotime(date("Y-m-d") . ' - 7 days'));
        $sql = "SELECT * from $table where fetch_date is null or fetch_date < '" . date("Y-m-d") . "' order by fetch_date limit 1 ";
        // $sql = "SELECT * from $table order by fetch_date limit 1 ";

        $results = $wpdb->get_results($sql, 'ARRAY_A');

        if (count($results) > 0) {
            $product_id = $results[0]['id'];
            $prk = $results[0]['prk'];
            $search_id = $results[0]['search_id'];
            $results[0]['word_search'];
            $query='https://one-api.ir/torob/?token=' . $token . '&action=get&search_id=' . $search_id . '&prk=' . $prk;
        //  echo $query.'<br>';
            $str_fetch = file_get_contents($query);
            $json = json_decode($str_fetch, true);
//var_dump($json);
           // if (is_array($json) && isset($json["status"]) && $json["status"] == 200) {

                $sql = "update  $table set fetch_result='" . json_encode($json["result"]) . "', fetch_date='" . date('Y-m-d H:i:s') . "' where id = '" . $results[0]['id'] . "' ";
                $query_result       = $wpdb->query($sql);
            //}
        }
    }
}
