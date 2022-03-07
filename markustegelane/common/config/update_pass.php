<?php
      if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  $recovery = true;
      include("getcookies.php");
      include("../../../mobcheck.php");?>
<title>
<?php
	if ($lang == "et-EE") {
		echo "Parooli muutmine";
	} else {
		echo "Change password";
	}
?></title>

<?php
if (empty($_COOKIE["theme"])) {
    $theme = 'light';
} else {
    $theme = $_COOKIE["theme"];
}
?>
<link rel="stylesheet" href="/markustegelane/common/themes/<?php echo $theme;	if ($isMob) {  echo "_m"; 	} ?>.css">
</head>
<body>
		<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
		<div class="mainpage">
		<?php
			include("../connect.php");
			
			// to update verified comments
			// searches all comments and saves them to an array
			
			$query = 'SELECT ID, UPASS, RECOVER_VERIFY, RECOVERYCODE FROM managers WHERE UNAME = "' . $_SESSION["usr"] . '"';
			$result = mysqli_query($connection, $query);	
			$row = mysqli_fetch_array($result);
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
						} else {
							if ($lang == "et-EE") {
								echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
							} else if ($lang == "en-US") {
								echo '<span style="color: #ff0000; ">Error: ' . $sql . '<br>' . $connection->error;
							}
						}
					} else {
                        if ($lang == "et-EE") {
                            die('Paroolid ei ühtinud. Midagi ei muudetud<br/><a href="index.php">Tagasi</a>');
                        } else {
                            die('Passwords did not match. Nothing was changed<br/><a href="index.php">Go back</a>');
                        }
					}
				} else {
                    if ($lang == "et-EE") {
                        die('Sisestatud vana parool või kinnituskood oli vale. Proovige uuesti.<br/><a href="index.php">Tagasi</a>');   
                    } else {
                        die('Old password or verification code entered were incorrect. Please try again.<br/><a href="index.php">Go back</a>');   
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
		<form action="update_pass.php" method="post">
			<table>
				<tr>
					<td>
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
					<td>
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
					<td>
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
			<input type="submit"></input>
		</form>
		</div>
</body>
</html>
