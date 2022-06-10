<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since 1.0.0
 */
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo ADMIN_WOO_INVOICE_URI; ?>assets/css/admin.css" />


    <title>فاکتور فروش</title>
    <style>
        .invoice {
            font-family: 'Vazir';
        }

        .invoice p {
            margin-bottom: 1px;
        }

        .invoice .table-bordered td,
        .invoice .table-bordered th,
        .invoice .table thead th {
            border: 1px solid #868789;
            ;
        }

        .invoice .table td,
        .table th {
            padding: 5px;
        }

        .invoice {
            font-size: 13px;
        }
    </style>
</head>

<body dir="rtl">
    <?php
    while (have_posts()) :
        the_post();
    ?>
        <div class="container-xl invoice" style="margin-top: 100px;">
            <div class="row">
                <div class="col-3 text-center"></div>
                <div class="col-6 text-center">
                    <h4 class="font-weight-bold">صورتحساب فروش کالا و خدمات</h4>
                </div>
                <div class="col-3 text-right">
                    <p><?php echo 'تاریخ سفارش' . ' ' . ':' . get_the_ID() ?></p>
                    <p><?php echo 'تاریخ سفارش' . ' ' . ':' . get_field('date') ?></p>
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <?php $contact = get_field("seller"); ?>
                            <th class="text-center" colspan="11">مشخصات فروشنده</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="11" class="text-right">
                                <div class="row">
                                    <div class="col-4">
                                        <p>نام شخص حقیق / حقوقی: <?php echo $contact->post_title ?></p>
                                        <p>آدرس کامل: <?php echo get_field("address", $contact->ID) ?> </p>
                                    </div>
                                    <div class="col-4">
                                        <p><?php echo 'شماره اقتصادی' . ' : ' . get_field("ech_number", $contact->ID) ?></p>
                                        <p><?php echo 'کد پستی' . ' : ' . get_field("postal_code", $contact->ID) ?></p>

                                    </div>
                                    <div class="col-4">
                                        <p><?php echo 'شماره ثبت / شناسه ملی' . ' : ' . get_field("nash_code", $contact->ID) ?></p>
                                        <p><?php echo 'تلفن / نمابر' . ' : ' . get_field("tel", $contact->ID) ?></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <?php $contact = get_field("contact"); ?>
                            <th class="text-center" colspan="11">مشخصات خریدار</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="11" class="text-right">
                                <div class="row">
                                    <div class="col-4">
                                        <p>نام شخص حقیق / حقوقی: <?php echo $contact->post_title ?></p>
                                        <p>آدرس کامل: <?php echo get_field("address", $contact->ID) ?> </p>
                                    </div>
                                    <div class="col-4">
                                        <p><?php echo 'شماره اقتصادی' . ' : ' . get_field("ech_number", $contact->ID) ?></p>
                                        <p><?php echo 'کد پستی' . ' : ' . get_field("postal_code", $contact->ID) ?></p>

                                    </div>
                                    <div class="col-4">
                                        <p><?php echo 'شماره ثبت / شناسه ملی' . ' : ' . get_field("nash_code", $contact->ID) ?></p>
                                        <p><?php echo 'تلفن / نمابر' . ' : ' . get_field("tel", $contact->ID) ?></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th class="text-center" colspan="11">مشخصات کالا یا خدمات مورد معامله</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="text-center">
                            <th>ردیف</th>
                            <th>کد کالا</th>
                            <th style="min-width: 260px;">شرح کالا یا خدمات</th>
                            <th>تعداد / مقدار</th>
                            <th>واحد انداز گیری</th>
                            <th>مبلغ واحد (ریال)</th>
                            <th>مبلغ کل (ریال)</th>
                            <th>مبلغ تخفیف (ریال)</th>
                            <th>مبلغ کل پس از تخفیف (ریال)</th>
                            <th>جمع مالیات و عوارض (ریال)</th>
                            <th>جمع مبلغ کل به علاوه مالیات و عوارض (ریال)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 0;
                        $items = get_field('items');
                        if (is_array($items)) {
                            foreach ($items as $item) {
                                $row++;
                                $it = $item['item'];
                        ?>

                                <tr class="text-center">
                                    <td><?php echo $row ?></td>
                                    <?php $product = wc_get_product($it['kala']->ID); ?>
                                    <td><?php echo $product->get_sku() ?></td>
                                    <td><?php echo $it['kala']->post_title ?></td>
                                    <td><?php echo $it['count'] ?></td>
                                    <td>عدد</td>aww
                                    <td><?php echo $it['price'] ?></td>
                                    <td><?php echo $it['price'] * $it['count'] ?></td>
                                    <td><?php echo $it['discount'] ?></td>
                                    <td><?php echo ($it['price'] * $it['count']) - $it['discount'] ?></td>
                                    <?php $tax = (($it['price'] * $it['count']) - $it['discount']) * get_field('tax');
                                    $tax = $tax / 100;
                                    $tax = round($tax); ?>
                                    <td><?php echo  $tax  ?></td>
                                    <td><?php echo ($it['price'] * $it['count']) - $it['discount'] + $tax ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <th colspan="5" class="text-right">جمع کل</th>
                            <th class="text-center">۱۵,۰۰۰</th>
                            <th class="text-center">۱۵,۰۰۰</th>
                            <th class="text-center">۱,۰۰۰</th>
                            <th class="text-center">۱۴,۰۰۰</th>
                            <th class="text-center">۵۰۰</th>
                            <th class="text-center">۱۴,۵۰۰</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-right">شرایط و نحوه فروش: <?php echo get_field('type'); ?></th>
                            <th colspan="6" class="text-right"><?php echo 'توضیحات' . ' : ' . get_field('desc'); ?></th>
                        </tr>
                        <tr style="padding: 60px 0;">
                            <td style="padding: 40px 10px;" colspan="5" class="text-right">مهر و امضا فروشنده</td>
                            <td colspan="6" class="text-right">مهر و امضا خریدار</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php

    endwhile; // End of the loop.
    ?>
</body>

</html>
<?php
