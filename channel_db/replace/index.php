<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<div class="container my-5">
<h1>Muuda kirjet</h1>
<div class="btn-group" role="group" aria-label="Sisu tüüp">
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
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/ideas/replace/index.php");
		die();
	}
	else if (!empty($_GET["gallery"])) {
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/gallery/replace/index.php");
		die();
	}
	if (empty($_SESSION["usr"])) {
		die("Peate sisse logima. // You must log in.");
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Teil puudub õigus andmebaasi kirjeid muuta. // You are not allowed to modify database records.");
	}
	
	
	include("../connect.php");
	$mod = "void";
	$current = "";
	if (!empty($_GET["mod"])) {
		$mod = $_GET["mod"];
	}
	if (!empty($_GET["bool"])) {
		$query = "SELECT * FROM channel_db WHERE ID = " . $_GET["id"];
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		$current = $row[$mod];
		if ($_GET["bool"] == "1") {
			include("../connect.php");
			if ($connection->connect_error) {
				die('<span style="color: #ff0000">Andmebaasiga ühendumine nurjus.
				Olge kindlad, et andmebaas toimib ning, et teie kinnitusparool oli õige</span><br/><a class="btn btn-primary mx-2" href="index.php">Tagasi andmebaasi</a>');
			}
			$new = "0";
			if ($current == "0") {
				$new = "1";
			}
			$sql = 'UPDATE channel_db SET ' . $mod . ' = ' . $new . ' WHERE ID=' . $_GET["id"];
			echo '<p>' . $sql . '</p>';
			if ($connection->query($sql) === TRUE) {
				echo '<span style="color: #00ff00; ">Õnnestus! Kirje väärtus inverteeriti.</span><br/>';
				echo '<script>window.history.back()</script>';
			} else {
				echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
			}
			$connection->close();
			echo '<br/><a class="btn btn-primary mx-2" href="..">Tagasi andmebaasi</a>';
			die();
		}
	}
	if (!empty($_POST["record-id"])) {
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
		echo '<br/><a class="btn btn-primary mx-2" href="index.php">Muuda veel</a><a class="btn btn-primary mx-2" href="..">Tagasi andmebaasi</a>';
		die();
	}
?>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<?php
$filter_id = "-1";
if (!empty($_GET["id"])) {
	$filter_id = $_GET["id"];
}
echo '<div class="form-floating my-3"><select class="form-select" id="record-id" name="record-id" style="text-align: left; width: 100%;">';
$query = "SELECT * FROM channel_db";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
	if ($row["ID"] == $filter_id) {
		echo '<option selected value="' . $row["ID"] . '">' . $row["ID"] . ' &lt;-&gt; ' . $row["Video"] . '</option>';
	} else {
		echo '<option value="' . $row["ID"] . '">' . $row["ID"] . ' &lt;-&gt; ' . $row["Video"] . '</option>';
	}
}
echo '</select><label for="record-id">Kirje ID</label></div>';?>
</td>
<div class="form-floating my-3">
<select id="col" class="form-select" name="col" style="width: 100%; text-align: left;"/>
<?php
	$query = "SELECT * FROM channel_db";
	$result = mysqli_query($connection, $query);
	while ($property = mysqli_fetch_field($result)) {
		if ($property->name != "ID") {
			$def = "";
			if ($mod == $property->name) {
				$def = "selected";
			}
			$current = $property->name;
			if (empty($_GET["bool"])) { echo '<option value="' . $property->name . '" '. $def . '>' . $property->name . '</option>'; }
		}
	}
?>
</select>
<label for="col">Veerg, mida muuta</label>
</div>
<div class="form-floating">
<textarea class="form-control" id="text1" name="new"><?php
if ((!empty($_GET["mod"])) && (!empty($_GET["id"]))) {
	include("../connect.php");
	$query = "SELECT " . $_GET["mod"] . " FROM channel_db WHERE ID = " . $_GET["id"];
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result);
	echo $row[0];
}
?></textarea><label for="text1">Sisu, millega asendada</label></div>
<br/><a class="btn btn-warning" href="#/" onclick="ReplaceRecord();">Asenda üksus</a><a class="btn btn-primary mx-2" href="..">Tagasi</a>
</form>
</div>
<script>
	function ReplaceRecord() {
		var detector = document.getElementById("text1").value.replaceAll("\"", "&quot;");
		//var n = detector.includes("-");
		var n = false;
		if (n) {
			document.getElementById("text1").value = "(\"" + detector + "\")";
		} else {
			document.getElementById("text1").value = "\"" + detector + "\"";
		}
		document.getElementById("form1").submit();
	}
</script>
<?php include("../foot.php"); ?>
