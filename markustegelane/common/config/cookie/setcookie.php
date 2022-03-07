<?php
    $lang = "en-US";
    if ($_GET["lang"] == "et") {
        $lang = "et-EE";
    }
    setcookie("lang", $lang, time()+2678400, "/");
    setcookie("theme", "light", time()+2678400, "/");
	echo '<meta http-equiv="refresh" content="0; url=/markustegelane" />';
?>
