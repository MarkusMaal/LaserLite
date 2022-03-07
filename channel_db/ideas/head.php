<!DOCTYPE html>
<html>
<head>
<title><?php if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) { 
	echo 'Kanali ideekast';
} else {
	echo 'Channel ideabox';
} ?></title>
<style>
	body {
		background-color: #000000;
		background: radial-gradient(rgba(180, 120, 10, 1), rgba(200, 80, 0, 0.95));
		color: #ffffff;
		font-family: "Verdana";
	}
	.navbar {
		width: 25px;
		text-align: center;
		background: rgba(100, 0, 0, 0.35);
	}
	.filters {
		display: block;
		position: fixed;
		z-index: 2;
		width: 100px;
		margin: auto;
		top: 8%;
	}
	.funsymbols {
		font-family: "Lucida Console";
		font-size: 25pt;
		padding: 7px;
	}
	.funsymbols:hover {
		text-decoration: none;
		background: rgba(255, 255, 0, 0.25);
	}
	.backdrop {
		display: block;
		position: fixed;
		background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
		top: 0;
		left: 0;
		right: 0;
		bottom: 50%;
		z-index: 1;
	}
	
	.filterbutton {
		color: #008888;
		border-radius: 10px;
		padding: 5px;
		background: rgba(128, 0, 0, 0.25);
		position:fixed;
		z-index: 2;
		top: 15px;
		left: 15px;
	}
	.filterbutton:hover {
		background: rgba(128, 0, 0, 0.8);
		color: #00ffff;
		text-decoration: none;
	}
	.filterbox, .filterbar {
		background: rgba(100, 0, 0, 0.35);
		border-radius: 10px;
		vertical-align: top;
	}
	h1 {
		font-weight: normal;
		font-family: Segoe UI;
	}
	.data-heading {
		background: #ff0000;
		padding: 15px;
		text-align: center;
	}
	.pagenav {
		color: #ffff00;
		text-decoration: none;
		margin: 0px;
		padding: 0px;
		font-size: 14pt;
	}
	.activenav {
		color: #ffffff;
		margin: 0px;
		padding: 0px;
		font-size: 14pt;
	}
	.pagenav:hover {
		color: #888800;
		text-decoration: none;
	}d
	.wrapper {
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		padding: 1%;
		padding-top: 100px;
		position: absolute;
	}
	textarea, input[type="password"] {
		padding: 10px;
		font-size: 12pt;
		border-radius: 10px;
		background: #660000;
		color: #ffff00;
		border: solid;
		border-size: 2px;
		margin-right: 10px;
	}
	input[type="checkbox"] {
		margin-right: 10px;
		curser: pointer;
		opacity: 0.9;
	}
	input[type="text"], select{
		padding: 10px;
		font-size: 12pt;
		border-radius: 10px;
		background: #660000;
		text-align: center;
		color: #ffff00;
		border: solid;
		border-size: 2px;
		margin-right: 10px;
	}
	select:hover, input:hover, textarea:hover {
		background: #336600;
		color: #ffff99;
	}
	td {
		border: solid;
		border-color: #ba0000;
		padding: 10px;
	}
	.content {
		vertical-align: top;
		padding: 15px;
		background: rgba(100, 0, 0, 0.35);
		max-width: 150px;
		max-height: 100px;
	}
	a {
		margin-right: 10px;
		text-decoration: none;
		color: #ffff00;
	}
	a:hover {
		text-decoration: underline;
	}
</style>
</head>
<body>
<h1 style="padding-top: 20px;"><?php if ((!empty($_COOKIE["lang"])) && ($_COOKIE["lang"] == "et-EE")) { 
	echo 'Kanali ideekast';
} else {
	echo 'Channel ideabox';
} ?></h1>
<div class="wrapper">
