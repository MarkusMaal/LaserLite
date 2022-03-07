		<?php
		include($_SERVER["DOCUMENT_ROOT"] . "/mobcheck.php");
		$lang = "en-US";
		if (!empty($_COOKIE["lang"])) {
			$lang = $_COOKIE["lang"];
		}
		
		function ms($en, $et, $lang) {
			if ($lang == "et-EE") {
				return $et;
			} else {
				return $en;
			}
		}
		?>
<html lang="<?php
    if ($lang == "et-EE") {
        echo "et";
    } else {
        echo "en";
    }
?>">
	<head>
        <title><?php
            if ($lang == "et-EE") {
                echo 'Avaleht';
            } else {
                echo 'Home page';
            }
        ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicons/dev.ico" />
        <link rel="stylesheet" href="style<?php if ($isMob) { echo "_m"; } ?>.css">
	</head>

	<body>
		<div class="parent">
		<img src="resources/pfp_dev.png" style="margin-left: 20px; width: 100px;">
		<h1>#markusTegelane<span class="blinky">.</span></h1>
		</div>
		<div class="navbar">
			<a class="link" href="/markustegelane">
				<div class="navitem">
					<?php echo ms("Go back", "Tagasi avalehele", $lang) ?>
				</div>
			</a>
			<a class="link" href="https://www.youtube.com/channel/UCvpWEcJTj4DRGIa3o279-3Q">
				<div class="navitem">
					<?php echo ms("Visit channel", "Külasta kanalit", $lang) ?>
				</div>
			</a>
			<a class="link" href="https://github.com/MarkusMaal?tab=repositories">
				<div class="navitem">
					<?php echo ms("Github repositiories", "Github hoidlad", $lang) ?>
				</div>
			</a>
		</div>
		<div class="container">
			<div class="blue">
				<h2>devUpdate</h2>
				<p>
					<?php echo ms("Update reports for my software. Mainly videos uploaded to the channel.",
					"Arendamise käigus tehtavad muudatuste ülevaated. Need on peamiselt videod, mille leiate sellelt kanalilt.", $lang);?>
				</p>
			<hr class="blue">
			<p style="color: #00f">
					<?php echo ms("Movement Pie (Python game)",
					"Movement Pie (Python mäng)", $lang);?>
			</p>
			<p>
				devUpdate 1 (<a href="https://www.youtube.com/watch?v=wH83EieQVaM">video</a>)
			</p>
			<p>
				<?php echo ms("What's new?",
				"Mis on uut?", $lang);?>
			</p>
			<ol>
				<li><?php echo ms("First public release. Anyone heard of this game?",
				"Esimene avalik väljaanne. Kas keegi on midagi selle mängu kohta kuulnud? ", $lang);?></li>
			</ol>
			<p>
				<?php echo ms("Source code coming soon!",
				"Lähtekood peagi tulemas", $lang);?>
			</p>
			<hr class="blue">
			<p style="color: #00f">
					<?php echo ms("Blue Screen Simulator Plus",
					"Blue Screen Simulator Plus (sinise ekraani simulaator)", $lang);?>
			</p>
			<p>
				devUpdate 1
				(<a href="https://www.youtube.com/watch?v=XG6mGJGkBBo">video</a>)
			</p>
			<p>
				<?php echo ms("What's new?",
				"Mis on uut?", $lang);?>
			</p>
			<ol>
				<li><?php echo ms("Windows 11 blue screen background color changed from black to blue",
				"Windows 11 sinise ekraani taustavärv muudeti siniseks (musta värvi asemel) ", $lang);?></li>
				<li><?php echo ms("Windows Vista and 7 were separated to make each screen more realistic",
				"Windows Vista ja 7 eraldati, et muuta kumbki ekraan realistlikumaks ", $lang);?></li>
				<li><?php echo ms("Option to close the program after ending prank mode",
				"Programmist väljumise valik pärast vemburežiimist väljumist", $lang);?></li>
				<li><?php echo ms("Much more accurate Windows 2000 blue screen",
				"Palju realistlikum Windows 2000 sinine ekraan", $lang);?></li>
				<li><?php echo ms("Smaller improvements and technical changes",
				"Väiksemad täiustused ja tehnilised muudatused", $lang);?></li>
			</ol>
			<a href="https://github.com/MarkusMaal/BlueScreenSimulatorPlus/tree/experimental">
					<?php echo ms("Latest build (source)",
					"Hiliseim järk (kood)", $lang);?></a>
			<hr class="blue">
			</div>
			<div class="green">
				<h2><?php echo ms("Tutorials", "Õpetused", $lang) ?></h2>
				<p>
					<?php echo ms("These tutorials help you with development and other things.",
					"Arendamise ja muude tegevuste õpetused.", $lang);?>
				</p>
				<hr class="green">
				<p style="color: #0f0;">
				     <?php echo ms("How to convert icons to cursors (and vice versa)",
					"Kuidas teisendada ikoone kursoriteks (ja vastupidi)", $lang);?>
				</p>
				<p>
					<?php echo ms("Cursor to icon",
					"Kursor ikooniks", $lang);?>
				</p>
				<ol>
					<li>
						<?php echo ms("Replace the file extension. For example, if the filename is example.cur, rename it to example.ico.",
						"Asendage faililaiend. Näiteks, kui failinimi on example.cur, seadke nimeks example.ico", $lang);?>
					</li>
					<li>
						<?php echo ms("Open the file in a hex editor, such as HxD",
						"Avage fail heksakoodi redaktoris, näiteks HxD-s", $lang);?>
					</li>
					<li>
						<?php echo ms("Select the value at offset 0x2, change the value from &quot;2&quot; to &quot;1&quot;",
						"Valige väärtus 3. baidil, muutke väärtus &quot;2&quot; üheks (1)", $lang);?>
					</li>
					<li>
						<?php echo ms("Save the file",
						"Salvestage fail", $lang);?>
					</li>
				</ol>
				<p>
					<?php echo ms("Icon to cursor",
					"Ikoon kursoriks", $lang);?>
				</p>
				<ol>
					<li>
						<?php echo ms("Replace the file extension. For example, if the filename is example.ico, rename it to example.cur.",
						"Asendage faililaiend. Näiteks, kui failinimi on example.ico, seadke nimeks example.cur", $lang);?>
					</li>
					<li>
						<?php echo ms("Open the file in a hex editor, such as HxD",
						"Avage fail heksakoodi redaktoris, näiteks HxD-s", $lang);?>
					</li>
					<li>
						<?php echo ms("Select the value at offset 0x2, change the value from &quot;1&quot; to &quot;2&quot;",
						"Valige väärtus 3. baidil, muutke väärtus &quot;1&quot; kaheks (2)", $lang);?>
					</li>
					<li>
						<?php echo ms("Save the file",
						"Salvestage fail", $lang);?>
					</li>
				</ol>
				<a href="https://www.youtube.com/watch?v=yHjQbyRFDCk" target="_blank">
					<?php echo ms("Video tutorial",
					"Video", $lang);?>
				</a>
				<hr class="green">
			</div>
			<div class="red">
				<h2><?php echo ms("Utilities and code", "Utiliidid ja kood", $lang) ?></h2>
				<p><?php echo ms("Cool, simple, and useful software created by me!",
					"Lahedad, lihtsad ja kasulikud tarkvaraprogrammid, mille olen ise teinud!", $lang);?></p>
				<hr class="red">
				<p style="color: #f00">ascii2pixels</p>
				<p><?php echo ms("This tool allows you to convert plain text ASCII images to regular grayscale low-resolution images.",
					"See tööriist võimaldab teil teisendada puhttekstilised ASCII kujutised tavalisteks must-valgeteks madala resolutsiooniga piltideks.", $lang);?></p>
				
				<a href="https://github.com/MarkusMaal/ascii2pixels/releases/download/v0.9-beta/ASCIIArtToImage.exe"><?php echo ms("Download",
					"Allalaadimine", $lang);?></a>
				<a href="https://github.com/MarkusMaal/ascii2pixels">
					<?php echo ms("Source code",
					"Lähtekood", $lang);?></a>
				<a href="https://www.youtube.com/watch?v=tEh0XZ37P00">
				<?php echo ms("Demonstration video",
					"Demonstreeriv video", $lang);?></a>
				<hr class="red">
				<p style="color: #f00"><?php echo ms("Segment display tool",
					"Segmentkuva tööriist", $lang);?></p>
				<img style="width: 90%;" src="/markustegelane/images/dloads/st.png"/>
				<p><?php echo ms("This tool allows you to visually toggle different segments on a virtual 7 or 8 segment display. It can also output the segments into a list, which is useful for development.",
					"See tööriist võimaldab kuvada ja lülitada sisse/välja erinevaid segmente virtuaalsel 7 või 8 segmendiliselt ekraanil. Sellega saab ka tagastada segmendid järjendisse, mis on kasulik arendamisel.", $lang);?></p>
				<a href="/markustegelane/?doc=download&id=37"><?php echo ms("Download", "Allalaadimine", $lang);?></a>
				<a href="https://github.com/MarkusMaal/SegmentDisplayTool" target="_blank"><?php echo ms("Source code", "Lähtekood", $lang);?></a>
				
				<hr class="red">
			</div>
		</div>
	</body>
</html>
