<?php 
    if(session_status()!=PHP_SESSION_ACTIVE) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../../style.css"/>
<?php
include("../../connect.php");
$query = "SELECT * FROM schedules ORDER BY id DESC";
?>
</head>
<body>
	<div style="width: 600px; margin: auto"><img width=600 src="../../resources/banner.png"/></div>
	<div class="mainpage">
		<h1>Eemalda sündmus</h1>
		<a href="..">Tagasi</a>
		<?php
			if ((empty($_SESSION["usr"])) || ($_SESSION["level"] != "owner"))
			{
				die('<p>Sisu muutmiseks peate olema sisse logitud omaniku kontoga.<br/>E: 001<br/><br/><a href="..">Tagasi</a></p>');
			}
			if (!empty($_POST)) {
				$id = $_POST["id"];
				$sql = 'DELETE FROM schedules WHERE ID=' . $id;
				if ($connection->query($sql) === TRUE) {
					$_POST = array();
					echo '<span style="color: #00ff00; ">Õnnestus! Kirje eemaldati andmebaasist</span><br/>';
				} else {
					echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
				}
			}
		?>
		<form action="index.php" method="post">
			<table>
			<tr>
			<td>Sündmuse ID (vt tabel)</td>
			<td><input style="width: 97%;" name="id" type="text" placeholder="nt 1"></input></td>
			</tr>
			<tr>
				<td colspan=2>
					<input type="submit" value="Eemalda"></input>
				</td>
			</tr>
			</table>
		</form>
		<hr>
		<h2>Praegused sündmused</h2>
		<table>
		<tr>
		<th>ID</th>
		<th>Sündmus</th>
		<th>Aeg</th>
		<th>Kanal</th>
		<th>Link</th>
		</tr>
		<?php
		$result = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_array($result)) {
			echo '<tr>';
			for ($i = 0; $i < 5; $i++) {
				if (str_replace("://", "", $row[$i]) == $row[$i]) {
					echo '<td>' . $row[$i] . '</td>';
				} else {
					echo '<td><a href="' . $row[$i] . '">Link</a></td>';
				}
			}
			echo '</tr>';
		}
		?>
		</table>
	</div>
</body>
</html>
