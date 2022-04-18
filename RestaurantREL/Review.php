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
$comment = $_POST["new-comment"];
$rating = $_POST["rating1"];
$customer_id = $_COOKIE["id"];
$restaurant_id = $_POST["id"];


// Change to correct restaurant_id
// also we need to insert the comment in comments table but we need the to know customer_id
$sql2 = "INSERT INTO comments (customer_id , restaurant_id, comment)
 VALUES ('$customer_id', '$restaurant_id', '$comment')";
$rs2 = mysqli_query($conn, $sql2);

if ($rs2){
  $sql = "INSERT INTO ratings (customer_id , restaurant_id, rating)
   VALUES ('$customer_id', '$restaurant_id', '$rating')";
   $rs = mysqli_query($conn, $sql);
 }

$conn -> close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>
    <script type="text/javascript">

    function formAutoSubmit () {
    var frm = document.getElementById("myForm");
    frm.submit();
    }
    window.onload = formAutoSubmit;
    </script>
    <form id="myForm" action="http://localhost/Project/RestaurantREL/Restaurant.php" method="post" hidden>
      <?php
      echo '<input type="text" name="id" value="'.$restaurant_id.'">';
      ?>
    </form>
  </body>
</html>
