 
<?php include("common/connect.php");?>
<h1>Changelog</h1>
<a class="listitems" href="?doc=changelog&s=1&year=0">All</a> 
<?php
for ($i = 2019; $i <= date('Y'); $i++) {
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
		echo '<br/><br/><h3>Changelog is being updated</h3>';
		die('<p>A major update is being applied to the changelog, which makes it easier for
				 the website owner to add new changes. Please come back later.</p>');
	}
	if ((!empty($_SESSION)) && ($_SESSION["level"] == "owner")) {
		echo '<a class="listitems" href="?doc=addchange&s=1">Add change</a>';
	}
	while ($row = mysqli_fetch_array($result)) {
		if ($row[1] == "0000-00-00") {
			echo '<h2>Previous updates</h2>';
		} else {
			$date = explode("-", $row[1]);
			$day = $date[2];
			$year = $date[0];
			$month = $date[1];
			$monthstr = "Unknown";
			if ($month == "01") { $monthstr = "January"; }
			else if ($month == "02") { $monthstr = "February"; }
			else if ($month == "03") { $monthstr = "March"; }
			else if ($month == "04") { $monthstr = "April"; }
			else if ($month == "05") { $monthstr = "May"; }
			else if ($month == "06") { $monthstr = "June"; }
			else if ($month == "07") { $monthstr = "July"; }
			else if ($month == "08") { $monthstr = "August"; }
			else if ($month == "09") { $monthstr = "September"; }
			else if ($month == "10") { $monthstr = "October"; }
			else if ($month == "11") { $monthstr = "November"; }
			else if ($month == "12") { $monthstr = "December"; }
			
			if ($day == "01") { $day = "1st"; }
			else if ($day == "02") { $day = "2nd"; }
			else if ($day == "03") { $day = "3rd"; }
			else if ($day == "04") { $day = "4th"; }
			else if ($day == "05") { $day = "5th"; }
			else if ($day == "06") { $day = "6th"; }
			else if ($day == "07") { $day = "7th"; }
			else if ($day == "08") { $day = "8th"; }
			else if ($day == "09") { $day = "9th"; }
			else if ($day == "21") { $day = "21st"; }
			else if ($day == "22") { $day = "22nd"; }
			else if ($day == "23") { $day = "23rd"; }
			else if ($day == "31") { $day = "31st"; }
			else if ($day == "32") { $day = "32nd"; }
			else if ($day == "33") { $day = "33rd"; }
			else { $day = $day . "th"; }
			echo '<h2>' . $day . ' ' . $monthstr . ' ' . $year . '</h2>';
		}
		$subquery = "SELECT CONTENT_EN FROM changelog_change WHERE PARNT_ID = " . $row[0] . " ORDER BY(ID) DESC";
		$subresult = mysqli_query($connection, $subquery);
		echo '<ul>';
		while ($row2 = mysqli_fetch_array($subresult)) {
			echo '<li>' . $row2[0] . '</li>';
		}
		echo '</ul><br/>';
	}
	echo '<a href="index.php">Back to homepage</a>';
?>
