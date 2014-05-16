<?php
	session_start();
	function logged_in() {
		return isset($_SESSION['webmail_id']);
	}
	function confirm_logged_in() {
		if (!logged_in()) {
		echo "<script> window.location.assign(\"http://127.0.0.1/categorize/categorize/index.php\") </script>";
	}
}
?>
