<?php
    require "../config/database.php";

        //fetch current user's Information from database
if (isset($_SESSION['user_is_admin'])) {

    // $current_user_id = $_SESSION['id'];

    if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) {
        if(isset($_GET['id'])){
            $editId = $_GET['id'];
            $edit_fetch_query = "SELECT * FROM admins WHERE id = $editId";
            $edit_fetch_result = mysqli_query($dbconnect, $edit_fetch_query);
            $sub = mysqli_fetch_assoc($edit_fetch_result);
            header('Content-Type: application/json');
            echo json_encode($sub);
    
            }
    } else {
        if(isset($_GET['id'])){
            $editId = $_GET['id'];
            $edit_fetch_query = "SELECT * FROM users WHERE id = $editId";
            $edit_fetch_result = mysqli_query($dbconnect, $edit_fetch_query);
            $sub = mysqli_fetch_assoc($edit_fetch_result);
            header('Content-Type: application/json');
            echo json_encode($sub);
    
            }
    }
}