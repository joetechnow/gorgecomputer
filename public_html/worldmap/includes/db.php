<?php
	$server = "localhost";
	$username = "gorgecom_temp";
	$password = "W0rldM@p";
	$db = "gorgecom_worldmap";

	$conn = mysqli_connect($server, $username, $password, $db);


	 if (!($conn)) {
	 	echo "not connected to db";
	}
 ?>