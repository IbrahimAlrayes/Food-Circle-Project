<?php
$email = $password ='';
$loginas=$_POST['loginas'];
echo $loginas;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["email"])) {
      header('location:lrform.php?error=Email is required');
      die();
    } else{

      $email=test_input($_POST["email"]);
    }

    if (empty($_POST["password"])) {
      header('location:lrform.php?error=passWord is required');
      die();
    } else{
      $password=$_POST["password"];
    }

  }

$conn = mysqli_connect('localhost', 'root', '', 'project');
if(mysqli_connect_errno())
    die("Error while connecting to the DB. ".  mysqli_connect_error());

if($loginas=="user"){
  $s=1;
$query = "SELECT * FROM customers WHERE email ='".$email."' AND password='".$password."' AND status='".$s."'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)==1){
    setcookie("auth", $email, time()+3600*2, "/");
    $id = mysqli_fetch_array($result)['customer_id'];
    setcookie("id", $id, time()+3600*2, "/");
    mysqli_close($conn);
    header("Location:/project/homepage/index.php");
}
else{
    mysqli_close($conn);
    header("Location:lrform.php?error=Wrong username/password");
}
}

else{
  $s=2;
$query = "SELECT * FROM admins WHERE email ='".$email."' AND password='".$password."' AND status='".$s."'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)==1){
    setcookie("auth", $email, time()+3600*2, "/");
    $row = mysqli_fetch_array($result);
    $id = $row["admin_id"];
    $name = $row["name"];

    setcookie("id", $id, time()+3600*2, "/");
    setcookie("name", "$name", time()+3600*2, "/");
    mysqli_close($conn);

      //This we redirect to  admin.php ..  YAZEED FOCUS HERE
      header("Location:/project/admin/admin.php");
}
else{
    mysqli_close($conn);
    header("Location:lrform.php?error=Wrong username/password");
}
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
