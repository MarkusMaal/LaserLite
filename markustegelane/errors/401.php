<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    //include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
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
<head><title>401</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  include("getcookies.php");
	  include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/themes/theme.php"); ?>
</head>
<body>
	<br>
		<div class="cut">
		<div class="cont">
  <!-- Main page section --->
		<table>
				<tr>
					<?php
					echo '<div style="width: 200px; margin: auto;"><img src="/markustegelane/images/';
					/*if (http_response_code() == 403) {*/ echo 'embarrased'; /*}
					else { echo 'joy'; }*/
					echo '.svg" width=200/></div>'; ?>
				</tr>
				<tr>
				<?php
                    $cloc = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    //if (http_response_code() == 403) {
                        if ($lang == "et-EE") {
                            echo "<h1 style=\"text-align:center;\">Autoriseerimine nurjus</h1>";
                            echo "<p style=\"width: 100%; float: left;\">Sisestatud kasutajanimi/parool oli vale. Sellele lehele pääsevad ligi ainult autenditud kasutajad. </p><p style=\"width: 100%; float: left;\">Te saate teha järgnevat:</p><ul>";
                            echo "<div style=\"width: 100%; float: left;\">";
                            echo '<li>Küsida veebisaidi omanikult kasutajanime ja parooli lehele ligi pääsemiseks</li>';
                            echo '<li>Eemaldada parool juhtpaneelist (juhul kui olete veebisaidi omanik)</li>';
							echo "</div>";
                            echo '</ul><div style="margin-top: 2em; width: 100%; float: left;">Tehniline info:<br/>HTTP olek 401</div>';
                        } else {
                            echo "<h1 style=\"text-align:center;\">Authorization failed</h1>";
                            echo "<p style=\"width: 100%; float: left;\">The username/password entered was incorrect. This page is only accessible to authenticated users. </p><p style=\"width: 100%; float: left;\">Here's what you can do:</p><ul>";
                            echo "<div style=\"width: 100%; float: left;\">";
                            echo '<li>Ask website owner for a username and password</li>';
                            echo '<li>Remove the password from control panel (if you are a website owner)</li>';
                            echo "</div>";
                            echo '</ul><div style="margin-top: 2em; width: 100%; float: left;">Technical information:<br/>HTTP status 401</div>';
                        }
                    /*} else {
                        if ($lang == "et-EE") {
                            echo "<h1 style=\"text-align:left;\">Mida te siin teete?</h1>";
                            echo "<div style=\"width: 100%; float: left;\"><p>Te peaksite seda lehte nägema ainult siis, kui ilmneb viga.</p>";
                            echo '</ul><div>Tehniline info:</div><div>HTTP olek ' . http_response_code() . '</div></div>';
                        } else {
                            echo "<h1 style=\"text-align:left;\">What are you doing here?</h1>";
                            echo "<div style=\"width: 100%; float: left;\"><p>You should only see this page when there's an error.</p>";
                            echo '</ul><div>Technical information:</div><div>HTTP status ' . http_response_code() . '</div></div>';
                        }
                    }*/
				?>
				</tr>
		</table>
	</div>
	</div>
</body>
</html>
