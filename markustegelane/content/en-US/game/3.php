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
    <script src="content/en-US/game/scripts/main.js"></script>
    <script src="content/en-US/game/scripts/game.js"></script>
    <script src="content/en-US/game/scripts/board.js"></script>
	<br>
    <div id="mai" style="margin-left: auto; margin-right:auto; width: 89%; float: none;">
    <h1>Game of life</h1>
    <h2 id="state">Drawing mode</h2>
   <p id="it_str">Press "Start simulation" to begin</p>
    <div id="sizesetup">
        <span style="margin-right: 10px;">Rectangle size:</span><input style="padding: 10px; border: none; font-size: 12pt; width: 25px;" value="5" id="res_w"></input><a href="#/" style="margin-left: 10px;" onclick="game.set_size()" class="listitems">Apply</a>
    </div>
    <div/>
    <div id="btn_parent" style="margin-top: 1%; margin-bottom: 1%;">
    <a href="#/" onclick="iterate()"  id="pause_resume" class="listitems">Start simulation</a>
    <a href="#/" onclick="iterate_one()" class="listitems">Next iteration</a>
    <a href="#/" onclick="reload_game()" class="listitems">New game</a>
    <a href="#/" onclick="inv_remove()" class="listitems" id="btype">Mode: Draw</a>
    </div>
    <div id="startbtn"/>
    </div>
    <div class="mainpage" style="padding-left: 0%; padding-right: 0%; margin-left: auto; margin-right:auto; width: 89%; float: none;">
<br/><br/>
    <h2>Personalization</h2>
    <h2>Advanced settings:</h2>
    <p>Framerate:</p>
    <div class="slidecontainer">
    <input style="width: 90%;" type="range" min="0" max="240" step="0.25" value="128" onchange="updateDelay(this.value)"><span id="fdly"> 9 fps</span>
    </div>
    <p>Window size:</p>
    <div class="slidecontainer">
    <input style="width: 90%;" type="range" min="0" max="100" step="0" value="50" onchange="updateSize(this.value)"><span id="wsize"> 50%</span>
    </div>
    <center>
        <table style="width: 100%">
            <tr>
                <td>
                <h2>Background:</h2>
                <p>Red:</p>
                <div class="slidecontainer">
                <input type="range" min="0" max="255" value="0" id="redCount" onchange="updateRed(this.value)"><span id="rstr"> 0</span>
                </div>
                <p>Green:</p>
                <div class="slidecontainer">
                <input type="range" min="0" max="255" value="0" id="greenCount" onchange="updateGreen(this.value)"><span id="gstr"> 0</span>
                </div>
                <p>Blue:</p>
                <div class="slidecontainer">
                <input type="range" min="0" max="255" value="0" id="blueCount" onchange="updateBlue(this.value)"><span id="bstr"> 0</span>
                </div>
                </td>
                <td>
                    <h2>Foreground:</h2>
                    <p>Red:</p>
                    <div class="slidecontainer">
                    <input type="range" min="0" max="255" value="255" id="redCount2" onchange="updateRed2(this.value)"><span id="rstr2"> 255</span>
                    </div>
                    <p>Green:</p>
                    <div class="slidecontainer">
                    <input type="range" min="0" max="255" value="255" id="greenCount2" onchange="updateGreen2(this.value)"><span id="gstr2"> 255</span>
                    </div>
                    <p>Blue:</p>
                    <div class="slidecontainer">
                    <input type="range" min="0" max="255" value="255" id="blueCount2" onchange="updateBlue2(this.value)"><span id="bstr2"> 255</span>
                    </div>
                </td>
            </tr>
        </table>
    </center>
<br/><br/>
    <h2>Instructions</h2>
    <h3 style="margin-top: 40px;">Symbols</h3>
    <ul>
    <li>Pixel with foreground color (default: white): Living cell</li>
    <li>Pixel with background color (default: black): Dead cell</li>
    </ul>
    <h3 style="margin-top: 40px;">Rules</h3>
    <p>This game is based on J. H. Conway's cellular automaton "Game of Life". It has 4 simple rules, which are as follows:</p>
    <ol>
    <li>Populated cell with less than two living neighbours will become unpopulated</li>
    <li>Populated cell with two or three living neighbours will stay populated</li>
    <li>Populated cell with more than three neighbours will become unpopulated</li>
    <li>Unpopulated cell with excactly three living neighbours will become populated</li>
    </ol>
    <a href="https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life">More info about the cellular automaton</a><br/>
     <span style="color: yellow;">Note:</span><i>This version has a specific difference compared to the original concept: game area is limited, which means that cells may get stuck near the bounds, otherwise this should be identical.</i>
    <h3 style="margin-top: 40px;">Drawing mode</h3>
    <p>The game initially starts in this mode. Holding down the left mouse button and dragging or clicking on a specific spot on the play area will populate cells. To delete populated cells, click on the "Mode: Draw", which activates the eraser. Press "Mode: Eraser" to go back to normal drawing mode. To clear the play area, click the "New game" button. To start the automaton, click "Start simulation", to move forward by one time unit, click on "Next iteration".</p>
    <h3 style="margin-top: 40px;">Life mode</h3>
    <p>If you see the text "Simulation is running..." and there is activity on the play area, the game has started. The player doesn't need to press any buttons anymore, only thing to do is to see how long your configuration lasts. To stop the simulation, click on "Pause simulation". To continue, click on "Continue simulation". The goal is to make a configuration that lasts as long as possible.</p>
    <h3 style="margin-top: 40px;">End of the game</h3>
    <p>The game will end with one of the following results:</p>
    <ul>
    <li>Entropy: All cells are dead, including the still ones</li>
    <li>No moving cells: All cells are dead, still ones are alive</li>
    <li>Frozen evolution: Only oscillators (and still cells) are alive</li>
    </ul>
    <p>In the end, you can see how long your configuration lasted. To start a new game, click on "New game".</p>
    <h3 style="margin-top: 40px;">Additional features</h3>
    <p>You can change the size of the cell, by clicking on the text field and typing a number. Than you can press "Apply" to apply the changes.</p>
    <p>You can also change colors. Using sliders below the game are, you can specify foreground and background colors in RGB system.
    (you can use <i><a href="https://google.com/search?q=color+picker">RGB color picker</a></i> for example to see all values needed for your desired color)</p>
    <p>In addition, it is possible to change the framerate. the higher the framerate, the faster simulation runs. You can also change the window size.</p>
</div>

<script>
main();
</script>
