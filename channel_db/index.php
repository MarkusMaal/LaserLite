<?php
$l = "en-US" ;
if (! empty($_COOKIE))
{
if (! empty($_COOKIE["lang"] )) 
{
   $l = $_COOKIE["lang"] ;
}
} 
$query = "";
$channel = "";
if(session_status()!=PHP_SESSION_ACTIVE) session_start();?>
<?php include("head.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php"); ?>
<h1><?php if ($l == "et-EE") { 
echo 'Kanalite andmebaas';
} else {
echo 'Channel database';
}?></h1>
<?php 
if (!empty($_GET["id"])) {
	include("record.php");
	die();
}
$search = "";
if (!empty($_GET["q"])) {
	$search = $_GET["q"];
}
if ($search != "") {
	echo '<p>';
	if ($l == "et-EE") {
		echo 'Võtmesõna(d)';
	} else {
		echo 'Keyword(s)';
	}
	echo ': "' . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . '"</p>';
	if ($channel != "all") {
		$query = $query . " AND ";
	}
} else {
	echo '<p>';
	if ($l == "et-EE") {
		echo 'Võtmesõna';
	} else {
		echo 'Keyword';
	}
	echo ':</p><input id="textBox1" type="text"></input><br/><br/>';
}
?>
<?php
if (empty($_GET["q"])) {
	echo '<a title="';
	if ($l == "et-EE") {
		echo 'Otsing';
	} else {
		echo 'Search';
	}
	echo '" class="funsymbols" href="#" onclick="SearchKey();">&#128269;</a>';
}
?>
<?php
if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
echo '<a title="';
if ($l == "et-EE") { echo 'Lisa kirje'; } else { echo 'Add record'; }
echo '" class="funsymbols" href="add">&#10133;</a>';
echo '<a title="';
if ($l == "et-EE") { echo 'Kustuta kirje'; } else { echo 'Delete record'; }
echo 'Kustuta kirje" class="funsymbols" href="delete">&#10134;</a>';
echo '<a title="';
if ($l == "et-EE") { echo 'Uuenda kirje'; } else { echo 'Update record'; }
echo '" class="funsymbols" href="replace">&#10024;</a>';
}

?>
<?php
	if (($_SERVER["REQUEST_URI"] != "/channel_db/index.php") && ($_SERVER["REQUEST_URI"] != "/channel_db/")) {
		echo '<a title="';
		if ($l == "et-EE") { echo 'Kuva raport'; } else { echo 'Show report'; }
		echo '" class="funsymbols" href="report' . str_replace("channel_db/", "", $_SERVER["REQUEST_URI"]) . '&nopages=1">&#128215;</a>';
		echo '<a title="';
		if ($l == "et-EE") { echo 'Salvesta raport'; } else { echo 'Save report'; }
		echo '" class="funsymbols" href="save_head.php' . str_replace("index.php", "", $_SERVER["REQUEST_URI"]) . '&nopages=1">&#128190;</a>';
	}
?>
<?php
if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
echo '<br/><br/><a href="login/logout.php">';
if ($l == "et-EE" ) { echo 'Logi välja'; } else { echo 'Log out'; }
echo '</a>';
} else {
echo '<br/><br/><a href="../markustegelane/common/config/login.php?redir=channel_db">';
if ($l == "et-EE") { echo 'Logi sisse'; } else { echo 'Log in'; }
echo '</a>';
}
?>
<br/><br/>
<a href="../markustegelane"><?php if ($l == "et-EE") { echo 'Tagasi avalehele'; } else { echo 'Go back'; } ?><br/><br/></a>
<a href="ideas"><?php if ($l == "et-EE") { echo 'Ideekast (beeta)'; } else { echo 'Idea box (beta)'; } ?><br/></a>
<a href="gallery"><?php if ($l == "et-EE") { echo 'Kanalite galerii (beeta)'; } else { echo 'Channel gallery (beta)'; } ?><br/></a>
<div class="backdrop" id="back">
<script>
function SearchKey() {
	var me = String(parent.location);
	var rep = me.replace("?", "nein");
	var amp = String(parent.location).replace("\"", "g");
	if (amp != me) {
		alert("<?php 
		if ($l == "et-EE")
		{
			echo 'See päring pole sobiv';
		} else {
			echo 'This query is invalid';
		} ?>");
		return;
	}
	var fin;
	if (rep != me) {
		fin = me + "&q=" + document.getElementById("textBox1").value;
	} else {
		fin = me + "?q=" + document.getElementById("textBox1").value;
	}
	parent.location = fin.replace("#", "");
}

function hideshowmenu() {
	var x = document.getElementById("filtermenu");
	var y = document.getElementById("back");
	if (x.style.visibility === "hidden") {
	x.style.visibility = "visible";
	y.style.visibility = "visible";
	} else {
	x.style.visibility = "hidden";
	y.style.visibility = "hidden";
	}
}

var input = document.getElementById("textBox1");
<?php
if (empty($_GET["q"])) {
	echo 'input.addEventListener("keyup", function(event) {	if (event.keyCode === 13) {	event.preventDefault();	SearchKey();}});';
}
?>
</script>
</div>
<?php include("content.php"); ?>
<?php include("foot.php"); ?>
