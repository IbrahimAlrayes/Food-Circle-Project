<!DOCTYPE html>
<html>

<head>
 <title>Add a Dish</title>


<link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="admin.php">Food Circles</a>
  <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Dashboard</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
<li class="nav-item"><a class="nav-link" href="/project/LoginPage/signout.php">Sign out</a></li>
</ul>
</nav>


<div class="container">

  <div class="jumbotron text-left col-md-12" id = "topJump">
  <h1>Add a New Dish</h1>

  <form method="post" action="addDish.php" enctype = "multipart/form-data">
    <div class="form-group">
  <label for="dishName">Dish Name</label>
  <input type="text" class="form-control" name="dishName" id="dishName" placeholder="Enter Dish name">
</div>


<div class="form-group">
<label for="description">Dish Price</label>
<input type="int" class="form-control" id="price" name="price" placeholder="Enter dish price">
</div>



<div class="form-group">
<label for="pic">Dish Picture</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="pic" name="pic" required>
    <label class="custom-file-label" for="pic">Choose dish picture</label>
  </div>

</div>

<button type="submit" class="btn btn-primary">Add Dish</button>
</form>

</div>
</div>
</body>
</html>
