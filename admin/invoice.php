<?php
// $page = "invoice";
$title = "Invoice";
$page  = $_GET['page'];

include './partials/header.php';
if (isset($_GET['id'])) {
    $current_user_id = $_GET['id'];
}
else
{
    header("location: all-student-data.php");
}

// fetch Subject Registered from registered table 
$fetch_subjects_query = "SELECT subject_id, session, year FROM registered_subjects Where student_id = $current_user_id";


$fetch_subjects_query = "SELECT rs.*, u.firstname, u.lastname  FROM registered_subjects rs, users u WHERE u.id=student_id AND rs.student_id = $current_user_id";
$fetch_subject_result = mysqli_query($dbconnect, $fetch_subjects_query);
$subject_ids = mysqli_fetch_assoc($fetch_subject_result);

if ($_SESSION['admin_fee']) {
    $adminFee = $_SESSION['admin_fee'];
}
else
{
    $adminFee = 0;
}
?>

<section class="invoice_section" id="invoice-section">
    <div class="top_head">
        <img id="logo" src="<?= ROOT_URL ?>/img/logo.png" alt="logo">
        <h2 class="nav_logo">SEVEN SKIES IGCSE EXAM CENTER</h2>
    </div>
    <div class="container invoice_section-container">
        <div class="w-100 my-5 mx-auto">
            <div class="control">
                <h2>Invoice</h2>
                <div class="form-control">
                    <h5 class="text-dark">Year: <?= $subject_ids['year'] ?></h5>
                    <h5 class="text-dark">Session: <?= $subject_ids['session'] ? 'MAY/JUNE' : 'OCT/NOV' ?></h5>
                    <h5 class="text-dark">Students Name: <?= "{$subject_ids['firstname']} {$subject_ids['lastname'] }" ?></h5>
                </div>
                
            </div>
            <form action="">
                    <table class="table invoice">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Fee (MYR)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $subjectId_array = $subject_ids['subject_id'];
                            $sub_ids = explode(',', $subjectId_array);
                            $price = 0.0;
                            foreach ($sub_ids as $item) {
                                $query = "SELECT subject, subject_code, fee FROM subjects WHERE id = $item";
                                $subject_result = mysqli_query($dbconnect, $query);

                                while ($subject = mysqli_fetch_assoc($subject_result)) {
                            ?>
                                    <tr>
                                        <td><?= $subject['subject_code'] ?></td>
                                        <td><?= $subject['subject'] ?></td>
                                        <td><?= $subject['fee'] ?>.00</td>

                                    </tr>
                            <?php
                                    $price = $price + $subject['fee'];
                                }
                            }
                            
                            $price = $price + $adminFee;
                            ?>
                            <tr>
                                <td colspan="2"><b>Admin Fee</b></td>
                                <td><b><?= $adminFee ?>.00</b></td>

                            </tr>
                            <tr>
                                <td colspan="2"><b>Total</b></td>
                                <td><b><?= $price ?>.00</b></td>

                            </tr>
                        </tbody>

                    </table>
                    <div class="control buttons">
                        <a href="<?php if ($page === 'reg' ){ echo 'registered-courses.php'; }else{ echo 'all-student-data.php'; }?>" class="btn btn-lg btn-warning w-100">Cancel</a>
                        <button class="btn btn-lg btn-primary w-100" onclick="window.print()">Print Invoice</button>
                    </div>
            </form>
        </div>
    </div>
</section>
    


<script src="./js/main.js"></script>
</body>

</html>