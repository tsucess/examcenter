<?php
require "./config/database.php";

function sendemail_verify($firstname, $lastname, $email){

    $from = "info@edubbey.com"; //Mail created form your site
    $to = $email;   // Receiver Address
    
    $fname = $firstname; // User First Name
    $lname = $lastname; // User Last Name

    $subject = "Email Verification from Edubbey Dynamic Solutions Limited"; // Subject

    $email_template    = "
    <html>
        <head>
            <link
                href='https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;500;700;800&family=Source+Sans+Pro:wght@700&display=swap' rel='stylesheet' />
            <style>
                /* internal */
                body {
                    width: 100%;
                    min-height: 100vh;
                    align-items: center;
                    display: block;
                    justify-content: center;
                    user-select: none;
                    position: absolute;
                    top: 80px;
                }
                img {
                    width: 20px;
                }
                table {
                    border-spacing: 0;
                }

                td {
                    background: #613d7c;
                    padding: 0;
                    width: 655px;
                    height: 500px;
                    border-radius: 10px;
                    margin-top: 7%;
                    align-items: center;
                }

                .webkit {
                    max-width: 600px;
                    background-color: #ffffff;
                    color: #000000;
                }

                /* Main */
                .main {
                    font-family: 'Montserrat', sans-serif;
                }

                .main p {
                    text-align: center;
                    margin-left: 20px;
                    margin-right: 20px;
                    margin-bottom: 1rem;
                    font-weight: 400;
                    font-size: 1rem;
                    color: #ffffff
                }
                .main .unique {
                    margin-top: 1rem;
                }

                .main h1 {
                    font-size: 1.6rem;
                    text-align: center;
                    color: #00ddff;
                }

                /* Reset Button */

                .verify-btn {
                    background-color: #000f55;
                    font-size: 1rem;
                    color: #fff;
                    font-family: 'Montserrat', sans-serif;
                    font-weight: 400;
                    width: 14rem;
                    padding: 1rem;
                    margin: 0 auto;
                    cursor: pointer;
                    justify-content: center;
                    align-items: center;
                    border: none;
                    text-decoration: none;
                    border-radius: 50px;
                    text-decoration: none;
                }
                .verify-btn a{
                    color: #ffffff;
                    text-decoration:none
                }

                .verify-btn:hover {
                    background: linear-gradient(27deg, rgba(42,163,187,1) 40%, #000f55 82%, #000f55 100%);;
                    color: white;
                    border: 0.3px solid #ffffff;
                }

                /* Media Queries */

                @media screen and (max-width: 600px) {
                }

                @media screen and (max-width: 400px) {
                }
            </style>
        </head>

        <body>
            <center class='wrapper'> 
                <div class='webkit'>
                    <table class='main'>
                        <tr>
                            <td>
                                <h1>Hi ".$fname." ".$lname."!</h1>
                                <br/>
                                <p>
                                    You recently requested for change of password. Click the button below
                                </p>
                                <br/> <br/>
                            
                                <div class='verify-btn' style='text-align: center'>
                                    <a href='https://sevenskiesportal.edu.my/examcenter/createpassword.php'>Create New Password</a>
                                </div>

                                <br/>

                                <p> if the button  above did not fuction properly Kindly use the link below: </p>

                                <p class='unique'>
                                    <a href='https://sevenskiesportal.edu.my/examcenter/createpassword.php' style='color:#00ddff; text-decoration:none; font-size:1.2rem; '>Click Here</a>
                                </p>
                            
                            </td>
                        </tr>
                    </table>
                    <p>
                        If you did not request for a change of password at Edubbey Dynamic Solution Limited, please ignore
                        this email.
                    </p>
                </div>
            </center>
        </body>
    </html>";


    $message = $email_template;
    $headers = "From:".$from . "\r\n"; 
    $headers  .= 'MIME-Version: 1.0' . "\r\n";
    $headers  .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    mail($to, $subject,  $message, $headers);

    $_SESSION['forgotpass-success'] = "Change password link as be successfully sent to your Email address";
    die();
}

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if(!$email){
            $_SESSION['forgotpass'] = "Enter your email address";
    } else {

        // check if email exist in the database 
         $admincheck_query = "SELECT * FROM admins WHERE email = '$email'";
        $admincheck_result = mysqli_query($dbconnect, $admincheck_query);

        //check if student already registered 
        $user_check_query = "SELECT * FROM users WHERE email = '$email'";
        $user_check_result = mysqli_query($dbconnect, $user_check_query);


        if (mysqli_num_rows($admincheck_result) > 0) {
            $row = mysqli_fetch_assoc($admincheck_result);
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];

            sendemail_verify($firstname, $lastname, $email);
            header('location: ' . ROOT_URL . 'index.php');
            die();
        } 
        else if (mysqli_num_rows($user_check_result) > 0) {

            $row = mysqli_fetch_assoc($user_check_result);
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];

            sendemail_verify($firstname, $lastname, $email);
            header('location: ' . ROOT_URL . 'index.php');
            die();
            
        } else {
            $_SESSION['forgotpass'] = "User Account doesn't exist";
        }
        
             // $name = "Sevenskies Exam Center";
                // $subject = "Password Recovery Link";
                // $message = '<p>Click <a href="https://sevenskiesportal.edu.my/examcenter/createpassword.php"><b>Reset Password</b></a></p>';
                // $sender = "test@edubeyy.com";

                // $mailheader = "From:".$name."<".$sender.">\r\n";

                // $receipient = $email;

                // mail($receipient, $subject, $message, $mailheader) or die("Error!");


                // $_SESSION['forgotpass-success'] = "Reset Password link as been successfully sent to your Email Address";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forget password</title>
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
        }

        .card {
            width: 360px;
            height: min-content;
            padding: 20px;
            border-radius: 12px;
            background: #ffffff;
            margin: auto;
        }

        .card h4 {
            text-align: center;
        }

        small a {
            font-size: 1rem;
            text-decoration: none;
            font-weight: 500;
            text-align: center;
        }
        
        
        
        .alert_message {
            padding: 0.8rem 1.4rem;
            margin-bottom: 1rem;
            text-align: center;
            border-radius: 0.5rem;
        }
        
        p{
            margin-bottom: 0rem;
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
    <div class="container">
        <div class="container-fluid">
            <div class="card">
                 <?php if (isset($_SESSION['forgotpass-success'])) : ?>
                <div class="alert_message success">
                    <p> <?= $_SESSION['forgotpass-success'];
                        unset($_SESSION['forgotpass-success']);
                        ?>
                    </p>
                </div>
                <?php elseif (isset($_SESSION['forgotpass'])) : ?>
                    <div class="alert_message error">
                        <p> <?= $_SESSION['forgotpass'];
                            unset($_SESSION['forgotpass']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <h4>Check Email</h4>
                <form action="forgetpassword.php" method="POST">
                    <div>
                        <label for="" class="form-label"> <b>Email: </b></label>
                        <input type="text" class="form-control mb-2" name="email" placeholder="Enter your email address">
                        <input type="submit" class="btn btn-primary w-100" name="submit" value="Submit">
                        <br><br>
                        <small><a href="./signin.php">Back</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>



</body>

</html>