<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="<?php
if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) {
echo 'et';
$lang = "et";
} else {
echo 'en';
$lang = "en";
}


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

?>">
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
		<?php include("../../mobcheck.php"); ?>
		<?php include("loadtheme.php");?>
	</head>
	<body>
		<a href=".."><img center class="banner" src="../gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a>
		<div class="mainpage">
			<h2><?php echo ms("Moderation", "Modereerimine")?></h2>
			<p>
			<?php
				if (!empty($_GET["cid"])) {
					if (!empty($_SESSION)) {
						if ($_GET["s"] == 1) {
							$query = "UPDATE general_comments SET hide = 1 WHERE ID = " . $_GET["cid"];
							if ($connection->query($query)) {
								echo '<span style="color: #0f0">';
								echo ms("Success", "Õnnestus");
								echo '</span>: ' . ms("Comment hidden", "Kommentaar peideti");
							} else {
								echo '<span style="color: #f00">';
								echo ms("Error", "Viga");
								echo '</span>: '. $connection->error;
							}
						}
						else if ($_GET["s"] == 3) {
							$query = "UPDATE general_comments SET hide = 0 WHERE ID = " . $_GET["cid"];
							if ($connection->query($query)) {
								echo '<span style="color: #0f0">';
								echo ms("Success", "Õnnestus");
								echo '</span>: ' . ms("Comment restored", "Kommentaar muudeti avalikuks");
							} else {
								echo '<span style="color: #f00">';
								echo ms("Error", "Viga");
								echo '</span>: '. $connection->error;
							}
						}
						else if ($_GET["s"] == 2) {
							if (($_SESSION["level"] == "admin") || ($_SESSION["level"] == "owner")) {
								$query = "DELETE FROM comment_managers WHERE cid = " . $_GET["cid"];
								$connection->query($query);
								$query = "DELETE FROM client_ratings WHERE CID = " . $_GET["cid"];
								$connection->query($query);
								$query = "DELETE FROM general_comments WHERE ID = " . $_GET["cid"];
								if ($connection->query($query)) {
									echo '<span style="color: #0f0">';
									echo ms("Success", "Õnnestus");
									echo '</span>: ' . ms("Comment deleted", "Kommentaar kustutati");
								} else {
									echo '<span style="color: #f00">';
									echo ms("Error", "Viga");
									echo '</span>: '. $connection->error;
								}
							}
						}
						else if ($_GET["s"] == 4) {
							if (($_SESSION["level"] == "admin") || ($_SESSION["level"] == "owner")) {
								$query = "UPDATE comment_managers SET code = \"" . md5($_GET["cid"]) . "\" WHERE cid = " . $_GET["cid"];
								if ($connection->query($query)) {
									echo '<span style="color: #0f0">';
									echo ms("Success", "Õnnestus");
									echo '</span>: ' . ms("Password removed", "Parool eemaldati");
								} else {
									echo '<span style="color: #f00">';
									echo ms("Error", "Viga");
									echo '</span>: '. $connection->error;
								}
							}
						}
					}
				}
			?></p>
				<br/><br/><a href="#" onclick="javascript:window.history.back(-1);return false;"> <?php echo ms("Back", "Tagasi")?></a>
		</div>
	</body>
</html>
