<?php
	include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
	if ((!empty($_POST)) && (!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner"))
	{
		$query = "SELECT * FROM dscrnshots WHERE DLOAD = " . $_GET["id"];
		$result = mysqli_query($connection, $query);
		$shots = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($shots, $row[0]);
		}
		
		$query = "SELECT * FROM dlinks WHERE DLOAD = " . $_GET["id"];
		$result = mysqli_query($connection, $query);
		$links = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($links, $row[0]);
		}
		
		$sql = "";
		if (!empty($_POST["actiontype"])) {
			if ($_POST["actiontype"] == "*") {
				$sql = 'UPDATE dloads SET ' .
						'DTITLE = "' . $_POST["title"] . 
						'", DDESC = "' . $_POST["desc"] . 
						'", DTYPE = ' . $_POST["type"] . 
						', MUI_DTITLE = "' . $_POST["title_en"] . 
						'", MUI_DDESC = "' . $_POST["desc_en"] . 
						'" WHERE ID = ' . $_GET["id"];
				$alinks = explode("\r\n", $_POST["url"]);
				$ascrn = explode("\r\n", $_POST["scrnshot"]);
				$i = 0;
				foreach ($alinks as &$c) {
					$post = explode("~", $alinks[$i]);
					$sql2 = 'UPDATE dlinks SET ' .
							'LINK_URI = "' . $post[0] . 
							'", LINK_PRIMARY = ' . $post[1] . 
							', CHKSUM = "' . $post[2] . 
							'" WHERE ID = ' . $links[$i];
					}
					$post = $ascrn[$i];
					$sql3 = 'UPDATE dscrnshots SET ' .
							'URI = "' . $post . 
							'" WHERE ID = ' . $shots[$i];
					if ($connection->query($sql1) !== TRUE) {
						echo 'ID = ' . $sql1 . ' <br/><br/> ' . $connection->error . '<br/>';
					}
					if ($connection->query($sql2) !== TRUE) {
						echo 'ID = ' . $sql2 . ' ~ ' . $connection->error . '<br/>';
					}
					if ($connection->query($sql3) !== TRUE) {
						echo 'ID = ' . $sql3 . ' ~ ' . $connection->error;
					}
					$i++;
			} else if ($_POST["actiontype"] == "-") {
				if ($_POST["title"] != "") {
					$sql = "DELETE FROM dloads WHERE ID = " . $_GET["id"];
					if ($connection->query($sql) !== TRUE) {
						echo 'ID = ' . $sql . ' ~ ' . $connection->error . '<br/>';
					} else {
						echo 'Õnnestus';
					}
				}
				if ($_POST["url"] != "") {
					$sql = "DELETE FROM dlinks WHERE DLOAD = " . $_GET["id"];
					if ($connection->query($sql) !== TRUE) {
						echo 'ID = ' . $sql . ' ~ ' . $connection->error . '<br/>';
					} else {
						echo 'Õnnestus';
					}
				}
				if ($_POST["scrnshot"] != "") {
					$sql = "DELETE FROM dscrnshots WHERE DLOAD = " . $_GET["id"];
					if ($connection->query($sql) !== TRUE) {
						echo 'ID = ' . $sql . ' ~ ' . $connection->error . '<br/>';
					} else {
						echo 'Õnnestus';
					}
				}
			}
				if ($connection->query($sql) === TRUE) {
					echo 'Õnnestus';
					$_POST = array();
				} else {
					echo 'Viga';
				}
				die();
		}
	}
?>

<h1>Allalaadimiste muutmine</h1>
<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
<?php
	function GetRows($q, $c, $ac) {
		if ($ac == false) {
			$query = "SELECT * FROM " . $q . " WHERE ID = " . $_GET["id"];
		} else {
			$query = "SELECT * FROM " . $q . " WHERE DLOAD = " . $_GET["id"];
		}
		$result = mysqli_query($c, $query);
		$wholearray = array();
		while ($row = mysqli_fetch_array($result)) {
			array_push($wholearray, $row);
		}
		if ($ac == true) 
		{
			return $wholearray;
		} else {
			if ($wholearray != array()) {
				return $wholearray[0];
			} else {
				return " ";
			}
		}
	}
	if (empty($_GET["id"])) {
		echo'<table>
		<tr>
		<th>ID</th>
		<th>Tüüp</th>
		<th>Pealkiri (eesti keeles)</th>
		<th>Kirjeldus (eesti keeles)</th>
		<th>Pealkiri (inglise keeles)</th>
		<th>Kirjeldus (inglise keels))</th>
		</tr>';
	} else {
	
		echo'<table>';
	}
	if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		if (empty($_GET["id"])) {
			$query = "SELECT * FROM dloads";
			$result = mysqli_query($connection, $query);
			$types = array("Pakkfailid", "PowerPoint", "Markuse tarkvara", "Taustapildid", "Muu");
			$finalid = 1;
			while ($row = mysqli_fetch_array($result)) {
				$en_title = $row["MUI_DTITLE"];
				if ($en_title == "") {
					$en_title = "Kopeeri";
				}
				$en_description = $row["MUI_DDESC"];
				if ($en_description == "") {
					$en_description = "Kopeeri";
				}
				echo '<tr>';
				echo '<td><a href="' . $_SERVER["REQUEST_URI"] . '&id=' . $row["ID"] . '">' . $row["ID"] . '</a></td>';
				echo '<td>' . $types[$row["DTYPE"]-1] . '</td>';
				echo '<td>' . $row["DTITLE"] . '</td>';
				if ($row["DDESC"] == "pht") {
					echo '<td>Kirjeldus puudub.</td>';
				} else {
					echo '<td>' . $row["DDESC"] . '</td>';
				}
				echo '<td>' . $en_title . '</td>';
				echo '<td>' . $en_description . '</td>';
				echo '</tr>';
				$finalid ++;
			}
			echo '</table>';
			echo '<a href="?doc=dload_add_features&s=1">Lisa uus</a><br/>';
			echo '<a href="?doc=upload">Pildi üleslaadimine</a><br/>';
			echo '<a href="?doc=dload_addimages&s=1">Pildi sidumine allalaadimisega</a><br/>';
			echo '<a href="?doc=dload_addimages&s=2">Pildi lahti sidumine allalaadimisest</a><br/>';
		} else {
			$row = GetRows("dloads", $connection, false);
			$row2 = GetRows("dlinks", $connection, true);
			$row3 = GetRows("dscrnshots", $connection, true);
			$types = array("Pakkfailid", "PowerPoint", "Markuse tarkvara", "Taustapildid", "Muu");
			echo '<tr>';
			echo '<td>Pealkiri</td>';
			echo '<td><input name="title" type="text" value="';
			if (!empty($row["DTITLE"])) {
				echo $row["DTITLE"];
			}
			echo '"></input></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Kirjeldus</td>';
			echo '<td><textarea name="desc" style="width: 500px; height: 200px;">';
			if (!empty($row["DDESC"])) {
				echo $row["DDESC"];
			}
			echo '</textarea></td>';
			echo '</tr>';
			echo '<tr><td>Tüüp</td><td><select name="type">';
			for ($x = 1; $x <= 5; $x++) {
				$sel = "";
				if ($row["DTYPE"] == $x) {
					$sel = " selected";
				}
				echo '<option value="' . $x . '"' . $sel . '>' . $types[$x-1] . '</option>';
			}
			echo '</select></td>';
			echo '<tr><td>Pealkiri (MUI_en-US)</td><td><input type="text" name="title_en" value="';
			if (!empty($row["MUI_DTITLE"])) {
				echo $row["MUI_DTITLE"];
			}
			echo '"></input></td></tr>';
			echo '<tr><td>Kirjeldus (MUI_en-US)</td><td><textarea name="desc_en" style="width: 500px; height: 200px;">';
			if (!empty($row["MUI_DDESC"])) {
				echo $row["MUI_DDESC"];
			}
			echo '</textarea></td></tr>';
			
			echo '<tr><td>URL: </td><td><textarea name="url" style="width: 700px; height: 100px;">';
			foreach  ($row2 as &$r) {
				echo $r["LINK_URI"] . "~" . $r["LINK_PRIMARY"] . "~" . $r["CHKSUM"] . "\r\n";
			}
			echo '</textarea></td></tr>';
			
			echo '<tr><td>Kuvatõmmised: </td><td><textarea name="scrnshot" style="width: 400px; height: 50px;">';
			foreach  ($row3 as &$r) {
				echo $r["URI"] . "\r\n";
			}
			echo '</textarea></td></tr>';
			if (!empty($row["DTITLE"])) {
				echo '</table><br/>
				  	<select name="actiontype">
				  	<option selected value="*">Muuda</option>
				  	<option value="-">Eemalda</option>
				  	</select>';
			} else {
			
				echo '</table><br/>
				  	<select name="actiontype">
				  	<option selected value="+">Lisa</option>
				  	</select>';
			}
			echo '<br/><br/><input type="submit" value="saada"></input>';
		}
	} else {
		echo 'Juurdepääs keelatud. Logige sisse omaniku kontoga.<br/>';
	}
?>
</form>
