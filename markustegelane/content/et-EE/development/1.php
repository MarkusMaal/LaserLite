<h1>Sisu uuendamine</h1>
<?php
if (!empty($_GET["section"])) {
echo '<p>Sektsioon: ' . $_GET["section"] . '</p>';
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
		if (($subdoc != "") || (!empty($_GET["navbar"]))) {
			if ($_POST != array()) {
				$len = count($_POST);
				flush_file($subdoc);
				echo '<p>Toiming sooritati</p>';
				echo '<a href="index.php">Avalehele</a>';
				die();
			}
			$root = $_SERVER["DOCUMENT_ROOT"] . "/markustegelane/content/" . $lang . "/" . $subdoc;
			if (!empty($_GET["navbar"])) {
				$root = $_SERVER["DOCUMENT_ROOT"] . "/markustegelane/content/" . $lang . "/";
			}
			echo '<p section="' . $subdoc . '">Tee: ' . $root . '</p>';
			if (empty($_GET["navbar"])) {
				for ($j = 1; $j < 10; $j++) {
					if ($sect == $j) {
						if (file_exists($root . "/" . $j . ".php")) {
							$file = fopen($root . "/" . $j . ".php", "r");
							
							echo '<textarea name="' . $subdoc . $j .  '" style="width: 100%; height: 800px">' . str_replace("<", "<", str_replace(">", ">", fread($file,filesize($root . "/" . $j . ".php")))) . '</textarea><br/>';
						}
					}
				}
			} else {
				$j = "navbar";
				if (file_exists($root . "/" . $j . ".php")) {
					$file = fopen($root . "/" . $j . ".php", "r");	
					echo '<textarea name="' . $subdoc . $j .  '" style="width: 100%; height: 800px">' . str_replace("<", "<", str_replace(">", ">", fread($file,filesize($root . "/" . $j . ".php")))) . '</textarea><br/>';
				}
			}
			echo '<input type="submit" value="uuenda"></input>';
		} else {
			echo 'Palun valige uuendatav dokument';
		}
	} else {
		echo 'Juurdepääs keelatud. Logige sisse omaniku kontoga.<br/>';
	}
?>
</form>
<?php
	if (empty($_GET["s"])) {
		die();
	}
?>
