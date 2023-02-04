<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	$hacking_time = '<head><style>body { background: #000; color: #0f0; font-family: "Hack", "Mono", "Lucida Console"; }</style></head><body><p>You\'re just a dirty hacker, aren\'t you?</p><iframe width="100%" height="75%" src="https://www.youtube-nocookie.com/embed/pgl37R7hILE?autoplay=1&amp;showinfo=0&amp;loop=1&amp;start=2&amp;list=PL6WkVx7vhlogvj4kxSizthqQgxq3j0BmD&amp;rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></body>';
	if (!((!empty($_SESSION["level"])) && ($_SESSION["level"] == "owner"))) {
		foreach($_GET as $key => $value) {
		    if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
				die($hacking_time);
		    }
		}
		if (!empty($_POST)) {
			foreach($_POST as $key => $value) {
				if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
					die($hacking_time);
				}
			}
		}
		if (!empty($_SESSION)) {
			foreach($_SESSION as $key => $value) {
				if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
					die($hacking_time);
				}
			}
		}
		if (!empty($_COOKIE)) {
			foreach($_COOKIE as $key => $value) {
				if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
					die($hacking_time);
				}
			}
		}
	}
	if (empty($_COOKIE["theme"])) { $_COOKIE["theme"] = "blue"; }
	if (empty($_COOKIE["lang"])) { $_COOKIE["lang"] = "en-US"; }
    $fullaccess = FALSE;
    include("../maintenance.php");
    include("../mobcheck.php");
	if (empty($_COOKIE["mobile_mode"])) {
		$_COOKIE["mobile_mode"] = "false";
		if ($isMob) { $_COOKIE["mobile_mode"] = "true"; }
	}
    if ((!empty($_SESSION["level"])) && ($_SESSION["level"] == "owner")) { $fullaccess = TRUE; }
?>
<!DOCTYPE html>
<html lang="et">
	<head>
		<title>markustegelane</title>
		<?php
			$theme = "blue";
			if (!empty($_COOKIE["theme"])) {
				$theme = $_COOKIE["theme"];	
				if ($theme == "") {
					$theme = "blue";
				}
			}
		?>
		<script>
			function bypass_message() {
				document.getElementById("themeprompt").innerHTML = "";
				document.getElementById("themeprompt").style.display = "none";
			}
		</script>
		
<?php
if ($isMob) {
        echo '<link rel="stylesheet" href="common/themes/' . $_COOKIE["theme"] . '_m.css"/>';
    } else {
        echo '<link rel="stylesheet" href="common/themes/' . $_COOKIE["theme"] . '.css"/>';
    }?>
	</head>
	<body>
	
	<a href="#Liigu_sisu_juurde" tabindex="1" title="Liigu põhisisu juurde"></a>
	<a href="#Navigatsiooniriba" tabindex="2" title="Navigatsiooniriba"></a>
	<a href="#Vasakud_alumised_nupud" tabindex="2" title="Vasakud alumised nupud"></a>
	<div class="broken" id="themeprompt" style="position:fixed; bottom: 0px; background: #006; color: #fff; width: 100%; padding: 10px; z-index: 20; margin-left: 0px; font-family: Arial;">
	<?php
	if ($_COOKIE["lang"] == "et-EE") {
		echo 'Kas veebilehte ei kuvata õigesti? Kui jah, siis ';
	} else {
		echo 'Is the page not displaying correctly? If so, then ';
	}
	?>
	<a href="common/config/chthm.php"><?php if ($_COOKIE["lang"] == "et-EE") {
		echo 'klõpsake siia';
	} else {
		echo 'click here';
	}?></a>
	<?php
	if ($_COOKIE["lang"] == "et-EE") {
		echo '. Kui kõik tundub õige, siis ';
	} else {
		echo '. If everything seems to be correct, then ';
	}
	?><a href="#/" onclick="bypass_message();"><?php
	if ($_COOKIE["lang"] == "et-EE") {
		echo 'sulgege see teade';
	} else {
		echo 'close this message';
	}
	?></a><?php
	if ($_COOKIE["lang"] == "et-EE") {
		echo ' ja teavitage probleemist <a href="?doc=feedback&s=1">tagasiside lehel';
	} else {
		echo ' and report the issue using the <a href="?doc=feedback&s=1">feedback page';
	}
	?></a>.
	</div>
		<a href="index.php"><img center style="padding: 4vh;" class="banner" src="gfx/banner.svg" alt="Soul core storage unit with smoke coming out next to the markustegelane text, which is glowing, filled with white noise, while also having smoke coming out of it."></a>
	<br>
		<?php 
		ini_set('display_errors', '0');
		$lang = "en-US";
		if (!empty($_COOKIE["lang"])) {
			$lang = $_COOKIE["lang"];
		}
		include("content/" . $lang . "/navbar.php");?>
		<a href="/" style="position: fixed; top: 10px; left: 10px; z-index: 1;">
		<?php 
			if ($lang == "et-EE") {
				echo '&lt; Tagasi avalehele';
			} else {
				echo '&lt; Go back';
			}
		?>
		</a>
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
					$pages = "4";
				}
				if ($page == "home") {
					include("common/connect.php");
					$query = "SELECT ename, etime, echannel, eurl FROM schedules";
					$result = mysqli_query($connection, $query);
					$cy = date("Y");
					$cm = date("n");
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
						$d_mon = explode("-", explode(" ", $row[1])[0])[1];
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
							} else if ($d_mon - $cm == 0) {
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
