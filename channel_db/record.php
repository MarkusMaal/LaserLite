
<?php
include("connect.php");
include("../markustegelane/common/comments.php");

function GetEnd($n) {
	$suf = mb_substr($n, -1);
	if ($suf == "1") {
		return "st";
	}
	else if ($suf == "2") {
		return "nd";
	}
	else if ($suf == "3") {
		return "rd";
	}
	else {
		return "th";
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

function BTFString($row, $vals, $all_property) {
	echo '<br/><h1>' . ms("Properties", "Attribuudid") . '</h1>';
	echo '<ul>';
	foreach ($vals as &$val) {
		echo '<li>' . GetHeader($all_property[$val]) . ': ' . str_replace("0", n(), str_replace("1", y(), $row[$val])) . '</li>';
	}
	echo '</ul>';
}

if (!empty($_GET["id"])) {
	$id = $_GET["id"];
}
$query = "SELECT * FROM channel_db WHERE ID = " . $id;
$cnt = mysqli_query($connection, $query);
$result = mysqli_query($connection, $query);
$all_property = array();
$months1 = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
$months2 = array("jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember");
if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US")) {
	$months2 = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
}
while ($property = mysqli_fetch_field($result)) {
    array_push($all_property, $property->name);
}
$row = mysqli_fetch_array($cnt);
echo '<a href="thumbs/' . $row[0] . '.jpg"><img width=500 src="thumbs/' . $row[0] . '.jpg"/></a>';
echo '<h1>' . $row[2] . '</h1>';
echo '<p>' . $row[1] . '</p>';
echo '<hr>';
echo '<p>' . nl2br($row[5]) . '</p>';
echo '<hr>';
$date = explode("-", $row[4]);
$wordmonth = $date[1];
for ($i = 0; $i < count($months1); $i++) {
	$wordmonth = str_replace($months1[$i], $months2[$i], $wordmonth);
}
if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
	echo '<p>' . ms("Published", "Avaldati") . ': ' . $date[2] . '. ' . $wordmonth . ' ' . $date[0] . '. a</p>';
} else {
	echo '<p>' . ms("Published", "Avaldati") . ': ' . $wordmonth . ' ' . $date[2] . GetEnd($date[2]) . ' ' . $date[0] . '</p>';
}
echo '<a target="_blank" href="' . $row[10] .  '">' . ms("Open video", "Ava video") . '</a>';
echo '<a href="' . str_replace("&id=" . $row[0], "", $_SERVER["REQUEST_URI"]) . '">' . ms("Go back", "Tagasi") . '</a>';
if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
echo '<h1>' . ms("Management", "Haldamine") . '</h1><ul>';
echo '<li><a href="delete?id=' . $row[0] .'&failsafeuserconfirmdelete=1">' . ms("Delete this video from the database", "Kustuta see video andmebaasist") . '</a></li>';
echo '<li><a href="add?temp_id=' . $row[0] .'">' . ms("Use this video as the template for a new one", "Kasuta seda videot uue mallina") . '</a></li>';
echo '<br/>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Video">' . ms("Modify title", "Muuda pealkirja") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kanal">' . ms("Modify channel", "Muuda kanalit") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kirjeldus">' . ms("Modify description", "Muuda kirjeldust") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kuupäev">' . ms("Modify date posted", "Muuda avaldamiskuupäeva") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=URL">' . ms("Modify URL", "Muuda veebiaadressi") . '</a></li>';
echo '<br/>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kustutatud">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("Deleted", "Kustutatud") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Subtiitrid">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("Subtitles", "Subtiitrid") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Avalik">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("Public", "Avalik") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Ülekanne">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("Live stream", "Otseülekanne") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=HD">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("High definition", "Kõrge kvaliteet") . '</a></li>';
echo '</ul>';
}
BTFString($row, array(3, 6, 7, 8, 9), $all_property);
echo '<h1>' . ms("Comments", "Kommentaarid") . '</h1>';

$r1 = mysqli_query($connection, "SELECT * FROM general_comments WHERE PAGE_ID = " . $id . " AND THREAD = 1 AND REPLY = 0 ORDER BY(ID) DESC");
if (mysqli_num_rows($r1) > 0) {
while ($orow = mysqli_fetch_array($r1)) {
	if ($orow != FALSE) {
		DisplayComments($connection, $orow, $row[0], 0, 1);
	}
}
} else {
		echo ms("There are no archived comments", "Arhiveeritud kommentaare ei ole");
}
echo '<br/>';
echo '<br/>';
echo '<br/>';
?>
