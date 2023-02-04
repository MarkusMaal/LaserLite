<?php
    $lang = "en-US";
	if (!empty($_GET["lang"])) {
		if ($_GET["lang"] == "et") {
			$lang = "et-EE";
		}
	}
    setcookie("lang", $lang, time()+2678400, "/");
    setcookie("theme", "blue", time()+2678400, "/");
	//echo '<meta http-equiv="refresh" content="0; url=/" />';
?>
