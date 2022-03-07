<?php
if (empty($_SESSION["usr"])  || ($_SESSION["level"] != "owner")) {
die("Toimingu sooritamiseks on vajalik omaniku konto<br/>E:010");
}
if (isset($_GET["status"])) {
	echo '<h2>Faili üleslaadimise olek</h2>';
	$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/markustegelane/images/dloads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if(isset($_POST["submit"])) {
  	$uploadOk = 1;
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 134217728) {
  	echo "Fail on liiga suur.";
  	$uploadOk = 0;
	}
	
	
	if ($uploadOk == 0) {
  	echo "Vabandust, faili ei saanud üles laadida.";
	} else {
  	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	echo "Fail '". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). "' laaditi üles.";
  	} else {
    	echo "Faili üleslaadimisel esines probleeme.";
  	}
	}
	echo '<br/><br/><br/><a href="index.php">Tagasi avalehele</a><a href="?doc=upload">Laadi veel üks fail üles</a>';
	die();
}?>
	<h2>Faili üles laadimine</h2>
	<form id="form1" action="?doc=upload&status=waiting" method="post" enctype="multipart/form-data">
      <img id="spinner" style="display: none; width: 5%;" src="hourglass.gif"/>
	  <span id="statustext">Valige fail, mida soovite üles laadida:</span>
	<br/>
	<input id="fs" class="fileselecter" type="file" name="fileToUpload" id="fileToUpload">
	<br/>
	<a id="action" href="javascript:;" onclick="UploadNow();">
	Laadi fail üles</a>
	<a id="hmm" href="..">Tagasi avalehele</a>
	</form>
	
	<script>
		function UploadNow() {
			document.getElementById('statustext').innerHTML = "";
			document.getElementById('hmm').innerHTML = "Katkesta";
			document.getElementById('fs').style.display = "none";
			document.getElementById('action').style.display = "none";
			document.getElementById('spinner').style.display = "block";
			document.getElementById('form1').submit();
		}
	</script>
