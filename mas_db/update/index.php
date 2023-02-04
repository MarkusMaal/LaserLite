<?php include("../head.php");
?>
<h1>Muuda kirjet</h1>
<?php
	if (!empty($_SESSION) && ($_SESSION["level"] == "owner")) {
		include("../connect.php");
	} else {
		die('<br/><span style="color: #ff0000">Selleks, et kasutada haldamistööriistu peate sisse logima omaniku kontoga.<br/></span>
		<a href="/markustegelane/common/config/login.php?redir=mas_db">Logi sisse</a>');
	}
	if (!empty($_POST["record-id"])) {
		echo "<br/>POST andmed kätte saadud!<br/>";
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasiga ühendumine nurjus.
			Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span><br/><a href="index.php">Tagasi andmebaasi</a>');
		}
		// sql päring
		$sql = 'UPDATE mas_db SET ' . $_POST["col"] . ' = ' . $_POST["new"] . ' WHERE ID=' . $_POST["record-id"];
		if ($connection->query($sql) === TRUE) {
			$_POST = array();
			echo '<span style="color: #00ff00; ">Õnnestus! Kirjet muudeti</span><br/>';
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
		}
		$connection->close();
		echo '<br/><a href="..">Tagasi andmebaasi</a>';
		die();
	}
?>
<table>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<td>Kirje ID: </td>
<td>
<select name="record-id">
<?php
	$query = "SELECT * FROM mas_db";
	$result = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_array($result)) {
		echo '<option value="' . $row[0] . '">' . $row["ID"] . ' &lt;-&gt; ' . $row["NIMI"] . '</option>';
	}
?>
</select>
</td>
<tr>
<td>Veerg mida muuta: </td>
<td>
<select name="col"/>
<?php
	$query = "SELECT * FROM mas_db";
	$result = mysqli_query($connection, $query);
	while ($property = mysqli_fetch_field($result)) {
		if ($property->name != "ID") {
			echo '<option value="' . $property->name . '">' . str_replace("Lversioon", "Viimane versioon", ucfirst(strtolower($property->name))) . '</option>';
		}
	}
?>
</select>
</td>
</tr>
<tr>
<td>Uus väärtus: </td>
<td><textarea name="new" rows="5" cols="100"></textarea></td>
</tr>
</table>
<br/><a href="#/" onclick="ReplaceRecord();">Asenda üksus</a><a href="..">Tagasi</a>
</form>
<script>
	function ReplaceRecord() {
		document.getElementById("form1").submit();
	}
</script>
<?php include("../foot.php"); ?>
