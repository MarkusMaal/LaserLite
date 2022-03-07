 <?php
			if (!empty($_COOKIE["mobile_mode"])) {
                if ($_COOKIE["mobile_mode"] == "true") {
                    $isMob = true;
                } else {
                    $isMob = false;
                }
			} else {
                $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
                $isMob = is_numeric(strpos($ua, "mobile"));
			}
			if (!empty($_GET["desktop"])) {
                if ($_GET["desktop"] == "1") {
                    $isMob = false;
                }
			}
			if (!empty($_GET["mobile"])) {
                if ($_GET["mobile"] == "1") {
                    $isMob = true;
                }
			}
?>
