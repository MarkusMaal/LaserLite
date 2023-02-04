	<section id="Navigation_bar">
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
			<li tabindex="8"><a tabindex="9" class="<?php echo $main;?>" href="index.php?s=4">News</a>
			<li tabindex="10"><a tabindex="11" class="<?php echo $game;?>" href="index.php?s=3">Games</a>
			  <?php if  (($main == "selected") || ($isMob == false)) {
			echo"<ul>
				<li><a href=\"?doc=game&s=1\">Guess the number</a></li>
				<li><a href=\"?doc=game&s=2\">Ggame</a></li>
				<li><a href=\"?doc=game&s=3\">Game of life</a></li>
				<li><a href=\"?doc=game&s=4\">Crazygame</a></li>
				<li><a href=\"?doc=game&s=5\">Infinity</a></li>
				<li><a href=\"?doc=game&s=6\">Wrapsweeper</a></li>
				<li><a href=\"?doc=game&s=7\">Tetrabloxx</a></li>
				</ul>";
				}
			?>
			
			<li><a tabindex="12" class="<?php echo $faq;?>" href="?doc=faq">FAQ</a></li>
			<li tabindex="13"><a tabindex="14" class="<?php echo $channels;?>" href="?doc=clinks">Channels and links</a>
			  <?php if  (($channels == "selected") || ($isMob == false)) {
			  echo "<ul>
				<li><a href=\"?doc=clinks&s=1\">New videos</a>
					  <ul>
						<li><a href=\"?doc=vids&channel=mt\">MarkusTegelane</a></li>
						<li><a href=\"?doc=vids&channel=hmt\">#markusTegelane</a></li>
						<li><a href=\"?doc=vids&channel=mtp\">MarkusTegelane+</a></li>
						<li><a href=\"?doc=vids&channel=mas\">Markus' stuff</a></li>
						<li><a href=\"?doc=vids&channel=paktc\">Press any key to continue...</a></li>
					  </ul></li>
				<li><a href=\"?doc=clinks&s=2\">Profiles</a>
				  <ul>
					<li><a href=\"https://www.youtube.com/MarkusTegelane\" target=\"_blank\">YouTube</a></li>
					<li><a href=\"https://twitter.com/@MarkusTegelane\" target=\"_blank\">Twitter</a></li>
					<li><a href=\"https://reddit.com/u/markustegelane\" target=\"_blank\">Reddit</a></li>
					<li><a href=\"https://github.com/MarkusMaal\" target=\"_blank\">Github profile</a></li>
					<li><a href=\"https://lbry.tv/@MarkusTegelane:8\" target=\"_blank\">LBRY channel</a></li>
					<li><a href=\"https://www.bitchute.com/channel/markustegelane/\" target=\"_blank\">Bitchute channel</a></li>
					<li><a href=\"https://forum.xda-developers.com/member.php?u=8290831\" target=\"_blank\">xda-developers profile</a></li>
				  </ul>
				  </li>
				<li><a href=\"?doc=clinks&s=3\">Blogs</a>
				  <ul>
					<li><a href=\"https://markustegelane.blogspot.com\">MarkusTegelane ajaveeb (eesti keeles)</a></li>
					<li><a href=\"https://markustegelane-en.blogspot.com\">Blog (In English)</a></li>
					<li><a href=\"http://markusmc.tk\">Minecraft blog (In Estonian)</a></li>
					<li><a href=\"http://logostech.tk\" target=\"_blank\">LogOS Technologies</a></li>
				  </ul></li>
				<li><a href=\"?doc=clinks&s=4\">Closed links/profiles</a>
				  <ul>
					<li><a href=\"../markusepood\">Markus' stuff store (archive)</a></li>
					<li><a href=\"https://file-server-2035.000webhostapp.com/\">Markus' stuff store (closed link)</a></li>
					<li><a href=\"https://google.com/+MarkusMaal\">Google+ profile</a></li>
				  </ul></li>
				<li><a href=\"?doc=clinks&s=5\">Random videos</a>
				  <ul>
					<li><a href=\"random?c=all\" target=\"_blank\">All channels</a></li>
					<li><a href=\"random?c=mt\" target=\"_blank\">MarkusTegelane</a></li>
					<li><a href=\"random?c=hmt\" target=\"_blank\">#markusTegelane</a></li>
					<li><a href=\"random?c=mtp\" target=\"_blank\">MarkusTegelane+</a></li>
					<li><a href=\"random?c=mas\" target=\"_blank\">Markus' stuff</a></li>
					<li><a href=\"random?c=pak\" target=\"_blank\">Press any key to continue...</a></li>
				  </ul></li>
				<li><a href=\"?doc=clinks&s=6\">Channels</a>
				  <ul>
					<li><a href=\"https://www.youtube.com/c/MarkusTegelane\" target=\"_blank\">MarkusTegelane</a></li>
					<li><a href=\"https://www.youtube.com/channel/UCGGMWFwRnLjTKRLtnO6KRFg\" target=\"_blank\">MarkusTegelane+</a></li>
					<li><a href=\"https://www.youtube.com/channel/UCvpWEcJTj4DRGIa3o279-3Q\" target=\"_blank\">#markusTegelane</a></li>
					<li><a href=\"https://www.youtube.com/channel/UCMD2HR_TjoK-Xh3yY6NBynQ\" target=\"_blank\">Markus' stuff</a></li>
					<li><a href=\"https://www.youtube.com/channel/UCquUJ3h9wsJUm55zu6Sckpg\" target=\"_blank\">Press any key to continue...</a></li>
					<li><a href=\"https://www.youtube.com/channel/UCirudpTn3Hp1sxbl-78z-dQ\" target=\"_blank\">Markus Maal (personal)</a></li>
				  </ul></li>
				<li><a href=\"?doc=clinks&s=7\">Other</a>
				  <ul>
					<li><a href=\"https://web.archive.org/web/20180101000000*/markustegelane.tk/et-EE_index.php\">Archived versions of the web page</a></li>
					<li><a href=\"?doc=usrnames\">Usernames in games</a></li>
				  </ul></li>
				<li></li>
			  </ul>";}?>
			</li>
			<li tabindex="15"><a tabindex="16" class="<?php echo $dloads;?>" href="?doc=dloads">Downloads</a>
				<?php if  (($dloads == "selected") || ($isMob == false)) { echo "<ul>
					<li><a href=\"?doc=dloads&s=1\">Batch files</a></li>
					<li><a href=\"?doc=dloads&s=2\">Powerpoint</a></li>
					<li><a href=\"?doc=dloads&s=3\">Markus' software</a></li>
					<li><a href=\"?doc=dloads&s=4\">Wallpapers</a></li>
					<li><a href=\"?doc=dloads&s=5\">Other</a></li></ul>";}?>
			  </li>
			<li tabindex="17"><a tabindex="18" class="<?php echo $about;?>" href="?doc=about">About</a>
				<?php if  (($about == "selected") || ($isMob == false)) {echo "<ul>
				<li><a href=\"?doc=changelog\">Changelog</a></li>
				<li><a href=\"?doc=feedback&s=1\">Feedback</a></li>
				</ul>";}?></li>
		    </ul>
		</nav>
	</section>
<?php include("common/cfgbar.php"); ?>
