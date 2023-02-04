<?php include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/config/getcookies.php");?>
<link rel="stylesheet" href="../themes/<?php echo $thm;?>.css">
<script>
	function ch_face() {
		var face = document.getElementById("face").getAttribute("src");
		switch (face) {
			case "../../images/joy.svg":
				document.getElementById("face").src = "../../images/disgust.svg";
				break;
			default:
				document.getElementById("face").src = "../../images/joy.svg";
				break;
		}
	}
</script>
<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
<div class="mainpage">
	<div style="width: 200px; margin: auto;"><img id="face" onclick="ch_face();" width=200 src="../../images/disgust.svg"></div>
	<div style="text-align: center;">
	<h1>Sisselogimine nurjus</h1>
	<p>Sisestatud kasutajanimi või parool oli vale.</p>
	<a href="index.php">Tagasi</a>
	</div>
</div>
