<?php include("common/connect.php");
  if ($_SESSION["level"] != "owner") {
  	die("Kommentaare saab lõplikult kustutada ainult veebilehe omanik.<br/>E: 005");
  }
  if (!empty($_GET["id"])) {
  	$sql = 'DELETE FROM poll WHERE ID=' . $_GET["id"];
  	if ($connection->query($sql) === TRUE) {
  		$_POST = array();
  		echo "Kommentaar kustutati<br/>";
  	} else {
  		echo $connection->error . "<br/>";
  	}
  }
?>
<br/><a href="index.php">Avaleht</a>
