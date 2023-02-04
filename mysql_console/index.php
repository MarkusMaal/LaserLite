<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
if ((empty($_SESSION)) || ($_SESSION["level"] != "owner")) {
	$_POST = array();
	die("Session not started yet. Please <a href=\"../markustegelane/common/config/login.php?redir=mysql_console\">log in</a>.");
}
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
	$lang = "en-US";
	$theme = "blue";
	if (!empty($_COOKIE["theme"])) {
		$theme = $_COOKIE["theme"];
	}
	if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) { $lang = "et-EE"; }
?>
<!DOCTYPE html>
<html lang="<?php if ($lang == "et-EE") { echo "et"; } else { echo "en"; } ?>">
<head><title><?php if ($lang == "et-EE") { echo "Markuse videod productions - avaleht"; } else { echo "Markus' videos productions - home page"; } ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
	  include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/config/getcookies.php");
	  include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/themes/theme.php"); ?>
</head>
<body>
		<table style="margin-left:0px; width: 100%;">
		<tr style="float: left; width: 100%;">
		<td>
		<img style="width: 5em;" src="/markustegelane/common/config/gfx/gears.svg">
		</td>
		<td>
		<h1 style="padding-top: 0px;"><?php echo ms("MySQL console", "MySQL konsool"); ?></h1>
		</td>
		</tr>
		<tr style="background: #<?php if ($theme == "blue") { echo '00f'; } else if ($theme == "light") { echo '888'; } else { echo '555'; } ?>2; width: 100%;">
		<td colspan="2">
		<?php 
			echo '<a href="/"><div class="button" style="margin-top: 0em;" >';
			if ($lang == "en-US")
			{
				echo 'Home page';
			} else {
				echo 'Avaleht';
			}
			echo '</div></a>';
			echo '<a href="/markustegelane/common/config"><div class="button" style="margin-top: 0em;" >';
			if ($lang == "en-US")
			{
				echo 'Settings';
			} else {
				echo 'Seaded';
			}
			echo '</div></a>';
			$rcmd = ms("Run command", "Käivita päring");
			$lt = ms("List tables", "Kuva tabelid");
			if (empty($_GET["cmd"])) {
				echo "<a href=\"?cmd=1\"><div class=\"button\" style=\"margin-top: 0em;\">$rcmd</div></a>";
			}
			echo "<a href=\"index.php\"><div class=\"button\" style=\"margin-top: 0em;\">$lt</div></a>";
			echo '<a href="/phpmyadmin"><div class="button" style="margin-top: 0em;" >phpMyAdmin</div></a>';
			?>
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
			<br/>
			
            <?php if (!empty($_GET["cmd"])) {
			echo '<div class="setting" style="margin-bottom: 1em;">
				<form action="index.php" method="post" name="form1">
					<textarea style="width: 90%; height: 50px;" name="command"></textarea><br/>
					<input style="float: left;" type="submit" value="' . ms("Run", "Käivita") . '"></input>
				</form>
			</div>'; }?>			
			
			<?php 
				include("../connect.php");
				if ((!empty($_POST)) || (!empty($_GET["table"]))) {
					if (!empty($_POST)) { $cmd = $_POST["command"]; }
					else { $cmd = "SELECT * FROM " . $_GET["table"]; }
					if (substr( strtoupper($cmd), 0, 6 )  == "SELECT") {
						$display_table = true;
					} else {
						$display_table = false;
					}
					if ($display_table) {
						$tq = ms("Table query", "Valiku päring");
						echo "<h2>$tq</h2>";
						echo '<p>' . $cmd . '</p>';
						echo '<div class="setting">';
						$result = mysqli_query($connection, $cmd);
						echo '<table class="normaltable">';
						echo '<tr>';
						$cols = 0;
						while ($property = mysqli_fetch_field($result)) {
								echo '<th class="normaltable">' . $property->name . '</td>';
								$cols++;
							}
						echo '</tr>';
						while ($row = mysqli_fetch_array($result)) {
							echo '<tr>';
							for ($i = 0; $i < $cols; $i++)
							{
								if ($row[$i] != null) {
									echo '<td class="normaltable">' . htmlspecialchars($row[$i], ENT_QUOTES, 'UTF-8') . '</td>';
								} else {
									echo '<td class="normaltable"><span style="color: #f00">null</span></td>';
								}
							}
							echo '</tr>';
						}
						echo '</table>';
					} else {
						$dc = ms("Database command", "Andmebaasi päring");
						echo "<h2>$dc</h2>";
						echo '<p>' . $cmd . '</p>';
						$success_str = ms("Query completed successfully", "Päring sooritati edukalt");
						$fail_str = ms("Query failed", "Päring nurjus");
						$reason = ms("Reason", "Põhjus");
						if ($connection->query($cmd) === TRUE) {
							echo "<span style=\"color: #0f0\">$success_str</span>";
						} else {
							echo "<span style=\"color: #f00\">$fail_str</span><br/><p>$reason: " . $connection->error . "</p>";
						}
						echo '<br/>';
					}
				} else {
					$te = ms("les", "elid");
					echo "<h2>Tab$te</h2><div class=\"setting\">";
					$sql = "SHOW TABLES FROM $db_name";
					$result = mysqli_query($connection, $sql);
					if (!$result) {
						echo "<span style=\"color: red\">Warning: Cannot fetch tables!<span><br/>\n";
						echo 'MySQL Error: ' . mysql_error();
						exit;
					}
					while ($row = mysqli_fetch_row($result)) {
						echo '<a href="?table=' . $row[0] . '"><div class="button">' . $row[0] . '</div></a>';
					}
					echo '</div>';
				}
			?>
			</div>
		</div>
		</div>
</body>
