<?php 
	if (!empty($_GET["s"])) {
		echo '<table><tr>
		<td style="width: 25%;">
		<img src="images/kat/software.svg" style="width: 95%; background-clip: content-box; background: linear-gradient(#0000 0%, #0000 7%, #018f 7%, #018f 16%, #ffff 16%, #ffff 75%, #0000 75%); background-position: 20px 20px;">
		</td>
		<td style="vertical-align: top; padding-top: 15px;">
		<h2 id="Software">Markus software</h2>
		<p>Different software programs, I have shown in my videos.
		</p>
		</td>
	</tr></table>';
		echo '<table>';
		include("common/connect.php");
		$query = "SELECT * FROM dloads WHERE dtype = 3 ORDER BY(ID) DESC";
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
		echo '</table>';
	} else {
		echo '';
	}
?>
