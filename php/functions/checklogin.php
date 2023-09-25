<?php
function check_clogin()
{

	if (isset($_SESSION['cLogID'])) {
		$id = $_SESSION['cLogID'];
		if ($id === "SupervisorAdmin") {
			$c_data = $id;
			return $c_data;
		}
	}

	header("Location: login.php");
	die;
}
