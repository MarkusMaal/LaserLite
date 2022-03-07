<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<h1>Lisa kirje</h1>
<?php
	if (!empty($_POST["channel_name"])) {
		echo $_POST["channel_name"];
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasige ühendumine nurjus.
			Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span>');
		}
		$done = "0";
		if ($_POST["bool-done"] == "on") {
			$done = "1";
		}
		$live = "0";
		if ($_POST["bool-livestr"] == "on") {
			$live = "1";
		}
		
		// sql päring
		$sql = 'INSERT INTO channel_ideas (Kanal, Video, Valmis, Ülekanne, Kirjeldus, Klass) ' . 
			   'VALUES ("' . $_POST["channel_name"] . '", "' . $_POST["title"] . '", ' . $done . 
			  ' , ' . $live . ', "' . $_POST["description"] . '", ' . $_POST["class"] .')';
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
		include("../../connect.php");
		$query = "SELECT * FROM channel_ideas WHERE id = " . $_GET["temp_id"];
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		$temp_channel = $row["Kanal"];
		$temp_video = $row["Video"];
		$temp_class = $row["Klass"];
		$temp_done = str_replace("1", "checked", str_replace("0", "", $row["Valmis"]));
		$temp_stream = str_replace("1", "checked", str_replace("0", "", $row["Ülekanne"]));
		$temp_description = $row["Kirjeldus"];
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
	include("../../connect.php");
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
<tr>
<td>Klass:</td>
<?php
if (!empty($_GET["temp_id"])) {
echo '<td><input name="class" id="class" style="width: 1%;" type="text" value="' . $temp_class . '"/></td>';
} else {
echo '<td><input name="class" id="class" style="width: 1%;" type="text"/></td>';
}
?>
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
<td>Video kirjeldus</td>
<?php
if (empty($_GET["temp_id"])) {
	echo '<td><textarea name="description" id="desc" rows="5" cols="100"></textarea></td>';
} else {
	echo '<td><textarea name="description" id="desc" rows="5" cols="100">' . $temp_description . '</textarea></td>';
}
?>
</tr>
</table>

<?php
if (empty($_GET["temp_id"])) {
	echo '<input name="bool-done" id="del" type="checkbox"/>Valmis<br/>';
	echo '<input name="bool-livestr" id="live" type="checkbox"/>Otseülekanne<br/>';
} else {
	echo '<input name="bool-done" id="del" type="checkbox" '. $temp_done . '/>Kustutatud<br/>';
	echo '<input name="bool-livestr" id="live" type="checkbox" '. $temp_stream . '/>Otseülekanne<br/>';
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
