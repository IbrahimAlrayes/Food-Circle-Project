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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food Circle: Restaurants</title>
  <link rel="icon" type="image/x-icon" href="images.png" />
  <!-- Latest compiled and minified CSS -->
  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/carousel/">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom styles for this template -->
  <link href="carousel.css" rel="stylesheet">
  <link href="rating.css" rel="stylesheet">
  <link href="allRest.css" rel="stylesheet">
  <link href="1css/styles.css" rel="stylesheet">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Fonts and Icons -->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <script src="1js/scripts.js"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

  <script>
    $(document).ready(function() {
      $(".card").hover(
        function() {
          $(this).addClass('shadow-lg')
        },
        function() {
          $(this).removeClass('shadow-lg');
        }
      );

      // document ready
    });

    $(document).ready(function() {
      $('#live_search').keyup(function() {
        var input = $(this).val();
        var allElements = document.querySelectorAll('[id="txt"]');
        var new_display_value = "none";
        for (i = 0; i < allElements.length; i++) {
          allElements[i].style.display = new_display_value;
        }
        if (input != "") {
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              $("#searchresult").html(data);

            }


          });
        } else {
          var allElements = document.querySelectorAll('[id="txt"]');
          var new_display_value = "block";
          for (i = 0; i < allElements.length; i++) {
            allElements[i].style.display = new_display_value;
          }
          $("#searchresult").html("");
        }
      });

    });
  </script>

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
            <li class="nav-item"><a class="nav-link" href="/project/HomePage/index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Restaurants</a></li>
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
  <br>
  <br><br>
<br><br><br>
  <div class="container">


    <div class="container">
      <div class="input-group md-form form-sm form-2 pl-0">
        <input class="form-control my-0 py-1" name="live_search" id="live_search" type="text" placeholder="Search">
        <div class="input-group-append">
          <span class="input-group-text" id="basic-text1"> <button style="border: 0; " type="submit"><i class="fas fa-search" aria-hidden="true"></button></i></span>
        </div>
      </div>





      <br>
      <p style="display: inline-block;">Search By: </p>

      <script>
        function showUser(str) {
          if (str == " ") {
            show()
            document.getElementById("txtHint").innerHTML = "";
            return;
          }

          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

              show()
              document.getElementById("txtHint").innerHTML = this.responseText;
              hid();

            }
          }

          xmlhttp.open("GET", "sortspciality.php?q=" + str, true);
          xmlhttp.send();

        }

        function hid() {
          var allElements = document.querySelectorAll('[id="txt"]');
          var new_display_value = "none";
          for (i = 0; i < allElements.length; i++) {
            allElements[i].style.display = new_display_value;
          }
        }

        function show() {
          var allElements = document.querySelectorAll('[id="txt"]');
          var new_display_value = "block";
          for (i = 0; i < allElements.length; i++) {
            allElements[i].style.display = new_display_value;
          }
        }
      </script>
      </head>

      <body>



        <script>
          function myFunction(tr) {

            if (tr == "rating") {

              show()
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("txtHint").innerHTML = this.responseText;
                  hid();

                }
              }

              xmlhttp.open("GET", "sortrating.php?q=" + tr, true);
              xmlhttp.send();

            }




            if (tr == "location") {
              getLocation();

            }

            function getLocation() {
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
              }
            }

            function showPosition(position) {

              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("txtHint").innerHTML = this.responseText;
                  hid();

                }
              }
              var x = position.coords.latitude;
              var y = position.coords.longitude
              xmlhttp.open("GET", "sortbylocation.php?lat=" + x + "&lon=" + y, true);
              xmlhttp.send();

            }



          }
        </script>

        <div>
          <form style="display: inline-block;">
            <select name="specialty" onchange="showUser(this.value)">
              <option value=" ">Select</option>
              <option value="Fast Food">Fast Food</option>
              <option value="Italian">Italian</option>
              <option value="Saudi">Saudi</option>
            </select>
          </form>

          <form style="display: inline-block;">
            <select name="sort" onchange="myFunction(this.value)">
              <option value=" ">Select</option>
              <option value="rating">rating</option>
              <option value="location">location</option>
            </select>
          </form>

        </div>
        <br>
        <div id="searchresult"></div>
        <br>
        <br>




        <?php
        $sql = "SELECT * FROM restaurants";
        $rs = mysqli_query($conn, $sql);



        // this to get average rating

        while ($row = mysqli_fetch_assoc($rs)) {
          $rest_id = $row['restaurant_id'];
          $sql2 = "SELECT AVG(rating) AS 'avg' FROM ratings WHERE restaurant_id = $rest_id";
          $avgRating = mysqli_query($conn, $sql2);
          if (mysqli_num_rows($avgRating) > 0) {
            $avgRating = mysqli_fetch_array($avgRating)['avg'];
          } else {
            $avgRating = 0;
          }

          //This to count number of reviewers
          $sql3 = "SELECT COUNT(rating) AS 'COUNT' FROM ratings WHERE restaurant_id = $rest_id";
          $nbRating = mysqli_query($conn, $sql3);
          if (mysqli_num_rows($nbRating) > 0) {
            $nbRating = mysqli_fetch_array($nbRating)["COUNT"];
          } else {
            $nbRating = 0;
          }
          echo '<input type="text" name="id" value=".' .$rest_id .'" hidden></form>';

          echo '<div class="container" id="txtHint" style="display:block; padding-left=50px">';
          echo '<div id="txt" style="display:block">';
          echo '<div class="card">';
          echo '<div class="card-body">';
          echo '<img class = "rounded" src = "data:image;base64,' . base64_encode($row["picture"]) . '" style="float: left; margin-right: 15px;"  height="300px" width="300px" alt="HTML5"';
          echo '<h1>'. $row["name"] .'</h1>';
          echo '<button id="buttn">' . $row["specialty"] . '</button>';
          echo '<p>Score: ' . round($avgRating, 2) . '/5 (' . $nbRating . ')</p>';
          echo '<span class="far fa-comment-alt" style="float: left;"></span>';
          echo '<p class="card-text" style="margin-left: 25px;">' . $row["description"] . ' </p>';
          echo '<form action="restaurant.php" method="post">';
          echo '<button type="submit" class="btn btn-outline-warning">'. "Go to restauran's Page".'</button>';
          echo '<input name="id" value="'.$rest_id.'" hidden>';
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '<br>';
          echo '</div>';
        }
        mysqli_close($conn);
        ?>
        <hr>
        <footer class="footer py-4" style="background-color: white; color: gray">

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

        </footer>
      </body>

</html>
