<?php
class Admin_Woo_Invoice_Sql_Scripts
{
  public function get_install_script()
  {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = '';

    $table_name = $wpdb->prefix . "search_word_torob";
    $sql .= "CREATE TABLE $table_name (
        `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
        `word_search` varchar(500) CHARACTER SET utf8 NOT NULL,
        `result_search` text CHARACTER SET utf8 NOT NULL,
        `result_search_new` text CHARACTER SET utf8 NOT NULL,
        `fetch_date` DATETIME NULL,
        PRIMARY KEY (`id`)
      )ENGINE=InnoDB $charset_collate; ";


    $table_name = $wpdb->prefix . "search_product_torob";
    $sql .= "CREATE TABLE $table_name (
    `id` BIGINT(18) NOT NULL AUTO_INCREMENT,
    `word_id` BIGINT(18) NOT NULL ,
    `word_search` varchar(500) CHARACTER SET utf8 NOT NULL,
    `search_id` varchar(500) CHARACTER SET utf8 NOT NULL,
    `prk` varchar(500) CHARACTER SET utf8 NOT NULL,
    `result_search` text CHARACTER SET utf8 NOT NULL,
    `fetch_result` text CHARACTER SET utf8,
    `fetch_date` DATETIME NULL,
    PRIMARY KEY (`id`)
  )ENGINE=InnoDB $charset_collate; ";

    $table_name = $wpdb->prefix . "search_product_torob_new";
    $sql .= "CREATE TABLE $table_name (
`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
`word_id` BIGINT(18) NOT NULL ,
`word_search` varchar(500) CHARACTER SET utf8 NOT NULL,
`random_key` varchar(500) CHARACTER SET utf8 NOT NULL,
`more_info_url` text CHARACTER SET utf8 NOT NULL,
`result_search` text CHARACTER SET utf8 NOT NULL,
`fetch_result` text CHARACTER SET utf8,
`fetch_date` DATETIME NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB $charset_collate; ";

    return $sql;
  }
}
