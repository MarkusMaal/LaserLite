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
		$_POST = array();
		echo '<span style="color: #00ff00; ">Õnnestus!</span><br/>';
	} else {
		echo '<span style="color: #ff0000; ">Viga: ' . $query . '<br>' . $connection->error;
	}
	$connection->close();
	echo '<br/><br/><a href="/dev">Tagasi</a>';
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<title>Content updater</title>
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
	</style>
</head>
<body>
	<h1>Sisu muutmine</h1>
	<form type="submit" action="index.php" method="post">
	<?php 
		if (empty($_POST)) {
			echo '
		<p>Muuda</p>
		<p>Valige uuendatava sisu tüüp</p>
		<select name="update_type">
			<option value="du">devUpdate</option>
			<option value="tuto">Õpetused</option>
			<option value="utils">Utiliidid ja kood</option>
		</select>
		<input type="submit" value="Jätka"></input>';
		} else if (!empty($_POST["update_type"])) {
			echo '<p>Muuda &gt; ';
			switch ($_POST["update_type"]) {
					case "du":
						echo "devUpdate";
						break;
					case "tuto":
						echo "Õpetused";
						break;
					case "utils":
						echo "Utiliidid ja kood";
						break;
			}
			echo '<p>Valige, mida muuta</p>';
			switch ($_POST["update_type"]) {
				case "du":
					echo '
		<select name="content_select">
			<option value="du">Põhiandmed</option>
			<option value="whatsnew">Mis on uut?</option>
		</select>';
					break;
				case "tuto":
					echo '
		<select name="content_select">
			<option value="tutos">Põhiandmed</option>
			<option value="sects">Sektsioonid</option>
			<option value="steps">Sammud</option>
		</select>';
					break;
				case "utils":
					echo '
		<select name="content_select">
			<option value="utils">Põhiandmed</option>
		</select>';
					break;
			}
			echo ' <input type="submit" value="Jätka"></input>';
		} else if (!empty($_POST["content_select"])) {
			echo '<p>Muuda &gt; ';
			switch ($_POST["content_select"]) {
					case "du":
						echo "devUpdate &gt; Põhiandmed";
						break;
					case "whatsnew":
						echo "devUpdate &gt; Mis on uut?";
						break;
					case "tutos":
						echo "Õpetused &gt; Põhiandmed";
						break;
					case "sects":
						echo "Õpetused &gt; Sektsioonid";
						break;
					case "steps":
						echo "Õpetused &gt; Sammud";
						break;
					case "utils":
						echo "Utiliidid ja kood &gt; Põhiandmed";
						break;
			}
			echo "<p>Valige muudetav üksus</p>";
			$cs = $_POST["content_select"];
			$_SESSION["CONTENT_SELECT"] = $_POST["content_select"];
			if (($cs == "du") || ($cs == "whatsnew")) {
				$query = "SELECT * FROM dev_du";
				echo '
	<select name="field_select">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '
		<option value = "' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . ' (devUpdate ' . $row["NO"] . ')</option>';
				}
				echo '
	</select> <input type="submit" value="Jätka"></input>
	';
			} else if (($cs == "tutos") || ($cs == "sects") || ($cs == "steps")) {
				$query = "SELECT * FROM dev_tutos";
				echo '
	<select name="field_select">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '
		<option value = "' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . ' (devUpdate ' . $row["NO"] . ')</option>';
				}
				echo '
	</select> <input type="submit" value="Jätka"></input>
	';
			} else if ($cs == "utils") {
				$query = "SELECT * FROM dev_utils";
				echo '
	<select name="field_select">';
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_array($result)) {
					echo '
		<option value = "' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["TITLE_ET"] . ' (devUpdate ' . $row["NO"] . ')</option>';
				}
				echo '
	</select> <input type="submit" value="Jätka"></input>
	';
			}
		} else if (!empty($_POST["field_select"])) {
			if (empty($_SESSION["CONTENT_SELECT"])) {
				die("Katastroofiline viga");
			} else {
				$cs = $_SESSION["CONTENT_SELECT"];
				$_SESSION["CONTENT_SELECT"] = null;
				$id = $_POST["field_select"];
				echo '<p>Muuda &gt; ';
				switch ($cs) {
						case "du":
							echo "devUpdate &gt; Põhiandmed &gt; Muuda elementi " . $id;
							break;
						case "whatsnew":
							echo "devUpdate &gt; Mis on uut? &gt; Muuda elementi " . $id;
							break;
						case "tutos":
							echo "Õpetused &gt; Põhiandmed &gt; Muuda elementi " . $id;
							break;
						case "sects":
							echo "Õpetused &gt; Sektsioonid &gt; Muuda elementi " . $id;
							break;
						case "steps":
							echo "Õpetused &gt; Sammud &gt; Muuda elementi " . $id;
							break;
						case "utils":
							echo "Utiliidid ja kood &gt; Põhiandmed &gt; Muuda elementi " . $id;
							break;
				}
				echo "<p>Tehke soovitud muudatused</p>";
				if ($cs == "du") {
					$query = "SELECT * FROM dev_du WHERE ID = " . $id;
					$result = mysqli_query($connection, $query);
					$row = mysqli_fetch_array($result);
					$_SESSION["ID"] = $id;
					echo '
					<br/>Pealkiri (inglise keeles): <input style="width: 50%;" type="text" maxlength="100" name="du_title_en" value="' . $row["TITLE_EN"] . '"></input>
					<br/>Pealkiri (eesti keeles): <input style="width: 50%;" type="text" maxlength="100" name="du_title_et" value="' . $row["TITLE_ET"] . '"></input>
					<br/>devUpdate osa: <input style="width: 30px;" type="text" maxlength="11" name="du_no" value="' . $row["NO"] . '"></input>
					<br/>Lähtekoodi asukoht: <input style="width: 60%;" type="text" maxlength="128" name="du_source" value="' . $row["SOURCE"] . '"></input>
					<br/>Video: <select name="du_video">';
					$query = "SELECT * FROM channel_db";
					$result = mysqli_query($connection, $query);
					while ($vrow = mysqli_fetch_array($result)) {
						echo '<option value="' . $vrow["ID"] . '"';
						if ($vrow["ID"] == $row["VIDEO"]) {
							echo ' selected';
						}
						echo '>[' . $vrow["ID"] . '] ' . $vrow["Video"];
						echo '</option>
						';
					}
					echo '
					</select>
					';
				} else if ($cs == "whatsnew") {
					$query = "SELECT * FROM dev_whatsnew WHERE LINE_ID = " . $id;
					$result = mysqli_query($connection, $query);
					echo 'Vali muudatustelogi üksus: <select name="whatsnew_id">';
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["CONTENT_ET"] . ' // ' . $row["CONTENT_EN"] . '</option>';
					}
					echo '</select><br/>';
					echo "Uus väärtus (eesti keeles): <input style=\"width: 50%;\" type=\"text\" name=\"whatnew_content_en\"></input><br/>";
					echo "Uus väärtus (inglise keeles): <input style=\"width: 50%;\" type=\"text\" name=\"whatnew_content_et\"></input>";
				} else if ($cs == "tutos") {
					$query = "SELECT * FROM dev_tutos WHERE ID = " . $id;
					$result = mysqli_query($connection, $query);
					$row = mysqli_fetch_array($result);
					$_SESSION["ID"] = $id;
					echo '
					<br/>Pealkiri (inglise keeles): <input style="width: 50%;" type="text" maxlength="100" name="tuto_title_en" value="' . $row["TITLE_EN"] . '"></input>
					<br/>Pealkiri (eesti keeles): <input style="width: 50%;" type="text" maxlength="100" name="tuto_title_et" value="' . $row["TITLE_ET"] . '"></input>
					<br/>Video: <select name="tuto_video">';
					$query = "SELECT * FROM channel_db";
					$result = mysqli_query($connection, $query);
					while ($vrow = mysqli_fetch_array($result)) {
						echo '<option value="' . $vrow["ID"] . '"';
						if ($vrow["ID"] == $row["VIDEO"]) {
							echo ' selected';
						}
						echo '>[' . $vrow["ID"] . '] ' . $vrow["Video"];
						echo '</option>
						';
					}
					echo '
					</select>
					';
				} else if ($cs == "sects") {
					$query = "SELECT * FROM dev_tutosections WHERE TUTO_ID = " . $id;
					$result = mysqli_query($connection, $query);
					echo 'Vali sektsioon, mille nime muuta: <select name="sects_id">';
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["STITLE_ET"] . ' // ' . $row["STITLE_EN"] . '</option>';
					}
					echo '</select>';
					$_SESSION["ID"] = $id;
					echo '<br/>Uus väärtus (inglise keeles): <input name="tuto_sect_en" type="text" style="width: 50%;"></input>';
					echo '<br/>Uus väärtus (eesti keeles): <input name="tuto_sect_et" type="text" style="width: 50%;"></input>';
				} else if ($cs == "steps") {
					$query = "SELECT * FROM dev_tutosections WHERE TUTO_ID = " . $id;
					$result = mysqli_query($connection, $query);
					echo 'Vali sektsioon, mille üksuseid muuta: <select name="steps_sect_id">';
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . '] ' . $row["STITLE_ET"] . '</option>';
					}
					echo '</select>';
				} else if ($cs == "utils") {
					$query = "SELECT * FROM dev_utils WHERE ID = " . $id;
					$result = mysqli_query($connection, $query);
					$row = mysqli_fetch_array($result);
					$_SESSION["ID"] = $id;
					echo '
					<br/>Pealkiri (inglise keeles): <input style="width: 50%;" type="text" maxlength="128" name="util_title_en" value="' . $row["TITLE_EN"] . '"></input>
					<br/>Pealkiri (eesti keeles): <input style="width: 50%;" type="text" maxlength="128" name="util_title_et" value="' . $row["TITLE_ET"] . '"></input>
					<br/>Lähtekoodi asukoht: <input style="width: 60%;" type="text" maxlength="256" name="util_source" value="' . $row["SOURCE"] . '"></input>
					<br/>Kirjeldus (inglise keeles): <textarea style="width: 50%;" type="text" maxlength="512" name="util_desc_en">' . $row["DESCRIPTION_EN"] . '</textarea>
					<br/>Kirjeldus (eesti keeles): <textarea style="width: 50%;" type="text" maxlength="512" name="util_desc_et">' . $row["DESCRIPTION_ET"] . '</textarea>
					<br/>Allalaaditav fail: <select name="util_dload">';
					$query = "SELECT * FROM dloads";
					$result = mysqli_query($connection, $query);
					while ($drow = mysqli_fetch_array($result)) {
						echo '<option value="' . $drow["ID"] . '"';
						if ($drow["ID"] == $row["DLOAD_ID"]) {
							echo ' selected';
						}
						echo '>[' . $drow["ID"] . '] ' . $drow["DTITLE"];
						echo '</option>
						';
					}
					echo '
					</select>
					';
					echo '
					<br/>Video: <select name="util_video">';
					$query = "SELECT * FROM channel_db";
					$result = mysqli_query($connection, $query);
					while ($vrow = mysqli_fetch_array($result)) {
						echo '<option value="' . $vrow["ID"] . '"';
						if ($vrow["ID"] == $row["VIDEO_ID"]) {
							echo ' selected';
						}
						echo '>[' . $vrow["ID"] . '] ' . $vrow["Video"];
						echo '</option>
						';
					}
					echo '
					</select>
					';
				}
				echo '<br/><br/><input type="submit" value="Jätka"></input>';
			}
		} else if (!empty($_POST["steps_sect_id"])) {
			echo '<p>Sammude muutmine</p>';
			$ssid = $_POST["steps_sect_id"];
			$query = "SELECT * FROM dev_tutosteps WHERE SECTION_ID = " . $ssid;
			echo '<p>Eesti keel</p>';
			$result = mysqli_query($connection, $query);
			while ($row = mysqli_fetch_array($result)) {
				echo '[' . $row["ID"] . "] " . $row["CONTENT_ET"] . '<br/>';
			}
			echo '<br/>Muudetav samm: <select name="step_id">';
			$result = mysqli_query($connection, $query);
			while ($row = mysqli_fetch_array($result)) {
				echo '<option value="' . $row["ID"] . '">[' . $row["ID"] . "] " . $row["CONTENT_ET"] . '</option>';
			}
			echo '</select>';
			echo '<br/>Uus väärtus: <input style="width: 50%;" type="text" name="step_newvalue_et"></input>';
			echo '<br/><br/><p>Inglise keel</p>';
			$result = mysqli_query($connection, $query);
			while ($row = mysqli_fetch_array($result)) {
				echo '[' . $row["ID"] . "] " . $row["CONTENT_EN"] . '<br/>';
			}
			
			echo '<br/>Uus väärtus: <input style="width: 50%;" type="text" name="step_newvalue_en"></input>';
			echo '<br/><br/><input type="submit" value="Jätka"></input>';
		} else if (!empty($_POST["step_id"])) {
			$query = "UPDATE dev_tutosteps SET CONTENT_EN = \"" . str_replace("\"", "&quot;", $_POST["step_newvalue_en"]) . "\", CONTENT_ET = \"" . str_replace("\"", "&quot;", $_POST["step_newvalue_et"]) . "\" WHERE ID = " . $_POST["step_id"];
			submit($connection, $query);
		} else if (!empty($_POST["util_title_en"])) {
			if (empty($_SESSION["ID"])) {
				die("Katastroofiline viga");
			} else {
				$id = $_SESSION["ID"];
				$_SESSION["ID"] = null;
				$title_en = $_POST["util_title_en"];
				$title_et = $_POST["util_title_et"];
				$description_en = $_POST["util_desc_en"];
				$description_et = $_POST["util_desc_et"];
				$source = $_POST["util_source"];
				$dload = $_POST["util_dload"];
				$video = $_POST["util_video"];
				$query = "UPDATE dev_utils SET ".
						 "TITLE_EN = \"" . $title_en . "\"" .
						 ", TITLE_ET = \"" . $title_et . "\"" .
						 ", DESCRIPTION_EN = \"" . $description_en . "\"" .
						 ", DESCRIPTION_ET = \"" . $description_et . "\"" .
						 ", DLOAD_ID = " . $dload .
						 ", VIDEO_ID = " . $video .
						 ", SOURCE = \"" . $source . "\"" .
						 " WHERE ID = " . $id;
				submit($connection, $query);
			}
		} else if (!empty($_POST["du_title_en"])) {
			if (empty($_SESSION["ID"])) {
				die("Katastroofiline viga");
			} else {
				$id = $_SESSION["ID"];
				$_SESSION["ID"] = null;
				$title_en = $_POST["du_title_en"];
				$title_et = $_POST["du_title_et"];
				$no = $_POST["du_no"];
				$video = $_POST["du_video"];
				$source = $_POST["du_source"];
				$query = "UPDATE dev_du SET ".
						 "TITLE_EN = \"" . $title_en . "\"" .
						 ", TITLE_ET = \"" . $title_et . "\"" .
						 ", NO = " . $no .
						 ", VIDEO = " . $video .
						 ", SOURCE = \"" . $source . "\"" .
						 " WHERE ID = " . $id;
				submit($connection, $query);
				
			}
		} else if (!empty($_POST["tuto_title_en"])) {
			if (empty($_SESSION["ID"])) {
				die("Katastroofiline viga");
			} else {
				$id = $_SESSION["ID"];
				$_SESSION["ID"] = null;
				$title_en = $_POST["tuto_title_en"];
				$title_et = $_POST["tuto_title_et"];
				$video = $_POST["tuto_video"];
				$query = "UPDATE dev_tutos SET ".
						 "TITLE_EN = \"" . $title_en . "\"" .
						 ", TITLE_ET = \"" . $title_et . "\"" .
						 ", VIDEO = " . $video .
						 " WHERE ID = " . $id;
				submit($connection, $query);
				
			}
		} else if (!empty($_POST["tuto_sect_en"])) {
			if (empty($_SESSION["ID"])) {
				die("Katastroofiline viga");
			} else {
				$id = $_SESSION["ID"];
				$_SESSION["ID"] = null;
				$stitle_en = $_POST["tuto_sect_en"];
				$stitle_et = $_POST["tuto_sect_et"];
				$query = "UPDATE dev_tutosections SET ".
						 "STITLE_ET = \"" . $stitle_et . "\"" .
						 ", STITLE_EN = \"" . $stitle_en . "\"" .
						 " WHERE ID = " . $id;
				submit($connection, $query);
			}
		}
	?>
	
	</form>
</body>
</html>