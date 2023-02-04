<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/gip.php");

if (empty($_SESSION["usr"])) {
	$flip_managers = mysqli_query($connection, "SELECT * FROM managers");
	$token_result = mysqli_query($connection, "SELECT * FROM saved_sessions");
	while ($row = mysqli_fetch_array($flip_managers)) {
		while ($trow = mysqli_fetch_array($token_result)) {
			if (getUserIPs($row["ID"]) == $trow["TOKEN"]) {
				if (date($trow["EXPIRE"]) > date("Y-m-d h:i:s")) {
					$_SESSION["usr"] = $row["UNAME"];
					$_SESSION["level"] = "moderator";
					if ($row["ISADMIN"]) {
						$_SESSION["level"] = "admin";
					}
					if ($row["ISOWNER"]) {
						$_SESSION["level"] = "owner";
					}
					$query = "UPDATE saved_sessions SET EXPIRE = (\"" . date("Y-m-d h:i:s", strtotime("+30 days")) . "\") WHERE ID = " . $trow["ID"];
					$connection->query($query);
				} else {
					$query = "DELETE FROM saved_sessions WHERE ID = " . $trow["ID"];
					$connection->query($query);
				}
			}
		}
	}
}
?>