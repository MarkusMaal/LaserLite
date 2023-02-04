<?php
function ms ($en, $et) {
	if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US")) {
		return $en;
	} else {
		return $et;
	}

}
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
?>

<table style="margin-left:0px; width: 100%;">
		<tr style="float: left; width: 100%;">
		<td>
		<?php $page = "home";
		if (!empty($_GET["doc"])) {
			$page = $_GET["doc"];
		}

		$pages = "123456789";
		if (!empty($_GET["s"])) {
			$pages = $_GET["s"];
		}
		if (($pages == "123456789") && ($page == "home")) {
			$pages = "4";
		}
		
		$result = mysqli_query($connection, "SELECT * FROM navbar WHERE FOLDER = \"$page\" AND SUBDOC = \"$pages\"");
		$fetch = mysqli_fetch_array($result);
		if ($fetch == null) {
			$result = mysqli_query($connection, "SELECT * FROM navbar WHERE FOLDER = \"$page\" AND PARENT = null");
			$fetch = mysqli_fetch_array($result);
			if ($fetch == null) {
				$fetch = array(0, $page, "Määratlemata lehekülg", "Undefined page", 0, null, 123456789);
			}
		}
		?>
		<?php
		if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/config/gfx/" . $page . ".svg")) {
		echo '<img style="width: 5em;" src="/markustegelane/common/config/gfx/' . $page . '.svg">'; }?>
		</td>
		<td>
		
		<h1 style="padding-top: 0px;"><?php echo ms($fetch[3], $fetch[2]); ?></h1>
		</td>
		</tr>
		<tr style="background: #<?php if ($theme == "blue") { echo '00f'; } else if ($theme == "light") { echo '888'; } else { echo '555'; } ?>2; width: 100%;">
			<td colspan="2">
				<?php if (!$isMob) {
				echo '<a href="/"><div style="padding: 0.6em; padding-left: 0em; padding-right: 0em;" class="button"><img style="width: 37%;" src="/markustegelane/common/config/gfx/house.svg"></div></a>
				<a href="/markustegelane/common/config"><div style="padding: 0.6em; padding-left: 1.7em; padding-right: 1.7em;" class="button"><img style="width: 95%;" src="/markustegelane/common/config/gfx/gears.svg"></div></a>';
				} else {
					echo '<a href="/"><div class="button">' . ms("Home page", "Avaleht") . '</div></a>
				<a href="/markustegelane/common/config"><div class="button">' . ms("Settings", "Seaded") . '</div></a>';
				}?>
				<?php
					$query = "SELECT * FROM navbar WHERE PARENT IS NULL";
					$result = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_array($result)) {
						echo '<a href="/markustegelane/?doc=' . $row["FOLDER"] . '&s=' . $row["SUBDOC"] . '"><div class="button">';
						echo ms($row["FRIENDLYNAME_EN"], $row["FRIENDLYNAME_ET"]);
						echo '</div></a>';
					}
				?>
			</td>
		</td>
		</table>
		<hr>
		<hr style="border-color: <?php
		
		switch ($theme) {
			case "blue":
				echo '#00e';
				break;
			case "light":
				echo '#eee';
				break;
			case "dark":
				echo '#888';
				break;
		}
				?>;">