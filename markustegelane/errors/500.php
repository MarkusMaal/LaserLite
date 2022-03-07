<html>
<head>
	<title>500</title>
	<link rel="stylesheet" href="theme/theme.css">
	<link rel="icon" href="images\favicon.png">
	<script>
		function getCookie(cname) {
		    var name = cname + "=";
		    var decodedCookie = decodeURIComponent(document.cookie);
		    var ca = decodedCookie.split(';');
		    for(var i = 0; i <ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0) == ' ') {
		            c = c.substring(1);
		        }
		        if (c.indexOf(name) == 0) {
		            return c.substring(name.length, c.length);
		        }
		    }
		    return "";
	}
		function clc() {
			var lng = getCookie("lang");
			if (lng != "et-EE") {
				return "";
			} else {
				document.getElementById('unfort').innerHTML = 'Tohoh, see on nüüd küll piinlik!';
				document.getElementById('funny').innerHTML = 'Tundub, et meie serveris esineb tehnilisi probeleeme.';
				document.getElementById('cando').innerHTML = 'Teil on võimalik teha järgnevat:';
				document.getElementById('li1').innerHTML = 'Laadida veebileht uuesti (F5)';
				document.getElementById('li2').innerHTML = 'Oodata natuke aega, et ühendus taastuks';
				document.getElementById('li3').innerHTML = 'Võtta ühendust veebisaidi administraatoriga';
				document.getElementById('ti').innerHTML = 'Tehniline info:';
				document.getElementById('hte').innerHTML = 'HTML Tõrge: 500_INTERNAL_SERVER_ERROR';
			}
		 	 return false;
		}
</script>
</head>
<body onload="clc()">
	<a href="index.php"><img center class="banner" src="images\banner.svg" alt="Welcome to my website"></img></a>
	<br>
	<section class="container">
	<div class="mainpage" style="word-wrap: break-word; text-align:left; width: 95%; margin-left: auto; margin-right: auto;">
  <!-- Main page section --->
		<table>
			<tr>
				<td style="vertical-align:top; width: 34%; ">
					<img class="ge" style='width:90%' src='images/serious.svg'>
				</td>
				<td>
					<h1 style="text-align:left;" id="unfort">Well, this is embarrasing!</h1>
					<p id="funny">It looks like our server is experiencing technical difficulties.</p>
					<p id="cando">Here's what you can do:</p>
					<ul>
						<li id="li1">Refresh the webpage</li>
						<li id="li2">Wait for a while for the connection to be restored</li>
						<li id="li3">Contact the website administrator</li>
					</ul>
					<div id="ti">Technical information:</div>
					<div id="hte">HTML Error: 500_INTERNAL_SERVER_ERROR</div>
				</td>
			</tr>
		</table>
  <!-- END OF Main page section --->
	</div>
	</section>
</body>
</html>