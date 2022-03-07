<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<h1>Lisa kirje</h1>
<?php
	if (!empty($_POST["channel_name"])) {
		echo $_POST["channel_name"];
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasige ühendumine nurjus.
			Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span>');
		}
		$del = "0";
		if ($_POST["bool-delete"] == "on") {
			$del = "1";
		}
		$sub = "0";
		if ($_POST["bool-subtitle"] == "on") {
			$sub = "1";
		}
		$pub = "0";
		if ($_POST["bool-public"] == "on") {
			$pub = "1";
		}
		$live = "0";
		if ($_POST["bool-livestr"] == "on") {
			$live = "1";
		}
		$hd = "0";
		if ($_POST["bool-highdef"] == "on") {
			$hd = "1";
		}
		
		// sql päring
		$sql = 'INSERT INTO channel_db (Kanal, Video, Kustutatud, Kuupäev, Kirjeldus, Subtiitrid, Avalik, Ülekanne, HD, URL)' . 
			   'VALUES ("' . $_POST["channel_name"] . '", "' . $_POST["title"] . '", ' . $del . 
			  ' , ("' . $_POST["date-year"] . '-' . $_POST["date-month"] . '-' . $_POST["date-day"] . '"), "' .
			   $_POST["description"] . '", ' . $sub . ', ' . $pub . ', ' .
			   $live . ', ' . $hd . ', "' . $_POST["uri"] . '")';
		if ($connection->query($sql) === TRUE) {
			$_POST = array();
			echo '<span style="color: #00ff00; ">Õnnestus! Kirje lisati andmebaasi</span><br/>';
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
		}
		$connection->close();
		echo '<br/><a href="index.php">Tagasi andmebaasi</a>';
		die();
	}
	if (!empty($_GET["temp_id"])) {
		include("../connect.php");
		$query = "SELECT * FROM channel_db WHERE ID = " . $_GET["temp_id"];
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		$temp_channel = $row[1];
		$temp_video = $row[2];
		$temp_delete = str_replace("1", "checked", str_replace("0", "", $row[3]));
		$temp_date = explode("-", $row[4]);
		$temp_description = $row[5];
		$temp_subtitles = str_replace("1", "checked", str_replace("0", "", $row[6]));
		$temp_public = str_replace("1", "checked", str_replace("0", "", $row[7]));
		$temp_stream = str_replace("1", "checked", str_replace("0", "", $row[8]));
		$temp_hd = str_replace("1", "checked", str_replace("0", "", $row[9]));
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<table>
<tr>
<td>Kanali nimi:</td>
<td>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<select name="channel_name" id="channel">
<?php
	include("../connect.php");
	$channels = mysqli_query($connection, "SELECT DISTINCT Kanal FROM channel_db");
	while ($row = mysqli_fetch_array($channels)) {
			if ((!empty($_GET["temp_id"])) && ($row[0] == $temp_channel)) {
				echo '<option value="' . $row[0] . '" selected>' . $row[0] . '</option>';
			} else {
				echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
			}
	}
?>
</td>
</select>
</tr>
<td>Video pealkiri</td>
<?php
if (!empty($_GET["temp_id"])) {
echo '<td><input name="title" id="title" style="width: 97%;" type="text" value="' . $temp_video . '"/></td>';
} else {
echo '<td><input name="title" id="title" style="width: 97%;" type="text"/></td>';
}
?>
<tr>
<td>Kuupäev (AAAA-KK-PP)</td>
<?php
if (empty($_GET["temp_id"])) {
echo '<td><input name="date-year" style="width: 5%;" type="text" id="year" value="2020"/><input name="date-month" style="width: 2%;" id="month" type="text"  value="11"/><input name="date-day" id="day" style="width: 2%;" type="text" value="01"/></td>';
} else {
echo '<td>';
echo '<input name="date-year" style="width: 5%;" type="text" id="year" value="' . $temp_date[0] . '"/>';
echo '<input name="date-month" style="width: 2%;" id="month" type="text"  value="' . $temp_date[1] . '"/>';
echo '<input name="date-day" id="day" style="width: 2%;" type="text" value="' . $temp_date[2] . '"/>';
echo '</td>';
}
?>
</tr>
<tr>
<td>Video kirjeldus</td>
<?php
if (empty($_GET["temp_id"])) {
	echo '<td><textarea name="description" id="desc" rows="5" cols="100"></textarea></td>';
} else {
	echo '<td><textarea name="description" id="desc" rows="5" cols="100">' . $temp_description . '</textarea></td>';
}
?>
</tr>
<tr>
<td>URL</td>
<td><input style="width: 35%;" type="text" name="uri" id="urid"></input></td>
</tr>
</table>

<?php
if (empty($_GET["temp_id"])) {
	echo '<input name="bool-delete" id="del" type="checkbox"/>Kustutatud<br/>';
	echo '<input name="bool-public" id="pub" type="checkbox" checked/>Avalik<br/>';
	echo '<input name="bool-subtitle" id="sub" type="checkbox"/>Subtiitrid<br/>';
	echo '<input name="bool-livestr" id="live" type="checkbox"/>Otseülekanne<br/>';
	echo '<input name="bool-highdef" id="hd" type="checkbox" checked/>Kõrge kvaliteet<br/>';
} else {
	echo '<input name="bool-delete" id="del" type="checkbox" '. $temp_delete . '/>Kustutatud<br/>';
	echo '<input name="bool-public" id="pub" type="checkbox" '. $temp_public . '/>Avalik<br/>';
	echo '<input name="bool-subtitle" id="sub" type="checkbox" '. $temp_subtitles . '/>Subtiitrid<br/>';
	echo '<input name="bool-livestr" id="live" type="checkbox" '. $temp_stream . '/>Otseülekanne<br/>';
	echo '<input name="bool-highdef" id="hd" type="checkbox" '. $temp_hd . '/>Kõrge kvaliteet<br/>';
}
?>
<br/><a href="#/" onclick="InsertRecord();">Lisa üksus</a><a href="..">Tagasi</a>
</form>
<script>
	function InsertRecord() {
		document.getElementById("form1").submit();
	}
</script>
<?php include("../foot.php"); ?>
