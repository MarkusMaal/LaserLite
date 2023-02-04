<!DOCTYPE html>
<html>
<head>
<?php include("getcookies.php");
include("../../../mobcheck.php"); 
?>
<title>
<?php
if ($lang == "et-EE") {
	echo "Haldaja konto";
} else {
	echo "Manager account";
}
?></title>

<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
if (empty($_COOKIE["theme"])) {
    $theme = 'blue';
} else {
    $theme = $_COOKIE["theme"];
}
?>
<link rel="stylesheet" href="/markustegelane/common/themes/<?php echo $theme;	if ($isMob) {  echo "_m"; 	} ?>.css">
</head>
<body>
		<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
		<div class="mainpage">
			<h1><?php
			if ($lang == "et-EE") {
				echo "Automaatne sisselogimine";
			} else {
				echo "Automatic login";
			}
			?></h1>
			<p>
			<?php
			if ($lang == "et-EE") {
				echo "See valik võimaldab sellel veebilehel teie sisselogimisandmed meeles pidada. Juhul kui valite märkeruudu, pidage silmas järgmist: <ul>
					<li>Sisselogimisandmeid (kasutajanimi, parool) ei talletata</li>
					<li>Vahetades brauserit peate uuesti sisse logima</li>
					<li>Brauseriteabe põhjal genereeritakse kontrollsumma (algoritm: SHA256), mis salvestatakse serverisse ja see pole isikuliselt eristatav</li>
					<li>Automaatne sisselogimisteave aegub 30 päeva pärast inaktiivsust</li>
					<li>Veebilehe uuesti sisenemine pikendab sisselogimisaega</li>
					<li>Väljalogimine eemaldab kirje andmebaasi tabelist</li>
				</ul>
					<a href=\"loginform.php\">Tagasi sisselogimislehele</a>";
			} else {
				echo "This option allows the web site to remember your login details. In case you tick the box, keep the following in mind: <ul>
					<li>Login details (username, password) will not be saved</li>
					<li>If you switch browser, you need to login again</li>
					<li>A checksum from the browser info is generated (algorithm: SHA256), which gets saved into the server and is not personally identifiable</li>
					<li>Auto-login info expires after 30 days of inactivity</li>
					<li>Re-entering the site postpones the expiration time</li>
					<li>Logging out deletes the record from a database table</li>
				</ul>
					<a href=\"loginform.php\">Back to login page</a>";
			}
			?>
			</p>
		</div>
</body>