<?php 
	if (!empty($_GET["s"])) {
		echo '<table><tr>
		<td style="width: 25%;">
		<img src="images/kat/batch.svg" style="width: 100%;">
		</td>
		<td style="vertical-align: top; padding-top: 15px;">
		<h2 id="Pakkfailid">Batch files</h2>
		<p>Simple batch files, I have created. Compatible only with the Windows operating system.<br/>
		Windows 8.1 or earlier recommended (newer versions may have compatibility issues).</p>
		</td>
	  </tr></table>';
		echo '<table>';
		include("common/connect.php");
		$query = "SELECT * FROM dloads WHERE dtype = 1 ORDER BY(ID) DESC";
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
		echo '
		<h2>Pick a category</h2>
		<img src="images/kat/batch.svg" style="width: 1%; margin-right: 10px;"/><a href="?doc=dloads&s=1">Batch files</a><br/>
		<img src="images/kat/powerpoint.svg" style="width: 1%; margin-right: 10px;"/><a href="?doc=dloads&s=2">PowerPoint</a><br/>
		<img src="images/kat/software.svg" style="width: 1%; margin-right: 10px; background: gray;"/><a href="?doc=dloads&s=3">Markus software</a><br/>
		<img src="images/kat/wallpapers.svg" style="width: 1%; margin-right: 10px;"/><a href="?doc=dloads&s=4">Wallpapers</a><br/>
		<img src="images/kat/other.svg" style="width: 1%; margin-right: 10px; background: black"/><a href="?doc=dloads&s=5">Other</a>
		';
	}
?>
