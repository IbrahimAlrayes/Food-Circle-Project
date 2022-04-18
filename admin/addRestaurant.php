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

$res_name = $_POST["res_name"];
$specialty = $_POST["specialty"];
$address = $_POST["address"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$description = $_POST["description"];
$picture  = addslashes(file_get_contents( $_FILES["picture"]["tmp_name"] ));

$admin_id = $_COOKIE["id"];
// CHANGE ADMIN TO LOGGED IN ADMIN
$sql = "INSERT INTO restaurants (name, admin_id, specialty, latitude, longitude, description, address, picture)
 VALUES ('$res_name', '$admin_id', '$specialty', $latitude, $longitude, '$description', '$address', '$picture')";

$rs = mysqli_query($conn, $sql);

if ($rs){
    echo "Restaurant inserted succeffuly!";
} else {
  echo "Not successful";
}

$conn -> close();
//
header("Location: http://localhost/Project/Admin/admin.php");
exit();
?>
