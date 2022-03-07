
<?php
ini_set('display_errors', '1');

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

function y() {
    if (!empty($_COOKIE["lang"])) {
 	if ($_COOKIE["lang"] == "et-EE") {
 		return "Jah";
 	} else {
 		return "Yes";
 	}
   } else {
        return "Yes" ;
   } 
}
function n() {
    if (!empty($_COOKIE["lang"])) {
 	if ($_COOKIE["lang"] == "et-EE") {
 		return "Ei";
 	} else {
 		return "No";
 	}
    } else {
        return "No" ;
    } 
}

function GetHeader($original) {
	if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
		return $original;
	} else {
		if ($original == "Kanal") { return "Channel"; }
		else if ($original == "Klass") { return "Class"; }
		else if ($original == "Kirjeldus") { return "Description"; }
		else if ($original == "Ülekanne") { return "Live stream"; }
		else if ($original == "Avalik") { return "Public"; }
		else if ($original == "Subtiitrid") { return "Subtitles"; }
		else if ($original == "Valmis") { return "Done"; }
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

include("../../connect.php");
if (!empty($_GET["id"])) {
	$id = $_GET["id"];
}
$query = "SELECT * FROM channel_ideas WHERE ID = " . $id;
$cnt = mysqli_query($connection, $query);
$result = mysqli_query($connection, $query);
$all_property = array();
while ($property = mysqli_fetch_field($result)) {
    array_push($all_property, $property->name);
}
$row = mysqli_fetch_array($cnt);
echo '<h1>' . $row["Video"] . '</h1>';
echo '<p>' . $row["Kanal"] . '</p>';
echo '<hr>';
echo '<p>' . nl2br($row["Kirjeldus"]) . '</p>';
echo '<hr>';
echo '<a href="' . str_replace("&id=" . $row[0], "", $_SERVER["REQUEST_URI"]) . '">' . ms("Go back", "Tagasi") . '</a>';
if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
echo '<h1>' . ms("Management", "Haldamine") . '</h1><ul>';
echo '<li><a href="delete?id=' . $row[0] .'&failsafeuserconfirmdelete=1">' . ms("Delete this idea from the database", "Kustuta see idee andmebaasist") . '</a></li>';
echo '<li><a href="add?temp_id=' . $row[0] .'">' . ms("Use this idea as the template for a new one", "Kasuta seda ideed uue mallina") . '</a></li>';
echo '<br/>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Video">' . ms("Modify title", "Muuda pealkirja") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kanal">' . ms("Modify channel", "Muuda kanalit") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kirjeldus">' . ms("Modify description", "Muuda kirjeldust") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Klass">' . ms("Modify class", "Muuda klassi") . '</a></li>';
echo '<br/>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Valmis">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("Done", "Valmis") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Ülekanne">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("Live stream", "Otseülekanne") . '</a></li>';
echo '</ul>';
}
BTFString($row, array(3, 6), $all_property);
echo '<br/>';
echo '<br/>';
echo '<br/>';
?>
