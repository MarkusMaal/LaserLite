<?php
session_start();

if ((empty($_POST)) || ($_SESSION["level"] != "owner")) {
    die("To add the download, you must log in with an owner account and complete the form on the previous page.");
} else {
    include("common/connect.php");
    if ($_POST["picts"] != "") {
        $pics = preg_split('/\r\n|[\r\n]/', $_POST['picts']);
        foreach ($pics as &$pic) {
            $sql = 'INSERT INTO dscrnshots (URI, DLOAD) VALUES("' . $pic . '", ' . $_GET["id"] . ')';
            if ($connection->query($sql) === TRUE) {
                $_POST = array();
            } else {
                die($sql . ' -> Something went wrong. Task cancelled.');
            }
        }
  	}
  	echo 'Done';
}
?>
</form>
