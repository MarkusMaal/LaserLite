<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
function my_error_handler()
{
  $last_error = error_get_last();
  if ($last_error && $last_error['type']==E_ERROR)
      {
        header("HTTP/1.1 500 Internal Server Error");
        include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/errors/500.php");
      }
}
register_shutdown_function('my_error_handler');
if (!empty($_SESSION["egg"])) {
	if ($_SESSION["egg"] == "H3CK3R") {
		unset($_COOKIE["username"]);
		setcookie("username", "Hecker", time()+2678400, "/");
		$_SESSION["egg"] = "";
	}
	elseif ($_SESSION["egg"] == "experimental") {
		unset($_COOKIE["theme"]);
		setcookie("theme", "wip", time()+2678400, "/");
		$_SESSION["egg"] = "";
	}
}
$logged_in = FALSE;
if ((!empty($_SESSION))) { $logged_in = TRUE; }
function welcomeback() {
    unset($_COOKIE['cookie_ok']); 
    setcookie('cookie_ok', "o", -1, '/'); 
    if ($_COOKIE["theme"] != "dark") {
        setcookie("theme", "blue", time()+2678400, "/");
    }
    //echo '<meta http-equiv="Refresh" content="0; URL=/markustegelane?doc=welcomeback">';
}
$display_placeholder = false;
include("maintenance.php");
if ((!empty($_COOKIE["cookie_ok"])) && ($_COOKIE["cookie_ok"] == "true")) {
    welcomeback();
} else if (empty($_COOKIE["lang"])) {
	include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/config/cookie/setcookie.php");
    //echo '<meta http-equiv="Refresh" content="0; URL=/markustegelane/common/config/cookie">';
} else if ((!empty($_COOKIE["theme"])) && (!(($_COOKIE["theme"] == "dark") || ($_COOKIE["theme"] == "light") || ($_COOKIE["theme"] == "blue")))) {
	if (empty($_COOKIE["old_theme"]) || ($_COOKIE["old_theme"] != "true")) {
		welcomeback();
	}
}
if (!empty($_COOKIE["lang"])) {
	$lang = $_COOKIE["lang"];
}
$theme = "blue";
if (!empty($_COOKIE["theme"])) {
	$theme = $_COOKIE["theme"];
}
?>
<!DOCTYPE html>
<html lang="<?php if ($lang == "et-EE") { echo "et"; } else { echo "en"; } ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php if ($lang == "et-EE") { echo "Ametlik avalehekülg Markuse videod productions kanalitele."; } else { echo "Official home page for Markus' videos productions channels."; }?>">
  <meta name="keywords" content="MarkusTegelane,MarkusTegelane+,#markusTegelane,Press any key to continue...,Markuse asjad,Markuse tarkvara,Markuse videod,Kanalite andmebaas,Channel database,otseülekanded,live streams">
  <meta name="author" content="Markus Maal">
<title><?php if ($lang == "et-EE") { echo "Markuse videod productions - avaleht"; } else { echo "Markus' videos productions - home page"; } ?></title>
	<style>
		body {
			<?php
			switch ($theme) {
				case "light":
					echo 'background: radial-gradient(circle, #fff 10%, #bbb 70%, #bbb 100%);';
					echo 'color: #000;';
					echo 'background-color: #fff;';
					break;
				case "dark":
					echo 'background: radial-gradient(circle, #555 10%, #222 70%, #222 100%);';
					echo 'color: #fff;';
					echo 'background-color: #222;';
					break;
				default:
					echo 'background: radial-gradient(circle, #00f 10%, #008 70%, #008 100%);';
					echo 'color: #fff;';
					echo 'background-color: #008;';
					break;
			}
			?>
			background-size: 50% 100%;
			font-family: "Segoe UI", "Microsoft Sans Serif", "Ubuntu", "Sans";
		}
		h1 {
			font-style: normal;
			font-weight: normal;
			text-align: center;
		}
		
		h2 {
			font-style: normal;
			font-weight: normal;
			text-align: center;
		}
		
		.cont {
			margin-left: auto;
			margin-right: auto;
			vertical-align: bottom;
			padding-top: 3em;
		}
		table {
			border-collapse: collapse;
			margin:0 auto;
		}
		.thumb {
			border: 0.15em solid;
			border-color: #fff #888 #888 #fff;
			margin: 0em;
			padding: 0em;
			width: 96px;
			height: 96px;
		}
		
		.thumb:active {
			border: 0.17em solid;
			border-color: #888 #fff #fff #888;
			width: 95px;
			height: 95px;
			filter: brightness(95%);
		}
		
		img {
			margin: 0em;
			padding: 0em;
		}
		
		.desc {
			text-align: center;
		}
		
		td {
			margin: 1.5em;
			text-align: center;
			padding: 0.5em;
		}
		
		a {
			cursor: default;
			text-decoration: none;
			<?php
				if ($theme == "light") {
					echo 'color: #000;';
				} else {
					echo 'color: #fff;';
				}
			?>
		}
		
		a:hover {
			color: #0ff;
			text-decoration: underline;
		}
		
		p.copy {
			color: #0aa;
			text-align: center;
		}
		
		p.copy:hover {
			animation: hover 1s linear infinite;
			cursor: default;
		}
		
		.blink {
			animation: blink 1s linear infinite;
		}
		.blink-soft {
			animation: teeter 1s linear infinite;
			color: #f00;
		}
		.sizable {
			animation: zoom 20s linear infinite;
		}
		.colorful {
			animation: colors 5s linear infinite;
		}
		.unlogic {
			position: fixed;
			font-family: "Comic Sans MS", "Segoe UI", "Microsoft Sans Serif", "Ubuntu", "Sans";
			animation: fun 4s linear infinite;
		}
		
		@keyframes fun {
			0%{ font-size: 1em; left: 0em; top: 0em; color: #ff0; }
			15%{ font-size: 8em; left: 1.4em; top: 0em; -webkit-transform: rotate(-45deg); -moz-transform: rotate(-45deg); color: #0ff; }
			50%{ font-size: 0.5em; left: 18em; top: 20em; -webkit-transform: rotate(80deg); -moz-transform: rotate(80deg); color: #f0f; }
			75%{ font-size: 8em; left: 0em; top: 4em; -webkit-transform: rotate(-100deg); -moz-transform: rotate(-100deg); color: #f00; }
			100%{ font-size: 1em; left: 0em; top: 0em; -webkit-transform: rotate(0deg); -moz-transform: rotate(0deg); color: #ff0; }
		}
		
		@keyframes zoom{
			0%{
				font-size: 0.5em;
			}
			50%{
				font-size: 8em;
			}
			100%{
				font-size: 0.5em;
			}
		}
		@keyframes colors{
			0%{
				color: #f00;
			}
			16%{
				color: #ff0;
			}
			32%{
				color: #0f0;
			}
			49%{
				color: #0ff;
			}
			66%{
				color: #00f;
			}
			84%{
				color: #f0f;
			}
			100%{
				color: #f00;
			}
		}
		@keyframes blink{
			0%{
				opacity: 1;
			}
			49%{
				opacity: 1;
			}
			50%{
				opacity: 0;
			}
			99%{
				opacity: 0;
			}
			100%{
				opacity: 1;
			}
		}
		@keyframes hover {
			50%{
				color: #0cc;
			}
			100%{
				color: #0aa;
			}
		}
		
		@keyframes teeter{
			0%{
				opacity: 1;
			}
			50%{
				opacity: 0;
			}
			100%{
				opacity: 1;
			}
		}
		img[alt="www.000webhost.com"]
		{
			display:none;
		}

		.disclaimer
		{
			display:none;
		}
	</style>
	
	<script>
		function copyEgg() {
			var current = document.getElementsByClassName("copy")[0].innerHTML;
			<?php 
			if ("$lang" == "et-EE") {
				echo "var e1 = \"&copy;2022 Markus Maal\";";
				echo "var e2 = \"Ma ei ole ühendatud\";";
				echo "var e3 = \"Vajuta soovitud nupul, et alustada!\";";
				echo "var e4 = \"<span style=\\\"color: blue\\\">Seda teksti on väga raske näha</span>\";";
				echo "var e5 = \"<span class=\\\"blink\\\">Vilkuv tekst</span>\";";
				echo "var e6 = \"Lõpeta klikkimine...\";";
				echo "var e7 = \"<h2 class=\\\"blink-soft\\\">HÄIRE! HÄIRE! HÄIRE!</h2>\";";
				echo "var e8 = \"<span class=\\\"sizable\\\">Ma muudan suurust</span>\";";
				echo "var e9 = \"<span class=\\\"colorful\\\">Värviline</span>\";";
				echo "var e10 = \"<span class=\\\"unlogic\\\">Püüa mind kinni!</span>\";";
			} else {
				echo "var e1 = \"&copy;2022 Markus Maal\";";
				echo "var e2 = \"I am not connected\";";
				echo "var e3 = \"Click on the desired button to start!\";";
				echo "var e4 = \"<span style=\\\"color: blue\\\">This text is hard to see</span>\";";
				echo "var e5 = \"<span class=\\\"blink\\\">Blinking text</span>\";";
				echo "var e6 = \"Stop clicking...\";";
				echo "var e7 = \"<h2 class=\\\"blink-soft\\\">ALERT! ALERT! ALERT!</h2>\";";
				echo "var e8 = \"<span class=\\\"sizable\\\">I am changing size</span>\";";
				echo "var e9 = \"<span class=\\\"colorful\\\">Colorful</span>\";";
				echo "var e10 = \"<span class=\\\"unlogic\\\">Catch me!</span>\";";
			}
			?>
			switch (current) {
				case e1:
					document.getElementsByClassName("copy")[0].innerHTML = e2;
					break;
				case e2:
					document.getElementsByClassName("copy")[0].innerHTML = e3;
					break;
				case e3:
					document.getElementsByClassName("copy")[0].innerHTML = e4;
					break;
				case e4:
					document.getElementsByClassName("copy")[0].innerHTML = e5;
					break;
				case e5:
					document.getElementsByClassName("copy")[0].innerHTML = e6;
					break;
				case e6:
					document.getElementsByClassName("copy")[0].innerHTML = e7;
					break;
				case e7:
					document.getElementsByClassName("copy")[0].innerHTML = e8;
					break;
				case e8:
					document.getElementsByClassName("copy")[0].innerHTML = e9;
					break;
				case e9:
					document.getElementsByClassName("copy")[0].innerHTML = e10;
					break;
				case e10:
					document.getElementsByClassName("copy")[0].innerHTML = e1;
					break;
				default:
					document.getElementsByClassName("copy")[0].innerHTML = e2;
					break;
			}
		}
	</script>
</head>
<body>
	<div class="cont">
	<h1>markustegelane</h1>
	<div style="text-align: center; background: linear-gradient(90deg, <?php
		if (empty($_COOKIE['theme']) || ($_COOKIE["theme"] == 'blue')) {
			echo '#04f0, #04f0, #04f8, #04f0, #04f0';
		} else if ($_COOKIE['theme'] == 'dark') {
			echo '#4440, #4440, #4448, #4440, #4440';
		} else {
			echo '#eee0, #eee0, #eee8, #eee0, #eee0';
		}
	
	?>);">
	<?php include("connect.php");
		$query = "SELECT ename, etime, echannel, eurl FROM schedules";
		$result = mysqli_query($connection, $query);
		$cy = date("Y");
		$cm = date("n");
		$cd = date("d");
		$th = date("H");
		$tm = date("i");
		$ts = date("s");
		while ($e = mysqli_fetch_array($result)) {
			$row = $e;
			$state = "notlive";
	 		$dd = explode("-", explode(" ", $row[1])[0])[2];
	 		$dm = explode("-", explode(" ", $row[1])[0])[1];
	 		$dy = explode("-", explode(" ", $row[1])[0])[0];
	 		$d_mon = explode("-", explode(" ", $row[1])[0])[1];
	 		$delta_h = explode(":", explode(" ", $row[1])[1])[0] - $th;
	 		$delta_m = explode(":", explode(" ", $row[1])[1])[1] - $tm;
	 		$delta_s = explode(":", explode(" ", $row[1])[1])[2] - $ts;
	 		$delta_t = $delta_h * 60 * 60 + $delta_m * 60 + $delta_s;
	 		if (($dd >= $cd) && ($dm >= $cm) && ($dy >= $cy)) {
	 			if ($dd - $cd == 0) {
		 			if ($delta_t >= -10000) {
	 					$state = "soon";
	 				}
	 				else if (($delta_t >= -10000) && ($delta_t <= -7200)) {
	 					$state = "ending";
	 				}
	 				else if ($delta_t < 3600) {
	 					if ($delta_t > 0) {
		 					$state = "verysoon";
		 				} else {
		 					if ($delta_t >= -10000) {
		 						$state = "live";
		 					}
		 				}
	 				}
	 			} else if ($d_mon - $cm == 0) {
		  			$state = "upcoming";
				}
	 		}
		}
		if (($state != "notlive")  && ($state != "upcoming")) {
			$time = explode(":", explode(" ", $row[1])[1]);
			if ($lang == "et-EE") {
			 	echo '<h2>otseülekanne: ' . $row[0] . '</h2>';
			 	echo '<p>algus täna kell '. $time[0] . ":" . $time[1] . '</p>';
				echo '<a href="' . $row[3] . '">Ülekande link</a>';
			} else if ($lang == "en-US") {
			 	echo '<h2>live stream: ' . $row[0] . '</h2>';
			 	echo '<p>today at '. $time[0] . ":" . $time[1] . ' (UTC+2)</p>';
				echo '<a href="' . $row[3] . '">Stream link</a>';
			}
		} else if ($state == "upcoming") {
			$time = explode(":", explode(" ", $row["etime"])[1]);
			$nd = $dd - $cd;
			if ($lang == "et-EE") {
				switch ($nd) {
					case 2:
						$str_time = "ülehomme";
						break;
					case 1:
						$str_time = "homme";
						break;
					default:
						$str_time = $nd . " päeva pärast";
						break;
				}
			 	echo '<h2>otseülekanne: ' . $row["ename"] . '</h2>';
			 	echo '<p>algab ' . $str_time . ' kell '. $time[0] . ":" . $time[1] . ' [<a href="' . $row["eurl"] . '">Ülekande link</a>]</p>';
			} else if ($lang == "en-US") {
				switch ($nd) {
					case 2:
						$str_time = "the day after tomorrow";
						break;
					case 1:
						$str_time = "tommorrow";
						break;
					default:
						$str_time = "after " . $nd . " days";
						break;
				}
			 	echo '<h2>live stream: ' . $row[0] . '</h2>';
			 	echo '<p>' . $str_time . ' at '. $time[0] . ":" . $time[1] . ' (UTC+2) [<a href="' . $row[3] . '">Stream link</a>]</p>';
			}
			
		}?>
	</div>
	<h2><?php if ($lang == "et-EE") { echo "kiire juurdepääs"; } else { echo "quick access"; } ?></h2>
		<table>
			<tr>
				<td>
					<a href="markustegelane" title="<?php if ($lang == "et-EE") { echo "põhileht"; } else { echo "main page"; } ?>"><img class="thumb" src="images/pushbutton_mt.svg"/></a>
				</td>
				<td>
					<a href="plus" title="<?php if ($lang == "et-EE") { echo "pluss"; } else { echo "plus"; } ?>"><img class="thumb" src="images/pushbutton_mtl.svg"/></a>
				</td>
				<td>
					<a href="dev" title="dev"><img class="thumb" src="images/pushbutton_hmt.svg"/></a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="mas_db" title="<?php if ($lang == "et-EE") { echo "markuse asjad"; } else { echo "markus' stuff"; } ?>"><img class="thumb" src="images/mas_db.png"/></a>
				</td>
				<td>
					<a href="channel_db" title="<?php if ($lang == "et-EE") { echo "kanali andmebaas"; } else { echo "channel database"; } ?>"><img class="thumb" src="images/db.png"/></a>
				</td>
				<td>
					<a href="batch" title="<?php if ($lang == "et-EE") { echo "pakkfail"; } else { echo "batch file"; } ?>"><img class="thumb" src="images/cmd.png"/></a>
				</td>
			</tr>
			<tr>
				<td>
					<a title="<?php if (!$logged_in) {
						if ($lang == "et-EE") {
							echo "sisselogimine";
						} else {
							echo "login";
						}
					} else {
						if ($lang == "et-EE") {
							echo "väljalogimine";
						} else {
							echo "logout";
						}
					}
					?>" href="markustegelane/common/config/<?php if (!$logged_in) { echo 'login.php?redir=..'; } else { echo 'logout.php?redir=/'; }?>"><img class="thumb" src="images/login.png"/></a>
				</td>
				<td>
					<a title="<?php if ($lang == "et-EE") { echo "valge müra"; } else { echo "white noise"; } ?>" href="static"><img class="thumb" src="images/static.png"/></a>
				</td>
				<td>
					<a title="<?php if ($lang == "et-EE") { echo "juhuslik leht"; } else { echo "random page"; } ?>" href="markustegelane/common/lucky"><img class="thumb" src="images/random.png"/></a>
				</td>
			</tr>
		</table>
		<?php
			if (empty($_SESSION["egg"])) {
				echo '<p class="copy" onclick="copyEgg();">&copy;2022 Markus Maal</p>';
			} elseif ($_SESSION["egg"] == "M4RKU5T3G3L4N3") {
				echo '<p class="copy">';
				if ($lang == "et-EE") { echo "Aitäh!"; } else { echo "Thank you!"; }
				echo '</p>';
				$_SESSION["egg"] = "";
			} elseif ($_SESSION["egg"] == "H3CK3R") {
				echo '<p class="copy">👨🏻‍💻 Hello, Hecker!</p>';
			} else {
				echo '<p class="copy" onclick="copyEgg();">&copy;2022 Markus Maal</p>';
			}
		?>
		<div style="text-align: center;">
			[<a href="markustegelane/common/config/chlang.php"><?php if ($lang == "et-EE") { echo "Change language to English"; } else { echo "Kuva see veebileht eesti keeles"; } ?></a>]<br/>
			[<a href="markustegelane/common/config/chthm.php"><?php if ($lang == "et-EE") { echo "Muuda värviskeemi"; } else { echo "Change color scheme"; } ?></a>]<br/>
			[<a href="markustegelane/common/config"><?php if ($lang == "et-EE") { echo "Lisanduvad sätted"; } else { echo "Additional settings"; } ?></a>]<br/>
			<?php if ($lang == "et-EE") {
				echo "<p>See veebileht kasutab tehnilisi küpsiseid kasutajaeelistuste salvestamiseks.<br/>Ma ei kogu telemeetriat veebilehe külastajate kohta.</p>";
			} else {
				echo "<p>This web page uses technical cookies for saving user preferences.<br/>I am not collecting telemetry or other data about the visitors of the web page.</p>";
			} ?>
		</div>
	</div>
	
</body>
</html>
