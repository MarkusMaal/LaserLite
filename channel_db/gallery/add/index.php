<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
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
		if ($result != null) {
			$row = mysqli_fetch_array($result);
			$temp_channel = $row["Kanal"];
			$temp_url = $row["URL"];
			$temp_kustutatud = str_replace("1", "checked", str_replace("0", "", $row["Kustutatud"]));
			$temp_description = $row["Kirjeldus"];
			$temp_date = $row["Loomiskuupäev"];
			$temp_deleted = $row["Kustutatud"];
		}
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<form method="post" action="" name="form" id="form1" enctype="multipart/mixed">
<div class="form-floating my-2">
<?php
if (empty($_GET["temp_id"])) {
    echo '<input class="form-control" id="channel" name="channel" type="text"/>';
} else {
   echo '<input class="form-control" id="channel" name="channel" type="text" value="' . $temp_channel . '"/>';
}?>
<label for="channel">Kanal</label>
</div>
<div class="form-floating my-2">
<?php
if (empty($_GET["temp_id"])) {
echo '<input class="form-control" type="date" name="date" style="width: 25%;" type="text" id="ymd" value="2020-11-01"/>';
} else {
echo '<input class="form-control" type="date" name="date" style="width: 25%;" type="text" id="ymd" value="';
echo "${temp_date}";
echo '"/>';
}
?><label for="ymd">Loomiskuupäev</label><div>
<div class="form-floating my-2">
<?php
if (!empty($_GET["temp_id"])) {
echo '<input class="form-control" name="url" id="url" type="text" value="' . $temp_url . '"/>';
} else {
echo '<input class="form-control" name="url" id="url" type="text"/>';
}
?><label for="url">URL</label>
</div>
<div class="form-floating my-2">
<?php
if (empty($_GET["temp_id"])) {
	echo '<textarea class="form-control" name="description" id="desc" rows="5" cols="100"></textarea>';
} else {
	echo '<textarea class="form-control" name="description" id="desc" rows="5" cols="100">' . $temp_description . '</textarea>';
}
?>
<label for="desc">Kanali kirjeldus</label>
</div>
<?php
if (empty($_GET["temp_id"])) {
	echo '<div class="form-check"><input class="form-check-input" name="bool-done" id="del" type="checkbox"/><label class="form-check-label" for="del">Kustutatud</label></div>';
} else {
	echo '<div class="form-check"><input class="form-check-input" name="bool-done" id="del" type="checkbox" '. $temp_deleted . '/><label class="form-check-label" for="del">Kustutatud</label></div>';
}
?>
<br/><input class="btn btn-success mx-2" type="submit" value="Lisa üksus"/><a class="btn btn-primary mx-2" href="..">Tagasi</a>
</form>
<script>
	function InsertRecord() {
		document.getElementById("form1").submit();
	}
</script>
<?php include("../foot.php"); ?>
