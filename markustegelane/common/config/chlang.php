<?php
if (!empty($_COOKIE["lang"])) {
	$lang = $_COOKIE["lang"];
	if ($lang == "et-EE") {
		setcookie("lang", "en-US", time()+2678400, "/");
	} else {
		setcookie("lang", "et-EE", time()+2678400, "/");
	}
} else {
	setcookie("lang", "et-EE", time()+2678400, "/");
}
$lang = $_COOKIE["lang"];
echo "<meta http-equiv=\"refresh\" content=\"0; url='index.php'\" />";
?>
