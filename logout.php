<?PHP

			include 'header.php';

	        session_destroy();

			//$_SESSION['do'] = '[ออกจากระบบสำเร็จ]';

			echo "<script type='text/javascript'>";
			echo  "alert('successfully logout');";
		    echo "window.location='index.php'";
			echo "</script>";

?>