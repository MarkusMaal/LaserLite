<?php 
	if (!empty($_GET["s"])) {
		echo '<table><tr>
		<td style="width: 25%;">
		<img src="images/kat/software.svg" style="width: 95%; background-clip: content-box; background: linear-gradient(#0000 0%, #0000 7%, #018f 7%, #018f 16%, #ffff 16%, #ffff 75%, #0000 75%); background-position: 20px 20px;">
		</td>
		<td style="vertical-align: top; padding-top: 15px;">
		<h2 id="Software">Markuse tarkvara</h2>
		<p>Erinevad tarkvaraprogrammid, mida olen enda videotes näidanud.
		</p>
		</td>
	</tr></table>';

		echo '<div style="width: 25%; margin: auto;"><h3>Javascript mängud</h3><p>Mängud, mis töötavad otse veebibrauseris</p><a href="?s=3">Ava</a></div>';
		echo '<table>';
		include("common/connect.php");
		$query = "SELECT * FROM dloads WHERE dtype = 3 ORDER BY (ID) DESC";
		$result = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_array($result)) {
	 		echo '<tr>';
			echo '<td style="width: 10%;">';
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
