<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	if (empty($_SESSION) || ($_SESSION["level"] != "owner")) {
		header('HTTP/1.0 403 Forbidden');
		include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/errors/403.php");
		die();
	} else {
		include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
	}
	
	function submit($connection, $query) {
		if ($connection->query($query) === TRUE) {
			echo '<span style="color: #00ff00; ">Õnnestus!</span><br/>';
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $query . '<br>' . $connection->error;
		}
	}
	
	function submitandclear($connection, $query) {
		submit($connection, $query);
		$_POST = array();
		$connection->close();
		echo '<br/><br/><a href="/dev">Tagasi</a>';
	}
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<title>Lisa sisu</title>
	<style>
		body {
			font-family: "Lucida Console", "Hack", "Monospace";
			background: #000;
			color: #0ff;
		}
		
		select, input[type="submit"], textarea, input[type="text"] {
			border: solid 3px #0ff;
			border-radius: 15px;
			padding: 10px;
			background: #222;
			color: #fff;
			font-family: "Lucida Console", "Hack", "Monospace";
		}
		
		input[type="text"] {
			width: 60%;
		}
		
		select:hover, input[type="submit"]:hover, textarea:hover, input[type="text"]:hover {
			background: #444;
			color: #fff;
		}
		
		textarea {
			width: 80%;
		}
	</style>
</head>
<body>
	<h1>Sisu lisamine</h1>
	<?php 
	if (empty($_POST)) {
		echo '
	<p>Vali lisatava sisu tüüp</p>';
		echo '<form action="index.php" method="post">';
		echo '<select name="new_item">';
		echo '	<option value="du">devUpdate</option>';
		echo '	<option value="dulog">devUpdate muudatustelogi üksus</option>';
		echo '	<option value="tuto">Õpetus</option>';
		echo '	<option value="tutosect">Õpetuse sektsioon</option>';
		echo '	<option value="tutosteps">Õpetuse sammud</option>';
		echo '	<option value="utils">Utilliidid ja kood</option>';
		echo '</select>';
		echo ' <input type="submit" value="Edasi"></input>';
		echo '</form>';
	} else if (!empty($_POST["new_item"])) {
		echo '
	<p>Määrake lisatav üksus</p>';
		echo '<form action="index.php" method="post">';
		switch($_POST["new_item"]) {
			case "du":
				echo '<br/>Pealkiri (inglise keeles): <input type="text" name="du_title_en"/>';
				echo '<br/><br/>Pealkiri (eesti keeles): <input type="text" name="title_et"/>';
				echo '<br/><br/>Lähtekoodi asukoht: <input type="text" name="source"/>';
				echo '<br/><br/>devUpdate osa: <input type="text" style="width: 50px;" name="part"/>';
				$query = "SELECT * FROM channel_db WHERE Kanal = \"#markusTegelane\"";
				echo '<br/><br/>Video: <select name="video">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["Video"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/>Muudatustelogi (ära nummerda, üks muudatus real, inglise keeles // eesti keeles):<br/><br/><textarea rows="10" name="changelog"></textarea>';
				echo '<br/><br/><input type="submit" value="Lisa"/>';
				break;
			case "dulog":
				echo '<br/>Muudatuse kirjeldus (inglise keeles): <input type="text" name="dulog_title_en"/>';
				echo '<br/><br/>Muudatuse kirjeldus (eesti keeles): <input type="text" name="title_et"/>';
				$query = "SELECT * FROM dev_du";
				echo '<br/><br/>devUpdate: <select name="du">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Lisa"/>';
				break;
			case "tuto":
				echo '<br/>Pealkiri (inglise keeles): <input type="text" name="tuto_title_en"/>';
				echo '<br/><br/>Pealkiri (eesti keeles): <input type="text" name="title_et"/>';
				$query = "SELECT * FROM channel_db WHERE Kanal = \"#markusTegelane\"";
				echo '<br/><br/>Video: <select name="video">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["Video"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Lisa"/>';
				break;
			case "tutosect":
				echo '<br/>Sektsiooni nimi (inglise keeles): <input type="text" name="sect_title_en"/>';
				echo '<br/><br/>Sektsiooni nimi (eesti keeles): <input type="text" name="title_et"/>';
				$query = "SELECT * FROM dev_tutos";
				echo '<br/><br/>Õpetus: <select name="tuto">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Lisa"/>';
				break;
			case "tutosteps":
				$query = "SELECT * FROM dev_tutos INNER JOIN dev_tutosections ON dev_tutos.ID = dev_tutosections.TUTO_ID";
				echo '<br/><br/>Sektsioon: <select name="tuto">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row[4] . '">[' . $row[4] . '] ' . $row["STITLE_ET"] . ' &lt;&gt; [' . $row[0] . '] ' . $row["TITLE_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/>Õpetuse sammud (ära nummerda, üks juhis real, vorming: inglise keeles // eesti keeles):<br/><br/><textarea rows="10" name="tuto_steps"></textarea>';
				echo '<br/><br/><input type="submit" value="Lisa"/>';
				break;
			case "utils":
				echo '<br/>Pealkiri (inglise keeles): <input type="text" name="utils_title_en"/>';
				echo '<br/><br/>Pealkiri (eesti keeles): <input type="text" name="title_et"/>';
				echo '<br/><br/>Kirjeldus (inglise keeles): <br/><br/><textarea type="text" name="desc_en"></textarea>';
				echo '<br/><br/>Kirjeldus (eesti keeles): <br/><br/><textarea type="text" name="desc_et"></textarea>';
				echo '<br/><br/>Lähtekoodi asukoht: <input type="text" name="source"/>';
				echo '<br/><br/>Allalaaditav fail<select name="dload">';
				$query = "SELECT * FROM dloads;";
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["DTITLE"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/>Video: <select name="video">';
				$query = "SELECT * FROM channel_db WHERE Kanal = \"#markusTegelane\";";
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["Video"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Lisa"/>';
				break;
		}
		echo '</form>';
	}
	else if (!empty($_POST["utils_title_en"])) {
		submitandclear($connection, "INSERT INTO dev_utils (TITLE_EN, TITLE_ET, DESCRIPTION_EN, DESCRIPTION_ET, DLOAD_ID, VIDEO_ID, SOURCE) VALUES (" .
				"\"" . $_POST["utils_title_en"] . "\", " .
				"\"" . $_POST["title_et"] . "\", " .
				"\"" . $_POST["desc_en"] . "\", " .
				"\"" . $_POST["desc_et"] . "\", " .
				"" . $_POST["dload"] . ", " .
				"" . $_POST["video"] . ", " .
				"\"" . $_POST["source"] . "\")");
	}
	else if (!empty($_POST["sect_title_en"])) {
		submitandclear($connection, "INSERT INTO dev_tutosections (STITLE_EN, STITLE_ET, TUTO_ID) VALUES (" .
				"\"" . $_POST["sect_title_en"] . "\", " .
				"\"" . $_POST["title_et"] . "\", " .
				"" . $_POST["tuto"] . ")");
	}
	else if (!empty($_POST["du_title_en"])) {
		$query = "INSERT INTO dev_du (TITLE_EN, TITLE_ET, NO, VIDEO, SOURCE) VALUES (" .
				"\"" . $_POST["du_title_en"] . "\", " .
				"\"" . $_POST["title_et"] . "\", " .
				"" . $_POST["part"] . ", " .
				"" . $_POST["video"] . ", " .
				"\"" . $_POST["source"] . "\")";
		submit($connection, $query);
		$get_last = mysqli_query($connection, "SELECT ID FROM dev_du ORDER BY(ID) DESC LIMIT 1");
		$id = mysqli_fetch_array($get_last)["ID"];
		$changelog_str = $_POST["changelog"];
		$changelog_rows = explode("\n", $changelog_str);
		foreach ($changelog_rows as &$row) {
			$translations = explode(" // ", $row);
			$en = $translations[0];
			$et = $translations[1];
			$query = "INSERT INTO dev_whatsnew (LINE_ID, CONTENT_EN, CONTENT_ET) VALUES (" .
					 $id . ", " .
					 "\"" . $en . "\", " .
					 "\"" . $et . "\")";
			echo '<p>' . $query . '</p>';
			submit($connection, $query);
		}
		$_POST = array();
		$connection->close();
		echo '<br/><br/><a href="/dev">Tagasi</a>';
	}
	 else if (!empty($_POST["dulog_title_en"])) {
		$query = "INSERT INTO dev_whatsnew (LINE_ID, CONTENT_EN, CONTENT_ET) VALUES (" .
				 $_POST["du"] . ", " .
				 "\"" . $_POST["dulog_title_en"] . "\", " .
				 "\"" . $_POST["title_et"] . "\")";
		submitandclear($connection, $query);
	 } else if (!empty($_POST["tuto_title_en"])) {
		$query = "INSERT INTO dev_tutos (TITLE_EN, TITLE_ET, VIDEO) VALUES (\"" .
				 $_POST["tuto_title_en"] . "\", " .
				 "\"" . $_POST["title_et"] . "\", " .
				 "" . $_POST["video"] . ")";
		submitandclear($connection, $query);
	 } else if (!empty($_POST["tuto_steps"])) {
		$tuto_id = $_POST["tuto"];
		$changelog_str = $_POST["tuto_steps"];
		$changelog_rows = explode("\n", $changelog_str);
		foreach ($changelog_rows as &$row) {
			$translations = explode(" // ", $row);
			$en = $translations[0];
			$et = $translations[1];
			$query = "INSERT INTO dev_tutosteps (SECTION_ID, CONTENT_EN, CONTENT_ET) VALUES (" .
					 $tuto_id . ", " .
					 "\"" . $en . "\", " .
					 "\"" . $et . "\")";
			echo '<p>' . $query . '</p>';
			submit($connection, $query);
		}
		$_POST = array();
		$connection->close();
		echo '<br/><br/><a href="/dev">Tagasi</a>';
	 }
	?>
</body>
</html>