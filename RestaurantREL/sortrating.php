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
$q = $_GET['q'];


$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
  die('Could not connect: ' );
}

mysqli_select_db($conn,"ajax_demo");
$sql="SELECT restaurant_id, AVG(rating) AS avg FROM ratings GROUP BY restaurant_id ORDER BY avg DESC";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)) {
  $rest_id = $row["restaurant_id"];
  $sql2="SELECT * FROM restaurants WHERE restaurant_id = $rest_id";
  $row = mysqli_fetch_array(mysqli_query($conn,$sql2));

	     $rest_id = $row['restaurant_id'];
        $sql2 = "SELECT AVG(rating) AS 'avg' FROM ratings WHERE restaurant_id = $rest_id";
        $avgRating = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($avgRating) > 0) {
          $avgRating = mysqli_fetch_array($avgRating)['avg'];
        } else {
          $avgRating = 0;
        }

        //This to count number of reviewers
        $sql3 = "SELECT COUNT(rating) AS 'COUNT' FROM ratings WHERE restaurant_id = $rest_id";
        $nbRating = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($nbRating) > 0) {
          $nbRating = mysqli_fetch_array($nbRating)["COUNT"];
        } else {
          $nbRating = 0;
        }


        echo ' <div class="container" style="display:block">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<img class = "rounded" src = "data:image;base64,' . base64_encode($row["picture"]) . '" style="float: left; margin-right: 15px;"  height="300px" width="300px" alt="HTML5"';
        echo '<div style = "margin-left: 345px; margin-top: 25px">'; //THIS MARGIN FOR NO REASON DOESNT WORK!
        echo '<h1>' . $row["name"] . '</a></h1>';
        echo '<button id="buttn">' . $row["specialty"] . '</button>';
		echo '<p>Score: ' . round($avgRating, 2) . '/5 (' . $nbRating . ')</p>';
        echo '<span class="far fa-comment-alt" style="float: left;"></span>';
        echo '<p class="card-text" style="margin-left: 25px;">' . $row["description"] . ' </p>';
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
