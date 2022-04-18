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
$res_name = $_POST["res_name"];
$specialty = $_POST["specialty"];
$address = $_POST["address"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$description = $_POST["description"];
$picture  = addslashes(file_get_contents( $_FILES["picture"]["tmp_name"] ));

// Change to correct restaurant_id

$sql = "UPDATE restaurants
SET name = '$res_name', specialty = '$specialty', address = '$address', latitude = $latitude, longitude = $longitude, description = '$description', picture = '$picture'
WHERE restaurant_id = $id";



$rs = mysqli_query($conn, $sql);

if ($rs){
    echo "Restaurant updated succeffuly!";
} else {
  echo "Not successful";
}

$conn -> close();
//
header("Location: http://localhost/Project/Admin/admin.php");
exit();
?>
