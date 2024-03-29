<?php include("../head.php");
?>
<?php 
if (!empty($_SESSION) && ($_SESSION["level"] == "owner")) {
	include("../connect.php");
} else {
	die('<br/><span style="color: #ff0000">Selleks, et kasutada haldamistööriistu peate sisse logima omaniku kontoga.<br/></span>
	<a href="/markustegelane/common/config/login.php?redir=mas_db">Logi sisse</a>');
}
if (!empty($_POST)) {
	echo '<h1>Andmebaasi muutmine</h1>';
	if ($connection->connect_error) {
		die('<span style="color: #ff0000">Andmebaasige ühendumine nurjus.
		Olge kindlad, et andmebaas toiming ning, et teie kinnitusparool oli õige</span>');
	}
	$sql = "";
	$sql2 = "none";
	if (!empty($_POST["wallpaper_id"])) {
		// change wallpaper code
		$sql = 'UPDATE mas_wallpapers SET ASUKOHT = "' . $_POST["location"] . '" WHERE ID=' . $_POST["wallpaper_id"];
		$sql2 = 'UPDATE mas_wallpapers SET VERSIOONI_ID = ' . $_POST["ver_id"] . ' WHERE ID=' . $_POST["wallpaper_id"];
	}
	else if (!empty($_POST["remove_id"])) {
		// delete wallpaper code
		$sql = 'DELETE FROM mas_wallpapers WHERE ID = ' . $_POST["remove_id"];
	}
	else if (!empty($_POST["location"])) {
		// add wallpaper code
		$query = "SELECT ID FROM mas_wallpapers";
		$result = mysqli_query($connection, $query);
		$new_id = 0;
		while ($row = mysqli_fetch_array($result)) {
			$new_id = $row[0];
		}
		$new_id++;
		$sql1 = 'ALTER TABLE mas_wallpapers AUTO_INCREMENT = ' . $new_id ;
		if ($connection->query($sql1) === FALSE) {
			echo $connection->error;	
		}
		$sql = 'INSERT INTO mas_wallpapers (ASUKOHT, VERSIOONI_ID) VALUES ("' .
		    	$_POST["location"] . '", ' . $_POST["ver_id"] . ')';
	}
	if ($connection->query($sql) === TRUE) {
		$_POST = array();
	} else {
		echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
	}
	if ($sql2 != "none") {
		if ($connection->query($sql2) === TRUE) {
			$_POST = array();
		} else {
			echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
		}
	}
	$connection->close();
	echo '<span style="color: #00ff00; ">Toimingud sooritatud</span>';
	echo '<br/><a href="index.php">Tagasi</a>';
	die();
}
?>
<h1>Taustapiltide haldamine</h1>
<table>
<tr>
	<td class="bigbox">
		<h1>Lisa taustapilt</h1>
		<form method="post" action="index.php" id="form1" name="form1" enctype="multipart/mixed">
			<table>
			<tr>
			<td>
				<p>Asukoht</p>
			</td>
			<td>
				<input type="text" name="location"></input>
			</td>
			</tr>
			<tr>
			<td>
				<p>Versiooni ID</p>
			</td>
			<td>
				<select name="ver_id">
				<?php
					include("../connect.php");
					$query = "SELECT * FROM mas_db";
					$result = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="' . $row[0] . '">' . $row["ID"] . ' <-> ' . $row["VERSIOON"] . ' - ' . $row["LVERSIOON"] . ' ' . substr($row["NIMI"], 0,10) . '</option>';
					}
				?>
				</select>
			</td>
			<tr>
			<td colspan=2 style="text-align: center;">
				<a href="#" onclick="document.getElementById('form1').submit();">Lisa taustapilt</a>
			</td>
			</tr>
			</table>
		</form>
	</td>
	
	<td class="bigbox">
		<h1>Muuda taustapilt</h1>
		<form method="post" action="index.php" id="form2" name="form2" enctype="multipart/mixed">
			<table>
			<tr>
			<td>
				<p>Taustapildi ID</p>
			</td>
			<td>
				<select name="wallpaper_id">
				<?php
					include("../connect.php");
					$query = "SELECT * FROM mas_wallpapers";
					$result = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="' . $row[0] . '">' . $row[0] . ' &lt;-&gt; ' . substr($row["ASUKOHT"], 0, 10) . '</option>';
					}
				?>
				</select>
			</td>
			</tr>
			<tr>
			<td>
				<p>Asukoht</p>
			</td>
			<td>
				<input type="text" name="location"></input>
			</td>
			</tr>
			<tr>
			<td>
				<p>Versiooni ID</p>
			</td>
			<td>
				
				<select name="ver_id">
				<?php
					include("../connect.php");
					$query = "SELECT * FROM mas_db";
					$result = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="' . $row[0] . '">' . $row[0] . ' &lt;-&gt; ' . $row["VERSIOON"] . ' - ' . $row["LVERSIOON"] . ' ' . substr($row["NIMI"], 0,10) . '</option>';
					}
				?>
				</select>
			</td>
			</tr>
			<tr>
			<td colspan=2 style="text-align: center;">
				<a href="#" onclick="document.getElementById('form2').submit();">Muuda taustapilti</a>
			</td>
			</tr>
			</table>
		</form>
	</td>
	
	
	<td class="bigbox">
		<h1>Eemalda taustapilt</h1>
		<form method="post" action="index.php" id="form3" name="form3" enctype="multipart/mixed">
			<table>
			<tr>
			<td>
				<p>Taustapildi ID</p>
			</td>
			<td>
				<select name="remove_id">
				<?php
					include("../connect.php");
					$query = "SELECT * FROM mas_wallpapers";
					$result = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value="' . $row[0] . '">' . $row[0] . ' &lt;-&gt; ' . substr($row["ASUKOHT"], 0, 10) . '</option>';
					}
				?>
				</select>
			</td>
			</tr>
			<tr>
			<td colspan=2 style="text-align: center;">
				<a href="#" onclick="document.getElementById('form3').submit();">Kustuta taustapilt</a>
			</td>
			</tr>
			</table>
		</form>
	</td>
</tr>
</table>
<br/><br/>
	<table>
		<tr>
			<th>
				Taustapildid
			</th>
			<th>
				Versioonid
			</th>
		</tr>
		<tr>
			<td style="padding: 0px;">
				<?php
				error_reporting(E_ALL);
				ini_set('display_errors', '1');
				include("../connect.php");

				//test if connection failed
				if(mysqli_connect_errno()){
					die("connection failed: "
						. mysqli_connect_error()
						. " (" . mysqli_connect_errno()
						. ")");
				}
				$query = "SELECT * FROM mas_wallpapers";
				$result = mysqli_query($connection, $query);
				echo '<table><tr><th>ID</th><th>Asukoht</th><th>Ver. ID</th></tr>';
				while ($row = mysqli_fetch_array($result)) {
					echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><tr>';
				}
				echo '</table>';
				?>
			</td>
			<td style="vertical-align: top; padding: 0px;">
				<?php
				error_reporting(E_ALL);
				ini_set('display_errors', '1');
				include("../connect.php");

				//test if connection failed
				if(mysqli_connect_errno()){
					die("connection failed: "
						. mysqli_connect_error()
						. " (" . mysqli_connect_errno()
						. ")");
				}
				$query = "SELECT * FROM mas_db";
				$result = mysqli_query($connection, $query);
				echo '<table><tr><th>ID</th><th>Nimi</th></tr>';
				while ($row = mysqli_fetch_array($result)) {
					echo '<tr><td>' . $row[0] . '</td><td>' . $row[4] . '</td><tr>';
				}
				echo '</table>';
				?>
			</td>
		</tr>
</table>

<?php include("../foot.php"); ?>
