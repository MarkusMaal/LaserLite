
<?php
//ini_set('display_errors', '1');
if (!empty($_GET["id"])) {
	die();
}
function display_property($row, $item, $idx, $fallback) {
	if ((is_numeric($row[$item])) && ($item != 0)) {
		echo '<td class="content">' . str_replace("1", ms("Yes", "Jah"), str_replace("0", ms("No", "Ei"), $row[$item])) . '</td>';
	} else {
		if (!filter_var($row[$item], FILTER_VALIDATE_URL)) {
			if ($row[$item] == ".") {
				$item = $fallback;
			}
			if ($row[$item] == "N/A") {
				echo '<td class="content" style="color: #ff0">' . ms("No description", "Kirjeldus puudub") . '</td>';
			} else {
				echo '<td class="content">' . nl2br(wordwrap(substr($row[$item], 0, 100), 30, "\n", true));
				if (substr($row[$item], 0, 100) != $row[$item]) {
					echo '...';
				}
				echo '</td>';
			}
		} else {
			echo '<td class="content">';
			if ($row["URL"] != "N/A") {
				echo '<a href="' . $row[$item] . '">YouTube link</a>';
			}
			if ($row["OdyseeURL"] != "N/A") {
				echo '<br/><a href="' . $row["OdyseeURL"] . '">Odysee link</a>';
			}
			echo '</td>';
		}
	}
}


$prefix = "&";
if (empty($_GET)) {
	$prefix = "?";
}
$perpage = str_replace("\"", "\\\"", str_replace("'", "\'", $results));


$mui_et = array(22, 13, -1, 15, -1);
$mui_en = array(21, 12, -1, 14, -1);

if (empty($_GET["nopages"])) {
	$disp_cols = array(1, 2, 4, 5, 10);
} else {
	if ($_GET["nopages"] == "1") {
		$disp_cols = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
	}
}
$search = "";
if (!empty($_GET["q"])) {
	$search = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["q"]));
}
$order = "ID";
if (!empty($_GET["ord"])) {
	$order = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["ord"]));
}
$otype = "ASC";
if (!empty($_GET["dir"])) {
	$otype = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["dir"]));
}

$category = "";
if (!empty($_GET["category"])) {
	$category = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["category"]));
}

$deleted = 0;
$cases = 0;
$hd = 0;
$start = 0;
$done = 0;
$class = 0;
if (!empty($_GET["done"])) {
	$done = $_GET["done"];
}
if (!empty($_GET["class"])) {
	$class = $_GET["class"];
}
if (!empty($_GET["stid"])) {
	$start = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["stid"]));
}
$end = $start + $perpage;
if (!empty($_GET["hd"])) {
	$hd = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["hd"]));
	$cases += 1;
}
$subtitles = 0;
if (!empty($_GET["subtitles"])) {
	$subtitles = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["subtitles"]));
	$cases += 1;
}
$live = 0;
if (!empty($_GET["live"])) {
	$live = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["live"]));
	$cases += 1;
}
$public = 0;
if (!empty($_GET["public"])) {
	$public = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["public"]));
	$cases += 1;
}
if (!empty($_GET["deleted"])) {
	$deleted = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["deleted"]));
	$cases += 1;
}

$ignorepages = false;
if (!empty($_GET["nopages"])) {
	$ignorepages = true;
}

$channel = "all";
if (!empty($_GET["channel"])) {
	$channel = str_replace("\"", "\\\"", str_replace("'", "\'", $_GET["channel"]));
	$cases += 1;
}

//test if connection failed
if(mysqli_connect_errno()){
    die("connection failed: "
        . mysqli_connect_error()
        . " (" . mysqli_connect_errno()
        . ")");
}

$query = "SELECT * FROM channel_db";
if (!empty($_GET["gallery"])) {
	$query = "SELECT * FROM channel_gallery";
}
if (!empty($_GET["ideas"])) {
	$query = "SELECT * FROM channel_ideas";
}
$query = $query . " WHERE";
if ($search != "") {
	$query = $query . ' CONCAT(ID, Video, Kirjeldus, Kuupäev, Tags, Category, CategoryMUI_en, KirjeldusMUI_en, KirjeldusMUI_et, TitleMUI_en, TitleMUI_et, Filename) LIKE "%' . $search . '%"';
}
if (($search != "")) {
	$query = $query . " AND";
}

if($channel != "all") {
	$query = $query . " Kanal = '" . $channel . "'";
} else {
	$query = $query . " Kanal LIKE \"%\" ";
}
if($category != "") {
	if ($category == "New Year's Celebration videos") {
		$query = $query . " AND Category = 'Uue aasta vastuvõtu videod'";
	} else {
		if (empty($_COOKIE["lang"]) || $_COOKIE["lang"] != "et-EE") {
			$query = $query . " AND CategoryMUI_en = '" . $category . "'";
		} else {
			$query = $query . " AND Category = '" . $category . "'";
		}
	}
}
if (empty($_GET["ideas"])) {

	if ($deleted != "0") {
		$query = $query . " AND ";
	}
	if($deleted == "2") {
		$query = $query . " Kustutatud = 0";
	}
	else if($deleted == "1") {
		$query = $query . " Kustutatud = 1";
	}	
}
if ($subtitles != "0") {
	$query = $query . " AND ";
}
if ($subtitles == "1") {
	$query = $query . " Subtiitrid = 1";
}
else if ($subtitles == "2") {
	$query = $query . " Subtiitrid = 0";
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
if ($public != "0") {
	$query = $query . " AND ";
}
if ($public == "1") {
	$query = $query . " Avalik = 1";
}
else if ($public == "2") {
	$query = $query . " Avalik = 0";
}
if ($hd != "0") {
	$query = $query . " AND ";
}
if ($hd == "1") {
	$query = $query . " HD = 1";
}
else if ($hd == "2") {
	$query = $query . " HD = 0";
}
if ($done != "0") {
	$query = $query . " AND ";
}
if ($done == "1") {
	$query = $query . " Valmis = 1";
}
else if ($done == "2") {
	$query = $query . " Valmis = 0";
}
if ($class != "0") {
	$query = $query . " AND ";
	$query = $query . " Klass = ${class}";
}
$query = $query . " ORDER BY(" . $order . ") " . $otype;
$query = str_replace("FROM channel_db AND", "FROM channel_db", $query);
$query = str_replace("FROM channel_gallery AND", "FROM channel_gallery", $query);
$query = str_replace("FROM channel_ideas AND", "FROM channel_ideas", $query);
$query = str_replace('CONCAT(ID, Video, Kirjeldus, Kuupäev) LIKE "%%" AND', '', $query);
$query = str_replace('CONCAT(ID, Video, Kirjeldus, Kuupäev) LIKE "%%"', '', $query);
echo '<div class="container text-center">';
if ($ignorepages == false) {
	if (($cases > 0) || ($search != "") || ($channel != "all") || ($category != "")) {
		echo '<a href="index.php?ord=ID&dir=DESC"><button type="button" class="btn btn-secondary mx-1 mt-4">' . ms("Remove filters", "Eemalda filtrid") . '</button></a>';
	}
	
	if (empty($_GET["dir"]) || empty($_GET["ord"]) || ($_GET["dir"] != "DESC") && ($_GET["ord"] != "id")) { echo '<a href="index.php?ord=id&dir=DESC"><button type="button" class="btn btn-secondary mx-1 mt-4">' . ms("Restore defaults", "Algleht") . '</button></a>'; }
	//get results from database
	if ($otype == "ASC")
	{
		echo '<a href="' . str_replace($prefix . "dir=ASC", "", $_SERVER["REQUEST_URI"]) . $prefix . 'dir=DESC"><button type="button" class="btn btn-secondary mx-1 mt-4">' . ms("Descending order", "Tagurpidi järjestus") . '</button></a>';
	} else {
		echo '<a href="' . str_replace($prefix . "dir=DESC", "", $_SERVER["REQUEST_URI"]) . $prefix . 'dir=ASC"><button type="button" class="btn btn-secondary mx-1 mt-4">' . ms("Ascending order", "Õigetpidi järjestus") . '</button></a>';
	}
	
}	
	$cnt = mysqli_query($connection, $query);
	$total = 0;
	while ($row = mysqli_fetch_array($cnt)) {
		$total++;
	}
	if ($total == 0) {
		die(ms("No results found for this query", "Esitatud päring ei andnud tulemusi"));
	}
	$prev = $end - ($perpage * 2);
	$next = $end + $perpage;
	$possible = $total / $perpage + 1;
	$origin = str_replace("&stid=" . $start, "", $_SERVER["REQUEST_URI"]);
	echo '<br/><br/><div class="btn-group">';
	if (($start >= $perpage) && ($total > 9 * $perpage)) {
		echo '<a class="btn btn-primary" href="' . $origin . $prefix . 'stid=0">&lt;&lt;</a>';
	}
	if ($end > $perpage) {
		echo '<a class="btn btn-primary" href="' . $origin . $prefix . 'stid=' . $prev . '">&lt;</a>';
	} else {
		echo '<span class="btn btn-primary active">&lt;</span>';
	}
	$final = $perpage * intval($possible - 1);
	if ($possible > 10) {
		$first = $start / $perpage;
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
		$pageid = $x * $perpage;
		if ($pageid != $start) {
			echo '<a class="btn btn-primary" href="' . $origin . $prefix . 'stid=' . $pageid . '">' . $c . '</a>';
		} else {
			echo '<span class="btn btn-primary active" >' . $c . '</span>';
		}
	}
	if ($next - $perpage <= $total) {
		echo '<a class="btn btn-primary" href="' . $origin . $prefix . 'stid=' . $end . '">&gt;</a>';
	} else {
		echo '<span class="btn btn-primary active">&gt;</span>';
	}
	if (($possible > 10) && (intval($start) != $final)) {
	echo '<a class="btn btn-primary" href="' . $origin . $prefix . 'stid=' . $final . '">&gt;&gt;</a>';
	}
	echo '</div>';
	
	
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
	$padend = "t";
	if (mysqli_num_rows($result) == 1) {
	$padend = "";
	}
	if (mysqli_num_rows($result) != 0) {
		if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
			echo '<p class="mt-4">Leiti ' . mysqli_num_rows($result) . ' vaste' . $padend . '.</p>';
		} else {
			echo '<p class="mt-4">' . mysqli_num_rows($result) . ' matches found' . '.</p>';
		}
	}
	echo '</div>';
	
	
	
	
	
	$all_property = array();  //declare an array for saving property
	
	//showing all data
	$tot = 0;
	$end = $start + $perpage;
	if (empty($_GET["ideas"])) {
		echo '<div class="container"><div class="row mx-auto">';
		while ($row = mysqli_fetch_array($result)) {
			$idx = 0;
			if (($tot >= $start) && ($tot < $end)) {
				echo '<div class="col"><a href="' . $_SERVER["REQUEST_URI"] . '&id=' . $row[0] . '" style="text-decoration: none;"><div class="card my-5 mx-auto" style="width: 18rem;">';
				if ($thumbnails == "true") {
					if (empty($_GET["gallery"]) && empty($_GET["ideas"])) {
						if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/channel_db/thumbs/" . $row[0] . ".jpg")) {
							$img = $_SERVER['DOCUMENT_ROOT'] . "/channel_db/thumbs/" . $row[0] . ".jpg";
							$url = 'http://img.youtube.com/vi/' . str_replace('https://www.youtube.com/watch?v=', '', $row[10]) . '/sddefault.jpg';
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $url); 
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
							$output = curl_exec($ch);   
							curl_close($ch);
							$fp = fopen($img, "w");
							fwrite($fp, $output);
							fclose($fp);
							
						}
						$prefix = "";
						if (str_replace('report/', '', $_SERVER['REQUEST_URI']) == $_SERVER['REQUEST_URI']) {
							echo '<img class="card-img-top" style="width: 100%;" src="thumbs/' . $row[0] . '.jpg"/>';
						}
					} else {
						if (str_replace('report/', '', $_SERVER['REQUEST_URI']) == $_SERVER['REQUEST_URI']) {
							$i = 1;
							while (file_exists($_SERVER['DOCUMENT_ROOT'] . "/channel_db/gallery/logos/" . $row[0] . "/" . $i . ".png")) {
								$i++;
							}
							$i = $i - 1;
							echo '<img class="card-img-top" style="width: 100%;" src="gallery/logos/' . $row[0] . '/' . $i . '.png"/>';
						}
					}
				}
				$enum = 0;
				// 1 - Channel
				// 2 - Title
				echo '<div class="card-body">';
				if (empty($_GET["gallery"]) && empty($_GET["ideas"])) {
					echo "	<h5 class=\"card-title\">${row[2]}</h5>";
					echo "	<p class=\"card-text\">${row[1]}</p>";
				} else {
					$names = explode(" / ", $row[1]);
					$formernames = $names;
					$lname = $names[count($names) - 1];
					array_splice($formernames, count($formernames) - 1, 1);
					echo "	<h5 class=\"card-title\">${lname}</h5>";
					if (count($formernames) > 1) {
						echo '   <p class=\"card-text\">' . ms("Former names: ", "Varasemad nimed: ");
						$constructor = "";
						foreach ($formernames as &$name) {
							$constructor = $constructor . $name . ', ';
						}
						$constructor = substr($constructor, 0, -2);
						echo $constructor;
					}
					else if (count($formernames) == 1) {
						echo '   <p class=\"card-text\">' . ms("Former name: ", "Varasem nimi: ") . $formernames[0];
					}
					if (count($formernames) > 0) {
						echo '   </p>';
					}
				}
				echo '</div>';
				echo '</div></a></div>';
			}
			if($ignorepages == false) {
				$tot += 1;
			}
		}
		echo "</div>";
	} else {
		echo '<ul class="list-group list-group-flush">';
		while ($row = mysqli_fetch_array($result)) {
			$idx = 0;
			if (($tot >= $start) && ($tot < $end)) {
				echo "<li class=\"list-group-item d-flex justify-content-between align-items-start\"><a href=\"${_SERVER["REQUEST_URI"]}&id=${row[0]}\" style=\"text-decoration: none;\">";
					echo "<div class=\"ms-2 me-auto\">";
						echo "<div class=\"fw-bold\">${row[2]}</div>${row[1]}";
					echo "</div></a>";
					echo "<span class=\"badge bg-primary rounded-pill\">${row[5]}</span>" ;
				echo "</li>";
			}
			if($ignorepages == false) {
				$tot += 1;
			}
		}
		echo '</ul>';
	}
?>
