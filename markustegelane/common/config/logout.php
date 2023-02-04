<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/gip.php");
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
$dest = -1;
$flip_managers = mysqli_query($connection, "SELECT * FROM managers");
$token_result = mysqli_query($connection, "SELECT * FROM saved_sessions");
while ($row = mysqli_fetch_array($flip_managers)) {
	while ($trow = mysqli_fetch_array($token_result)) {
		if (getUserIPs($row["ID"]) == $trow["TOKEN"]) {
			$dest = $trow["ID"];
		}
	}
}
$query = "DELETE FROM saved_sessions WHERE ID = " . $dest;
$connection->query($query);
$_SESSION = array();
session_destroy();
if (empty($_GET["redir"])) {
	echo "<script type='text/javascript'>document.location.href='index.php';</script>";
} else {
	echo "<script type='text/javascript'>document.location.href='" . $_GET["redir"] . "';</script>";
}
exit();
?>
