<?php
?>
  <h1>Teave</h1>
  <p>markustegelane ametlik veebisait<br>Versioon 6.3<br>Varjunimi: LaserLite<br>Järk: 6403<br>Viimane muutmisaeg (UTC): <?php
echo date('d.m.Y H:m:s', filemtime($_SERVER["DOCUMENT_ROOT"] . '/markustegelane/content/et-EE/about/1.php'));
?><script>document.write('<br>Tehnoloogia: Markuse tarkvara JS<br/><span id="ctype"></span>'); </script><?php echo 'Hosti versioon: ' . phpversion();?><br/>Ühenduse tüüp: <?php 
$isSsl = false; 
if (isset($_SERVER['HTTP_CF_VISITOR']) || !empty($_SERVER['HTTPS'])) {
    $cfDecode = json_decode($_SERVER['HTTP_CF_VISITOR']);
    if (!empty($cfDecode) && !empty($cfDecode->scheme) && $cfDecode->scheme == 'https') {
        $isSsl = true;
    }
    if (!empty($_SERVER["HTTPS"])) {
        $isSsl = true;
    }
}
if ($isSsl == true) {
   echo '<span style="color: #0f0;">Turvaline</span>';
} else {
   echo '<span style="color: #f00;">Ebaturvaline</span>';
}
?><br/>
  </p>
<?php if (!empty($_SESSION["usr"])) {
  echo '<a href="?doc=development&s=1&subdoc=about">Teabe muutmine</a><br/>';
}?>
  <a href="?doc=changelog">Muudatustelogi</a><br/>
  <a href="?doc=feedback&s=1">Tagasiside</a>
  <br>
  <div style="width: 500px; margin: auto;">
  <?php
  if ($theme == "light") {
  echo '<a href="images/ljsoftware.png" title="markuse loodud veebitarkvara"><img style="width: 100%;" src="images/ljsoftware.png"></a>';
  } else {
  echo '<a href="images/jsoftware.png" title="markuse loodud veebitarkvara"><img style="width: 100%;" src="images/jsoftware.png"></a>';
  }
  ?>
  </div>
  <br>
<?php if ((str_contains($_SERVER["HTTP_HOST"], ".ml")) || (str_contains($_SERVER["HTTP_HOST"], ".tk"))) {
echo '<h2>Domeeni pakkuja</h2>
<a target="_blank" href="freenom.com"><img title="Freenom - A name for everyone" alt="Freenom" src="https://www.freenom.com/images.v2/logo.png" style="width: 20%;"></a><br/><br/>';
}
if (!empty($_SERVER["HTTPS"])) {
if (str_contains($_SERVER["HTTP_HOST"], ".eu")) {
echo '<h2>SSL/TLS pakkuja</h2>
<a target="_blank" href="https://letsencrypt.org/"><img title="Let\'s Encrypt" alt="Let\'s Encrypt" src="https://letsencrypt.org/images/letsencrypt-logo-horizontal.svg" style="width: 20%;"></a><br/><br/>';
} else if (str_contains($_SERVER["HTTP_HOST"], ".tk")) {
echo '<h2>SSL/TLS pakkuja</h2>
<a target="_blank" href="https://zerossl.com/"><img title="ZeroSSL" alt="ZeroSSL" src="https://zerossl.com/assets/images/zerossl_logo.svg" style="width: 20%;"></a><br/><br/>';
} else if (str_contains($_SERVER["HTTP_HOST"], ".online")) {
echo '<h2>SSL/TLS pakkuja</h2>
<a target="_blank" href="https://pki.goog/"><img title="Google Trust Services LLC" alt="ZeroSSL" src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" style="width: 20%;"></a><br/><br/>';
}
}
?>
   <h2>Veebimajutus</h2>
  <a target="_blank" href="https://hostinger.ee?REFERRALCODE=1MARKUS53"><img title="Klõpsake siia, kui soovite 20% allahindlust ning samal ajal ka aidata katta veebilehe majutuskulusid" alt="Hostinger" src="https://assets.hostinger.com/images/logo-homepage2020-f9c79137d7.svg" style="width:20%;"></a>
  <br><br>
  <p id="name">Tere, Anonüümne isik!</p>
        <a href="#/" id="myBtn" onclick="buttonClicked();" class="listitems">Sisesta nimi</a>
        <div id="myModal" class="modal">
            <div id="inmodal" class="modal-content">
                <p>Palun sisestage nimi:</p>
                <input id="tfield" class="textfield" style="padding: 5px; margin-bottom: 10px;"></input><br/>
                <a href="#/" onclick="setName();" class="listitems">OK</a>
                <a href="#/" onclick="hide();" class="listitems">Loobu</a>
                <a href="#/" onclick="unsetName();" class="listitems">Kustuta nimi</a>
            </div>
        </div>

        <?php if (isset($_COOKIE)) { echo '<a href="#/" id="button1" onclick="alertClicked();" class="listitems">Salvesta</a>'; }?>
	<script>
		function happyFunc() {
			alert("Ma olen väga õnnelik.");
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
				document.getElementById("name").innerHTML = "Tere, " + getCookie("username") + "!";
				document.getElementById("myBtn").innerHTML = "Muuda nime";
			} else {
				document.getElementById("name").innerHTML = "Tere, Anonüümne isik!";
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
            document.getElementById('inmodal').innerHTML = '<p>Palun sisestage nimi:</p><input id="tfield" class="textfield" style="padding: 5px; margin-bottom: 10px;"></input><br/><a href="#/" onclick="setName();" class="listitems">OK</a><a style="margin-left: 5px;" href="#/" onclick="hide();" class="listitems">Loobu</a><a style="margin-left: 5px;" href="#/" onclick="unsetName();" class="listitems">Kustuta nimi</a>';
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
                    x = x.replace(/</g, "<") + "<br/><b>Ära mitte üritagi!</b>";
                }
                else if (x == "Bill Gates!") {
                    x = "see Microsofti tüüp!";
                }
                x = x.replace('rebane', '<span style="color: #ff6600;">rebane</span>')
                document.getElementById('name').innerHTML = "Tere, " + x;
                if (x == "H4CK3R!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "https://hackertyper.net/";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Access the system</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x == "keela!") {
                    document.getElementById("name").innerHTML = "";
                }
                else if (x == "rõõm!") {
                    var inputText = "<a href=\"errors/joy.php\">Olge mõnusad</a>";
                    document.getElementById("name").innerHTML = inputText;
                    document.getElementById("button1").innerHTML = "Olen rõõmus";
                    document.getElementById("button1").onclick = happyFunc;
                }
                else if (x == "Freenom!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "http://freenom.com";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Tänan domeeni pakkumise eest, Freenom!</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x == "000webhost!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "https://www.000webhost.com/";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Tänan hostimisteenuse pakkumise eest, 000webhost!</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x == "Cloudflare!") {
                    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                    var inputText = "https://www.cloudflare.com/";
                    var replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">Tänan SSL/TLS pakkumise eest turvalise ühenduse jaoks, Cloudflare!</a>');
                    document.getElementById("name").innerHTML = replacedText;
                }
                else if (x.replace("___", "") != x) {
                    document.getElementById("name").style = "color: " + getRandomColor() + ";";
                    document.getElementById("name").innerHTML = "Tere, " + x.replace("___", "");
                }
            } else {
                message = 'Tundub, et te ei sisestanud midagi. See ei ole ilus!<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
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
			// if (getCookie("cookie_ok") == "true") {
				if (document.getElementById("name").innerHTML == 'Tere, Anonüümne isik!') {
					document.getElementById("myBtn").innerHTML = "Sisesta nimi";
					document.cookie = "username=";
					message = 'Tervitus keelati<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
				} else {
					var uname = document.getElementById("name").innerHTML;
                    var now = new Date();
					var minutes = 43200;
					now.setTime(now.getTime() + (minutes * 60 * 1000));
					document.cookie = "username=" + uname.replace("Tere, ", "").replace("!", "") + "; path=/ ; expires=" + now.toUTCString();
					
					message = 'Nimi salvestati<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
				}
			// } else {
                // message = 'Nime salvestamine nurjus<br/><br/><a href="#/" onclick="hide();" class="listitems">OK</a>';
			// }
            document.getElementById('inmodal').innerHTML = message;
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
		}
		function buttonClicked() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
		}
        <?php if (isset($_COOKIE["username"])) { echo 'loadname();'; }?>
	</script>
