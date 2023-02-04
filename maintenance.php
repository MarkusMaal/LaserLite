<?php
$maintenance = false;
if ($maintenance) {
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	if ((!empty($_SESSION["usr"]) && ($_SESSION["level"] == "owner")) || (str_contains($_SERVER["REQUEST_URI"], "login"))) {
		echo "<div style=\"display: flex; justify-content: center; background: linear-gradient(#ffaa2274, #cbaa2277); width: 100%; float: left; bottom: 0px; position: fixed; z-index: 1;\"><div><img style=\"margin-left: 30px;\" height=50 src=\"../../../../../../markustegelane/images/work.svg\"/></div>";
		echo "<div style=\"margin-top: 0.75em;\"><span style=\"font-size: 18px; color: yellow; margin-left: 10px; z-index: 0;\">";
		if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US"))
		{
			echo "Warning: Under maintenance message bypassed with a manager account. This website may be unstable.";
		} else {
			echo "Hoiatus: Veebisaidi konstrueerimisteade eemaldati pärast haldaja kontoga sisselogimist. See veebisait võib olla ebastabiilne.";
		}
		echo "</span></div></div>";
	}
	else {
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
	}
} else {
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
		ini_set('error_reporting', E_ALL);
}
?>
