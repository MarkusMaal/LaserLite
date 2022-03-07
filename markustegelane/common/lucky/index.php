<?php
$lang = "en-US";
if (!empty($_COOKIE["lang"])) {
	$lang = $_COOKIE["lang"];
}
$maindocs = array("about", "changelog", "clinks", "dloads", "faq", "game", "home", "usrnames");
if (!empty($_SESSION["usr"])) {
array_push($maindocs, "development");
array_push($maindocs, "upload");
}
$randomuris = array();

foreach ($maindocs as &$maindoc) {
	for ($i = 1; $i <= 9; $i++) {
		if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/content/" . $lang . "/" . $maindoc . "/" . $i . ".php")) {
			array_push($randomuris, "?doc=" . $maindoc . "&s=" . $i);
			//echo "?doc=" . $maindoc . "&s=" . $i . "<br/>";
		}
	}
}
array_push($randomuris, "?doc=vids&channel=mt");
array_push($randomuris, "?doc=vids&channel=mtp");
array_push($randomuris, "?doc=vids&channel=mas");
array_push($randomuris, "?doc=vids&channel=paktc");
array_push($randomuris, "?doc=vids&channel=cqvmix");
array_push($randomuris, "../x?p=channel");
array_push($randomuris, "../x?p=streams");
array_push($randomuris, "../channel_db");

include("../connect.php");
$query = "SELECT ID FROM dloads";
$randids = array();
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
	array_push($randids, $row[0]);
}
for ($i = 1; $i <= 5; $i++) {
	array_push($randomuris, "?doc=download&id=" . $randids[array_rand($randids, 1)]);
}
$final = "/markustegelane/" . $randomuris[array_rand($randomuris, 1)];
echo '<meta http-equiv="refresh" content="0; url=' .$final .'" />';
?>
