<!DOCTYPE html>
<html>
<head>
<?php include("getcookies.php");
include("../../../mobcheck.php"); 
?>
<title>
<?php
if ($lang == "et-EE") {
	echo "Haldaja konto";
} else {
	echo "Manager account";
}
?></title>

<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
<?php
if (empty($_COOKIE["theme"])) {
    $theme = 'light';
} else {
    $theme = $_COOKIE["theme"];
}
?>
<link rel="stylesheet" href="/markustegelane/common/themes/<?php echo $theme;	if ($isMob) {  echo "_m"; 	} ?>.css">
</head>
<body>
		<a href="index.php"><img center class="banner" src="gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
		<div class="mainpage">
			<h1><?php
			if ($lang == "et-EE") {
				echo 'Haldaja kontoga sisselogimine';
			} else if ($lang == "en-US") {
				echo 'Manager account login';
			}?></h1>
			<form action="login.php<?php 
			if (!empty($_GET["redir"])) {
			echo '?redir=' . $_GET["redir"];
			}
			?>" method="post">
			<table>
				<tr>
				<td>
				<?php
				if ($lang == "et-EE") {
					echo 'Kasutajanimi';
				} else if ($lang == "en-US") {
					echo 'Username';
				}?>
				</td>
				<td>
				<input name="loginuser" type="text"></input><br/><br/>
				</td>
				</tr>
				<tr>
				<td>
				<?php
				if ($lang == "et-EE") {
					echo 'Parool';
				} else if ($lang == "en-US") {
					echo 'Password';
				}?>
				</td>
				<td>
				<input name="loginpass" type="password"></input><br/><br/>
				</td>
				</tr>
				</tr>
				<tr colspan=2>
				<td>
				<a href="recovery.php">
				<?php
				if ($lang == "en-US") {
					echo 'I forgot the username or password';
				} else if ($lang == "et-EE") {
					echo 'Ma unustasin kasutajanime või parooli';
				}?>
				</td>
				</tr>
				<tr>
				<td colspan=2>
				<input type="submit" value="<?php 
				if ($lang == "et-EE") {
					echo 'Logi sisse';
				} else if ($lang == "en-US") {
					echo 'Log in';
				}?>"></input>
				</td>
				</a>
				</table>
			</form>
		</div>
</body>
