<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$lat = $_GET['lat'];
$lon = $_GET['lon'];


$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
  die('Could not connect: ' );
}

mysqli_select_db($conn,"ajax_demo");

$sql = "SELECT * FROM restaurants ORDER BY distance(latitude, longitude, $lat, $lon) ASC";

$result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($result)) {

        echo ' <div class="container" style="display:block">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<img class = "rounded" src = "data:image;base64,' . base64_encode($row["picture"]) . '" style="float: left; margin-right: 15px;"  height="300px" width="300px" alt="HTML5"';
        echo '<div style = "margin-left: 345px; margin-top: 25px">'; //THIS MARGIN FOR NO REASON DOESNT WORK!
        echo '<h1>' . $row["name"] . '</a></h1>';
        echo '<button id="buttn">' . $row["specialty"] . '</button>';
        echo '<span class="far fa-comment-alt" style="float: left;"></span>';
        echo '<p class="card-text" style="margin-left: 25px;">' . $row["description"] . ' </p>';
	$lat1 = deg2rad($lat);
    $long1 = deg2rad($lon);
    $lat2 = deg2rad($row['latitude']);
    $long2 = deg2rad($row['longitude']);
    $dlong = $long2 - $long1;
    $dlat = $lat2 - $lat1;
    $ans = pow(sin($dlat / 2), 2) +
                          cos($lat1) * cos($lat2) *
                          pow(sin($dlong / 2), 2);
    $ans = 2 * asin(sqrt($ans));
    $R = 6371;
    $ans = $ans * $R;


		echo '<p class="card-text" style="margin-left: 25px;">' .round($ans,1).' km </p>';
    echo '<form action="restaurant.php" method="post">';
    echo '<button type="submit" class="btn btn-outline-warning">'. "Go to restauran's Page".'</button>';
    echo '<input name="id" value="'.$row["restaurant_id"].'" hidden>';
    echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '</div>';

}

mysqli_close($conn);
?>
</body>
</html>
