<?php
if (empty($_COOKIE["lang"]) || $_COOKIE["lang"] == "en-US") {
	setcookie("lang", "et-EE", time()+2678400, "/");
}
if (empty($_GET["redir"])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='/'\" />";
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='index.php'\" />";
}
?>