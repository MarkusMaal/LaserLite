<?php
session_start();

if ((empty($_POST)) || ($_SESSION["level"] != "owner")) {
    die("Allalaadimise lisamiseks tuleb sisse logida omaniku kontoga ja täita vorm eelmisel lehel.");
} else {
    include("common/connect.php");
  	$sql = 'INSERT INTO dlinks (LINK_URI, LINK_PRIMARY, CHKSUM, DLOAD) VALUES("' . $_POST["link"] . '", 1, "' . $_POST["chksum"] . '", ' . $_GET["id"] . ')';
  	echo $sql;
  	if ($connection->query($sql) === TRUE) {
        $_POST = array();
  	} else {
        die("Midagi läks valesti. Toiming katkestati");
  	}
}
?>

<h1>Allalaadimise lisamine</h1>
<p style="color: red; font-size: 16pt;">Hoiatus: See liides pole mõeldud tavakasutajatele. Kui olete tavakasutaja, SULGEGE SEE LEHT KOHE!</p>
<p style="color: yellow;">Allalaadimise lisamisel ei tohi ühtegi järgnevat etappi vahele jätta. Vastasel korral on üksus allalaadimise lehel rikutud.</p>
<ol>
<li>Tekstipõhiste metaandmete lisamine</li>
<li>Allalaadimise linkide lisamine</li>
<li style="font-weight: bold;">Pisipiltide lisamine</li>
</ol>
<form name="form1" action="?doc=dload_add_features&s=4&id=<?php echo $_GET["id"]; ?>" method="post">
<table>
<tr>
<td>Piltide asukohad (üks asukoht ühel real)</td>
<td><textarea name="picts"></textarea></td>
</tr>
</table>
<input type="submit" value="Jätka"></input>
</form>
