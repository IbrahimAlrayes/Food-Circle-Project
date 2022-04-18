<?php
if (isset($_COOKIE["auth"])){
  if ($_COOKIE["auth"] == ""){
    echo $_COOKIE["auth"];
    $isLoggedIn = false;
  } else {
    $isLoggedIn = true;
  }
} else {
  $isLoggedIn = false;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Restaurant Page </title>
  <link rel="icon" type="image/x-icon" href="images.png" />
  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/carousel/">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Bootstrap core CSS -->

  <!-- Custom styles for this template -->
  <link href="carousel.css" rel="stylesheet">
  <link href="rating.css" rel="stylesheet">
  <link href="allRest.css" rel="stylesheet">
  <link href="1css/styles.css" rel="stylesheet">

  <!--Ahmed Suggested links-->
  <!-- Latest compiled and minified CSS -->
  <!-- SlideShow-->
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <!-- Google fonts-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="1js/scripts.js"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



  <!-- SlideShow-->

  <!-- Font Awesome icons (free version)-->
  <!-- Google fonts-->

  <!-- Core theme CSS (includes Bootstrap)-->

  <script>
    $(document).ready(function() {

      $("#decBtn").click(function() {
        $("#Menu").hide();
        $("#menuBtn").attr("class", "nav-link btn-lg");
        $("#Reviews").hide();
        $("#revBtn").attr("class", "nav-link btn-lg");
        $("#Description").show();
        $("#decBtn").attr("class", "nav-link active btn-lg");
      });

      $("#menuBtn").click(function() {
        $("#Description").hide();
        $("#decBtn").attr("class", "nav-link btn-lg");
        $("#Reviews").hide();
        $("#revBtn").attr("class", "nav-link btn-lg");
        $("#Menu").show();
        $("#menuBtn").attr("class", "nav-link active btn-lg ");
      });

      $("#revBtn").click(function() {
        $("#Menu").hide();
        $("#menuBtn").attr("class", "nav-link btn-lg");
        $("#Description").hide();
        $("#decBtn").attr("class", "nav-link btn-lg ");
        $("#Reviews").show();
        $("#revBtn").attr("class", "nav-link active btn-lg");
      });

    });
  </script>
  <!--GoogleMap-->
  <script src="googlemap.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>



</head>

<body id="page-top">
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "Project";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
  } else {
    "connected sucssefully";
  }
  ?>
  <!-- Here is the Heading .. we will replace it (include) the home Page Navbar-->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: black;" id="mainNav">
      <div class="container">
      <a class="navbar-brand" href="#page-top"><img src="images.png" height="40px" width="40px" alt="..." /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
            <li class="nav-item"><a class="nav-link" href="/project/HomePage/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="allrestaurant.php">Restaurants</a></li>
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

  </header>

  <!-- END OF NAVBAR-->
<br><br><br>

  <main role="main">
    <div id="myCarousel" class="carousel slide" style="width: 1920px;" data-ride="carousel">

      <div class="carousel-inner">
        <?php
        $res_id = $_POST["id"];

        // shall be changed to correct restaurant_id
        $sql = "SELECT * FROM photos WHERE restaurant_id = $res_id";
        $rs = mysqli_query($conn, $sql);

        // shall be changed to correct restaurant_id
        $sql2 = "SELECT * FROM restaurants WHERE restaurant_id = $res_id";
        $rs2 = mysqli_query($conn, $sql2);
        $name =  mysqli_fetch_array($rs2)["name"];
        $i = 1;
        while ($row = mysqli_fetch_array($rs)) {
          if ($i == 1) {
            echo '<div class="carousel-item active">';
          } else {
            echo '<div class="carousel-item ">';
          }
          echo '<img src="data:image;base64,' . base64_encode($row["photo"]) . '" alt="error">';
          echo '<div class="container">';
          echo '<div class="carousel-caption">';
          echo '<h1>' . $name . '</h1>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          $i++;
        }
        ?>
      </div>

      <!-- FRONT END
        <div class="carousel-item active">
          <img class="first-slide" src="https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8Nnx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Restaurant Name

              </h1>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="second-slide" src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mnx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Restaurant Name

              </h1>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="third-slide" src="https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MTN8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Restaurant Name

              </h1>
            </div>
          </div>
        </div>
        -->

      <!--Controls-->
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

    <div class="container">

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <button class="nav-link active btn-lg " href="#" id="decBtn">Description</button>
        </li>
        <li class="nav-item">
          <button class="nav-link btn-lg " href="#" id="menuBtn">Menu</button>

        </li>
        <li class="nav-item">
          <button class="nav-link btn-lg" href="#" id="revBtn">Reviews</button>
        </li>
      </ul>
      <div class="container">

        <br>

        <div id="Description">
          <?php
          $res_id = $_POST["id"];
          // we must change restaurant_id to its proper id.
          $sql = "SELECT * FROM restaurants WHERE restaurant_id = $res_id";
          $rs = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($rs);

          // we must change restaurant_id to its proper id.
          //this is for getting average rating
          $sql2 = "SELECT AVG(rating) AS 'avg' FROM ratings WHERE restaurant_id = $res_id";
          $avgRating = mysqli_query($conn, $sql2);
          if (mysqli_num_rows($avgRating) > 0) {
            $avgRating = mysqli_fetch_array($avgRating)['avg'];
          } else {
            $avgRating = 0;
          }
          // this is for counting number of reviewers
          $sql3 = "SELECT COUNT(rating) AS 'COUNT' FROM ratings WHERE restaurant_id = $res_id";
          $nbRating = mysqli_query($conn, $sql3);
          if (mysqli_num_rows($nbRating) > 0) {
            $nbRating = mysqli_fetch_array($nbRating)["COUNT"];
          } else {
            $nbRating = 0;
          }

          echo '<h1>' . $row["name"] . '</h1>';
          echo '<h5>' . $row["description"] . '</h5>';
          // round method is for displaying only 2 decimal numbers instead of showing the rating as "2.95849350/5"
          echo '<p>Gain ' . round($avgRating, 2)   . '/5 Score out of (' . $nbRating . ') Reviewers!</p>'
          ?>
          <!-- Front-End of description
          <h1>Restaurant Name</h1>
          <h6>Here is some Description Wrote by Restaurant Owner</h6>
          <p>and here will be Our users Average Rating Score </p>
          <p>Rating Score: ... Average for 94 Reviewer</p>
          <hr>
          <br>
        -->
          <h1>Location</h1>


          <?php
          $res_id = $_POST["id"];
          $sql = "SELECT address FROM restaurants WHERE restaurant_id = $res_id";
          $rs = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($rs)['address'];

          echo '<br>';
          echo '<a href="' . $row . '" style = "font-size: 20px;" target="_blank" >Google map Location </a>';


          ?>


        </div>

        <div id="Menu" style="display: none;">

          <?php
          //Resaurant id shall be changed to correct number
          $sql = "SELECT * FROM dishes WHERE restaurant_id = $res_id";
          $rs = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_array($rs)) {
            echo '<br>';
            echo '<div class="row featurette">';
            echo '<div class="col-md-7">';
            echo '<h2 class="featurette-heading">' . $row["name"] . '<span class="text-muted" style="font-size: 0.75em ;"> ' . $row["price"] . ' Riyal</span>';
            echo '</div>';
            echo '<div class="col-md-5">';
            echo '<img class="rounded" src="data:image;base64,' . base64_encode($row["picture"]) . '" height="400px" width="400px" alt="Generic placeholder image">';
            echo '</div>';
            echo '</div>';
            echo '<hr>';
          }
          ?>


        </div>

        <div id="Reviews" style="display: none;">

          <?php
          // CHANGE to correct Resaurant_id
          $sql = "SELECT * FROM ratings WHERE restaurant_id = $res_id";
          $rs = mysqli_query($conn, $sql);

          if (mysqli_num_rows($rs) > 0) {

            while ($row = mysqli_fetch_array($rs)) {

              $customer_id = $row['customer_id'];
              $sql2 = "SELECT name FROM customers WHERE customer_id = $customer_id";
              $name = mysqli_fetch_array(mysqli_query($conn, $sql2))["name"];

              $sql3 = "SELECT comment FROM comments WHERE customer_id = '$customer_id' AND restaurant_id='$res_id'";
              $comment = mysqli_fetch_array(mysqli_query($conn, $sql3))['comment'];


              echo '<hr>';
              echo ' <h5 style="font-weight: bold;">' . $name . '</h5>';
              echo ' <p>Rating: ' . $row["rating"] . '/5 <!--should call rating --></p>';
              echo '<p>' . $comment . '</p>';
            }
          } else {
            echo '<p> Be The first one who write a review!</p>';
          }


          ?>

          <hr>
          <?php
          if ($isLoggedIn == true){
          echo '<form method="post" action="Review.php">';
        }
          else{
          echo '<form method="post" action="Review.php" hidden>';
          }
           ?>
            <label for="newreview">Write A Review </label>
            <textarea class="form-control" id="new-comment" name="new-comment" placeholder="Write a Review..." rows="3" required></textarea>
            <label>Your overall experience with us out of 5</label><br>
            <div class="rating" style="margin-right: 880px;">
              <input type="radio" id="star5" name="rating1" value="5" required />
              <label for="star5">5 stars</label>
              <input type="radio" id="star4" name="rating1" value="4" required />
              <label for="star4">4 stars</label>
              <input type="radio" id="star3" name="rating1" value="3" required />
              <label for="star3">3 stars</label>
              <input type="radio" id="star2" name="rating1" value="2" required />
              <label for="star2">2 stars</label>
              <input type="radio" id="star1" name="rating1" value="1" required />
              <label for="star1">1 star</label>
              <?php
              echo '<input type="text" name="id" value="'.$res_id.'">';
               ?>
            </div>
            <br>
            <button type="submit" id="revSubmit" class="btn btn-secondary btn-md" style="margin-top: 1em ;">Submit</button>

          </form>

        </div>
      </div>

    </div>

    <!-- FOOTER -->
    <hr>
    <br>

    <footer class="footer py-4" style="background-color: white; color: gray">
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
            <a class="link-dark text-decoration-none" href="#!" style="color: gray">Terms of Use</a>
          </div>
        </div>
      </div>
    </footer>
  </main>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
</body>

</html>
