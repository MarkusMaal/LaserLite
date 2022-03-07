<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include("connect.php");
include("../../mobcheck.php");
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
        <?php
        if (empty($_COOKIE["theme"])) {
            $theme = 'light';
        } else {
            $theme = $_COOKIE["theme"];
        }
        ?>
        <link rel="stylesheet" href="themes/<?php echo $theme;	if ($isMob) {  echo "_m"; 	} ?>.css">
		<title><?php echo ms("Manage comment", "Kommentaari haldamine")?></title>
	</head>
	<body>
		<a href=".."><img center class="banner" src="../gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a>
		<div class="mainpage">
			<h2><?php echo ms("Manage comment", "Kommentaari haldamine")?></h2>
			<p>
			<?php
				if (!empty($_POST)) {
					if ($success) {
						echo "<p style=\"color: #0f0;\">";
						echo ms("Task completed successfully", "Toiming õnnestus");
						echo "</p>";
					} else {
						echo "<p style=\"color: #f00;\">";
						echo ms("Task failed to complete successfully", "Toiming nurjus");
						echo "</p>";
					}
					die("<p>" . $error . "</p>");
				}
				if (!empty($_GET["cid"])) {
					echo '<hr>';
					$result = mysqli_query($connection, "SELECT * FROM general_comments WHERE ID = " . $_GET["cid"]);
					$good = false;
					$badge = "nobody";
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
			<form action="manage2.php?id=<?php echo $_GET["cid"]; ?>" method="post" name="form1">
				<?php
				if (!($good)) {
					echo '<table style="width: 90%"><tr><td>';
					if ($lang == "et") {
						echo 'Haldamisparool';
					} else {
						echo 'Management password';
					}
					echo ': </td><td>';
					echo '<input type="password" name="pass" style="width: 100%;"></input></td>';
					echo '</tr></table>';
				}
				?>
				<?php
				if (($good) && ($usrname != $_SESSION["usr"]))
				{
					echo '<p>';
					echo ms("You must be logged in as the user who originally made this comment to be able to manage it", "Te peate olema sisse logitud kontoga, mille abil see kommentaar loodi, et seda hallata");
					die('</p></form></div></body></html>');
				}?>
				<p>Toiming: 
				<select name="action">
					<option value="mod"><?php echo ms("Modify comment", "Muuda kommentaari");?></option>
					<?php
						if (!($good)) {
							echo '<option value="chp">';
							echo ms("Change password", "Muuda parooli");
							echo '</option>';
						}
					?>
					<option value="del"><?php echo ms("Delete comment", "Kustuta kommentaar");?></option>
				</select></p>
				<input type="submit" value="<?php echo ms("Next", "Edasi"); ?>"></input>
			</form>
		</div>
	</body>
</html>
