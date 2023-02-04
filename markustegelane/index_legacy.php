<!--Kas otsite mingeid saladusi? Minge aadressile http://markustegelane.tk/bigsecret ja näete kõiki võimalikke saladusi sellel saidil! --->
<?php
	$thm = "blue";
	if (!empty($_COOKIE["theme"])) {
		$thm = $_COOKIE["theme"];
	}
	if ($thm == "light") {
		$thm = "colorful";
	}
	include($_SERVER["DOCUMENT_ROOT"] . "/mobcheck.php");
	
	function ms3($en, $et) {
		if (empty($_COOKIE["lang"]) || ($_COOKIE["lang"] == "en-US")) {
			return $en;
		} else {
			return $et;
		}
	}
?>
<html>
<head>
	<title>Avaleht</title>
	<link rel="icon" href="images\favicon.png">
	<!-- Uus kood -->
	<link rel="stylesheet" href="/markustegelane/common/themes/legacy/<?php echo str_replace("blue", "theme", $thm); ?>.css" />
	<!-- Uue koodi lõpp -->
	<!-- Javascript for going to random page --->
	<script type="text/javascript">
		var links = new Array();
		links[0] = "et-EE_about.php";
		links[1] = "et-EE_faq.php";
		links[2] = "et-EE_cookies.php";
		links[3] = "et-EE_links.php";
		links[4] = "et-EE_channels.php";
		links[5] = "et-EE_dloads.php";
		links[6] = "et-EE_game.php";
		links[7] = "et-EE_plus_index.html";
		links[8] = "et-EE_streams.html";
		links[9] = 'et-EE_cpanel.php';
		links[10] = 'et-EE_changelog.php';
		links[11] = 'view_database.php';
		function buttonClicked() {
		  var i = Math.floor(Math.random() * links.length);
		  i = Math.floor(Math.random() * links.length);
		  i = Math.floor(Math.random() * links.length);
		  i = Math.floor(Math.random() * links.length);
		  i = Math.floor(Math.random() * links.length);
		  parent.location = links[i];
		  return false;
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
<body>
	<?php
		$doc = "home";
		if (!empty($_GET["doc"])) {
			$doc = $_GET["doc"];
		}
		
		$s = "123456789";
		if ($doc == "home") {
			$s = "4";
		}
		if (!empty($_GET["s"])) {
			$s = $_GET["s"];
		}
		
	?>
	<a href="et-EE_index.php"><img center style="width: 40%; padding: 4vh;" class="banner" src="gfx\banner.svg" alt="Welcome to my website"></img></a>
		<ul class="linklist" style="<?php
			if ($thm == "element") {
				echo "margin: auto; width: 60%;";
			}
		?>">
			<li style="float:left"><a href="?doc=home" class="<?php if (($doc == "home") && ($s != "3")) { echo "activepage"; } else { echo "listitems"; } ?>"><?php echo ms3("News", "Uudised"); ?></a></li>
			<li style="float:left"><a href="?s=3" class="<?php if (($doc == "home") && ($s == "3")) { echo "activepage"; } else { echo "listitems"; } ?>"><?php echo ms3("Games", "Mängud"); ?></a></li>
			<li style="float:left"><a href="?doc=faq&s=1" class="<?php if ($doc == "faq") { echo "activepage"; } else { echo "listitems"; } ?>"><?php echo ms3("FAQ", "KKK"); ?></a></li>
			<li style="float:left"><a href="?doc=clinks" class="<?php if ($doc == "clinks") { echo "activepage"; } else { echo "listitems"; } ?>"><?php echo ms3("Links", "Lingid"); ?></a></li>
			<li style="float:left"><a href="?doc=dloads" class="<?php if ($doc == "dloads") { echo "activepage"; } else { echo "listitems"; } ?>"><?php echo ms3("Downloads", "Allalaadimised"); ?></a></li>
			<li style="float:left"><a href="?doc=about&s=1" class="<?php if ($doc == "about") { echo "activepage"; } else { echo "listitems"; } ?>"><?php echo ms3("About", "Teave"); ?></a></li>
			<li style="float:left"><a href="/" class="listitems"><?php echo ms3("Back to homepage", "Tagasi avalehele"); ?></a></li>
		</ul>
	<br>
	<section class="container">
	<div style="word-wrap: break-word; text-align:left;" class="mainpage">
  <!-- Main page section --->
	<?php
		$lang = "en-US";
		if (!empty($_COOKIE["lang"])) {
			$lang = $_COOKIE["lang"];
		}
		$numbers = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
		foreach ($numbers as &$number) {
			if (str_contains($s, $number) && file_exists($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/content/$lang/$doc/$number.php")) {
				include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/content/$lang/$doc/$number.php");
			}
		}
	?>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
  <!-- END OF Main page section --->
	</div>
	<div class="sidepanel3">
		<center>
		<h2><?php echo ms3("Settings", "Seadistused"); ?></h2>
		<a href="/markustegelane/common/config/chlang.php"><?php echo ms3("Kuva see leht eesti keeles", "View this page in English"); ?></a>
		<br><a href="/markustegelane/common/config"><?php echo ms3("Change settings", "Muuda seadeid"); ?></a>
		</center>
	</div>
	<div class="sidepanel">
		<center>
		<h2><?php echo ms3("I'm feeling lucky", "Ehk mul veab"); ?></h2>
		<form>
			<!--<a onclick="jsfunction()" href="#">
			<a onclick="jsfunction()" href="javascript:void(0);">--->
			<a href="/markustegelane/common/lucky"><p class="listitems"><?php echo ms3("Go to a random page", "Mine juhuslikule lehele"); ?></p></a>
			<br/><br/>
			<a href="/markustegelane/random?c=all"><p class="listitems"><?php echo ms3("Random video", "Juhuslik video"); ?></p></a>
		</form>
		</center>
	</div>
	<?php include("sidepanel.php"); ?>
	</section>
</body>
</html>
