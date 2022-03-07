<?php
	include("common/comments.php");
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$loggedin = FALSE;
	if ((!empty($_SESSION)) && ($_SESSION["level"] == "owner")) {
		$loggedin = TRUE;
	}
	if (empty($_GET["id"])) {
		die('Vajalik on allalaadimise ID');	
	}
	$id = $_GET["id"];
	include("common/connect.php");
	$q = "SELECT * FROM dloads ORDER BY(ID) ASC";
	$qmax = mysqli_query($connection, $q);
	$max = 0;
	while ($m = mysqli_fetch_array($qmax)) {
		$max = $m["ID"];
	}
	$query = "SELECT * FROM dloads WHERE ID=" . $id;
	$query2 = "SELECT * FROM dscrnshots WHERE DLOAD = " . $id;
	$query3 = "SELECT * FROM dlinks WHERE DLOAD = " . $id;
	$meta = mysqli_query($connection, $query);
	$pictures = mysqli_query($connection, $query2);
	$links = mysqli_query($connection, $query3);
	if (mysqli_num_rows($meta) == 0) {
		if ($id > $max) {
			die("Seda allalaadimist ei eksisteeri andmebaasis");
		} else {
			die("See allalaadimine kustutati andmebaasist");
		}
	}
	while ($row = mysqli_fetch_array($meta)) {
		echo '<h2>' . $row[2] . '</h2>';
		if ($loggedin) {
			echo '<a href="?doc=development&s=9&id=' . $id . '">Muuda/kustuta</a>';
		}
		echo '<p>Kategooria: ';
		if ($row[1] == "1") {
			echo '<a href="?doc=dloads&s=1">Pakkfailid</a>';	
		}
		else if ($row[1] == "2") {
			echo '<a href="?doc=dloads&s=2">PowerPoint</a>';	
		}
		else if ($row[1] == "3") {
			echo '<a href="?doc=dloads&s=3">Tarkvara</a>';	
		}
		else if ($row[1] == "4") {
			echo '<a href="?doc=dloads&s=4">Taustapildid</a>';	
		}
		else if ($row[1] == "5") {
			echo '<a href="?doc=dloads&s=5">Muu</a>';	
		}
		echo '</p>';
		while ($img = mysqli_fetch_array($pictures)) {
			echo '<a href="' . $img[1] . '"><img style="width: 50%" src="' . $img[1] . '"/></a>';
		}
		if ($row[1] != "4") {
		echo '<p>' . $row[3] . '</p>';
			echo '<h3>Allalaadimise lingid</h3>';
			while ($link = mysqli_fetch_array($links)) {
				if ($link[2] == "1") {
					echo 'Põhiline link: <a href="' . $link[1] . '">' . $link[1] . '</a><br/>';
				} else {
					echo 'Alternatiivne link: <a href="' . $link[1] . '">' . $link[1] . '</a><br/>';
				}
				echo 'Kontrollsumma (MD5): ' . $link[3] . '<br/><br/>';
			}
		}
	}
?>
<h2>Kommentaarid</h2>
<hr>
<?php
$query = "SELECT * FROM general_comments WHERE THREAD = 2 AND REPLY = 0 AND PAGE_ID = " . $id;
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_array($result)) {
	DisplayComments($connection, $row, $_GET["id"], 0, 2);
}
} else {
echo "<p>Kommentaare ei ole</p>";
}
?>
<hr>

<?php echo '<a href="common/post.php?th=2&id=' . $_GET["id"] . '">Lisa kommentaar</a>';?>
