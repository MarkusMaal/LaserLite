 
<?php include("common/connect.php");?>
<h1>Muudatustelogi</h1>
<a class="listitems"  href="?doc=changelog&s=1&year=0">Kõik</a> 
<?php
for ($i = 2019; $i <= date("Y"); $i++) {
	echo '<a class="listitems" href="?doc=changelog&s=1&year=' . $i . '">' . $i . '</a> ';
} ?>
<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL ^ E_NOTICE);
	if (empty($_GET["year"])) {
		$query = "SELECT * FROM changelog ORDER BY (ID) DESC";
	} else {
		$query = "SELECT * FROM changelog WHERE RELEASEDATE < (\"" . ($_GET["year"] + 1) . "-01-01" . "\") AND RELEASEDATE > (\"" . $_GET["year"] . "-01-01" . "\") ORDER BY (ID) DESC";
	}
	$result = mysqli_query($connection, $query);
	if ($result === FALSE) {
		echo '<br/><br/><h3>Muudatustelogi uuendatakse</h3>';
		die('<p>Muudatustelogile rakendatakse hetkel suur uuendus, mis võimaldab
				 veebisaidi omanikul lihtsamini muudatusi lisada. Palun tulge hiljem tagasi.</p>');
	}
	if ((!empty($_SESSION)) && ($_SESSION["level"] == "owner")) {
		echo '<a class="listitems"  href="?doc=addchange&s=1">Lisa muudatus</a>';
	}
	echo '<br/><br/>';
	while ($row = mysqli_fetch_array($result)) {
		if ($row[1] == "0000-00-00") {
			echo '<h2>Varasemad värskendused</h2>';
		} else {
			$date = explode("-", $row[1]);
			$day = $date[2];
			$year = $date[0];
			$month = $date[1];
			$monthstr = "tundmatu";
			if ($month == "01") { $monthstr = "jaanuar"; }
			else if ($month == "02") { $monthstr = "veebruar"; }
			else if ($month == "03") { $monthstr = "märts"; }
			else if ($month == "04") { $monthstr = "aprill"; }
			else if ($month == "05") { $monthstr = "mai"; }
			else if ($month == "06") { $monthstr = "juuni"; }
			else if ($month == "07") { $monthstr = "juuli"; }
			else if ($month == "08") { $monthstr = "august"; }
			else if ($month == "09") { $monthstr = "september"; }
			else if ($month == "10") { $monthstr = "oktoober"; }
			else if ($month == "11") { $monthstr = "november"; }
			else if ($month == "12") { $monthstr = "detsember"; }
			
			if ($day == "01") { $day = "1"; }
			else if ($day == "02") { $day = "2"; }
			else if ($day == "03") { $day = "3"; }
			else if ($day == "04") { $day = "4"; }
			else if ($day == "05") { $day = "5"; }
			else if ($day == "06") { $day = "6"; }
			else if ($day == "07") { $day = "7"; }
			else if ($day == "08") { $day = "8"; }
			else if ($day == "09") { $day = "9"; }
			echo '<h2>' . $day . '. ' . $monthstr . ' ' . $year . '. a</h2>';
		}
		$subquery = "SELECT CONTENT_ET FROM changelog_change WHERE PARNT_ID = " . $row[0] . " ORDER BY(ID) DESC";
		$subresult = mysqli_query($connection, $subquery);
		echo '<ul>';
		while ($row2 = mysqli_fetch_array($subresult)) {
			echo '<li>' . $row2[0] . '</li>';
		}
		echo '</ul><br/>';
	}
	echo '<a href="index.php">Tagasi avalehele</a>';
?>
