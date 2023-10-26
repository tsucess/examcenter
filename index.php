<?php
$title = "Seven skies IGCSE Exam Registration Center";
$page = "home";

include './partials/header.php';


// fetch data from database 
$post_query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 3";
$post_result = mysqli_query($dbconnect, $post_query);



// fetch 3 posts from posts table
$query = "SELECT * FROM subjects ORDER BY date_time DESC ";
$subjects = mysqli_query($dbconnect, $query);

?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section class="dashboard" hidden>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
    </div>
</section>



<!-- ******************** Start OF Carousel Section *********************** -->

<!doctype html>

  <body>

<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  <div class="carousel-item active" data-bs-interval="5000">
      <img src="./img/image1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="./img/image2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="./img/image3.jpeg" class="d-block w-100" alt="...">
    </div>
   
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</html>

<!--<section class="carousel">
    <div class="carousel_container">
        <div class="carousel_image fade">
            <img src="./img/img1.jpeg" alt="">
        </div>
        <div class="carousel_image fade">
            <img src="./img/img2.jpeg" alt="">
        </div>
        <div class="carousel_image fade">
            <img src="./img/img3.jpeg" alt="">
        </div>

        <!--
            <div class="carousel_image fade">
                <img src="./img/image5.jpg" alt="">
            </div>
            <div class="carousel_image fade">
                <img src="./img/image6.jpg" alt="">
            </div>
            -->
       <!-- <i id="prev" onclick="showImage(-1)" class="fa-solid fa-angle-left"></i>
        <i id="next" onclick="showImage(1)" class="fa-solid fa-angle-right"></i>

    </div>
</section>
-->
<!-- ******************** End OF Carousel Section *********************** -->

<br>
<h2 class="heading" style="color:var(--color-gray-700)">Why choose our centre?</h2>
<div class="card-group">
      <div class="card">
        <img src="./img/env.png" class="card-img-top" alt="...">
    
        <div class="card-body">
          <h5 class="card-title">Conducive environment</h5>
          <p class="card-text">Sitting for an exam in a conducive and stress-free envrionment is the key to success. We provide well-equipped exam classrooms and halls
          with facilities to make students feel comfortable during their examinations.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated few mins ago</small>
        </div>
      </div>
      <div class="card">
        <img src="./img/money.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Affordable centre fee</h5>
          <p class="card-text">We provide affordable fees compared to other. Upon that, we have an early bird RM100 discount
          on every subject registered.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated few mins ago</small>
        </div>
      </div>
      <div class="card">
        <img src="./img/stress.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Stress free registration</h5>
          <p class="card-text">You can make your registration and payment by contacting our exams officer directly through the  number provided.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated few mins ago</small>
        </div>
      </div>
    </div>

<!--    End of Card  -->

<!-- ********************  Course Section *********************** -->

<section class="courses" style="background-color:var(--color-gray-700)">
    <h2 class="heading" style="color:#ffffff">IGCSE subjects and components offered</h2>

<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
       Languages
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"> 
      
        - First Language English (0500) - CU Paper 2, Paper 3<br>
        - English as Second Language (0510) - AY Core, EY Extended <br>
        - Malay (0546) - Z Paper 2, speaking, paper 4
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Mathematics
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        - Mathematics (0580) - AZ Core, BZ Extended <br>
        - Additional Mathematics (0606) - AY Paper 1, Paper 2 <br>
      </div>
  </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Sciences
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      - Biology (0610) - GY Core, CY Extended<br>
      - Chemistry (0620) - GY Core, CY Extended<br>
      - Physics (0625) - GY Core, CY Extended
      </div>
  </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
        Commerce
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      - Business Studies (0450) - AY Paper 1, Paper 2<br>
      - Accounting (0452) - AY Paper 1, Paper 2<br>
      - Economics (0455) - Y Paper 1, Paper 2
      </div>
  </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFive">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
        Others
      </button>
    </h2>
    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      - Islamiyat (0610) - AY Paper 1, Paper 2<br>
      - ICT (0417) - Paper 1, Practical test 2 & 3
      </div>
  </div>
</div>
</section>
<!--<section class="courses">
    <h2 class="heading">Available subjects</h2>
    <div class="slider-wrap">
        <div class=" courses_container">
            <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                <article id="course" class="courses_image">
                    <div class="course_thumbnail">
                        <img src="./img/thumbnail/<?= $subject['thumbnail'] ?>">
                    </div>
                    <div class="course_info">
                        <form action="<?= ROOT_URL ?>php/reg-redirect-logic.php" method="POST">
                            <input type="submit" name="submit" class="category_button" value="Register">
                        </form>
                        <h3 class="course_title">
                            <p><?= $subject['subject'] ?></p>
                        </h3>
                        <p class="course_body">
                            <b>Registration Period:- </b> <?= $subject['start_date'] ?> To: <?= $subject['end_date'] ?>
                        </p>
                    </div>
                </article>
            <?php endwhile ?>
            <i id="prev_course" onclick="prev()" class="fa-solid fa-angle-left"></i>
            <i id="next_course" onclick="next()" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</section>

<script>
    let commCards = document.querySelector(".courses_container");
    let item = commCards.getElementsByClassName("courses_image");

    function next() {
        commCards.append(item[0]);
    }

    function prev() {
        commCards.prepend(item[item.length - 1]);
    }
</script>

<!-- ******************** End OF POST Section *********************** -->



<section class="notice">
    <h2 class="heading">Notice Bulletin</h2>
    <div class="container notice_container">
        <?php while ($post = mysqli_fetch_assoc($post_result)) : ?>
            <article class="post">
                <div class="notice_thumbnail">
                    <img src="./img/thumbnail/<?= $post['post_thumbnail'] ?>">
                </div>
                <div class="notice_info">
                    <h3 class="notice_title heading"> <a href="<?= ROOT_URL ?>single-post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
                    <p class="notice_body"><?= substr($post['body'], 0, 100) ?>...</p>
                    
                    <div class="post_author">
                        <div class="post_author_info">
                            <small><?= date("M, d, Y - H:i", strtotime($post['date_time'])) ?></small>
                        </div>
                    </div>
                    <a href="<?= ROOT_URL ?>single-post.php?id=<?= $post['id'] ?>" class="category_button">Read more</a>
                </div><br />
            </article>
        <?php endwhile ?>
    </div>
</section>

<!-- ******************** End OF Notice Bulletin SECTION ***********************-->

<!--Section: Contact v.2-->

<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

 

        <!--Grid column-->
        <div id="contact"></div>
<section class="contact">
    <div class="container contact_form">
        <!--<h2 class="heading">Contact us</h2>-->
        <form action="mail.php" method="POST">
            
            <input type="text" name="name" class="field" placeholder="Please enter your name" required>
            <input type="text" name="number" class="field" placeholder="Please enter your phone number" required>
            <input type="text" name="email" class="field" placeholder="Please enter your email">
            <textarea name="message" class="field" id="" cols="30" rows="10" placeholder="Please drop your message. We will reply to you as soon as possible."></textarea>
            
            <input type="submit" name="submit" class="contactbtn" value="Submit">
            <!-- <a href="add-notice.php" class="btn btn-edit">Submit</a> -->
        </form>
    </div>
        <!--Grid column-->

        <!--Grid column
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>2, Jalan Electron U16/68, Denai Alarm, 40160 Shah Alarm, Selangor.</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+60 10-305 1952 | +60 19-483 0890</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>admin@sevenskies.edu.my | examsofficer@sevenskies.edu.my</p>
                </li>
            </ul>
        </div>
        Grid column-->

    

</section>


<!--Section: Contact v.2-->

<!--
<div id="contact"></div> <br> <br>
<section class="contact">
    <div class="container contact_form">
        <h2 class="heading">Contact Us</h2>
        <form action="./php/mail.php" method="POST">
            
            <input type="text" name="name" class="field" placeholder="Please enter your name" required>
            <input type="text" name="number" class="field" placeholder="Please enter your phone number" required>
            <input type="text" name="email" class="field" placeholder="Please enter your email">
            <textarea name="message" class="field" id="" cols="30" rows="10" placeholder="Please drop your message. We will reply to you as soon as possible."></textarea>
            
            <input type="submit" name="submit" class="field btn btn-edit" value="Submit" placeholder="Enter Email">
            <!-- <a href="add-notice.php" class="btn btn-edit">Submit</a> 
        </form>
    </div>
</section>

<!-- ******************** End OF CONTACT SECTION *********************** -->


<script src="./js/carousel.js"></script>
<?php
include './partials/footer.php';
?>