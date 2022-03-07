<html>
<head>
	<title>403</title>
	<link rel="icon" href="../../../../../markustegelane/images/favicon.png">
	<!-- Javascript for going to random page --->
	<?php
    if (empty($_COOKIE['theme'])) {
	    echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/light.css">';
    } else {
        $thm = $_COOKIE['theme'];
        if ($thm == "light") {
	        echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/light.css">';
        } else if ($thm == "dark") {
	        echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/dark.css">';
        }
    }
    if (empty($_COOKIE)) {
        echo '<link rel="stylesheet" href="../../../../../markustegelane/common/themes/light.css">';
    }
    $lang = $_COOKIE["lang"];
	?>
</head>
<body>
	<a href="../../../../../../markustegelane/index.php"><img center class="banner" src="../../../../../markustegelane/gfx/banner.png"></img></a>
	<br>
		<div class="mainpage">
  <!-- Main page section --->
		<table>
				<tr>
					<div style="width: 200px; margin: auto;"><img src="../../../../../markustegelane/images/angry.svg" width=200/></div>
				</tr>
				<tr>
				<?php
                    $cloc = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    if ($lang == "et-EE") {
							echo '<h1 style="text-align:center;" id="unfort">Tundub, et teil pole ligipääsu sellele lehele</h1>
							<p id="funny">Teil puuduvad õigused sellele lehele pääsemiseks. Palun võtke ühenduste veebisaidi administraatoriga, kui see pole nii.</p>
							<p id="cando">Mida saate teha:</p>
							<ul>
								<li id="li1">Saada mingil viisil õigus seda lehte näha</li>
								<li id="li2">Kontakteeruda veebisaidi administraatoriga, kui te peaksite sellele lehele pääsema</li>
							</ul>
							<div id="ti">Tehniline informatsioon:</div>
							<div id="hte">HTTP staatus: 403_FORBIDDEN</div>';
                    } else {
							echo '<h1 style="text-align:left;" id="unfort">It looks like you can not access this page</h1>
							<p id="funny">This web page is forbidden for you. That means, you have no rights to access this page. Please contact the website administrator if that is not the case.</p>
							<p id="cando">Here is what you can do:</p>
							<ul>
								<li id="li1">Somehow get permission to view this page</li>
								<li id="li2">Contact website administrator if you should be able to access this page</li>
							</ul>
							<div id="ti">Technical information:</div>
							<div id="hte">HTML status: 403_FORBIDDEN</div>';
                    }
				?>
				</tr>
		</table>
	</div>
</body>
</html>
