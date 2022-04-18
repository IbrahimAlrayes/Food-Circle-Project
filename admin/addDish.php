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

$dishName = $_POST["dishName"];
$price = $_POST["price"];
$picture  = addslashes(file_get_contents( $_FILES["pic"]["tmp_name"] ));

$sql = 'SELECT * FROM restaurants WHERE admin_id = "'.$_COOKIE["id"].'";';
$rs = mysqli_query($conn, $sql);
$res_id = mysqli_fetch_array($rs)["restaurant_id"];

// Change to correct restaurant_id
$sql = "INSERT INTO dishes (restaurant_id, name, price, picture)
 VALUES ($res_id, '$dishName', '$price', '$picture')";

$rs = mysqli_query($conn, $sql);

if ($rs){
    echo "Dish inserted succeffuly!";
} else {
  echo "Not successful";
}

$conn -> close();

header("Location: http://localhost/Project/Admin/admin.php");

exit();
?>
