 <?php
include("../../../../mobcheck.php");
 if (!empty($_GET)) {
 if ($_GET["l"] == "et") {
    include("est.php");
    die();
 }
 }
 ?>
 
 <!DOCTYPE html>
 <html lang="en">
    <head>
<link rel="shortcut icon" type="image/x-icon" href="/favicons/main.ico" />
        <title>markustegelane</title>
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
		<a href="index.php"><img center class="banner" src="/markustegelane/gfx/banner.png" alt="tere tulemast minu veebisaidile!"></a><br/>
        <div class="mainpage">
            <div style="width: 200px; margin: auto;">
            <?php
                if (empty($_COOKIE["lang"])) {
                    echo "<img style='width: 200px;' src='/markustegelane/images/cookie.svg'>";
                } else {
                    echo "<img style='width: 200px;' src='/markustegelane/images/cookie_bit.svg'>";
                }
            ?>
            </div>
            <h1 style="text-align: center;">This website uses cookies</h1>
            <a href="?l=et">Kuva see teade eesti keeles</a>
            <?php
                if (empty($_COOKIE["lang"])) {
                    echo "<p>It looks like you haven't set any cookies for this web site. In order to get the best experience on this web site, we need to set some cookies... if you don't mind.</p>";
                }
            ?>
            <p>The website uses cookies for the following purposes:</p>
            <ul>
                <li>Storing language information</li>
                <li>Storing theme preference</li>
            </ul>
            <p>The website may also send POST requests to the server for the following purposes</p>
            <ul>
                <li>Posting comments and feedback</li>
                <li>Login details when signing in using either moderator or owner account</li>
                <li>New data when modifying databases (owner/developer only)</li>
            </ul>
            <p>The website can store your login details if you are a moderator. Your password is stored as a hash and is also salted. Verification code is not encrypted, but only accessible by the owner/developer.</p>
            <?php
            if (empty($_COOKIE["lang"])) {
                echo "<a class='listitems' href='setcookie.php?lang=en'>Sure, why not</a>
                <a class='listitems' href='/markustegelane'>I don't want to enable cookies right now</a>";
            } else {
                echo '<p>You have agreed to have cookies saved on your computer. You can revoke this decision by clearing all cookie data in settings.</p><a href="..">Back to settings</a></p>';
            }?>
        </div>
    </body>
 </html>
