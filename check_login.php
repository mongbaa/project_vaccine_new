<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

//กรณีต้องการเก็บ log file
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '../error_log.txt');


include "config.inc.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php


if (isset($_POST['username'])  && !empty($_POST['username'])) {
	$user = $conn->real_escape_string($_POST['username']);
} else {
	$user = 0;
}


if (isset($_POST['password'])  && !empty($_POST['password'])) {
	$pass = $conn->real_escape_string($_POST['password']);
} else {
	$pass = 0;
}




				$sql_staff = "select * from tbl_staff  where  staff_username ='$user' and staff_password ='$pass' and staff_status = 1";
				$objQuery_staff = $conn ->query($sql_staff);
				$objResult_staff = $objQuery_staff->fetch_assoc();

			  if(isset($objResult_staff)){


				$_SESSION['UserLogin_id'] = $objResult_staff["staff_id"];
				$_SESSION['staff_id'] = $objResult_staff["staff_id"];
				$_SESSION["staff_name"] = $objResult_staff["staff_name"];
				$_SESSION["staff_lastname"] = $objResult_staff["staff_lastname"];
				$_SESSION["staff_username"] = $objResult_staff["staff_username"];
				$_SESSION["level_id"] = $objResult_staff["level_id"];
				$_SESSION["UserLogin"] = $objResult_staff["staff_username"];


				   $_SESSION['do'] = '[Successfully logged in Welcome to login]';
				   echo "<script wg='text/javascript'>";
				   echo "window.location='index.php';";
				   echo "</script>";

			  }else{

					$_SESSION['error'] = 'error_login';
					echo "<script wg='text/javascript'>";
					echo "window.location='index.php';";
					echo "</script>";

			  }


?>