<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
if (!empty($_GET["collection"])) {
	if ($_GET["collection"] == "dloads") {
		echo "::\r\n:: This file stores batch file store metadata\r\n::\r\n:: Do not delete or change its sharing information in Google Drive\r\n::\r\n:: Local deletion or any modification is completely safe (don't modify download IDs)\r\n::\r\nset scolor=0f\r\nset aboutcolor=0a\r\nset updatecolor=0b\r\nset pcolor=0e\r\nset pageval=1\r\nset \"smessage=\"\r\n";
		$query = "SELECT * FROM dloads LEFT JOIN dlinks ON dloads.ID = dlinks.DLOAD WHERE DTYPE <> 4";
		$result = mysqli_query($connection, $query);
		$i = 1;
		while ($row = mysqli_fetch_array($result)) {
			if ((!str_contains($row["LINK_URI"], "drive.google.com")) && (str_contains(substr($row["LINK_URI"], -5, 5), "."))) {
				if ($row["MUI_DTITLE"] != "") {
					echo "set \"name" . $i . "=" . $row["MUI_DTITLE"] . "\"\r\n";
				} else {
					echo "set \"name" . $i . "=" . $row["DTITLE"] . "\"\r\n";
				}
				if ($row["MUI_DDESC"] != "") {
					echo "set \"desc" . $i . "=" . $row["MUI_DDESC"] . "\"\r\n";
				} else {
					echo "set \"desc" . $i . "=" . $row["DDESC"] . "\"\r\n";
				}
				echo "set \"check" . $i . "=" . strtoupper($row["CHKSUM"]) . "\"\n";
				if (str_starts_with($row["LINK_URI"], "/")) {
					echo "set \"url" . $i . "=https://markustegelane.online" . $row["LINK_URI"] . "\"\r\n";
				} else {
					echo "set \"url" . $i . "=" . $row["LINK_URI"] . "\"\r\n";
				}
				$url_parts = explode("/", $row["LINK_URI"]);
				$filename = str_replace("%20", "_", $url_parts[count($url_parts)-1]);
				echo "set \"file" . $i . "=" . $filename . "\"\r\n";
				echo "set \"cat" . $i . "=" . $row["DTYPE"] . "\"\r\n\r\n";
				$i++;
			}
		}
		echo "set \"updateserver=http://markustegelane.ml/bstore/LogOS.bat\"\r\n";
	} else if ($_GET["collection"] == "blog") {
		$query = "SELECT * FROM eblog ORDER BY(id) DESC";
		$result = mysqli_query($connection, $query);
		$i = 1;
		echo "::\r\n:: Data for blog posts for batch store and viewer\r\n::\r\n:: Do not change or remove sharing information\r\n::\r\n:: Local edits are completely safe\r\n::\r\nset pcolor=0e\r\n";
		while ($row = mysqli_fetch_array($result)) {
			echo "set \"post" . $i . "=" . str_replace("\n", "", str_replace("&nbsp;", " ", strip_tags($row["title"]))) . "\"\r\n";
			$letters = "abcdefghijklmnopqrstuvwxyz";
			$fullpost = explode("\n", str_replace("&quot;", "'", str_replace("&nbsp;", " ", strip_tags($row["body"]))));
			echo "set \"inpost" . $i . "=" . $fullpost[0] . "\"\r\n";
			$ltr_idx = 0;
			$past_first = false;
			$chars = 0;
			if (count($fullpost) > 1) {
				foreach ($fullpost as &$line) {
					if ($line != "") {
						
						if ($past_first) {
							$chars += strlen($line);
							if ($chars < 1500) {
									if ($ltr_idx < strlen($letters)) {
										echo "set \"inpost" . $i . $letters[$ltr_idx] . "=" . $line . "\"\r\n";
										$ltr_idx ++;
									}
							}
						} else {
							$past_first = true;
						}
					}
				}
			}
			$i++;
		}
	} else if ($_GET["collection"] == "version") {
		echo "set newersion=1.35\r\n";
	}
}
?>