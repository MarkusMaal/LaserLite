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
		echo "Lisa halduskonto";
	} else {
		echo "Add manager account";
	}
?></h1>
		<?php
			
			if ((empty($_SESSION["usr"])) || ($_SESSION["level"] != "owner")) {
				if ($lang == "et-EE") {
					echo '<p>Logige sisse omaniku kontoga</p>';
				} else {
					echo '<p>Log in with the owner account</p>';
				}
				die('</div></body></html>');
			}
			
		?>
		<form name="addaccountform" action="managers.php" method="post">
			<table>
				<tr>
					<td><?php if ($lang == "et-EE") { echo 'Kasutajanimi'; } else {	echo 'Username'; } ?></td>
					<td><input name="uname"></input></td>
				</tr>
				<tr>
					<td><?php if ($lang == "et-EE") { echo 'Konto status'; } else {	echo 'Account type'; } ?></td>
					<td>
					<select name="status">
						<option value="moderator"><?php if ($lang == "et-EE") { echo 'Moderaator'; } else { echo 'Moderator'; } ?></option>
						<option value="admin"><?php if ($lang == "et-EE") { echo 'Administraator'; } else { echo 'Administrator'; } ?></option>
						<option value="owner"><?php if ($lang == "et-EE") { echo 'Omanik'; } else { echo 'Owner'; } ?></option>
					</select>
					</td>
				</tr>
			</table>
			<input type="submit" value="<?php if ($lang == "et-EE") { echo 'Loo konto'; } else { echo 'Create account'; } ?>"/>
		</form>
		</div>
</body>
</html>
