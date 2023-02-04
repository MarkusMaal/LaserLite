<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$lang = "en-US";
if (!empty($_COOKIE["lang"])) {
	$lang = $_COOKIE["lang"];
}
if ($lang == "et-EE") {
	setcookie("lang", "en-US", time()+2678400, "/");
} else {
	setcookie("lang", "et-EE", time()+2678400, "/");
}
if (empty($_GET["redir"])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='/'\" />";
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='index.php'\" />";
}
?>
