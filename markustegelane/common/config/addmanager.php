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
		<h1 style="padding-top: 0px;"><?php echo ms("Add manager account", "Lisa halduskonto"); ?></h1>
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
			echo '</div></a>'; 
			echo '<a href="/markustegelane/common/config/managers.php"><div class="button" style="margin-top: 0em;" >';
			if ($lang == "en-US")
			{
				echo 'Manage accounts';
			} else {
				echo 'Kontode haldamine';
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
		<div class="setting">
			<?php
			
				if ((empty($_SESSION["usr"])) || ($_SESSION["level"] != "owner")) {
					if ($lang == "et-EE") {
						echo '<p>Logige sisse omaniku kontoga</p>';
					} else {
						echo '<p>Log in with the owner account</p>';
					}
					die('</div></div></body></html>');
				}
			
			?>
			<form name="addaccountform" action="managers.php" method="post">
				<div style="float: left;">
				<table>
					<tr>
						<td><?php if ($lang == "et-EE") { echo 'Kasutajanimi'; } else {	echo 'Username'; } ?></td>
						<td><input type="text" name="uname"></input></td>
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
				</div>
			</form>
			</div>
		</div>
		</div>
		</div>
</body>
