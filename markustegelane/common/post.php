<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include("connect.php");
include("../../mobcheck.php");
$badge = "none";
$godmode = ((!empty($_SESSION)) && (($_SESSION["level"] == "owner") || ($_SESSION["level"] == "admin")));
if (!$godmode) {
	if (empty($_GET["auth"])) {
		if ((!empty($_GET["th"])) && ($_GET["th"] == 4)) {
			die("Access is denied. // Juurdepääs keelatud.");
		}
	} else {
			$sql = "SELECT * FROM feedback_users WHERE CRYPTCODE=\"" . $_GET["auth"] . "\"";
			$r1 = mysqli_query($connection, $sql);
			if (!((mysqli_num_rows($r1) > 0))) {
				die("Access is denied. // Juurdepääs keelatud.");
			}
			$me = mysqli_fetch_array($r1)[0];
			if (($_GET["id"] != $me)) {
				die("Access is denied. // Juurdepääs keelatud.");
			}
	}
}
if (!empty($_POST)) {
	$reply = 0;
	$rid = "NULL";
	$success = 0;
	$error = "";
	if (!empty($_GET["rid"])) {
		$reply = 1;
		$rid = $_GET["rid"];
	}
	$comment = mysqli_real_escape_string($connection, $_REQUEST['comment']);
	if (empty($_REQUEST['usrname']) && (!empty($_SESSION["usr"]))) {
		$query1 = "SELECT ID, UPASS, RECOVERYCODE FROM managers WHERE UNAME = \"" . $_SESSION["usr"] . "\"";
		$result = mysqli_query($connection, $query1);
		$row = mysqli_fetch_array($result);
		$uid = md5($row["ID"] . $_SESSION["usr"] . $row["UPASS"] . $row["RECOVERYCODE"] . $comment);
		$usrname = "id" . $uid . "_" . $_SESSION["usr"];
	} else {
		$usrname = mysqli_real_escape_string($connection, $_REQUEST['usrname']);
	}
	if (empty($_POST["pass"])) {
		$usrpasswd = "";
	} else {
		$usrpasswd = mysqli_real_escape_string($connection, $_REQUEST['pass']);
	}
	$query = "INSERT INTO general_comments (NAME, COMMENT, THREAD, REPLY, REPLY_PARENT, PAGE_ID, LIKES, DISLIKES, HEART) VALUES (" .
			 "\"" . $usrname . "\", " .
			 "\"" . $comment . "\", " .
			 $_GET["th"] . ", " .
			 $reply . ", " .
			 $rid . ", " .
			 $_GET["id"] . ", 0, 0, 0)";
	if ($connection->query($query) === TRUE) {
		$success = 1;
	} else {
		$error = $connection->error;
	}
	$query2 = "SELECT * FROM general_comments";
	$result2 = mysqli_query($connection, $query2);
	$id = "";
	while ($row2 = mysqli_fetch_array($result2)) {
		$id = $row2[0];
	}
	$success = 0;
	$query3 = "INSERT INTO comment_managers (cid, code) VALUES (" . $id . ", MD5(CONCAT(\"" . $id . "\", \"" . $usrpasswd . "\")))";
	if ($connection->query($query3) === TRUE) {
	 	$success = 1;
	} else {
		$error = $connection->error;
	}
}
?>
<!DOCTYPE html>
<html lang="<?php
if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
echo 'et';
$lang = "et";
} else {
echo 'en';
$lang = "en";
}


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

?>">
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
		<title><?php echo ms("Post comment", "Kommentaari postitamine")?></title>
		<?php
            if (empty($_COOKIE["theme"])) {
                $theme = 'light';
            } else {
                $theme = $_COOKIE["theme"];
            }
            ?>
            <link rel="stylesheet" href="themes/<?php echo $theme;	if ($isMob) {  echo "_m"; 	} ?>.css">
	</head>
	<body>
		<a href=".."><img center class="banner" src="../gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a>
		<div class="mainpage">
			<h2><?php echo ms("Post comment", "Kommentaari postitamine")?></h2>
			<p>
			<?php
				if (!empty($_POST)) {
					if ($success) {
						echo "<p style=\"color: #0f0;\">";
						echo ms("Comment successfully posted", "Kommentaar postitati edukalt");
						echo "</p>";
						echo '<br/><br/><a href="#" onclick="javascript:window.history.back(-2);return false;">' . ms("Back", "Tagasi") . '</a>';
					} else {
						echo "<p style=\"color: #f00;\">";
						echo ms("Error posting comment", "Kommentaari postitamine nurjus");
						echo "</p>";
						echo '<br/><br/><a href="#" onclick="javascript:window.history.back(-2);return false;">' . ms("Back", "Tagasi") . '</a>';
					}
					die("<p>" . $error . "</p>");
				}
				if ($lang == "et") {
					if (!empty($_GET["th"])) {
						switch ($_GET["th"]) {
							case 1:
								echo 'Kanali andmebaas';
								break;
							case 2:
								echo 'Allalaaditav fail';
								break;
							case 3:
								echo 'Blogipostitus';
								break;
							case 4:
								echo 'Privaatsõnum';
								break;
						}
						if (!empty($_GET["id"])) {
							echo ' (ID: ' . $_GET["id"] . ')';
						}
						echo '</p><p>'; 
						if (empty($_GET["rid"])) {
							echo 'Eraldiseisev kommentaar';
						} else {
							echo 'Vastus eksisteerivale kommentaarile';
						}
						echo '</p>';
					} else {
						die();
					}
				} else {
					if (!empty($_GET["th"])) {
						switch ($_GET["th"]) {
							case 1:
								echo 'Channel database';
								break;
							case 2:
								echo 'Downloadable file';
								break;
							case 3:
								echo 'Blog post';
								break;
							case 4:
								echo 'Private message';
								break;
						}
						if (!empty($_GET["id"])) {
							echo ' (ID: ' . $_GET["id"] . ')';
						}
						echo '</p><p>'; 
						if (empty($_GET["rid"])) {
							echo 'Standalone comment';
						} else {
							echo 'Reply to an existing commnent';
						}
						echo '</p>';
						ini_set('display_errors', '1');
					} else {
						die();
					}
				}
				if (!empty($_GET["rid"])) {
					echo '<hr>';
					$result = mysqli_query($connection, "SELECT * FROM general_comments WHERE ID = " . $_GET["rid"]);
					while ($row = mysqli_fetch_array($result)) {
						$usrname = $row["NAME"];
						$suf = "";
						$pref = "";
						if (substr($usrname, 0, 2) == "id") {
							$usrname = substr($usrname, 2);
							$technical_id = explode("_", $usrname)[0];
							$query1 = "SELECT * FROM managers";
							$result = mysqli_query($connection, $query1);
							while ($r1 = mysqli_fetch_array($result)) {
								if (md5($r1["ID"] . $r1["UNAME"] . $r1["UPASS"] . $r1["RECOVERYCODE"] . $row["COMMENT"]) == $technical_id) {
									if (($r1["ISADMIN"] == "1") && ($r1["ISOWNER"] == "1")) {
										$badge = "dev";
										$usrname = $r1["UNAME"];
									}
									else if (($r1["ISADMIN"] == "1") && ($r1["ISOWNER"] == "0")) {
										$badge = "admin";
										$usrname = $r1["UNAME"];
									}
									else if (($r1["ISADMIN"] == "0") && ($r1["ISOWNER"] == "0")) {
										$badge = "mod";
										$usrname = $r1["UNAME"];
									}
								}
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
						echo '<h2>' . $pref . $usrname . $suf . '</h2>';
						echo '<p>' . $row["COMMENT"] . '</p>';
					}
					echo '<hr>';
				}
			?></p>
			<form action="post.php?id=<?php echo $_GET["id"]; ?>&th=<?php echo $_GET["th"]; ?>&rid=<?php if (!empty($_GET["rid"])) { echo $_GET["rid"]; }?>&auth=<?php if (!empty($_GET["auth"])) { echo $_GET["auth"]; }?>" method="post" name="form1">
			<table style="width: 90%">
			<?php 
				echo '<tr><td>';
				if ($lang == "et") {
					echo 'Kasutajanimi';
				} else {
					echo 'Username';
				}
				echo ': </td><td>';
				if (empty($_SESSION["usr"])) {
					echo '<input name="usrname" style="width: 100%;"></input></td>
				 		  </tr>';
				} else {
					if ($_SESSION["level"] == "admin") {
						$style = "\"background: #008; color: #fff; padding: 5px; border-radius: 15px;\"";
					}
					else if ($_SESSION["level"] == "owner") {
						$style = "\"background: #080; color: #fff; padding: 5px; border-radius: 15px;\"";
					}
					else if ($_SESSION["level"] == "moderator") {
						$style = "\"background: #800; color: #fff; padding: 5px; border-radius: 15px;\"";
					}
					echo '<span style=' . $style . '>' . $_SESSION["usr"] . '</span> <a href="../index.php?doc=about&s=2" target="_blank">?</a>';
				}
			?>
			<?php
			?>
			<tr>
			<td>
			<?php
				if ($lang == "et") {
					echo 'Kommentaar';
				} else {
					echo 'Comment';
				}
			?>: </td><td>
			<textarea name="comment" style="width: 100%; height: 200px"></textarea></td>
			</tr>
			<?php
				echo '<tr><td>';
				if ($lang == "et") {
					echo 'Parool<br/>(hilisemaks muutmiseks<br/>või kustutamiseks)';
				} else {
					echo 'Password <br/>(for modifying<br/>or deleting the comment later)';
				}
				echo ': </td><td>';
				if (empty($_SESSION["usr"])) {
					echo '<input type="password" name="pass" style="width: 100%;"></input></td></tr>';
				} else {
					if ($lang == "et") {
						echo 'Seotud teie kasutajakontoga</td>';
					} else {
						echo 'Tied to your user account</td>';
					}
				}?>
			</table>
			<br/><input type="submit" value="<?php 
				if ($lang == "et") {
					echo 'Postita';
				} else {
					echo 'Post';
				}
			?>"></input>
			</form>
		</div>
	</body>
</html>
