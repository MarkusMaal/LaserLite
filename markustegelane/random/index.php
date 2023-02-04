<?php
include("../common/connect.php");
$channel = "";
$onlypublic = "TRUE";
$deleted = "FALSE";
if (!empty($_GET["pub"])) {
$onlypublic = $_GET["pub"];
}
if (!empty($_GET["del"])) {
$deleted = $_GET["del"];
}
if ($_GET["c"] == "mt") {
	$channel = "MarkusTegelane";
}
else if ($_GET["c"] == "mtp") {
	$channel = "MarkusTegelane+";
}
else if ($_GET["c"] == "hmt") {
	$channel = "#markusTegelane";
}
else if ($_GET["c"] == "me") {
	$channel = "Minecraft Entities";
}
else if ($_GET["c"] == "mas") {
	$channel = "Markuse asjad";
}
else if ($_GET["c"] == "pak") {
	$channel = "Press any key to continue...";
}
else if ($_GET["c"] == "cqv") {
	$channel = "cqvmix";
}
else if ($_GET["c"] == "all") {
	$channel = "everyone";
}
if ($channel != "everyone") {
	$query = 'SELECT URL FROM channel_db WHERE Kanal = "' . $channel . '" AND Avalik = ' . $onlypublic . ' AND Kustutatud = ' . $deleted;
} else {
	$query = 'SELECT URL FROM channel_db WHERE Avalik = ' . $onlypublic . ' AND Kustutatud = ' . $deleted;
}
$uris = array();
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result))
{
	array_push($uris, $row[0]);
}
$len = count($uris) - 1;
$video = rand(0, $len);
$fin = "";
$idx = 0;
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result))
{
	$fin = $row[0];
	if ($idx == $video) {
		break;
	}
	$idx++;
}
echo "<script type='text/javascript'>document.location.href='{$fin}';</script>";
?>
