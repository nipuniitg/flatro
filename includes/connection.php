<?php 
	
	require("constants.php");
	// 1. Create a database connection
	//		(Use your own servername, username and password if they are different.)
	//		$connection allows us to keep refering to this connection after it is established
	
	
	$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
	if (!$con) {
		die("Database connection failed: " . mysql_error());
	}

	
?>