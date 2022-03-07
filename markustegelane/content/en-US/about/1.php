	<script>
		function happyFunc() {
			alert("I am very happy.");
		}
		function getRandomColor() {
		  var letters = '0123456789ABCDEF';
		  var color = '#';
		  for (var i = 0; i < 6; i++) {
			color += letters[Math.floor(Math.random() * 16)];
		  }
		  return color;
		}
		function loadname() {
			if ((getCookie("username") != "") && (getCookie("username") != null)) {
				document.getElementById("name").innerHTML = "Hello, " + getCookie("username") + "!";
				document.getElementById("myBtn").innerHTML = "Change name";
			} else {
				document.getElementById("name").innerHTML = "Hello, anonymous!";
			}
		}
		function unsetName() {
            document.getElementById("name").innerHTML = "";
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
		}
		function hide() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
            document.getElementById('inmodal').innerHTML = '<p>Please enter a name:</p><input id="tfield" class="textfield" style="padding: 5px; margin-bottom: 10px;"></input><br/><a href="#/" onclick="setName();" class="listitems">OK</a><a style="margin-left: 5px;" href="#/" onclick="hide();" class="listitems">Loobu</a><a style="margin-left: 5px;" href="#/" onclick="unsetName();" class="listitems">Kustuta nimi</a>';
		}
		function setName() {
            var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            var x;
            x = document.getElementById("tfield").value;
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
            if (x != "" && x != null) {
                x = x + "!";
                if (x != x.replace(/</g, "<")) {
                    x = x.replace(/</g, "<") + "<br/><b>Do not even dare to try!</b>";
                }
                else if (x == "Bill Gates!") {
                    x = "this Microsoft guy!";
                }
                document.getElementById('name').innerHTML = "Hello, " + x;
                if (x == "H4CK3R!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "https://hackertyper.net/";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Access the system</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x == "disable!") {
                    document.getElementById("name").innerHTML = "";
                }
                else if (x == "ENA!") {
                    document.getElementById('name').innerHTML = "Hello, <span style=\"color: yellow;\">E</span><span style=\"color: black;\">N</span><span style=\"color: blue;\">A</span>!";
                }
                else if (x == "dislike!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = '<a href="theme/ohwow.png">Click if you dare</a>';
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Click if you dare</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x == "secret_theme!") {
                    var head = document.getElementsByTagName("head")[0];
                    var link = document.createElement("link");
                    link.id = "newid";
                    link.rel = "stylesheet";
                    link.type = "text/css";
                    link.href = "common/themes/wip.css";
                    link.media = "all";
                    head.appendChild(link);
					if ((getCookie("username") == null) || (getCookie("username") == "")) {
						var now = new Date();
						var minutes = 43200;
						now.setTime(now.getTime() + (minutes * 60 * 1000));
						document.cookie = "theme=wip; path=/ ; expires=" + now.toUTCString();
						message = '???<br/>Theme saved<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
						document.getElementById('inmodal').innerHTML = message;
						var modal = document.getElementById("myModal");
						modal.style.display = "block";
					}
                    document.getElementById("button1").innerHTML = "Restore default theme";
                    document.getElementById("button1").onclick = setCSS;
                }
                else if (x == "happiness!") {

                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "http://markustegelane.tk/joy.php";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Be chill!</a>');
                    document.getElementById("name").innerHTML = replacedText;
                    document.getElementById("button1").innerHTML = "I'm happy";
                    document.getElementById("button1").onclick = happyFunc;
                }
                else if (x == "Freenom!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "http://freenom.com";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Thanks you for offering the domain, Freenom!</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x == "000webhost!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "https://www.000webhost.com/";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Thank you for providing hosting services, 000webhost!</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x == "Cloudflare!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "https://www.cloudflare.com/";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Thank you for providing SSL/TLS for secure connection, Cloudflare!</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x.replace("___", "") != x) {
                    document.getElementById("name").style = "color: " + getRandomColor() + ";";
                    document.getElementById("name").innerHTML = "Tere, " + x.replace("___", "");
                }
            } else {
                message = 'Seems like you did not enter anything. This is not nice!<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
                document.getElementById('inmodal').innerHTML = message;
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }
		}

		
		function getCookie(cname) {
		    var name = cname + "=";
		    var decodedCookie = decodeURIComponent(document.cookie);
		    var ca = decodedCookie.split(';');
		    for(var i = 0; i <ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0) == ' ') {
		            c = c.substring(1);
		        }
		        if (c.indexOf(name) == 0) {
		            return c.substring(name.length, c.length);
		        }
		    }
		    return "";
		}
		
		function alertClicked() {
            message = ""
				if (document.getElementById("name").innerHTML == 'Hello, anonymous!') {
					document.getElementById("myBtn").innerHTML = "Enter name";
					document.cookie = "username=";
					message = 'Greeting disabled<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
				} else {
					var uname = document.getElementById("name").innerHTML;
                    var now = new Date();
					var minutes = 43200;
					now.setTime(now.getTime() + (minutes * 60 * 1000));
					document.cookie = "username=" + uname.replace("Hello, ", "").replace("!", "") + "; path=/ ; expires=" + now.toUTCString();
					
					message = 'Name saved<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
				}
            document.getElementById('inmodal').innerHTML = message;
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
		}
		function buttonClicked() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
		}
	</script>
  <h1>About</h1>
  <p>themarkusguy official web site<br>Version 6.1<br>Codename: LaserLite<br>Build: 6138<br>Last modified (UTC): <?php
echo date('F j, Y g:m:s a', filemtime($_SERVER["DOCUMENT_ROOT"] . '/markustegelane/content/et-EE/about/1.php'));
?><script>document.write('<br>Technology: Markus' software JS<br/><span id="ctype"></span>'); </script><br/><?php echo 'Host version: ' . phpversion();?><br/>
  </p>
<?php if (!empty($_SESSION["usr"])) {
  echo '<a href="?doc=development&s=1&subdoc=about">Modify information</a><br/>';
}?>
  <a href="?doc=changelog">Changelog</a><br/>
  <a href="?doc=feedback&s=1">Feedback</a>
  <br>
  <div style="width: 500px; margin: auto;">
  <?php
  if ($_COOKIE["theme"] == "light") {
  	echo '<a href="images/ljsoftware-en.png" title="web software by markus"><img style="width: 100%;" src="images/ljsoftware-en.png"></a>';
  } else {
  	echo '<a href="images/jsoftware-en.png" title="web software by markus"><img style="width: 100%;" src="images/jsoftware-en.png"></a>';
  }
  ?>
  </div>
  <br>
  <h2>Hosting provided by 000webhost</h2>
  <a target="_blank" href="https://000webhost.com"><img alt="000webhost" src="https://cdn.000webhost.com/000webhost/logo/000logo-new-colors.svg" style="width:20%;"></a>
  <br><br>
  <h2>Domain provider</h2>
  <a title="Freenom - A Name for Everyone" href="https://www.freenom.com"><img alt="Freenom - DNS teenus" src="https://www.freenom.com/images.v2/logo.png" style="width:20%;"></a>
  <br><br>
  <h2>SSL/TLS provider (HTTPS support)</h2>
  <a title="Cloudflare - The Web Performance & Security Company" href="https://www.cloudflare.com/"><img style="width: 25%;" src="https://www.cloudflare.com/img/logo-cloudflare-dark.svg"/></a>
  <p id="name">Hello, anonymous!</p>
	<form>
        <a href="#/" id="myBtn" onclick="buttonClicked();" class="listitems">Enter name</a>
        <div id="myModal" class="modal">
            <div id="inmodal" class="modal-content">
                <p>Please enter a name:</p>
                <input id="tfield" class="textfield" style="padding: 5px; margin-bottom: 10px;"></input><br/>
                <a href="#/" onclick="setName();" class="listitems">OK</a>
                <a href="#/" onclick="hide();" class="listitems">Cancel</a>
                <a href="#/" onclick="unsetName();" class="listitems">Delete name</a>
            </div>
        </div>

        <?php if (isset($_COOKIE)) { echo '<a href="#/" id="button1" onclick="alertClicked();" class="listitems">Save</a>'; }?>
	</form>
  <!-- <a href="images\about.png"><img width=300 src="images\about.png" alt="Picture of the source code."><img></a>
  <p>Source code for this web page</p> --->
  <!-- END OF Main page section --->
<script>

	<?php if (isset($_COOKIE["username"])) { echo 'loadname();'; }?>
</script>