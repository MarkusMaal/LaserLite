	<script type="text/javascript">
		var i = Math.floor(Math.random() * 999);
		var tr = Math.floor(0);
		function newgame() {
			document.getElementById('tries').innerHTML = 'Attempts: 0';
			i = Math.floor(Math.random() * 999);
		var guessy = Math.floor(Math.random() * 999);
			document.getElementById('try').value = guessy;
			if(guessy > i) {
				document.getElementById('hint').innerHTML='Hint: Smaller than ' + guessy;
			}
			if(guessy < i) {
				document.getElementById('hint').innerHTML='Hint: Bigger than ' + guessy;
			}
			if(guessy == i) {
				document.getElementById('hint').innerHTML='Hint: Equal to ' + guessy;
				guessnum();
			}
		}
		function guessnum() {
			var guessy = document.getElementById('try').value;
			if(guessy > i) {
				document.getElementById('hint').innerHTML='Hint: Smaller than ' + guessy;
				tr = Math.floor(tr + 1);
				document.getElementById('tries').innerHTML = 'Attempts: ' + tr;
			}
			if(guessy < i) {
				document.getElementById('hint').innerHTML='Hint: Bigger than ' + guessy;
				tr = Math.floor(tr + 1);
				document.getElementById('tries').innerHTML = 'Attempts: ' + tr;
			}
			if(guessy == i) {
				document.getElementById('hint').innerHTML='You win!';
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
</head>
<div style="word-wrap: break-word; text-align:left;">
  <!-- Main page section --->
  <h2>Game</h2>
		<p>What number is this?</p>
		<form>
		Enter number: <input type="text" name="try" id="try"><br/><br/>
		<p id="hint">Please wait...</p>
		<p id="tries"></p>
        <a href="#" onclick="guessnum();" class="listitems">I think this is the number</a>
        <a href="#" onclick="newgame();" class="listitems">New number</a>
		</form>
	<script>newgame();</script>
  <!-- END OF Main page section --->
</div>

