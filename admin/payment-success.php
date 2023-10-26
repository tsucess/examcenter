<?php
// Include configuration file  
require "config/database.php";



$current_user_id = $_SESSION['id'];




$payment_id = $statusMsg = '';
$status = 'error';

// Check whether stripe checkout session is not empty 
if ($_GET['session_id']) {
    $session_id = $_GET['session_id'];

    // Fetch transaction data from the database if already exists 
        $sqlQ = "SELECT * FROM transactions WHERE stripe_checkout_session_id = '$session_id'";
        $result = mysqli_query($dbconnect, $sqlQ);
    
    if (mysqli_num_rows($result) > 0) {
        // Transaction details 
        $transData = mysqli_fetch_assoc($result);
        $payment_id = $transData['id'];
        $transactionID = $transData['txn_id'];
        $paidAmount = $transData['paid_amount'];
        $paidCurrency = $transData['paid_amount_currency'];
        $payment_status = $transData['payment_status'];

        $customer_name = $transData['card_name'];
        $customer_email = $transData['card_email'];

        $status = 'success';
        $statusMsg = 'Your Payment has been Successful!';
    } else {
        // Include the Stripe PHP library 
        require 'stripe-php/init.php';

        // Set API key 
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

        // Fetch the Checkout Session to display the JSON result on the success page 
        try {
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $checkout_session) {
            // Get customer details 
            $customer_details = $checkout_session->customer_details;

            // Retrieve the details of a PaymentIntent 
            try {
                $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $paymentIntent) {
                // Check whether the payment was successful 
                if (!empty($paymentIntent) && $paymentIntent->status == 'succeeded') {
                    // Transaction details  
                    $transactionID = $paymentIntent->id;
                    $paidAmount = $paymentIntent->amount;
                    $paidCurrency = $paymentIntent->currency;
                    $payment_status = $paymentIntent->status;

                    // Customer info 
                    $customer_name = $customer_email = '';
                    if (!empty($customer_details)) {
                        $customer_name = !empty($customer_details->name) ? $customer_details->name : '';
                        $customer_email = !empty($customer_details->email) ? $customer_details->email : '';
                    }

                    // Check if any transaction data is exists already with the same TXN ID 
                    $sqlQ = "SELECT id FROM transactions WHERE txn_id = '$transactionID'";
                    $result = mysqli_query($dbconnect, $sqlQ);
                    $prevRow = mysqli_fetch_assoc($result);

                    if (!empty($prevRow)) {
                        $payment_id = $prevRow['id'];
                    } else {
                        // Insert transaction data into the database 
                        $sqlQ = "INSERT INTO transactions (student_name, student_email, student_id, card_name, card_email, subject, subject_code, subject_id, session, year, total_price, item_price_currency, paid_amount, paid_amount_currency, txn_id, payment_status, stripe_checkout_session_id, created, modified) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())";
                        $stmt = $dbconnect->prepare($sqlQ);
                        $stmt->bind_param("ssissssdsddsdssss", $student_name, $student_email, $student_id, $customer_name, $customer_email, $subject, $subject_code, $subject_id, $session, $year, $totalPrice, $currency, $paidAmount, $paidCurrency, $transactionID, $payment_status, $session_id);
                        $insert = $stmt->execute();

                        if ($insert) {
                            $payment_id = $stmt->insert_id;
                        }
                    }

                    $status = 'success';
                    $statusMsg = 'Your Payment has been Successful!';
                } else {
                    $statusMsg = "Transaction has been failed!";
                }
            } else {
                $statusMsg = "Unable to fetch the transaction details! $api_error";
            }
        } else {
            $statusMsg = "Invalid Transaction! $api_error";
        }
    }
} else {
    $statusMsg = "Invalid Request!";
}
?>

<?php 


if (!empty($payment_id)) {

 $update_register_query = "UPDATE registered_subjects SET payment_status ='success'  WHERE student_id = $current_user_id";
 $update_register_result = mysqli_query($dbconnect, $update_register_query);
    header('location: ' . ROOT_URL . 'admin/registered-courses.php');
    die();

?>

<?php } else { ?>
    <h1 class="error">Your Payment been failed!</h1>
    <p class="error"><?php echo $statusMsg; ?></p>
<?php } ?>