<h1>Update styles</h1>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
<ul>
<li><a href="?doc=development&s=2&subdoc=light">light</a></li>
<li><a href="?doc=development&s=2&subdoc=dark">dark</a></li>
<li><a href="?doc=development&s=2&subdoc=blue">blue</a></li>
<li><a href="?doc=development&s=2&subdoc=light_m">light (mobile)</a></li>
<li><a href="?doc=development&s=2&subdoc=dark_m">dark (mobile)</a></li>
<li><a href="?doc=development&s=2&subdoc=blue_m">blue (mobile)</a></li>
</ul>
<?php
$subdoc = "";
if (!empty($_GET["subdoc"])) {
$subdoc = $_GET["subdoc"];
}
include_once("common/flush.php");
	if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		if ($subdoc != "") {
			if ($_POST != array()) {
				$len = count($_POST);
				flush_file($subdoc);
				echo '<p>Task finished</p>';
				echo '<a href="index.php">Homepage</a>';
				die();
			}
			$root = $_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/themes/" . $subdoc;
			echo '<h2 section="' . $subdoc . '">' . $root . '</h2>';
			if (file_exists($root . ".css")) {
				$file = fopen($root . ".css", "r");
				
				echo '<textarea name="' . $subdoc .  '" style="width: 100%; height: 800px">' . str_replace("<", "<", str_replace(">", ">", fread($file,filesize($root . ".css")))) . '</textarea><br/>';
			}
			echo '<input type="submit" value="uuenda"></input>';
		} else {
			echo 'Please select an updatable cascading style sheet.';
		}
	} else {
		echo 'Access is denied. Please log in with an owner account.<br/>';
	}
?>
</form>
