    <script>
        var redslide = document.getElementById("redCount");

        function updateDelay(args) {
            nargs = 256 - Number(args)
            document.getElementById("fdly").innerHTML = " " + String(Math.round(Number(1000 / nargs))) + " fps";
            iterate()
            game.fullrate = nargs;
            iterate()
        }
        function updateSize(args) {
            document.getElementById("wsize").innerHTML = " " + String(args) + "%";
            game.canvas.setAttribute("style", "width: " + String(args) + "%; image-rendering: pixelated;");
        }

        function updateRed(args) {
            document.getElementById("rstr").innerHTML = " " + String(args);
            game.bg_r = args;
        }

        function updateGreen(args) {
            document.getElementById("gstr").innerHTML = " " + String(args);
            game.bg_g = args;
        }

        function updateBlue(args) {
            document.getElementById("bstr").innerHTML = " " + String(args);
            game.bg_b = args;
        }
        
        function updateRed2(args) {
            document.getElementById("rstr2").innerHTML = " " + String(args);
            game.fg_r = args;
        }

        function updateGreen2(args) {
            document.getElementById("gstr2").innerHTML = " " + String(args);
            game.fg_g = args;
        }

        function updateBlue2(args) {
            document.getElementById("bstr2").innerHTML = " " + String(args);
            game.fg_b = args;
        }

    </script>
    <script src="content/et-EE/game/scripts/main.js"></script>
    <script src="content/et-EE/game/scripts/game.js"></script>
    <script src="content/et-EE/game/scripts/board.js"></script>
	<br>
    <div id="mai" style="margin-left: auto; margin-right:auto; width: 89%; float: none;">
    <h1>Elu mäng</h1>
    <h2 id="state">Joonistamisrežiim</h2>
    <p id="it_str">Vajutage "Alusta simulatsiooni", et alustada</p>
    <div id="sizesetup">
        <span style="margin-right: 10px;">Ristküliku suurus:</span><input style="padding: 10px; border: none; font-size: 12pt; width: 25px;" value="5" id="res_w"></input><a href="#/" style="margin-left: 10px;" onclick="game.set_size()" class="listitems">Muuda</a>
    </div>
    <div/>
    <div id="btn_parent" style="margin-top: 1%; margin-bottom: 1%;">
    <a href="#/" onclick="iterate()"  id="pause_resume" class="listitems">Alusta simulatsiooni</a>
    <a href="#/" onclick="iterate_one()" class="listitems">Järgmine iteratsioon</a>
    <a href="#/" onclick="reload_game()" class="listitems">Uus mäng</a>
    <a href="#/" onclick="inv_remove()" class="listitems" id="btype">Režiim: Joonistamine</a>
    </div>
    <div id="startbtn"/>
    </div>
    <div style="padding-left: 0%; padding-right: 0%; margin-left: auto; margin-right:auto; width: 89%; float: none;">
<br/><br/>
    <h2>Isikupärastamine</h2>
    <h2>Täpsemad seadistused:</h2>
    <p>Kaadrisagedus:</p>
    <div class="slidecontainer">
    <input style="width: 90%;" type="range" min="0" max="240" step="0.25" value="128" onchange="updateDelay(this.value)"><span id="fdly"> 9 fps</span>
    </div>
    <p>Akna suurus:</p>
    <div class="slidecontainer">
    <input style="width: 90%;" type="range" min="0" max="100" step="0" value="50" onchange="updateSize(this.value)"><span id="wsize"> 50%</span>
    </div>
    <center>
        <table style="width: 100%">
            <tr>
                <td>
                <h2>Taustavärv:</h2>
                <p>Punane:</p>
                <div class="slidecontainer">
                <input type="range" min="0" max="255" value="0" id="redCount" onchange="updateRed(this.value)"><span id="rstr"> 0</span>
                </div>
                <p>Roheline:</p>
                <div class="slidecontainer">
                <input type="range" min="0" max="255" value="0" id="greenCount" onchange="updateGreen(this.value)"><span id="gstr"> 0</span>
                </div>
                <p>Sinine:</p>
                <div class="slidecontainer">
                <input type="range" min="0" max="255" value="0" id="blueCount" onchange="updateBlue(this.value)"><span id="bstr"> 0</span>
                </div>
                </td>
                <td>
                    <h2>Esiplaani värv:</h2>
                    <p>Punane:</p>
                    <div class="slidecontainer">
                    <input type="range" min="0" max="255" value="255" id="redCount2" onchange="updateRed2(this.value)"><span id="rstr2"> 255</span>
                    </div>
                    <p>Roheline:</p>
                    <div class="slidecontainer">
                    <input type="range" min="0" max="255" value="255" id="greenCount2" onchange="updateGreen2(this.value)"><span id="gstr2"> 255</span>
                    </div>
                    <p>Sinine:</p>
                    <div class="slidecontainer">
                    <input type="range" min="0" max="255" value="255" id="blueCount2" onchange="updateBlue2(this.value)"><span id="bstr2"> 255</span>
                    </div>
                </td>
            </tr>
        </table>
    </center>
<br/><br/>
    <h2>Juhised</h2>
    <h3 style="margin-top: 40px;">Tähised</h3>
    <ul>
    <li>Esiplaani värviga piksel (vaikesäte: valge): Elus piksel</li>
    <li>Taustavärviga piksel (vaikesäte: must): Eluta piksel</li>
    </ul>
    <h3 style="margin-top: 40px;">Reeglid</h3>
    <p>See mäng põhineb J. H. Conway rakuautomaadil "Game of Life". Sellel on 4 lihtsat reeglit, mis on järgmised:</p>
    <ol>
    <li>Elus rakk, millel on vähem kui kaks naaberrakku ei ela järgmises ajaühikus</li>
    <li>Elus rakk, millel on kaks või kolm naaberrakku jääb järgmises ajaühikus elama</li>
    <li>Elus rakk, millel on rohkem kui kolm naaberrakku ei ela järgmises ajaühikus</li>
    <li>Eluta rakk, millel on täpselt kolm naaberrakku elab järgmises ajaühikus</li>
    </ol>
    <a href="https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life">Lisainfo rakuautomaadi kohta (inglise keeles)</a><br/>
     <span style="color: yellow;">Märkus:</span><i>Sellel versioonil on teatud erinevus originaalse ideega: mänguala on piiratud, st rakud võivad piiride juures seisma jääda, kuid ülejäänu peaks olema identne.</i>
    <h3 style="margin-top: 40px;">Joonistamisrežiim</h3>
    <p>Mäng käivitub alguses selles režiimis. Hoides vasakut hiirenuppu all ja liigutades või klõpsates kindlasse kohta mängualal, saate lisada elusaid rakke. Et kustutada elavaid rakke, klõpsake "Režiim: Joonistamine", mis aktiveerib kustutamise. Vajutage "Režiim: Kustutamine", et minna tagasi harilikku režiimi.
    Et mänguala tühjendada, vajutage nupule "Uus mäng". Simulatsiooni alustamiseks valige "Alusta simulatsioon", ühe ajaühiku haaval liikumiseks vajutage
    "Järgmine iteratsioon" nupule.</p>
    <h3 style="margin-top: 40px;">Elurežiim</h3>
    <p>Kui näete teksti "Simulatsioon jookseb..." ja mängualal toimuvad muudatused, on mäng alanud. Mängija ei pea ühtegi nuppu enam vajutama, tuleb ainult
    jälgida kui pikalt elu kestab. Simulatsiooni peatamiseks valige "Peata simulatsioon". Jätkamiseks valige "Jätka simulatsiooni". Eesmärgiks on luua
    konfiguratsioon, mis kestaks võimalikult kaua.</p>
    <h3 style="margin-top: 40px;">Mängu lõpp</h3>
    <p>Mäng lõpeb ühe järgmise tulemusega:</p>
    <ul>
    <li>Entroopia: Kõik rakud on surnud, kaasaarvatud seisvad rakud</li>
    <li>Liikuvaid rakke pole: Kõik liikuvad rakud on surnud, seisvad on veel elus</li>
    <li>Seisev evolutsioon: Eksisteerivad ainult pulseerivad (ja seisvad) rakud</li>
    </ul>
    <p>Mängu lõpus saate näha mitu ajaühikut teie konfiguratsioon kestis. Uue mängu alustamiseks valige nüüd "Uus mäng".</p>
    <h3 style="margin-top: 40px;">Lisafunktsioonid</h3>
    <p>Selles mängus saate ka muuta ühe raku suurust klõpsates tekstiväljale, kirjutades numbri ning seejärel vajutades "Muuda".</p>
    <p>Võimalik on ka muuta värve. Kasutades mänguala all olevaid liugureid saate määrata esiplaani ja tagaplaani värve RGB süsteemis
    (saate kasutada nt <i><a href="https://google.com/search?q=color+picker">RGB color picker</a></i>, et näha kõiki väärtusi kindla värvi jaoks)</p>
    <p>Lisaks on võimalik muuta kaadrisagedust. Mida kõrge on kaadrisagedus, seda kiirem on simulatsioon. Te saate muuta ka akna suurust.</p>
</div>
<script>
main();
</script>
