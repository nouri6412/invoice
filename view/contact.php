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


    <title>خریدار</title>
    <style>
        body{
            text-align: right;
        }
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

        .hidden-td {
            display: none;
        }
        .invoice .red{
    color: red;
}
    </style>
</head>
<?php
if (!is_user_logged_in()) {
    return;
}
?>

<body dir="rtl">
    <?php
    while (have_posts()) :
        the_post();
    ?>
        <div class="container-xl invoice" style="margin-top: 100px;">
            <div class="row">
                <div class="col-3 text-center"></div>
                <div class="col-6 text-center">
                    <h4 class="font-weight-bold">مشخصات خریدار</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>نام شخص حقیق / حقوقی: <?php echo get_the_title(); ?></label>
                </div>
                <div class="col-12">
                    <label class="red">وضعیت: <?php echo get_field("status", get_the_ID()) ?> </label>
                </div>
                <div class="col-12">
                    <label class="red">درجه: <?php echo get_field("rate", get_the_ID()) ?> </label>
                </div>
                <div class="col-12">
                    <label>آدرس کامل: <?php echo get_field("address", get_the_ID()) ?> </label>
                </div>
                <div class="col-12">
                    <label><?php echo 'شماره اقتصادی' . ' : ' . get_field("ech_number",get_the_ID()) ?></label>

                </div>
                <div class="col-12">
                    <label><?php echo 'کد پستی' . ' : ' . get_field("postal_code",get_the_ID()) ?></label>

                </div>
                <div class="col-12">
                    <label><?php echo 'شماره ثبت / شناسه ملی' . ' : ' . get_field("nash_code", get_the_ID()) ?></label>
                </div>
                <div class="col-12">
                    <label><?php echo 'تلفن / نمابر' . ' : ' . get_field("tel", get_the_ID()) ?></label>
                </div>
            </div>
        </div>
    <?php

    endwhile; // End of the loop.
    ?>
</body>

</html>
<?php
