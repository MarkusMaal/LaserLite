<?php
include("common/connect.php");
include("common/comments.php");
function br2nl( $input ) {
    return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($input))));
}
//get results from database
$result = mysqli_query($connection,"SELECT * FROM blog ORDER BY post_time DESC");
$all_property = array();  //declare an array for saving property

//showing property
/* echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag*/
while ($property = mysqli_fetch_field($result)) {
    array_push($all_property, $property->name);  //save those to array
}
// echo '</tr>'; //end tr tag

//showing all data
echo '<h2 id="Blog">Blogi</h2>';
if (!empty($_SESSION)) {
    if ($_SESSION["level"] != "moderator") {
    	echo '<a href="?doc=development&s=4">Loo uus postitus</a>';
    }
}
$posts = 1;
while ($row = mysqli_fetch_array($result)) {
    echo '<h3>' . $row["title"] . '</h3>';
    if (!empty($_SESSION)) {
    	if ($_SESSION["level"] != "moderator") {
    		echo '<a href="?doc=development&s=3&id=' . $row[0] . '">Muuda/kustuta</a>';
    	}
    }
    echo '<p style="font-size: 10px;">';
	echo $row["post_time"];
	echo ' UTC+0</p>';
    echo '<p>' . explode("</div>", explode("<br>", explode("\n", $row["body"])[0])[0])[0] . '</p><hr>'; 
    echo '<a href="?s=5&id=' . $row["id"] . '">Loe edasi</a><br/>';
	$r1 = mysqli_query($connection, "SELECT * FROM general_comments WHERE PAGE_ID = " . $row["id"] . " AND THREAD = 3 AND REPLY = 0 ORDER BY(ID) DESC");
	if (mysqli_num_rows($r1) > 0) {
		echo '<a href="?s=5&id=' . $row["id"] . '">' . mysqli_num_rows($r1) . ' ';
		if (mysqli_num_rows($r1) == 1) {
			echo 'kommentaar';
		} else {
			echo 'kommentaari';
		}
		echo '</a>';
	} else {
    	echo '<a href="common/post.php?th=3&id=' . $row["id"] . '">Lisa kommentaar</a>';
    }
	if ($posts == 3) {
		if (empty($_GET["s"])) {
			echo '<br/><hr>';
			break;
		} else {
			echo '<hr>';
		}
	} else {
		$posts++;
		echo '<br/><hr>';
	}
}
?>
<?php
if (empty($_GET["s"])) {
	echo '<a href="?s=4">Kuva kõik postitused</a>';
}
?>
<br/>
<a href="#">Tagasi algusesse</a>
