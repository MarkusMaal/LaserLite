<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php include("getcookies.php");?>
<title>
<?php
if ($lang == "et-EE") {
	echo "Haldaja konto";
} else {
	echo "Manager account";
}
?></title>

<?php include("../../../mobcheck.php"); ?>
<?php include("../loadtheme.php");?>
</head>
<body>
		<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
		<div class="mainpage">
			<h1><?php
			if ($lang == "et-EE") {
				echo 'Haldaja kontoga sisselogimine';
			} else if ($lang == "en-US") {
				echo 'Manager account login';
			}?></h1>
			
			<?php
				if ($lang == "et-EE") {
					echo '<h2>Konto taastamine</h2>';
					echo '<p>Juhul, kui te unustasite sisselogimisandmed, saate teha järgnevat:</p>';
					echo '<ol>';
					echo '<li>Juhul, kui mäletate enda tagasiside kasutajanime ja parooli, logige nendega sisse ja saatke administraatorile sõnum, kus küsite, et teie konto parooli taastamiseks. Toimib ainult siis, kui kasutasite seda tagasiside kontot sisumoderaatori konto loomiseks.</li>';
					echo '<li>Saata veebisaidi administraatorile tagasiside koos kinnituskoodiga, mis saadeti Teile konto loomise käigus, või e-posti aadressiga</li>';
					echo '<li><a href="../../index.php?doc=feedback&s=3">Luua uus sisumoderaatori konto</a>. Kui see õnnestub, siis varasem sisumoderaatori konto kustutatakse (proovige seda varianti vältida)</li>';
					echo '<li>Kui olete veebisaidi omanik, saate muuta oma kontostaatust MySQL-is</li>';
					echo '</ol>';
					echo '<a href="loginform.php">Tagasi</a>';
				} else if ($lang == "en-US") {
					echo '<h2>Account recovery</h2>';
					echo '<p>In case you forgot the login details, you can do the following:</p>';
					echo '<ol>';
					echo '<li>Send an e-mail to the web site owner with a verification code, which was sent to you when you created the account</li>';
					echo '<li>If you are the owner of the website, you may change your account status in MySQL</li>';
					echo '</ol>';
					echo '<a href="loginform.php">Go back</a>';
				}
			?>
		</div>
</body>
