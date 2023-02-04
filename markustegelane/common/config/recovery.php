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
		<h1 style="padding-top: 0px;"><?php echo ms("Account recovery", "Konto taastamine"); ?></h1>
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
			
			<?php
				echo '<div class="setting">';
				if ($lang == "et-EE") {
					echo '<p>Juhul, kui te unustasite sisselogimisandmed, saate teha järgnevat:</p>';
					echo '<ol>';
					echo '<li>Juhul, kui mäletate enda tagasiside kasutajanime ja parooli, logige nendega sisse ja saatke administraatorile sõnum, kus küsite, et teie konto parooli taastamiseks. Toimib ainult siis, kui kasutasite seda tagasiside kontot sisumoderaatori konto loomiseks.</li>';
					echo '<li>Saata e-kri veebilehe omanikule koos kinnituskoodiga, mis saadeti Teile konto loomise käigus, või e-posti aadressiga</li>';
					echo '<li><a href="../../index.php?doc=feedback&s=3">Luua uus sisumoderaatori konto</a>. Kui see õnnestub, siis varasem sisumoderaatori konto kustutatakse (proovige seda varianti vältida)</li>';
					echo '<li>Kui olete veebisaidi omanik, saate muuta oma kontostaatust MySQL-is</li>';
					echo '</ol>';
					echo '<a href="loginform.php"><div class="button">Tagasi</div></a>';
				} else if ($lang == "en-US") {
					echo '<p>In case you forgot the login details, you can do the following:</p>';
					echo '<ol>';
					echo '<li>In case you remember your feedback username and password, log in with these and send a message to the administrator, where you ask to reset your password. This will only work if you used this feedback account for creating a content moderator account.</li>';
					echo '<li>Send an e-mail to the web site owner with a verification code, which was sent to you when you created the account</li>';
					echo '<li><a href="../../index.php?doc=feedback&s=3">Create a new content moderator account</a>. If this is successful, the old moderator account will be deleted (try to avoid this option)</li>';
					echo '<li>If you are the owner of the website, you may change your account status in MySQL</li>';
					echo '</ol>';
					echo '<a href="loginform.php"><div class="button">Go back</div></a>';
				}
			?></div>
			</div>
		</div>
		</div>
</body>
