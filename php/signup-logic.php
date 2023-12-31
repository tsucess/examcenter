<?php
require "../config/database.php";


// get data from signup page

if (isset($_POST['submit'])) {


    $firstname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = strtoupper($firstname);
    $lastname = filter_var($_POST['lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = strtoupper($lastname);
    $pNumber = filter_var($_POST['pnumber'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nationality = filter_var($_POST['nationality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpsword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpsword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];
    $passport = $_FILES['passport'];


    if (!$fname) {
        $_SESSION['signup'] = "Enter your First name";
    } else if (!$lname) {
        $_SESSION['signup'] = "Enter your Last Name";
    } else if (!$pNumber) {
        $_SESSION['signup'] = "Enter your NRIC/Passport ID Number";
    } else if (!$nationality) {
        $_SESSION['signup'] = "Select your Nationality";
    } else if (!$passport) {
        $_SESSION['signup'] = "Upload your passport";
    } else if (!$gender) {
        $_SESSION['signup'] = "Select your Gender";
    } else if (!$dob) {
        $_SESSION['signup'] = "Enter your Date of Birth";
    } else if (!$avatar) {
        $_SESSION['signup'] = "Upload your Avatar";
    } else if (!$email) {
        $_SESSION['signup'] = "Enter your Email";
    } else if (strlen($createpsword) < 5 || strlen($confirmpsword) < 5) {
        $_SESSION['signup'] = "Password should be 5+ characters";
    } else {

        if ($createpsword !== $confirmpsword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($confirmpsword, PASSWORD_DEFAULT);


            //check if email exist in the admin table 
            $admincheck_query = "SELECT * FROM admins WHERE email = '$email'";
            $admincheck_result = mysqli_query($dbconnect, $admincheck_query);

            //check if email exist in the users table 
            $user_check_query = "SELECT * FROM users WHERE email = '$email'";
            $user_check_result = mysqli_query($dbconnect, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0 || mysqli_num_rows($admincheck_result) > 0) {
                $_SESSION['signup'] = "Email account exist";
            } else {
                
                $passport_name = $time . $passport['name'];
                $passport_tmp_name = $passport['tmp_name'];
                $passport_destination_path = '../img/passport/' . $passport_name;


                $passport_format = ['png', 'jpg', 'jpeg'];
                $img_ext = explode('.', $passport_name);
                $img_ext = end($img_ext);

                if (in_array($img_ext, $passport_format)) {
                    // chck image size 
                    if ($passport['size'] < 1000000) {

                        if(isset($_FILES['avatar'])){
                            // Checking Avatar Properties: size and file 
                            // $avatar_name = $time . $avatar['name'];
                            $time = time();
                            $avatar_name = $time . $avatar['name'];
                            $avatar_tmp_name = $avatar['tmp_name'];
                            $avatar_destination_path = '../img/avatar/' . $avatar_name;
                            // chck if file is an image
                            $image_format = ['png', 'jpg', 'jpeg'];
                            $image_ext = explode('.', $avatar_name);
                            $image_ext = end($image_ext);
                            if (in_array($image_ext, $image_format)) {
                                // chck image size 
                                if ($avatar['size'] < 1000000) {
                                    // upload avatar
                                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                                    // upload passport
                                    move_uploaded_file($passport_tmp_name, $passport_destination_path);
                                } else {
                                    $_SESSION['signup'] = "Photo file size too big. should be less than 1mb";
                                }
                            } else {
                                $_SESSION['signup'] = "Photo file should be png, jpg, or jpeg";
                                // $avatar_name = "nodp.png";
                                // upload passport
                                move_uploaded_file($passport_tmp_name, $passport_destination_path);
                            }
                        } 
                    } else {
                        $_SESSION['signup'] = "Passport file size too big. should be less than 1mb";
                    }
                } else {
                    $_SESSION['signup'] = "Passport file should be png, jpg 0r jpeg";
                }
            }
        }
    }

    // redirect back to signup if there is any problem 

    if (isset($_SESSION['signup'])) {

        // pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        $insert_user_query = "INSERT INTO users (firstname, lastname, passport_no, passport, nationality, dob,  avatar, email, password, gender, is_super_admin) 
    VALUES ('$fname', '$lname', '$pNumber', '$passport_name', '$nationality', '$dob', '$avatar_name', '$email', '$hashed_password', '$gender', 0)";
        $insert_user_result = mysqli_query($dbconnect, $insert_user_query);


        if (!mysqli_errno($dbconnect)) {
            // redirect to signin page with success message
            $_SESSION['signup-success'] = "Registeration successful, log in...";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {

    // if submit button is not clicked, redirect back to signup page 
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
