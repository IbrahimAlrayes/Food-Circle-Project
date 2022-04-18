<?php 
$con=mysqli_connect("localhost","root","" ,"project") ;
if(mysqli_connect_errno())
    die("Error while connecting to the DB. ".  mysqli_connect_error());
if(isset($_POST['input'])){
    $input=$_POST['input'];
    
    $query2 = "SELECT * FROM restaurants WHERE name LIKE '{$input}%' ";
    $result = mysqli_query($con, $query2);
    if(mysqli_num_rows($result)>0){
 while ($row = mysqli_fetch_assoc($result)) {
        $rest_id = $row['restaurant_id'];
        $sql2 = "SELECT AVG(rating) AS 'avg' FROM ratings WHERE restaurant_id = $rest_id";
        $avgRating = mysqli_query($con, $sql2);
        if (mysqli_num_rows($avgRating) > 0) {
          $avgRating = mysqli_fetch_array($avgRating)['avg'];
        } else {
          $avgRating = 0;
        }

        //This to count number of reviewers
        $sql3 = "SELECT COUNT(rating) AS 'COUNT' FROM ratings WHERE restaurant_id = $rest_id";
        $nbRating = mysqli_query($con, $sql3);
        if (mysqli_num_rows($nbRating) > 0) {
          $nbRating = mysqli_fetch_array($nbRating)["COUNT"];
        } else {
          $nbRating = 0;
        }
        echo '<div class="container" id="txtHint" style="display:block">';
        echo '<div id="txt" style="display:block">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<img class = "rounded" src = "data:image;base64,' . base64_encode($row["picture"]) . '" style="float: left;" height="300px" width="300px" alt="HTML5"';
        echo '<div style = "margin-left: 345px; margin-top: 25px">'; //THIS MARGIN FOR NO REASON DOESNT WORK!
        echo '<h1><a href="restaurant.php">' . $row["name"] . '</a></h1>';
        echo '<button id="buttn">' . $row["specialty"] . '</button>';
        echo '<p>Score: ' . round($avgRating, 2) . '/5 (' . $nbRating . ')</p>';
        echo '<span class="far fa-comment-alt" style="float: left;"></span>';
        echo '<p class="card-text" style="margin-left: 25px;">' . $row["description"] . ' </p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '</div>';
      }
    }

else{
    echo "NOT FOUND ";
}
}

?>