<?php
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
		<h1 style="padding-top: 0px;"><?php echo ms("Log in", "Sisselogimine"); ?></h1>
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
			<h1 style="width: 100%;"><?php
			if ($lang == "et-EE") {
				echo 'Haldaja kontoga sisselogimine';
			} else if ($lang == "en-US") {
				echo 'Manager account login';
			}?></h1>
			<div class="setting">
			<form action="login.php<?php 
			if (!empty($_GET["redir"])) {
			echo '?redir=' . $_GET["redir"];
			}
			?>" method="post">
			<a href="recovery.php" style="float: left; width: 100%;">
			<?php
			if ($lang == "en-US") {
				echo 'I forgot the username or password';
			} else if ($lang == "et-EE") {
				echo 'Ma unustasin kasutajanime või parooli';
			}?>
			</a>
			<table style="float: left;">
				<tr>
				<td style="float: left;">
				<?php
				if ($lang == "et-EE") {
					echo 'Kasutajanimi';
				} else if ($lang == "en-US") {
					echo 'Username';
				}?>
				</td>
				<td>
				<input name="loginuser" type="text"></input><br/><br/>
				</td>
				</tr>
				<tr>
				<td style="float: left;">
				<?php
				if ($lang == "et-EE") {
					echo 'Parool';
				} else if ($lang == "en-US") {
					echo 'Password';
				}?>
				</td>
				<td>
				<input name="loginpass" type="password"></input><br/><br/>
				</td>
				</tr>
				</tr>
				<tr colspan=2>
				<td>
				<input type="checkbox" name="addtoken">
				<?php
				if ($lang == "en-US") {
					echo 'Stay logged in on this browser <br/><a href="autologin.php" style="float: left;">What does this option do?</a>';
				} else {
					echo 'Jää selles veebibrauseris sisselogituks <br/><a href="autologin.php" style="float: left;">Mida see valik teeb?</a>'; 
				}?>
				</input><br/><br/>
				</td>
				</tr>
				<tr>
				<td colspan=2>
				<input class="button" style="float: left;" type="submit" value="<?php 
				if ($lang == "et-EE") {
					echo 'Logi sisse';
				} else if ($lang == "en-US") {
					echo 'Log in';
				}?>"></input>
				</td>
				</table>
			</form>
			</div>
		</div>
		</div>
</body>
