<?php include("common/connect.php");
  if ((empty($_SESSION)) || ($_SESSION["level"] == "moderator")) {
  	die("Blogipostitusi saab lisada ainult veebisaidi omanik.<br/>E: 002");
  }
  if (!empty($_POST)) {
  	// post code here
	date_default_timezone_set("UTC");
  	$datetime = date("Y-m-d H-i-s");
  	$dtime = '("' . $datetime . '"), ';
  	$dtitle = '"' . $_POST["title"] . '", ';
  	$dbody = '"' . str_replace('"', '"', $_POST["body"]) . '"';
  	$sql = 'INSERT INTO blog (post_time, title, body) VALUES (' . $dtime . $dtitle . $dbody . ')';
  	if ($connection->query($sql) === TRUE) {
  		$_POST = array();
  		echo "Postitus avaldati<br/>";
  	} else {
  		echo $connection->error . "<br/>";
  	}
  }
?>
<h1>Uus blogpostitus</h1>
<form action="?doc=development&s=4" method="post">
<input name="title" style="width: 90%;" type="text"></input><br/><br/>
<textarea name="body" style="width: 100%; height: 400px"></textarea>
<input type="submit" value="Avalda"></input>
</form>
