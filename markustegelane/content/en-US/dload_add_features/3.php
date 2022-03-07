<?php
session_start();

if ((empty($_POST)) || ($_SESSION["level"] != "owner")) {
    die("To add the download, you must log in with an owner account and complete the form on the previous page.");
} else {
    include("common/connect.php");
  	$sql = 'INSERT INTO dlinks (LINK_URI, LINK_PRIMARY, CHKSUM, DLOAD) VALUES("' . $_POST["link"] . '", 1, "' . $_POST["chksum"] . '", ' . $_GET["id"] . ')';
  	echo $sql;
  	if ($connection->query($sql) === TRUE) {
        $_POST = array();
  	} else {
    	die("Something went wrong. Task cancelled");
  	}
}
?>

<h1>Add a download</h1>
<p style="color: red; font-size: 16pt;">Warning: This interface is not meant for regular users. If you are a regular user, EXIT THIS PAGE NOW!</p>
<p style="color: yellow;">When adding a download you mustn't skip any step. Otherwise, downloadable item will be corrupt.</p>
<ol>
<li>Add text based metadata</li>
<li>Add download links</li>
<li style="font-weight: bold;">Add thumbnails</li>
</ol>
<form name="form1" action="?doc=dload_add_features&s=4&id=<?php echo $_GET["id"]; ?>" method="post">
<table>
<tr>
<td>Thumbnail locations (one location per line)</td>
<td><textarea name="picts"></textarea></td>
</tr>
</table>
<input type="submit" value="Continue"></input>
</form>
