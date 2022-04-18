<!DOCTYPE html>
<html>

<head>
 <title>Edit restaurant</title>


<link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<?php


$restaurant_id = $_POST["id"];


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

if ($_POST["action"] == "Delete"){

  $sql = "DELETE FROM dishes WHERE restaurant_id=$restaurant_id";
  $rs = mysqli_query($conn, $sql);
  $sql = "DELETE FROM photos WHERE restaurant_id=$restaurant_id";
  $rs = mysqli_query($conn, $sql);
  $sql = "DELETE FROM comments WHERE restaurant_id=$restaurant_id";
  $rs = mysqli_query($conn, $sql);
$sql = "DELETE FROM ratings WHERE restaurant_id=$restaurant_id";
$rs = mysqli_query($conn, $sql);

$sql = "DELETE FROM restaurants WHERE restaurant_id=$restaurant_id";
$rs = mysqli_query($conn, $sql);

if ($rs){
    echo "Restaurant deleted succeffuly!";
} else {
  echo "Not successful";
}

$conn -> close();
//

header("Location: http://localhost/Project/Admin/admin.php");
exit();
}
?>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Project</a>
  <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Home Page</a>
      </li>
    </ul>

  </div>
</nav>


<div class="container">
<?php
$sql = "SELECT * FROM restaurants WHERE restaurant_id=$restaurant_id";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);
 ?>
  <div class="jumbotron text-left col-md-12" id = "topJump">
  <h1>Edit Restaurant</h1>
  <form method="post" action="editRestaurant.php" enctype="multipart/form-data">
    <div class="form-group">
  <label for="restaurantname">Restaurant Name</label>
  <?php
  echo '<input type="text" class="form-control" name="res_name" id="res_name" placeholder="Enter restaurant name" required value="' . $row["name"] .'">';
   ?>
</div>

<div class="form-group">
<label for="specialty">Restaurant Specialty</label>
<select class="form-control" id="specialty" name="specialty" required>
  <?php
  $sql = "SELECT * FROM Specialty";
  $rs = mysqli_query($conn, $sql);


    while($spec = mysqli_fetch_array($rs))
    {
    echo "<option name=" . $spec["specialty"] . '">' . $spec["specialty"] . "</option>";
    }
   ?>
</select>
</div>

<div class="form-group">
<label for="description">Restaurant Address</label>
<?php
echo '<input type="text" class="form-control" id="address" name="address" placeholder="Enter restaurant description" required value="' . $row["address"] .'">';
 ?>
</div>

<div class="form-group">
<label for="genre">Restaurant Latitude</label>
<?php
echo '<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter restaurant latitude" required value="' . $row["latitude"] .'">';
 ?>
</div>

<div class="form-group">
<label for="genre">Restaurant Logitude</label>
<?php
echo '<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter restaurant longitude" required value="' . $row["longitude"] .'">';
 ?>
</div>

<div class="form-group">
<label for="description">Restaurant Description</label>
<?php
echo '<input type="text" class="form-control" id="description" name="description" placeholder="Enter restaurant description" required value="' . $row["description"] .'">';
 ?>
</div>



<div class="form-group">
<label for="pic">Restaurant Picture</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Upload</span>
  </div>
  <div class="custom-file">
    <?php
    echo '<input type="file" class="custom-file-input" id="picture" name="picture" required>';
     ?>
    <label class="custom-file-label" for="picture">Choose restaurant picture</label>
  </div>

</div>
<?php
echo '<input type="hidden" name="id" value="' .  $restaurant_id . '"/>';
 ?>
<button type="submit" class="btn btn-primary">Edit restaurant</button>
</form>

</div>
</div>
</div>

<?php
$conn -> close();
 ?>

</body>
</html>
