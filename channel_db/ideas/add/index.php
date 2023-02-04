<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
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
<form method="post" action="" name="form" id="form1" enctype="multipart/mixed">
<div class="form-floating">
<select class="form-select my-4" style="width: 97%;" type="text" name="channel_name" placeholder="Kanali nimi" id="channel">
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
</select>
<label for="channel">Kanali nimi</label></div>
<div class="form-floating">
<?php
if (!empty($_GET["temp_id"])) {
echo '<input class="form-control my-2" name="class" id="class" type="text" value="' . $temp_class . '"/>';
} else {
echo '<input class="form-control my-2" name="class" id="class" type="text"/>';
}
?><label for="class">Klass</label></div>
<div class="form-floating">
<?php
if (!empty($_GET["temp_id"])) {
echo '<input class="form-control my-2" name="title" id="title" type="text" value="' . $temp_video . '"/>';
} else {
echo '<input class="form-control my-2" name="title" id="title" type="text"/>';
}
?>
<label for="title">Video pealkiri</label>
</div>
<div class="form-floating">
<?php
if (empty($_GET["temp_id"])) {
	echo '<textarea class="form-control my-2" name="description" id="desc" rows="5" cols="100"></textarea>';
} else {
	echo '<textarea class="form-control my-2" name="description" id="desc" rows="5" cols="100">' . $temp_description . '</textarea>';
}
?>
<label for="desc">Video kirjeldus</label>
</div>

<?php
if (empty($_GET["temp_id"])) {
	echo '<div class="form-check"><input class="form-check-input" name="bool-done" id="del" type="checkbox"/><label class="form-check-label" for="bool-done">Valmis</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-livestr" id="live" type="checkbox"/><label class="form-check-label" for="bool-livestr">Otseülekanne</label></div><br/>';
} else {
	echo '<div class="form-check"><input class="form-check-input" name="bool-done" id="del" type="checkbox" '. $temp_done . '/><label class="form-check-label" for="bool-done">Valmis</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-livestr" id="live" type="checkbox" '. $temp_stream . '/><label class="form-check-label" for="bool-livestr">Otseülekanne</label></div><br/>';
}
?>
<br/><input type="submit" class="btn btn-success mx-2" value="Lisa üksus"/><a class="btn btn-primary mx-2" href="..">Tagasi</a>
</form>
<script>
	function InsertRecord() {
		document.getElementById("form1").submit();
	}
</script>
<?php include("../foot.php"); ?>
