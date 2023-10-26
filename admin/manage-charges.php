<?php
$page = "courses";
$title = "Manage Charges";

include './partials/header.php';


if (isset($_SESSION['user_is_admin'])) {

    //fetch all subjects from database
    $query = "SELECT id, subject, subject_code, start_date, end_date, fee FROM subjects ORDER BY id DESC";
    $subjects = mysqli_query($dbconnect, $query);
}


$charges_query = "SELECT * FROM charges ORDER BY id DESC ";
$charges_result = mysqli_query($dbconnect, $charges_query);

 

?>

<section class="dashboard">
                <div class="error-txt container"></div>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
		<?php include './partials/aside.php' ?>

        <main>
            <div class="form_control">
                <div class="control">
                    <div class="form_control">
                        <h2>Registeration Section</h2>
                    </div>
                    <div class="form_control d-flex align-items-end">
                        <a href="available-courses.php" class=" btn btn-warning w-50 me-5">Back</a>
                    </div>
                </div>
                <form id="charges-form" enctype="multipart/form-data" method="POST">
                    <div class="control-four" id="">
                        <div class="form_control">
                            <label for="">Enter Admin Fee</label>
                            <input type="text" name="admin_fee" class="charges" value="" placeholder="Type Admin Fee">
                        </div>
                        <div class="form_control">
                            <label for="">Create Coupon</label>
                            <input type="text" name="coupon_code" class="charges" value="" placeholder="Create Coupon">
                        </div>
                        <div class="form_control">
                            <label for="">Coupon Discount</label>
                            <input type="text" name="coupon_discount" class="charges" value="" placeholder="Coupon Discount">
                        </div>
                        <div class="form_control">
                            <label for="">Coupon Expiry Date</label>
                            <input type="date" name="exp_date" min="2022-12-01" placeholder="dd-mm-yyyy" class="charges" value="">
                        </div>
                    </div>
                    <div class="control">
                        <input class="btn-lg" type="Submit" id="charges-btn" name="submit">
                    </div>
                </form>
            </div>
                <br>      
                <table class="tb-courses">
                    <thead>
                        <tr>
                            <th>Copoun Code</th>
                            <th>Discount (MYR)</th>
                            <th>Expiry Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($charges_result) > 0) {
                       ?>
                            <?php while ($coupon = mysqli_fetch_assoc($charges_result)) : ?>
                            <tr>
                                <td><?= $coupon['coupon_code'] ?></td>
                                <td><?= $coupon['coupon_discount'] ?></td>
                                <td><?= $coupon['exp_date'] ?></td>
                                <td><button id="<?= $coupon['id'] ?>" name="edit-btn" class="edit-coupon edtBtn">Edit</button></td>
                                <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-charges.php?id=<?= $coupon['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                            <?php endwhile ?>

                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <?php  } else { 
                                
                                $admin_fee = 0; ?>
                            <tr>
                                <td colspan="5"> No Coupon Code Available</td>
                            </tr>
                            <tr>
                            <td colspan="5"></td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>   


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




<script src="../js/charges.js"></script>
<script src="../js/edit-coupon.js"></script>
<?php
include '../partials/footer.php';
?>