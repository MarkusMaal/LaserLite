<?php include("../head.php");
?>
<h1>Lisa kirje</h1>
<?php
	if (!empty($_SESSION) && ($_SESSION["level"] == "owner")) {
		include("../connect.php");
	} else {
		die('<br/><span style="color: #ff0000">Selleks, et kasutada haldamistööriistu peate sisse logima omaniku kontoga.<br/></span>
		<a href="/markustegelane/common/config/login.php?redir=mas_db">Logi sisse</a>');
	}
	if (!empty($_POST["title"])) {
		echo $_POST["title"];
		echo "<br/>POST andmed kätte saadud!<br/>";
		// autentimisandmed
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasige ühendumine nurjus.
			Olge kindlad, et andmebaas toimib ning, et teie kinnitusparool oli õige</span>');
		}
		$mini = "0";
		if ($_POST["bool-mini"] == "on") {
			$mini = "1";
		}
		$query = "SELECT ID FROM mas_db";
		$result = mysqli_query($connection, $query);
		$new_id = 0;
		while ($row = mysqli_fetch_array($result)) {
			$new_id = $row[0];
		}
		$new_id++;
		$sql1 = 'ALTER TABLE mas_db AUTO_INCREMENT = ' . $new_id ;
		if ($connection->query($sql1) === FALSE) {
			echo $connection->error;	
		}
		$sql = 'INSERT INTO mas_db (VERSIOON, LVERSIOON, NIMI, KIRJELDUS, AASTA, MINI)' . 
			   'VALUES ("' . $_POST["fver"] . '", "' . $_POST["lver"] . '", "' . $_POST["title"] . 
			  '", "' . $_POST["description"] . '", ' . $_POST["year"] . ', ' . $mini. ')';
		// "
		if ($connection->query($sql) === TRUE) {
			$_POST = array();
			echo '<span style="color: #00ff00; ">Õnnestus! Kirje lisati andmebaasi</span><br/>';
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
		}
		$connection->close();
		echo '<br/><a href="..">Tagasi</a>';
		die();
	}
?>
<table>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<td>Versiooni nimi</td>
<td><input name="title" id="title" style="width: 97%;" type="text"/></td>
<tr>
<td>Versioonid</td>
<td><input name="fver" style="width: 5%;" type="text" value="99.99"/>-<input name="lver" style="width: 5%;" type="text" value="99.99"/>
</tr>
<tr>
<td>Kirjeldus</td>
<td><textarea name="description" id="desc" rows="5" cols="100"></textarea></td>
</tr>
<tr>
<td>Aasta</td>
<td><input name="year" type="text" style="width: 5%;" value="<?php echo date('Y'); ?>"></input></td>
</tr>
</table>
<input name="bool-mini" id="del" type="checkbox"/>Miniversioon<br/>
<br/><a href="#/" onclick="InsertRecord();">Lisa üksus</a><a href="..">Tagasi</a>
</form>
<script>
	function InsertRecord() {
		document.getElementById("form1").submit();
	}
</script>
<?php include("../foot.php"); ?>
