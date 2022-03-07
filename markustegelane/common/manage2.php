<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include("connect.php");
include("../../mobcheck.php");
if (empty($_POST)) {
	die("Catastrophic error // Katastroofiline viga");
} else {
	$finish = false;
	$error = "";
	$invalidpass = false;
	if (!empty($_POST["newcomment"])) {
		// muuda kommentaari
		$newcomment = mysqli_real_escape_string($connection, $_REQUEST['newcomment']);
		$authuser = md5($_POST["name"] . ":" . $_POST["pass"]);
		$good = false;
		
		$comment = mysqli_real_escape_string($connection, $_REQUEST['newcomment']);
		$query1 = "SELECT ID, UPASS, RECOVERYCODE FROM managers WHERE UNAME = \"" . $_SESSION["usr"] . "\"";
		$result = mysqli_query($connection, $query1);
		$row = mysqli_fetch_array($result);
		$uid = md5($row["ID"] . $_SESSION["usr"] . $row["UPASS"] . $row["RECOVERYCODE"] . $comment);
		$usrname = "id" . $uid . "_" . $_SESSION["usr"];
		
		$query = "UPDATE general_comments SET COMMENT = \"" . $newcomment . "\" WHERE ID = " . $_GET["id"];
		if ($connection->query($query) === TRUE) {
			$finish = true;
		} else {
			$finish = false;
			$error = $connection->error;
		}
		$query = "UPDATE general_comments SET NAME = \"" . $usrname . "\" WHERE ID = " . $_GET["id"];
		if ($connection->query($query) === TRUE) {
			$finish = true;
		} else {
			$finish = false;
			$error = $connection->error;
		}
	}
	else if (!empty($_POST["confirm"])) {
		// muuda kommentaari
		$finish1 = false;
		$finish2 = false;
		$query = "DELETE FROM client_ratings WHERE cid = " . $_GET["id"];
		if ($connection->query($query) === TRUE) {
			$finish1 = true;
		} else {
			$error = $connection->error;
		}
		$query = "DELETE FROM comment_managers WHERE cid = " . $_GET["id"];
		if ($connection->query($query) === TRUE) {
			$finish1 = true;
		} else {
			$error = $connection->error;
		}
		$query = "DELETE FROM general_comments WHERE ID = " . $_GET["id"];
		if ($connection->query($query) === TRUE) {
			$finish2 = true;
		} else {
			$error = $error . '<br/>' . $connection->error;
		}
		if (($finish1) && ($finish2)) {
			$finish = true;
		}
	}
	else if (!empty($_POST["newpass"])) {
		// muuda parooli
		$newpass = mysqli_real_escape_string($connection, $_REQUEST['newpass']);
		$query = "UPDATE comment_managers SET code = MD5(CONCAT(" . $_GET["id"] . ", \"" . $newpass . "\")) WHERE cid = " . $_GET["id"];
		if ($connection->query($query) === TRUE) {
			$finish = true;
		} else {
			$error = $connection->error;
		}
	}
	else {
		// eelmisest sammust
		if (!empty($_SESSION["usr"])) {			
			$query = "SELECT * FROM general_comments WHERE ID = " . $_GET["id"];
			$res = mysqli_query($connection, $query);
			
			$mycomment = mysqli_fetch_array($res);
			if (strpos($mycomment["NAME"], '_') !== false) {
				$original_usr = explode("_", $mycomment["NAME"])[1];
				if ($original_usr != $_SESSION["usr"]) {
					$invalidpass = true;
				} else {
					$invalidpass = false;
					$task = $_POST["action"];
				}
			} else {
				$invalidpass = true;
			}
		}
		if (($invalidpass) || (empty($_SESSION["usr"]))) {
			$invalidpass = false;
			$query = "SELECT * FROM comment_managers WHERE cid = " . $_GET["id"];
			$result = mysqli_query($connection, $query);
			$row = mysqli_fetch_array($result);
			$pass = mysqli_real_escape_string($connection, $_REQUEST['pass']);
			if (md5($_GET["id"] . $pass) != $row["code"]) {
				$invalidpass = true;
				$_POST = array();
			} else {
				$task = $_POST["action"];
				$_POST = array();
			}
		}
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
		<title><?php echo ms("Manage comment", "Kommentaari haldamine")?></title>
        <?php include("loadtheme.php"); ?>
	</head>
	<body>
		<a href=".."><img center class="banner" src="../gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a>
		<div class="mainpage">
			<h2><?php echo ms("Manage comment", "Kommentaari haldamine")?></h2>
			<p>
			<?php
				if ($invalidpass) {
					echo '<p><span style="color: #f00;">' . ms("Error: ", "Viga: ");
					echo '</span>';
					echo ms("Invalid password or locked comment", "Vale parool või lukustatud kommentaar");
					echo $error . '</p>';
					die('<a href="../..">' . ms("Go back", "Tagasi avalehele") . '</a>');
				}
				if ($error != "") {
					echo '<p><span style="color: #f00;">' . ms("Error: ", "Viga: ");
					echo '</span>';
					echo $error . '</p>';
					die('<a href="../..">' . ms("Go back", "Tagasi avalehele") . '</a>');
				}
				if ($finish) {
					echo '<p>' . ms("Task finished", "Toiming lõpetati") . '</p>';
					die('<a href="../..">' . ms("Go back", "Tagasi avalehele") . '</a>');
				}
				if (!empty($_GET["id"])) {
					echo '<hr>';
					
					$result = mysqli_query($connection, "SELECT * FROM general_comments WHERE ID = " . $_GET["id"]);
					$good = false;
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
									$good = true;
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
			<form action="manage2.php?id=<?php echo $_GET["id"]; ?>" method="post" name="form1">
				<p><?php echo ms("Action", "Toiming");?>: <?php 
				if ($task == "mod") {
					echo ms("Change comment", "Muuda kommentaari");
				} else if ($task == "del") {
					echo ms("Delete commment", "Kustuta kommentaar");
				} else if ($task == "chp") {
					echo ms("Change password", "Muuda parooli");
				}
				?></p>
				<table style="width: 90%">
				<tr><td>
				<?php
					if ($task == "mod") {
						if ($lang == "et") {
							echo 'Uus kommentaar';
						} else {
							echo 'New comment';
						}
					}
					else if ($task == "del") {
						if ($lang == "et") {
							echo 'Kinnita kustutamine';
						} else {
							echo 'Confirm deletion';
						}
					}
					else if ($task == "chp") {
						if ($lang == "et") {
							echo 'Muuda parooli';
						} else {
							echo 'Change password';
						}
					}
				?>: </td><td>
				<?php
					if ($task == "mod") {
						echo '<textarea style="width: 100%; height: 200px" name="newcomment"></textarea>';
					} else if ($task == "del") {
						echo '<input type="checkbox" name="confirm">' . ms("I understand that this comment will no longer be visible to others or the server administrators",
							 "Ma mõistan, et see kommentaar pole enam nähtav teistele või serveri administraatoritele") . '</input>';
					} else if ($task == "chp") {
						echo '<input type="password" name="newpass"></input>';
					}
				?></td>
				</tr>
				</table><br/>
				<input type="submit" value="<?php echo ms("Finish", "Lõpeta"); ?>"></input>
			</form>
		</div>
	</body>
</html>
