<?php
	session_start();
	
	unset($_SESSION['uid'] );
	unset($_SESSION['ufullname'] );

	echo "<script>";
	echo "window.location='index.php'; ";
	echo "</script>";	

?>