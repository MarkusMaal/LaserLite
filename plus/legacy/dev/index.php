<?php if(session_status()!=PHP_SESSION_ACTIVE) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css"/>
<?php
include("../connect.php");
$query = "SELECT * FROM schedules ORDER BY id DESC";
$result = mysqli_query($connection, $query);
?>
</head>
<body>
	<div style="width: 600px; margin: auto"><img width=600 src="../resources/banner.png"/></div>
	<div class="mainpage">
		<h1>Sündmuste haldamine</h1>
		<?php
			if ((empty($_SESSION["usr"])) || ($_SESSION["level"] != "owner"))
			{
				die('<p>Sisu muutmiseks peate olema sisse logitud omaniku kontoga.<br/>E: 001<br/><br/><a href="..">Tagasi</a></p>');
			}
		?>
		<br/>
		<a href="add">Lisa</a>
		<br/>
		<a href="remove">Eemalda</a>
		<br/>
		<a href="modify">Muuda</a>
		<br/>
		<a href="..">Tagasi</a>
		<br/>
		<br/>
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
