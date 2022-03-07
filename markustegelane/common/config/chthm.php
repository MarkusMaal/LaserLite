<?php
if (!empty($_COOKIE["theme"])) {
	$thm = $_COOKIE["theme"];
	if ($thm == "light") {
		setcookie("theme", "dark", time()+2678400, "/");
	} else if ($thm == "dark") {
		setcookie("theme", "blue", time()+2678400, "/");
	} else {
		setcookie("theme", "light", time()+2678400, "/");
	}
} else {
	setcookie("theme", "dark", time()+2678400, "/");
}
?>
<meta http-equiv="refresh" content="0; url='index.php'" />
