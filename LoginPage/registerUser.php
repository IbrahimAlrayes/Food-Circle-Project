
<?php
 $username=$email=$password=$conf='';
 $registeras=$_POST['registeras'];

$name = test_input($_POST["username"]);
if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
  header('location:lrform.php?error=Only letters and white space allowed');
  die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    header('location:lrform.php?error=userName is required');
    die();
  } else{
    $username=test_input($_POST["username"]);
  }

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

  if (empty($_POST["confirm"])) {
    header('location:lrform.php?error=confirm passWord is required');
    die();
  } else{
    $conf=$_POST["confirm"];
  }

}
if($conf!=$password){
  header('location:lrform.php?error=confirm passWord mismatch');
}


else if($registeras=="user"){
$conn = mysqli_connect('localhost', 'root', '', 'project');
if (mysqli_connect_errno())
  die("Error connecting to the DB: " . mysqli_connect_error());
static $r=0;
  $query = "INSERT INTO `customers` ( `name`, `email`, `password`, `status`, `latitude`, `longitude`) VALUES ( '$username', '$email', '$password', '1', '79.1', '79.1')";
 $r++;
  mysqli_query($conn,$query);
  setcookie('auth','yes',time()+(3600*3),'/');
  $query = "SELECT * FROM customers WHERE email ='".$email."' AND password='".$password."'";
  $result = mysqli_query($conn, $query);

      $id = mysqli_fetch_array($result)['customer_id'];
      setcookie("id", $id, time()+3600*2, "/");
      mysqli_close($conn);

  header("Location:/project/homepage/index.php?notify=User added successfully");
}

else {
  $conn = mysqli_connect('localhost', 'root', '', 'project');
  if (mysqli_connect_errno())
    die("Error connecting to the DB: " . mysqli_connect_error());

    $query = "INSERT INTO `admins` (`name`, `email`, `password`, `status`) VALUES ('$username', '$email', '$password', '2')";
    mysqli_query($conn,$query);
    setcookie('auth','yes',time()+(3600*3),'/');

    $query = "SELECT * FROM admins WHERE email ='" .$email. "' AND password='". $password. "'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_array($result);
    $id = $row["admin_id"];
    $name = $row["name"];

    setcookie("id", $id, time()+3600*2, "/");
    setcookie("name", "$name", time()+3600*2, "/");
    mysqli_close($conn);

    header("Location:/project/admin/admin.php?notify=User added successfully");


}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
