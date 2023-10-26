<?php
$page = "forms";
$title = "Forms";

include './partials/header.php';
require "../php/all-filter-func.php";



if (isset($_SESSION['user_is_admin'])) {
		$current_user_id = $_SESSION['id'];

	if (isset($_GET['id'])) {
		$user_id = $_GET['id'];
		if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) {
			$query = "SELECT * FROM forms WHERE receiver = '$user_id' ORDER BY id DESC";
			$forms = mysqli_query($dbconnect, $query);
		}
	}

}





?>

<section class="dashboard">
    <?php if (isset($_SESSION['edit-form'])) : // shows if edit post was Not successful 
    ?>
        <div class="alert_message error container">
            <p> <?= $_SESSION['edit-form'];
                unset($_SESSION['edit-form']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="error-txt container"></div>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <?php include './partials/aside.php' ?>
        <main>
        <div class="control">
            <div class="form_control">
                <h2>Available Forms</h2>
            </div>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
            <div class="form_control d-flex align-items-end">
                <a href="forms.php" class=" btn btn-warning px-5 me-5">Back</a>
            </div>
            <?php endif ?>
        </div>
            <button id="add-form" class="btn btn-success">Upload Form</button>
            <br><br><table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Download</th>
                        <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                            <th>Edit</th>
                            <th>Delete</th>
                        <?php endif  ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($forms) > 0) : ?>
                        <?php while ($form = mysqli_fetch_assoc($forms)) { 
                                    ?>
                            <tr>
                                <td><?= $form['date_time'] ?></td>
                                <td><?= $form['title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>php/download-form.php?id=<?= $form['id'] ?>" target="_blank" class="btn btn-success">Download</a></td>
                                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                                    <td><button id="<?= $form['id'] ?>" name="edit-fomr-btn" class="edit-document-btn edtBtn">Edit</button></td>
                                    <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-form.php?id=<?= $form['id'] ?>" class="btn sm danger">Delete</a></td>
                                <?php endif  ?>
                            </tr>
                        <?php } ?>
                    <?php else :  ?>
                        <tr>
                            <td colspan="5"> No forms uploaded</td>
                        </tr>
                    <?php endif  ?>

                </tbody>
            </table>

        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->


<!-- ******************** UPLOAD AND EDIT FORM SECTION *********************** -->
<div id="modal-edit-inactive4"></div>
<div id="modal-edit-form4">
    <section class="form_section ">
        <div class="container form_section-container">
            <h2>Edit Form Document</h2>
            <form action="" id="edit-document-form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="" id="edit_id" placeholder="Subject Id">
                <input type="hidden" name="prev_form_name" value="" id="form_thumbnail" placeholder="Prev thumbnail">

                <div class="form_control">
                    <label for="thumbnail">Update Document</label>
                    <input type="file" name="document" id="thumbnail">
                </div>
                <input type="text" name="title" value="" id="form_title" placeholder="Title">
                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <div class="form_control">
                    <select name="student" id="students">
                        <option disabled hidden selected>STUDENTS</option>
                        <option value="all">ALL</option>
                        <?php

                        $usersOption = getAllStudData();

                        if ($usersOption) {
                            foreach ($usersOption as $users) {
                        ?>
                                <option value="<?= $users['id']?>"><?= "{$users['firstname']} {$users['lastname']}" ?></option>
                            <?php
                            }
                        } else {
                            ?>
                            <option value="">No Student Registered</option>
                        <?php
                        }

                        ?>
                    </select>
                </div>
                <?php endif ?>
                <div class="control">
                    <button id="cancel-edit-form" class="btn-lg">Cancel</button>
                    <button type="submit" name="submit" id="update-form" class="btn-lg">Update Form</button>
                </div>

            </form>
        </div>
    </section>
</div>

<div id="modal-add-form4">
    <section class="form_section add-document-form">
        <div class="container form_section-container">
            <h2>Upload Document</h2>
            <?php if (isset($_SESSION['add-form'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-form'];
                        unset($_SESSION['add-form']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form enctype="multipart/form-data">
                <div class="form_control">
                    <label for="thumbnail">Select Document</label>
                    <input type="file" name="document" id="thumbnail">
                </div>
                <input type="text" name="title" value="" placeholder="Title">
                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <div class="form_control">
                    <select name="student" id="students">
                        <option disabled hidden selected>STUDENTS</option>
                        <option value="all">ALL</option>
                        <?php

                        $usersOption = getAllStudData();

                        if ($usersOption) {
                            foreach ($usersOption as $users) {
                        ?>
                                <option value="<?= $users['id']?>"><?= "{$users['firstname']} {$users['lastname']}" ?></option>
                            <?php
                            }
                        } else {
                            ?>
                            <option value="">No Student Registered</option>
                        <?php
                        }

                        ?>
                    </select>
                </div>
                <?php endif ?>
                <div class="control">
                    <button name="cancel" id="cancel-form" class="btn-lg">Cancel</button>
                    <button type="Submit" name="submit" id="save-form" class="btn-lg">Upload New Form</button>
                </div>

            </form>
        </div>
    </section>
</div>

<!-- ******************** UPLOAD AND EDIT FORM SECTION *********************** -->
<?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
    <script src="../js/edit-form.js"></script>
<?php endif ?>
    <script src="../js/add-form.js"></script>
<?php
include '../partials/footer.php';
?>