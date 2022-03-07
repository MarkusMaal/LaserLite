<?php include("common/connect.php");
  if ($_SESSION["level"] != "owner") {
  	die("Kommentaare saab taastada ainult veebilehe omanik.<br/>E: 004");
  }
  if (!empty($_GET["id"])) {
  	$sql = 'UPDATE poll SET public=1 WHERE ID=' . $_GET["id"];
  	if ($connection->query($sql) === TRUE) {
  		$_POST = array();
  		echo "Kommentaar taastati avalikuks<br/>";
  	} else {
  		echo $connection->error . "<br/>";
  	}
  }
?>
<br/><a href="index.php">Avaleht</a>
