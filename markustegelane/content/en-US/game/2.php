<script src="content/en-US/game/gscripts/game.js"></script>
<div onkeydown="keydown_handle(event)" onkeyup="keyup_handle(event)">
    <H1>Ggame</H1>

    <div id="start" style="width: 100%;"></div>
    <br>
    <a href="#" onclick="reload()" class="listitems">New game</a>
    <a href="#" onclick="pausegame()" id="pausnupp" class="listitems">Pause</a>
    <p id="pts">Score: 0</p>
    <p id="hs">Press start to begin</p>
	<script>document.addEventListener("keydown", keydown_handle);
	document.addEventListener("keyup", keyup_handle);
	newgame();</script>
  <!-- END OF Main page section --->
</div>
