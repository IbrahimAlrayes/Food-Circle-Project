<!DOCTYPE html>
<html>

<head>
 <title>Add a Restaurant</title>


<link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
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


<div class="container">

  <div class="jumbotron text-left col-md-12" id = "topJump">
  <h1>Add a new Restaurant!</h1>
  <form method="post" action="addRestaurant.php" enctype="multipart/form-data">
    <div class="form-group">
  <label for="restaurantname">Restaurant Name</label>
  <input type="text" class="form-control" name="res_name" id="res_name" placeholder="Enter restaurant name" required>
</div>

<div class="form-group">
<label for="specialty">Restaurant Specialty</label>
<select class="form-control" id="specialty" name="specialty" required>
  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "project";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
  }
  else {
    "Connected";
  }

  $sql = "SELECT * FROM Specialty";
  $rs = mysqli_query($conn, $sql);


    while($row = mysqli_fetch_array($rs))
    {
    echo "<option name=" . $row["specialty"] . '">' . $row["specialty"] . "</option>";
    }
  $conn -> close();
   ?>
</select>
</div>

<div class="form-group">
<label for="description">Restaurant Address</label>
<input type="text" class="form-control" id="address" name="address" placeholder="Enter restaurant description" required>
</div>

<div class="form-group">
<label for="genre">Restaurant Latitude</label>
<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter restaurant latitude" required>
</div>

<div class="form-group">
<label for="genre">Restaurant Logitude</label>
<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter restaurant longitude" required>
</div>

<div class="form-group">
<label for="description">Restaurant Description</label>
<input type="text" class="form-control" id="description" name="description" placeholder="Enter restaurant description" required>
</div>



<div class="form-group">
<label for="picture">Restaurant Picture</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="picture" name="picture" required>
    <label class="custom-file-label" for="picture">Choose restaurant picture</label>
  </div>

</div>

<button type="submit" class="btn btn-primary">Add restaurant</button>
</form>

</div>
</div>

</body>
</html>
