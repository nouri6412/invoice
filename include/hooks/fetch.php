<?php
class Admin_Woo_Invoice_Fetch
{
    function torob()
    {

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
            <div class="postbox">
                <div style="padding: 15px">
                    <form method="POST" action="admin.php?page=invoice-fetch-totob">
                        <textarea style="    width: 100%; margin-bottom: 10px;" id="invoice_fetch" name="invoice_fetch"><?php if (isset($_POST["invoice_fetch"])) echo $_POST["invoice_fetch"] ?></textarea>
                        <span>با حرف - کلمات را جدا کنید</span>
                        <button type="submit">دریافت اطلاعات از api</button>
                    </form>
                </div>

                <button onclick="exportTableToExcelCustom()">تبدیل به اکسل</button>
                <?php
                if (isset($_POST["invoice_fetch"])) {
                    $arr = explode('-', $_POST["invoice_fetch"]);
                    $html = '<table  id="torob-table" style="display:none">';
                    global $detail;
                    $detail = [];
                    foreach ($arr as $word) {
                        $html .= '<tr>';
                        $html .= '<td>';
                        $html .= $word;
                        $html .= '</td>';
                        $html .= '</tr>';
                        $html .= '<tr>';
                        $str = file_get_contents('https://one-api.ir/torob/?token=950071:62b828c9f410d7.97991171&action=search&q=' . trim($word));
                        $json = json_decode($str, true);
                        // print_r($json);
                        // var_dump($json);
                        $html .= $this->table($json["result"], $word);
                        $html .= '</tr>';
                    }
                    $html .= '</table>';

                    $html .= '<table  id="torob-table-detail" style="display:none">';
                   // var_dump($detail);
                    foreach ($detail as $row) {
                        $html .= '<tr>';
                        $html .= '<td>';
                        $html .= $row["word"];
                        $html .= '</td>';
                        $html .= '</tr>';
                        $html .= '<tr>';
                        $url='https://one-api.ir/torob/?token=950071:62b828c9f410d7.97991171&action=get&search_id=' . $row["search_id"] . '&prk=' . $row["prk"] . '';
                      //  echo $url.'<br>';
                        $str = file_get_contents($url);
                     //  echo $str;
                        $json = json_decode($str, true);
                        // var_dump($json);
                        //   $html .= $this->table($json);
                        $html .= '</tr>';
                    }
                    $html .= '</table>';
                    echo $html;
                }
                ?>
            </div>
        </div>


        <script src="<?php echo ADMIN_WOO_INVOICE_URI; ?>assets/js/jszip.js"></script>
        <script src="<?php echo ADMIN_WOO_INVOICE_URI; ?>assets/js/xlsx.js"></script>
        <script src="<?php echo ADMIN_WOO_INVOICE_URI; ?>assets/js/excel.js"></script>
<?php
    }
    function table($table,$word="")
    {
     global $detail;
        $html = "";

        $index=0;
        foreach ($table as $key => $tr)
        {
            $index++;
            if($index==1)
            {
                $html .= '<tr>';
                foreach ($tr as $key1 => $tr1) {
                    $html .= '<th>' . $key1 . '-' . '</th>';
                }
                $html .= '</tr>';
            }

    
            $html .= '<tr>';
            foreach ($tr as $key1 => $tr1) {
                if ($key1 == "search_id") {
                    $detail[] = ["search_id" => $tr1, "prk" => $tr["prk"], "word" => $word];
                }
                $html .= '<td>' . $tr1 . '-' . '</td>';
            }
            $html .= '</tr>';
        }

        return $html;
    }
}
