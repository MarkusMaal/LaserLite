<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	include("../connect.php");

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
	if (empty($_GET)) {
		$otype = "DESC";
	}
	$deleted = 0;
	$cases = 0;
	$hd = 0;
	$start = 0;
	if (!empty($_GET["stid"])) {
		$start = $_GET["stid"];
	}
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
	if (!empty($_GET["deleted"])) {
		$deleted = $_GET["deleted"];
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

	$query = "SELECT * FROM channel_db";
	if (!empty($_GET["gallery"])) {
		$query = "SELECT * FROM channel_gallery";
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/gallery/report/index.php");
	} else if (!empty($_GET["ideas"])) {
		$query = "SELECT * FROM channel_ideas";
		include($_SERVER["DOCUMENT_ROOT"] . "/channel_db/ideas/report/index.php");
	} else {
		if (($cases > 0) || ($search != "")) {
			$query = $query . " WHERE";
		}

		if ($search != "") {
			$query = $query . ' CONCAT(ID, Video, Kirjeldus, Kuupäev, Tags, Category, CategoryMUI_en, KirjeldusMUI_en, KirjeldusMUI_et, TitleMUI_en, TitleMUI_et, Filename) LIKE "%' . $search . '%"';
		}
		if (($search != "") && ($channel != "all")) {
			$query = $query . " AND";
		}

		if($channel != "all") {
			$query = $query . " Kanal = '" . $channel . "'";
		}

		$category = "";
		if (!empty($_GET["category"])) {
			$category = $_GET["category"];
		}
		if($category != "") {
			if ($category == "New Year's Celebration videos") {
				if (($channel == "all") && ($search == "")) {
					$query = $query . " Category = 'Uue aasta vastuvõtu videod'";
				} else {
					$query = $query . " AND Category = 'Uue aasta vastuvõtu videod'";
				}
			} else {
				if (empty($_COOKIE["lang"]) || $_COOKIE["lang"] != "et-EE") {
					if (($channel == "all") && ($search == "")) {

						$query = $query . " CategoryMUI_en = '" . $category . "'";
					} else {
						$query = $query . " AND CategoryMUI_en = '" . $category . "'";
					}
				} else {
					if (($channel == "all") && ($search == "")) {
						$query = $query . " Category = '" . $category . "'";
					} else {
						$query = $query . " AND Category = '" . $category . "'";
					}
				}
			}
		}

		if ($deleted != "0") {
			$query = $query . " AND ";
		}
		if($deleted == "2") {
			$query = $query . " Kustutatud = 0";
		}
		else if($deleted == "1") {
			$query = $query . " Kustutatud = 1";
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
		$query = $query . " ORDER BY(" . $order . ") " . $otype;
		$query = str_replace('CONCAT(ID, Video, Kirjeldus, Kuupäev) LIKE "%%" AND', '', $query);
		$query = str_replace('CONCAT(ID, Video, Kirjeldus, Kuupäev) LIKE "%%"', '', $query);

		$cols = mysqli_query($connection, "DESCRIBE channel_db;");
		$clmn = array();
		while ($col = mysqli_fetch_array($cols)) {
			array_push($clmn, $col[0]);
		}

		$cnt = mysqli_query($connection, $query);
		if (empty($_COOKIE["reportformat"]) || ($_COOKIE["reportformat"] == "html")) {
			include('../head.php');
			echo '<h1>' . ms("Channel database report", "Kanali andmebaasi raport") . '</h2>';
			echo ms("SQL query: ", "SQL päring: ") . $query;
			echo "<br/><br/>";
			echo '<table class="data-table">';
			echo '<tr class="data-heading">';

			foreach ($clmn as $col) {
				echo '<td>' . $col . '</td>';
			}
			echo '</tr>';
			while ($row = mysqli_fetch_array($cnt))
			{
				echo '<tr>';
				foreach ($clmn as $col) {
					echo '<td class="content">' . $row[$col] . '</td>';
				}
				echo '<tr>';

			}
			echo '</table>';
			include('../foot.php');
		} else if ($_COOKIE["reportformat"] == "json") {
		$json_data=array();//create the array
		while ($row = mysqli_fetch_array($cnt))//foreach loop
		{

			foreach ($clmn as $col) {
				$json_array[$col]=$row[$col];
			}
			//here pushing the values in to an array
			array_push($json_data,$json_array);

		}

		//built in PHP function to encode the data in to JSON format
		echo json_encode($json_data);
		}
		else if ($_COOKIE["reportformat"] == "csv") {
			echo implode(",", $clmn);
			echo "\r\n";
			while ($row = mysqli_fetch_array($cnt)) {
				$fullrow = array();
				foreach ($clmn as $col) {
					array_push($fullrow, "\"" . $row[$col] . "\"");
				}
				echo implode(",", $fullrow);
				echo "\r\n";
			}
		}
	}
?>
