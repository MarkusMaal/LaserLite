<h1>Update content</h1>
<?php
if (!empty($_GET["section"])) {
echo '<p>Section: ' . $_GET["section"] . '</p>';
}
?>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
<?php
include_once("common/flush.php");
$subdoc = "";
if (!empty($_GET["subdoc"])) {
$subdoc = htmlspecialchars($_GET["subdoc"], ENT_QUOTES, 'UTF-8');
}
$sect = 1;
if (!empty($_GET["section"])) {
$sect = $_GET["section"];
}
	if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		if ($subdoc != "") {
			if ($_POST != array()) {
				$len = count($_POST);
				flush_file($subdoc);
				echo '<p>Task finished</p>';
				echo '<a href="index.php">Homepage</a>';
				die();
			}
			$root = $_SERVER["DOCUMENT_ROOT"] . "/markustegelane/content/" . $lang . "/" . $subdoc;
			echo '<p section="' . $subdoc . '">Path: ' . $root . '</p>';
			for ($j = 1; $j < 10; $j++) {
				if ($sect == $j) {
					if (file_exists($root . "/" . $j . ".php")) {
						$file = fopen($root . "/" . $j . ".php", "r");
						
						echo '<textarea name="' . $subdoc . $j .  '" style="width: 100%; height: 800px">' . str_replace("<", "<", str_replace(">", ">", fread($file,filesize($root . "/" . $j . ".php")))) . '</textarea><br/>';
					}
				}
			}
			echo '<input type="submit" value="update"></input>';
		} else {
			echo 'Please select an updatable document';
		}
	} else {
		echo 'Access is denied. Log in with an owner account.<br/>';
	}
?>
</form>
<?php
	if (empty($_GET["s"])) {
		die();
	}
?>
