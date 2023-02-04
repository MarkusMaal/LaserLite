<?php
	if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<?php include("lang.php");
	  $rec = ms(" record", " kirje");?>
<!DOCTYPE html>
<html lang="<?php echo ms("en", "et");?>">
	<head>
		<link rel="shortcut icon" type="image/svg" href="/favicons/mas_web.svg" />
		<title><?php echo ms("Markus' stuff versions", "Markuse asjade versioonid");?></title>
		<?php 
		$theme = "blue";
		if (!empty($_COOKIE["theme"])) {
			$theme = $_COOKIE["theme"];
		}
		switch ($theme) {
			case "dark":
				echo '<link rel="stylesheet" href="../style_d.css"/>';
				break;
			case "light":
				echo '<link rel="stylesheet" href="../style.css"/>';
				break;
			default:
				echo '<link rel="stylesheet" href="../style_b.css"/>';
				break;
		}?>
	</head>
	<body>
		<a href=".."><img style="height: 100px;" src="../images/mas_web.svg"/></a>
		<h1><?php echo ms("Markus' stuff versions", "Markuse asjade versioonid");?></h1>
		<br/>
		<table class="navbar">
			<tr>
				<td class="navbar">
					<a class="nav" href="../toq"><?php echo ms("Table of Contents", "Sisukord");?></a>
				</td>
				<td class="navbar">
					<a class="nav" href="../faq"><?php echo ms("FAQ", "KKK");?></a>
				</td>
				<td class="navbar">
					<a class="nav" href="#" onmouseover="ShowMenu();" onmouseleave="HideMenu();"><?php echo ms("Management tools", "Haldustööriistad");?></a>
				</td>
				<td class="navbar">
					<a class="nav" href="../.."><?php echo ms("Exit this webpage", "Välju veebilehelt");?></a>
				</td>
			</tr>
			<tr>
				<td class="navbar" colspan=2>
				</td>
				<td class="submenu" id="submenu1" onmouseover="ShowMenu();" onmouseleave="HideMenu();">
					<br/>
					<a href="../add"><?php echo ms("Add", "Lisa") . $rec;?></a><br/><br/>
					<a href="../update"><?php echo ms("Update", "Uuenda") . $rec;?></a><br/><br/>
					<a href="../remove"><?php echo ms("Delete", "Kustuta") . $rec;?></a><br/><br/>
					<a href="../wallpapers"><?php echo ms("Wallpapers", "Taustapildid");?></a><br/><br/>
				</td>
			</tr>
		</table>
	<script>
		document.getElementById("submenu1").style.display = "none";
		
		function ShowMenu() {
			document.getElementById("submenu1").style.display = "block";
		}
		
		function HideMenu() {
			document.getElementById("submenu1").style.display = "none";
		}
	</script>
	<div class="mainpage">
