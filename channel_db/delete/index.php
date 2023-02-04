<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<div class="container">
<h1 class="mt-5">Kustuta kirje</h1>
<div class="btn-group my-3" role="group" aria-label="Sisu tüüp">
	<?php
		if (empty($_GET["temp_id"])) {
			echo '<a hreF="index.php?dummy=1';
			foreach ($_GET as $key => $value) {
				if (($key != "ideas") && ($key != "dummy") && ($key != "gallery")) {
					echo "&${key}=${value}";
				}
			}
			echo '" type="button" class="btn btn-primary';
			if(empty($_GET["ideas"]) && empty($_GET["gallery"])) { echo ' active'; } 
			echo '">Video</a>';
			echo '<a hreF="index.php?gallery=1';
			foreach ($_GET as $key => $value) {
				if (($key != "ideas") && ($key != "dummy") && ($key != "gallery")) {
					echo "&${key}=${value}";
				}
			}
			echo '" type="button" class="btn btn-primary';
			if(!empty($_GET["gallery"])) { echo ' active'; }
			echo '">Kanal</a>';
			echo '<a hreF="index.php?ideas=1';
			foreach ($_GET as $key => $value) {
				if (($key != "ideas") && ($key != "dummy") && ($key != "gallery")) {
					echo "&${key}=${value}";
				}
			}
			echo '" type="button" class="btn btn-primary';
			if(!empty($_GET["ideas"])) { echo ' active'; } 
			echo '">Idee</a>';
		}
	?>
</div>
<?php
	if (!empty($_GET["ideas"])) {
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/ideas/delete/index.php");
		die();
	}
	else if (!empty($_GET["gallery"])) {
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/gallery/delete/index.php");
		die();
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
	include("../connect.php");
	if (!empty($_POST["record-id"])) {
		echo "<br/>POST andmed kätte saadud!<br/>";
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasiga ühendumine nurjus.
			Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span><br/><a class="btn btn-primary mx-2" href="index.php">Tagasi andmebaasi</a>');
		}
		// sql päring
		$sql = 'DELETE FROM channel_db WHERE ID=' . $_POST["record-id"];
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
?>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<?php
if (empty($_GET["id"])) {
	echo '<div class="form-floating"><select class="form-select" name="record-id" id="record-id" style="text-align: left;">';
	$query = "SELECT * FROM channel_db";
	$result = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_array($result)) {
		echo '<option value="' . $row["ID"] . '">' . $row["ID"] . ' &lt;-&gt; ' . $row["Video"] . '</option>';
	}
	echo '</select><label for="record-id">Kirje ID</label></div>';
} else {
	if (!empty($_GET["failsafeuserconfirmdelete"]) && ($_GET["failsafeuserconfirmdelete"] == "1")) {
		echo '<input name="record-id" style="width: 25%;" type="text" value="' . $_GET["id"] . '"/>';
	} else {
		echo '<p>' . $_GET["id"] . '</p>';
		echo '<p>Palun lisage veebiaadressile "&failsafeuserconfirmdelete=1", et kustutamine kinnitada</p>';
		die();
	}
}
?>
<br/><a class="btn btn-danger" href="#/" onclick="Delete();">Kustuta üksus</a><a class="btn mx-2 btn-primary" href="..">Tagasi</a>
</form>
</div>
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
