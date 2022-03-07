 
<?php
	include("common/connect.php");
	if ((empty($_SESSION)) || ($_SESSION["level"] != "owner")) {
		die('<p>Palun logige sisse omaniku kontoga</p>');
	}
	if (!empty($_POST)) {
		$query = "SELECT * FROM changelog WHERE RELEASEDATE = (\"" . $_POST["date_txt"] . "\")";
		$result = mysqli_query($connection, $query);
		$cnt = mysqli_fetch_array($result);
		$id = "0";
		if ($cnt == FALSE) {
			$sql = "INSERT INTO changelog (RELEASEDATE) VALUES ((\"" . $_POST["date_txt"] . "\"))";
			if ($connection->query($sql) !== TRUE) {
				die("Uue kuupäeva lisamine nurjus");
			}
			$query = "SELECT * FROM changelog WHERE RELEASEDATE = (\"" . $_POST["date_txt"] . "\")";
			$result = mysqli_query($connection, $query);
			$cnt = mysqli_fetch_array($result);
			$id = $cnt[0];
		} else {
			$id = $cnt[0];
		}
		$sql = "INSERT INTO changelog_change (PARNT_ID, CONTENT_ET, CONTENT_EN) VALUES (" . $id .
				 ", \"" . $_POST["mui_et"] . "\", \"" . $_POST["mui_en"] . "\");";
		if ($connection->query($sql) !== TRUE) {
				die("Muudatuse lisamine nurjus");
		}
		die("Õnnestus!");
	}
?>
<h1>Lisa muudatus</h1>
<form method="post" action="?doc=addchange&s=1">
	<p>
	Kuupäev (AAAA-KK-PP): <input type="text" value="<?php echo date('Y');?>-<?php echo date('m');?>-<?php echo date('d');?>" name="date_txt"></input>
	</p>

	<p>
	Muudatuse kirjeldus (eesti keeles): <input style="width: 60%;" type="text" name="mui_et"></input>
	</p>

	<p>
	Muudatuse kirjeldus (inglise keeles): <input style="width: 60%;" type="text" name="mui_en"></input>
	</p>
	<input type="submit" value="Lisa muudatus">
</form>
