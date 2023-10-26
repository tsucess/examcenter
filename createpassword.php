<?php
require "./config/database.php";

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpsword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpsword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$email) {
        $_SESSION['resetpassword'] = "Enter your Email Address";
    } else if (strlen($createpsword) < 5 || strlen($confirmpsword) < 5) {
        $_SESSION['resetpassword'] = "Password should be 5+ characters";
    } else {

        if ($createpsword !== $confirmpsword) {
            $_SESSION['resetpassword'] = "Passwords do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($confirmpsword, PASSWORD_DEFAULT);

            //check if email exist in the admin table 
            $admincheck_query = "SELECT * FROM admins WHERE email = '$email'";
            $admincheck_result = mysqli_query($dbconnect, $admincheck_query);

            //check if email exist in the users table 
            $user_check_query = "SELECT * FROM users WHERE email = '$email'";
            $user_check_result = mysqli_query($dbconnect, $user_check_query);
        }
  
        if (mysqli_num_rows($user_check_result) > 0 || mysqli_num_rows($admincheck_result) > 0) {

            if (mysqli_num_rows($user_check_result) > 0) {

                //update the new password of the User
                $update_user_query = "UPDATE users SET  password= '$hashed_password' WHERE email = '$email' LIMIT 1";
                $update_user_result = mysqli_query($dbconnect, $update_user_query);
            } else {
                //update the new password of the Admin
                $update_admin_query = "UPDATE admins SET  password= '$hashed_password' WHERE email = '$email' LIMIT 1";
                $update_admin_result = mysqli_query($dbconnect, $update_admin_query);
            }
        } else {
            $_SESSION['resetpassword'] = "User account does not exist";
        }
        
        if (isset($_SESSION['resetpassword'])) {
            
            // pass form data back to resetpassword page
            $_SESSION['resetpassword-data'] = $_POST;
            header('location: ' . ROOT_URL . 'createpassword.php');
            die();
        } else {      
            $_SESSION['resetpassword-success'] = "Password changed successfully";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
}


$email = $_SESSION['resetpassword-data']['email'] ?? null;
$psword = $_SESSION['resetpassword-data']['createpassword'] ?? null;
$cpsword = $_SESSION['resetpassword-data']['confirmpassword'] ?? null;


unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create new password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2d2b7c;
        }

 .container{
            --bs-gutter-x: 0rem;
            /*padding: 2rem;*/
        }

        .card {
            width: 380px;
            height: min-content;
            padding: 20px;
            border-radius: 12px;
            background: #ffffff;
            margin: auto;
        }

        .card h4 {
            text-align: center;

        }
        p{
            margin-bottom: 0rem;
        }

         .alert_message {
            padding: 0.8rem 1.4rem;
             margin-bottom: 1rem; 
            text-align: center;
            border-radius: 0.5rem;
        }

        .alert_message.error {
            background: rgba(236, 138, 138, 0.5);
            color: #da0f3f;
        }

        .alert_message.success {
            background: hsl(156, 100%, 38%, 15%);
            color: #00c476;
        }
    </style>


</head>

<body>
    <div class="container container-sm">
        <div class="card">
        <?php if (isset($_SESSION['resetpassword'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['resetpassword'];
                        unset($_SESSION['resetpassword']);
                        ?>
                    </p>
                </div>
            <?php else: ?>
                <div class="alert_message success">
                    <p> <?= $_SESSION['resetpassword-success'];
                        unset($_SESSION['resetpassword-success']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <h4>Create New Password</h4>
            <form action="createpassword.php" method="POST">
                <div>
                    <label for="" class="form-label"> <b>Email: </b></label>
                    <input type="text" class="form-control mb-2" name="email" value="<?= $email ?>" placeholder="Enter your email address" >
                    <input type="password" class="form-control mb-2" name="createpassword" value="<?=  $psword ?>" placeholder="Enter New Password" >
                    <input type="password" class="form-control mb-2" name="confirmpassword" value="<?=  $cpsword ?>" placeholder="Confirm Password" >
                    <input type="submit" name="submit" class="btn btn-primary w-100" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>