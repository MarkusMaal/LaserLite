<?php include("lang.php"); ?>
<!DOCTYPE html>
<html lang="<?php echo ms("en", "et");
    	include($_SERVER["DOCUMENT_ROOT"] . "/maintenance.php"); ?>">
	<head>
		<link rel="shortcut icon" type="image/svg" href="/favicons/mas_web.svg" />
		<title><?php echo ms("Markus' stuff versions", "Markuse asjade versioonid"); ?></title>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<a href="index.php"><img style="height: 100px;" src="images/mas_web.svg"/></a>
		<h1><?php echo ms("Markus' stuff versions", "Markuse asjade versioonid"); ?></h1>
		<br/>
		<a class="nav" href="faq"><?php echo ms("Frequently Asked Questions", "Korduma Kippuvad Küsimused"); ?></a>
		<a class="nav" href="toq"><?php echo ms("Table of Contents", "Sisukord"); ?></a>
		<a class="nav" href=".."><?php echo ms("Exit this webpage", "Välju veebilehelt"); ?></a><br/><br/>
		<div style="text-align: center;">
		<img style="height: 200px;" src="images/mas_web.svg"/>
		<h1><?php echo ms("Markus' stuff", "Markuse asjad"); ?></h1>
		<h3 style="font-weight: normal;"><?php echo ms("Frequently Asked Questions and version history", "Korduma kippuvad küsimused ja versioonide ajalugu"); ?> (2009-<?php echo date("Y"); ?>)</h3>
		</div>
<?php include("foot.php"); ?>
		
