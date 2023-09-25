<html>

<head>
  <meta http-equiv="refresh" content="0; url='../supermain.php'" />
</head>

<body>
  <p>If you were not redircted back, please follow <a href="../supermain.php">this link</a>.</p>

</html>
<?php
include "dbconnect.php";
include "checklogin.php";

$name = addslashes($_POST['name']);
$math = addslashes($_POST['math']);
$language = addslashes($_POST['language']);
$physics = addslashes($_POST['physics']);
$chemistry = addslashes($_POST['chemistry']);
$biology = addslashes($_POST['biology']);
$history = addslashes($_POST['history']);
$geography = addslashes($_POST['geography']);
$sports = addslashes($_POST['sports']);

print_r($_POST);
echo "<br>";

echo "<br>";
if (isset($_POST['CreateS'])) {

    //Add Student Data
    $sql = "INSERT INTO `scores`(`fullname`, `math`, `language`, `physics`, `chemistry`, `biology`, `history`, `geography`, `sports`) VALUES ('$name','$math','$language','$physics','$chemistry','$biology','$history','$geography','$sports')";
    $result = $mysqli->query($sql);

}
?>
</body>