<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    	$fname = "result";
ini_set('display_errors', '1');
    	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) { $fname = "vaste"; }
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="' . $fname . '.html"');
	include("../connect.php");
	include("head.php");
	include("content.php");
	include("../foot.php");
?>
