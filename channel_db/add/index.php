<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("../head.php"); ?>
<div class="container my-5">
<h1>Lisa kirje</h1>
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
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/ideas/add/index.php");
		die();
	}
	else if (!empty($_GET["gallery"])) {
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/gallery/add/index.php");
		die();
	}
	if (!empty($_POST["channel_name"])) {
		echo $_POST["channel_name"];
		echo "<br/>POST andmed kätte saadud!<br/>";
		include("../connect.php");
		if ($connection->connect_error) {
			die('<span style="color: #ff0000">Andmebaasige ühendumine nurjus.
			Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span>');
		}
		$del = "0";
		if ($_POST["bool-delete"] == "on") {
			$del = "1";
		}
		$sub = "0";
		if ($_POST["bool-subtitle"] == "on") {
			$sub = "1";
		}
		$pub = "0";
		if ($_POST["bool-public"] == "on") {
			$pub = "1";
		}
		$live = "0";
		if ($_POST["bool-livestr"] == "on") {
			$live = "1";
		}
		$hd = "0";
		if ($_POST["bool-highdef"] == "on") {
			$hd = "1";
		}
		
		$result = mysqli_query($connection, "SELECT DISTINCT Category FROM channel_db WHERE CategoryMUI_en = \"" . $_POST["cat"] . "\"");
		$et_cat = mysqli_fetch_array($result)[0];
		// sql päring
		$sql = 'INSERT INTO channel_db (Kanal, Video, Kustutatud, Kuupäev, Kirjeldus, Subtiitrid, Avalik, Ülekanne, HD, URL, OdyseeURL, TitleMUI_en, TitleMUI_et, KirjeldusMUI_en, KirjeldusMUI_et, Filename, Category, CategoryMUI_en, Tags)' . 
			   'VALUES ("' . $_POST["channel_name"] . '", "' . $_POST["title"] . '", ' . $del . 
			  ' , ("' . $_POST["date"] . '"), "' .
			   $_POST["description"] . '", ' . $sub . ', ' . $pub . ', ' .
			   $live . ', ' . $hd . ', "' . $_POST["uri"] . '", "' . $_POST["uriodysee"] . '", "' .
			   $_POST["title-en"] . '", ".", "' . $_POST["desc-en"] . '", ".", "' . $_POST["filename"] . '", "' .
			   $et_cat . '", "' . $_POST["cat"] . '", "' . $_POST["tags"] . '")';
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
		include("../connect.php");
		$query = "SELECT * FROM channel_db WHERE ID = " . $_GET["temp_id"];
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		$temp_channel = $row[1];
		$temp_video = $row[2];
		$temp_delete = str_replace("1", "checked", str_replace("0", "", $row[3]));
		$temp_date = explode("-", $row[4]);
		$temp_description = $row[5];
		$temp_subtitles = str_replace("1", "checked", str_replace("0", "", $row[6]));
		$temp_public = str_replace("1", "checked", str_replace("0", "", $row[7]));
		$temp_stream = str_replace("1", "checked", str_replace("0", "", $row[8]));
		$temp_hd = str_replace("1", "checked", str_replace("0", "", $row[9]));
		$temp_entitle = $row["TitleMUI_en"];
		$temp_endesc = $row["KirjeldusMUI_en"];
		$temp_filename = $row["Filename"];
		$temp_cat = $row["Category"];
		$temp_odysee = $row["OdyseeURL"];
		$temp_tags = $row["Tags"];
	}
	if (!((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))) {
		die("Peate sisse logima.");
	}
?>
<form method="post" action="index.php" name="form" id="form1" enctype="multipart/mixed">
<?php
	include("../connect.php");
	if (empty($_GET["newchannel"])) {
		echo '<div class="form-floating my-3"><select class="form-select" name="channel_name" id="channel">';
		$channels = mysqli_query($connection, "SELECT DISTINCT Kanal, KanalMUI_en, KanalMUI_et FROM channel_db");
		while ($row = mysqli_fetch_array($channels)) {
				$sec = $row[1];
				if ($sec == ".") {
					$sec = $row[2];
					if ($sec == ".") {
						$sec = $row[0];
					}
				}
				if ((!empty($_GET["temp_id"])) && ($row[0] == $temp_channel)) {
					echo '<option value="' . $row[0] . '" selected>' . $row[0] . ' &lt;-&gt; ' . $sec . '</option>';
				} else {
					echo '<option value="' . $row[0] . '">' . $row[0] . ' &lt;-&gt; ' . $sec . '</option>';
				}
		}
		echo '</select><label for="channel">Kanali nimi</label></div><a href="?';
		$args = "";
		if (str_contains($_SERVER["REQUEST_URI"], "?")) {
			$args = explode("?", $_SERVER["REQUEST_URI"])[1];
		}
		if ($args == "") {
			echo 'newchannel=1';
		} else {
			echo $args . '&newchannel=1';
		}
		echo '">Uus kanal</a>';
	} else {
		echo '<input class="form-control my-4" style="width: 97%;" type="text" name="channel_name" placeholder="Kanali nimi" id="channel"></input>';
	}
?>
<?php
if (!empty($_GET["temp_id"])) {
echo '<input class="form-control my-4" placeholder="Video pealkiri (eesti keeles)" name="title" id="title" style="width: 97%;" type="text" value="' . $temp_video . '"/>';
} else {
echo '<input class="form-control my-4" placeholder="Video pealkiri (eesti keeles)" name="title" id="title" style="width: 97%;" type="text"/>';
}
?>
<?php
if (empty($_GET["temp_id"])) {
echo '<input class="form-control my-4" placeholder="Avaldamiskuupäev" name="date" type="date" id="date" value="' . date("Y") . '-' . date("m") . '-' . date("d") . '"></input>';
} else {
echo '<input class="form-control my-4" placeholder="Avaldamiskuupäev" name="date" type="date" id="date" value="' . $temp_date[0] . '-' . $temp_date[1] . '-' . $temp_date[2] . '"></input>';
}
?>
<?php
if (empty($_GET["temp_id"])) {
	echo '<td><textarea class="form-control my-4" placeholder="Kirjeldus (eesti keeles)" name="description" id="desc" rows="5" cols="100"></textarea></td>';
} else {
	echo '<td><textarea class="form-control my-4" placeholder="Kirjeldus (eesti keeles)" name="description" id="desc" rows="5" cols="100">' . $temp_description . '</textarea></td>';
}
?>
<input class="form-control my-4" placeholder="URL (YouTube)" style="width: 35%;" type="text" name="uri" id="urid"></input>
<input class="form-control my-4" placeholder="URL (Odysee)" style="width: 35%;" type="text" name="uriodysee" id="urodyseeid"></input>
<input class="form-control my-4" placeholder="Pealkiri (inglise keeles)" style="width: 97%;" type="text" name="title-en" id="titlenid" value="<?php
if (!empty($_GET["temp_id"])) {
	echo $temp_entitle;
}
?>"></input>
<textarea class="form-control my-4" placeholder="Kirjeldus (inglise keeles)" name="desc-en" id="descenid" rows="5" cols="100"><?php
if (!empty($_GET["temp_id"])) {
	echo $temp_endesc;
}
?></textarea>
	<?php 
		if (!empty($_GET["newcategory"])) {
			echo '<input class="form-control my-4" placeholder="Kategooria" style="width: 35%;" type="text" name="cat" id="catid"></input>';
		} else {
			echo '<div class="form-floating"><select class="form-select" style="width: 35%;" name="cat" id="catid">';
			$result = mysqli_query($connection, "SELECT DISTINCT Category, CategoryMUI_en FROM channel_db;");
			while ($row = mysqli_fetch_array($result)) {
				if (empty($_GET["temp_id"]) || ($row["Category"] != $temp_cat)) {
					echo '<option value="' . $row["CategoryMUI_en"] . '">' . $row["Category"] . '</option>';
				} else {
					echo '<option value="' . $row["CategoryMUI_en"] . '" selected=selected>' . $row["Category"] . '</option>';
				}
			}
			echo '</select><label for="catid">Kategooria</label></div></select><a class="mx-auto float-right" href="?';
			$args = "";
			if (str_contains($_SERVER["REQUEST_URI"], "?")) {
				$args = explode("?", $_SERVER["REQUEST_URI"])[1];
			}
			if ($args == "") {
				echo 'newcategory=1';
			} else {
				echo $args . '&newcategory=1';
			}
			echo '">Uus kategooria</a>';
		}?>
<textarea class="form-control my-4" placeholder="Sildid" name="tags" id="tagsid" rows="5" cols="100"><?php
if (!empty($_GET["temp_id"])) {
	echo $temp_tags;
}
?></textarea>
<input class="form-control my-4" placeholder="Failinimi" style="width: 97%; text-align: left;" type="text" name="filename" id="filenameid" value="<?php
if (!empty($_GET["temp_id"])) {
	echo $temp_filename;
}
?>"></input>
<?php
if (empty($_GET["temp_id"])) {
	echo '<div class="form-check"><input class="form-check-input" name="bool-delete" id="del" type="checkbox"/><label class="form-check-label" for="del">Kustutatud</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-public" id="pub" type="checkbox" checked/><label class="form-check-label" for="pub">Avalik</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-subtitle" id="sub" type="checkbox"/><label class="form-check-label" for="sub">Subtiitrid</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-livestr" id="live" type="checkbox"/><label class="form-check-label" for="live">Otseülekanne</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-highdef" id="hd" type="checkbox" checked/><label class="form-check-label" for="hd">Kõrge kvaliteet</label></div>';
} else {
	echo '<div class="form-check"><input class="form-check-input" name="bool-delete" id="del" type="checkbox" '. $temp_delete . '/><label class="form-check-label" for="del">Kustutatud</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-public" id="pub" type="checkbox" '. $temp_public . '/><label class="form-check-label" for="pub">Avalik</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-subtitle" id="sub" type="checkbox" '. $temp_subtitles . '/><label class="form-check-label" for="sub">Subtiitrid</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-livestr" id="live" type="checkbox" '. $temp_stream . '/><label class="form-check-label" for="live">Otseülekanne</label></div>';
	echo '<div class="form-check"><input class="form-check-input" name="bool-highdef" id="hd" type="checkbox" '. $temp_hd . '/><label class="form-check-label" for="hd">Kõrge kvaliteet</label></div>';
}
?>
<br/><?php 
if (!empty($_COOKIE["legacy"]) && ($_COOKIE["legacy"] == "true")) {
	echo '<input class="btn btn-success" type="submit" value="Lisa üksus"/>';
} else {
	echo '<a class="btn btn-success" href="#/" onclick="InsertRecord()">Lisa üksus</a>';
}
?><a class="btn btn-primary mx-2" href="..">Tagasi</a>
</form>
</div>
<?php if (empty($_COOKIE["legacy"]) || ($_COOKIE["legacy"] != "true")) {
echo '<script>
	function InsertRecord() {
		document.getElementById("form1").submit();
	}
</script>';
}
include("../foot.php"); ?>