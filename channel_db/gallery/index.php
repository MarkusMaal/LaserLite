<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
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
$search = "";
include("head.php");
if (!empty($_GET["q"])) {
	$search = $_GET["q"];
}
if (!empty($_GET["id"])) {
include("record.php");
die();
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
if (empty($_GET["q"])) {
	echo '<a title="';
	if ($l == "et-EE") {
		echo 'Otsing';
	} else {
		echo 'Search';
	}
	echo '" class="funsymbols" href="#" onclick="SearchKey();">&#128269;</a>';
}
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
	if (($_SERVER["REQUEST_URI"] != "/channel_db/gallery/index.php") && ($_SERVER["REQUEST_URI"] != "/channel_db/gallery/")) {
		echo '<a title="';
		if ($l == "et-EE") { echo 'Kuva raport'; } else { echo 'Show report'; }
		echo '" class="funsymbols" href="report' . str_replace("/channel_db/gallery/", "/", $_SERVER["REQUEST_URI"]) . '&nopages=1">&#128215;</a>';
		echo '<a title="';
		if ($l == "et-EE") { echo 'Salvesta raport'; } else { echo 'Save report'; }
		echo '" class="funsymbols" href="save_head.php' . str_replace("channel_db/gallery/index.php", "", $_SERVER["REQUEST_URI"]) . '&nopages=1">&#128190;</a>';
	}
?>
<br/><br/>
<a href=".."><?php if ($l == "et-EE") { echo 'Tagasi andmebaasi avalehele'; } else { echo 'Go back'; } ?><br/><br/></a>
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
<?php include("../foot.php"); ?>
