<h1>Feedback</h1>
<?php
include("common/connect.php");
include("common/comments.php");
if (!empty($_POST["name"]))
{
	$usr_id = mysqli_real_escape_string($connection, md5($_POST["name"] . ":" . $_POST["pass"]));
	$sql = "SELECT * FROM feedback_users WHERE CRYPTCODE = \"" . $usr_id . "\"";
	$r1 = mysqli_query($connection, $sql);
	if (mysqli_num_rows($r1) > 0) {
			echo '<h2>Welcome back, ' . htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8') . '!</h2>';
	} else {
			echo '<h2>Welcome, ' . htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8') . '!</h2>';
			$sql = 'INSERT INTO feedback_users (CRYPTCODE) VALUES ("' . $usr_id . '")';
			if ($connection->query($sql)) {
				echo '<p>User was added to the database</p>';
			} else {
				echo '<p>' . $connection->error . '</p>';
			}
	}
	$me = mysqli_fetch_array($r1)["ID"];
	echo '<a href="?doc=feedback&s=1">Log out</a>';
	
	$sql = "SELECT * FROM general_comments WHERE THREAD = 4 AND REPLY = 0 AND PAGE_ID = " . $me;
	$r2 = mysqli_query($connection, $sql);
	if (mysqli_num_rows($r2) > 0) {
		while ($row = mysqli_fetch_array($r2)) {
			DisplayComments($connection, $row, $me, 0, 4);
		}
	} else {
		echo '<p>You have not sent any feedback yet</p>';
	}
	echo '<a href="common/post.php?th=4&id=' . $me . '&auth=' . $usr_id . '">Send comment</a>';
} else {
	die("<p>Please log in with a username and password <a href=\"?doc=feedback&s=1\">here</a></p>");
}
?>
