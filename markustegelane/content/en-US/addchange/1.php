 
<?php
	include("common/connect.php");
	if ((empty($_SESSION)) || ($_SESSION["level"] != "owner")) {
		die('<p>Please log in with an owner account</p>');
	}
	if (!empty($_POST)) {
		$query = "SELECT * FROM changelog WHERE RELEASEDATE = (\"" . $_POST["date_txt"] . "\")";
		$result = mysqli_query($connection, $query);
		$cnt = mysqli_fetch_array($result);
		$id = "0";
		if ($cnt == FALSE) {
			$sql = "INSERT INTO changelog (RELEASEDATE) VALUES ((\"" . $_POST["date_txt"] . "\"))";
			if ($connection->query($sql) !== TRUE) {
				die("Failed to add new date");
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
				die("Failed to add change");
		}
		die("Success!");
	}
?>
<h1>Add change</h1>
<form method="post" action="?doc=addchange&s=1">
	<p>
	Date (YYYY-MM-DD): <input type="text" value="<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>" name="date_txt"></input>
	</p>

	<p>
	Change description (in Estonian): <input style="width: 60%;" type="text" name="mui_et"></input>
	</p>

	<p>
	Change description (in English): <input style="width: 60%;" type="text" name="mui_en"></input>
	</p>
	<input type="submit" value="Add change">
</form>
