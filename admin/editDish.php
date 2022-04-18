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

$id = $_POST["id"];
$dishName = $_POST["dishName"];
$price = $_POST["price"];
$picture  = addslashes(file_get_contents( $_FILES["pic"]["tmp_name"] ));

// Change to correct restaurant_id

$sql = "UPDATE dishes
SET name = '$dishName', price = $price, picture = '$picture'
WHERE dish_id = $id";


$rs = mysqli_query($conn, $sql);

if ($rs){
    echo "Dish updated succeffuly!";
} else {
  echo "Not successful";
}

$conn -> close();

header("Location: http://localhost/Project/Admin/admin.php");
exit();
?>
