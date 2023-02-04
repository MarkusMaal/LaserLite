<?php include("../head.php");
?>
<h1>Kustuta kirje</h1>
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
		$sql = 'DELETE FROM mas_db WHERE ID=' . $_POST["record-id"];
		if ($connection->query($sql) === TRUE) {
			$_POST = array();
			echo '<span style="color: #00ff00; ">Õnnestus! Kirje kustutati tabelist</span><br/>';
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
	include("../connect.php");
	$query = "SELECT * FROM mas_db";
	$result = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_array($result)) {
		echo '<option value="' . $row[0] . '">' . $row["ID"] . ' &lt;-&gt; ' . $row["NIMI"] . '</option>';
	}
?>
</select>
</td>
</table>
<br/><a href="#/" onclick="Delete();">Kustuta üksus</a><a href="..">Tagasi</a>
</form>
<script>
	function Delete() {
		if (confirm("Kas olete kindel, et soovite selle kirje kustutada?")) {	
			document.getElementById("form1").submit();
		} else {
			alert("Muudatusi ei tehtud");
			parent.location = "..";
		}
	}
</script>
<?php include("../foot.php"); ?>
