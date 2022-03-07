<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<h1>Kustuta idee kirje</h1>
<?php
	if (!empty($_POST["record-id"])) {
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasiga ühendumine nurjus.
			Olge kindlad, et andmebaas toimib ja et olete sisse logitud</span><br/><a href="index.php">Tagasi andmebaasi</a>');
		}
		// sql päring
		$sql = 'DELETE FROM channel_ideas WHERE ID=' . $_POST["record-id"];
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
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<table>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<td>Kirje ID: </td>
<?php
if (empty($_GET["id"])) {
	echo '<td><input name="record-id" style="width: 25%;" type="text"/></td>';
} else {
	if (!empty($_GET["failsafeuserconfirmdelete"]) && ($_GET["failsafeuserconfirmdelete"] == "1")) {
		echo '<td><input name="record-id" style="width: 25%;" type="text" value="' . $_GET["id"] . '"/></td>';
	} else {
		echo '<td>' . $_GET["id"] . '</td>';
		echo '<p>Palun lisage veebiaadressile "&failsafeuserconfirmdelete=1", et kustutamine kinnitada</p>';
		die();
	}
}
?>
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
