<?php
require "../config/database.php";



$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$coupon_code = filter_var($_POST['coupon_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$admin_fee = filter_var($_POST['admin_fee'], FILTER_SANITIZE_NUMBER_INT);
$coupon_discount = filter_var($_POST['coupon_discount'], FILTER_SANITIZE_NUMBER_INT);
$exp_date = filter_var($_POST['exp_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if(($coupon_code && $coupon_discount) || $admin_fee){


    $update_coupon_query = "UPDATE charges SET admin_fee=$admin_fee, coupon_code='$coupon_code', coupon_discount=$coupon_discount, exp_date='$exp_date' WHERE id = $id LIMIT 1";
    $insert_coupon_result = mysqli_query($dbconnect, $update_coupon_query);
    echo "success";
}
