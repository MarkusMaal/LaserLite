	<section id="Navigatsiooniriba">
		<nav>
		  <ul class="nav">
		  <?php 
		  	$page = "home";
		  	if (!empty($_GET["doc"])) {
		  		$page = $_GET["doc"];
		  	}
		  	$main = "notselected";
		  	$game = "notselected";
		  	$faq = "notselected";
		  	$channels = "notselected";
		  	$dloads = "notselected";
		  	$about = "notselected";
		  	switch ($page)
		  	{
		  		case "home":
		  			$main = "selected";
		  			break;
		  		case "game":
		  			$game = "selected";
		  			break;
		  		case "faq":
		  			$faq = "selected";
		  			break;
		  		case "clinks":
		  			$channels = "selected";
		  			break;
		  		case "dloads":
		  			$dloads = "selected";
		  			break;
		  		case "about":
		  			$about = "selected";
		  			break;
		  	}
		  ?>
		  <li tabindex="8"><a tabindex="9" class="<?php echo $main;?>" href="index.php?s=4">Uudised</a>
		  <li tabindex="10"><a tabindex="11" class="<?php echo $game;?>" href="index.php?s=3">Mängud</a>
		  <?php if  (($main == "selected") || ($isMob == false)) {
			echo '
			  <ul>
				  <li><a href="?doc=game&s=1">Arva number</a></li>
				  <li><a href="?doc=game&s=2">Gmäng</a></li>
				  <li><a href="?doc=game&s=3">Elu mäng</a></li>
				  <li><a href="?doc=game&s=4">Crazygame</a></li>
				  <li><a href="?doc=game&s=5">Lõpmatus</a></li>
				  <li><a href="?doc=game&s=6">Wrapsweeper</a></li>
				  <li><a href="?doc=game&s=7">Tetrabloxx</a></li>
				</ul>';
				}
			?>
			<li><a tabindex="12" class="<?php echo $faq;?>" href="?doc=faq">KKK</a></li>
			<li tabindex="13"><a tabindex="14" class="<?php echo $channels;?>" href="?doc=clinks">Kanalid ja lingid</a>
		  <?php if  (($channels == "selected") || ($isMob == false)) {
			  echo '<ul>
				<li><a href="?doc=clinks&s=1">Uued videod</a>
					  <ul>
						<li><a href="?doc=vids&channel=mt">MarkusTegelane</a></li>
						<li><a href="?doc=vids&channel=hmt">#markusTegelane</a></li>
						<li><a href="?doc=vids&channel=mtp">MarkusTegelane+</a></li>
						<li><a href="?doc=vids&channel=mas">Markuse asjad</a></li>
						<li><a href="?doc=vids&channel=paktc">Jätkamiseks vajutage suvalist klahvi...</a></li>
					  </ul></li>
				<li><a href="?doc=clinks&s=2">Profiilid</a>
				  <ul>
					<li><a href="https://www.youtube.com/MarkusTegelane" target="_blank">YouTube</a></li>
					<li><a href="https://twitter.com/@MarkusTegelane" target="_blank">Twitter</a></li>
					<li><a href="https://reddit.com/u/markustegelane" target="_blank">Reddit</a></li>
					<li><a href="https://github.com/MarkusMaal" target="_blank">GitHub profiil</a></li>
					<li><a href="https://lbry.tv/@MarkusTegelane:8" target="_blank">LBRY kanal</a></li>
					<li><a href="https://www.bitchute.com/channel/markustegelane/" target="_blank">BitChute kanal</a></li>
					<li><a href="https://forum.xda-developers.com/member.php?u=8290831" target="_blank">xda-developers profiil</a></li>
				  </ul>
				  </li>
				<li><a href="?doc=clinks&s=3">Ajaveebid</a>
				  <ul>
					<li><a href="https://markustegelane.blogspot.com">MarkusTegelane ajaveeb</a></li>
					<li><a href="https://markustegelane-en.blogspot.com">Blog (In English)</a></li>
					<li><a href="http://markusmc.tk">Minecrafti ajaveeb</a></li>
					<li><a href="http://logostech.tk" target="_blank">LogOS Technologies</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=4">Suletud lingid/profiilid</a>
				  <ul>
					<li><a href="../markusepood">Markuse asjade pood (arhiiv)</a></li>
					<li><a href="https://file-server-2035.000webhostapp.com/">Markuse asjade pood (suletud link)</a></li>
					<li><a href="https://google.com/+MarkusMaal">Google+ profiil</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=5">Juhuslikud videod</a>
				  <ul>
					<li><a href="random?c=all" target="_blank">Kõik kanalid</a></li>
					<li><a href="random?c=mt" target="_blank">MarkusTegelane</a></li>
					<li><a href="random?c=mtp" target="_blank">MarkusTegelane+</a></li>
					<li><a href="random?c=hmt" target="_blank">#markusTegelane</a></li>
					<li><a href="random?c=mas" target="_blank">Markuse asjad</a></li>
					<li><a href="random?c=pak" target="_blank">Jätkamiseks vajutage suvalist klahvi...</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=6">Kanalid</a>
				  <ul>
					<li><a href="https://www.youtube.com/c/MarkusTegelane" target="_blank">MarkusTegelane</a></li>
					<li><a href="https://www.youtube.com/channel/UCvpWEcJTj4DRGIa3o279-3Q" target="_blank">#markusTegelane</a></li>
					<li><a href="https://www.youtube.com/channel/UCGGMWFwRnLjTKRLtnO6KRFg" target="_blank">MarkusTegelane+</a></li>
					<li><a href="https://www.youtube.com/channel/UCMD2HR_TjoK-Xh3yY6NBynQ" target="_blank">Markuse asjad</a></li>
					<li><a href="https://www.youtube.com/channel/UCquUJ3h9wsJUm55zu6Sckpg" target="_blank">Jätkamiseks vajutage suvalist klahvi...</a></li>
					<li><a href="https://www.youtube.com/channel/UCirudpTn3Hp1sxbl-78z-dQ" target="_blank">Markus Maal (isiklik)</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=7">Muu</a>
				  <ul>
					<li><a href="https://web.archive.org/web/20180101000000*/markustegelane.tk/et-EE_index.php">Veebilehe arhiveeritud versioonid</a></li>
					<li><a href="?doc=usrnames">Kasutajanimed mängudes</a></li>
				  </ul></li>
				<li></li>
			  </ul>'; }?>
			</li>
			<li tabindex="15"><a tabindex="16" class="<?php echo $dloads;?>" href="?doc=dloads">Allalaadimised</a>
				 <?php if  (($dloads == "selected") || ($isMob == false)) { echo  '<ul>
					<li><a href="?doc=dloads&s=1">Pakkfailid</a></li>
					<li><a href="?doc=dloads&s=2">Powerpoint</a></li>
					<li><a href="?doc=dloads&s=3">Markuse tarkvara</a></li>
					<li><a href="?doc=dloads&s=4">Taustapildid</a></li>
					<li><a href="?doc=dloads&s=5">Muu</a></li></ul>';}?>
			  </li>
			<li tabindex="17"><a tabindex="18" class="<?php echo $about;?>" href="?doc=about">Teave</a>
				<?php if  (($about == "selected") || ($isMob == false)) {echo '<ul>
			 	<li><a href="?doc=changelog">Muudatuslogi</a></li>
				<li><a href="?doc=feedback&s=1">Tagasiside</a></li>
				</ul>';}?></li>
		  </ul>
		</nav>
	</section>
<?php include("common/cfgbar.php"); ?>
