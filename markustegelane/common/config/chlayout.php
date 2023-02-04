<?php
$old_theme = "false";
if (!empty($_GET["val"])) {
	$old_theme = $_GET["val"];
} else if (!empty($_COOKIE["old_theme"])) {
	$old_theme = $_COOKIE["old_theme"];
	if ($old_theme == "false") {
		$old_theme = "true";
	} else {
		$old_theme = "false";
	}
}
setcookie("old_theme", $old_theme, time()+2678400, "/");
if (empty($_GET["redir"])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='/'\" />";
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='index.php'\" />";
}
?>
