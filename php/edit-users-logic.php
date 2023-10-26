<?php
require "../config/database.php";


$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$prev_avatar_name = filter_var($_POST['prev_avatar_name'], FILTER_SANITIZE_SPECIAL_CHARS);
$prev_password = filter_var($_POST['prev_password'], FILTER_SANITIZE_SPECIAL_CHARS);
$prev_nricpassport_name = filter_var($_POST['prev_passport_name'], FILTER_SANITIZE_SPECIAL_CHARS);

$firstname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$fname = strtoupper($firstname);
$lastname = filter_var($_POST['lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lname = strtoupper($lastname);
$passport_no = filter_var($_POST['pnumber'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nationality = filter_var($_POST['nationality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$dob = filter_var($_POST['dob'], FILTER_SANITIZE_NUMBER_INT);
$avatar = $_FILES['avatar'];
$passport = $_FILES['passport'];
$createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_SPECIAL_CHARS);
$confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_SPECIAL_CHARS);


if (!empty($fname) && !empty($lname) && !empty($passport_no)) {

    if ($createpassword) {

        if ($createpassword !== $confirmpassword) {
            echo "Passwords do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($confirmpassword, PASSWORD_DEFAULT);
        }
    } else{
        $hashed_password = $prev_password;
    }
  
    //work on document
    //deleting existing avatar if new document is available
    if ($avatar['name']) {
        $prev_avatar_path = '../img/avatar/'.$prev_avatar_name;
        if ($prev_avatar_path) {
            unlink($prev_avatar_path);
        }

    //deleting existing document if new document is available
    if ($passport['name']) {
        $prev_passport_path = '../img/passport/'.$prev_nricpassport_name;
        if ($prev_passport_path) {
            unlink($prev_passport_path);
        }

        // Checking Document Properties: size and file 
        $time = time();
        $passport_name = $time . $passport['name'];
        $passport_tmp_name = $passport['tmp_name'];
        $passport_destination_path = '../img/passport/'.$passport_name;

        // passport validation
        $passport_format = ['jpeg', 'jpg', 'png'];
        $passport_ext = explode('.', $passport_name);
        $passport_ext = end($passport_ext);


        if (in_array($passport_ext, $passport_format)) {
            // chck document size 
            if ($passport['size'] < 2000000) {
                // upload Document
                move_uploaded_file($passport_tmp_name, $passport_destination_path);
            } else {
                $_SESSION['edit-user'] = "File size too big. should be less than 2mb";
            }
        } else {
            echo "please select an Image file - png, jpeg, or jpg!";
        }

    }

        // Checking avatar Properties: size and file 
        $time = time();
        $avatar_name = $time . $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_destination_path = '../img/avatar/'.$avatar_name;

        // image validation
        $image_format = ['jpeg', 'jpg', 'png'];
        $image_ext = explode('.', $avatar_name);
        $image_ext = end($image_ext);



        if (in_array($image_ext, $image_format)) {
            // chck document size 
            if ($avatar['size'] < 2000000) {
                // upload Document
                move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
            } else {
                echo "File size too big. should be less than 2mb";
            }
        } else {
            echo "please select an Image file - png, jpeg, or jpg!";
        }
    }

    
    //set avatar name if a new one was uploaded,else keep old avatar name
    $avatar_to_insert = $avatar_name ?? $prev_avatar_name;

    //set passport name if a new one was uploaded,else keep old passport name
    $passport_to_insert = $passport_name ?? $prev_nricpassport_name;

    // $password_to_insert = $hashed_password ?? $prev_password;
    $password_to_insert = $hashed_password;

    try {
        // let's update all user data inside database table 
        $update_user_query = "UPDATE `users` SET firstname ='$fname', lastname ='$lname', passport_no='$passport_no', passport='$passport_to_insert', nationality='$nationality', gender='$gender', dob ='$dob', avatar='$avatar_to_insert', password='$password_to_insert' WHERE id =$id LIMIT 1";
        $insert_user_result = mysqli_query($dbconnect, $update_user_query);
        echo "success";
    } catch (mysqli_sql_exception $e) {
        var_dump($e);
        exit;
    }
} else {
    echo "All input field are required";
}
