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
                 echo 'Avaleht';
            } else {
                echo 'Home page';
            }
        ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicons/x.ico" />
        <link rel="stylesheet" href="style<?php if ($isMob) { echo "_m"; } ?>.css">
	</head>

	<body>
		<div class="parent"></div>
		<div class="banner"><a href="/x"><img class="banner" src="resources/banner_x.png"/></a></div>
		<div class="navbar">
			<a class="pages" href="?p=channel"><?php if ($lang == "et-EE") { echo 'kanalist'; } else { echo 'about channel'; }?></a>
			<a class="pages" href="?p=streams"><?php if ($lang == "et-EE") { echo 'kavad ja otseülekanded'; } else { echo 'schedules and live streams'; }?></a>
			<a class="pages" href="https://www.youtube.com/channel/UCGGMWFwRnLjTKRLtnO6KRFg"><?php if ($lang == "et-EE") { echo 'külasta kanalit'; } else { echo 'visit channel'; }?></a>
			<a class="pages" href="/lite"><?php if ($lang == "et-EE") { echo 'uus kujundus'; } else { echo 'new design'; }?></a>
		</div>
        <a class="returnhome" href="../">&lt;- 
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
                            echo '<h2>uusimad videod</h2></a>';
                            echo '<table><tr><th>pilt</th><th>pealkiri</th><th width=40>link</th></tr>';
                            break;
                        case "en-US":
                            echo '<h2>latest videos</h2></a>';
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
                        echo '<p>kas teile meeldib markustegelane? kas soovite osa saada videotest olenemata nende kvaliteedist? siis markustegelane x on mõeldud teile! nüüdsest kanaliga markustegelane++ ühinenud kanalil leiate otseülekandeid, lisavideosid, videosid videote tegemisest ja arendamise videosid.</p>';
                        echo '<p>vaata põhikanalit: <a href="http://www.youtube.com/c/MarkusTegelane">http://www.youtube.com/c/MarkusTegelane</a></p>';
                        break;
                    case "en-US":
                        echo '<h2>about channel</h2>';
                        echo '<p>do you like themarkusguy? do you want to see new videos, no matter the quality? then mmaal x is meant for you! now united with TheMarkusGuy++, you will find live streams, additional content, behind the scenes content and programming videos.</p>';
                        echo '<p>main channel: <a href="http://www.youtube.com/c/MarkusTegelane">http://www.youtube.com/c/MarkusTegelane</a></p>';
                        break;
                    }
                } else if ($page = "streams") {
                
                    switch ($lang) {
                        case "et-EE":
                            echo '<h2>kavad ja otseülekanded</h2></a>';
                            echo '<table><tr><th>sündmus</th><th>aeg</th><th>kanal</th></tr>';
                            break;
                        case "en-US":
                            echo '<h2>schedules and live streams</h2></a>';
                            echo '<table><tr><th>event</th><th>time</th><th>channel</th></tr>';
                            break;
                    }
                    
                    
                    include("connect.php");
                    $query = 'SELECT ename, etime, echannel, eurl FROM schedules';
                    $result = mysqli_query($connection, $query);
                    $cy = date("Y");
                    $cm = date("n");
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
                        } else if ($d_mon - $cm == 0){
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
                                case "later":
                                    echo 'ülekanne algab mõne kuu pärast';
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
                                case "later":
                                    echo 'live stream scheduled to start in a few months';
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
                                case "later":
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
                                case "later":
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
	</body>
</html>
