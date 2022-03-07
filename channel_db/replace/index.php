<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<h1>Muuda kirjet</h1>
<?php
	if (!empty($_POST["record-id"])) {
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasiga ühendumine nurjus.
			Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span><br/><a href="index.php">Tagasi andmebaasi</a>');
		}
		// sql päring
		$sql = 'UPDATE channel_db SET ' . $_POST["col"] . ' = ' . $_POST["new"] . ' WHERE ID=' . $_POST["record-id"];
		if ($connection->query($sql) === TRUE) {
			$_POST = array();
			echo '<span style="color: #00ff00; ">Õnnestus! Kirjet muudeti</span><br/>';
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
		}
		$connection->close();
		echo '<br/><a href="index.php">Muuda veel</a><a href="..">Tagasi andmebaasi</a>';
		die();
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<table>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<td>Kirje ID: </td>
<td><input name="record-id" style="width: 5%;" type="text" value="<?php
if (!empty($_GET["id"])) {
	echo $_GET["id"];
}
?>"/></td>
<tr>
<td>Veerg mida muuta: </td>
<td>
<select name="col"/>
<?php
	include("../connect.php");
	$query = "SELECT * FROM channel_db";
	$result = mysqli_query($connection, $query);
	$mod = "void";
	if (!empty($_GET["mod"])) {
		$mod = $_GET["mod"];
	}
	while ($property = mysqli_fetch_field($result)) {
		if ($property->name != "ID") {
			$def = "";
			if ($mod == $property->name) {
				$def = "selected";
			}
			echo '<option value="' . $property->name . '" '. $def . '>' . $property->name . '</option>';
		}
	}
?>
</select>
</td>
</tr>
<tr>
<td>Uus väärtus: <br/>0 = Ei, 1 = Jah<br/>Kuupäev:<br/>AAAA-KK-PP</td>
<td><textarea id="text1" name="new" rows="5" cols="100"><?php
if ((!empty($_GET["mod"])) && (!empty($_GET["id"]))) {
	include("../connect.php");
	$query = "SELECT " . $_GET["mod"] . " FROM channel_db WHERE ID = " . $_GET["id"];
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result);
	echo $row[0];
}
?></textarea></td>
</tr>
</table>
<br/><a href="#/" onclick="ReplaceRecord();">Asenda üksus</a><a href="..">Tagasi</a>
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
