<div class="sidepanel2">
	<h1><?php echo ms3("New videos", "Uued videod"); ?></h1>
	<?php
		error_reporting(0);
		include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
		$query_mt = "SELECT * FROM channel_db WHERE Kanal = \"markustegelane\" AND AVALIK = 1 ORDER BY(ID) DESC LIMIT 2";
		$query_mtx = "SELECT * FROM channel_db WHERE Kanal = \"markustegelane lite\" AND AVALIK = 1  ORDER BY(ID) DESC LIMIT 2";
		$query_hmt = "SELECT * FROM channel_db WHERE Kanal = \"#markusTegelane\" AND AVALIK = 1  ORDER BY(ID) DESC LIMIT 2";
		$query_mts = "SELECT * FROM channel_db WHERE Kanal = \"Markuse asjad\" AND AVALIK = 1  ORDER BY(ID) DESC LIMIT 2";
		$query_paktc = "SELECT * FROM channel_db WHERE Kanal = \"Press any key to continue...\" AND AVALIK = 1  ORDER BY(ID) DESC LIMIT 2";
		$result_mt = mysqli_query($connection, $query_mt);
		$result_mtx = mysqli_query($connection, $query_mtx);
		$result_hmt = mysqli_query($connection, $query_hmt);
		$result_mts = mysqli_query($connection, $query_mts);
		$result_paktc = mysqli_query($connection, $query_paktc);
		while ($row = mysqli_fetch_array($result_mt)) {
			echo '<a href="' . $row["URL"] . '"><img src="/channel_db/thumbs/' . $row["ID"] . '.jpg"></a>';
		}
		while ($row = mysqli_fetch_array($result_mtx)) {
			echo '<a href="' . $row["URL"] . '"><img src="/channel_db/thumbs/' . $row["ID"] . '.jpg"></a>';
		}
		while ($row = mysqli_fetch_array($result_hmt)) {
			echo '<a href="' . $row["URL"] . '"><img src="/channel_db/thumbs/' . $row["ID"] . '.jpg"></a>';
		}
		while ($row = mysqli_fetch_array($result_mts)) {
			echo '<a href="' . $row["URL"] . '"><img src="/channel_db/thumbs/' . $row["ID"] . '.jpg"></a>';
		}
		while ($row = mysqli_fetch_array($result_paktc)) {
			echo '<a href="' . $row["URL"] . '"><img src="/channel_db/thumbs/' . $row["ID"] . '.jpg"></a>';
		}
	?>
	<p><?php echo ms3("Channels", "Kanalid"); ?>:</p>
	<ul>
	<li>markustegelane</li>
	<p><?php echo ms3("My main channel, that posts videos about technology and entertainment. New videos don't come out too often tough.", "Minu põhiline kanal, mis postitab videosid arvutitest ja meelelahutusest. Videosid ei lasta siiski väga sageli välja."); ?></p>
	<li>markustegelane lite</li>
	<p><?php echo ms3("This is my second channel. I post stuff more frequently here, but quality of the videos will be lower.", "See on mu teine kanal. Ma postitan videosid siia sagedamini, aga see kanal ei ole nii aktiivne."); ?></p>
	<li>&#35;markusTegelane</li>
	<p><?php echo ms3("This is a programming focused channel, where I post updates for my upcoming projects and other fun stuff. All content is in English.", "See on programmeerimisele keskendunud kanal, kuhu postitan enda tulevaste projektide uuendusi ja muud lõbusat värki. Kogu sisu on ingliskeelne."); ?></p>
	<li>Markuse asjad</li>
	<p><?php echo ms3("A channel about my stuff. Videos come out least often compared to other two channels.", "Kanal minu asjadest. Võrreldes kahe eelneva kanaliga, postitan ma siia kanalile kõige vähem videosid.");?></p>
	<li>Press any key to continue...</li>
	<p><?php echo ms3("A channel about random gaming and computing related content. No specific upload schedule or quality control for content.", "Kanal juhusliku mängude ja arvutitega seotud sisuga. Sellel kanalil pole konkreetset üleslaadimisgraafikut või sisu kvaliteedikontrolli.");?></p>
	</ul>
	</div>