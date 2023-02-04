<?php include("../../mobcheck.php"); ?>
<?php include("loadtheme.php");?>
<?php
function ms ($en, $et) {
	if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US")) {
		return $en;
	} else {
		return $et;
	}

}
?>
<title><?php echo ms("Rate comment", "Kommentaarile hinnangu lisamine"); ?></title>
<?php
    include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
	$lang = "en-US";
	$theme = "blue";
	if (!empty($_COOKIE["theme"])) {
		$theme = $_COOKIE["theme"];
	}
	if (!empty($_COOKIE["lang"]) && ($_COOKIE["lang"] == "et-EE")) { $lang = "et-EE"; }
?>
<?php
include("connect.php");

// get public IP, encrypt immediately for privacy reasons
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return md5($ip);
}

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
		<h1 style="padding-top: 0px;"><?php echo ms("Rate comment", "Kommentaari hindamine"); ?></h1>
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
		<div class="setting">
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
				<?php echo '<br/><br/><a href="#" onclick="javascript:window.history.back(-1);return false;"><div class="button">' . ms("Back", "Tagasi") . '</div></a>';
				?>
			
		</div>
		</div>
</body>
