<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="/favicons/x.ico" />
    <title>x</title>
  </head>
  <body>
    <header></header>
    <main>
    	<p><?php if (!empty($_COOKIE["lang"])) {
                        if ($_COOKIE["lang"] == "et-EE") {
                            echo "Veebileht on konstrueerimisel";
                        } else {
                            echo "This page is under construction";
                        }
                } else {
                            echo "This page is under construction";
                }?>
    	 </p>
    </main>
    <footer></footer>
  </body>
</html>
