<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>markustegelane</title>
	<?php
		$lang = "en-US";
		if (!empty($_COOKIE["lang"])) {
			$lang = $_COOKIE["lang"];
		}
		$theme = "blue";
		if (!empty($_COOKIE["theme"])) {
			$theme = $_COOKIE["theme"];
		}
		if (!empty($_COOKIE["mobile_mode"])) {
			if ($_COOKIE["mobile_mode"] == "true") {
				$theme = $theme . "_m";
			}
		}
		include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/themes/theme.php");
	?>
    <!--<link rel="stylesheet" href="/markustegelane/common/themes/<?php //echo $theme; ?>.css">-->
  </head>
  <body>
	<div style="display: flex; justify-content: center;" >
		<div class="cont">
			<div class="setting">
				<div style="width: 200px; margin: auto;"><img style="width: 200px;" src="/images/work.svg"></div>
				<h1 style="text-align: center;"> <?php if ($lang == "et-EE") { echo 'Veebisaidi failide kopeerimine...'; } else { echo 'Copying website files...'; }?> </h1>
				<p style="text-align: center;"><?php if ($lang == "et-EE") { echo 'See protsess võib kaua aega võtta'; } else { echo 'This process can take a long time'; }?></p>
				<!--<p style="text-align: center;">A<span id="loaderanimation">&gt;--------</span>B</p>-->
				<!--<p> 5.x<span id="loaderanimation">-----&gt;</span>6.x </p><br/>-->
				<a href="index.php"><?php if ($lang == "et-EE") { echo 'Laadi uuesti'; } else { echo 'Refresh'; }?></a><br/>
				<a href="/markustegelane/common/config/loginform.php"><?php if ($lang == "et-EE") { echo 'Ava veebileht ebastabiilses olekus'; } else { echo 'Open website in unstable state'; }?></a><br/>
				<a href="/markustegelane/common/config/chlang.php"><?php if ($lang == "et-EE") { echo 'Display this message in English'; } else { echo 'Kuva see teade eesti keeles'; }?></a>
				<br/>
				<!--<h2>Viimistlemine... // Finalizing...</h2>
				<p>Seda veebisaiti saate peagi kasutada. Võite lehelt lahkuda ja hiljem naasta.<br/>
				Ei soovi oodata? Saate kasutada veebisaiti eksperimentaalses olekus <a href="/markustegelane">selle lingiga</a></p>
				<p>This web site is soon usable again. You may exit this page and return later.<br/>
				Don't want to wait? You can use the website in its experimental state using <a href="/markustegelane">this link</a><br/>-->
			</div>
		</div>
	</div>
    <script>
        function roll() {
            var loader = document.getElementById("loaderanimation").innerHTML;
            loader = loader.replace("&gt;", ".");
            if (loader.substring(loader.length - 1, loader.length) == " ") {
                document.getElementById("loaderanimation").innerHTML = (" " + loader.substring(0, loader.length - 1)).replace(".", "&gt;");
            }
            else if (loader.substring(loader.length - 1, loader.length) == ".")
            {
                document.getElementById("loaderanimation").innerHTML = ("." + loader.substring(0, loader.length - 1)).replace(".", "&gt;");
            }
            else if (loader.substring(loader.length - 1, loader.length) == "-")
            {
                document.getElementById("loaderanimation").innerHTML = (loader.substring(loader.length - 1, loader.length) + loader.substring(0, loader.length - 1)).replace(".", "&gt;");
            }
        }
        window.setInterval(roll, 200);
    </script>
  </body>
</html>
