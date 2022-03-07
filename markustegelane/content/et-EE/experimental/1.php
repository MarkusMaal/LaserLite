  <!-- Main page section --->
  <?php 
    $site = $_GET['uri'];
	if ($site != "") {
		$url = "https://" . $site;
		$htm = file_get_contents($url);
		echo $htm;
	} else {
        $uuid = md5($_SERVER['HTTP_USER_AGENT'] .  $_SERVER['REMOTE_ADDR']);
        echo 'Seadme id: ' . $uuid;
		include("web_blog.php");
		include("view_database.php");
	}
	?>
  <!-- END OF Main page section --->
