<?php
// fetch post from database if id is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($dbconnect, $query);
    $post = mysqli_fetch_assoc($result);

}else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}

$title = $post['title'];

include "./partials/header.php";

?>

<!-- ********************  POST Section *********************** -->

<section class="singlepost">
    <div class="container singlepost_container">
        <h2><?= $post['title'] ?></h2>
        <div class="post_author">
            <div class="post_author_info">
                <small><?= date("M, d, Y - H:i", strtotime($post['date_time']))?></small>
            </div>
        </div>
        <div class="singlepost_thumbnail">
            <img src="./img/thumbnail/<?= $post['post_thumbnail'] ?>" alt="">
        </div>
        <p class="notice_body"><?= $post['body'] ?></p>
    </div>
</section>

<!-- ******************** End of POST Section *********************** -->


<?php
    include "./partials/footer.php";
    ?>