<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	if (!empty($_COOKIE["mobile_mode"])) {
		$isMob = $_COOKIE["mobile_mode"];
		if ($isMob == "true") {
			setcookie("mobile_mode", "false", time()+2678400, "/");
		} else {
			setcookie("mobile_mode", "true", time()+2678400, "/");
		}
	} else {
		setcookie("mobile_mode", "true", time()+2678400, "/");
	}
	echo "<meta http-equiv=\"refresh\" content=\"0; url='index.php'\" />";
?>

