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
<head><title>403</title>
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
					/*if (http_response_code() == 403) {*/ echo 'angry'; /*}
					else { echo 'joy'; }*/
					echo '.svg" width=200/></div>'; ?>
				</tr>
				<tr>
				<?php
                    $cloc = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    //if (http_response_code() == 403) {
                        if ($lang == "et-EE") {
                            echo "<h1 style=\"text-align:center;\">Tundub, et teil pole ligipääsu sellele lehele</h1>";
                            echo "<p style=\"width: 100%; float: left;\">Teil puuduvad õigused sellele lehele pääsemiseks. Palun võtke ühenduste veebisaidi administraatoriga, kui see pole nii.</p><p style=\"width: 100%; float: left;\">Te saate teha järgnevat:</p><ul>";
                            echo "<div style=\"width: 100%; float: left;\">";
                            echo '<li>Saada mingil viisil õigus seda lehte näha</li>';
                            echo '<li>Kontakteeruda veebisaidi administraatoriga, kui te peaksite sellele lehele pääsema</li>';
							echo "</div>";
                            echo '</ul><div style="margin-top: 2em; width: 100%; float: left;">Tehniline info:<br/>HTTP olek ' . http_response_code() . '</div>';
                        } else {
                            echo "<h1 style=\"text-align:center;\">It looks like you can not access this page</h1>";
                            echo "<p style=\"width: 100%; float: left;\">This web page is forbidden for you. That means, you have no rights to access this page. Please contact the website administrator if that is not the case.</p><p style=\"width: 100%; float: left;\">Here's what you can do:</p><ul>";
                            echo "<div style=\"width: 100%; float: left;\">";
                            echo '<li>Somehow get permission to view this page</li>';
                            echo '<li>Contact website administrator if you should be able to access this page</li>';
                            echo "</div>";
                            echo '</ul><div style="margin-top: 2em; width: 100%; float: left;">Technical information:<br/>HTTP status ' . http_response_code() . '</div>';
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
