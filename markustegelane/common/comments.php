<?php

ini_set('display_errors', '0');
function ms ($en, $et) {
	if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US")) {
		return $en;
	} else {
		return $et;
	}

}

function getUserIP()
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

    return md5($ip);
}

function DisplayComments($connection, $comment, $page, $depth, $thread) {
	$authuser = "";
	$pref = "";
	$suf = "";
	if (($thread == 4) && (empty($_SESSION["level"])) && ($_SESSION["level"] != "owner") && ($_SESSION["level"] != "admin")) {
		if (empty($_POST)) {
			die(ms("Access is denied", "Juurdepääs on keelatud"));
		} else {
			$authuser = md5($_POST["name"] . ":" . $_POST["pass"]);
		}
	}
	if (($comment["hide"] == 1) && (empty($_SESSION)))
	{
		return;
	}
	$dp = 50 * $depth;
	$custstyle = "\"float: right; margin-left: 10px; font-style: normal;\"";
	$custstyle2 = "\"float: left; margin-right: 10px; font-style: normal;\"";
	echo '<div style="margin-left: ' . $dp . 'px;">';
	$usrname = $comment["NAME"];
	$badge = "";
	if (substr($usrname, 0, 2) == "id") {
		$backup = $usrname;
		$usrname = substr($usrname, 2);
		$technical_id = explode("_", $usrname)[0];
		$query1 = "SELECT * FROM managers";
		$result = mysqli_query($connection, $query1);
		$good = false;
		while ($row = mysqli_fetch_array($result)) {
			if (md5($row["ID"] . $row["UNAME"] . $row["UPASS"] . $row["RECOVERYCODE"] . $comment["COMMENT"]) == $technical_id) {
				$good = true;
				if (($row["ISADMIN"] == "1") && ($row["ISOWNER"] == "1")) {
					$badge = "dev";
					$usrname = $row["UNAME"];
				}
				else if (($row["ISADMIN"] == "1") && ($row["ISOWNER"] == "0")) {
					$badge = "admin";
					$usrname = $row["UNAME"];
				}
				else if (($row["ISADMIN"] == "0") && ($row["ISOWNER"] == "0")) {
					$badge = "mod";
					$usrname = $row["UNAME"];
				}
			}
		}
		if (!($good)) {
			$usrname = $backup;
		}
	}
	if ($badge == "admin") {
		$pref = "<span style=\"background: #008; color: #fff; padding: 5px; border-radius: 15px;\">";
		$suf = "</span>";
	} else if ($badge == "mod") {
		$pref = "<span style=\"background: #800; color: #fff; padding: 5px; border-radius: 15px;\">";
		$suf = "</span>";
	} else if ($badge == "dev") {
		$pref = "<span style=\"background: #080; color: #fff; padding: 5px; border-radius: 15px;\">";
		$suf = "</span>";
	}
	echo '<br/>' . $pref . htmlspecialchars($usrname, ENT_QUOTES, 'UTF-8') . $suf;
	if ($badge != "") {
		echo '<a style="margin-left: 5px;" href="../../../../../markustegelane/index.php?doc=about&s=2" target="_blank">?</a>';
	}
	echo ' <a style=' . $custstyle . ' href="../../../../../markustegelane/common/manage.php?cid=' . $comment["ID"] . '">' . ms("manage", "halda") . '</a>';
	if (!empty($_SESSION)) 
	{
		if ($comment["hide"] == 1) {
			echo ' <a style=' . $custstyle . ' href="../../../../../markustegelane/common/moderate.php?cid=' . $comment["ID"] . '&s=3">' . ms("restore", "taasta") . '</a>';	
		} else {
			echo ' <a style=' . $custstyle . ' href="../../../../../markustegelane/common/moderate.php?cid=' . $comment["ID"] . '&s=1">' . ms("hide", "peida") . '</a>';	
		}
		if (($_SESSION["level"] == "admin") || ($_SESSION["level"] == "owner")) {
			echo ' <a style=' . $custstyle . ' href="../../../../../markustegelane/common/moderate.php?cid=' . $comment["ID"] . '&s=2">' . ms("delete", "kustuta") . '</a>';	
			echo ' <a style=' . $custstyle . ' href="../../../../../markustegelane/common/moderate.php?cid=' . $comment["ID"] . '&s=4">' . ms("reset password", "paroolitaaste") . '</a>';	
		}
	}
	echo '<br/>';
	echo '<p>' . htmlspecialchars(nl2br($comment["COMMENT"]), ENT_QUOTES, 'UTF-8') .'</p>';
	echo '<p>';
	$q1 = "SELECT * FROM client_ratings WHERE CID = " . $comment["ID"] . " AND POSITIVE = 1";
	$q2 = "SELECT * FROM client_ratings WHERE CID = " . $comment["ID"] . " AND POSITIVE = 0";
	$re1 = mysqli_query($connection, $q1);
	$likes = mysqli_num_rows($re1) + $comment["likes"];
	$re2 = mysqli_query($connection, $q2);
	$dislikes = mysqli_num_rows($re2) + $comment["dislikes"];
	
	echo '<a style=' . $custstyle2 . ' href="../../../../../markustegelane/common/post.php?th=' . $thread . '&id=' . $page . '&rid=' . $comment["ID"] . '&auth=' . $authuser . '">' . ms("Reply", "Vasta") . '</a>';
	if ($comment["heart"] == 1) {
		echo '<span style=' . $custstyle2 . '>&#128159;</span>';
	}
	echo '<a style=' . $custstyle2 . ' href="../../../../../markustegelane/common/like.php?id=' . $comment["ID"] . '"><span style=' . $custstyle2 . '>&#128077;</span>' . $likes . '</a><a style=' . $custstyle2 . ' href="../../../../../markustegelane/common/dislike.php?id=' . $comment["ID"] . '"><span style=' . $custstyle2 . '>&#128078;</span>' . $dislikes . '</a>';
	echo '</p><br/><br/>';
	echo '</div>';
	$r2 = mysqli_query($connection, "SELECT * FROM general_comments WHERE PAGE_ID = " . $page . " AND THREAD = " . $thread . " AND REPLY = 1 AND REPLY_PARENT = " . $comment["ID"]);
	if (mysqli_num_rows($r2) > 0) {
		while ($rep = mysqli_fetch_array($r2)) {
			DisplayComments($connection, $rep, $page, $depth + 1, $thread);
		}
	}
}?>
