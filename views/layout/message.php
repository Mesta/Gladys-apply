<?php

# ---------------------------------
# File : message.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

if(isset($_SESSION["notice"])){
	if(isset($_SESSION["notice"]["error"])){
		$errors = $_SESSION["notice"]["error"];
		
		foreach($errors as $message){
			echo "<div class='alert alert-danger' role='alert'>";
			echo $message;
			echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
			echo "</div>";
		}
		

		$_SESSION["notice"]["error"] = null;
	}

	if(isset($_SESSION["notice"]["success"])){
		$success = $_SESSION["notice"]["success"];
		
		foreach($success as $message){
			echo "<div class='alert alert-notice' role='alert'>";
			echo $message;
			echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
			echo "</div>";
		}
		

		$_SESSION["notice"]["success"] = null;
	}
}
?>