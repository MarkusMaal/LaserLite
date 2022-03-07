<?php
$lang = "en-US";
if (!empty($_COOKIE["lang"])) {
	$lang = $_COOKIE["lang"];
}
if (!empty($_GET["lang"])) {
	$lang = $_GET["lang"];
}
$thm = "light";
if (!empty($_COOKIE["theme"])) {
	$thm = $_COOKIE["theme"];
}
if (!empty($_GET["theme"])) {
	$thm = $_GET["theme"];
}
if (!empty($recovery)) {
    if ($recovery != true) {
        if ((!empty($_SESSION["usr"])) && (empty($_SESSION["level"]))) {
            echo "<script type='text/javascript'>document.location.href='logout.php';</script>";
        }
    }
}
?>
