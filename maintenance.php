
<?php
$maintenance = false;

if ($maintenance) {
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	if ((empty($_COOKIE["cookie_ok"]) || ($_COOKIE["cookie_ok"] != "dev"))) {
		/*echo "<table style=\"background: linear-gradient(#ffaa2274, #cbaa2277); width: 100%; float: top; position: fixed; z-index: 1;\"><tr><td><img style=\"margin-left: 30px;\" height=50 src=\"../../../../../../markustegelane/images/work.svg\"/></td>";
		echo "<td><span style=\"font-size: 18px; color: yellow; margin-left: 10px;\">";
		if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US"))
		{
			echo "Warning: Web server issues. Website may be unstable.";
		} else {
			echo "Hoiatus: Veebiserveri probleemid. Veebileht võib olla ebastabiilne.";
		}
		echo "</span></td></tr></table>";*/
		include($_SERVER["DOCUMENT_ROOT"] . "/constructor/index.php");
		die();
	} else {	
		echo "<table style=\"background: linear-gradient(#ffaa2274, #cbaa2277); width: 100%; float: top; position: fixed; z-index: 1;\"><tr><td><img style=\"margin-left: 30px;\" height=50 src=\"../../../../../../markustegelane/images/work.svg\"/></td>";
		echo "<td><span style=\"font-size: 18px; color: yellow; margin-left: 10px;\">";
		if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US"))
		{
			echo "Warning: Under maintenance message bypass using a magic cookie. This website may be unstable.";
		} else {
			echo "Hoiatus: Veebisaidi konstrueerimisteade eemaldati maagilise küpsisega. See veebisait võib olla ebastabiilne.";
		}
		echo "</span></td></tr></table>";
	}
} else {
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');
}
?>
