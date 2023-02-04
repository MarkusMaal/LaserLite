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
<head><title>404</title>
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
					/*if (http_response_code() == 404) { */ echo 'sad'; /*}
					else { echo 'joy'; }*/
					echo '.svg" width=200/></div>'; ?>
				</tr>
				<tr>
				<?php
                    $cloc = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    //if (http_response_code() == 404) {
                        if ($lang == "et-EE") {
                            echo "<h1 style=\"text-align:center;\">Kahjuks ei leidnud me seda lehekülge</h1>";
                            echo "<p style=\"width: 100%; float: left;\">Me otsisime seda lehekülge kõikjalt. Sahtlitest, kappidest, riiulitest, laudadelt, laua alt, kõvakettalt, mälupulkadelt ja paljudest teistest kohtadest. Me ei saa ikkagi teile seda lehekülge pakkuda.</p><p style=\"width: 100%; float: left;\">Te saate teha järgnevat:</p><ul>";
                            echo "<div style=\"width: 100%; float: left;\">";
							if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                                $refuri = parse_url($_SERVER['HTTP_REFERER']);
                                if($refuri['host'] == "markustegelane.ml"){
                                    echo "<li>Tulge hiljem tagasi uuendatud lingi saamiseks</li>";
                                    echo "<li>Teavita vigasest aadressist veebilehe administraatorile - see olen mina</li>";
                                }
                                else{
                                    echo '<li>Võta ühendust inimesega, kes andis teie selle lingi, kes omakorda saab leida alternatiivse lingi</li>';
                                }
                            }
                            else{
                                echo '<li>Kontrolli veebilehe aadressi - suured ja väikesed tähed on erinevad tähemärgid</li>';
                                echo '<li>Soovitud leht võib olla kustutatud - teavitage administraatorit</li>';
                            }
							echo "</div>";
                            echo '</ul><div style="margin-top: 2em; width: 100%; float: left;">Tehniline info:<br/>HTTP olek ' . http_response_code() . '</div>';
                        } else {
                            echo "<h1 style=\"text-align:center;\">Unfortunately we can't find this page</h1>";
                            echo "<p style=\"width: 100%; float: left;\">We looked for this page everywhere. Drawers, closets, shelves, tables, under the table, hard drives, flash drives and so many more places. We still were not able to serve you this page.</p><p style=\"width: 100%; float: left;\">Here's what you can do:</p><ul>";
                            echo "<div style=\"width: 100%; float: left;\">";
							if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                                $refuri = parse_url($_SERVER['HTTP_REFERER']);
                                if($refuri['host'] == "markustegelane.ml"){
                                    echo "<li>Come back later for an updated link</li>";
                                    echo "<li>Report broken URL to the website's administrator - that's me</li>";
                                }
                                else{
                                    echo '<li>Contact person who gave you this link to check for an alternative link</li>';
                                }
                            }
                            else{
                                echo '<li>Check URL for any mistakes - it is case sensitive</li>';
                                echo '<li>The requested page may be deleted - contact web site administrator for more information</li>';
                            }
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
