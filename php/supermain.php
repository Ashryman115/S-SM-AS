<?php
session_start();

include("functions/dbconnect.php");
include("functions/checklogin.php");

$c_data = check_clogin($mysqli);
if (isset($_GET['logout']) == 1) {
  session_destroy();
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <title>Admin Page</title>
</head>

<body>

  <?php

  if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
  } else {
    $keyword = "";
  }

  //Show specific students
  $sql = "SELECT * FROM `scores` WHERE dName Like '%" . $keyword . "%'";
  $result = $mysqli->query($sql);
  ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
      <div class="container-fluid">
        <a class="navbar-brand" href="supermain.php">Student Score/Mark Assistance System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="supermain.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="login.php">Login As Supervisor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?logout=1">Logout</a>
            </li>
          </ul>
          <form class="d-flex" action="supermain.php">
            <input class="form-control me-2" name="keyword" type="search" placeholder="Search students" aria-label="Search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <br>
    <div class="container page-container">
    <div class="row justify-content-center">

      <!-- Create Student Profile-->

      <div class="col-6">
        <form class="justify-content-center form-control" method="POST" action="functions/createstudent.php" enctype="multipart/form-data">
          <legend style="text-align:center;">Add Student & Scores</legend>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="fname">Name:</label>
            </div>
            <div class="col">
              <input type="text" id="fname" name="name" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="math">Math:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="math" name="math" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="language">Language:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="language" name="language" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="physics">Physics:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="physics" name="physics" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="chemistry">Chemistry:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="chemistry" name="chemistry" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="biology">Biology:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="biology" name="biology" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="history">History:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="history" name="history" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="geography">Geography:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="geography" name="geography" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4" style="text-align: right;">
              <label for="sports">Sports:</label>
            </div>
            <div class="col">
              <input max='100' min='0' type="number" id="sports" name="sports" class="form-control">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="d-grid gap-2">
              <button id="create" name="CreateS" class="btn btn-primary">Create Student Profile</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>


<?php
    $mysqli->close();
?>

</body>

</html>