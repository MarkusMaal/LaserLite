<?php 
	if (!empty($_GET["s"])) {
		echo '<table><tr>
		<td style="width: 25%;">
		<img src="images/kat/batch.svg" style="width: 100%;">
		</td>
		<td style="vertical-align: top; padding-top: 15px;">
		<h2 id="Pakkfailid">Pakkfailid</h2>
		<p>Lihtsad pakkfailid, mille olen ise loonud. Ühilduvad ainult operatsioonsüsteemiga Windows.<br>
		Soovitatav on kasutada Windows 8.1 või vanemat versiooni (uuemates versioonides esineb ühilduvusprobleeme).</p>
		</td>
	  </tr></table>';
		echo '<table>';
		include("common/connect.php");
		$query = "SELECT * FROM dloads WHERE dtype = 1 ORDER BY (ID) DESC";
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
		echo '
		<h2>Valige kategooria</h2>
		<img src="images/kat/batch.svg" style="width: 1%; margin-right: 10px;"/><a href="?doc=dloads&s=1">Pakkfailid</a><br/>
		<img src="images/kat/powerpoint.svg" style="width: 1%; margin-right: 10px;"/><a href="?doc=dloads&s=2">PowerPoint</a><br/>
		<img src="images/kat/software.svg" style="width: 1%; margin-right: 10px; background: gray;"/><a href="?doc=dloads&s=3">Markuse tarkvara</a><br/>
		<img src="images/kat/wallpapers.svg" style="width: 1%; margin-right: 10px;"/><a href="?doc=dloads&s=4">Taustapildid</a><br/>
		<img src="images/kat/other.svg" style="width: 1%; margin-right: 10px; background: black"/><a href="?doc=dloads&s=5">Muu</a>
		';
		if ((!empty($_SESSION)) && ($_SESSION["level"] == "owner")) {
			echo '<br><hr><a href="?doc=dload_add_features&s=1">Lisa allalaaditav fail</a><br/>';
			echo '<a href="?doc=upload&s=1">Pildi üleslaadimine</a><br/>';
			echo '<a href="?doc=dload_addimages&s=1">Pildi sidumine allalaadimisega</a><br/>';
			echo '<a href="?doc=dload_addimages&s=2">Pildi eemaldamine allalaadimisest</a><br/>';
		}
	}
?>
