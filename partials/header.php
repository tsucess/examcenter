<?php
require "./config/database.php";

//fetch current user's Information from database
if (isset($_SESSION['id'])) {

    $current_user_id = $_SESSION['id'];

    if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) {
        $admin_query = "SELECT avatar FROM admins WHERE id = $current_user_id LIMIT 1";
        $admin_info = mysqli_query($dbconnect, $admin_query);

        $admin = mysqli_fetch_assoc($admin_info);
    } else {

        $user_query = "SELECT avatar FROM users WHERE id = $current_user_id LIMIT 1";
        $user_info = mysqli_query($dbconnect, $user_query);

        $user = mysqli_fetch_assoc($user_info);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?></title>
    <!-- custom style sheet  -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/style.css">
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
    <!-- Bootsrap hearder -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/form.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/responsiveness.css">
    
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <nav>
        <div class="container nav_container">
            <a href="<?= ROOT_URL ?>"><img id="logo" src="<?= ROOT_URL ?>/img/logo.png" alt="logo"></a>
            <a href="<?= ROOT_URL ?>" class="nav_logo"></a>
            <ul class="nav_items">
                <li><a href="<?= ROOT_URL ?>">Home</a></li>
                <li><a href="<?= ROOT_URL ?>courses.php">Available subjects</a></li>
                <li><a href="https://sevenskies.edu.my/admission-form/" target="_blank">Join Seven Skies</a></li>
                <li><a href="<?= ROOT_URL ?>index.php#contact">Contact us</a></li>
                <li><a href="<?= ROOT_URL ?>faq.php">FAQs</a></li>
                
                <?php if (isset($_SESSION['id'])) : ?>
                    <?php if ($page === "home"):  ?>
                        <li>
                            <a href="<?php  if (isset($_SESSION['id'])) { echo 'admin/available-courses.php'; } else{ echo './signin.php';} ?>"><button class="btn btn-primary">Register</button></a>
                        </li>
                    <?php endif ?>
                    <li class="nav_profile py-3">
                        <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                            <div class="avatar">
                                <img src="<?= ROOT_URL . 'img/avatar/' . $admin['avatar'] ?>">
                            </div>
                            <ul>
                                <li><a href="<?= ROOT_URL ?>admin/dashboard.php">Dashboard</a></li>
                                <li><a href="<?= ROOT_URL ?>php/logout.php">Logout</a></li>
                            </ul>
                        <?php else :  ?>
                            <div class="avatar">
                                <img src="<?= ROOT_URL . 'img/avatar/' . $user['avatar'] ?>">
                            </div>
                            <ul>
                                <li><a href="<?= ROOT_URL ?>admin/dashboard-user.php">Dashboard</a></li>
                                <li><a href="<?= ROOT_URL ?>php/logout.php">Logout</a></li>
                            </ul>
                        <?php endif  ?>
                    </li>
                <?php else : ?>
                    <li><a href="<?= ROOT_URL ?>signin.php"><button class="btn btn-primary">login</button></a></li>
                <?php endif ?>
            </ul>

            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
        
    </nav>
    <!-- ******************** End of Nav Section *********************** -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
    </body>
    </html>