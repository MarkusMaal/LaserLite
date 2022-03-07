<?php
      if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  $recovery = true;
      include("getcookies.php");?>
<title>
<?php
	if ($lang == "et-EE") {
		echo "Halduskontod";
	} else {
		echo "Management accounts";
	}
?></title>

<?php include("../../../mobcheck.php"); ?>
<?php include("../loadtheme.php");?>
</head>
<body>
		<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
		<div class="mainpage">
<h1>
<?php
	if ($lang == "et-EE") {
		echo "Halduskontod";
	} else {
		echo "Management accounts";
	}
?></h1>
		<?php
			if ((!empty($_SESSION["usr"])) && (($_SESSION["level"] == "owner") || ($_SESSION["level"] == "admin"))) {
				include("../connect.php");
				if (!empty($_POST["uname"])) {
					if ($_SESSION["level"] == "owner") {
						$stat = $_POST["status"];
						$isowner = "0";
						$isadmin = "0";
						$accountcode = "";
						for ($i = 0; $i < 7; $i++) {
							$accountcode = $accountcode . rand(0, 9);
						}
						if ($_POST["status"] == "admin") {
							$isadmin = "1";
						} else if ($_POST["status"] == "owner") {
							$isowner = "1";
							$isadmin = "1";
						}
						$query = "INSERT INTO managers (UNAME, UPASS, ISOWNER, ISADMIN, RECOVER_VERIFY, RECOVERYCODE) VALUES (\""
						. mysqli_real_escape_string($connection, $_POST["uname"]) . "\", "
						. "\"\", "
						. $isowner . ", "
						. $isadmin . ", "
						. "1, "
						. "\"" . $accountcode . "\""
						. ")";
						if ($connection->query($query)) {
							if ($lang == "et-EE") {
								echo '<p style="#0f0">Konto loodi edukalt</p>';
							} else {
								echo '<p style="#0f0">Account created successfully</p>';
							}
						} else {
							if ($lang == "et-EE") {
								echo '<p style="#f00">Viga: ';
							} else {
								echo '<p style="#f00">Error: ';
							}
							echo $connection->error . '</p>';
						}
						$_POST = array();
					}
				}
				if (!empty($_GET["rec"])) {
					$query = "UPDATE managers SET RECOVER_VERIFY = 1 WHERE ID = " . $_GET["rec"];
					if ($connection->query($query)) {
						echo '<p style="#0f0">';
						if ($lang == "et-EE") {
							echo 'Konto parool taastati';
						} else {
							echo 'Account password recovered';
						}
					} else {
						echo '<p style="#f00">';
						if ($lang == "et-EE") {
							echo 'Konto parooli ei saanud taastada';
						} else {
							echo 'Could not recover account password';
						}
					}
					echo '</p>';
				}
				if (!empty($_GET["del"])) {
					if ($_SESSION["level"] == "admin") {
						echo '<p style="#f00">';
						if ($lang == "et-EE") {
							echo 'Kontosid saab kustutada ainult omanik';
						} else {
							echo 'Only the owner can delete accounts';
						}
						echo '</p>';
					} else {
						$query = "DELETE FROM managers WHERE ID = " . $_GET["del"];
						if ($connection->query($query)) {
							echo '<p style="#0f0">';
							if ($lang == "et-EE") {
								echo 'Konto kustutati';
							} else {
								echo 'Account deleted';
							}
							echo '</p>';
						}
					}
				}
				$query = 'SELECT * FROM managers';
				$result = mysqli_query($connection, $query);
				echo '<table>';
				echo '<tr><th>ID</th>';
				if ($lang == "et-EE") {
					echo '<th>Nimi</th>';
					echo '<th>Konto staatus</th>';
					echo '<th>Kinnituskood</th>';
					echo '<th>Paroolitaaste</th>';
					echo '<th>Kustuta konto</th>';
				} else {
					echo '<th>Username</th>';
					echo '<th>Account status</th>';
					echo '<th>Verification code</th>';
					echo '<th>Password recovery</th>';
					echo '<th>Delete account</th>';
				}
				echo '</tr>';
				while ($row = mysqli_fetch_array($result)) {
					echo '<tr>';
					echo '<td>' . $row["ID"] . '</td>';
					echo '<td>' . $row["UNAME"] . '</td>';
					$status = "";
					if ($lang == "et-EE") {
						$status = "Moderaator";
					} else {
						$status = "Moderator";
					}
					if ($row["ISADMIN"] == "1") {
						if ($lang == "et-EE") {
							$status = "Administraator";
						} else {
							$status = "Administrator";
						}
					}
					if ($row["ISOWNER"] == "1") {
						if ($lang == "et-EE") {
							$status = "Omanik";
						} else {
							$status = "Owner";
						}
					}
					echo '<td>' . $status . '</td>';
					echo '<td>' . $row["RECOVERYCODE"] . '</td>';
						if ($lang == "et-EE") {
							if ($row["RECOVER_VERIFY"] == "0") {
								$recorylink = "<a href=\"managers.php?rec=" . $row["ID"] ."\">Taasta kasutaja " . $row["UNAME"] . " parool</a>";
							} else {
								$recorylink = "Parool taastati. Kasutaja pole veel sisse loginud.";
							}
						} else {
							if ($row["RECOVER_VERIFY"] == "0") {
								$recorylink = "<a href=\"managers.php?rec=" . $row["ID"] ."\">Recover users's (" . $row["UNAME"] . ") password</a>";
							} else {
								$recorylink = "Password recovered. User has not logged in yet.";
							}
							
						}
					echo '<td>' . $recorylink . '</td>';
						if ($lang == "et-EE") {
							$recorylink = "<a style=\"color: #f00; padding-left: 20px;\" href=\"managers.php?del=" . $row["ID"] ."\">Kustuta kasutaja</a>";
						} else {
							$recorylink = "<a style=\"color: #f00; padding-left: 20px;\" href=\"managers.php?del=" . $row["ID"] ."\">Delete user</a>";
						}
					echo '<td>' . $recorylink . '</td>';
					echo '</tr>';
				}
				echo '</table><h2>';
				if ($lang == "et-EE") {
					echo 'Konto lisamine';
				} else {
					echo 'Add account';
				}
				echo '</h2><p>';
				if ($lang == "et-EE") {
					echo 'Juhul, kui olete kindel kasutaja autentsuses, saate siit uue konto lisada.';
				} else {
					echo 'If you are sure abount the authenticity of the user, you can add a new account here.';
				}
				echo '</p>';
				echo '<a href="addmanager.php">';
				if ($lang == "et-EE") {
					echo 'Lisa halduskonto';
				} else {
					echo 'Add manager account';
				}
				echo '</a>';
			} else {
				if ($lang == "et-EE") {
					echo '<p>Halduskontode lisamiseks/muutmiseks peate sisse logima haldaja kontoga.</p>';
				} else {
					echo '<p>In order to change manager account, please log in with a manager account.</p>';
				}
			}
			echo '<br/><br/><a href="index.php">';
			if ($lang == "et-EE") {
				echo 'Tagasi seadetelehele';
			} else {
				echo 'Back to settings';
			}
			echo '</a>';
			
		?>
		</div>
</body>
</html>
