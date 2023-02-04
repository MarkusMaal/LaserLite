<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
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
	if ((!empty($_GET["delcookies"])) && ($_GET["delcookies"] == "1")) {
		$lang = "en-US";
		if (!empty($_COOKIE["lang"])) {
			$lang = $_COOKIE["lang"];
		}
		$_SESSION = array();
		session_destroy();
		setcookie('lang', '', -1, '/'); 
		setcookie('theme', '', -1, '/');
		setcookie('name', '', -1, '/');
		setcookie('username', '', -1, '/');
		setcookie('mobile_mode', '', -1, '/');
		unset($_COOKIE["lang"]);
		unset($_COOKIE["theme"]);
		unset($_COOKIE["name"]);
		unset($_COOKIE["mobile_mode"]);
		echo "<div style=\"position: fixed; bottom: 0px; left: 0px; width: 100%; background: linear-gradient(90deg, #008a, #0000, #0080); padding: 1em; text-align: left;\">Cookies deleted. // Küpsised kustutati.</div>";
	}
	$lang = "en-US";
	if (!empty($_COOKIE["lang"])) {
		$lang = $_COOKIE["lang"];
	}
	$theme = "blue";
	if (!empty($_COOKIE["theme"])) {
		$theme = $_COOKIE["theme"];
	}
	$old_theme = "false";
	if (!empty($_COOKIE["old_theme"])) {
		$old_theme = $_COOKIE["old_theme"];
	}
	$soundMode = "all";
	if (!empty($_COOKIE["soundmode"])) {
		$soundMode = $_COOKIE["soundmode"];
	}
	if (!empty($_GET["smode"])) {
		setcookie("soundmode", $_GET["smode"], time()+2678400, "/");
		$soundMode = $_GET["smode"];
	}
	
	$gfxMode = "nice";
	if (!empty($_COOKIE["gfx"])) {
		$gfxMode = $_COOKIE["gfx"];
	}
	if (!empty($_GET["gfx"])) {
		setcookie("gfx", $_GET["gfx"], time()+2678400, "/");
		$gfxMode = $_GET["gfx"];
	}
?>

<!DOCTYPE html>
<html lang="<?php if ($lang == "et-EE") { echo "et"; } else { echo "en"; } ?>">
<head><title><?php if ($lang == "et-EE") { echo "Markuse videod productions - avaleht"; } else { echo "Markus' videos productions - home page"; } ?></title>

	<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  include("getcookies.php");
	  include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/themes/theme.php"); ?>
</head>
<body>
		<table style="margin-left:0px; width: 100%;">
		<tr style="float: left; width: 100%;">
		<td>
		<img style="width: 5em;" src="/markustegelane/common/config/gfx/gears.svg">
		</td>
		<td>
		<h1 style="padding-top: 0px;"><?php echo ms("Settings", "Seaded"); ?></h1>
		</td>
		</tr>
		<tr style="background: #<?php if ($theme == "blue") { echo '00f'; } else if ($theme == "light") { echo '888'; } else { echo '555'; } ?>2; width: 100%;">
		<td colspan="2">
		<?php 
			echo '<a href="/"><div class="button" style="margin-top: 0em;">';
			if ($lang == "en-US")
			{
				echo 'Home page';
			} else {
				echo 'Avaleht';
			}
			echo '</div></a>'; ?>
		</td>
		</tr>
		</table>
		<hr>
		<hr style="border-color: <?php
		
		switch ($theme) {
			case "blue":
				echo '#00e';
				break;
			case "light":
				echo '#eee';
				break;
			case "dark":
				echo '#888';
				break;
		}
				?>;">
		<div class="cut">
		<div class="cont">
			<div>
			<?php
			echo '<h1>' . ms("General", "Üldine") . '</h1>';
			echo '<div class="setting">';
			echo ms("Theme", "Kujundus");
			echo ':<br /><br />';
			if ($old_theme == "false") {
				echo '<div class="nobutton">' . ms("Laserlight", "Laservalgus") . '</div> ';
				echo '<a href="chlayout.php?redir=1&val=true"><div class="button">' . ms("Classic", "Klassikaline") . '</div></a> ';
				echo '<a href="chlayout.php?redir=1&val=new"><div class="button">' . ms("Experimental", "Eksperimentaalne") . '</div></a>';
			} else if ($old_theme == "true") {
				echo '<a href="chlayout.php?redir=1&val=false"><div class="button">' . ms("Laserlight", "Laservalgus") . '</div></a> ';
				echo '<div class="nobutton">' . ms("Classic", "Klassikaline") . '</div> ';
				echo '<a href="chlayout.php?redir=1&val=new"><div class="button">' . ms("Experimental", "Eksperimentaalne") . '</div></a>';
			} else if ($old_theme == "new") {
				echo '<a href="chlayout.php?redir=1&val=false"><div class="button">' . ms("Laserlight", "Laservalgus") . '</div></a> ';
				echo '<a href="chlayout.php?redir=1&val=true"><div class="button">' . ms("Classic", "Klassikaline") . '</div></a> ';
				echo '<div class="nobutton">' . ms("Experimental", "Eksperimentaalne") . '</div>';
				echo '<div style="flex-direction: column; justify-content: center; display: flex; margin-top: 0.65em;"><span style="color: red">' . ms("Warning: ", "Hoiatus: ") . '</span>' . ms("The experimental theme is still in development phase and many parts of the web page may be broken.", "Eksperimentaalteema on endiselt arendusfaasis ning paljud veebisaidi osad võivad selles teemas olla katki."). '</div>';
			}
			echo '</div>';
			echo '<div class="setting">';
			echo ms("Language", "Keel");
			echo ':<br /><br />';
			if ($lang == "et-EE") {
				echo '<div class="nobutton">eesti</div> ';
				echo '<a href="chlang.php?redir=1"><div class="button">inglise</div></a></div>';
			} else {
				echo '<a href="chlang.php?redir=1"><div class="button">Estonian</div></a> ';
				echo '<div class="nobutton">English</div></div>';
			}
			echo '<div class="setting">';
			echo ms("Color scheme", "Värviskeem");
			echo ': <br/><br/>';
			if ($thm == "dark") { echo '<div class="nobutton">' . ms("Dark", "Tume") . '</div> '; } else { echo '<a href="chthm.php?redir=1&type=dark"><div class="button">' . ms("Dark", "Tume") . '</div></a>'; }
			if ($old_theme != "true") {
				if ($thm == "light") { echo '<div class="nobutton">' . ms("Light", "Hele") . '</div> '; } else { echo '<a href="chthm.php?redir=1&type=light"><div class="button">' . ms("Light", "Hele") . '</div></a>'; }
			} else {
				if ($thm == "light") { echo '<div class="nobutton">' . ms("Colorful", "Värviline") . '</div> '; } else { echo '<a href="chthm.php?redir=1&type=light"><div class="button">' . ms("Colorful", "Värviline") . '</div></a>'; }
			}
			if (($thm == "blue") || ($thm == "")) { echo '<div class="nobutton">' . ms("Blue", "Sinine") . '</div> '; } else { echo '<a href="chthm.php?redir=1&type=blue"><div class="button">' . ms("Blue", "Sinine") . '</div></a>'; }
			if ($old_theme == "true") {
				if (($thm == "old") || ($thm == "")) { echo '<div class="nobutton">' . ms("Blue (original)", "Sinine (originaal)") . '</div> '; } else { echo '<a href="chthm.php?redir=1&type=old"><div class="button">' . ms("Blue (original)", "Sinine (originaal)") . '</div></a>'; }
				if (($thm == "element") || ($thm == "")) { echo '<div class="nobutton">Element</div> '; } else { echo '<a href="chthm.php?redir=1&type=element"><div class="button">Element</div></a>'; }
				if (($thm == "plus") || ($thm == "")) { echo '<div class="nobutton">' . ms("Plus", "Pluss") . '</div> '; } else { echo '<a href="chthm.php?redir=1&type=plus"><div class="button">' . ms("Plus", "Pluss") . '</div></a>'; }
			}
			echo '</div>';
			echo '<div class="setting"><br/>';
			echo ms('Device', 'Seade');
			echo ': <br/><br/>';
			if ($isMob) {
				echo '<div class="nobutton">' . ms("Mobile mode", "Telefonirežiim") . '</div> ';
				echo '<a href="chdev.php"><div class="button">' . ms("Computer mode", "Arvutirežiim") . '</div></a></div>';
			}
			else {
				echo '<a href="chdev.php"><div class="button">' . ms("Mobile mode", "Telefonirežiim") . '</div></a> ';
				echo '<div class="nobutton">' . ms("Computer mode", "Arvutirežiim") . '</div></div>';
			}
			echo '<h1>';
			echo ms("Games", "Mängud");
			echo '</h1><div class="setting">';
			echo ms("Sound mode", "Helirežiim");
			echo ': <br/><br/>';
			if ($soundMode == "all") {
				echo '<div class="nobutton">' . ms("Music and sound effects", "Muusika ja heliefektid") . '</div>';
				echo '<a href="?smode=sfx"><div class="button">' . ms("Sound effects only", "Ainult heliefektid") . '</div></a>';
				echo '<a href="?smode=none"><div class="button">' . ms("No sound", "Vaigista helid") . '</div></a>';
			}
			else if ($soundMode == "sfx") {
				echo '<a href="?smode=all"><div class="button">' . ms("Music and sound effects", "Muusika ja heliefektid") . '</div></a>';
				echo '<div class="nobutton">' . ms("Sound effects only", "Ainult heliefektid") . '</div>';
				echo '<a href="?smode=none"><div class="button">' . ms("No sound", "Vaigista helid") . '</div></a>';
			}
			else if ($soundMode == "none") {
				echo '<a href="?smode=all"><div class="button">' . ms("Music and sound effects", "Muusika ja heliefektid") . '</div></a>';
				echo '<a href="?smode=sfx"><div class="button">' . ms("Sound effects only", "Ainult heliefektid") . '</div></a>';
				echo '<div class="nobutton">' . ms("No sound", "Vaigista helid") . '</div>';
			}
			echo '</div>';
			echo '<div class="setting">';
			echo ms("Graphics", "Graafika");
			echo ': <br/><br/>';
			if ($gfxMode == "nice") {
				echo '<div class="nobutton">' . ms("Best", "Parim") . '</div>';
				echo '<a href="?gfx=fast"><div class="button">' . ms("Fast", "Kiire") . '</div></a>';
			}
			else if ($gfxMode == "fast") {
				echo '<a href="?gfx=nice"><div class="button">' . ms("Best", "Parim") . '</div></a>';
				echo '<div class="nobutton">' . ms("Fast", "Kiire") . '</div>';
			}
			else {
				echo '<a href="?gfx=nice"><div class="button">' . ms("Best", "Parim") . '</div></a>';
				echo '<a href="?gfx=fast"><div class="button">' . ms("Fast", "Kiire") . '</div></a>';
			}
			echo '</div>';
			echo '<br/><h1>' . ms("Your website data", "Teie andmed veebisaidil") . '</h1>';
			echo '<div class="setting">';
			echo '<p>' . ms("The website data is saved to cookies, which are stored in your web browser's cache", "Veebisaidi andmed salvestatakse küpsistesse, mis asuvad teie brauseri vahemälus. ");
			echo '</p><br/>';
			if ($lang == "et-EE") {
				echo '<a href="cookie/index.php?l=et">';
			} else {
				echo '<a href="cookie/index.php">';
			}
			echo '<div class="button">' . ms("About cookies", "Lisateave küpsistest") . '</div></a> ';
			echo '<a href="?delcookies=1"><div class="button">' . ms("Delete cookies", "Kustuta küpsised") . '</div></a>';
			echo '</div>';
			echo '<h1>' . ms("Management account", "Haldaja konto") . '</h1>';
			echo '<div class="setting">';
			if (empty($_SESSION["usr"])) {
				echo '<p>' . ms("If you are the owner of this website, administrator, or a content moderator, you can manage databases by logging in with a username and password.", "Kui olete selle veebisaidi omanik või sisumoderaator, saate andmebaase hallata logides kasutajanimi ja parooliga sisse.") . '</p>';
				echo '<a href="loginform.php"><div class="button">' . ms("Log in", "Logi sisse") . '</div></a>';
				echo '<a href="../../index.php?doc=feedback&s=3"><div class="button">' . ms("Sign up as a content moderator", "Sisumoderaatoriks registreerumine") . '</div></a>';
			} else {
				echo '<p>Need valikud võimaldavad hallata teie halduskontot:</p>';
				echo '<p>Kasutajanimi: ' . $_SESSION["usr"] . '</p>';
				echo '<p>Kontostaatus: ' . $_SESSION["level"] . '</p>';
				if ($_SESSION["level"] == "owner") {
					echo '<a href="../../index.php?doc=development&s=2"><div class="button">' . ms("Modify cascading style sheets", "Kaskaalaadistike muutmine") . '</div></a>';
					echo '<a href="../../index.php?doc=development&navbar=1"><div class="button">' . ms("Modify navigation bar", "Navigatsiooniriba muutmine") . '</div></a>';
					echo '<a href="../../index.php?doc=development&s=9"><div class="button">' . ms("Modify downloads", "Allalaadimiste muutmine") . '</div></a>';
				}
				if (($_SESSION["level"] == "owner") || ($_SESSION["level"] == "admin")) {
					echo '<a href="../../../x/dev"><div class="button">' . ms("Modify events", "Sündmuste muutmine") . '</div></a>';
				}
				if ($_SESSION["level"] == "owner") {
					echo '<a href="../../../mysql_console"><div class="button">' . ms("MySQL console", "MySQL konsool") . '</div></a>';
					echo '<a href="managers.php"><div class="button">' . ms("Manage accounts", "Halda kontosid") . '</div></a>';
				}
				echo '<a href="update_pass.php"><div class="button">' . ms("Change password", "Muuda parooli") . '</div></a>';
				echo '<a href="logout.php"><div class="button">' . ms("Log out", "Logi välja") . '</div></a>';
				echo '</div>';
				echo '<br/><br/><h1>' . ms("Feedback", "Tagasiside") . '</h1>';
			}
			if (!empty($_SESSION["usr"])) {
				if ((!empty($_SESSION)) && (($_SESSION["level"] == "owner") || ($_SESSION["level"] == "admin"))) {
					echo '<div class="setting"><div class="comment_section">';
					include("../connect.php");
					include("../comments.php");
					$sql = "SELECT * FROM general_comments WHERE THREAD = 4 AND REPLY = 0 ORDER BY(ID) DESC";
					$r1 = mysqli_query($connection, $sql);
					if (mysqli_num_rows($r1) > 0) {
						while ($row = mysqli_fetch_array($r1)) {
							DisplayComments($connection, $row, $row["PAGE_ID"], 0, 4);
						}
					}
					echo '</div></div>';
				} else {
					echo '<span style="float: left; width: 100%;">';
					if ($lang == "et-EE") {
						echo 'Kui olete administraator või omanik, saate näha ja vastata tagasisidesse saadetud kommentaaridele';
					} else {
						echo "If you're an administrator or the owner, you can see and reply to comments sent to feedback";
					}
					echo '</span>';
					echo '</div>';
				}
			} else {
				echo '</div>';
			}
			echo '<br/>';
			?>
		</div>
		</div>
</body>
</html>
