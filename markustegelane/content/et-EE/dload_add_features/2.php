<?php
if ((empty($_POST)) || ($_SESSION["level"] != "owner")) {
    die("Allalaadimise lisamiseks tuleb sisse logida omaniku kontoga ja täita vorm eelmisel lehel.");
}
include("common/connect.php");
$sql = 'INSERT INTO dloads (DTYPE, DTITLE, DDESC, MUI_DTITLE, MUI_DDESC) VALUES (' . $_POST["dtype"] . ', "' . str_replace('"', '&quot;', $_POST["etTitle"]) . '", "' . str_replace('"', '&quot;', $_POST["etDescription"]) . '", "' . str_replace('"', '&quot;', $_POST["enTitle"]) . '", "' . str_replace('"', '&quot;', $_POST["enDescription"]) . '")';
echo $sql;
if ($connection->query($sql) === TRUE) {
    $_POST = array();
} else {
    die("Midagi läks valesti. Toiming katkestati");
}
$query = 'SELECT ID FROM dloads ORDER BY ID DESC LIMIT 1';
$result = mysqli_query($connection, $query);
$newitem = mysqli_fetch_array($result)[0];

?>

<h1>Allalaadimise lisamine</h1>
<p style="color: red; font-size: 16pt;">Hoiatus: See liides pole mõeldud tavakasutajatele. Kui olete tavakasutaja, SULGEGE SEE LEHT KOHE!</p>
<p style="color: yellow;">Allalaadimise lisamisel ei tohi ühtegi järgnevat etappi vahele jätta. Vastasel korral on üksus allalaadimise lehel rikutud.</p>
<ol>
<li>Tekstipõhiste metaandmete lisamine</li>
<li style="font-weight: bold;">Allalaadimise linkide lisamine</li>
<li>Pisipiltide lisamine</li>
</ol>
<form name="form1" action="?doc=dload_add_features&s=3&id=<?php echo $newitem; ?>" method="post">
<table>
<tr>
<td>Allalaadimise link<span style="color: #f00">*</span></td>
<td><input name="link" type="text"></input></td>
</tr>
<tr>
<td>Kontrollsumma<span style="color: #f00">*</span></td>
<td><input name="chksum" type="text"></input></td>
</tr>
</table>
<input type="submit" value="Jätka"></input>
</form>
