
 <!DOCTYPE html>
 <html lang="et">
    <head>
<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
        <title>markustegelane</title>
        <?php
		if (empty($_COOKIE["theme"])) {
			$theme = 'light';
		} else {
			$theme = $_COOKIE["theme"];
		}
        ?>
        <link rel="stylesheet" href="/markustegelane/common/themes/<?php echo $theme;	if ($isMob) {  echo "_m"; 	} ?>.css">
    </head>
    <body>
		<a href="index.php"><img center class="banner" src="/markustegelane/gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
        <div class="mainpage">
            <div style="width: 200px; margin: auto;">
            <?php
                if (empty($_COOKIE["lang"])) {
                    echo "<img style='width: 200px;' src='/markustegelane/images/cookie.svg'>";
                } else {
                    echo "<img style='width: 200px;' src='/markustegelane/images/cookie_bit.svg'>";
                }
            ?>
            </div>
            <h1 style="text-align: center;">See veebileht kasutab küpsiseid</h1>
            <a href="index.php">Show this message in English</a>
            <?php
                if (empty($_COOKIE["lang"])) {
                    echo "<p>Tundub, et sellele lehele pole ühtegi küpsist seadistatud. Selleks, et saada parim kogemus selle veebilehe kasutamisel peame mõned küpsised seadistama... juhul kui te pahaks ei pane.</p>";
                }
            ?>
            <p>See veebisait kasutab küpsiseid järgmistel eesmärkidel:</p>
            <ul>
                <li>Keeleinfo talletamine</li>
                <li>Teema eelistuse talletamine</li>
            </ul>
            <p>Veebisait võib saata POST kutseid serverile järgnevatel eesmärkidel:</p>
            <ul>
                <li>Kommentaaride ja tagasiside postitamine</li>
                <li>Sisselogimisandmed, kui sisenete moderaatori või omaniku kontoga.</li>
                <li>Uued andmed andmebaaside muutmisel (ainult omanik/arendaja)</li>
            </ul>
            <p>See veebisait võib talletada teie sisselogimisandmeid, kui olete moderaator. Teie parool on talletatud šifreerituna ja soolatud. Kinnituskood pole krüptitud, kuid on juurdepääsetav omanikule/arendajale.</p>
            <?php
            if (empty($_COOKIE["lang"])) {
                echo "<a class='listitems' href='setcookie.php?lang=et'>Muidugi, miks mitte</a>
                <a class='listitems' href='/markustegelane'>Ma ei soovi hetkel küpsiseid sisse lülitada</a>";
            } else {
                echo '<p>Te olete nõustunud sellega, et küpsised salvestatakse teie arvutisse. Te saate selle otsuse tagasi võtta kustutades kõik andmed seadetelehel.</p><a href="..">Tagasi seadetelehele</a></p>';
            }?>
        </div>
    </body>
 </html>
 
