<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    $fname = "channel_db_" . date("Y") . "-" . date("m") . "-" . date("d") . "_" . date("h") . "-" . date("i") . "-" . date("s");
    if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) { $fname = "vaste"; }
    function ms($en, $et) {
	if (!empty($_COOKIE["lang"])) {
		if ($_COOKIE["lang"] == "et-EE") {
			return $et;
		} else {
			return $en;
		}
	   } else {
			return $en;
	   } 
	}
	if (empty($_COOKIE["reportformat"]) || $_COOKIE["reportformat"] == "html") {
		header('Content-type: text/plain');
		header('Content-Disposition: attachment; filename="' . $fname . '.html"');
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/report/index.php");
	} else if ($_COOKIE["reportformat"] == "json") {
		header('Content-type: application/json');
		header('Content-Disposition: attachment; filename="' . $fname . '.json"');
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/report/index.php");
	} else if ($_COOKIE["reportformat"] == "csv") {
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename="' . $fname . '.csv"');
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/report/index.php");
	}
?>
