<?php
$thm = "blue";
if (!empty($_COOKIE["theme"])) {
	$thm = $_COOKIE["theme"];
}
if (empty($_GET["type"]) ) {
if ($thm == "light") {
	setcookie("theme", "dark", time()+2678400, "/");
} else if ($thm == "dark") {
	setcookie("theme", "blue", time()+2678400, "/");
} else {
	setcookie("theme", "light", time()+2678400, "/");
}
} else {
	setcookie("theme", $_GET["type"], time()+2678400, "/");
}
if (empty($_GET["redir"])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='../../..'\" />";
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='index.php'\" />";
}
?>
