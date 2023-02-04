<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	if (!empty($_POST["record-id"])) {
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasiga ühendumine nurjus.
			Olge kindlad, et andmebaas toimib ja et olete sisse logitud</span><br/><a class="btn btn-primary" href="index.php">Tagasi andmebaasi</a>');
		}
		// sql päring
		$sql = 'DELETE FROM channel_gallery WHERE ID=' . $_POST["record-id"];
		if ($connection->query($sql) === TRUE) {
			$_POST = array();
			echo '<span style="color: #00ff00; ">Õnnestus! Kirje kustutati tabelist</span><br/>';
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
		}
		$connection->close();
		echo '<br/><a class="btn btn-primary" href="..">Tagasi andmebaasi</a>';
		die();
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<form method="post" action="" name="form" id="form1" enctype="multipart/mixed">
<div class="form-floating">
<?php
if (empty($_GET["id"])) {
	echo '<select class="form-select" id="record-id" name="record-id" type="text">';
	$query = "SELECT * FROM channel_gallery";
	$result = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_array($result)) {
		echo '<option value="' . $row["ID"] . '">' . $row["ID"] . ' &lt;-&gt; ' . $row["Kanal"] . '</option>';
	}
	echo '</select>';
} else {
	if (!empty($_GET["failsafeuserconfirmdelete"]) && ($_GET["failsafeuserconfirmdelete"] == "1")) {
		echo '<select class="form-select" id="record-id" name="record-id" type="text" value="' . $_GET["id"] . '">';
		$query = "SELECT * FROM channel_gallery";
		$result = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_array($result)) {
			echo '<option value="' . $row["ID"] . '"';
			if ($row["ID"] == $_GET["id"]) {
				echo ' selected';
			}
			echo '>' . $row["ID"] . ' &lt;-&gt; ' . $row["Kanal"] . '</option>';
		}
		echo '</select>';
	} else {
		echo $_GET["id"];
		echo '<p>Palun lisage veebiaadressile "&failsafeuserconfirmdelete=1", et kustutamine kinnitada</p>';
		die();
	}
}
?>
<label for="record-id">Kirje ID</label>
</div>
<br/><a class="btn btn-danger" href="#/" onclick="Delete();">Kustuta üksus</a><a class="btn btn-primary mx-2" href="..">Tagasi</a>
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
