<?php
$page = "registered";
$title = "Registered Subjects";

include './partials/header.php';



$current_user_id = $_SESSION['id'];

// fetch Subject Registered from registered table 
$fetch_subjects_query = "SELECT subject_id FROM registered_subjects Where student_id = $current_user_id AND payment_status = 'success'";
$fetch_subject_result = mysqli_query($dbconnect, $fetch_subjects_query);
$subject_ids = mysqli_fetch_assoc($fetch_subject_result);



?>

<section class="dashboard">
    <?php if (isset($_SESSION['register-success'])) : ?>
        <div class="alert_message success">
            <p> <?= $_SESSION['register-success'];
                unset($_SESSION['register-success']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <?php include './partials/aside.php' ?>
        <main>
            <h2>Registered Subjects</h2>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Subject</th>

                    </tr>
                </thead>
                <tbody id="reg">
            <?php
                    if (mysqli_num_rows($fetch_subject_result) > 0) {
                            $subjectId_array = $subject_ids['subject_id'];
                            $sub_ids = explode(',', $subjectId_array);
                                foreach ($sub_ids as $item) {
                                    $query = "SELECT subject, subject_code FROM subjects WHERE id = $item";
                                    $subject_result = mysqli_query($dbconnect, $query);

                                    while ($subject = mysqli_fetch_assoc($subject_result)) {
                            ?>
                                        <tr>
                                            <td><?= $subject['subject_code'] ?></td>
                                            <td><?= $subject['subject'] ?></td>

                                        </tr>
                                <?php    }
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="2" style="text-align:center;">No Subject Registered yet</td>
                                </tr>
                            <?php
                            }
                            ?>
                </tbody>
            </table>
            <br><br>
            <a href="invoice.php?id=<?= $current_user_id?>&page='reg'" class="btn btn-success">Print Invoice</a>
        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>