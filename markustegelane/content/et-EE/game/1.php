	<script type="text/javascript">
		var i = Math.floor(Math.random() * 999);
		var tr = Math.floor(0);
		function newgame() {
			document.getElementById('tries').innerHTML = 'Proovikordi: 0';
			i = Math.floor(Math.random() * 999);
		var guessy = Math.floor(Math.random() * 999);
			document.getElementById('try').value = guessy;
			if(guessy > i) {
				document.getElementById('hint').innerHTML='Vihje: Väiksem kui ' + guessy;
			}
			if(guessy < i) {
				document.getElementById('hint').innerHTML='Vihje: Suurem kui ' + guessy;
			}
			if(guessy == i) {
				document.getElementById('hint').innerHTML='Vihje: Võrdne arvuga ' + guessy;
				guessnum();
			}
		}
		function guessnum() {
			var guessy = document.getElementById('try').value;
			if(guessy > i) {
				document.getElementById('hint').innerHTML='Vihje: Väiksem kui ' + guessy;
				tr = Math.floor(tr + 1);
				document.getElementById('tries').innerHTML = 'Proovikordi: ' + tr;
			}
			if(guessy < i) {
				document.getElementById('hint').innerHTML='Vihje: Suurem kui ' + guessy;
				tr = Math.floor(tr + 1);
				document.getElementById('tries').innerHTML = 'Proovikordi: ' + tr;
			}
			if(guessy == i) {
				document.getElementById('hint').innerHTML='Te võitsite!';
				document.getElementById('try').value ='';
			}
		}
		function setLangCookie() {
		    var now = new Date();
               var minutes = 43200;
               now.setTime(now.getTime() + (minutes * 60 * 1000));
			document.cookie = "lang=en-US; path=/ ; expires=" + now.toUTCString();
		  	parent.location = "index.php";
		}
</script>
	<?php
    if (empty($_GET)) {
        echo '<script src="scripts/loadtheme.js"></script>';
        echo '<link rel="stylesheet" href="..\theme\element.css">';
    } else {
        $thm = $_GET['theme'];
        if ($thm == "element") {
            echo '<link rel="stylesheet" href="..\theme\element.css">';
        } else if ($thm == "colorful") {
            echo '<link rel="stylesheet" href="..\theme\mas.css">';
        } else if ($thm == "dark") {
            echo '<link rel="stylesheet" href="..\theme\dark.css">';
        } else if ($thm == "blue") {
            echo '<link rel="stylesheet" href="..\theme\theme.css">';
        } else if ($thm == "blue_old") {
            echo '<link rel="stylesheet" href="..\theme\theme_old.css">';
        }
    }
    if (empty($_GET)) {
        echo '<script>setCSS();</script>';
    }
	?>
</head>
<div style="word-wrap: break-word; text-align:left;">
  <!-- Main page section --->
  <h2>Mäng</h2>
		<p>Mis number see on?</p>
		<form>
		Kirjuta number: <input type="text" name="try" id="try"><br/><br/>
		<p id="hint">Palun oota...</p>
		<p id="tries"></p>
        <a href="#" onclick="guessnum();" class="listitems">Ma arvan, et see number</a>
        <a href="#" onclick="newgame();" class="listitems">Uus number</a>
		</form>
	<script>newgame();</script>
  <!-- END OF Main page section --->
</div>

