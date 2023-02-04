<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();



function getUserIP($saltysaltsalt)
{
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
		$ip = $forward;
	}
	else
	{
		$ip = $remote;
	}

	return hash("sha256", $ip . $saltysaltsalt);
}

$redir = "index.php";
if (!empty($_GET["redir"])) {
	$redir = "../../../" . $_GET["redir"];
}
include("getcookies.php");
if (! empty($_POST["loginuser"])) {
    $_SESSION = array();
	$savetoken = !empty($_POST["addtoken"]);
    $username = filter_var($_POST["loginuser"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["loginpass"], FILTER_SANITIZE_STRING);
    include("../connect.php");
    $login_success = false;
    $query = "SELECT * FROM managers";
	$result = mysqli_query($connection, $query);	
	$detecter = false;
	$uid = 0;
	while ($row = mysqli_fetch_array($result)) {
		if ($row["UNAME"] == $username) {
			$detecter = true;
			$uid = $row["ID"];
			if ($row["RECOVER_VERIFY"] == "0") {
				if ($row["UPASS"] == md5($password . "-" . $username . "-" . $row["ID"])) {
					$_SESSION["usr"] = $username;
					if (($row["ISOWNER"] == "0") && ($row["ISADMIN"] == "1")) {
						$_SESSION["level"] = "admin";
					} else {
						$_SESSION["level"] = str_replace("1", "owner", str_replace("0", "moderator", $row["ISOWNER"]));
					}
					$login_success = true;
				} else {
					session_destroy();
					include("../../errors/" . $lang . "/invalid_details.php");
					die();
				}
			} else {
				$_SESSION["usr"] = $username;
                echo "<script type='text/javascript'>document.location.href='update_pass.php';</script>";
				header("location: update_pass.php");
				die();
			}
		}
	}
	if ($detecter == false) {
		$_SESSION = array();
		session_destroy();
		include("../../errors/" . $lang . "/invalid_details.php");
		die();
	}
	if ($login_success == true) {
		if ($savetoken) {
			$expire = date("Y-m-d h:i:s", strtotime("+30 days"));
			$query = "INSERT INTO saved_sessions (USR_ID, TOKEN, EXPIRE) VALUES (" .
					 $uid . ", \"" . getUserIP($uid) . "\", (\"" . $expire . "\"))";
			
			$connection->query($query);
		}
        echo "<script type='text/javascript'>document.location.href='" . $redir . "';</script>";
	} else {
        echo "<script type='text/javascript'>document.location.href='login.php';</script>";
	}
    exit();
} else {
	include("loginform.php");
	if (empty($_GET["redir"])) {
		if ($lang == "et-EE") {
			echo '<script>alert("Palun täitke kõik vajalikud väljad.");</script>';
		} else {
			echo '<script>alert("Palun täitke kõik vajalikud väljad.");</script>';
		}
	}
}
?>
