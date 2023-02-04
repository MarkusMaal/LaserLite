<!DOCTYPE html>
<html>
	<head>
		<?php
		if (!empty($_COOKIE["lang"])) {
			$lang = $_COOKIE["lang"];
		} else {
			$lang = "en-US";
		}
    	include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
		?>
		<link rel="shortcut icon" type="image/x-icon" href="/favicons/plus.ico" />
		<title>
			<?php
				if ($lang == "et-EE") {
					echo 'Avaleht';
				} else {
					echo 'Home page';
				}
			?>
		</title>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<div style="width: 600px; margin: auto;">
		<img width=600 src="resources/banner.png"/>
		</div>
		
		<a class="returnhome" href="../markustegelane">&lt;- 
		<?php
			if ($lang == "et-EE") {
				echo "tagasi";
			}
			else if ($lang == "en-US") {
				echo "go back";
			}
		?></a>
		<div class="mainpage">
		<?php
			$page = "channel";
			if (!empty($_GET["p"])) {
				$page = $_GET["p"];
			}
			if ($page == "channel") {
				switch ($lang) {
					case "et-EE":
						echo '<h2>uusimad videod / <a href="?p=streams">kavad ja otseülekanded</h2></a>';
						echo '<table><tr><th>pilt</th><th>pealkiri</th><th width=40>link</th></tr>';
						break;
					case "en-US":
						echo '<h2>latest videos / <a href="?p=streams">schedules and streams</h2></a>';
						echo '<table><tr><th>picture</th><th>title</th><th width=40>link</th></tr>';
						break;
				}
				include("connect.php");
				$query = 'SELECT ID, Video, URL, Kuupäev FROM channel_db WHERE Kanal="MarkusTegelane+" AND Kustutatud=FALSE AND Avalik=TRUE ORDER BY (Kuupäev) DESC LIMIT 10';
				$result = mysqli_query($connection, $query);
				
				while ($row = mysqli_fetch_array($result)) {
					echo '<tr>';
					echo '<td><img style="width: 70px;" src="../channel_db/thumbs/' . $row[0] . '.jpg"/></td>';
					echo '<td>' . $row[1] . '</td>';
					echo '<td><a href="' . $row[2] . '">&gt;</a></td>';
					echo '</tr>';
				}
				echo '</table>';
				
				switch ($lang){
			 	case "et-EE":
					echo '<h2>kanalist</h2>';
					echo '<p>kas teile meeldib markus-tegelane? kas soovite osa saada videotest olenemata nende kvaliteedist? siis markus-tegelane+ on mõeldud teile! nüüdsest kanaliga markus-tegelane++ ühinenud kanalil leiate otseülekandeid, lisavideosid, videosid videote tegemisest ja arendamise videosid.</p>';
					echo '<p>vaata põhikanalit: <a href="http://www.youtube.com/c/MarkusTegelane">http://www.youtube.com/c/MarkusTegelane</a></p>';
					break;
			 	case "en-US":
					echo '<h2>about channel</h2>';
					echo '<p>do you like themarkusguy? do you want to see new videos, no matter the quality? then TheMarkusGuy+ is meant for you! now united with TheMarkusGuy++, you will find live streams, additional content, behind the scenes content and programming videos.</p>';
					echo '<p>main channel: <a href="http://www.youtube.com/c/MarkusTegelane">http://www.youtube.com/c/MarkusTegelane</a></p>';
			 		break;
				}
			} else if ($page = "streams") {
			
				switch ($lang) {
					case "et-EE":
						echo '<h2><a href="?p=channel">uusimad videod</a> / kavad ja otseülekanded</h2></a>';
						echo '<table><tr><th>sündmus</th><th>aeg</th><th>kanal</th></tr>';
						break;
					case "en-US":
						echo '<h2><a href="?p=channel">latest videos</a> / schedules and live streams</h2></a>';
						echo '<table><tr><th>event</th><th>time</th><th>channel</th></tr>';
						break;
				}
				
				
				include("connect.php");
				$query = 'SELECT ename, etime, echannel, eurl FROM schedules';
				$result = mysqli_query($connection, $query);
				$cy = date("Y");
				$cm = date("m");
				$cd = date("d");
				$th = date("H");
				$tm = date("i");
				$ts = date("s");
				$state = "notlive";
				while ($row = mysqli_fetch_array($result)) {
				 $formatted_time = $row[1];
				 $dd = explode("-", explode(" ", $row[1])[0])[2];
				 $dm = explode("-", explode(" ", $row[1])[0])[1];
				 $dy = explode("-", explode(" ", $row[1])[0])[0];
				 $delta_h = explode(":", explode(" ", $row[1])[1])[0] - $th;
				 $delta_m = explode(":", explode(" ", $row[1])[1])[1] - $tm;
				 $delta_s = explode(":", explode(" ", $row[1])[1])[2] - $ts;
				 $delta_t = $delta_h * 60 * 60 + $delta_m * 60 + $delta_s;
				 if (($dd >= $cd) && ($dm >= $cm) && ($dy >= $cy)) {
				 	if ($dd - $cd == 0) {
				 		if (($delta_t >= -10000) && ($delta_t <= -7200)) {
				 			$state = "ending";
				 		}
				 		else if ($delta_t < 3600) {
				 			if ($delta_t > 0) {
					 			$state = "verysoon";
					 		} else {
					 			if ($delta_t >= -10000) {
					 				$state = "live";
					 			}
					 		}
				 		} else {
				 			$state = "soon";
				 		}
				 	} else {
					  	$state = "upcoming";
					}
				 }
				 $exp = explode(":", explode(" ", $row[1])[1]);
				 $time = $exp[0] . ":" . $exp[1];
				 if ($lang == "et-EE") {
				 	$formatted_time = $dd . '.' . $dm . '.' . $dy . ', kell ' . $time;
				 }
				 
				 echo '<tr><td>' . $row[0] . '</td><td>' . $formatted_time . '</td><td>' . $row[2] . '</td></tr>';
				 
				}
				echo '<div style="width: 150px; margin: auto;"><img style="width: 150px;" src="resources/' . $state . '.svg"/></div>';
				echo '<div style="text-align: center;"><h2>';
				 switch ($lang) {
				 	case "et-EE":
				 		switch ($state) {
					 		 case "notlive":
					 			echo 'hetkel voogedastusi ei toimu';
					 			break;
					 		 case "upcoming":
					 			echo 'lähiajal on tulemas otseülekanne';
					 			break;
					 		 case "soon":
					 			echo 'täna toimub otseülekanne';
					 			break;
					 		 case "verysoon":
					 			echo 'otseülekanne algab vähem kui tunni pärast';
					 			break;
					 		 case "live":
					 			echo 'toimub voogedastus';
					 			break;
					 		 case "ending":
					 			echo 'otseülekanne on lõppemas';
					 			break;
				 		}
					 	break;
					case "en-US":
				 		switch ($state) {
					 		 case "notlive":
					 			echo 'there are currently no live broadcasts';
					 			break;
					 		 case "upcoming":
					 			echo 'live stream scheduled to start in a few days';
					 			break;
					 		 case "soon":
					 			echo 'an event is getting live streamed today';
					 			break;
					 		 case "verysoon":
					 			echo 'live stream starting in less than an hour';
					 			break;
					 		 case "live":
					 			echo 'an event is currently live';
					 			break;
					 		 case "ending":
					 			echo 'live stream is ending';
					 			break;
				 		}
						break;
				 }
				 echo '</h2>';
				 
				 switch ($lang) {
				 	case "et-EE":
				 		switch ($state) {
					 		 case "notlive":
					 			echo '<p>kui algab voogedastus, teavitatakse sellest markustegelane veebilehe avalehel</p>';
					 			break;
					 		 case "ending":
					 			echo '<p>ülekannet saab järelvaadata lingiga avalehel</p>';
					 			break;
					 		 default:
					 			echo '<p>otseülekande link on nüüd veebisaidi avalehel</p>';
					 			break;
				 		}
					 	break;
					case "en-US":
				 		switch ($state) {
					 		 case "notlive":
					 			echo '<p>if a broadcast is started, you will get notified at the front page of this web site</p>';
					 			break;
					 		 case "ending":
					 			echo '<p>live stream archive is rewatchable using the link on the front page of this website</p>';
					 			break;
					 		default:
					 			echo '<p>link to the live stream is now on the front page of this website</p>';
					 			break;
				 		}
						break;
				 }
				 echo '</div>';
				echo '</table>';
			}
		?>
		</div>
		<br/><br/><br/><br/>
	</body>
</html>
