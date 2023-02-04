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
<head><title><?php if ($lang == "et-EE") { echo "Markuse videod productions - avaleht"; } else { echo "Markus' videos productions - home page"; } ?></title>
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
		<h1 style="padding-top: 0px;"><?php echo ms("Change password", "Muuda parooli"); ?></h1>
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
				include("../connect.php");
				
				// to update verified comments
				// searches all comments and saves them to an array
				
				$query = 'SELECT ID, UPASS, RECOVER_VERIFY, RECOVERYCODE FROM managers WHERE UNAME = "' . $_SESSION["usr"] . '"';
				$result = mysqli_query($connection, $query);	
				$row = mysqli_fetch_array($result);
				$qq = "DELETE FROM saved_sessions WHERE USR_ID = " . $row["ID"];
				$connection->query($qq);
				$usr_id = $row[0];
				$usr_hash = $row[1];
				$usr_name = $_SESSION["usr"];
				$rcc = $row[3];
				$rec = $row[2];
				
				$q = 'SELECT * FROM general_comments WHERE NAME LIKE "id%_' . $_SESSION["usr"] . '"';
				$needupdate = array();
				$r1 = mysqli_query($connection, $q);
				
				while ($comment = mysqli_fetch_array($r1)) {
					if ("id" . md5($usr_id . $usr_name . $usr_hash . $rcc . $comment["COMMENT"]) . "_" . $usr_name == $comment["NAME"]) {
						array_push($needupdate, $comment);
					}
				}
				if (!empty($_POST["old"])) {
					$oldpass = $_POST["old"];
					$newpass = $_POST["new"];
					$confirm = $_POST["confirm"];
					if ($rec == "1") {
						session_destroy();
					}
					$_POST = array();
					$allowchange = false;
					if ( ($usr_hash == md5($oldpass . '-' . $usr_name . '-' . $usr_id)) ||
						 (($rec == "1") && ($oldpass == $rcc)) ) {
						$allowchange = true;
					}
					if ($allowchange) {
						// old password correct
						if ($newpass == $confirm) {
							$sql = 'UPDATE managers SET UPASS = md5("' . $newpass . '-' . $usr_name . '-' . $usr_id . '") WHERE ID = "' . $usr_id . '"';
							if ($connection->query($sql) === TRUE) {
								// success
								if ($rec == "1" ){
									$sql = 'UPDATE managers SET RECOVER_VERIFY = "0" WHERE ID = "' . $usr_id . '"';
									$connection->query($sql);
									echo "<script type='text/javascript'>document.location.href='loginform.php';</script>";
								}
								$npass = md5($newpass . '-' . $usr_name . '-' . $usr_id);
								foreach ($needupdate as &$comment) {
									$query = "UPDATE general_comments SET NAME = \"id" . md5($usr_id . $usr_name . $npass . $rcc . $comment["COMMENT"]) . "_" . $usr_name . "\" WHERE ID = " . $comment["ID"];
									if (!($connection->query($query))) {
										echo $connection->error;
									}
								}
								
								if ($lang == "et-EE") {
									echo 'Parool muudeti';
								} else if ($lang == "en-US") {
									echo 'Password was changed';
								}
								echo '<br/><br/><a href="/markustegelane/common/config"><div class="button">OK</div></a>';
							} else {
								if ($lang == "et-EE") {
									echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
								} else if ($lang == "en-US") {
									echo '<span style="color: #ff0000; ">Error: ' . $sql . '<br>' . $connection->error;
								}
							}
						} else {
							if ($lang == "et-EE") {
								die('Paroolid ei ühtinud. Midagi ei muudetud<br/><a href="index.php"><div class="button">Tagasi</div></a>');
							} else {
								die('Passwords did not match. Nothing was changed<br/><a href="index.php"><div class="button">Go back</div></a>');
							}
						}
					} else {
						if ($lang == "et-EE") {
							die('Sisestatud vana parool või kinnituskood oli vale. Proovige uuesti.<br/><a href="index.php"><div class="button">Tagasi</div></a>');   
						} else {
							die('Old password or verification code entered were incorrect. Please try again.<br/><a href="index.php"><div class="button">Go back</div></a>');   
						}
					}
					$connection->close();
					die();
				}
			?>
			<h1>
			<?php
			if ($lang == "et-EE") {
				if ($rec == "0") {
					echo "Parooli muutmine";
				} else {
					echo "Parooli lisamine";
				}
			} else {
				if ($rec == "0") {
					echo "Change password";
				} else {
					echo "Add a password";
				}
			}
			?>
			</h1>
			<div class="setting">
			<form action="update_pass.php" method="post">
				<div style="width: 100%; float: left;">
				<table style="float: left;">
					<tr style="text-align: left;">
						<td style="text-align: left;">
							<?php
							if ($lang == "et-EE") {
								if ($rec == "0") {
									echo "Vana parool: ";
								} else {
									echo "Kinnituskood: ";
								}
							} else {
								if ($rec == "0") {
									echo "Previous password: ";
								} else {
									echo "Verification code: ";
								}
							}
							?>
						</td>
						<td>
							<input name="old" type="password"></input>
						</td>
					</tr>
					<tr>
						<td style="text-align: left;">
							<?php
							if ($lang == "et-EE") {
								echo "Uus parool: ";
							} else {
								echo "New password: ";
							}
							?>
						</td>
						<td>
							<input name="new" type="password"></input>
						</td>
					</tr>
					<tr>
						<td style="text-align: left;">
							<?php
							if ($lang == "et-EE") {
								echo "Uus parool (kinnita): ";
							} else {
								echo "New password (confirm): ";
							}
							?>
						</td>
						<td>
							<input name="confirm" type="password"></input>
						</td>
					</tr>
				</table>
				</div>
				<input type="submit" value="<?php if ($lang == "et-EE") { echo 'Muuda'; } else { echo 'Confirm'; } ?>"></input>
			</form>
			</div>
		</div>
		</div>
		</div>
</body>
