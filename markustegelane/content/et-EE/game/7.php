<h1>Tetrabloxx</h1>
<div style="float: left; margin-right: 100%; <?php if (!empty($_COOKIE["old_theme"]) && ($_COOKIE["old_theme"] == "true")) { echo "margin-bottom: 300px"; } else if (!empty($_COOKIE["old_theme"]) && ($_COOKIE["old_theme"] == "false")) { echo "margin-bottom: 10px"; } ?>" class="container">
	<div style="float: left;" id="gamewindow">
	</div>
	<div style="position: absolute; margin-left: 260px; background: blue; color: white; min-height: 481px; width: 260px;" id="rightpanel">
		<div class="container">
			<p style="color: white;" id="next"></p>
			<div id="nextblock"></div>
			<p style="color: white;" id="score"></p>
			<p style="color: white;" id="debug_speed"></p>
			<p style="color: white;" id="debug_pos"></p>
			<p style="color: white;" id="debug_fpos"></p>
		</div>
	</div>
</div>
<br>
<a id="newButton" class="btn btn-primary listitems" href="#/" onclick="floating_brick.randomize(); game.randomColors(); game.reset();">Uus mäng</a>
<a id="pauseButton" class="btn btn-primary listitems" href="#/" onclick="game.pause();">Paus</a>
<hr>
<h2>Kuidas mängida?</h2>
<p>Mängu eesmärgiks on saavutada võimalikult kõrge skoor. Selleks, et suurendada skoori, peate langevaid tükke üksteise peale laduma kindlal viisil. Kui mingi rida on kaetud tükkidega, siis see rida kustutatakse ning vastav heliefekt esitatakse. Juhul kui olete saavutanud 100n skoori, siis jõuate järgmisele tasandile, kus tükid langevad palju kiiremini.</p>
<p>Mäng saab läbi, kui üks tükk jõuab mängivälja tippu.</p>
<p>Mängu alustamiseks vajutage &quot;Uus mäng&quot; nuppu. Pausile panemiseks ning jätkamiseks ilmuvad sobival ajal vastavad nupu.</p>
<p>Juhtnupud:</p>
<ul>
	<li>Vasak/Parem nooleklahv - Liiguta tükk vasakule/paremale</li>
	<li>Alumine nooleklahv - Kiirenda tüki kukkumist</li>
	<li>Ülemine nooleklahv - Pööra tükki</li>
</ul>
<?php 
$sm = "all";
if (!empty($_GET["soundmode"])) {
	$sm = $_GET["soundmode"];
}
if ($sm != "none") {
	echo '
<audio id="block" src="sfx/block.wav">
</audio>
<audio id="line" src="sfx/line.wav">
</audio>
<audio id="levelup" src="sfx/levelup.wav">
</audio>
<audio id="gameover" src="sfx/gameover.wav">
</audio>'; } 
if ($sm == "all") { echo '
<audio id="bgm" src="music/bgm1.mp3">
</audio>'; }?>
<script src="common/tetrabloxx_et.js"></script>
<script>
window.addEventListener("keydown", function(e) {
    if(["Space","ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);
</script>