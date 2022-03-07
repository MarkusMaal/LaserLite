<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
      if ((!empty($_GET["delcookies"])) && ($_GET["delcookies"] == "1")) {
        $_SESSION = array();
        session_destroy();
        setcookie('lang', '', -1, '/'); 
        setcookie('theme', '', -1, '/');
        setcookie('name', '', -1, '/');
        setcookie('mobile_mode', '', -1, '/');
        unset($_COOKIE["lang"]);
        unset($_COOKIE["theme"]);
        unset($_COOKIE["name"]);
        unset($_COOKIE["mobile_mode"]);
    	echo '<meta http-equiv="Refresh" content="0; URL=/index.php">';
      }
    if (empty($_COOKIE["lang"])) {
    	echo '<meta http-equiv="Refresh" content="0; URL=/markustegelane/common/config/cookie">';
        die();
    }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  include("getcookies.php");
      include("../../../mobcheck.php");
      ?>
<title>
<?php
if ($lang == "et-EE") {
	echo "Seaded";
} else {
	echo "Settings";
}
?></title>
<?php
if ($isMob) {
        echo '<link rel="stylesheet" href="../themes/' . $_COOKIE["theme"] . '_m.css"/>';
    } else {
        echo '<link rel="stylesheet" href="../themes/' . $_COOKIE["theme"] . '.css"/>';
    }?>
</head>
<body>
		<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
		<div class="mainpage">
			<?php
			if ($lang == "et-EE") {
				echo '<h1>Seaded</h1>';
				echo 'Praegune keel: eesti<br/>';
				echo '<a href="chlang.php">Muuda</a>';
					echo '<br/><br/>Praegune teema: ';
				if ($thm == "dark") {
					echo 'Tume';
				} else if ($thm == "blue") {
					echo 'Sinine';
				} else {
					echo 'Hele';
				}
				echo '<br/><a href="chthm.php">Muuda</a><br/>';
				echo '<br/>Kujundus: ';
                if ($isMob) {
                    echo 'Telefon';
                }
                else {
                    echo 'Arvuti';
                }
                echo '<br/>';
                echo '<a href="chdev.php">';
				if ($isMob) {
                    echo 'Arvutirežiim';
				} else {
                    echo 'Telefonirežiim';
                }
				echo '</a><br/>';
				echo '<h2>Veebisaidi andmed</h2>';
				echo '<p>Veebisaidi andmed salvestatakse küpsistesse, mis asuvad teie brauseri vahemälus. ';
				echo '<br/><a href="cookie/index.php?l=et">Lisateave küpsistest</a></p>';
				echo '<p>Soovi korral saate need <a href="?delcookies=1">kustutada</a>';
				echo '<h2>Halduskonto</h2>';
				if (empty($_SESSION["usr"])) {
					echo '<p>Kui olete selle veebisaidi omanik või sisumoderaator, saate andmebaase hallata logides kasutajanimi ja parooliga sisse. Kõik ebaõnnestunud sisselogimiskatsed logitakse serverisse.</p>';
					echo '<a href="loginform.php">Logi sisse</a>';
					echo '<br/><a href="../../index.php?doc=feedback&s=3">Sisumoderaatoriks registreerumine</a>';
				} else {
					echo '<p>Need valikud võimaldavad hallata teie halduskontot:</p>';
					echo '<p>Kasutajanimi: ' . $_SESSION["usr"] . '</p>';
					echo '<p>Kontostaatus: ' . $_SESSION["level"] . '</p>';
					if ($_SESSION["level"] == "owner") {
						echo '<a href="../../index.php?doc=development&s=1">Veebisaidi põhisisu muutmine</a><br/>';
						echo '<a href="../../index.php?doc=development&s=2">Kaskaadlaadistike muutmine</a><br/>';
						echo '<a href="../../index.php?doc=development&s=9">Allalaadimiste muutmine</a><br/>';
					}
					if (($_SESSION["level"] == "owner") || ($_SESSION["level"] == "admin")) {
						echo '<a href="../../../x/dev">markustegelane x sündmuste muutmine</a><br/>';
					}
					if ($_SESSION["level"] == "owner") {
						echo '<a href="../../../mysql_console">MySQL konsool</a><br/>';
						echo '<a href="managers.php">Halda kontosid</a><br/>';
					}
					echo '<a href="update_pass.php">Muuda parooli</a><br/>';
					echo '<a href="logout.php">Logi välja</a>';
					echo '<br/><br/><h2>Tagasiside</h2>';
				}
			} else if ($lang == "en-US") {
				echo '<h1>Settings</h1>';
				echo 'Current language: English<br/>';
				echo '<a href="chlang.php">Change</a>';
					echo '<br/><br/>Current theme: ';
				if ($thm == "dark") {
					echo 'Dark';
				} else if ($thm == "blue") {
					echo 'Blue';
				} else {
					echo 'Light';
				}
				echo '<br/><a href="chthm.php">Change</a><br/>';
				echo '<br/>Layout: ';
                if ($isMob) {
                    echo 'Mobile';
                }
                else {
                    echo 'Desktop';
                }
                echo '<br/>';
                echo '<a href="chdev.php">';
				if ($isMob) {
                    echo 'Desktop mode';
				} else {
                    echo 'Mobile mode';
                }
				echo '</a><br/>';
				echo '<h2>Website data</h2>';
				echo "<p>Website data is saved in cookies, which are stored in your browser's cache.";
				echo '<br/><a href="cookie">More info about cookies</a></p>';
				echo '<p>If you want to, you can <a href="?delcookies=1">delete</a> cookies';
				echo '<h2>Management account</h2>';
				if (empty($_SESSION["usr"])) {
					echo '<p>If you are the owner or a content moderator of this web site, you can manage databases by logging in using a username and password. Any invalid login attempts will be logged on the server.</p>';
					echo '<a href="loginform.php">Log in</a>';
					echo '<br/><a href="../../index.php?doc=feedback&s=3">Sign up as a content moderator</a>';
				} else {
					echo '<p>Options below will let you manage your management account:</p>';
					echo '<p>Username: ' . $_SESSION["usr"] . '</p>';
					echo '<p>Account status: ' . $_SESSION["level"] . '</p>';
					if ($_SESSION["level"] == "owner") {
						echo '<a href="../../index.php?doc=development&s=1">Modify main website content</a><br/>';
						echo '<a href="../../index.php?doc=development&s=2">Modify cascading stylesheets</a><br/>';
						echo '<a href="../../index.php?doc=development&s=9">Modify downloads</a><br/>';
					}
					if (($_SESSION["level"] == "owner") || ($_SESSION["level"] == "admin")) {
						echo '<a href="../../../x/dev">Modify events</a><br/>';
					}
					echo '<a href="update_pass.php">Change password</a><br/>';
					if ($_SESSION["level"] == "owner") {
						echo '<a href="../../../mysql_console">MySQL console</a><br/>';
						echo '<a href="managers.php">Manage accounts</a><br/>';
					}
					echo '<a href="logout.php">Log out</a>';
					echo '<br/><br/><h2>Feedback</h2>';
				}
			}
			if (!empty($_SESSION["usr"])) {
				if ((!empty($_SESSION)) && (($_SESSION["level"] == "owner") || ($_SESSION["level"] == "admin"))) {
					include("../connect.php");
					include("../comments.php");
					$sql = "SELECT * FROM general_comments WHERE THREAD = 4 AND REPLY = 0 ORDER BY(ID) DESC";
					$r1 = mysqli_query($connection, $sql);
					if (mysqli_num_rows($r1) > 0) {
						while ($row = mysqli_fetch_array($r1)) {
							DisplayComments($connection, $row, $row["PAGE_ID"], 0, 4);
						}
					}
				} else {
					if ($lang == "et-EE") {
						echo 'Kui olete administraator või omanik, saate näha ja vastata tagasisidesse saadetud kommentaaridele';
					} else {
						echo "If you're an administrator or the owner, you can see and reply to comments sent to feedback";
					}
				}
			}
				echo '<br/><br/><br/><a href="../..">';
				if ($lang == "en-US")
				{
					echo 'Go back';
				} else {
					echo 'Tagasi avalehele';
				}
				echo '</a>';
			?>
		</div>
</body>
</html>
