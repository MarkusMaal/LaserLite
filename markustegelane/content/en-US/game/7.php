<h1>Tetrabloxx</h1>
<div style="float: left; margin-right: 100%; <?php if (!empty($_COOKIE["old_theme"]) && ($_COOKIE["old_theme"] == "true")) { echo "margin-bottom: 300px"; } else if (!empty($_COOKIE["old_theme"]) && ($_COOKIE["old_theme"] == "false")) { echo "margin-bottom: 10px"; } ?>" class="container">
	<div style="float: left;" id="gamewindow">
	</div>
	<div style="position: absolute; margin-left: 260px; background: blue; color: white; min-height: 481px; width: 260px;" id="rightpanel">
		<div class="cont">
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
<a id="newButton" class="btn btn-primary listitems" href="#/" onclick="floating_brick.randomize(); game.randomColors(); game.reset();">New game</a>
<a id="pauseButton" class="btn btn-primary listitems" href="#/" onclick="game.pause();">Pause</a>
<hr>
<h2>How to play?</h2>
<p>The goal of the game is to achieve maximum possible score. To do this, you must stack falling blocks on top of each other using specific alignments. If a row is filled with blocks, then that row is cleared and a specific sound effect is played. If you manage to reach 100n score, then you'll reach the next level, where pieces fall much more quickly.</p>
<p>The game is over when a block reaches the top row.</p>
<p>To start the game, press the &quot;New game&quot; button. To pause/resume, correct buttons appear for each action at specific moments.</p>
<p>Controls:</p>
<ul>
	<li>Left/Right arrow key - Move piece left/right</li>
	<li>Down arrow key - Accelerate piece falling</li>
	<li>Up arrow key - Rotate piece</li>
</ul>
<?php 
$sm = "all";
if (!empty($_COOKIE["soundmode"])) {
	$sm = $_COOKIE["soundmode"];
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
<script src="common/tetrabloxx_en.js"></script>
<script>
window.addEventListener("keydown", function(e) {
    if(["Space","ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);
</script>