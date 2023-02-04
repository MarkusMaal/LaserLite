<?php
if (empty($_COOKIE["lang"]) || $_COOKIE["lang"] == "et-EE") {
	setcookie("lang", "en-US", time()+2678400, "/");
}
if (empty($_GET["redir"])) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='/'\" />";
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url='index.php'\" />";
}
?>