<?php
$page = "dashboard";
$title = "Dashboard";

include './partials/header.php';


$current_user_id = $_SESSION['id'];

// fetch Subject Registered from registered table 
$fetch_subjects_query = "SELECT subject_id FROM registered_subjects Where student_id = $current_user_id";
$fetch_subject_result = mysqli_query($dbconnect, $fetch_subjects_query);
$subject_ids = mysqli_fetch_assoc($fetch_subject_result);


?>

<section class="dashboard">
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <?php include './partials/aside.php' ?>
        <main class="user-dashbaord">
            <?php

            // fetch data from database 
            $post_query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 3";
            $post_result = mysqli_query($dbconnect, $post_query);


            ?>
            <h2>Dashboard</h2>
            <h2 id="title">Registered Subjects</h2>
            <div class="row dashboard">
                <div class="dashboard_cards">
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
                    </table>
                </div>
            </div>
            

        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc.1/dist/chartjs-plugin-datalabels.min.js" integrity="sha256-Oq8QGQ+hs3Sw1AeP0WhZB7nkjx6F1LxsX6dCAsyAiA4=" crossorigin="anonymous"></script>
<script src="../js/dashboardjs/chart.js"></script>
<?php
include '../partials/footer.php';
?>