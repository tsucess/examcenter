<?php
require "../config/database.php";


//get data from signin page
// if (isset($_POST['apply'])) {
    $coupon_code = filter_var($_POST['coupon_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Coupon query 
        $fetch_coupon_query = "SELECT * FROM charges WHERE coupon_code = '$coupon_code'";
        $fetch_coupon_result = mysqli_query($dbconnect, $fetch_coupon_query);

        if (mysqli_num_rows($fetch_coupon_result) == 1) {
            $coupon_record = mysqli_fetch_assoc($fetch_coupon_result);


            $curdate = date("Y-m-d");
                    $exp_date = $coupon_record['exp_date'];
                    if ($curdate <= $exp_date) {
                        $discount = $coupon_record['coupon_discount'];
                        $_SESSION['discount'] = $discount;

                        echo "success";
                    }
                    
                } else {

                    echo "Coupon Code Expired";
                } 
                
            // }
         
            