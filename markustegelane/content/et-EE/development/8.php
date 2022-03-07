<?php include("common/connect.php");
  if ($_SESSION["level"] != "owner") {
  	die("Kommentaaride paroole saab nullida ainult veebisaidi omanik.<br/>E: 006");
  }
  if ((!empty($_GET["id"])) && (!empty($_GET["usr"]))) {
  	$sql = 'UPDATE poll SET close="' . md5($_GET['usr'] . '_') . '" WHERE ID=' . $_GET["id"];
  	if ($connection->query($sql) === TRUE) {
  		$_POST = array();
  		echo "Parool nulliti.<br/>";
  	} else {
  		echo $connection->error . "<br/>";
  	}
  }
?>
<br/><a href="index.php">Avaleht</a>
