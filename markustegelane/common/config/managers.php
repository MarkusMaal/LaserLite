<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
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
	$lang = "en-US";
	$theme = "blue";
	if (!empty($_COOKIE["theme"])) {
		$theme = $_COOKIE["theme"];
	}
	if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) { $lang = "et-EE"; }
?>
<!DOCTYPE html>
<html lang="<?php if ($lang == "et-EE") { echo "et"; } else { echo "en"; } ?>">
<head><title><?php if ($lang == "et-EE") { echo "Halduskontod"; } else { echo "Management accounts"; } ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  include("getcookies.php");
	  include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/themes/theme.php"); ?>
</head>
<body>
		<table style="margin-left:0px; width: 100%;">
		<tr style="float: left; width: 100%;">
		<td>
		<img style="width: 5em;" src="/markustegelane/common/config/gfx/gears.svg">
		</td>
		<td>
		<h1 style="padding-top: 0px;"><?php echo ms("Manage accounts", "Halda kontosid"); ?></h1>
		</td>
		</tr>
		<tr style="background: #<?php if ($theme == "blue") { echo '00f'; } else if ($theme == "light") { echo '888'; } else { echo '555'; } ?>2; width: 100%;">
		<td colspan="2">
		<?php 
			echo '<a href="/"><div class="button" style="margin-top: 0em;" >';
			if ($lang == "en-US")
			{
				echo 'Home page';
			} else {
				echo 'Avaleht';
			}
			echo '</div></a>';
			echo '<a href="/markustegelane/common/config"><div class="button" style="margin-top: 0em;" >';
			if ($lang == "en-US")
			{
				echo 'Settings';
			} else {
				echo 'Seaded';
			}
			echo '</div></a>'; ?>
		</td>
		</tr>
		</table>
		<hr>
		<hr style="border-color: <?php
		
		switch ($theme) {
			case "blue":
				echo '#00e';
				break;
			case "light":
				echo '#eee';
				break;
			case "dark":
				echo '#888';
				break;
		}
				?>;">
		<div class="cut">
		<div class="cont">
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
					echo '<div class="setting" style="margin-bottom: 1em;"><table class="normaltable" style="margin-left: 0px;">';
					echo '<tr><th class="normaltable">ID</th>';
					if ($lang == "et-EE") {
						echo '<th class="normaltable">Nimi</th>';
						echo '<th class="normaltable">Konto staatus</th>';
						echo '<th class="normaltable">Kinnituskood</th>';
						echo '<th class="normaltable">Paroolitaaste</th>';
						echo '<th class="normaltable">Kustuta konto</th>';
					} else {
						echo '<th class="normaltable">Username</th>';
						echo '<th class="normaltable">Account status</th>';
						echo '<th class="normaltable">Verification code</th>';
						echo '<th class="normaltable">Password recovery</th>';
						echo '<th class="normaltable">Delete account</th>';
					}
					echo '</tr>';
					while ($row = mysqli_fetch_array($result)) {
						echo '<tr>';
						echo '<td class="normaltable">' . $row["ID"] . '</td>';
						echo '<td class="normaltable">' . $row["UNAME"] . '</td>';
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
						echo '<td class="normaltable">' . $status . '</td>';
						echo '<td class="normaltable">' . $row["RECOVERYCODE"] . '</td>';
							if ($lang == "et-EE") {
								if ($row["RECOVER_VERIFY"] == "0") {
									$recorylink = "<a href=\"managers.php?rec=" . $row["ID"] ."\"><div class=\"button\">Taasta kasutaja " . $row["UNAME"] . " parool</div></a>";
								} else {
									$recorylink = "Parool taastati. Kasutaja pole veel sisse loginud.";
								}
							} else {
								if ($row["RECOVER_VERIFY"] == "0") {
									$recorylink = "<a href=\"managers.php?rec=" . $row["ID"] ."\"><div class=\"button\">Recover users's (" . $row["UNAME"] . ") password</div></a>";
								} else {
									$recorylink = "Password recovered. User has not logged in yet.";
								}
								
							}
						echo '<td class="normaltable">' . $recorylink . '</td>';
							if ($lang == "et-EE") {
								$recorylink = "<a style=\"color: #f00; padding-left: 20px;\" href=\"managers.php?del=" . $row["ID"] ."\"><div class=\"redbutton\">Kustuta kasutaja</div></a>";
							} else {
								$recorylink = "<a style=\"color: #f00; padding-left: 20px;\" href=\"managers.php?del=" . $row["ID"] ."\"><div class=\"redbutton\">Delete user</div></a>";
							}
						echo '<td class="normaltable">' . $recorylink . '</td>';
						echo '</tr>';
					}
					echo '</table></div><div class="setting"><h2>';
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
					echo '<a href="addmanager.php"><div class="button">';
					if ($lang == "et-EE") {
						echo 'Lisa halduskonto';
					} else {
						echo 'Add manager account';
					}
					echo '</div></a></div>';
				} else {
					if ($lang == "et-EE") {
						echo '<p>Halduskontode lisamiseks/muutmiseks peate sisse logima haldaja kontoga.</p>';
					} else {
						echo '<p>In order to change manager account, please log in with a manager account.</p>';
					}
				}
				echo '<a href="index.php"><div class="button">';
				if ($lang == "et-EE") {
					echo 'Tagasi seadetelehele';
				} else {
					echo 'Back to settings';
				}
				echo '</div></a>';
				
			?>
		</div>
		</div>
</body>
