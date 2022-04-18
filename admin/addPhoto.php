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
$sql = 'SELECT * FROM restaurants WHERE admin_id = "'.$_COOKIE["id"].'";';
$rs = mysqli_query($conn, $sql);
$res_id = mysqli_fetch_array($rs)["restaurant_id"];

$picture = addslashes(file_get_contents( $_FILES["photo"]["tmp_name"] ));
// Change to add based on restaurant_id
$sql = "INSERT INTO photos(restaurant_id, photo)
 VALUES ($res_id, '$picture')";

$rs = mysqli_query($conn, $sql);

if ($rs){
    echo "Photo inserted succeffuly!";
} else {
  echo "HEEEY";
}

$conn -> close();

header("Location: http://localhost/Project/Admin/admin.php");
exit();
?>
