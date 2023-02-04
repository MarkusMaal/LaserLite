<?php
session_start();
if (!empty($_COOKIE["lang"])) {
	$lang = $_COOKIE["lang"];
} else {
	$lang = "en-US";
}
include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php");
include($_SERVER["DOCUMENT_ROOT"] . "/mobcheck.php");
?>
<html lang="<?php
    if ($lang == "et-EE") {
        echo "et";
    } else {
        echo "en";
    }
?>">
	<head>
        <title><?php
            if ($lang == "et-EE") {
                 echo 'MarkusTegelane+';
            } else {
                echo 'mmaal+';
            }
        ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicons/x.ico" />
        <link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		<div class="banner"><a href="/x"><div id="leftbanner"><img class="banner" src="resources/mtl_transparent.svg"/></div></a></div>
		<div class="navbar">
			<a class="pages" href="?p=channel"><?php if ($lang == "et-EE") { echo 'Kanalist'; } else { echo 'About channel'; }?></a>
			<a class="pages" href="?p=streams"><?php if ($lang == "et-EE") { echo 'Kavad ja otseülekanded'; } else { echo 'Schedules and live streams'; }?></a>
			<a class="pages" target="_blank" href="https://www.youtube.com/channel/UCGGMWFwRnLjTKRLtnO6KRFg"><?php if ($lang == "et-EE") { echo 'Külasta kanalit'; } else { echo 'Visit channel'; }?></a>
			<a class="pages" href="/x"><?php if ($lang == "et-EE") { echo 'Vana kujundus'; } else { echo 'Old design'; }?></a>
			<a class="pages" href="/"><?php if ($lang == "et-EE") { echo 'Avaleht'; } else { echo 'Home page'; }?></a>
		</div>
		<div class="mainpage">
                <?php
                $page = "channel";
                if (!empty($_GET["p"])) {
                    $page = $_GET["p"];
                }
                if ($page == "channel") {
                    switch ($lang) {
                        case "et-EE":
                            echo '<h2>uusimad videod</h2></a>';
                            echo '<table><tr><th>pilt</th><th>pealkiri</th><th width=40>link</th></tr>';
                            break;
                        case "en-US":
                            echo '<h2>latest videos</h2></a>';
                            echo '<table><tr><th>picture</th><th>title</th><th width=40>link</th></tr>';
                            break;
                    }
                    include("connect.php");
                    $query = 'SELECT ID, Video, URL, Kuupäev FROM channel_db WHERE Kanal="MarkusTegelane+" AND Kustutatud=FALSE AND Avalik=TRUE ORDER BY Kuupäev DESC, ID DESC LIMIT 10';
                    $result = mysqli_query($connection, $query);
                    
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo '<td><img style="width: 70px;" src="../channel_db/thumbs/' . $row[0] . '.jpg"/></td>';
                        echo '<td>' . $row[1] . '</td>';
                        echo '<td><a target="_blank" href="' . $row[2] . '"><div class="play">&#9654;</div></a></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    
                    switch ($lang){
                    case "et-EE":
                        echo '<h2>kanalist</h2>';
                        echo '<p>Kas teile meeldib MarkusTegelane? Kas soovite osa saada videotest olenemata nende kvaliteedist? Siis MarkusTegelane+ on mõeldud teile! Nüüdsest kanaliga markustegelane++ ühinenud kanalil leiate otseülekandeid, lisavideosid, videosid videote tegemisest ja arendamise videosid.</p>';
                        echo '<p>Vaata põhikanalit: <a target="_blank" href="http://www.youtube.com/c/MarkusTegelane">http://www.youtube.com/c/MarkusTegelane</a></p>';
                        break;
                    case "en-US":
                        echo '<h2>about channel</h2>';
                        echo '<p>Do you like mmaal a.k.a. MarkusTegelane? Do you want to see new videos, no matter the quality? Then mmaal+ is meant for you! Now united with TheMarkusGuy++, you will find live streams, additional content, behind the scenes content and programming videos.</p>';
                        echo '<p>Main channel: <a target="_blank" href="http://www.youtube.com/c/MarkusTegelane">http://www.youtube.com/c/MarkusTegelane</a></p>';
                        break;
                    }
                } else if ($page = "streams") {
                
                    switch ($lang) {
                        case "et-EE":
                            echo '<h2>kavad ja otseülekanded</h2></a>';
                            echo '<table><tr><th>sündmus</th><th>aeg</th><th>kanal</th><th style="text-transform: uppercase;">url</th></tr>';
                            break;
                        case "en-US":
                            echo '<h2>schedules and live streams</h2></a>';
                            echo '<table><tr><th>event</th><th>time</th><th>channel</th><th style="text-transform: uppercase;">url</th></tr>';
                            break;
                    }
                    
                    
                    include("connect.php");
                    $query = 'SELECT ename, etime, echannel, eurl FROM schedules ORDER BY(ID) DESC';
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
					$d_mon = explode("-", explode(" ", $row[1])[0])[1];
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
                        } else if ($d_mon - $cm == 0) {
                            $state = "upcoming";
                        } else {
							$state = "later";
						}
                    }
                    $exp = explode(":", explode(" ", $row[1])[1]);
                    $time = $exp[0] . ":" . $exp[1];
                    if ($lang == "et-EE") {
                        $formatted_time = $dd . '.' . $dm . '.' . $dy . ', kell ' . $time;
                    }
                    
                    echo '<tr><td>' . $row[0] . '</td><td>' . $formatted_time . '</td><td>' . $row[2] . '</td><td><a target="_blank" href="' . $row[3] . '"><div class="play live">&bull;</div></a></td></tr>';
                    
                    }
                    echo '<div style="display: flex; justify-content: center; margin: auto;"><img style="width: 150px;" src="resources/' . $state . '.svg"/></div>';
                    echo '<div style="text-align: center; text-transform: initial;"><h2>';
                    switch ($lang) {
                        case "et-EE":
                            switch ($state) {
                                case "notlive":
                                    echo 'Hetkel otseülekandeid ei toimu';
                                    break;
                                case "later":
                                    echo 'Ülekanne algab mõne kuu pärast';
                                    break;
                                case "upcoming":
                                    echo 'Lähiajal on tulemas otseülekanne';
                                    break;
                                case "soon":
                                    echo 'Täna toimub otseülekanne';
                                    break;
                                case "verysoon":
                                    echo 'Otseülekanne algab vähem kui tunni pärast';
                                    break;
                                case "live":
                                    echo 'Toimub voogedastus';
                                    break;
                                case "ending":
                                    echo 'Otseülekanne on lõppemas';
                                    break;
                            }
                            break;
                        case "en-US":
                            switch ($state) {
                                case "notlive":
                                    echo 'There are currently no active live streams';
                                    break;
                                case "later":
                                    echo 'Live stream scheduled to start in a few months';
                                    break;
                                case "upcoming":
                                    echo 'Live stream scheduled to start in a few days';
                                    break;
                                case "soon":
                                    echo 'An event is getting live streamed today';
                                    break;
                                case "verysoon":
                                    echo 'Live stream starting in less than an hour';
                                    break;
                                case "live":
                                    echo 'An event is currently live';
                                    break;
                                case "ending":
                                    echo 'Live stream is ending';
                                    break;
                            }
                            break;
                    }
                    echo '</h2>';
                    
                    switch ($lang) {
                        case "et-EE":
                            switch ($state) {
                                case "notlive":
                                    echo '<p>Kui algab voogedastus, teavitatakse sellest avalehel</p>';
                                    break;
                                case "later":
                                    echo '<p>Kui algab voogedastus, teavitatakse sellest markustegelane veebilehe avalehel</p>';
                                    break;
                                case "ending":
                                    echo '<p>Ülekannet saab järelvaadata alloleva lingi kaudu</p>';
                                    break;
                                default:
                                    echo '<p>Otseülekande link on nüüd veebisaidi avalehel</p>';
                                    break;
                            }
                            break;
                        case "en-US":
                            switch ($state) {
                                case "notlive":
                                    echo '<p>If a broadcast is started, a notification will be displayed on the home page</p>';
                                    break;
                                case "later":
                                    echo '<p>If a broadcast is started, you will get notified at the front page of this web site</p>';
                                    break;
                                case "ending":
                                    echo '<p>Live stream archive is rewatchable using a link listed below</p>';
                                    break;
                                default:
                                    echo '<p>Link to the live stream is now on the home page of the website</p>';
                                    break;
                            }
                            break;
                    }
                    echo '</div>';
                    echo '</table>';
                }
            ?>
		</div>
	</body>
</html>
