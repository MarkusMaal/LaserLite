<script src="content/et-EE/game/gscripts/game.js"></script>
<div onkeydown="keydown_handle(event)" onkeyup="keyup_handle(event)">
    <H1>GMäng</H1>

    <div id="start" style="width: 100%;"></div>
    <br>
    <a href="#" onclick="reload()" class="listitems">Uus mäng</a>
    <a href="#" onclick="pausegame()" id="pausnupp" class="listitems">Paus</a>
    <p id="pts">Punkte: 0</p>
    <p id="hs">Vajuta alusta, et mäng käivitada</p>
	<script>document.addEventListener("keydown", keydown_handle);
	document.addEventListener("keyup", keyup_handle);
	newgame();</script>
  <!-- END OF Main page section --->
</div>
