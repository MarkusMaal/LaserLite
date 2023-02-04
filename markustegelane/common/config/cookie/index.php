<?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
	function ms($en, $et) {
		if (empty($_GET["l"])) {
			if (!empty($_COOKIE["lang"])) {
			if ($_COOKIE["lang"] == "et-EE") {
				return $et;
			} else {
				return $en;
			}
		} else {
				return $en;
		} 
		} else {
			return $et;
		}
	}
	$lang = "en-US";
	$theme = "blue";
	if (!empty($_COOKIE["theme"])) {
		$theme = $_COOKIE["theme"];
	}
	if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) { $lang = "et-EE"; }
	if (!empty($_GET["l"])) {
		$lang = "et-EE";
	}
?>
<!DOCTYPE html>
<html lang="<?php if ($lang == "et-EE") { echo "et"; } else { echo "en"; } ?>">
<head><title><?php if ($lang == "et-EE") { echo "Markuse videod productions - avaleht"; } else { echo "Markus' videos productions - home page"; } ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/config/getcookies.php");
	  include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/themes/theme.php"); ?>
</head>
<body>
		<table style="margin-left:0px; width: 100%;">
		<tr style="float: left; width: 100%;">
		<td>
		<img style="width: 5em;" src="/markustegelane/images/<?php 
                if (empty($_COOKIE["lang"])) {
                    echo "cookie.svg";
                } else {
                    echo "cookie_bit.svg";
                }
		?>">
		</td>
		<td>
		<h1 style="padding-top: 0px;"><?php echo ms("Cookies", "Küpsised"); ?></h1>
		</td>
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
            <h1 style="text-align: center;"><?php echo ms('This website uses cookies', 'See veebileht kasutab küpsiseid'); ?></h1>
			<div style="width: 100%; float: left;">
			<?php 
			if (empty($_COOKIE["lang"])) {
				echo ms('<a href="?l=et">Kuva see teade eesti keeles</a>', '<a href="index.php">Show this message in English</a>');
			}
			?>
            <?php
                if (empty($_COOKIE["lang"])) {
                    echo ms("<p>It looks like you haven't set any cookies for this web site. In order to get the best experience on this web site, we need to set some cookies... if you don't mind.</p>", "<p>Tundub, et sellele lehele pole ühtegi küpsist seadistatud. Selleks, et saada parim kogemus selle veebilehe kasutamisel peame mõned küpsised seadistama... juhul kui te pahaks ei pane.</p>");
                }
            ?>
			<?php echo ms('
            <p>The website uses cookies for the following purposes:</p>
            <ul>
                <li>Storing language information</li>
                <li>Storing theme preference</li>
            </ul>
            <p>The website may also send POST requests to the server for the following purposes</p>
            <ul>
                <li>Posting comments and feedback</li>
                <li>Login details when signing in using either moderator or owner account</li>
                <li>New data when modifying databases (owner/developer only)</li>
            </ul>
            <p>The website can store your login details if you are a moderator. Your password is stored as a hash and is also salted. Verification code is not encrypted, but only accessible by the owner/developer.</p>
			</div>
			', '
			<p>See veebisait kasutab küpsiseid järgmistel eesmärkidel:</p>
            <ul>
                <li>Keeleinfo talletamine</li>
                <li>Teema eelistuse talletamine</li>
            </ul>
            <p>Veebisait võib saata POST kutseid serverile järgnevatel eesmärkidel:</p>
            <ul>
                <li>Kommentaaride ja tagasiside postitamine</li>
                <li>Sisselogimisandmed, kui sisenete moderaatori või omaniku kontoga.</li>
                <li>Uued andmed andmebaaside muutmisel (ainult omanik/arendaja)</li>
            </ul>
            <p>See veebisait võib talletada teie sisselogimisandmeid, kui olete moderaator. Teie parool on talletatud šifreerituna ja soolatud. Kinnituskood pole krüptitud, kuid on juurdepääsetav omanikule/arendajale.</p>
            ');
			?>
            <?php
            if (empty($_COOKIE["lang"])) {
                echo ms("<a href='setcookie.php?lang=en'><div class=\"button\">Sure, why not</div></a>
                <a href='/markustegelane'><div class=\"button\">I don't want to enable cookies right now</div></a>", "<a href='setcookie.php?lang=et'><div class=\"button\">Muidugi, miks mitte</div></a>
                <a href='/markustegelane'><div class=\"button\">Ma ei soovi hetkel küpsiseid sisse lülitada</div></a>");
            } else {
                echo ms('<p style="width: 100%; float: left;">You have agreed to have cookies saved on your computer. You can revoke this decision by clearing all cookie data in settings.</p><a href=".."><div class="button">Back to settings</div></a></p>', '<p>Te olete nõustunud sellega, et küpsised salvestatakse teie arvutisse. Te saate selle otsuse tagasi võtta kustutades kõik andmed seadetelehel.</p><a href=".."><div class="button">Tagasi seadetelehele</div></a></p>');
            }?>
        </div>
		</div>
    </body>
 </html>
