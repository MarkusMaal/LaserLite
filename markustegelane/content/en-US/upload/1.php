<?php
if (empty($_SESSION["usr"])  || ($_SESSION["level"] != "owner")) {
die("To perform this action, you need an owner account<br/>E:010");
}
if (isset($_GET["status"])) {
	echo '<h2>File upload status</h2>';
	$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/markustegelane/images/dloads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if(isset($_POST["submit"])) {
  	$uploadOk = 1;
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 134217728) {
  	echo "The file is too large.";
  	$uploadOk = 0;
	}
	
	
	if ($uploadOk == 0) {
  	echo "Sorry, this file cannot be uploaded.";
	} else {
  	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	echo "The following file was uploaded: '". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). "'";
  	} else {
    	echo "Problems occoured uploading file.";
  	}
	}
	echo '<br/><br/><br/><a href="index.php">Go back</a><br/><a href="?doc=upload">Upload another file</a>';
	die();
}?>
	<h2>Upload the file</h2>
	<form id="form1" action="?doc=upload&status=waiting" method="post" enctype="multipart/form-data">
      <img id="spinner" style="display: none; width: 5%;" src="hourglass.gif"/>
	  <span id="statustext">Choose a file you want to upload:</span>
	<br/>
	<input id="fs" class="fileselecter" type="file" name="fileToUpload" id="fileToUpload">
	<br/>
	<a id="action" href="javascript:;" onclick="UploadNow();">
	Upload file</a><br/>
	<a id="hmm" href="..">Go back</a>
	</form>
	
	<script>
		function UploadNow() {
			document.getElementById('statustext').innerHTML = "";
			document.getElementById('hmm').innerHTML = "Cancel";
			document.getElementById('fs').style.display = "none";
			document.getElementById('action').style.display = "none";
			document.getElementById('spinner').style.display = "block";
			document.getElementById('form1').submit();
		}
	</script>
