<h2>Uued videod</h2>
<table class="table_s">
<?php
$name = $_GET['channel'];
$maxResults = 10;
$channel = 'null';
if ($name == "mt") {
    $channel  = 'MarkusTegelane';
}
else if ($name == "mtp") {
    $channel  = 'MarkusTegelane+';
}
else if ($name == "hmt") {
    $channel  = '#markusTegelane';
}
else if ($name == "mas") {
    $channel = 'Markuse asjad';
}
else if ($name == "paktc") {
    $channel = 'Press any key to continue...';
}
else if ($name == "cqvmix") {
    $channel = 'cqvmix';
}
if ($channel == "null") {
    echo '<span style="color: red">Tõrge: </span>Tundmatu GET väljakutse. Kontrollige veebilehe aadressi.';
} else {
    echo '<tr style="background-color:#333333; text-align:center; color:#ffffff;"><td>Pisipilt</td><td>Pealkiri</td><td>Link</td></tr>';
    include("common/connect.php");
    $query = 'SELECT * FROM channel_db WHERE Kanal = "' . $channel . '" AND Avalik = TRUE AND Kustutatud = FALSE ORDER BY Kuupäev DESC, ID DESC LIMIT 10';
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)){
        echo '<tr class="secrow" >';
        echo '<td style="width:85px;"><img style="width:70px;" src="/channel_db/thumbs/'. $row["ID"] . '.jpg"></td>';
        echo '<td style="width:84%;">' . $row["Video"] . '</td>';
        echo '<td style="width:50px; text-align:center;"><a href="'. $row["URL"] . '">Link</a></td>';
        echo '</tr>';
    }
}
?>
</table>
<br/>
<br/>
<a class="listitems" href="#" onclick="goBack()">Tagasi</a>
<script>            
function goBack() {
    window.history.back();
}
</script>
