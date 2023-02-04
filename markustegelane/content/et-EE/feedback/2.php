<h1>Tagasiside</h1>
<?php
include("common/connect.php");
include("common/comments.php");
if (!empty($_SESSION["name"]) || !empty($_POST["name"]))
{
	$usr_id = "";
	if (empty($_SESSION["name"])) {
		$_SESSION["name"] = $_POST["name"];
		$usr_id = mysqli_real_escape_string($connection, md5($_SESSION["name"] . ":" . $_POST["pass"]));
		$_SESSION["auth"] = $usr_id;
	} else {
		$usr_id = $_SESSION["auth"];
	}
	$sql = "SELECT * FROM feedback_users WHERE CRYPTCODE = \"" . $usr_id . "\"";
	$r1 = mysqli_query($connection, $sql);
	$newaccount = false;
	if (mysqli_num_rows($r1) > 0) {
			echo '<h2>Tere tulemast tagasi, ' . htmlspecialchars($_SESSION["name"], ENT_QUOTES, 'UTF-8') . '!</h2>';
	} else {
			echo '<h2>Tere tulemast, ' . htmlspecialchars($_SESSION["name"], ENT_QUOTES, 'UTF-8') . '!</h2>';
			$sql = 'INSERT INTO feedback_users (CRYPTCODE) VALUES ("' . $usr_id . '")';
			if ($connection->query($sql)) {
				echo '<p>Kasutaja lisati andmebaasi</p>';
			} else {
				echo '<p>' . $connection->error . '</p>';
			}
			$newaccount = true;
	}
	echo '<a href="?doc=feedback&s=1&logout=1">Logi välja</a>';
	if ($newaccount == false) {
		$r1 = mysqli_query($connection, $sql);
		$me = mysqli_fetch_array($r1)["ID"];
		
		$sql = "SELECT * FROM general_comments WHERE THREAD = 4 AND REPLY = 0 AND PAGE_ID = " . $me;
		$r2 = mysqli_query($connection, $sql);
		if (mysqli_num_rows($r2) > 0) {
			while ($row = mysqli_fetch_array($r2)) {
				DisplayComments($connection, $row, $me, 0, 4);
			}
		} else {
			echo '<p>Te ei ole veel tagasisidet saatnud</p>';
		}
	} else {
		$fdbk_usr = mysqli_query($connection, "SELECT ID FROM feedback_users ORDER BY(ID) DESC LIMIT 1");
		$me = mysqli_fetch_array($fdbk_usr)[0];
		echo '<p>Võite nüüd saata kommentaari veebilehe administraatorile</p>';
	}
	echo '<a href="common/post.php?th=4&id=' . $me . '">Saada kommentaar</a>';
} else {
	die("<p>Palun sisenege kasutajanime ja parooliga <a href=\"?doc=feedback&s=1\">sellel lehel</a></p>");
}
?>
