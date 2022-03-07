<?php
if ((empty($_POST)) || ($_SESSION["level"] != "owner")) {
    die("To add the download, you must log in with an owner account and complete the form on the previous page.");
}
include("common/connect.php");
$sql = 'INSERT INTO dloads (DTYPE, DTITLE, DDESC, MUI_DTITLE, MUI_DDESC) VALUES (' . $_POST["dtype"] . ', "' . str_replace('"', '&quot;', $_POST["etTitle"]) . '", "' . str_replace('"', '&quot;', $_POST["etDescription"]) . '", "' . str_replace('"', '&quot;', $_POST["enTitle"]) . '", "' . str_replace('"', '&quot;', $_POST["enDescription"]) . '")';
echo $sql;
if ($connection->query($sql) === TRUE) {
    $_POST = array();
} else {
    die("Something went wrong. Task cancelled");
}
$query = 'SELECT ID FROM dloads ORDER BY ID DESC LIMIT 1';
$result = mysqli_query($connection, $query);
$newitem = mysqli_fetch_array($result)[0];

?>

<h1>Add a download</h1>
<p style="color: red; font-size: 16pt;">Warning: This interface is not meant for regular users. If you are a regular user, EXIT THIS PAGE NOW!</p>
<p style="color: yellow;">When adding a download you mustn't skip any step. Otherwise, downloadable item will be corrupt.</p>
<ol>
<li>Add text based metadata</li>
<li style="font-weight: bold;">Add download links</li>
<li>Add thumbnails</li>
</ol>
<form name="form1" action="?doc=dload_add_features&s=3&id=<?php echo $newitem; ?>" method="post">
<table>
<tr>
<td>Download link<span style="color: #f00">*</span></td>
<td><input name="link" type="text"></input></td>
</tr>
<tr>
<td>Checksum<span style="color: #f00">*</span></td>
<td><input name="chksum" type="text"></input></td>
</tr>
</table>
<input type="submit" value="Continue"></input>
</form>
