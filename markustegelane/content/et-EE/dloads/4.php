<?php 
	if (!empty($_GET["s"])) {
		echo '<table><tr>
		<td style="width: 25%;">
		<img src="images/kat/wallpapers.svg" style="width: 100%;">
		</td>
		<td style="vertical-align: top; padding-top: 15px;">
		<h2 id="Wallpapers">Taustapildid</h2>
		<p>Erinevad taustapildid/kaanepildid.</p>
		</td>
	</tr></table>';
		echo '<table>';
		include("common/connect.php");
		$query = "SELECT * FROM dloads WHERE dtype = 4 ORDER BY (ID) DESC";
		$result = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_array($result)) {
			echo '<tr><td style="width: 10%;">';
			$subquery = "SELECT * FROM dscrnshots WHERE dload = " . $row[0];
			$hit = mysqli_query($connection, $subquery);
			while ($r2 = mysqli_fetch_array($hit)) {
				echo '<td><img width=200 src="' . $r2[1] . '"/></td>';
				break;
			}
			echo '
					<td>
						' . $row[2] . '
					</td>
					<td>
						<a href="?doc=download&id=' . $row[0] . '">Lisainfo/alla laadimine</a>
					</td>
				  </tr>';
		}
		echo '</table>';
	} else {
		echo '';
	}
?>
