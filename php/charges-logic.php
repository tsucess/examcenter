<?php
require "../config/database.php";
 

// if(isset($_POST['submit'])){

    $coupon_code = filter_var($_POST['coupon_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $admin_fee = filter_var($_POST['admin_fee'], FILTER_SANITIZE_NUMBER_INT);
    $coupon_discount= filter_var($_POST['coupon_discount'], FILTER_SANITIZE_NUMBER_INT);
    $exp_date = filter_var($_POST['exp_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   if($coupon_code || $admin_fee){
       
       try {            
           $insert_charges_query = "INSERT INTO charges (admin_fee, coupon_code, coupon_discount, exp_date) VALUES ($admin_fee, '$coupon_code', $coupon_discount, '$exp_date')";
           $insert_charges_result = mysqli_query($dbconnect, $insert_charges_query);
           echo 'success';
        } catch (mysqli_sql_exception $e) {
            var_dump($e);
            exit;
        }
    } else{
        echo "Input Form Data";
    }
// }


?>