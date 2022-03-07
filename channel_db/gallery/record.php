
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


$query = "SELECT * FROM channel_gallery WHERE ID = " . $id;
$query2 = "SELECT * FROM channel_gallery";

$cnt = mysqli_query($connection, $query);
$result = mysqli_query($connection, $query);
$result2 = mysqli_query($connection, $query2);
$count = mysqli_num_rows($result2);
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
$date = explode("-", $row["Loomiskuupäev"]);
$wordmonth = $date[1];
for ($i = 0; $i < count($months1); $i++) {
	$wordmonth = str_replace($months1[$i], $months2[$i], $wordmonth);
}
echo '<h1>' . $row["Kanal"] . '</h1>';if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
	echo '<p>' . ms("Creation date", "Loomiskuupäev") . ': ' . $date[2] . '. ' . $wordmonth . ' ' . $date[0] . '. a</p>';
} else {
	echo '<p>' . ms("Creation date", "Loomiskuupäev") . ': ' . $wordmonth . ' ' . $date[2] . GetEnd($date[2]) . ' ' . $date[0] . '</p>';
}
echo '<p>Logode ajalugu:</p>';
for ($i = 1; $i < 10; $i++) {
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . explode("?", $_SERVER['REQUEST_URI'])[0] . "logos/" . $row[0] . "/" . $i . ".png")) {
        echo "<a href=\"logos/" . $row[0] . "/" . $i . ".png\"><img src=\"logos/" . $row[0] . "/" . $i . ".png\" style=\"width: 200px;\"></a>";
    }
}
echo '<hr>';
echo '<p>' . nl2br($row["Kirjeldus"]) . '</p>';
echo '<hr>';
echo '<p>URL: <a href="' . $row["URL"] . '">' . $row["URL"] . '</a></p>';
if ($row[0] > 1) {
    echo '<a href="' . str_replace("&id=" . $row[0], "&id=" . ($row[0] - 1), $_SERVER["REQUEST_URI"]) . '">&lt; ' . ms("Previous", "Eelmine") . '</a>';
}
if ($row[0] < $count) {
    echo '<a href="' . str_replace("&id=" . $row[0], "&id=" . ($row[0] + 1), $_SERVER["REQUEST_URI"]) . '">' . ms("Next", "Järgmine") . ' &gt;</a>';
}
echo '<br/><a href="' . str_replace("&id=" . $row[0], "", $_SERVER["REQUEST_URI"]) . '">' . ms("Go back", "Tagasi") . '</a>';
if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
echo '<h1>' . ms("Management", "Haldamine") . '</h1><ul>';
echo '<li><a href="delete?id=' . $row[0] .'&failsafeuserconfirmdelete=1">' . ms("Delete this idea from the database", "Kustuta see idee andmebaasist") . '</a></li>';
echo '<li><a href="add?temp_id=' . $row[0] .'">' . ms("Use this idea as the template for a new one", "Kasuta seda ideed uue mallina") . '</a></li>';
echo '<br/>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kanal">' . ms("Modify channel", "Muuda kanalit") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kirjeldus">' . ms("Modify description", "Muuda kirjeldust") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Loomiskuupäev">' . ms("Modify date", "Muuda kuupäeva") . '</a></li>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=URL">' . ms("Modify URL", "Muuda URL-i") . '</a></li>';
echo '<br/>';
echo '<li><a href="replace?id=' . $row[0] .'&mod=Kustutatud">' . ms("Modify property", "Muuda attribuuti") . ': ' . ms("Deleted", "Kustutatud") . '</a></li>';
echo '</ul>';
}
BTFString($row, array(5), $all_property);
echo '<br/>';
echo '<br/>';
echo '<br/>';
?>
