<?php
if (isset($_COOKIE["auth"])){
  if ($_COOKIE["auth"] == ""){
    $isLoggedIn = false;
  } else {
    $isLoggedIn = true;
  }
} else {
  $isLoggedIn = false;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Food Circle</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="images.png" />
        <!-- SlideShow-->
        <link rel="stylesheet" href="1css/style.css">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="1css/styles.css" rel="stylesheet" />





    </head>
    <body id="page-top">
    <!-- php for retrieve descriptions and pictures-->
    <?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="project";
    $conn=new mysqli($servername,$username,$password,$dbname);

    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
        }
        else{
        "connected";
        }


        // we must change restaurant_id to its proper id.



    ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="images.png" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/project/RestaurantREL/allrestaurant.php">Restaurants</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact us</a></li>
                        <?php if ($isLoggedIn == false){
                          echo '<li class="nav-item"><a class="nav-link" href="/project/LoginPage/lrform.php">Login</a></li>';
                        } else {
                          echo '<li class="nav-item"><a class="nav-link" href="/project/LoginPage/signout.php">Sign out</a></li>';
                        }
                         ?>


                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To Food circle</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>

            </div>


        </header>
        <section class="page-section">
            <h1 id="top5">Top 5 Restaurants!</h1>
        </section>
        <section style="height: 700px; padding-left: 15%; padding-right: 15%; background-color: rgb(30,30,30);" id="slideshow">
            <!--slide show-->
            <div class="slidershow middle">

                <div class="slides">

                    <input type="radio" name="r" id="r1" checked="">
                    <input type="radio" name="r" id="r2">
                    <input type="radio" name="r" id="r3">
                    <input type="radio" name="r" id="r4">
                    <input type="radio" name="r" id="r5">
                    <?php
                    $sql="SELECT restaurant_id, AVG(rating) AS avg FROM ratings GROUP BY restaurant_id ORDER BY avg DESC";
                    $rs1 = mysqli_query($conn,$sql);
                    $counter = 0;
                    while($row = mysqli_fetch_array($rs1)){
                      $res_id = $row["restaurant_id"];
                      $photo_sql = "SELECT photo FROM photos  WHERE restaurant_id = $res_id";
                      $sql= "SELECT * FROM restaurants WHERE restaurant_id = $res_id";
                      $row =  mysqli_fetch_array(mysqli_query($conn,$sql));
                      $picture =  mysqli_fetch_array(mysqli_query($conn,$photo_sql))[0];
                        if ($counter == 0){
                          echo '<div class="slide s1" style="position: relative">';
                          echo '<img style="width: 1600px; height: 720px;" src="data:image;base64,' . base64_encode($picture) . '"/>';
                          echo '<div class="top-left" style="padding: 15px;">';
                          echo $row["name"] . '<br>'.$row["description"];
                          echo '<form action="/project/RestaurantREL/restaurant.php" method="post">';
                          echo '<button type="submit" class="btn btn-light btn-sm">Visit Restaurant</button>';
                          echo '<input name="id" value="'.$res_id.'" hidden>';
                          echo '</form></div></div>';
                        } else {
                          echo '<div class="slide" style="position: relative;">';
                          echo '<img style="width: 1600px; height: 720px;" src="data:image;base64,' . base64_encode($picture) . '"/>';
                          echo '<div class="top-left" style="padding: 15px;">';
                          echo $row["name"] . '<br>'.$row["description"];
                          echo '<form action="/project/RestaurantREL/restaurant.php" method="post">';
                          echo '<button type="submit" class="btn btn-light btn-sm">Visit Restaurant</button>';
                          echo '<input name="id" value="'.$res_id.'" hidden>';
                          echo '</form></div></div>';
                        }
                        $counter++;
                    }
                    $conn->close();

                     ?>
                </div>

                <div class="navigation">
                    <label for="r1" class="bar"></label>
                    <label for="r2" class="bar"></label>
                    <label for="r3" class="bar"></label>
                    <label for="r4" class="bar"></label>
                    <label for="r5" class="bar"></label>
                </div>
            </div>
        </section>




        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">We are happy to help you</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
                </form>
            </div>
        </section>

        <!-- Footer-->
        <footer class="footer py-4" style="background-color: black; color: gray">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Food circle</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!" style="color: gray">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!"  style="color: gray">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Bootstrap core JS-->

        <!-- Core theme JS-->
        <script src="1js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script></div>
                    </div>


    </body>
</html>
