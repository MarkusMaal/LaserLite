<?php
session_start();

if ((empty($_POST)) || ($_SESSION["level"] != "owner")) {
    die("Allalaadimise lisamiseks tuleb sisse logida omaniku kontoga ja täita vorm eelmisel lehel.");
} else {
    include("common/connect.php");
    if ($_POST["picts"] != "") {
        $pics = preg_split('/\r\n|[\r\n]/', $_POST['picts']);
        foreach ($pics as &$pic) {
            $sql = 'INSERT INTO dscrnshots (URI, DLOAD) VALUES("' . $pic . '", ' . $_GET["id"] . ')';
            if ($connection->query($sql) === TRUE) {
                $_POST = array();
            } else {
                die($sql . ' -> Midagi läks valesti. Toiming katkestati');
            }
        }
  	}
  	echo 'Valmis';
}
?>
</form>
