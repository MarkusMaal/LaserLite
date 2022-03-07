<?php include("common/connect.php");
  if ((empty($_SESSION)) || ($_SESSION["level"] == "moderator")) {
  	die("Blog posts can only be modified or deleted by the owner of website.<br/>E: 002");
  }
  if (!empty($_POST)) {
  	// post code here
  	$dtitle = '"' . $_POST["title"] . '", ';
  	$dbody = '"' . str_replace('"', '"', $_POST["body"]) . '"';
	//"
  	$sql = 'UPDATE eblog SET title = ' . $dtitle . 'body = ' . $dbody . ' WHERE ID = ' . $_GET["id"];
  	if ($connection->query($sql) === TRUE) {
  		$_POST = array();
  		echo "Post modified<br/>";
  	} else {
  		echo $connection->error . "<br/>";
  	}
  } else {
  	$query = "";
  	if (!empty($_GET["delpost"])) {
  		$sql = "DELETE FROM eblog WHERE ID=" . $_GET["id"];
  		if ($connection->query($sql) === TRUE) {
  			$_POST = array();
  			echo "Post deleted<br/>";
  		} else {
  			echo $connection->error . "<br/>";
  		}
  	}
  	if (!empty($_GET["id"])) {
	  	$query = "SELECT title, body FROM eblog WHERE ID=" . $_GET["id"];
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
	}
  }
?>
<h1>Modify/delete blog post</h1>
<a href="<?php echo $_SERVER["REQUEST_URI"]; ?>&delpost=1">Delete</a>
<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
<input name="title" style="width: 90%;" type="text" value="<?php echo $row[0]; ?>"></input><br/><br/>
<textarea name="body" style="width: 100%; height: 400px"><?php echo nl2br($row[1]); ?></textarea>
<input type="submit" value="Publish"></input>
</form>
