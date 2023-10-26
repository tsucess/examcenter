<?php
$page = "courses";
$title = "Available Courses";

include './partials/header.php';



if (isset($_SESSION['user_is_admin'])) {

    //fetch all subjects from database
    $query = "SELECT id, subject, subject_code, start_date, end_date, fee FROM subjects ORDER BY id DESC";
    $subjects = mysqli_query($dbconnect, $query);
}


$charges_query = "SELECT * FROM charges ORDER BY id DESC ";
$charges_result = mysqli_query($dbconnect, $charges_query);

if (mysqli_num_rows($charges_result) > 0) {
    $charges_fee = mysqli_fetch_assoc($charges_result);
    $admin_fee = $charges_fee['admin_fee'];
} else {
    $admin_fee = 0;
}

?>

<section class="dashboard">
                <div class="error-txt container"></div>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <?php include './partials/aside.php' ?>

        <main>
            <div class="form_control">
                <div class="form_control">
                    <h2>Registeration Section</h2>
                </div>
                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                    <div class="control">
                        <div class="form_control">
                            <button id="add-course" class="btn-lg">Add Subject</button>
                        </div>
                        <div class="form_control">
                            <a href="manage-charges.php" id="manage-coupon" class="btn-lg">Manage Coupon</a>
                        </div>
                </div>
            <?php endif ?>
            </div>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <table class="tb-courses">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Code</th>
                            <th>Duration</th>
                            <th>Fee (MYR)</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($subjects) > 0) : ?>
                            <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                                <?php
                                $_SESSION['rowId'] = $subject['id'];
                                ?>
                                <tr>
                                    <td><?= $subject['subject'] ?></td>
                                    <td><?= $subject['subject_code'] ?></td>
                                    <td><b>From:</b> <?= $subject['start_date'] ?> <br><b>To:</b> <?= $subject['end_date'] ?></td>
                                    <td><?= $subject['fee'] ?>.00</td>
                                    <td><button id="<?= $subject['id'] ?>" name="edit-btn" class=" edit-course edtBtn">Edit</button></td>
                                    <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-course.php?id=<?= $subject['id'] ?>" class="btn sm danger">Delete</a></td>
                                </tr>
                            <?php endwhile ?>
                            
                            <tr>
                            <td colspan="6"> Admin Fee:  <?=  $admin_fee ?> (MYR)</td>
                            </tr>
                        <?php else :  ?>
                            <tr>
                                <td colspan="6"> No Subject uploaded</td>
                            </tr>
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                            <?php endif  ?>
                        </tbody>
                </table>  
                <br>      
                          
                     <?php else :  ?>
                                
            <form action="<?= ROOT_URL ?>admin/summary.php" id="reg_form" method="POST">
                        <div class="control" id="">
                            <div class="form_control">
                                <label for="">Are you currently a Sevenskies Student?</label>
                                <select name="current_student" id="current_student" class="reg_form">
                                    <option disabled hidden selected>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form_control">
                                <label for="">Are you a Fresh Candidate or Re-Sit?</label>
                                <select name="fresh_candidate" id="fresh_candidate" class="reg_form">
                                    <option disabled hidden selected>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="control" id="prev_candidate_details">
                            <div class="form_control">
                                <input type="text" name="prev_center_no" id="prev_center_no" class="reg_form" value="" placeholder="Enter Previous Center Number">
                            </div>
                            <div class="form_control">
                                <input type="text" name="prev_candidate_no" id="prev_candidate_no" class="reg_form" value="" placeholder="Enter Previous Candidate No.">
                            </div>
                        </div>
                        <div class="control" id="">
                            <div class="form_control">
                                <input type="text" name="student_id" id="student_id" class="reg_form" value="" placeholder="Student's ID Number">
                            </div>
                            <div class="form_control">
                                <input type="text" name="sch_name" id="sch_name" class="reg_form" value="" placeholder="Enter School Name">
                            </div>
                        </div>
                        <div class="control" id="">
                            <div class="form_control">
                                <input type="text" name="student_number" class="reg_form" value="" placeholder="Enter Student's Number" required>
                            </div>
                            <div class="form_control">
                                <input type="email" name="student_email" class="reg_form" value="" placeholder="Enter Student's Email" required>
                            </div>
                        </div>
                        
                        <div class="control" id="">
                            <div class="form_control">
                                <input type="text" name="parent_number" class="reg_form" value="" placeholder="Enter Parent's Number" required>
                            </div>
                            <div class="form_control">
                                <input type="email" name="parent_email" class="reg_form" value="" placeholder="Enter Parent's Email" required>
                            </div>
                        </div>

                        <div class="control" id="session_year">
                            <div class="form_control">
                                <label for="">SESSION</label>
                                <select name="session" class="reg_form">
                                    <option disabled hidden selected>Select</option>
                                    <option value="1">MAY/JUNE</option>
                                    <option value="0">OCT/NOV</option>
                                </select>
                            </div>
                            <div class="form_control">
                                <label>YEAR</label>
                                <select name="year" class="reg_form">
                                    <option disabled hidden selected>Select</option>
                                    <option value="2023">2022</option>
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
                        </div>
                        <marquee behavior="alternate" direction="left">
                            <p id="note"><b>Note:- </b> 100 (MYR) discount on each subject for all Sevenskies Students .... </p>
                        </marquee>
                    <table class="tb-courses">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Code</th>
                                <th>Duration</th>
                                <th>Fee (MYR)</th>
                                <th><input type="checkbox" onchange="checkAll(this)" class="checkboxes" id="markall"> <br> <label for="markall">Select</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($subjects) > 0) : ?>
                                <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                                    <tr>
                                        <td><?= $subject['subject'] ?></td>
                                        <td><?= $subject['subject_code'] ?></td>
                                        <td><b>From:</b> <?= $subject['start_date'] ?> <br><b>To:</b> <?= $subject['end_date'] ?></td>
                                        <td><?= $subject['fee'] ?>.00</td>
                                        <td><label for="<?= $subject['id'] ?>"></label> <input type="checkbox" name="subjects[]" class="checkboxes" value="<?= $subject['id'] ?>"></td>
                                    </tr>
                                <?php endwhile ?>

                                <tr>
                                    <td colspan="3">Admin Fee: <?= $admin_fee ?> (MYR)</td>
                                    <?php 
                                    $_SESSION['admin_fee'] = $admin_fee;
                                    ?>
                                    <td colspan="2"> <input class="btn-lg" type="submit" name="submit" value="Register"></td>
                                </tr>
                            <?php else :  ?>
                                <tr>
                                    <td colspan="5"> No forms uploaded</td>
                                </tr>
                            <?php endif  ?>
                        </tbody>
                    </table>
                    <?php endif  ?>
            </form>

        </main>
    </div>
</section>

<script>
    let checkboxes = document.querySelectorAll(".checkboxes");

    function checkAll(markAll) {
        if (markAll.checked == true) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }
</script>

<!-- ******************** End OF AVAILABLE COURSES SECTION *********************** -->

<div id="modal-edit-inactive"></div>
<div id="modal-add">
    <section class="form_section add-course-form">
        <div class="container form_section-container">
            <h2>Add Subject</h2>
            <?php if (isset($_SESSION['add-subject'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-subject'];
                        unset($_SESSION['add-subject']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="text" name="subject" value="" placeholder="Subject Title">
                <input type="text" name="subjectcode" value="" placeholder="Code">
                <div class="control">
                    <div class="form_control">
                        <label for="thumbnail">Start Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id name="start_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="form_control">
                        <label for="thumbnail">End Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id name="end_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                </div>
                <input type="text" name="fee" value="" placeholder="Fee">
                <div class="form_control">
                    <label for="thumbnail">Add Course Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="control">
                    <button name="cancel" id="cancel-add" class="btn-lg">Cancel</button>
                    <button type="Submit" name="submit" id="save" class="btn-lg">Add New Subject</button>
                </div>

            </form>
        </div>
    </section>
</div>

<div id="modal-edit">
    <section class="form_section edit-course-form">
        <div class="container form_section-container">
            <h2>Edit Subject</h2>
            <?php if (isset($_SESSION['edit-subject'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['edit-subject'];
                        unset($_SESSION['edit-subject']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form id="edit-subject-form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="" id="edit_id" placeholder="Subject Id">
                <input type="hidden" name="prev_thumbnail_name" value="" id="edit_thumbnail" placeholder="Prev thumbnail">

                <input type="text" name="subject" value="" id="edit_subject" placeholder="Subject Title">
                <input type="text" name="subjectcode" value="" id="edit_subjectcode" placeholder="Code">
                <div class="control">
                    <div class="form_control">
                        <label for="thumbnail">Start Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id="start_date" name="start_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="form_control">
                        <label for="thumbnail">End Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id="end_date" name="end_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                </div>
                <input type="text" name="fee" value="" id="edit_fee" placeholder="Fee">
                <div class="form_control">
                    <label for="thumbnail">Edit Course Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="control">
                    <button id="cancel-edit" name="" class="btn-lg">Cancel</button>
                    <button type="submit" id="update" class="btn-lg">Update Subject</button>
                </div>
            </form>
        </div>
    </section>
</div>




<?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
    <script src="../js/add-course.js"></script>
    <script src="../js/edit-course.js"></script>
    <?php else: ?>
    <script src="../js/reg-form.js"></script>
    <?php endif?>
<?php
include '../partials/footer.php';
?>