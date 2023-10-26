<?php
$page = "posts";
$title = "Manage Posts";

include './partials/header.php';


//fetch all forms from database
$query = "SELECT id, title, date_time,is_featured FROM posts ORDER BY id DESC";
$posts = mysqli_query($dbconnect, $query);


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
            <h2>Bulletin</h2>
            <a href="add-notice.php" class="btn btn-success">Add Notice</a>
            <br>
            <!-- <br> -->
            <table class="mt-3">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Featured</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                        <tr>
                            <td><?= $post['date_time'] ?></td>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['is_featured'] ? 'YES' : 'NO' ?></td>
                            <td><button id="<?= $post['id'] ?>" name="edit-fomr-btn" class="edit-post-btn edtBtn">Edit</button></td>
                            <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger">Delete</a></td>

                        </tr>
                    <?php endwhile ?>

                </tbody>
            </table>

        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->


<!-- ******************** UPLOAD AND EDIT FORM SECTION *********************** -->
<div id="modal-edit-inactive5"></div>
<div id="modal-edit-post5">
    <section class="form_section">
        <div class="container form_section-container">
            <h2>Add Notice</h2>
            <?php if (isset($_SESSION['add-post'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-post'];
                        unset($_SESSION['add-post'])
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form id="edit-document-post" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" id="edit_id" placeholder="edit">
                <input type="hidden" name="prev_thumbnail_name" id="prev_thumbnail_name" placeholder="edit">

                <input type="text" name="title" id="title" placeholder="Title">
                <textarea rows="10" name="body" id="body" placeholder="Body"></textarea>
                <div class="form_control">
                    <label for="thumbnail">Upload Thumbnail</label>
                    <input type="file" id="thumbnail" name="thumbnail" id="thumbnail">
                </div>
                <div class="form_control inline">
                    <input type="checkbox" name="is_featured" value="" id="is_featured">
                    <label for="is_featured">Featured</label>
                </div>
                <div class="control">
                    <button name="cancel" id="cancel-edit-post" class="btn-lg">Cancel</button>
                    <button type="submit" name="submit" id="update-post" class="btn-lg">Update Post</button>
                </div>

            </form>
        </div>
    </section>
</div>



<!-- ******************** UPLOAD AND EDIT FORM SECTION *********************** -->
<script src="../js/edit-post.js"></script>
<!-- <script src="../js/add-form.js"></script> -->
<?php
include '../partials/footer.php';
?>