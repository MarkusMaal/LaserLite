<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
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
<!DOCTYPE html>
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="/favicons/dev.ico" />
        <link rel="stylesheet" href="style<?php if ($isMob) { echo "_m"; } ?>.css">
	</head>

	<body>
		<?php
		if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		echo '
		<div class="symbolbar">';
		echo '<a title="';
		if ($lang == "et-EE") { echo 'Lisa kirje'; } else { echo 'Add record'; }
		echo '" class="funsymbols" href="add_text">&#10133;</a>';
		echo '<a title="';
		if ($lang == "et-EE") { echo 'Kustuta kirje'; } else { echo 'Delete record'; }
		echo '" class="funsymbols" href="delete_text">&#10134;</a>';
		echo '<a title="';
		if ($lang == "et-EE") { echo 'Uuenda kirje'; } else { echo 'Update record'; }
		echo '" class="funsymbols" href="edit_text">&#10024;</a>';
		echo '
		</div>';
		}
		?>
		<div class="parent">
		<img src="resources/pfp_dev.svg" class="logo">
		<h1>#markusTegelane<span class="blinky">&nbsp;</span></h1>
		</div>
		<div class="navbar">
			<a class="link" href="/">
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
			<?php
				$query = "SELECT ID, TITLE_EN, NO, VIDEO, SOURCE FROM dev_du ORDER BY(ID) DESC";
				if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) {
					$query = "SELECT ID, TITLE_ET, NO, VIDEO, SOURCE FROM dev_du ORDER BY(ID) DESC";
				}
				$rows = mysqli_query($connection, $query);
				
				while ($row = mysqli_fetch_array($rows)) {
					echo "<p style=\"color: #00f;\">" . $row[1] . "</p>";
					$cdb_query = mysqli_query($connection, "SELECT URL FROM channel_db WHERE ID = " . $row[3]);
					$cdb_row = mysqli_fetch_array($cdb_query);
					echo "<img style=\"width: 90%;\" src=\"/channel_db/thumbs/" . $row[3] . ".jpg\">";
					echo "<p>devUpdate " . $row[2] . " (<a href=\"" . $cdb_row[0] .  "\">video</a>)</p>";
					echo "<p>" . ms("What's new?", "Mis on uut?", $lang) . "</p><ol>";
					
					$wnquery = mysqli_query($connection, "SELECT CONTENT_EN, CONTENT_ET FROM dev_whatsnew WHERE LINE_ID = " . $row[0]);
					while ($cli = mysqli_fetch_array($wnquery)) {
						echo "<li>";
						if (empty($_COOKIE["lang"]) || $_COOKIE["lang"] == "en-US") { echo $cli["CONTENT_EN"]; }
						                                                       else { echo $cli["CONTENT_ET"]; }
						echo "</li>";
					}
					echo "</ol>";
					echo "<a href=\"" . $row["SOURCE"] . "\">" . ms("Source code", "Lähtekood", $lang) . "</a>";
					echo "<hr class=\"blue\">";
				}
			?>
			</div>
			<div class="green">
				<h2><?php echo ms("Tutorials", "Õpetused", $lang) ?></h2>
				<p>
					<?php echo ms("These tutorials help you with development and other things.",
					"Arendamise ja muude tegevuste õpetused.", $lang);?>
				</p>
				<hr class="green">
				<?php
				$tquery = "SELECT ID, TITLE_EN, VIDEO FROM dev_tutos";
				if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) {
					$tquery = "SELECT ID, TITLE_ET, VIDEO FROM dev_tutos";
				}
				$tquery = $tquery . " ORDER BY(ID) DESC";
				$rows = mysqli_query($connection, $tquery);
				while ($row = mysqli_fetch_array($rows)) {
					echo "<p style=\"color: #0f0;\">" . $row[1] . "</p>";
					$tsquery = "SELECT ID, STITLE_EN, TUTO_ID FROM dev_tutosections";
					if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) {
						$tsquery = "SELECT ID, STITLE_ET, TUTO_ID FROM dev_tutosections";
					}
					$cquery = mysqli_query($connection, $tsquery . " WHERE TUTO_ID = " . $row[0] . " ORDER BY(ID)");
					while ($srow = mysqli_fetch_array($cquery)) {
						$squery = mysqli_query($connection, "SELECT * FROM dev_tutosteps WHERE SECTION_ID = " . $srow["ID"]);
						echo "<p>" . $srow[1] . "</p>";
						echo "<ol>";
						while ($ssrow = mysqli_fetch_array($squery)) {
							echo "<li>";
							if ($lang == "et-EE") {
								echo $ssrow["CONTENT_ET"];
							} else {
								echo $ssrow["CONTENT_EN"];
							}
							echo "</li>";
						}
						echo "</ol>";
					}
					$cdb_query = mysqli_query($connection, "SELECT URL FROM channel_db WHERE ID = " . $row["VIDEO"]);
					$cdb_row = mysqli_fetch_array($cdb_query);
					echo "<img style=\"width: 90%;\" src=\"/channel_db/thumbs/" . $row[2] . ".jpg\">";
					echo "<a href=\"". $cdb_row["URL"] . "\">" . ms("Video tutorial", "Video", $lang) . "</a>";
					echo "<hr class=\"green\">";
				}
				?>
			</div>
			<div class="red">
				<h2><?php echo ms("Utilities and code", "Utiliidid ja kood", $lang) ?></h2>
				<p><?php echo ms("Cool, simple, and useful software created by me!",
					"Lahedad, lihtsad ja kasulikud tarkvaraprogrammid, mille olen ise teinud!", $lang);?></p>
				<hr class="red">
				<?php
				$uquery = "SELECT ID, TITLE_EN, DESCRIPTION_EN, DLOAD_ID, VIDEO_ID, SOURCE FROM dev_utils";
				if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) {
					$uquery = "SELECT ID, TITLE_ET, DESCRIPTION_ET, DLOAD_ID, VIDEO_ID, SOURCE FROM dev_utils";
				}
				$uquery = $uquery . " ORDER BY(ID) DESC";
				$rows = mysqli_query($connection, $uquery);
				while ($urow = mysqli_fetch_array($rows)) {
					echo "<p style=\"color: red;\">" . $urow[1] . "</p>";
					if ($urow["DLOAD_ID"] != null) {
						$dstr = "SELECT * FROM dscrnshots WHERE DLOAD = " . $urow["DLOAD_ID"];
						$scrnshot_query = mysqli_query($connection, $dstr);
						while ($row = mysqli_fetch_array($scrnshot_query)) {
							echo "<img style=\"width: 90%;\" src=\"/markustegelane/" . $row["URI"] . "\">";
						}
					}
					if ($urow["VIDEO_ID"] != null) {
						echo "<img style=\"width: 90%;\" src=\"/channel_db/thumbs/" . $urow["VIDEO_ID"] . ".jpg\">";
					}
					echo "<p>" . $urow[2] . "</p>";
					if ($urow["DLOAD_ID"] != null) {
						$dstr = "SELECT * FROM dlinks WHERE DLOAD = " . $urow["DLOAD_ID"] . " AND LINK_PRIMARY = 1";
						$dload_query = mysqli_query($connection, $dstr);
						$dlink = mysqli_fetch_array($dload_query)["LINK_URI"];
						echo "<a href=\"" . $dlink . "\">" . ms("Download", "Allalaadimine", $lang) . "</a> ";
					}
					echo "<a href=\"" . $urow["SOURCE"] . "\">" . ms("Source code", "Lähtekood", $lang) . "</a>";
					if ($urow["VIDEO_ID"] != null) {
						$cdb_query = mysqli_query($connection, "SELECT URL FROM channel_db WHERE ID = " . $urow["VIDEO_ID"]);
						$cdb_row = mysqli_fetch_array($cdb_query);
						echo " <a href=\"" . $cdb_row["URL"] . "\">" . ms("Demonstration video", "Demonstreeriv video", $lang) . "</a>";
					}
					echo "<hr class=\"red\">";
				}
				?>
			</div>
		</div>
	</body>
</html>
