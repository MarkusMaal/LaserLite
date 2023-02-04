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
	<title>Kustuta sisu</title>
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
	<h1>Sisu eemaldamine</h1>
	<?php 
	if (empty($_POST)) {
		echo '
	<p>Vali kustutatava sisu tüüp</p>';
		echo '<form action="index.php" method="post">';
		echo '<select name="old_item">';
		echo '	<option value="du">devUpdate</option>';
		echo '	<option value="dulog">devUpdate muudatustelogi üksus</option>';
		echo '	<option value="tuto">Õpetus</option>';
		echo '	<option value="tutosect">Õpetuse sektsioon</option>';
		echo '	<option value="tutosteps">Õpetuse sammud</option>';
		echo '	<option value="utils">Utilliidid ja kood</option>';
		echo '</select>';
		echo ' <input type="submit" value="Edasi"></input>';
		echo '</form>';
	} else if (!empty($_POST["old_item"])) {
		echo '
	<p>Määrake kustutatav üksus</p>';
		echo '<form action="index.php" method="post">';
		switch($_POST["old_item"]) {
			case "du":
				$query = "SELECT * FROM dev_du";
				echo 'ID: <select name="du_id">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Kustuta"/>';
				break;
			case "dulog":
				$query = "SELECT * FROM dev_du INNER JOIN dev_whatsnew ON dev_du.ID = dev_whatsnew.LINE_ID";
				echo 'ID: <select name="dulog_id">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row[6] . '">[' . $row[0] . '] ' . $row["TITLE_ET"] . ' &lt;&gt; [' . $row[6] . '] ' . $row["CONTENT_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Kustuta"/>';
				break;
			case "tuto":
				$query = "SELECT * FROM dev_tutos";
				echo 'ID: <select name="tuto_id">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Kustuta"/>';
				break;
			case "tutosect":
				$query = "SELECT * FROM dev_tutos INNER JOIN dev_tutosections ON dev_tutos.ID = dev_tutosections.TUTO_ID";
				echo 'ID: <select name="sect_id">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row[4] . '">[' . $row[0] . '] ' . $row["TITLE_ET"] . ' &lt;&gt; [' . $row[4] . '] ' . $row["STITLE_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Kustuta"/>';
				break;
			case "tutosteps":
				$query = "SELECT * FROM dev_tutosections INNER JOIN dev_tutosteps ON dev_tutosections.ID = dev_tutosteps.SECTION_ID";
				echo 'ID: <select name="step_id">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row[4] . '">[' . $row[0] . '] ' . $row["STITLE_ET"] . ' &lt;&gt; [' . $row[4] . '] ' . $row["CONTENT_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Kustuta"/>';
				break;
			case "utils":
				$query = "SELECT * FROM dev_utils";
				echo 'ID: <select name="utils_id">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . '</option>';
				}
				echo '</select>';
				echo '<br/><br/><input type="submit" value="Kustuta"/>';
				break;
		}
		echo '</form>';
	} else {
			if (!empty($_POST["utils_id"])) { submitandclear($connection, "DELETE FROM dev_utils WHERE ID = " . $_POST["utils_id"]);
			} else if (!empty($_POST["step_id"])) { submitandclear($connection, "DELETE FROM dev_tutosteps WHERE ID = " . $_POST["step_id"]);
			} else if (!empty($_POST["dulog_id"])) { submitandclear($connection, "DELETE FROM dev_whatsnew WHERE ID = " . $_POST["dulog_id"]);
			} else if (!empty($_POST["du_id"])) {
				submit($connection, "DELETE FROM dev_whatsnew WHERE LINE_ID = " . $_POST["du_id"]);
				submitandclear($connection, "DELETE FROM dev_du WHERE ID = " . $_POST["du_id"]);
			} else if (!empty($_POST["sect_id"])) {
				submit($connection, "DELETE FROM dev_tutosteps WHERE SECTION_ID = " . $_POST["sect_id"]);
				submitandclear($connection, "DELETE FROM dev_tutosections WHERE ID = " . $_POST["sect_id"]);
			} else if (!empty($_POST["tuto_id"])) {
				$query = "SELECT * FROM dev_tutosections WHERE TUTO_ID = " . $_POST["tuto_id"];
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					submit($connection, "DELETE FROM dev_tutosteps WHERE SECTION_ID = " . $row["ID"]);
				}
				submit($connection, "DELETE FROM dev_tutosections WHERE TUTO_ID = " . $_POST["tuto_id"]);
				submitandclear($connection, "DELETE FROM dev_tutos WHERE ID = " . $_POST["tuto_id"]);
			}
		}
	?>
</body>
</html>