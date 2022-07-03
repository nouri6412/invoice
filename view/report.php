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