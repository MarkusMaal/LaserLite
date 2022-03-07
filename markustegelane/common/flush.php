<?php
function flush_file($location) {
	$lang = "en-US";
	if (!empty($_COOKIE["lang"])) {
		$lang = $_COOKIE["lang"];
	}
	for ($i = 1; $i < 10; $i++) {
		if ((empty($_GET["section"])) || ($_GET["section"] == $i)) {
			if (!empty($_POST[$location . $i])) {
				file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/content/" . $lang . "/" . $location . "/" . $i . ".php", str_replace(">", ">", str_replace("<", "<", $_POST[$location . $i])));
			}
		}
	}
}
?>
