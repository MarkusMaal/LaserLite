<?php include("common/connect.php");
  if ((empty($_SESSION)) || ($_SESSION["level"] == "moderator")) {
  	die("Blogipostitusi saab muuta ja kustutada ainult veebisaidi omanik.<br/>E: 002");
  }
  if (!empty($_POST)) {
  	// post code here
  	$dtitle = '"' . $_POST["title"] . '", ';
  	$dbody = '"' . str_replace('"', '"', $_POST["body"]) . '"';
	//"
  	$sql = 'UPDATE blog SET title = ' . $dtitle . 'body = ' . $dbody . ' WHERE ID = ' . $_GET["id"];
  	if ($connection->query($sql) === TRUE) {
  		$_POST = array();
  		echo "Postitust muudeti<br/>";
  	} else {
  		echo $connection->error . "<br/>";
  	}
  } else {
  	$query = "";
  	if (!empty($_GET["delpost"])) {
  		$sql = "DELETE FROM blog WHERE ID=" . $_GET["id"];
  		if ($connection->query($sql) === TRUE) {
  			$_POST = array();
  			echo "Postitus kustutati<br/>";
  		} else {
  			echo $connection->error . "<br/>";
  		}
  	}
  	if (!empty($_GET["id"])) {
	  	$query = "SELECT title, body FROM blog WHERE ID=" . $_GET["id"];
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
	}
  }
?>
<h1>Muuda/kustuta blogipostitus</h1>
<a href="<?php echo $_SERVER["REQUEST_URI"]; ?>&delpost=1">Kustuta postitus</a>
<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
<input name="title" style="width: 90%;" type="text" value="<?php echo $row[0]; ?>"></input><br/><br/>
<textarea name="body" style="width: 100%; height: 400px"><?php echo nl2br($row[1]); ?></textarea>
<input type="submit" value="Avalda"></input>
</form>
