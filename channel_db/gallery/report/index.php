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
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include("../head.php");
if (!empty($_GET["q"])) {
	$search = $_GET["q"];
}
if (!empty($_GET["id"])) {
include("record.php");
die();
}
?>
<div>
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
<?php include("../../connect.php"); ?>
<?php include("../content.php"); ?>
<?php include("../../foot.php"); ?>
