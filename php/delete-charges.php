<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch form from the database  in order to delete form from images folder
    $query = "SELECT * FROM charges WHERE id = $id";
    $result = mysqli_query($dbconnect, $query);

 
    //make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
        $subject = mysqli_fetch_assoc($result);
        
            // delet coupon from database
            $delete_subject_query = "DELETE FROM charges WHERE id=$id LIMIT 1";
            $delete_subject_result = mysqli_query($dbconnect, $delete_subject_query);
            if (!mysqli_errno($dbconnect)) {
                $_SESSION['delete-form-success'] = "Coupon Deleted successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-charges.php');
die();
