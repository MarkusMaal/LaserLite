<html>
<head>
	<title>Cookies</title>
    <script src="scripts/loadtheme.js"></script>
	<link rel="icon" href="images\favicon.png">
	<script>
		function setLangCookie() {
		    var now = new Date();
               var minutes = 43200;
               now.setTime(now.getTime() + (minutes * 60 * 1000));
			document.cookie = "lang=en-US; path=/ ; expires=" + now.toUTCString();
		  	parent.location = "index.php";
		  	return false;
		}
	</script>
</head>
<body onload="setCSS()">
	<a href="index.php"><img center class="banner" src="images\banner.svg" alt="Welcome to my website"></img></a>
		<ul class="linklist">
			<li style="float:left" class="listitems">Home</a></li>
			<li style="float:left" class="listitems">FAQ</a></li>
			<li style="float:left" class="listitems">Links</a></li>
			<li style="float:left" class="listitems">Downloads</a></li>
			<li style="float:left" class="listitems">Channels</a></li>
			<li style="float:left" class="listitems">About</a></li>
		</ul>
	<br>
	<section class="container">
	<div style="word-wrap: break-word; text-align:left;" class="mainpage">
  <!-- Main page section --->
		<table>
			<tr>
				<td style="vertical-align:top; width: 34%; ">
					<img class="ge" style='width:80%' src='images/cookie.svg'>
				</td>
				<td>
					<h1 style="text-align:left;">This webpage uses cookies</h1>
					<a href="et-EE_cookie.php">Vaata seda teadet eesti keeles</a>
					<p>It looks like cookie for this webpage was not found. This can happen, because of the following reasons:</p>
					<ul>
						<li>You visit this website for the first time</li>
						<li>You use a different device to access this website</li>
						<li>You use a different browser to access this website for the first time using that browser</li>
						<li>You cleared web browser's cache</li>
						<li>You did not visit this site for more than about 30 days</li>
					</ul>
					<p>In any case, this webpage will need to create new cookies to store the following information:</p>
					<ul>
					<li>Language option</li>
					<li>Theme</li>
					</ul>
					<p>Pressing "I agree" will create a new cookie and store it inside web browser's browsing cache</p>
					<a onclick="setLangCookie()" href="#" class="listitems">I agree</a><a style="margin-left: 15px" class="listitems" href="quit.php">I do not agree</a>
				</td>
			</tr>
		</table>
  <!-- END OF Main page section --->
	</div>
	<?php include("sidepanel.php"); ?>
	</section>
</body>
</html>
