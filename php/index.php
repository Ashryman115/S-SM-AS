<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <title>Home Page</title>
</head>

<?php
include "functions/dbconnect.php";

if (isset($_GET['keyword'])) {
  $keyword = $_GET['keyword'];
} else {
  $keyword = "";
}

//Show specific students
$sql = "SELECT * FROM `scores` WHERE fullname Like '%" . $keyword . "%'";
$result = $mysqli->query($sql);
?>

<body>

  <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Student Score/Mark Assistance System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link disabled" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="supermain.php">Login As Supervisor</a>
            </li>
          </ul>
          <form class="d-flex" action="index.php">
            <input class="form-control me-2" name="keyword" type="search" placeholder="Search Students" aria-label="Search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <br>
    
  <div class="container page-container">
    <?php
    if (empty($keyword)) {
      echo "<h2>Students:</h2>";
    } else {
      echo "<h2>Displaying Results for " . $keyword . ":</h2>";
    }
    ?>

    <hr>

    <div class="container">

      <?php
      while ($row = $result->fetch_assoc()) {
        echo "<div class=\"form-control prev\" onclick=\"window.location.href = 'profile.php?id=" . $row['id'] . "&ad=0'\" style=\"cursor: pointer;\">";
        echo "<div class=\"row\">";
        echo "<h5>Name: " . $row["fullname"] . "</h5>";
        echo "</div>";
        echo "</div><br>";
      }

      ?>
    </div>
  </div>
</body>

</html>