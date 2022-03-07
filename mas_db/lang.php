<?php
function ms($en, $et) {
	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
		return $et;
	} else {
		return $en;
	}
}
function GetEnd($n) {
	$suf = mb_substr($n, -1);
	if ($suf == "1") {
		return "st";
	}
	else if ($suf == "2") {
		return "nd";
	}
	else if ($suf == "3") {
		return "rd";
	}
	else {
		return "th";
	}
}

function y() {
	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
 		return "Jah";
 	} else {
 		return "Yes";
 	}
}
function n() {
	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
 		return "Ei";
 	} else {
 		return "No";
 	}
}

?>