<?php
//Variables to connect to database
$host = "localhost";
$username = "root";
$pass = "";
$database = "students";

//create connections
if(!$mysqli = new mysqli($host, $username, $pass, $database))
{
	die("Failed To Connect To Database");
}
?>