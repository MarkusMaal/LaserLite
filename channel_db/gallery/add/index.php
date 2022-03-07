<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<h1>Lisa kirje</h1>
<?php
	if (!empty($_POST["channel"])) {
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasige ühendumine nurjus.
			Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span>');
		}
		$del = "0";
		if ($_POST["bool-done"] == "on") {
			$del = "1";
		}
		
		// sql päring
		$sql = 'INSERT INTO channel_gallery (Kanal, Kirjeldus, Kustutatud, Loomiskuupäev, URL) ' . 
			   'VALUES ("' . $_POST["channel"] . '", "' . $_POST["description"] . '", ' . $del . 
			  ', ("' . $_POST["date-year"] . '-' . $_POST["date-month"] . '-' . $_POST["date-day"] . '"), "' . $_POST["url"] .'")';
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
		$query = "SELECT * FROM channel_gallery WHERE id = " . $_GET["temp_id"];
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		$temp_channel = $row["Kanal"];
		$temp_url = $row["URL"];
		$temp_kustutatud = str_replace("1", "checked", str_replace("0", "", $row["Kustutatud"]));
		$temp_description = $row["Kirjeldus"];
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<table>
<tr>
<td>Kanal</td>
<td>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<?php
if (empty($_GET["temp_id"])) {
    echo '<input name="channel" style="width: 97%" type="text"/>';
} else {
   echo '<input name="channel" style="width: 97%" type="text" value="' . $temp_channel . '"/>';
}?>
</td>
</tr>
<tr>
<td>Loomiskuupäev (AAAA-KK-PP)</td>
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
<td>URL</td>
<?php
if (!empty($_GET["temp_id"])) {
echo '<td><input name="url" id="url" style="width: 97%;" type="text" value="' . $temp_url . '"/></td>';
} else {
echo '<td><input name="url" id="url" style="width: 97%;" type="text"/></td>';
}
?>
<tr>
<td>Kanali kirjeldus</td>
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
	echo '<input name="bool-done" id="del" type="checkbox"/>Kustutatud<br/>';
} else {
	echo '<input name="bool-done" id="del" type="checkbox" '. $temp_deleted . '/>Kustutatud<br/>';
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
