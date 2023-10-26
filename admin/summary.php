<?php
$page = "summary";
$title = "Transaction Summary";


include './partials/header.php';


if (isset($_POST['submit'])) {

    $session = $_POST['session'];
    $year = $_POST['year'];
    $studentNumber = $_POST['student_number'];
    $studentEmail = $_POST['student_email'];
    $parentNumber = $_POST['parent_number'];
    $parentEmail = $_POST['parent_email'];
    $studentIdNumber = $_POST['student_id'];
    $schoolName = $_POST['sch_name'];
    $prevCenterNumber = $_POST['prev_center_no'];
    $prevCandidateNumber = $_POST['prev_candidate_no'];
    $adminFee = $_SESSION['admin_fee'];
    $subjects = $_POST['subjects'];
    $price = 0.0;



    // $current_reg_id = 0;

    if (empty($session)) {
        $_SESSION['select'] = "Please Select Session";
    } else if (empty($year)) {
        $_SESSION['select'] = "Please Select Year";
    } else {
        if (empty($studentIdNumber) && empty($schoolName)) {
            $_SESSION['select'] = "Please Select School Details";
            // header('location: ' . ROOT_URL . 'admin/available-courses.php');
            // die();
        }
    }
} else {
    $_SESSION['select'] = "Please Select your Subjects";
    // header('location: ' . ROOT_URL . 'admin/available-courses.php');
    // die();
}



$current_user_id = $_SESSION['id'];
// fetch Subject Registered from registered and users table 

$fetch_subjects_query = "SELECT firstname, lastname  FROM  users WHERE id = $current_user_id";
$fetch_subject_result = mysqli_query($dbconnect, $fetch_subjects_query);
$student = mysqli_fetch_assoc($fetch_subject_result);

?>


<section class="invoice_section">
    <div class="top_head">
        <img id="logo" src="<?= ROOT_URL ?>/img/logo.png" alt="logo">
    </div>
    <div id="summary" class="container invoice_section-container ">
        <h2>SEVEN SKIES IGCSE EXAM CENTER</h2>
        <?php if (isset($_SESSION['register'])) : // shows if Register subject post was Not successful 
        ?>
            <div class="alert_message error container">
                <p> <?= $_SESSION['register'];
                    unset($_SESSION['register']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <table class="invoice">
            <thead>
                <tr>
                    <th colspan="2">Student's Bio-Data</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name:</td>
                    <td><?= "{$student['firstname']} {$student['lastname']}" ?></td>
                </tr>
                <tr>
                    <td>Year:</td>
                    <td> <?= $year ?></td>
                </tr>
                <tr>
                    <td>Session:</td>
                    <td><?= $session ? 'MAY/JUNE' : 'OCT/NOV' ?></td>
                </tr>
                <tr>
                    <td>Student's Number:</td>
                    <td><?= $studentNumber ?></td>
                </tr>
                <tr>
                    <td>Student's Email:</td>
                    <td><?= $studentEmail ?></td>
                </tr>
                <tr>
                    <td>Parent's Number:</td>
                    <td><?= $parentNumber ?></td>
                </tr>
                <tr>
                    <td>Parent's Email:</td>
                    <td><?= $parentEmail ?></td>
                </tr>
                <?php if (!empty($studentIdNumber)) :  ?>
                    <tr>
                        <td>Student ID Number:</td>
                        <td><?= $studentIdNumber ?></td>
                    </tr>
                <?php else :  ?>
                    <tr>
                        <td>School Name:</td>
                        <td> <?= $schoolName ?></td>
                    </tr>
                <?php endif  ?>
                <?php if (!empty($prevCenterNumber)) :  ?>
                    <tr>
                        <td>Previous Center Number:</td>
                        <td> <?= $prevCenterNumber ?></td>
                    </tr>
                    <tr>
                        <td>Previous Candidate Number:</td>
                        <td><?= $prevCandidateNumber ?></td>
                    </tr>
                <?php endif  ?>
            </tbody>

        </table>
        <div class="form-control">
            <h2>Selected Subjects</h2>
        </div>
        <div class="control">
            <div class="error-txt"></div>
        </div>

        <form class="coupon">
            <div class="control" id="">
                <div class="form_control">
                    <label for="">Apply for a discount if you have a coupon;</label>
                    <input type="text" name="coupon_code" id="" class="reg_form" value="" placeholder="Enter Coupon Code">
                </div>
                <button class="btn-lg" name="apply" type="submit" id="apply_coupon">
                    <span id="">Apply</span>
                </button>
            </div>
        </form>
         <table class="invoice">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Subject</th>
                    <th id="fee">Fee (MYR)</th>
                </tr>
            </thead>
            <tbody>
                <?php


                        // Fetching the coupon value 
                if (isset($_SESSION['discount'])) {
                    $coupon_discount = $_SESSION['discount'];

                    unset($_SESSION['discount']);
                } else{
                    $coupon_discount = 0;
                }

                if (isset($_SESSION['coupon'])) {
                    $skyStudentId = $studentIdNumber;
                    $discount = $_SESSION['coupon'];
                } else {
                    $skyStudentId = "NIL";
                    $discount = 0;
                }

                if (!empty($schoolName)) {
                    $schName = $schoolName;
                } else {
                    $schName = "SEVEN SKIES";
                }

                if (!empty($prevCandidateNumber) && !empty($prevCenterNumber)) {
                    $prevCanNo = $prevCandidateNumber;
                    $prevCenter = $prevCenterNumber;
                } else {
                    $prevCanNo = "NIL";
                    $prevCenter = " NIL";
                }


                if (!empty($subjects)) {
                    foreach ($subjects as $item) {
                        //fetch all subjects from database
                        $query = "SELECT  subject, subject_code, fee FROM subjects WHERE id= $item ORDER BY id DESC";
                        $subject_result = mysqli_query($dbconnect, $query);
                        while ($subject = mysqli_fetch_assoc($subject_result)) {

                ?>

                            <tr>
                                <td><?= $subject['subject_code'] ?></td>
                                <td><?= $subject['subject'] ?></td>
                                <td><?= $subject['fee'] ?> .00</td>
                            </tr>
                <?php

                                if(!empty($coupon_discount)){
                                    $disprice = $subject['fee'] -  $coupon_discount;
                                    $price = $price + $disprice;
                                } else if ($discount) {
                                $disprice = $subject['fee'] -  $discount;
                                $price = $price + $disprice;
                            } else {

                                $price = $price + $subject['fee'];
                            }
                        }
                    }

                    $price = $price + $adminFee;


                    // *************************************************************************************
                    // *************************************************************************************
                    if ($_SESSION['id']) {

                        $current_user_id = $_SESSION['id'];

                        //check if student already registered 
                        $user_check_query = "SELECT * FROM registered_subjects WHERE student_id = $current_user_id AND year = '$year' AND session = $session ";
                        $user_check_result = mysqli_query($dbconnect, $user_check_query);

                        if (mysqli_num_rows($user_check_result) > 0) {
                            $_SESSION['register'] = "Students already registered";
                        } else {

                            // Check for payment status later 
                            $payment_status = "pending";

                            foreach ($subjects as $item) {
                                //fetch all subjects from database
                                $query = "SELECT subject, subject_code FROM subjects WHERE id= $item";
                                $subject_result = mysqli_query($dbconnect, $query);
                                $subject = mysqli_fetch_assoc($subject_result);

                                $subjects2[] = $subject['subject'];
                                $subject_codes[] = $subject['subject_code'];
                            }

                            $subjec_Arr = $subjects2;
                            $subjec_code_Arr = $subject_codes;

                            $sub = implode(',', $subjec_Arr);
                            $sub_code =  implode(',', $subjec_code_Arr);
                            $sub_id = implode(',', $subjects);

                        //    $_SESSION['$numOfSubjects'] = count($subjects);

                            $insert_registered_subject = "INSERT INTO registered_subjects (subject, subject_code, subject_id, student_id, student_email, student_phone_no, parent_email, parent_phone_no, school_id_no, school_name, prev_candidate_no, prev_center_no, year, session, payment_status, amount )  VALUES ('$sub', '$sub_code', '$sub_id', '$current_user_id', '$studentEmail', '$studentNumber', '$parentEmail', '$parentNumber', '$skyStudentId', '$schName', '$prevCanNo', '$prevCenter', '$year', '$session', '$payment_status', $price)";
                            $insert_subject_result = mysqli_query($dbconnect, $insert_registered_subject);
                        }
                        $_SESSION['process'] = $current_user_id;
                    }
                    // *************************************************************************************
                    // *************************************************************************************

                    //   fetch back the Id Value Immediately
                    $check_query = "SELECT id FROM registered_subjects WHERE student_id = $current_user_id AND session = '$session' AND year='$year' AND student_email ='$studentEmail' AND student_phone_no='$studentNumber'";
                    $check_result = mysqli_query($dbconnect, $check_query);
                    $id = mysqli_fetch_assoc($check_result);

                   $_SESSION['current_reg_id']  = $id['id'];
                } else {
                    $_SESSION['select'] = "Please Select your Subjects";
                }


                ?>


                <tr>
                    <td colspan="2"><b>Admin Fee</b></td>
                    <td><b><?= $adminFee ?>.00</b></td>

                </tr>
                <?php if (!empty($coupon_discount)){
                    
                    ?>
                    <tr>
                        <td colspan="2"><b>Coupon Discount</b></td>
                        <td><b><?= $coupon_discount  ?>.00 X <?php echo count($subjects); ?></b></td>
                    </tr>
                <?php
                // $update_price_query = "UPDATE registered_subjects SET amount = $price WHERE student_id = $current_user_id AND id = $current_reg_id";
                // $update_price_sql = "mysqli_query($dbconnect, $update_price_query)";
            } ?>
                <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td><b><?php echo $price;
                    $_SESSION['paymentPrice'] = $price;

                    ?>.00</b></td>

                </tr>
            </tbody>
        </table>

        <div class="control">
            <a href="../php/delete-reg.php?reg-id=<?= $current_reg_id ?>" class="btn-lg" name="cancel">Cancel</a>
            <!-- Payment button -->
            <button class="stripe-button btn-lg" id="payButton">
                <div class="spinner hidden" id="spinner"></div>
                <span id="buttonText">Proceed to Payment</span>
            </button>
        </div>
    </div>
</section>


<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    // Select payment button
    const payBtn = document.querySelector("#payButton");

    // Payment request handler
    payBtn.addEventListener("click", function(evt) {
        setLoading(true);

        createCheckoutSession().then(function(data) {
            if (data.sessionId) {
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                handleResult(data);
            }
        });
    });

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function(stripe) {
        return fetch("payment_init.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                createCheckoutSession: 1,
            }),
        }).then(function(result) {
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function(result) {
        if (result.error) {
            showMessage(result.error.message);
        }

        setLoading(false);
    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#buttonText").classList.remove("hidden");
        }
    }

    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function() {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }
</script>







<script src="../js/coupon.js"></script>
<script src="../js/main.js"></script>
</body>

</html>