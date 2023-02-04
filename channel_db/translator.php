<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include("connect.php");
if (empty($_SESSION) || empty($_SESSION["usr"]) || ($_SESSION["level"] != "owner")) {
	die("You need to log in as the owner to view this page. // Selle lehekülje kuvamiseks peate omaniku kontoga sisse logima.");
}
if (!empty($_POST)) {
	if ($connection->connect_error) {
		die('<span style="color: #ff0000">Andmebaasige ühendumine nurjus.
		Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span>');
	}
	$query = 'UPDATE channel_db SET TitleMUI_et = "' . str_replace("\"", "&quot;", $_POST["TitleMUI_et"]) . '", TitleMUI_en = "' .
			 str_replace("\"", "&quot;", $_POST["TitleMUI_en"]) . '", KirjeldusMUI_et = "'. str_replace("\"", "&quot;", $_POST["KirjeldusMUI_et"]) .
			 '", KirjeldusMUI_en = "' . str_replace("\"", "&quot;",$_POST["KirjeldusMUI_en"]) . '", Category = "' . $_POST["Category"] .
			 '", CategoryMUI_en = "' . $_POST["CategoryMUI_en"] . '", OdyseeURL = "' . $_POST["OdyseeURL"] . '", Tags = "' .
			 str_replace("\"", "&quot;", $_POST["Tags"]) . '", Filename = "' . $_POST["Filename"] . '", Translated = 1 WHERE ID = ' . $_POST["ID"];
	if ($connection->query($query) === TRUE) {
		$_POST = array();
	} else {
		die($connection->error);
	}
}
include("head.php");
$query = "SELECT * FROM channel_db WHERE Translated = 0 LIMIT 1";
$cnt = mysqli_query($connection, $query);
$row = mysqli_fetch_array($cnt);
?>
<form method="post" action="translator.php" name="form" enctype="multipart/mixed">
<input type="submit" value="Märgi tõlgituks"/>
<table style="width: 100%;">
	<tr>
		<td>
			ID
		</td>
		<td>
			<input style="width: 98%; text-align: left;" name="ID" type="text" value="<?php echo $row["ID"];?>"></input>
		</td>
	</tr>
	<tr>
		<td>
			Pealkiri (Fallback)
		</td>
		<td>
			<?php echo $row["Video"];?>
		</td>
	</tr>
	<tr>
		<td>
			Pealkiri (Eesti)
		</td>
		<td>
			<input style="width: 98%; text-align: left;" name="TitleMUI_et" type="text" value="<?php echo $row["TitleMUI_et"];?>"></input>
		</td>
	</tr>
	<tr>
		<td>
			Pealkiri (Inglise)
		</td>
		<td>
			<input style="width: 98%; text-align: left;" name="TitleMUI_en" type="text" value="<?php echo $row["TitleMUI_en"];?>"></input>
		</td>
	</tr>
	<tr></tr>
	<tr>
		<td>
			Kirjeldus (Fallback)
		</td>
		<td>
			<?php echo $row["Kirjeldus"];?>
		</td>
	</tr>
	<tr>
		<td>
			Kirjeldus (Eesti)
		</td>
		<td>
			<textarea style="width: 98%; text-align: left;" name="KirjeldusMUI_et" type="text"><?php echo $row["KirjeldusMUI_et"];?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			Kirjeldus (Inglise)
		</td>
		<td>
			<textarea style="width: 98%; text-align: left;" name="KirjeldusMUI_en" type="text"><?php echo $row["KirjeldusMUI_en"];?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			Kategooria (Eesti)
		</td>
		<td>
			<input style="width: 98%; text-align: left;" name="Category" type="text" value="<?php echo $row["Category"];?>"></input>
		</td>
	</tr>
	<tr>
		<td>
			Kategooria (Inglise)
		</td>
		<td>
			<input style="width: 98%; text-align: left;" name="CategoryMUI_en" type="text" value="<?php echo $row["CategoryMUI_en"];?>"></input>
		</td>
	</tr>
	<tr>
		<td>
			Odysee URL
		</td>
		<td>
			<input style="width: 98%; text-align: left;" name="OdyseeURL" type="text" value="<?php echo $row["OdyseeURL"];?>"></input>
		</td>
	</tr>
	<tr>
		<td>
			Sildid
		</td>
		<td>
			<textarea style="width: 98%; text-align: left;" name="Tags"><?php echo $row["Tags"];?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			Failinimi
		</td>
		<td>
			<input style="width: 98%; text-align: left;" name="Filename" type="text" value="<?php echo $row["Filename"];?>"></input>
		</td>
	</tr>
</table>
</form>
<?php
include("foot.php");
?>