<?php 
	if (!empty($_GET["s"])) {
		echo '
		<h2 id="Others">Other downloads</h2>
		<p>Other downloadble files.</p>
		';
		echo '<table>';
		include("common/connect.php");
		$query = "SELECT * FROM dloads WHERE dtype = 5 ORDER BY(ID) DESC";
		$result = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_array($result)) {
			echo '<tr><td style="width: 10%;">';
			$subquery = "SELECT * FROM dscrnshots WHERE dload = " . $row[0] . " ORDER BY(ID) DESC";
			$hit = mysqli_query($connection, $subquery);
			while ($r2 = mysqli_fetch_array($hit)) {
				echo '<td><img width=200 src="' . $r2[1] . '"/></td>';
				break;
			}

			echo '<td>';
			if ($row[4] == "") {
				echo $row[2];
			} else {
				echo $row[4];
			}
			echo '
					</td>
					<td>
						<a href="?doc=download&id=' . $row[0] . '">Details and download</a>
					</td>
				  </tr>';
		}
	} else {
		echo '';
	}
?>
