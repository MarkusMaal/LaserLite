<?php
if (!empty($_POST["loginuser"])) {
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    $_SESSION = array();
    $username = filter_var($_POST["loginuser"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["loginpass"], FILTER_SANITIZE_STRING);
    include("../connect.php");
    $login_success = false;
    $query = "SELECT * FROM managers";
	$result = mysqli_query($connection, $query);	
	while ($row = mysqli_fetch_array($result)) {
		if ($row[1] == $username) {
			if ($row[4] == "0") {
				if ($row[2] == md5($password . "-" . $username . "-" . $row[0])) {
					$_SESSION["usr"] = $username;
					$_SESSION["level"] = str_replace("1", "owner", str_replace("0", "moderator", $row[3]));
					$login_success = true;
				}
			} else {
				$_SESSION["usr"] = $username;
				$_SESSION["level"] = str_replace("1", "owner", str_replace("0", "moderator", $row[3]));
				header("location: ../../markustegelane/common/config/update_pass.php");
			}
		}
	}
	include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/index.php");
    exit();
}
?>
