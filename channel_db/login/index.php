<?php 

include("../head.php");
?>
			<h1><?php echo ms("Management account login", "Haldaja kontoga sisselogimine"); ?></h1>
			<?php
				if ((empty($_COOKIE["lang"])) || ($_COOKIE["lang"] == "en-US")) {
					echo '<p>English translation for management features is not available yet.</p>';
				}
			?>
			<form action="login.php" method="post">
			<table>
				<tr>
				<td><?php echo ms("Username", "Kasutajanimi"); ?></td>
				<td>
				<input name="loginuser" type="text"></input><br/><br/>
				</td>
				</tr>
				<tr>
				<td><?php echo ms("Password", "Parool"); ?></td>
				<td>
				<input name="loginpass" type="password"></input><br/><br/>
				</td>
				</tr>
				</tr>
				<tr>
				<td colspan=2>
				<a href="recovery.php"><?php echo ms("I forgot the username or password", "Ma unustasin kasutajanime või parooli"); ?></td>
				</tr>
				<tr>
				<td colspan=2>
				<input type="submit" value="<?php echo ms("Log in", "Logi sisse"); ?>"></input>
				</td>
				</a>
				</table>
			</form>
<?php include("../foot.php");?>
