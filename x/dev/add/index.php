<?php if(session_status()!=PHP_SESSION_ACTIVE) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="/favicons/plus.ico" />
<link rel="stylesheet" href="../../style.css"/>
<?php
include("../../connect.php");
$query = "SELECT * FROM schedules ORDER BY id DESC";
?>
</head>
<body>
	<div class="mainpage">
		<h1>Uus sündmus</h1>
		<a href="..">Tagasi</a>
		<?php
			if ((empty($_SESSION["usr"])) || ($_SESSION["level"] == "moderator"))
			{
				die('<p>Sisu muutmiseks peate olema sisse logitud omaniku kontoga.<br/>E: 001<br/><br/><a href="..">Tagasi</a></p>');
			}
			if (!empty($_POST)) {
				$a_time = $_POST["et_dh"] . ":" . $_POST["et_dm"] . ":" . $_POST["et_ds"];
				$a_date = $_POST["et_y"] . "-" . $_POST["et_m"] . "-" . $_POST["et_d"];
				$dtime = '("' . $a_date . ' ' . $a_time . '"), ';
				$a_title = '"' . $_POST["event"] . '", ';
				$a_channel = '"' . $_POST["channel"] . '", ';
				$a_url = '"' . $_POST["url"] . '"';
				$sql = 'INSERT INTO schedules (ename, etime, echannel, eurl) VALUES(
						' . $a_title . $dtime . $a_channel . $a_url . ')';
				if ($connection->query($sql) === TRUE) {
					$_POST = array();
					echo '<span style="color: #00ff00; ">Õnnestus! Kirje lisati andmebaasi</span><br/>';
				} else {
					echo '<span style="color: #ff0000; ">Viga: ' . $sql . '<br>' . $connection->error;
				}
			}
		?>
		<form action="index.php" method="post">
			<table>
			<tr>
			<td>Sündmus</td>
			<td><input style="width: 97%;" name="event" type="text" placeholder="Sündmuse pealkiri"></input></td>
			</tr>
			<tr>
			<td>Kuupäev<br/>Kellaaeg</td>
			<td>
				<input style="width: 40px" name="et_y" type="text" placeholder="AAAA"></input>-
				<input style="width: 20px" name="et_m" type="text" placeholder="KK"></input>-
				<input style="width: 20px" name="et_d" type="text" placeholder="PP"></input>
				<br/>
				<input style="width: 20px" name="et_dh" type="text" placeholder="HH"></input>:
				<input style="width: 25px" name="et_dm" type="text" placeholder="MM"></input>:
				<input style="width: 20px" name="et_ds" type="text" placeholder="SS"></input>
			</td>
			</tr>
			<tr>
			<td>Kanal</td>
			<td><input name="channel" type="text" placeholder="nt MarkusTegelane+"></input></td>
			</tr>
			<tr>
			<td>URL</td>
			<td><input name="url" type="text" style="width: 48%;" placeholder="https://www.youtube.com/watch?v=00000000"></input></td>
			</tr>
			<tr>
				<td colspan=2>
					<input type="submit" value="Lisa"></input>
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
