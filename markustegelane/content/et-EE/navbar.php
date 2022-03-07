	<section id="Navigatsiooniriba">
		<nav>
		  <ul class="nav">
		  <?php 
		  	$page = "home";
		  	if (!empty($_GET["doc"])) {
		  		$page = $_GET["doc"];
		  	}
		  	$main = "notselected";
		  	$faq = "notselected";
		  	$channels = "notselected";
		  	$dloads = "notselected";
		  	$about = "notselected";
		  	switch ($page)
		  	{
		  		case "home":
		  			$main = "selected";
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
		  <li tabindex="10"><a tabindex="11" class="<?php echo $main;?>" href="index.php">põhiline</a>
		  <?php if  (($main == "selected") || ($isMob == false)) {
			echo '
			  <ul>
				<li><a href="?s=1">mis see veebieht on</a></li>
				<li><a href="?s=3">mängud</a>
				  <ul>
					  <li><a href="?doc=game&s=1">arva number</a></li>
					  <li><a href="?doc=game&s=2">gmäng</a></li>
					  <li><a href="?doc=game&s=3">elu mäng</a></li>
					  <li><a href="?doc=game&s=4">crazygame</a></li>
					  <li><a href="?doc=game&s=5">lõpmatus</a></li>
					  <li><a href="?doc=game&s=6">wrapsweeper</a></li>
					</ul></li>
				<li><a href="?s=4">blogi</a></li>
				<li><a href="../channel_db">kanalite andmebaas</a></li>
                <li><a href="../mas_db">markuse asjade versioonid</a></li>
				</ul>';
				}
			?>
			<li><a tabindex="12" class="<?php echo $faq;?>" href="?doc=faq">kkk</a></li>
			<li tabindex="13"><a tabindex="14" class="<?php echo $channels;?>" href="?doc=clinks">kanalid ja lingid</a>
		  <?php if  (($channels == "selected") || ($isMob == false)) {
			  echo '<ul>
				<li><a href="?doc=clinks&s=1">uued videod</a>
					  <ul>
						<li><a href="?doc=vids&channel=mt">markustegelane</a></li>
						<li><a href="?doc=vids&channel=hmt">#markusTegelane</a></li>
						<li><a href="?doc=vids&channel=mtp">markustegelane x</a></li>
						<li><a href="?doc=vids&channel=mas">Markuse asjad</a></li>
						<li><a href="?doc=vids&channel=paktc">Jätkamiseks vajutage suvalist klahvi...</a></li>
					  </ul></li>
				<li><a href="?doc=clinks&s=2">profiilid</a>
				  <ul>
					<li><a href="https://www.youtube.com/MarkusTegelane" target="_blank">YouTube</a></li>
					<li><a href="https://twitter.com/@MarkusTegelane" target="_blank">Twitter</a></li>
					<li><a href="https://github.com/MarkusMaal" target="_blank">GitHub profiil</a></li>
					<li><a href="https://lbry.tv/@MarkusTegelane:8" target="_blank">LBRY kanal</a></li>
					<li><a href="https://www.bitchute.com/channel/markustegelane/" target="_blank">BitChute kanal</a></li>
					<li><a href="https://forum.xda-developers.com/member.php?u=8290831" target="_blank">xda-developers profiil</a></li>
				  </ul>
				  </li>
				<li><a href="?doc=clinks&s=3">ajaveebid</a>
				  <ul>
					<li><a href="https://markustegelane.blogspot.com">MarkusTegelane ajaveeb</a></li>
					<li><a href="https://markustegelane-en.blogspot.com">Blog (In English)</a></li>
					<li><a href="http://markusmc.tk">Minecrafti ajaveeb</a></li>
					<li><a href="http://logostech.tk" target="_blank">LogOS Technologies</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=4">suletud lingid/profiilid</a>
				  <ul>
					<li><a href="../markusepood">Markuse asjade pood (arhiiv)</a></li>
					<li><a href="https://file-server-2035.000webhostapp.com/">Markuse asjade pood (suletud link)</a></li>
					<li><a href="https://google.com/+MarkusMaal">Google+ profiil</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=5">juhuslikud videod</a>
				  <ul>
					<li><a href="random?c=all" target="_blank">kõik kanalid</a></li>
					<li><a href="random?c=mt" target="_blank">markustegelane</a></li>
					<li><a href="random?c=mtp" target="_blank">markustegelane x</a></li>
					<li><a href="random?c=hmt" target="_blank">#markusTegelane</a></li>
					<li><a href="random?c=mas" target="_blank">Markuse asjad</a></li>
					<li><a href="random?c=pak" target="_blank">Jätkamiseks vajutage suvalist klahvi...</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=6">kanalid</a>
				  <ul>
					<li><a href="https://www.youtube.com/c/MarkusTegelane" target="_blank">markustegelane</a></li>
					<li><a href="https://www.youtube.com/channel/UCvpWEcJTj4DRGIa3o279-3Q" target="_blank">#markusTegelane</a></li>
					<li><a href="https://www.youtube.com/channel/UCGGMWFwRnLjTKRLtnO6KRFg" target="_blank">markustegelane x</a></li>
					<li><a href="https://www.youtube.com/channel/UCMD2HR_TjoK-Xh3yY6NBynQ" target="_blank">Markuse asjad</a></li>
					<li><a href="https://www.youtube.com/channel/UCquUJ3h9wsJUm55zu6Sckpg" target="_blank">Jätkamiseks vajutage suvalist klahvi...</a></li>
					<li><a href="https://www.youtube.com/channel/UCirudpTn3Hp1sxbl-78z-dQ" target="_blank">Markus Maal (isiklik)</a></li>
				  </ul></li>
				<li><a href="?doc=clinks&s=7">muu</a>
				  <ul>
					<li><a href="https://web.archive.org/web/20180101000000*/markustegelane.tk/et-EE_index.php">Veebilehe arhiveeritud versioonid</a></li>
					<li><a href="?doc=usrnames">Kasutajanimed mängudes</a></li>
				  </ul></li>
				<li></li>
			  </ul>'; }?>
			</li>
			<li tabindex="15"><a tabindex="16" class="<?php echo $dloads;?>" href="?doc=dloads">allalaadimised</a>
				 <?php if  (($dloads == "selected") || ($isMob == false)) { echo  '<ul>
					<li><a href="?doc=dloads&s=1">pakkfailid</a></li>
					<li><a href="?doc=dloads&s=2">powerpoint</a></li>
					<li><a href="?doc=dloads&s=3">markuse tarkvara</a></li>
					<li><a href="?doc=dloads&s=4">taustapildid</a></li>
					<li><a href="?doc=dloads&s=5">muu</a></li></ul>';}?>
			  </li>
			<li tabindex="17"><a tabindex="18" class="<?php echo $about;?>" href="?doc=about">teave</a>
				<?php if  (($about == "selected") || ($isMob == false)) {echo '<ul>
				<li><a href="?doc=changelog">muudatuslogi</a></li>
				<li><a href="?doc=feedback&s=1">tagasiside</a></li>
				</ul>';}?></li>
			<li tabindex="19"><a tabindex="20" class="notselected" href="/x">x</a>
				<?php if (!$isMob) {echo '<ul>
					<li><a href="/x?p=channel">kanalist</a></li>
					<li><a href="/x?p=streams">kavad ja otseülekanded</a></li>
					<li><a href="https://www.youtube.com/channel/UCGGMWFwRnLjTKRLtnO6KRFg" target="_blank">külasta kanalit</a></li></ul>';}?>
			  </li>
			<li tabindex="21"><a tabindex="22" class="notselected" href="/dev">dev</a></li>
		  </ul>
		</nav>
	</section>
<?php include("common/cfgbar.php"); ?>
