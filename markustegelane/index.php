<?php
	session_start();
    $fullaccess = FALSE;
    include("../maintenance.php");
    include("../mobcheck.php");
    if ((!empty($_SESSION)) && ($_SESSION["level"] == "owner")) { $fullaccess = TRUE; }
?>
<!DOCTYPE html>
<html lang="et">
	<head>
		<title>markustegelane</title>
		<?php
			$theme = "light";
			if (!empty($_COOKIE["theme"])) {
				$theme = $_COOKIE["theme"];	
			}
		?>
		
<?php
if ($isMob) {
        echo '<link rel="stylesheet" href="common/themes/' . $_COOKIE["theme"] . '_m.css"/>';
    } else {
        echo '<link rel="stylesheet" href="common/themes/' . $_COOKIE["theme"] . '.css"/>';
    }?>
	</head>
	<body onkeydown="keydown_handle(event)" onkeyup="keyup_handle(event)">
	<a href="#Liigu_sisu_juurde" tabindex="1" title="Liigu põhisisu juurde"></a>
	<a href="#Navigatsiooniriba" tabindex="2" title="Navigatsiooniriba"></a>
	<a href="#Vasakud_alumised_nupud" tabindex="2" title="Vasakud alumised nupud"></a>
		<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a>
	<br>
		<?php 
		ini_set('display_errors', '0');
		$lang = "en-US";
		if (!empty($_COOKIE["lang"])) {
			$lang = $_COOKIE["lang"];
		}
		include("content/" . $lang . "/navbar.php");?>
		<section id="Liigu_sisu_juurde">
		<div class="mainpage">
			<?php
				$pages = "123456789";
				$page = "home";
				if (!empty($_GET["doc"])) {
					$page = $_GET["doc"];
				}
				if (!empty($_GET["s"])) {
					$pages = $_GET["s"];
				}
				if (($pages == "123456789") && ($page == "home")) {
					$pages = "145";
				}
				if ($page == "home") {
					include("common/connect.php");
					$query = "SELECT ename, etime, echannel, eurl FROM schedules";
					$result = mysqli_query($connection, $query);
					$cy = date("Y");
					$cm = date("m");
					$cd = date("d");
					$th = date("H");
					$tm = date("i");
					$ts = date("s");
					while ($e = mysqli_fetch_array($result)) {
						$row = $e;
						$state = "notlive";
				 		$dd = explode("-", explode(" ", $row[1])[0])[2];
				 		$dm = explode("-", explode(" ", $row[1])[0])[1];
				 		$dy = explode("-", explode(" ", $row[1])[0])[0];
				 		$delta_h = explode(":", explode(" ", $row[1])[1])[0] - $th;
				 		$delta_m = explode(":", explode(" ", $row[1])[1])[1] - $tm;
				 		$delta_s = explode(":", explode(" ", $row[1])[1])[2] - $ts;
				 		$delta_t = $delta_h * 60 * 60 + $delta_m * 60 + $delta_s;
				 		if (($dd >= $cd) && ($dm >= $cm) && ($dy >= $cy)) {
				 			if ($dd - $cd == 0) {
					 			if ($delta_t >= -10000) {
				 					$state = "soon";
				 				}
				 				else if (($delta_t >= -10000) && ($delta_t <= -7200)) {
				 					$state = "ending";
				 				}
				 				else if ($delta_t < 3600) {
				 					if ($delta_t > 0) {
					 					$state = "verysoon";
					 				} else {
					 					if ($delta_t >= -10000) {
					 						$state = "live";
					 					}
					 				}
				 				}
				 			} else {
					  			$state = "upcoming";
							}
				 		}
					}
					if (($state != "notlive")  && ($state != "upcoming")) {
						$time = explode(":", explode(" ", $row[1])[1]);
						if ($lang == "et-EE") {
						 	echo '<h2>Otseülekanne: ' . $row[0] . '</h2>';
						 	echo '<p>Algus täna kell '. $time[0] . ":" . $time[1] . '</p>';
							echo '<a href="' . $row[3] . '">Ülekande link</a>';
						} else if ($lang == "en-US") {
						 	echo '<h2>Live stream: ' . $row[0] . '</h2>';
						 	echo '<p>Today at '. $time[0] . ":" . $time[1] . ' (UTC+2)</p>';
							echo '<a href="' . $row[3] . '">Stream link</a>';
						}
					} else if ($state == "upcoming") {
						$time = explode(":", explode(" ", $row["etime"])[1]);
						$nd = $dd - $cd;
						if ($lang == "et-EE") {
							switch ($nd) {
								case 2:
									$str_time = "ülehomme";
									break;
								case 1:
									$str_time = "homme";
									break;
								default:
									$str_time = $nd . " päeva pärast";
									break;
							}
						 	echo '<h2>Otseülekanne: ' . $row["ename"] . '</h2>';
						 	echo '<p>Algab ' . $str_time . ' kell '. $time[0] . ":" . $time[1] . '</p>';
							echo '<a href="' . $row["eurl"] . '">Ülekande link</a>';
						} else if ($lang == "en-US") {
							switch ($nd) {
								case 2:
									$str_time = "The day after tomorrow";
									break;
								case 1:
									$str_time = "Tommorrow";
									break;
								default:
									$str_time = "After " . $nd . " days";
									break;
							}
						 	echo '<h2>Live stream: ' . $row[0] . '</h2>';
						 	echo '<p>' . $str_time . ' at '. $time[0] . ":" . $time[1] . ' (UTC+2)</p>';
							echo '<a href="' . $row[3] . '">Stream link</a>';
						}
						
					}
				}
				for ($i = 1; $i < 10; $i++) {
					if (preg_match('/' . $i . '/i', $pages)) {
						if (file_exists("content/" . $lang . "/" . $page . "/" . $i . ".php")) {
							include("content/" . $lang . "/" . $page . "/" . $i . ".php");
						} else {
							if ($i == 1) {
								include("errors/" . $lang . "/notfound.php");
							}
						}
					}
				}
                if ($fullaccess)
                {
                    if (empty($_GET["doc"])) { $sdoc = "home"; } else {
                    $sdoc = $_GET["doc"];
                    }
                    if (empty($_GET["s"])) {
                    $sct = 1;
                    } else {
                    $sct = $_GET["s"];
                    }
                    echo '<hr><a href="?doc=development&subdoc=' . htmlspecialchars($sdoc, ENT_QUOTES, 'UTF-8') . '&section=' . $sct . '">';
                    if ((!empty($_COOKIE)) && ($_COOKIE["lang"] == "et-EE"))
                    {
                        echo 'Muuda seda lehte';
                    } else {
                        echo 'Modify this page';
                    }
                    echo '</a><br/>';
                    echo '<a href="?doc=development&s=2">';
                    if ((!empty($_COOKIE)) && ($_COOKIE["lang"] == "et-EE"))
                    {
                        echo 'Muuda teemasid';
                    } else {
                        echo 'Modify themes';
                    }
                    echo '</a><br/>';
                }
			?>
		</div>
		</section>
		<?php
            if ($isMob) {
                echo "<div class=\"mainpage\"><a href=\"" . $_SERVER["REQUEST_URI"] . "&desktop=1\">";
                if ($lang == "et-EE") {
                        echo "Arvutiversioon";
                } else {
                        echo "Desktop version";
                }
                echo "</a></div>";
            }
		?>
	</body>
</html>
