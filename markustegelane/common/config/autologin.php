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
		<h1 style="padding-top: 0px;"><?php echo ms("Automatic login", "Automaatne sisselogimine"); ?></h1>
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
			echo '<a href="/markustegelane/common/config/loginform.php"><div class="button" style="margin-top: 0em;" >';
			if ($lang == "en-US")
			{
				echo 'Log in';
			} else {
				echo 'Sisselogimine';
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
			<h1><?php
			if ($lang == "et-EE") {
				echo 'Haldaja kontoga sisselogimine';
			} else if ($lang == "en-US") {
				echo 'Manager account login';
			}?></h1>
			<div class="setting">
			<p>
			<?php
			if ($lang == "et-EE") {
				echo "Automaatse sisselogimise valik võimaldab sellel veebilehel teie sisselogimisandmed meeles pidada. Juhul kui valite märkeruudu, pidage silmas järgmist: <ul>
					<li>Sisselogimisandmeid (kasutajanimi, parool) ei talletata</li>
					<li>Vahetades brauserit peate uuesti sisse logima</li>
					<li>Brauseriteabe põhjal genereeritakse kontrollsumma (algoritm: SHA256), mis salvestatakse serverisse ja see pole isikuliselt eristatav</li>
					<li>Automaatne sisselogimisteave aegub 30 päeva pärast inaktiivsust</li>
					<li>Veebilehe uuesti sisenemine pikendab sisselogimisaega</li>
					<li>Väljalogimine eemaldab kirje andmebaasi tabelist</li>
				</ul>
					<a href=\"loginform.php\"><div class=\"button\">Tagasi</div></a>";
			} else {
				echo "Automatic login option allows the web site to remember your login details. In case you tick the box, keep the following in mind: <ul>
					<li>Login details (username, password) will not be saved</li>
					<li>If you switch browser, you need to login again</li>
					<li>A checksum from the browser info is generated (algorithm: SHA256), which gets saved into the server and is not personally identifiable</li>
					<li>Auto-login info expires after 30 days of inactivity</li>
					<li>Re-entering the site postpones the expiration time</li>
					<li>Logging out deletes the record from a database table</li>
				</ul>
					<a href=\"loginform.php\"><div class=\"button\">Go back</div></a>";
			}
			?>
			</p>
			</div>
			</div>
		</div>
		</div>
</body>
