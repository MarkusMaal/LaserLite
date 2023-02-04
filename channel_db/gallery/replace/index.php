<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	if (!empty($_POST["record-id"])) {
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasiga ühendumine nurjus.
			Olge kindlad, et andmebaas toimib ning, et teie kinnitusparool oli õige</span><br/><a class="btn btn-primary" href="index.php">Tagasi andmebaasi</a>');
		}
		// sql päring
		$sql = 'UPDATE channel_gallery SET ' . $_POST["col"] . ' = ' . $_POST["new"] . ' WHERE ID=' . $_POST["record-id"];
		if ($connection->query($sql) === TRUE) {
			$_POST = array();
			echo '<span style="color: #00ff00; ">Õnnestus! Kirjet muudeti</span><br/>';
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
		}
		$connection->close();
		echo '<br/><a class="btn btn-primary" href="index.php">Muuda veel</a><a class="btn btn-primary mx-2" href="..">Tagasi andmebaasi</a>';
		die();
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<form method="post" action="index.php?gallery=1" name="form" id="form1" enctype="multipart/mixed">
<div class="form-floating">
<select id="record-id" class="form-select my-3" name="record-id">
<?php
	include("../../connect.php");
	$query = "SELECT * FROM channel_gallery";
	$id = -1;
	if (!empty($_GET["id"])) {
		$id = $_GET["id"];
	}
	$result = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_array($result)) {
		echo '<option value="' . $row["ID"] . '"';
		if ($id == $row["ID"]) {
			echo ' selected';
		}
		echo '>' . $row["ID"] . ' &lt;&gt; ' . $row["Kanal"] . '</option>';
	}
?>
</select>
<label for="record-id">Kirje ID</label>
</div>
<div class="form-floating my-3">
<select class="form-select" id="col" name="col"/>
<?php
	$result = mysqli_query($connection, $query);
	$mod = "void";
	if (!empty($_GET["mod"])) {
		$mod = $_GET["mod"];
	}
	while ($property = mysqli_fetch_field($result)) {
		if ($property->name != "id") {
			$def = "";
			if ($mod == $property->name) {
				$def = "selected";
			}
			echo '<option value="' . $property->name . '" '. $def . '>' . $property->name . '</option>';
		}
	}
?>
</select>
<label for="col">Veerg, mida muuta</label>
</div>
<div class="form-floating my-3">
<textarea class="form-control" id="text1" name="new" rows="5" cols="100"><?php
if ((!empty($_GET["mod"])) && (!empty($_GET["id"]))) {
	include("../connect.php");
	$query = "SELECT " . $_GET["mod"] . " FROM channel_gallery WHERE ID = " . $_GET["id"];
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result);
	echo $row[0];
}
?></textarea>
<label for="text1">Uus väärtus</label>
</div>
<br/><a class="btn btn-warning" href="#/" onclick="ReplaceRecord();">Asenda üksus</a><a class="btn btn-primary mx-2" href="..">Tagasi</a>
</form>
<script>
	function ReplaceRecord() {
		var detector = document.getElementById("text1").value.replaceAll("\"", "&quot;");
		var n = detector.includes("-");
		if (n) {
			document.getElementById("text1").value = "(\"" + detector + "\")";
		} else {
			document.getElementById("text1").value = "\"" + detector + "\"";
		}
		document.getElementById("form1").submit();
	}
</script>
<?php include("../foot.php"); ?>
