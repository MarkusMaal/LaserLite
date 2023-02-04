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
			<?php
				$encrypted_ip = getUserIP();
				if (!empty($_GET["id"])) {
				$query = "SELECT * FROM client_ratings WHERE CID = " . $_GET["id"] . " AND CLIENT = \"" . $encrypted_ip . "\"";
				$unlike = false;
				$undislike = false;
				$result = mysqli_query($connection, $query);
				if (mysqli_num_rows($result) == 0) {
					$query = "INSERT INTO client_ratings (CLIENT, CID, POSITIVE) VALUES (\"" . $encrypted_ip . "\", " . $_GET["id"] . ", 1)";
					if ($connection->query($query)) {
						// success
						echo ms("Comment liked", "Kommentaarile lisati hinnang");
					} else {
						// error
						echo $connection->error;
					}
				} else {
					while ($row = mysqli_fetch_array($result)) {
						if ($row["POSITIVE"] == FALSE) {
							$undislike = true;
						} else {
							$unlike = true;
						}
					}
					if ($unlike) {
						$query = "DELETE FROM client_ratings WHERE CLIENT = \"" . $encrypted_ip . "\" AND CID = " . $_GET["id"];
						if ($connection->query($query)) {
							echo ms("Comment unliked", "Kommentaarilt eemaldati hinnang");
						} else {
							// error
							echo $connection->error;
						}
					} else if ($undislike) {
						$query = "UPDATE client_ratings SET POSITIVE = TRUE WHERE CLIENT = \"" . $encrypted_ip . "\" AND CID = " . $_GET["id"];
						if ($connection->query($query)) {
							echo ms("Rating updated", "Kommentaari hinnang muudeti");
						} else {
							echo $connection->error;
						}
					}

				}
				} else {
				}
				echo '<br/><br/><a href="#" onclick="javascript:window.history.back(-1);return false;"><div class="button">' . ms("Back", "Tagasi") . '</div></a>';
		?>
			
		</div>
		</div>
</body>
