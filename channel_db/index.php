<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
if (!empty($_GET["q"])) {
	if (str_contains($_GET["q"], "';") || str_contains($_GET["q"], "\";") || str_contains($_GET["q"], "<script>")) {
		echo '<head><style>body { background: #000; color: #0f0; }</style></head><body><p>You are just a dirty hacker, aren\'t you?</p>';
		echo '<meta http-equiv="Refresh" content="0; URL=https://www.youtube.com/watch?v=pgl37R7hILE&autoplay=1"></body>';
		die();
	}
}
$query = "";
$channel = "";?>
<?php 
include("connect.php");
include("head.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");?>
<?php include("content.php"); ?>
<?php include("foot.php"); ?>
