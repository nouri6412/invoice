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
    <h2>گزارش api</h2>
    <?php
    //  echo  mbm_invoice\tools::to_shamsi(date('Y-m-d'));
    ?>

    <div class="postbox">
        <?php  
// $string = json_decode('"' . str_replace("u","\u","u062fu0627u0631 ") . '"');
// echo json_decode('"' . $string . '"');
// var_dump(json_decode('"' . $string . '"')); // string(2) "á"

?>
        <div class="filter-box">
            <div class="invoice-field">
                <label for="report-type">نوع گزارش</label>
                <select id="report-type" name="report-type">
                    <option value="1">گزارش کلی </option>
                    <option value="2">گزارش جزئیات</option>
                </select>
            </div>

            <div class="invoice-field">
                <button id="fetch_api_report" class="button button-primary">گزارش</button>
            </div>
            <div class="invoice-field">
                <button id="download-xlsx" class="button button-primary">تبدیل به excel</button>
            </div>
        </div>

        <div class="content-box"></div>
        <div id="api-torob-area"></div>
    </div>

</div>