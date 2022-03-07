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

<h1>Modify downloads</h1>
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
		<th>Type</th>
		<th>Title (in Estonian)</th>
		<th>Description (in Estonian)</th>
		<th>Title (in English)</th>
		<th>Description (in English))</th>
		</tr>';
	} else {
	
		echo'<table>';
	}
	if ((!empty($_SESSION["usr"])) && ($_SESSION["level"] == "owner")) {
		if (empty($_GET["id"])) {
			$query = "SELECT * FROM dloads";
			$result = mysqli_query($connection, $query);
			$types = array("Batch files", "PowerPoint", "Markus' software", "Wallpapers", "Other");
			$finalid = 1;
			while ($row = mysqli_fetch_array($result)) {
				$en_title = $row["MUI_DTITLE"];
				if ($en_title == "") {
					$en_title = "Copy";
				}
				$en_description = $row["MUI_DDESC"];
				if ($en_description == "") {
					$en_description = "Copy";
				}
				echo '<tr>';
				echo '<td><a href="' . $_SERVER["REQUEST_URI"] . '&id=' . $row["ID"] . '">' . $row["ID"] . '</a></td>';
				echo '<td>' . $types[$row["DTYPE"]-1] . '</td>';
				echo '<td>' . $row["DTITLE"] . '</td>';
				if ($row["DDESC"] == "pht") {
					echo '<td>No description.</td>';
				} else {
					echo '<td>' . $row["DDESC"] . '</td>';
				}
				echo '<td>' . $en_title . '</td>';
				echo '<td>' . $en_description . '</td>';
				echo '</tr>';
				$finalid ++;
			}
			echo '</table>';
			echo '<a href="?doc=dload_add_features&s=1">Add new</a><br/>';
			echo '<a href="?doc=upload">Upload a picture</a><br/>';
			echo '<a href="?doc=dload_addimages&s=1">Link picture to a download</a><br/>';
			echo '<a href="?doc=dload_addimages&s=2">Unlink picture from a download</a><br/>';
		} else {
			$row = GetRows("dloads", $connection, false);
			$row2 = GetRows("dlinks", $connection, true);
			$row3 = GetRows("dscrnshots", $connection, true);
			$types = array("Batch files", "PowerPoint", "Markus' software", "Wallpapers", "Other");
			echo '<tr>';
			echo '<td>Title</td>';
			echo '<td><input name="title" type="text" value="';
			if (!empty($row["DTITLE"])) {
				echo $row["DTITLE"];
			}
			echo '"></input></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Description</td>';
			echo '<td><textarea name="desc" style="width: 500px; height: 200px;">';
			if (!empty($row["DDESC"])) {
				echo $row["DDESC"];
			}
			echo '</textarea></td>';
			echo '</tr>';
			echo '<tr><td>Type</td><td><select name="type">';
			for ($x = 1; $x <= 5; $x++) {
				$sel = "";
				if ($row["DTYPE"] == $x) {
					$sel = " selected";
				}
				echo '<option value="' . $x . '"' . $sel . '>' . $types[$x-1] . '</option>';
			}
			echo '</select></td>';
			echo '<tr><td>Title (MUI_en-US)</td><td><input type="text" name="title_en" value="';
			if (!empty($row["MUI_DTITLE"])) {
				echo $row["MUI_DTITLE"];
			}
			echo '"></input></td></tr>';
			echo '<tr><td>Description (MUI_en-US)</td><td><textarea name="desc_en" style="width: 500px; height: 200px;">';
			if (!empty($row["MUI_DDESC"])) {
				echo $row["MUI_DDESC"];
			}
			echo '</textarea></td></tr>';
			
			echo '<tr><td>URL: </td><td><textarea name="url" style="width: 700px; height: 100px;">';
			foreach  ($row2 as &$r) {
				echo $r["LINK_URI"] . "~" . $r["LINK_PRIMARY"] . "~" . $r["CHKSUM"] . "\r\n";
			}
			echo '</textarea></td></tr>';
			
			echo '<tr><td>Screenshots: </td><td><textarea name="scrnshot" style="width: 400px; height: 50px;">';
			foreach  ($row3 as &$r) {
				echo $r["URI"] . "\r\n";
			}
			echo '</textarea></td></tr>';
			if (!empty($row["DTITLE"])) {
				echo '</table><br/>
				  	<select name="actiontype">
				  	<option selected value="*">Modify</option>
				  	<option value="-">Remove</option>
				  	</select>';
			} else {
			
				echo '</table><br/>
				  	<select name="actiontype">
				  	<option selected value="+">Add</option>
				  	</select>';
			}
			echo '<br/><br/><input type="submit" value="submit"></input>';
		}
	} else {
		echo 'Access is denied. Please log in with an owner account.<br/>';
	}
?>
</form>
