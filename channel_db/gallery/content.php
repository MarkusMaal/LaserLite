
<?php
ini_set('display_errors', '1');
if ((empty($_GET["nopages"]))) {
    include("../connect.php");
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
		else if ($original == "Kirjeldus") { return "Description"; }
		else if ($original == "Loomiskuupäev") { return "Creation date"; }
		else if ($original == "Kustutatud") { return "Deleted"; }
		else { return $original; }
	}
}
function display_property($row, $item, $idx) {
	if ((is_numeric($row[$item])) && ($item != 0)) {
		echo '<td class="content">' . str_replace("1", ms("Yes", "Jah"), str_replace("0", ms("No", "Ei"), $row[$item])) . '</td>';
	} else {
		if (!filter_var($row[$item], FILTER_VALIDATE_URL)) {
			echo '<td class="content">' . nl2br(wordwrap(substr($row[$item], 0, 100), 30, "\n", true));
			if (substr($row[$item], 0, 100) != $row[$item]) {
				echo '...';
			}
			echo '</td>';
		} else {
			echo '<td class="content"><a href="' . $row[$item] . '">Link</a></td>';
		}
	}
}

if (empty($_GET["nopages"])) {
	$disp_cols = array(1, 2, 3, 4, 5);
} else {
	if ($_GET["nopages"] == "1") {
		$disp_cols = array(0, 1, 2, 3, 4, 5);
	}
}
$search = "";
if (!empty($_GET["q"])) {
	$search = $_GET["q"];
}
$order = "ID";
if (!empty($_GET["ord"])) {
	$order = $_GET["ord"];
}
$otype = "ASC";
if (!empty($_GET["dir"])) {
	$otype = $_GET["dir"];
}
$done = 0;
$cases = 0;
$hd = 0;
$start = 0;
if (!empty($_GET["stid"])) {
	$start = $_GET["stid"];
}
$end = $start + 20;
if (!empty($_GET["hd"])) {
	$hd = $_GET["hd"];
	$cases += 1;
}
$subtitles = 0;
if (!empty($_GET["subtitles"])) {
	$subtitles = $_GET["subtitles"];
	$cases += 1;
}
$live = 0;
if (!empty($_GET["live"])) {
	$live = $_GET["live"];
	$cases += 1;
}
$public = 0;
if (!empty($_GET["public"])) {
	$public = $_GET["public"];
	$cases += 1;
}
if (!empty($_GET["done"])) {
	$done = $_GET["done"];
	$cases += 1;
}

$ignorepages = false;
if (!empty($_GET["nopages"])) {
	$ignorepages = true;
}

$channel = "all";
if (!empty($_GET["channel"])) {
	$channel = $_GET["channel"];
	$cases += 1;
}

//test if connection failed
if(mysqli_connect_errno()){
    die("connection failed: "
        . mysqli_connect_error()
        . " (" . mysqli_connect_errno()
        . ")");
}

$query = "SELECT * FROM channel_gallery";
if (($cases > 0) || ($search != "")) {
	$query = $query . " WHERE";
}
$query = $query . ' CONCAT(ID, Kanal, Kirjeldus, Loomiskuupäev, URL) LIKE "%' . $search . '%"';
if (($search != "") && ($channel != "all")) {
	$query = $query . " AND";
}

if($channel != "all") {
	$query = $query . " Kanal = '" . $channel . "'";
}
if ($done != "0") {
	$query = $query . " AND ";
}
if($done == "2") {
	$query = $query . " Kustutatud = 0";
}
else if($done == "1") {
	$query = $query . " Kustutatud = 1";
}
if ($live != "0") {
	$query = $query . " AND ";
}
if ($live == "1") {
	$query = $query . " Ülekanne = 1";
}
else if ($live == "2") {
	$query = $query . " Ülekanne = 0";
}
$query = $query . " ORDER BY(" . $order . ") " . $otype;
$query = str_replace('CONCAT(ID, Kanal, Kirjeldus, Loomiskuupäev, URL) LIKE "%%" AND', '', $query);
$query = str_replace('CONCAT(ID, Kanal, Kirjeldus, Loomiskuupäev, URL) LIKE "%%"', '', $query);

if ($ignorepages == false) {
	if (($cases > 0) || ($search != "")) {
		echo '<a href="index.php?ord=ID&dir=DESC">' . ms("Remove filters", "Eemalda filtrid") . '</a><br/>';
	}
	
	if ($_SERVER["REQUEST_URI"] != str_replace("?", "", $_SERVER["REQUEST_URI"])) {
		echo '<a href="index.php">' . ms("Hide all items", "Peida kõik üksused") . '</a>';
		//get results from database
		if (str_replace("ord=", "", $_SERVER["REQUEST_URI"]) != $_SERVER["REQUEST_URI"]) {
			if ($otype == "ASC")
			{
				echo '<br/><a href="' . str_replace("&dir=ASC", "", $_SERVER["REQUEST_URI"]) . '&dir=DESC">' . ms("Descending order", "Tagurpidi järjestus") . '</a>';
			} else {
				echo '<br/><a href="' . str_replace("&dir=DESC", "", $_SERVER["REQUEST_URI"]) . '&dir=ASC">' . ms("Ascending order", "Õigetpidi järjestus") . '</a>';
			}
		}
	}
}
if(($_SERVER["REQUEST_URI"] != "/channel_db/gallery/index.php") && ($_SERVER["REQUEST_URI"] != "/channel_db/gallery/")) {
	$result = mysqli_query($connection, $query);
	if (!empty($_GET["nopages"])) {
	    echo '<p> ' . ms("Query", "Päring") . ': ' . $query . '</p>';
    }
    if ($result == FALSE) {
		echo '<p>' . ms("No matches found for this query.", "Esitatud päringule ei ilmunud ühtegi vastust.") . '</p>
			  <script>
			  	document.getElementById("back").style.display = "none";
			  </script>';
		die();
    }
	if ($ignorepages == false) {
		echo '<a class="filterbutton" href="#/" onclick="hideshowmenu();">' . ms("Advanced search", "Täpne otsing") . '</a>';
		echo '<table id="filtermenu" class="filters"><tr>';
		if ($channel == "all") {
			$channels = mysqli_query($connection, "SELECT DISTINCT Kanal FROM channel_gallery");
			echo '<td class="filterbar"><h2>' . ms("Channels", "Kanalid") . '</h2><ul>';
			while ($row = mysqli_fetch_array($channels)) {
				if (($cases > 0) || ($search != "")) {
						echo '<li><a href="' . $_SERVER['REQUEST_URI'] . '&channel=' . str_replace('+', '%2B', $row[0]) . '">' . $row[0] . '</a></li>';
				} else {
					echo '<li><a href="index.php?channel=' . str_replace('+', '%2B', $row[0]) . '">' . $row[0] . '</a></li>';
				}
			}
			echo '</ul></td>';
		} else {
			echo '<td class="filterbar"><h2>' . ms("Channels", "Kanalid") . '</h2><p>' . $channel . '</p></td>';
		}
		
		$deletes = mysqli_query($connection, "SELECT DISTINCT Kustutatud FROM channel_gallery");
		if ($done == 0) {
			echo '<td class="filterbar"><h2>' . ms("Deleted", "Kustutatud") . '?</h2><ul>';
			while ($row = mysqli_fetch_array($deletes)) {
				if (($cases > 0) || ($search != "")) {
					echo '<li><a href="' . $_SERVER['REQUEST_URI'] . '&done=' . str_replace(0, 2, $row[0]) . '">' . str_replace("1", y(), str_replace("0", n(), $row[0])) . '</a></li>';
				} else {
					echo '<li><a href="index.php?done=' . str_replace(0, 2, $row[0]) . '">' . str_replace("1", y(), str_replace("0", n(), $row[0])) . '</a></li>';
				}
			}
			echo '</ul></td>';
		} else {
			if ($done == 1) {
				echo '<td class="filterbar"><h2>' . ms("Deleted", "Kustutatud") . '?</h2><p>'. y() . '</p></td>';
			} else {
				echo '<td class="filterbar"><h2>' . ms("Deleted", "Kustutatud") . '?</h2><p>' . n() . '</p></td>';
			}
		}
		
		$cnt = mysqli_query($connection, $query);
		$total = 0;
		while ($row = mysqli_fetch_array($cnt)) {
			$total++;
		}
		$prev = $end - 40;
		$next = $end + 20;
		$possible = $total / 20 + 1;
		$origin = str_replace("&stid=" . $start, "", $_SERVER["REQUEST_URI"]);
		echo '<br/><br/><table><tr>';
		if (($start >= 20) && ($total > 180)) {
			echo '<td class="navbar"><a class="pagenav"  href="' . $origin . '&stid=0">&lt;&lt;</a></td>';
		}
		if ($end > 20) {
			echo '<td class="navbar"><a class="pagenav" href="' . $origin . '&stid=' . $prev . '">&lt;</a></td>';
		} else {
			echo '<td class="navbar"><span class="activenav">&lt;</a></td>';
		}
		$final = 20 * intval($possible - 1);
		if ($possible > 10) {
			$first = $start / 20;
			while (($possible - $first) < 9) {
				$first -= 1;
			}
			$endpos = $first + 8;
			while ($first < 0) {
				$first += 1;
			}
		} else {
			$first = 0;
			$endpos = $possible - 1;
		}
		for ($x = $first; $x <= $endpos; $x++) {
			$c = $x + 1;
			$pageid = $x * 20;
			if ($pageid != $start) {
				echo '<td class="navbar"><a class="pagenav" href="' . $origin . '&stid=' . $pageid . '">' . $c . '</a></td>';
			} else {
				echo '<td class="navbar"><span class="activenav" >' . $c . '</span></td>';
			}
		}
		if ($next - 20 <= $total) {
			echo '<td class="navbar"><a class="pagenav" href="' . $origin . '&stid=' . $end . '">&gt;</a></td>';
		} else {
			echo '<td class="navbar"><span class="activenav">&gt;</span></td>';
		}
		if (($possible > 10) && (intval($start) != $final)) {
		echo '<td class="navbar"><a class="pagenav" href="' . $origin . '&stid=' . $final . '">&gt;&gt;</a></td>';
		}
		echo '</tr></table></span>';
	}
	$padend = "t";
	if (mysqli_num_rows($result) == 1) {
	$padend = "";
	}
	if (mysqli_num_rows($result) != 0) {
		if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
			echo '<p>Leiti ' . mysqli_num_rows($result) . ' kirje' . $padend . '.</p>';
		} else {
			if ($padend == "") {
				echo '<p>' . mysqli_num_rows($result) . ' record found' . '.</p>';
			} else {
				echo '<p>' . mysqli_num_rows($result) . ' records found' . '.</p>';
			}
		}
	}
	echo '<table>';
	$all_property = array();  //declare an array for saving property
	
	//showing property
	echo '<table class="data-table">
        	<tr class="data-heading">';  //initialize table tag
 	$idx = 0;
	while ($property = mysqli_fetch_field($result)) {
		if (in_array($idx, $disp_cols)) {
			if ($_SERVER["REQUEST_URI"] == str_replace("?", "", $_SERVER["REQUEST_URI"])) {
    			echo '<td><a href="?ord=' . $property->name . '">' . $property->name . '</td></a>';	
			} else {
    			echo '<td><a href="'. str_replace('&ord=' . $order, '', $_SERVER["REQUEST_URI"]) . '&ord=' . $property->name . '">' . GetHeader($property->name) . '</td></a>';
    		}  //get field name for header
    	}
    	array_push($all_property, $property->name);  //save those to array
		$idx++;
	}
	if (empty($_GET["nopages"])) {
		echo '<td>' . ms("More info", "Lisainfo") . '</td>';
	}
	echo '</tr>'; //end tr tag
	
	//showing all data
	$tot = 0;
	$end = $start + 20;
	while ($row = mysqli_fetch_array($result)) {
    	$idx = 0;
    	if (($tot >= $start) && ($tot < $end)) {
    		echo "<tr>";
    		$prefix = "";
    		foreach ($disp_cols as &$i) {
	   		display_property($row, $i, 1);
	   	}
	   		if (empty($_GET["nopages"])) {
		   		echo '<td class="content"><a href="' . $_SERVER["REQUEST_URI"] . '&id=' . $row[0] . '">' . ms("More info", "Lisainfo") . '</a></td>';
	   		}
   			echo '</tr>';
    	}
    	if($ignorepages == false) {
	    	$tot += 1;
    	}
	}
	echo "</table>";
} else {
echo '<a href="?ord=id&dir=DESC">' . ms("Show all items", "Kuva kõik üksused") . '</a>';
echo '<script>var x = document.getElementById("back"); x.style.visibility = "hidden";</script>';
}
?>
<script>
var x = document.getElementById("filtermenu");
x.style.visibility = "hidden";
var x = document.getElementById("back");
x.style.visibility = "hidden";
</script>
