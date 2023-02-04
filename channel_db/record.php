
<?php
if ((str_replace("/replace", "", $_SERVER["REQUEST_URI"]) == $_SERVER["REQUEST_URI"]) && (str_replace("/delete", "", $_SERVER["REQUEST_URI"]) == $_SERVER["REQUEST_URI"])) {
	include("connect.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/comments.php");

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

	function BTFString($row, $vals, $all_property) {
		echo '<br/><h2 class="mt-3">' . ms("Properties", "Attribuudid") . '</h2>';
		echo '<ul style="list-style-type: none; margin: 0; padding: 0;">';
		foreach ($vals as &$val) {
			echo '<li><span style="display: inline-block; width: 2em;">' . str_replace("n", "0", str_replace("y", "1", str_replace("0", "&#ynn6n;", str_replace("1", "&#ynnn4;", $row[$val])))) . '</span>' .  GetHeader($all_property[$val]) . '';
			if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
				echo '<a style="width: 98%;" class="pencil" href="replace?id=' . $row[0] .'&mod=' . $all_property[$val] . '&bool=1">&nbsp;</a>';
			}
			echo '</li>';
		}
		echo '</ul>';
	}

	if (!empty($_GET["id"])) {
		$id = $_GET["id"];
	}
	$query = "SELECT * FROM channel_db WHERE ID = " . $id;
	if (!empty($_GET["gallery"])) {
		$query = "SELECT * FROM channel_gallery WHERE ID = " . $id;
	}
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
	echo '</div></div></div>';
	if (empty($_GET["gallery"]) && empty($_GET["ideas"])) {
		echo '<div class="container"><div class="card mx-auto" style="width: 90%;"><a class="card-img-top text-center" href="thumbs/' . $row[0] . '.jpg"><img width=500 src="thumbs/' . $row[0] . '.jpg"/></a>';
		echo '<div class="card-body">';
		echo '<h1 class="card-title">' . mui_return($row[2], $row["TitleMUI_et"], $row["TitleMUI_en"]) . '</h1>' .  CheckOwner(ms("TitleMUI_en", "Video"), "Modify title", "Muuda pealkirja", $row[0]);
		$url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';

		echo '<p>' . mui_return($row[1], $row["KanalMUI_et"], $row["KanalMUI_en"]) . CheckOwner(ms("KanalMUI_en", "Kanal"), "Change channel", "Muuda kanalit", $row[0]) . '</p>';
		if ($row["Kirjeldus"] != "N/A") {
			echo CheckOwner(ms("KirjeldusMUI_en", "Kirjeldus"), "Modify description", "Muuda kirjeldust", $row[0]) . '<hr>';
			echo '<p>' . nl2br(preg_replace($url_pattern, '<a href="$0">$0</a>', mui_return($row[5], $row["KirjeldusMUI_et"], $row["KirjeldusMUI_en"]))) . '</p>';
			echo '<hr>';
		}

		$date = explode("-", $row[4]);
		$wordmonth = $date[1];
		for ($i = 0; $i < count($months1); $i++) {
			$wordmonth = str_replace($months1[$i], $months2[$i], $wordmonth);
		}
		if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
			echo CheckOwner("Kuupäev", "Modify date", "Muuda kuupäeva", $row[0]) . '<p>' . ms("Published", "Avaldati") . ': ' . $date[2] . '. ' . $wordmonth . ' ' . $date[0] . '. a';
		} else {
			echo CheckOwner("Kuupäev", "Modify date", "Muuda kuupäeva", $row[0]) . '<p>' . ms("Published", "Avaldati") . ': ' . $wordmonth . ' ' . $date[2] . ' ' . $date[0];
		}
		echo CheckOwner("Filename", "Modify filename", "Muuda failinime", $row[0]) . CheckOwner(ms("CategoryMUI_en", "Category"), "Modify category", "Muuda kategooriat", $row[0]) . '<br/>';
		if (empty($_COOKIE["lang"]) || ($_COOKIE["lang"] != "et-EE")) {
			echo 'Filename: ';
		} else {
			echo 'Failinimi: ';
		}
		if ($row["Filename"] != "N/A") {
			echo $row["Filename"];
		} else {
			echo '<span style="color: #ff0;">' . ms("not archived", "pole arhiveeritud") . '</span>';
		}
		echo '<br/>';
		if (empty($_COOKIE["lang"]) || ($_COOKIE["lang"] != "et-EE")) {
			echo 'Category: ';
		} else {
			echo 'Kategooria: ';
		}
		echo mui_return($row["CategoryMUI_en"], $row["Category"], $row["CategoryMUI_en"]);
		echo '</p>';
		if ($row["URL"] != "N/A") {
			echo CheckOwner("URL", "Modify YouTube URL", "Muuda YouTube URL", $row[0]) . CheckOwner("OdyseeURL", "Modify Odysee URL", "Muuda Odysee URL", $row[0]) . '<br/><a class="btn btn-primary mx-2" target="_blank" href="' . $row[10] .  '">' . ms("Open video", "Ava video") . ' (YouTube)</a>';
		}
		if ($row["OdyseeURL"] != "N/A") {
			echo '<a class="btn btn-primary mx-2" target="_blank" href="' . $row["OdyseeURL"] .  '">' . ms("Open video", "Ava video") . ' (Odysee)</a>';
		}
		echo '<a class="btn btn-primary mx-2" href="' . str_replace("&id=" . $row[0], "", $_SERVER["REQUEST_URI"]) . '">' . ms("Go back", "Tagasi") . '</a>';
		if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		echo '<h2 class="mt-3">' . ms("Management", "Haldamine") . '</h2>';
		echo '<a class="btn btn-danger mx-2" href="delete?id=' . $row[0] .'&failsafeuserconfirmdelete=1">' . ms("Delete this video from the database", "Kustuta see video andmebaasist") . '</a>';
		echo '<a class="btn btn-success mx-2" href="add?temp_id=' . $row[0] .'">' . ms("Use this video as the template for a new one", "Kasuta seda videot uue mallina") . '</a>';
		}
		BTFString($row, array(3, 6, 7, 8, 9), $all_property);

		if ($row["Tags"] != "") {
		echo CheckOwner("Tags", "Change tags", "Muuda silte", $row[0]) . '<h2 class="mt-3">' . ms("Tags", "Sildid") . '</h2><p>';
		foreach (explode(",", $row["Tags"]) as $tag) {
			echo "<span class=\"bg-secondary mx-1 badge badge-pill badge-primary\">${tag}</span>";
		}
		echo '</p>';
		}
		echo '<h2 class="mt-3">' . ms("Comments", "Kommentaarid") . '</h2>';

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
	} else if (!empty($_GET["gallery"])) {
		echo '<div class="container"><div class="card mx-auto" style="width: 90%;">';
		echo '<div class="card-body">';
		echo '<h1 class="card-title">' .  $row["Kanal"] . '</h1>';

		$date = explode("-", $row["Loomiskuupäev"]);
		$wordmonth = $date[1];
		for ($i = 0; $i < count($months1); $i++) {
			$wordmonth = str_replace($months1[$i], $months2[$i], $wordmonth);
		}
		if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
			echo '<p>' . ms2("Creation date", "Loomiskuupäev") . ': ' . $date[2] . '. ' . $wordmonth . ' ' . $date[0] . '. a</p>';
		} else {
			echo '<p>' . ms2("Creation date", "Loomiskuupäev") . ': ' . $wordmonth . ' ' . $date[2] . GetEnd($date[2]) . ' ' . $date[0] . '</p>';
		}
		echo '<p>Logode ajalugu:</p>';
		for ($i = 1; $i < 99; $i++) {
			if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/channel_db/gallery/logos/" . $row[0] . "/" . $i . ".png")) {
				echo "<a href=\"gallery/logos/" . $row[0] . "/" . $i . ".png\"><img src=\"gallery/logos/" . $row[0] . "/" . $i . ".png\" style=\"width: 200px;\"></a>";
			}
		}
		echo '<hr>';
		echo '<p>' . nl2br($row["Kirjeldus"]) . '</p>';
		echo '<hr>';
		echo '<span>URL: <a href="' . $row["URL"] . '">' . $row["URL"] . '</a></span>';
		echo '<br/><br/><a class="btn btn-primary" href="' . str_replace("&id=" . $row[0], "", $_SERVER["REQUEST_URI"]) . '">' . ms2("Go back", "Tagasi") . '</a><br/><br/>';
		if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		echo '<h1>' . ms2("Management", "Haldamine") . '</h1><ul>';
		echo '<li><a href="delete?gallery=1&id=' . $row[0] .'&failsafeuserconfirmdelete=1&gallery=1">' . ms2("Delete this idea from the database", "Kustuta see idee andmebaasist") . '</a></li>';
		echo '<li><a href="add?gallery=1&temp_id=' . $row[0] .'">' . ms2("Use this idea as the template for a new one", "Kasuta seda ideed uue mallina") . '</a></li>';
		echo '<br/>';
		echo '<li><a href="replace?id=' . $row[0] .'&mod=Kanal&gallery=1">' . ms2("Modify channel", "Muuda kanalit") . '</a></li>';
		echo '<li><a href="replace?id=' . $row[0] .'&mod=Kirjeldus&gallery=1">' . ms2("Modify description", "Muuda kirjeldust") . '</a></li>';
		echo '<li><a href="replace?id=' . $row[0] .'&mod=Loomiskuupäev&gallery=1">' . ms2("Modify date", "Muuda kuupäeva") . '</a></li>';
		echo '<li><a href="replace?id=' . $row[0] .'&mod=URL&gallery=1">' . ms2("Modify URL", "Muuda URL-i") . '</a></li>';
		echo '<br/>';
		echo '<li><a href="replace?id=' . $row[0] .'&mod=Kustutatud&gallery=1">' . ms2("Modify property", "Muuda attribuuti") . ': ' . ms2("Deleted", "Kustutatud") . '</a></li>';
		echo '</ul>';
		}
		BTFString($row, array(5), $all_property);
	} else if (!empty($_GET["ideas"])) {
		echo '<div class="container"><div class="card mx-auto" style="width: 90%;">';
		echo '<div class="card-body">';
		$query = "SELECT * FROM channel_ideas WHERE ID = " . $id;
		$cnt = mysqli_query($connection, $query);
		$result = mysqli_query($connection, $query);
		$all_property = array();
		while ($property = mysqli_fetch_field($result)) {
			array_push($all_property, $property->name);
		}
		$row = mysqli_fetch_array($cnt);
		echo '<h1 class="card-title">' . $row["Video"] . '</h1>';
		echo '<p>' . $row["Kanal"] . '</p>';
		echo '<hr>';
		echo '<p>' . nl2br($row["Kirjeldus"]) . '</p>';
		echo '<hr>';
		echo '<a class="btn btn-primary" href="' . str_replace("&id=" . $row[0], "", $_SERVER["REQUEST_URI"]) . '">' . ms2("Go back", "Tagasi") . '</a><br/><br/>';
		if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		echo '<h1>' . ms2("Management", "Haldamine") . '</h1>';
		echo '<a class="btn btn-danger mx-2" href="delete?ideas=1&id=' . $row[0] .'&failsafeuserconfirmdelete=1">' . ms2("Delete this idea from the database", "Kustuta see idee andmebaasist") . '</a>';
		echo '<a class="btn btn-success mx-2" href="add?ideas=1&temp_id=' . $row[0] .'">' . ms2("Use this idea as the template for a new one", "Kasuta seda ideed uue mallina") . '</a>';
		echo '<br/><br/>';
		echo '<a class="btn btn-secondary mx-2" href="replace?id=' . $row[0] .'&mod=Video&ideas=1">' . ms2("Modify title", "Muuda pealkirja") . '</a>';
		echo '<a class="btn btn-secondary mx-2" href="replace?id=' . $row[0] .'&mod=Kanal&ideas=1">' . ms2("Modify channel", "Muuda kanalit") . '</a>';
		echo '<a class="btn btn-secondary mx-2" href="replace?id=' . $row[0] .'&mod=Kirjeldus&ideas=1">' . ms2("Modify description", "Muuda kirjeldust") . '</a>';
		echo '<a class="btn btn-secondary mx-2" href="replace?id=' . $row[0] .'&mod=Klass&ideas=1">' . ms2("Modify class", "Muuda klassi") . '</a>';
		echo '<br/><br/>';
		echo '<a class="btn btn-secondary mx-2" href="replace?id=' . $row[0] .'&mod=Valmis&ideas=1">' . ms2("Modify property", "Muuda attribuuti") . ': ' . ms2("Done", "Valmis") . '</a>';
		echo '<a class="btn btn-secondary mx-2" href="replace?id=' . $row[0] .'&mod=Ülekanne&ideas=1">' . ms2("Modify property", "Muuda attribuuti") . ': ' . ms2("Live stream", "Otseülekanne") . '</a>';
		}
		BTFString($row, array(3, 6), $all_property);
	}
	echo '<br/>';
	echo '<br/>';
	echo '<br/>
			</div>
			</div>';
}
?>
