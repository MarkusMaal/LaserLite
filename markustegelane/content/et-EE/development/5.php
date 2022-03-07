<?php include("common/connect.php");
  if ((empty($_SESSION["level"]))) {
  	die("Kommentaare saab peita registreeritud moderaator või veebilehe omanik.<br/>E: 003");
  }
  if (!empty($_GET["id"])) {
  	$sql = 'UPDATE poll SET public=0 WHERE ID=' . $_GET["id"];
  	if ($connection->query($sql) === TRUE) {
  		$_POST = array();
  		echo "Kommentaar pole enam avalik<br/>";
  	} else {
  		echo $connection->error . "<br/>";
  	}
  }
?>
<br/><a href="index.php">Avaleht</a>
