<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

  <title>Profile Page</title>
</head>

<?php
include "functions/dbconnect.php";
include "functions/checklogin.php";

if ($_GET['ad'] == 1) {
  $admin = true;
} else {
  $admin = false;
}

$id = $_GET['id'];
$sql = "SELECT * FROM `scores` WHERE id Like '" . $id . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

$high1 = "";
$high2 = "";
$subjects = ["math", "language", "physics", "chemistry", "biology", "history", "geography", "sports"];
$scores_arr = array();
for ($i=0; $i < count($subjects) ; $i++) { 
  $scores_arr[$i] = $row[$subjects[$i]];
}

for ($i = 0; $i < count($subjects); $i++) {
  for ($j = $i + 1; $j < count($subjects); $j++) {
    if ($scores_arr[$i] <= $scores_arr[$j]) {
      $temp1 = $scores_arr[$i];
      $temp2 = $subjects[$i];
      $scores_arr[$i] = $scores_arr[$j];
      $subjects[$i] = $subjects[$j];
      $scores_arr[$j] = $temp1;
      $subjects[$j] = $temp2;
    }
  }
}

$high1 = $subjects[0];
$high2 = $subjects[1];
?>
<html>

<body>

  <!-- Nav Bar -->
  <div class="">
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
      <div class="container-fluid">
        <a class="navbar-brand" <?php if ($admin) {
                                  echo "href=\"supermain.php\"";
                                } else {
                                  echo "href=\"index.php\"";
                                } ?>>Student Score/Mark Assistance System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" <?php if ($admin) {
                                                        echo "href=\"adminpage.php\"";
                                                      } else {
                                                        echo "href=\"index.php\"";
                                                      } ?>>Home</a>
            </li>
            <li class="nav-item">
              <a <?php if ($admin) {
                    echo "class=\"nav-link disabled\"";
                  } else {
                    echo "class=\"nav-link\"";
                  } ?> href="supermain.php">Login As Supervisor</a>
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

    <!-- Profile Data -->
    <div class="container">
      <div class="row">
        <div class="col-8">
          <p class="fs-2 fw-bold">PROFILE</p>
          <?php echo "<p class=\"fs-3 fw-bold\" style=\"color:green\";\">Name: " . $row['fullname'] . "</p>"; ?>
          </div>
          <div style="width:700px;height:500px;">
            <canvas id="scorechart"></canvas>
          </div>
        <div class="col-4">
          <p class="fs-3 fw-bold">The Two Highest Subjects: 
            <b><u><?php 
            echo ucfirst($high1) . "</b></u>, and <b><u>" . ucfirst($high2) . "</b></u><br><br><br>";
          
            $sql2 = "SELECT * FROM `jobs` WHERE (subject1='". $high1 ."' AND subject2='". $high2 ."') OR (subject1='". $high2 ."' AND subject2='". $high1 ."')";
            $result2 = $mysqli->query($sql2);
            $row2 = $result2->fetch_assoc();
            if ($row2 != NULL) {
              echo "Suggested Jobs:<br><i>" . $row2['job'] . "</i>";
            } else {
              echo "Suggested Jobs:<br><i>[To Be Determined]</i>";
            }
          ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var scorchart = document.getElementById("scorechart").getContext('2d')
  var barChart = new Chart(scorechart,{
    type: 'bar',
    data: {
      labels:["Math","Language","Physics","Chemistry","Biology","History","Geography","Sports"],
      datasets: [{
        backgroundColor: [
          "#ffd322",
          "#ff344e",
          "#511091",
          "#5945fd",
          "#25d5f2",
          "#f56d0c",
          "#0dd41a",
          "#838591",
        ],
        <?php echo "data: [" . $row["math"] . "," . $row["language"] . "," . $row["physics"] . "," . $row["chemistry"] . "," . $row["biology"] . "," . $row["history"] . "," . $row["geography"] . "," . $row["sports"] . "]"?>
      }]
    },
    options:{
      legend: {
        display:false,
      }
    },
  })
</script>
</body>

</html>