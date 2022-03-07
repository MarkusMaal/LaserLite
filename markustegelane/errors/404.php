<html>
<head>
	<title>404</title>
	<link rel="icon" href="../../../../../markustegelane/images/favicon.png">
	<!-- Javascript for going to random page --->
	<?php
    if (empty($_COOKIE['theme'])) {
	    echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/light.css">';
    } else {
        $thm = $_COOKIE['theme'];
        if ($thm == "light") {
	        echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/light.css">';
        } else if ($thm == "dark") {
	        echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/dark.css">';
        }
    }
    if (empty($_COOKIE)) {
        echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/light.css">';
    }
	$lang = "en-US";
	if (!empty($_COOKIE["lang"])) {
		$lang = $_COOKIE["lang"];
	}
	?>
</head>
<body>
	<a href="../../../../../../markustegelane/index.php"><img center class="banner" src="../../../../../markustegelane/gfx/banner.png"></img></a>
	<br>
		<div class="mainpage">
  <!-- Main page section --->
		<table>
				<tr>
					<div style="width: 200px; margin: auto;"><img src="../../../../../markustegelane/images/sad.svg" width=200/></div>
				</tr>
				<tr>
				<?php
                    $cloc = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    if (http_response_code(404) != false) {
                        if ($lang == "et-EE") {
                            echo "<h1 style=\"text-align:center;\">Kahjuks ei leidnud me seda lehekülge</h1>";
                            echo "<p>Me otsisime seda lehekülge kõikjalt. Sahtlitest, kappidest, riiulitest, laudadelt, laua alt, kõvakettalt, mälupulkadelt ja paljudest teistest kohtadest. Me ei saa ikkagi teile seda lehekülge pakkuda.</p><p>Te saate teha järgnevat:</p><ul>";
                            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                                $refuri = parse_url($_SERVER['HTTP_REFERER']);
                                if($refuri['host'] == "markustegelane.tk"){
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
                            echo '</ul><div>Tehniline info:</div><div>HTTP olek ' . http_response_code() . '</div>';
                        } else {
                            echo "<h1 style=\"text-align:center;\">Unfortunately we can't find this page</h1>";
                            echo "<p>We looked for this page everywhere. Drawers, closets, shelves, tables, under the table, hard drives, flash drives and so many more places. We still were not able to serve you this page.</p><p>Here's what you can do:</p><ul>";
                            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                                $refuri = parse_url($_SERVER['HTTP_REFERER']);
                                if($refuri['host'] == "markustegelane.tk"){
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
                            echo '</ul><div>Technical information:</div><div>HTTP status ' . http_response_code() . '</div>';
                        }
                    } else {
                        if ($lang == "et-EE") {
                            echo "<h1 style=\"text-align:left;\">Mida te siin teete?</h1>";
                            echo "<p>Te peaksite seda lehte nägema ainult siis, kui ilmneb viga.</p>";
                            echo '</ul><div>Tehniline info:</div><div>HTTP olek ' . http_response_code() . '</div>';
                        } else {
                            echo "<h1 style=\"text-align:left;\">What are you doing here?</h1>";
                            echo "<p>You should only see this page when there's an error.</p>";
                            echo '</ul><div>Technical information:</div><div>HTTP status ' . http_response_code() . '</div>';
                        }
                    }
				?>
				</tr>
		</table>
	</div>
</body>
</html>
