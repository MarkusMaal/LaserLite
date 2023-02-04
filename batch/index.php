<?php session_start(); include("../maintenance.php"); include("../markustegelane/common/config/getcookies.php");?>
<!DOCTYPE html>
<html lang="<?php if ($lang == "et-EE") { echo "et"; } else { echo "en"; } ?>">
	<head>
		<title>Allalaadimiste pakkfail</title>
		<style>
			<?php $theme = $thm; ?>
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
				text-align: center;
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
	</head>
	<body>
		<div class="cont">
			<h1>markustegelane</h1>
			<h2><?php if ($lang == "et-EE") { echo "allalaadimiste pakkfail"; } else { echo "batch download center"; } ?></h2>
			<?php
			if ($lang == "et-EE") {
				echo "<p>Allalaadimiste pakkfail võimaldab laadida alla faile ilma seda veebilehte<br/>külastamata. Juhul kui teil puudub tihti internetiühendust või teil on raskusi<br/>selle veebilehe külastamisega, võib see pakkfail just teile kasulik olla.</p>";
			} else {
				echo "<p>The batch download center allows you to download files without visiting this<br/>web page. In case you are frequently unable to connect to the internet or<br/>you are having trouble visiting this website, this batch file might be useful for you.</p>";
			}?>
			<div class="screenshots">
				<img src="../markustegelane/images/dloads/bstore.png"/>
				<img src="../markustegelane/images/dloads/bstore2.png"/>
			</div>
			[<a href="/app/store2.zip"><?php if ($lang == "et-EE") { echo "Laadi alla</a>] (kontrollsumma"; } else { echo "Download</a>] (checksum"; } ?>: 2EA241622EF93E29BD258E45CA4EF25F)<br/>[<a href=".."><?php if ($lang == "et-EE") { echo "Tagasi"; } else { echo "Go back"; } ?></a>]
			<p class="copy" onclick="copyEgg();"s>&copy;2022 Markus Maal</p>
			<div style="text-align: center;">
				<a href="/markustegelane/common/config/chlang.php" style="color: #0ff"><?php if ($lang == "et-EE") { echo "Change language to English"; } else { echo "Kuva see veebileht eesti keeles"; } ?></a>
				<?php if ($lang == "et-EE") {
					echo "<p>See veebileht kasutab tehnilisi küpsiseid kasutajaeelistuste salvestamiseks.<br/>Ma ei kogu telemeetriat veebilehe külastajate kohta.</p>";
				} else {
					echo "<p>This web page uses technical cookies for saving user preferences.<br/>I am not collecting telemetry or other data about the visitors of the web page.</p>";
				} ?>
			</div>
		</div>
	</body>
</html>