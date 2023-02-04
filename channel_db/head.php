<?php include($_SERVER["DOCUMENT_ROOT"] . "/connect.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php
$rformat = null;
$results = null;
$legacy = null;
$thumbnails = null;
$prefix = "?";
if (!empty($_GET)) {
	$prefix = "&";
}

if (!empty($_COOKIE["thumbnails"])) { $thumbnails = $_COOKIE["thumbnails"];} else { $thumbnails = "true"; }
if (!empty($_COOKIE["legacy"])) { $legacy = $_COOKIE["legacy"]; } else { $legacy = "false"; }
if (!empty($_COOKIE["results"])) { $results = $_COOKIE["results"]; } else { $results = "20"; }
if (!empty($_COOKIE["rformat"])) { $rformat = $_COOKIE["reportformat"]; } else { $rformat = "html"; }

if (!empty($_GET)) {
	if (!empty($_GET["legacy"])) {
		setcookie("legacy", $_GET["legacy"], time()+2678400, "/");
		$legacy = $_GET["legacy"];
	}
	else if (!empty($_GET["thumbnails"])) {
		setcookie("thumbnails", $_GET["thumbnails"], time()+2678400, "/");
		$thumbnails = $_GET["thumbnails"];
	}
	else if (!empty($_GET["results"])) {
		setcookie("results", $_GET["results"], time()+2678400, "/");
		$results = $_GET["results"];
	}
	else if (!empty($_GET["reportformat"])) {
		setcookie("reportformat", $_GET["reportformat"], time()+2678400, "/");
		$rformat = $_GET["reportformat"];
	}
}
function ms($en, $et) {
    if (!empty($_COOKIE["lang"])) {
 	if ($_COOKIE["lang"] == "et-EE") {
 		return $et;
 	} else {
 		return $en;
 	}
   } else {
        return $en;
   } 
}

function GetHeader($original) {
	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
		return $original;
	} else {
		if ($original == "Ülekanne") { return "Live stream"; }
		else if ($original == "Avalik") { return "Public"; }
		else if ($original == "Subtiitrid") { return "Subtitles"; }
		else if ($original == "Kustutatud") { return "Deleted"; }
		else { return $original; }
	}
}

function MUI_return($fallback, $et, $en) {
	if ($_COOKIE["lang"] == "et-EE") {
		if ($et != ".") {
			return $et;
		} else {
			return $fallback;
		}
	} else {
		if ($en != ".") {
			return $en;
		} else {
			return $fallback;
		}
	}
}

function y() {
	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
 		return "Jah";
 	} else {
 		return "Yes";
 	}
}
function n() {
	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
 		return "Ei";
 	} else {
 		return "No";
 	}
}

function CheckOwner($column, $en, $et, $id) {
	if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		return '<a class="btn btn-light btn-md float-end mx-2" href="replace?id=' . $id .'&mod=' . $column . '">' . ms($en, $et) . '</a>';
	} else {
		return "";
	}
}
$l = "en-US" ;
if (! empty($_COOKIE))
{
if (! empty($_COOKIE["lang"] )) 
{
   $l = $_COOKIE["lang"] ;
}
} ?>
<title><?php if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) { 
	echo 'Kanali andmebaas';
} else {
	echo 'Channel database';
} ?></title>
<link reL="stylesheet" href="/fw/bootstrap-5.2.3/css/bootstrap.min.css">
<style>
	a {
		text-decoration: none;
	}
	.modal-backdrop {
		z-index: 1019;
	}
	<?php
		if (!empty($_GET["nopages"])) {
			echo '.navbar {
				display: none;
			}';
		}
	?>
</style>
<?php if ($legacy == "false") { echo '<script src="https://kit.fontawesome.com/c483d265ae.js" crossorigin="anonymous"></script>'; } ?>
</head>
<body>
<div class="wrapper sticky-top">

<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
<div class="container-fluid">
<a href="/channel_db/index.php?ord=id&dir=DESC" class="navbar-brand"><?php if ($l == "et-EE") { 
echo 'Kanalite andmebaas';
} else {
echo 'Channel database';
}?></a>
<?php 
$search = "";
$q_ch = "";
$q_del = "";
$q_subs = "";
$q_pub = "";
$q_live = "";
$q_hd = "";
$q_category = "";
if (!empty($_GET["category"])) { $q_category = $_GET["category"]; }
if (!empty($_GET["channel"])) { $q_ch = $_GET["channel"]; }
if (!empty($_GET["deleted"])) { $q_del = $_GET["deleted"]; }
if (!empty($_GET["subtitles"])) { $q_subs = $_GET["subtitles"]; }
if (!empty($_GET["public"])) { $q_pub = $_GET["public"]; }
if (!empty($_GET["live"])) { $q_live = $_GET["live"]; }
if (!empty($_GET["hd"])) { $q_hd = $_GET["hd"]; }
if (!empty($_GET["q"])) {
	$search = $_GET["q"];
}
?>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItems" aria-controls="navbarItems" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
 </button>

<div class="collapse navbar-collapse" id="navbarItems">
    
<?php

if ($legacy == "true") {
	echo '<form method="get" action="" class="d-flex" role="search">';
	if ($q_del == "0") { $q_del = ""; }
	if ($q_subs == "0") { $q_subs = ""; }
	if ($q_pub == "0") { $q_pub = ""; }
	if ($q_live == "0") { $q_live = ""; }
	if ($q_hd == "0") { $q_hd = ""; }
	if ($q_category == "none") {
		$q_category = "";
	}
}
if ($search == "") {
	echo '<input class="form-control" id="textBox1" name="q" type="search"></input>';
} else {
	echo '<input class="form-control" id="textBox1" name="q" type="search" value="' . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . '"></input>';
}
?>
<ul class="navbar-nav me-auto mb-2 mb-lg-0 symbolbar">
<?php
if ($legacy != "true") {
echo '<li class="nav-item"><a title="';
if ($l == "et-EE") {
	echo 'Otsing';
} else {
	echo 'Search';
}
echo '" class="funsymbols nav-link" href="#" onclick="SearchKey();">&#128269;</a></li>';
}
if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
echo '<li class="nav-item"><a title="';
if ($l == "et-EE") { echo 'Lisa kirje'; } else { echo 'Add record'; }
echo '" class="funsymbols nav-link" href="/channel_db/add">&#10133;</a></li>';
echo '<li class="nav-item"><a title="';
if ($l == "et-EE") { echo 'Kustuta kirje'; } else { echo 'Delete record'; }
echo '" class="funsymbols nav-link" href="/channel_db/delete">&#10134;</a></li>';
echo '<li class="nav-item"><a title="';
if ($l == "et-EE") { echo 'Uuenda kirje'; } else { echo 'Update record'; }
echo '" class="funsymbols nav-link" href="/channel_db/replace">&#10024;</a></li>';
}
?>
<?php
	if (($_SERVER["REQUEST_URI"] != "/channel_db/index.php") && ($_SERVER["REQUEST_URI"] != "/channel_db/")) {
		echo '<li class="nav-item"><a title="';
		if ($l == "et-EE") { echo 'Kuva raport'; } else { echo 'Show report'; }
		echo '" class="funsymbols nav-link" href="/channel_db/report' . str_replace("channel_db/", "", $_SERVER["REQUEST_URI"]) . '&nopages=1">&#128215;</a></li>';
		echo '<li class="nav-item"><a title="';
		if ($l == "et-EE") { echo 'Salvesta raport'; } else { echo 'Save report'; }
		echo '" class="funsymbols nav-link" href="save_head.php' . str_replace("/channel_db/index.php", "", $_SERVER["REQUEST_URI"]) . '&nopages=1">&#128190;</a></li>';
	}
?>
</ul>
<div class="dropdown mx-1">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <?php echo ms("Sort", "Sorteeri"); ?>
  </a>

  <ul class="dropdown-menu">
	<?php
		$result = null;
		if (empty($_GET["gallery"]) && empty($_GET["ideas"])) { $result = mysqli_query($connection, "SHOW COLUMNS FROM channel_db"); }
		else if (!empty($_GET["gallery"])) { $result = mysqli_query($connection, "SHOW COLUMNS FROM channel_gallery"); }
		else if (!empty($_GET["ideas"])) { $result = mysqli_query($connection, "SHOW COLUMNS FROM channel_ideas"); }
		while ($row = mysqli_fetch_array($result)) {
			echo '<li><a class="dropdown-item" href="';
			if ($_SERVER["REQUEST_URI"] == str_replace("?", "", $_SERVER["REQUEST_URI"])) {
    			echo '?ord=' . $row[0];	
			} else {
				$order = "ID";
				if (!empty($_GET["ord"])) {
					$order = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["ord"]));
				}
    			echo str_replace('&ord=' . $order, '', $_SERVER["REQUEST_URI"]) . '&ord=' . $row[0];
    		}
			echo '">' . $row[0] . '</a></li>';
		}
	?>
  </ul>
</div>
<button type="button" class="btn btn-secondary mx-1" data-bs-toggle="modal" data-bs-target="#filterModal"><?php echo ms("Filters", "Filtrid"); ?></button>
<?php
if ($legacy == "true") {
	echo '<input class="btn btn-primary text-center" style="padding-left: 0px;" type="submit" value="Otsing" /></form>';
} ?>
<button type="button" class="btn btn-secondary mx-1" data-bs-toggle="modal" data-bs-target="#settingsModal"><?php if ($l == "et-EE") { echo 'Seaded'; } else { echo 'Settings'; } ?></button>
<a href="<?php echo str_replace("&gallery=1", "", str_replace("?gallery=1", "", $_SERVER["REQUEST_URI"] . $prefix)); ?>ideas=1"><button type="button" class="btn btn-warning mx-1"><?php if ($l == "et-EE") { echo 'Ideekast'; } else { echo 'Ideas'; } ?></button></a>
<a href="<?php echo str_replace("&ideas=1", "", str_replace("?ideas=1", "", $_SERVER["REQUEST_URI"] . $prefix)); ?>gallery=1"><button type="button" class="btn btn-info mx-1"><?php if ($l == "et-EE") { echo 'Kanalid'; } else { echo 'Channels'; } ?></button></a>
<a href="/channel_db_old"><button type="button" class="btn btn-primary mx-1"><?php if ($l == "et-EE") { echo 'Vana&nbsp;kujundus'; } else { echo 'Old&nbsp;design'; } ?></button></a>
<a href="../"><button type="button" class="btn btn-danger mx-1">X</button></a>
<?php
if (!empty($_GET["id"]) && empty($_GET["nopages"])) {
	include("record.php");
}
?>
<div class="modal fade" id="settingsModal" tabindex="-2" aria-labelledby="Settings modal dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="settingsModalLabel"><?php echo ms("Settings", "Seaded"); ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo ms("Close", "Sule"); ?>"></button>
			</div>
			<div class="modal-body">
				<div class="container my-5">
				<?php $prerefix = $_SERVER["REQUEST_URI"] . $prefix; ?>
					<p><?php echo ms("Legacy browser mode", "Pärandbrauseri režiim");?>: <?php
				if ($legacy == "false") {
					echo "<a class=\"btn btn-danger\" href=\"" . $prerefix . "legacy=true\">" . ms("Disabled", "Keelatud") . "</a>";
				} else
				{
					echo "<a class=\"btn btn-success\" href=\"" . $prerefix . "legacy=false\">" . ms("Enabled", "Lubatud") . "</a>";
				}
				?></p>
				<p><?php echo ms("The legacy browser mode helps you perform searches even if you are using an older browser at the cost of some functionality.", "Pärandbrauseri režiim võimaldab teil teostada päringuid vanemate brauseritega, miinuseks on vähendatud funktsionaalsus."); ?></p>
				<p><?php echo ms("Display thumbnails in search pages", "Kuva pisipildid otsingulehel");?>: <?php
				if ($thumbnails == "true") {
					echo "<a class=\"btn btn-success\" href=\"" . $prerefix . "thumbnails=false\">" . ms("Enabled", "Lubatud") . "</a>";
				} else
				{
					echo "<a class=\"btn btn-danger\" href=\"" . $prerefix . "thumbnails=true\">" . ms("Disabled", "Keelatud") . "</a>";
				}
				?></p>
				<p><?php echo ms("Disabling this option can improve load times on slower connections.", "Selle valiku väljalülitamine võimaldab lehte kiiremini laadida aeglasemate ühenduste korral."); ?></p>

				<p><?php
				echo ms("Results per page", "Tulemuste arv ühel lehel");?>
				<div class="btn-group" role="group" aria-label="<?php echo ms("Results per page", "Tulemuste arv lehel"); ?>">
				<?php
					for ($i = 5; $i <= 50; $i += 5) {
						echo '<a href="' . $prerefix . 'results=' . $i . '" class="btn btn-primary';
						if ($results == (string)$i) {
							echo ' active';
						}
						echo '">' . $i . '</a>';
					}
				?>
				</div></p>
				<p><?php echo ms("Reducing this number can reduce load times while increasing this number can provide more results at once.", "Selle numbri vähendamisel laetakse tulemused kiiremini, samas võimaldab suurem number näha rohkem tulemusi ühel lehel."); ?></p>

				<p><?php echo ms("Report format", "Raporti formaat ");
				echo '<div class="btn-group"><a class="btn btn-primary';
				if ($rformat == "html") {
					echo ' active';
				}
				echo '" href="' . $prerefix . 'reportformat=html">HTML</a>';
				echo '<a class="btn btn-primary';
				if ($rformat == "json") {
					echo ' active';
				}
				echo '" href="' . $prerefix . 'reportformat=json">JSON</a>';
				echo '<a class="btn btn-primary';
				if ($rformat == "csv") {
					echo ' active';
				}
				echo '" href="' . $prerefix . 'reportformat=csv">CSV</a></div>';

				?>
				<p><?php echo ms("This will determine how the report is going to be outputted. HTML displays a webpage, CSV creates a simple table, and JSON creates an array, which contains maximum amount of data, useful for programming.", "See valik määrab, kuidas raport väljastatakse. HTML kuvab veebilehe, CSV loob lihtsa tabeli ning JSON loob massiivi, mis sisaldab kõige rohkem andmeid, kasulik programmerimiseks."); ?></p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo ms("Close", "Sule"); ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="Filter modal dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="filterModalLabel"><?php echo ms("Filters", "Filtrid"); ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo ms("Close", "Sule"); ?>"></button>
			</div>
			<div class="modal-body">
				<?php
						if (empty($_GET["gallery"]) && empty($_GET["ideas"])) {
							$categories = mysqli_query($connection, "SELECT DISTINCT Category FROM channel_db ORDER BY (Category) ASC");
							if (empty($_COOKIE["lang"]) || $_COOKIE["lang"] != "et-EE") {
								$categories = mysqli_query($connection, "SELECT DISTINCT CategoryMUI_en FROM channel_db ORDER BY (CategoryMUI_en) ASC");
							}
							$channels = mysqli_query($connection, "SELECT DISTINCT Kanal FROM channel_db");
							echo '<div class="form-floating"><select class="form-select" name="channel" id="select_channel">';
							echo '<option value="">' . ms("(no filters)", "(filtrid puuduvad)") . '</option>';
							while ($row = mysqli_fetch_array($channels)) {
								if ($q_ch == str_replace('+', '%2B', $row[0])) {
									echo '<option selected value="' . str_replace('#', '%23', str_replace('+', '%2B', $row[0])) . '">' . $row[0] . '</option>';
								} else {
									echo '<option value="' . str_replace('#', '%23', str_replace('+', '%2B', $row[0])) . '">' . $row[0] . '</option>';
								}
							}
							echo '</select>';
							echo '<label for="select_channel">';
							echo ms("Channel", "Kanal");
							echo '</label></div>';
							echo '<div class="form-floating mt-3"><select class="form-select" name="category" id="select_category">';
							echo '<option value="">' . ms("(no filters)", "(filtrid puuduvad)") . '</option>';
							while ($row = mysqli_fetch_array($categories)) {
								if ($q_category == $row[0]) {
									echo '<option selected value="' . str_replace("'", "%27", str_replace('+', '%2B', $row[0])) . '">' . $row[0] . '</option>';
								} else {
									echo '<option value="' . str_replace("'", "%27", str_replace('+', '%2B', $row[0])) . '">' . $row[0] . '</option>';
								}
							}
							echo '</select>';
							echo '<label for="select_category">';
							echo ms("Category", "Kategooria");
							echo '</label></div><div class="form-floating mt-3">';
							echo '<select class="form-select" name="deleted" id="select_gone">';
							echo '<option value="0">' . ms("(all)", "(kõik)") . '</option>';
							echo '<option ';
							if ($q_del == "1") { echo 'selected '; }
							echo 'value="1">' . ms("Yes", "Jah") . '</option>';
							echo '<option ';
							if ($q_del == "2") { echo 'selected '; }
							echo 'value="2">' . ms("No", "Ei") . '</option></select>';
							echo '<label for="select_gone">';
							echo ms("Deleted", "Kustutatud");
							echo '</label></div><div class="form-floating mt-3">';
							echo '<select class="form-select" name="subtitles" id="select_subs">';
							echo '<option value="0">' . ms("(all)", "(kõik)") . '</option>';
							echo '<option ';
							if ($q_subs == "1") { echo 'selected '; }
							echo 'value="1">' . ms("Yes", "Jah") . '</option>';
							echo '<option ';
							if ($q_subs == "2") { echo 'selected '; }
							echo 'value="2">' . ms("No", "Ei") . '</option></select>';
							echo '<label for="select_gone">';
							echo ms("Subtitles", "Subtiitrid");
							echo '</label></div><div class="form-floating mt-3">';
							echo '<select class="form-select" name="public" id="select_public">';
							echo '<option value="0">' . ms("(all)", "(kõik)") . '</option>';
							echo '<option ';
							if ($q_pub == "1") { echo 'selected '; }
							echo 'value="1">' . ms("Yes", "Jah") . '</option>';
							echo '<option ';
							if ($q_pub == "2") { echo 'selected '; }
							echo 'value="2">' . ms("No", "Ei") . '</option></select>';
							echo '<label for="select_gone">';
							echo ms("Public", "Avalik");
							echo '</label></div><div class="form-floating mt-3">';
							echo '<select class="form-select" name="hd" id="select_hd">';
							echo '<option value="0">' . ms("(all)", "(kõik)") . '</option>';
							echo '<option ';
							if ($q_hd == "1") { echo 'selected '; }
							echo 'value="1">' . ms("Yes", "Jah") . '</option>';
							echo '<option ';
							if ($q_hd == "2") { echo 'selected '; }
							echo 'value="2">' . ms("No", "Ei") . '</option></select>';
							echo '<label for="select_gone">';
							echo ms("High definition", "Kõrge kvaliteet"); 
							echo '</label></div><div class="form-floating mt-3">';
							echo '<select class="form-select" name="live" id="select_live">';
							echo '<option value="0">' . ms("(all)", "(kõik)") . '</option>';
							echo '<option ';
							if ($q_live == "1") { echo 'selected '; }
							echo 'value="1">' . ms("Yes", "Jah") . '</option>';
							echo '<option ';
							if ($q_live == "2") { echo 'selected '; }
							echo 'value="2">' . ms("No", "Ei") . '</option></select>';
							echo '<label for="select_gone">';
							echo ms("Live stream", "Otseülekanne"); 
							echo '</label></div>';
						} else {
							$cols_query = "DESCRIBE channel_gallery";
							$blacklist = array("ID", "Kanal", "Kirjeldus", "Loomiskuupäev", "URL");
							if (!empty($_GET["ideas"])) { $cols_query = "DESCRIBE channel_ideas"; $blacklist = array("id", "Video", "Kirjeldus"); }
							$result = mysqli_query($connection, $cols_query);
							while ($row = mysqli_fetch_array($result)) {
								if (!in_array($row[0], $blacklist)) {
									echo '<div class="form-floating mt-3">';
									echo '<select class="form-select" name="_CUST_' . $row[0] . '" id="_CUST_' . $row[0] . '">';
									$subquery = "SELECT DISTINCT " . $row[0] . " FROM channel_";
									if (!empty($_GET["ideas"])) {
										$subquery = $subquery . "ideas";
									}
									else if (!empty($_GET["gallery"])) {
										$subquery = $subquery . "gallery";
									}
									echo '<option value="">' . ms("(no filters)", "(filtrid puuduvad)") . '</option>';
									$subresult = mysqli_query($connection, $subquery);
									while ($subrow = mysqli_fetch_array($subresult)) {
											echo '<option value="' . $subrow[0] . '"';
											if ((!empty($_GET["_CUST_" . $row[0]])) && ($_GET["_CUST_" . $row[0]] == $subrow[0])) {
												echo ' selected';
											}
											echo '>' . $subrow[0] . '</option>';
									}
									
									echo '</select>';
									echo '<label for="_CUST_' . $row[0] . '">';
									echo $row[0]; 
									echo '</label>';
									echo '</div>';
								}
							}
						}?>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo ms("Close", "Sule"); ?></button>
			</div>
		</div>
	</div>
</div>

</form>
</div>
</div>
</nav>
<script>
<?php if ($legacy == "true") { echo '<!--'; } ?>
let as = document.getElementsByClassName("funsymbols");
for (let i = 0; i < as.length; i++) {
	if ((as[i].title == "<?php echo ms('Search', 'Otsing'); ?>")) {
		as[i].innerHTML = '<i class="fa-solid fa-magnifying-glass"></i>';
	}
	else if ((as[i].title == "<?php echo ms('Add record', 'Lisa kirje'); ?>")) {
		as[i].innerHTML = '<i class="fa-solid fa-plus"></i>';
	}
	else if ((as[i].title == "<?php echo ms('Delete record', 'Kustuta kirje'); ?>")) {
		as[i].innerHTML = '<i class="fa-solid fa-minus"></i>';
	}
	else if ((as[i].title == "<?php echo ms('Update record', 'Uuenda kirje'); ?>")) {
		as[i].innerHTML = '<i class="fa-solid fa-pencil"></i>';
	}
	else if ((as[i].title == "<?php echo ms('Update record', 'Uuenda kirje'); ?>")) {
		as[i].innerHTML = '<i class="fa-solid fa-pencil"></i>';
	}
	else if ((as[i].title == "<?php echo ms('Show report', 'Kuva raport'); ?>")) {
		as[i].innerHTML = '<i class="fa-solid fa-book"></i>';
	}
	else if ((as[i].title == "<?php echo ms('Save report', 'Salvesta raport'); ?>")) {
		as[i].innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
	}
	
}
function SearchKey() {
	var me = "index.php";
	var rep = me.replace("?", "nein");
	var amp = String(parent.location).replace("\"", "g");
	var fin;
	fin = me + "?q=" + document.getElementById("textBox1").value;
	var a_channel = document.getElementById("select_channel");
	var a_gone = document.getElementById("select_gone");
	var a_subs = document.getElementById("select_subs");
	var a_pub = document.getElementById("select_public");
	var a_live = document.getElementById("select_live");
	var a_hd = document.getElementById("select_hd");
	var a_category = document.getElementById("select_category");
	let channel = "none"
	let klass = "0"
	let done = "0"
	let gone = "0"
	let subs = "0"
	let pub = "0"
	let live = "0"
	let hd = "0"
	let category = "none"
	let cust_suffix = ""
	if (a_channel !== null) {channel = a_channel.options[a_channel.selectedIndex].value;}
	if (a_category !== null) {category = a_category.options[a_category.selectedIndex].value;}
	if (a_gone !== null) {gone = a_gone.options[a_gone.selectedIndex].value;}
	if (a_subs !== null) {subs = a_subs.options[a_subs.selectedIndex].value;}
	if (a_pub !== null) {pub = a_pub.options[a_pub.selectedIndex].value;}
	if (a_live !== null) {live = a_live.options[a_live.selectedIndex].value;}
	if (a_hd !== null) {hd = a_hd.options[a_hd.selectedIndex].value;}
	if (document.querySelector("#_CUST_Kustutatud") !== null) {gone = document.querySelector("#_CUST_Kustutatud").value; cust_suffix += "&_CUST_Kustutatud=" + document.querySelector("#_CUST_Kustutatud").value;}
	if (document.querySelector("#_CUST_Klass") !== null) {klass = document.querySelector("#_CUST_Klass").value; cust_suffix += "&_CUST_Klass=" + document.querySelector("#_CUST_Klass").value; }
	if (document.querySelector("#_CUST_Valmis") !== null) {done = document.querySelector("#_CUST_Valmis").value; cust_suffix += "&_CUST_Valmis=" + document.querySelector("#_CUST_Valmis").value; }
	if (document.querySelector("#_CUST_Ülekanne") !== null) {live = document.querySelector("#_CUST_Ülekanne").value; cust_suffix += "&_CUST_Ülekanne=" + document.querySelector("#_CUST_Ülekanne").value; }
	if (document.querySelector("#_CUST_Kanal") !== null) {channel = document.querySelector("#_CUST_Kanal").value; cust_suffix += "&_CUST_Kanal=" + document.querySelector("#_CUST_Kanal").value; }
	if (channel != "none") {
		fin = fin + "&channel=" + channel;
	}
	if (category != "none") {
		fin = fin + "&category=" + category;
	}
	if (gone != "0") {
		fin = fin + "&deleted=" + gone;
	}
	if (subs != "0") {
		fin = fin + "&subtitles=" + subs;
	}
	if (pub != "0") {
		fin = fin + "&public=" + pub;
	}
	if (live != "0") {
		fin = fin + "&live=" + live;
	}
	if (hd != "0") {
		fin = fin + "&hd=" + hd;
	}
	if (klass != "0") {
		fin = fin + "&class=" + klass;
	}
	if (done != "0") {
		fin = fin + "&done=" + done;
	}
	<?php
		if (!empty($_GET["ord"])) {
			echo 'fin = fin + "&ord=' . $_GET["ord"] . '";';
		}
		if (!empty($_GET["dir"])) {
			echo 'fin = fin + "&dir=' . $_GET["dir"] . '";';
		}
		if (!empty($_GET["gallery"])) {
			echo 'fin = fin + "&gallery=1";';
		} else if (!empty($_GET["ideas"])) {
			echo 'fin = fin + "&ideas=1";';
		}
	?>
	fin += cust_suffix;
	parent.location = fin.replace("#", "");
}

function hideshowmenu() {
	return null
}

var input = document.getElementById("textBox1");
<?php
if (empty($_GET["q"])) {
	echo 'input.addEventListener("keyup", function(event) {	if (event.keyCode === 13) {	event.preventDefault();	SearchKey();}});';
}
if ($legacy == "true") { echo ' -->'; } ?>
</script>
</div>