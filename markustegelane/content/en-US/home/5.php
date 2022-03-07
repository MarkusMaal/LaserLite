<?php
include("common/connect.php");
include("common/comments.php");
if (empty($_GET["id"])) {
die();
}

//get results from database
$result = mysqli_query($connection,"SELECT * FROM eblog WHERE id = " . $_GET["id"] . " ORDER BY(post_time) DESC");
$all_property = array();  //declare an array for saving property

//showing property
/* echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag*/
while ($property = mysqli_fetch_field($result)) {
    array_push($all_property, $property->name);  //save those to array
}
// echo '</tr>'; //end tr tag

//showing all data
$posts = 1;
while ($row = mysqli_fetch_array($result)) {
    echo '<h2>' . $row["title"] . '</h2>';
    if (!empty($_SESSION)) {
    	if ($_SESSION["level"] != "moderator") {
    		echo '<a href="?doc=development&s=3&id=' . $row[0] . '">Modify/delete</a>';
    	}
    }
    echo '<p style="font-size: 10px;">';
	echo $row["post_time"];
	echo ' UTC+0</p>';
    echo '<p>' . $row["body"] . '</p><br/><hr>'; 
	$r1 = mysqli_query($connection, "SELECT * FROM general_comments WHERE PAGE_ID = " . $row["id"] . " AND THREAD = 3 AND REPLY = 0 ORDER BY(ID) DESC");
	echo '<h3>Comments:</h3><hr>';
	if (mysqli_num_rows($r1) > 0) {
		while ($orow = mysqli_fetch_array($r1)) {
			if ($orow != FALSE) {
				DisplayComments($connection, $orow, $row[0], 0, 3);
			}
		}
	} else {
		echo '<p>There are no comments</p>';
	}
	echo '<hr>';
	echo '<a href="common/post.php?th=3&id=' . $row["id"] . '">Add a comment</a>';
	$posts++;
}
?>
<br/><a href="#">Back to top</a>
