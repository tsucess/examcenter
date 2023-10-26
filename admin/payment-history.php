<?php
$page = "history";
$title = "Payment History";

include './partials/header.php';
include "../php/filter-function.php";



//fetch all forms from database
// $query = "SELECT * FROM registered_subjects ORDER BY id DESC LIMIT 5";
// $subjects = mysqli_query($dbconnect, $query);


?>

<section class="dashboard">
    
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <?php include './partials/aside.php' ?>
        
        <main id="report">
            <h2>Payment History</h2>
            <!--<form action="" enctype="multipart/form-data" method="POST">-->

                <div class="report">
                    <table id="madmin_tb">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Year/Session</th>
                                <th>Registered Courses</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                            $current_user_id = $_SESSION['id'];

                            $user_query = "SELECT *  FROM registered_subjects WHERE student_id = $current_user_id ";
                            $user_result = mysqli_query($dbconnect, $user_query);
                        if (mysqli_num_rows($user_result) > 0) {
                            while($student = mysqli_fetch_assoc($user_result)){
                                    $current_reg_id = $student['id'];
                                      ?>
                            <tr>
                                <td><?= $student['date_time'] ?></td>
                                <td><?= $student['session'] ? 'MAY/JUNE' : 'OCT/NOV' ?></td>
                                <td><?= $student['subject'] ?></td>
                                <td><?= $student['amount'] ?></td>
                                <td><?= $student['payment_status'] ?></td>
                                <td>
                                    <?php if ($student['payment_status'] = 'pending') : ?>
                                    <a href="../php/delete-reg.php?reg-id=<?= $current_reg_id ?>" class="re-reg" name="re-reg">Re-register</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                                 <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No History Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <br><br><br>
                    <div>
                        <p>If your payment status shows <b>pending</b> due to insuccessful payment, please try the following options:</p>
                        <ol>
                            <li>1. Repeat the registration process again by selecting the same subject as previous and proceed to the payment page</li><br>
                            <li>2. If you choose to edit your unpaid registered subjects, <b> you can do that by clicking on re-register.</b> </li>
                        </ol>
                    </div>
                </div>
        </main>
        
    </div>
</section>

<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>