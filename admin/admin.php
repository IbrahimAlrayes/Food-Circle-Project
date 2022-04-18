<?php
if (!isset($_COOKIE["auth"]))
   header("Location:/project/loginpage/login.php?error=Please sign in again");

?>
<!DOCTYPE html>
<html>

<head>
 <title>Food Circles</title>


<link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<body style="margin:0px; border:0px; padding:0px;">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="admin.php">Food Circles</a>
  <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Dashboard</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
<li class="nav-item"><a class="nav-link" href="/project/LoginPage/signout.php">Sign out</a></li>
</ul>
</nav>

<!-- Welcome jumptron row -->
  <div class="row">
    <div class="container">

  <div class="jumbotron text-center col-md-6" id = "topJump">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // CHANGE TO LOGGED IN ADMIN
      echo '<h1 id="welcome">Welcome, ' .$_COOKIE["name"]. '!</h1>';
     ?>
    <hr class="my-4">
    <!-- Restaurant Card -->

<!-- Show card if there is a restaurant with admin_id == amdin id -->
<?php

// CHANGE TO LOGGED IN ADMIN
$sql = 'SELECT * FROM restaurants WHERE admin_id = "'.$_COOKIE["id"].'";';
$rs = mysqli_query($conn, $sql);

// if no restaurant is added by the admin
if(mysqli_num_rows($rs) == 0)
{
  echo '<a href="addRestaurantDetails.php" class="btn btn-primary btn-md">Add a restaurant!</a>';
} else {
// if a restaurant exists

$row = mysqli_fetch_array($rs);
echo '<div class="container">';
echo '<div class="card" style="width: 18rem;">';
echo '<img class="card-img-top" src="data:image;base64,'.base64_encode($row["picture"]).'" alt="Card image cap">';
echo '<div class="card-body">';
echo '<h5 class="card-title">' . $row["name"] . "</h5>";
echo '<p class="card-text">' . $row["description"] . "</p>";
echo '<ul class="list-group list-group-flush">';
echo '<li class="list-group-item">Food Specialty: ' . $row["specialty"] . '</li>';
echo '<li class="list-group-item">Address: ' . $row["address"] . '</li>';
echo '</ul>';
echo "<br>";
echo '<form method="post" action="ModifyRestaurant.php">';
echo '<input type="submit" class="btn btn-info btn-md" name="action" value="Edit"/>';
echo '<input type="submit" class="btn btn-danger btn-md" name="action" value="Delete"/>';
echo '<input type="hidden" name="id" value="' .  $row['restaurant_id'] . '"/>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
}
?>
  </div>


<!-- statistics section -->

<?php



// CHANGE TO LOGGED IN ADMIN
$sql = 'SELECT * FROM restaurants WHERE admin_id = "'.$_COOKIE["id"].'";';
$rs = mysqli_query($conn, $sql);

// if no restaurant is added by the admin
if(mysqli_num_rows($rs) > 0){
   $res_id = mysqli_fetch_array($rs)["restaurant_id"];

  // change all to where restaurant_id = restaurant_id
$sql = "SELECT AVG(rating) AS 'AVG' FROM ratings WHERE restaurant_id = '$res_id'";
$avg_rating = mysqli_query($conn, $sql);
if(mysqli_num_rows($avg_rating) > 0){
  $avg_rating = mysqli_fetch_array($avg_rating)["AVG"];
} else {
  $avg_rating = 0;
}

$sql = "SELECT COUNT(comment_id) AS 'COUNT' FROM comments WHERE restaurant_id = '$res_id'";
$nb_comments = mysqli_query($conn, $sql);
if(mysqli_num_rows($nb_comments) > 0){
  $nb_comments = mysqli_fetch_array($nb_comments)["COUNT"];
} else {
  $nb_comments = 0;
}



$sql = "SELECT COUNT(dish_id) AS 'COUNT' FROM dishes WHERE restaurant_id = '$res_id'";
$nb_dishes = mysqli_query($conn, $sql);
if(mysqli_num_rows($nb_dishes) > 0){
  $nb_dishes = mysqli_fetch_array($nb_dishes)["COUNT"];
} else {
  $nb_dishes = 0;
}

} else {
   $res_id = 0;
  $avg_rating = 0;
  $nb_comments = 0;
  $nb_dishes = 0;
}

echo '<div class="jumbotron text-left col-md-6" id = "topJump">';
echo '<h1 class="display-4">Statistics</h1>';
echo '<hr class="my-4">';
echo '<ul class="list-group">';
echo '<li class="list-group-item">Average Rating: ' . $avg_rating . '</li>';
echo '<li class="list-group-item">Number of comments: ' . $nb_comments . '</li>';
echo '<li class="list-group-item">Number of dishes: ' . $nb_dishes  . '</li>';
echo '</ul>';
?>
<hr class="my-4">


</div>
</div>
</div>

<!-- Second row jumptrons -->


    <div class="row">
    <div class="container">


      <div class="jumbotron text-center col-md-6">
          <h1 class="display-4">Menu</h1>
      <br>
      <?php
      $sql = 'SELECT * FROM restaurants WHERE admin_id = "'.$_COOKIE["id"].'";';
      $rs = mysqli_query($conn, $sql);

      // if no restaurant is added by the admin
      if(mysqli_num_rows($rs) != 0)
      {
        echo '<a href="addDishDetails.php" class="btn btn-primary btn-md">Add a dish</a>';
      }
       ?>

          <hr class="my-4">

          <?php
          // CHANGE to correct restaurant_id

          $sql = "SELECT * FROM dishes WHERE restaurant_id = '$res_id'";
          $rs = mysqli_query($conn, $sql);

          if(mysqli_num_rows($rs) > 0){

          $counter=0;
          while($row = mysqli_fetch_array($rs)){

              if ($counter % 2 == 0){
                echo '<div class="row">';
                echo '<div class="container">';

             }
             $counter = $counter + 1;

             echo '<div class="card" style="width: 14rem;">';
             echo '<img class="card-img-top" src="data:image;base64,'.base64_encode($row["picture"]).'" alt="Card image cap">';
             echo '<div class="card-body">';
             echo '<h5 class="card-title">' . $row["name"] . "</h5>";
             echo '<li class="list-group-item">Price: ' . $row["price"] . '</li>';
             echo '<div class="row">';
             echo '<div class="col-sm-12 text-center">';
             echo '<br>';
             echo '<form method="post" action="ModifyDish.php">';
             echo '<input type="submit" class="btn btn-info btn-sm" name="action" value="Edit"/>';
             echo '<input type="submit" class="btn btn-danger btn-sm" name="action" value="Delete"/>';
             echo '<input type="hidden" name="id" value="' .  $row['dish_id'] . '"/>';
             echo '<input type="hidden" name="name" value="' .  $row['name'] . '"/>';
             echo '<input type="hidden" name="price" value="' .  $row['price'] . '"/>';
             echo '<input type="hidden" name="pic" value="' .  base64_encode($row['picture']) . '"/>';
             echo '</form>';
             echo '</div>';
             echo '</div>';
             echo '</div>';
             echo '</div>';

             if ($counter % 2== 0){
               echo '</div>';
               echo '</div>';

            }
          }
          if ($counter % 2 != 0){
            echo '</div>';
            echo '</div>';

            }
          }

           ?>

         </div>


<div class="jumbotron text-center col-md-6">



  <h1 class="display-4">Photos</h1>
  <br>
  <?php
  // CHANGE to correct admin_id

  // if no restaurant is added by the admin
  if($res_id != 0)
  {
    echo '<a href="UploadPhoto.php" class="btn btn-primary btn-md">Add a photo</a>';
  }
   ?>
  <hr class="my-4">
  <?php

  $sql = "SELECT * FROM photos WHERE restaurant_id = $res_id";
  $rs = mysqli_query($conn, $sql);

  if(mysqli_num_rows($rs) > 0){

  $counter=0;
  while($row = mysqli_fetch_array($rs)){

      if ($counter % 2 == 0){
        echo '<div class="row">';
        echo '<div class="container">';

     }
     $counter = $counter + 1;

     echo '<div class="card" style="width: 14rem;">';
     echo '<img class="card-img-top" src="data:image;base64,'.base64_encode($row["photo"]).'" alt="Card image cap">';
     echo '<div class="card-body">';
     echo '<div class="row">';
     echo '<div class="col-sm-12 text-center">';
     echo '<br>';
     echo '<form method="post" action="ModifyPhoto.php">';
     echo '<input type="submit" class="btn btn-info btn-sm" name="action" value="Edit"/>';
     echo '<input type="submit" class="btn btn-danger btn-sm" name="action" value="Delete"/>';
     echo '<input type="hidden" name="id" value="' .  $row['photo_id'] . '"/>';
     echo '<input type="hidden" name="photo" value="' .  base64_encode($row['photo']) . '"/>';
     echo '</form>';
     echo '</div>';
     echo '</div>';
     echo '</div>';
     echo '</div>';

     if ($counter % 2== 0){
       echo '</div>';
       echo '</div>';

    }
  }
  if ($counter % 2 != 0){
    echo '</div>';
    echo '</div>';

    }
  }

   ?>


</div>




</div>
</div>

<!-- Third row jumptrons -->

<div class="row">
<div class="container">


  <div class="jumbotron text-center col-md-6">
      <h1 class="display-4">Comments</h1>
      <hr class="my-4">

      <?php
      // CHANGE to correct admin_id
      $sql = "SELECT * FROM comments WHERE restaurant_id = $res_id";
      $rs = mysqli_query($conn, $sql);

      if(mysqli_num_rows($rs) > 0){

      while($row = mysqli_fetch_array($rs)){

        $customer_id = $row['customer_id'];
        $sql = "SELECT name FROM customers WHERE customer_id = $customer_id LIMIT 1";
        $name = mysqli_fetch_array(mysqli_query($conn, $sql))["name"];

        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<blockquote class="blockquote mb-0">';
        echo '<p>'.$row["comment"] .'</p>';
        // CHANGE THIS TO CUSTOMER NAME

        echo '<footer class="blockquote-footer">' . $name.'</footer>';
        echo '</blockquote>';
        echo '</div>';
        echo '</div>';

        }
      }


       ?>

     </div>


<div class="jumbotron text-center col-md-6">



<h1 class="display-4">Ratings</h1>
<hr class="my-4">

<?php
$sql = "SELECT * FROM ratings WHERE restaurant_id = $res_id";
$rs = mysqli_query($conn, $sql);

if(mysqli_num_rows($rs) > 0){

echo '<div class="card" style="width: 32rem;">';
echo '<ul class="list-group list-group-flush">';
while($row = mysqli_fetch_array($rs)){

    //get customer name
    $customer_id = $row['customer_id'];
    $sql = "SELECT name FROM customers WHERE customer_id = $customer_id";
    $name = mysqli_fetch_array(mysqli_query($conn, $sql))["name"];

      echo '<li class="list-group-item">' . $name . ' Rated you: '.$row["rating"] . '/10</li>';

  }
  echo "</ul>";
  echo "</div>";
}


$conn -> close();

 ?>

</div>
</div>
</div>
</body>
</html>
