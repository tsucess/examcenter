<?php
$page = "reports";
$title = "Reports";


include './partials/header.php';
include "../php/filter-function.php";

?>

<section class="dashboard">
    <?php if (isset($_SESSION['select'])) : // shows if edit post was Not successful 
    ?>
        <div class="alert_message error container">
            <p> <?= $_SESSION['select'];
                unset($_SESSION['select']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['register'])) : // shows if Register subject post was Not successful 
    ?>
        <div class="alert_message error container">
            <p> <?= $_SESSION['register'];
                unset($_SESSION['register']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <?php include './partials/aside.php' ?>
        <main id="report">
            <h2>Report</h2>
            <form action="" id="filreport" enctype="multipart/form-data" method="POST">
                <div class="control">
                    <!-- <div class="form_control">
                        <button name="submit" class="btn-lg">Print Report</button>
                    </div> -->
                    <div class="form_control rep">
                        <select name="filter" id="filter">
                            <option value="" disabled hidden selected>FILTER</option>
                            <option value="default">ALL</option>
                            <option value="year">YEAR ONLY</option>
                            <option value="yearsession">YEAR AND SESSION</option>
                            <option value="others">OTHERS</option>
                        </select>
                    </div>
                </div>
                <div class="control">
                    <div class="form_control">
                        <select name="year" class="rep" id="years">
                            <option value="null">YEAR</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2020">2020</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                        </select>

                    </div>
                    <div class="form_control">
                        <select name="session" class="rep" id="sessions">
                            <option disabled hidden selected>SESSION</option>
                            <option value="1">MAY/JUNE</option>
                            <option value="0">OCT/NOV</option>
                        </select>
                    </div>

                </div>
                <div class="control">
                    <div class="form_control">
                        <select name="others" class="rep" id="others">
                            <option disabled hidden selected>OTHERS</option>
                            <option value="success">SUCCESSFUL APPLICANTS</option>
                            <option value="pending">PENDING APPLICATIONS</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="report" id="report-section">
                <h2>Registered Students</h2>
                <table id="madmin_tb">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Year/Session</th>
                            <th>Name</th>
                            <th>Registered Courses</th>
                            <th>Payment Status</th>

                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <?php

                        $subjects = getAllData();
                        if ($subjects) {
                            foreach ($subjects as $subject) {

                                $student_id = $subject['student_id'];

                                $user_query = "SELECT firstname, lastname FROM users WHERE id = $student_id";
                                $user_result = mysqli_query($dbconnect, $user_query);
                                $student = mysqli_fetch_assoc($user_result);
                        ?>
                                <tr>
                                    <td><?= $subject['date_time'] ?></td>
                                    <td><?= $subject['session'] ? 'MAY/JUNE' : 'OCT/NOV' ?></td>
                                    <td><?= "{$student['firstname']} {$student['lastname']}" ?></td>
                                    <td><?= $subject['subject'] ?></td>
                                    <td><?= $subject['payment_status'] ?></td>
                                </tr>
                            <?php
                            }
                        } else {

                            ?>
                            <tr>
                                <td colspan="7"> No Student Registered</td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <br><br>
            <button class="btn btn-success" onclick="window.print()">Print Report</button>
        </main>
    </div>
</section>

<!-- ******************** End OF FORM SECTION *********************** -->






<!-- <script src="../js/filter.js"></script> -->
<script src="../js/report.js"></script>
<?php
include '../partials/footer.php';
?>