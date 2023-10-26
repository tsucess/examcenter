<?php
include "../config/database.php";

if (isset($_GET['reg-id'])) {
    $id = filter_var($_GET['reg-id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch Registeration data from the database  in order to delete form from images folder
    $query = "SELECT * FROM registered_subjects WHERE id = $id";
    $result = mysqli_query($dbconnect, $query);


    //make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
      
            // delet post from database
            $delete_subject_query = "DELETE FROM registered_subjects WHERE id=$id LIMIT 1";
            $delete_subject_result = mysqli_query($dbconnect, $delete_subject_query);
       
    }
}

header('location: ' . ROOT_URL . 'admin/available-courses.php');
die();
