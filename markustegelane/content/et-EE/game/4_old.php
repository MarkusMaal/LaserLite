	<h1>Crazygame</h1>
	<script>
		class Character {
			constructor(pos_x, pos_y, locked, direction, texture) {
				this.pos_x = pos_x;
				this.pos_y = pos_y;
				this.locked = locked;
				this.direction = direction;
				this.texture = texture;
				this.beenhere = false;
			}
			
			teleport(to) {
				for (var y = 0; y < lines; y++) {
					for (var x = 0; x < cols; x++) {
						if (map[y][x] == to) {
							this.pos_x = x;
							this.pos_y = y;
							sfx[5].play();
						}
					}
				}
			}
			
			remap() {
				if (map[this.pos_y][this.pos_x] != "*") {
					for (var y = 0; y < lines; y++) {
						for (var x = 0; x < cols; x++) {
							if (map[y][x] == "*") {
								map[y][x] = "_";
							}
						}
					}
				}
			}
		}
		var c_lvl = 0;
		var level = "";
		var levelpack = new Array();
		var cols = 12;
		var lines = 8;
		var block = 32;
		var onedone = false;
		var cc = 0;
		var sfx = [new Audio("images/shootme/move3.wav"), new Audio("images/shootme/coin.wav"), new Audio("images/shootme/box.wav"), new Audio("images/shootme/switch.wav"), new Audio("images/shootme/stuck.wav"), new Audio("images/shootme/teleport.wav"), new Audio("images/shootme/explosion.wav"), new Audio("images/shootme/help.wav")];
		/* direction:
		 * 0 - idle
		 *     1
		 *   2 3 4
		 */
		var map = new Array();
		
		var textures = new Array();
		var chrs = new Array();
		
		var chars;
		var c1;
		
		
		function PrepareTexture1() {
            var i = 0;
            
            var tcnv = document.createElement('canvas');
            tcnv.width = 256;
            tcnv.height = 256;

            // Get the drawing context
            var tctx = tcnv.getContext('2d');
            var temp = document.createElement("img");
            temp.onload = function() {
                imgToDataURL(this);
            };
            temp.src = "images/shootme/text2.png";
            
            tctx.drawImage(temp, 0, 0);
            for (var y = 0; y < 8; y++) {
                for (var x = 0; x < 8; x++) {
                    var im = document.createElement("img");
                    coords = [x, y];
                    let imageData = tctx.getImageData(coords[0] * 32, coords[1] * 32, coords[0] * 32 + 32, coords[1] * 32 + 32);
                    let canvas1 = document.createElement("canvas");
                    canvas1.width = 32;
                    canvas1.height = 32;
                    let ctx1 = canvas1.getContext("2d");
                    ctx1.rect(0, 0, 32, 32);
                    ctx1.fillStyle = 'white';
                    ctx1.fill();
                    ctx1.putImageData(imageData, 0, 0);
                    im.onload = function() {
                        imgToDataURL(this);
                    };
                    im.src = canvas1.toDataURL("image/png");
                    textures[i] = im;
                    i++;
                }
            }
            if (onedone) {
                document.getElementById("dsel").style = "display: block;";
                document.getElementById("loader").style = "display: none;";
            } else {
                onedone = true;
            }
		}
		
		function PrepareTexture2() {
            var i = 0;
            
            tcnv = document.createElement('canvas');
            tcnv.width = 256;
            tcnv.height = 256;

            // Get the drawing context
            var tctx = tcnv.getContext('2d');
            var temp = new Image();
            temp.onload = function() {
                imgToDataURL(this);
            };
            temp.src = "images/shootme/character.png";
            tctx.drawImage(temp, 0, 0);
            for (var x = 0; x < 4; x++) {
                var im = new Image();
                coords = [x, 0];
                let imageData = tctx.getImageData(coords[0] * 32, coords[1] * 32, coords[0] * 32 + 32, coords[1] * 32 + 32);
                let canvas1 = document.createElement("canvas");
                canvas1.width = 32;
                canvas1.height = 32;
                let ctx1 = canvas1.getContext("2d");
                ctx1.rect(0, 0, 32, 32);
                ctx1.fillStyle = 'white';
                ctx1.fill();
                ctx1.putImageData(imageData, 0, 0);
                im.onload = function() {
                    imgToDataURL(this);
                };
                im.src = canvas1.toDataURL("image/png");
                chrs[i] = im;
                i++;
            }
            
            c1 = new Character(1, 0, false, 0, chrs[0]);
            chars = [c1];
            if (onedone) {
                document.getElementById("dsel").style = "display: block;";
                document.getElementById("loader").style = "display: none;";
            } else {
                onedone = true;
            }
		}
		
		function LoadTexture(im, x, y) {
                return canvas1
		}
		
		function GetCoords(x) {
            var rx = x % 8;
            var ry = (x-rx) / 8;
            return [rx, ry]
		}
		
		
		function LoadLevel(contents, start_coords, dimensions) {
			chars = new Array();
			chars[0] = new Character(start_coords[0], start_coords[1], false, 0, chrs[0]);
			if (start_coords.length > 2) {
				chars[1] = new Character(start_coords[2], start_coords[3], false, 0, chrs[1]);
			}
			if (start_coords.length > 4) {
				chars[2] = new Character(start_coords[4], start_coords[5], false, 0, chrs[2]);
			}
			if (start_coords.length > 6) {
				chars[3] = new Character(start_coords[6], start_coords[7], false, 0, chrs[3]);
			}
			cols = dimensions[0];
			lines = dimensions[1];
			map = new Array();
			lns = new Array();
			
			var idx = 0;
			for (var x = 0; x < contents.length; x+=cols) {
				lns[idx] = contents.substring(x, x+cols);
				idx++;
			}
			
			for (var line = 0; line < lines; line+=1) {
				var ln = lns[line];
				map[line] = new Array();
				for (var i = 0; i < cols; i++) {
					map[line][i] = ln[i];
				}
			}
			newgame();
		}
		
		var game = {
			canvas : document.createElement("canvas"),
			init : function() {
				this.canvas = document.createElement("canvas");
				this.canvas.width = cols * block;
				this.canvas.height = lines * block;
                this.canvas.setAttribute("style", "width: <?php
                    if ($isMob) {
                        echo "100";
                    } else {
                        echo "40";
                    }
                ?>%; image-rendering: crisp-edges; image-rendering: pixelated;");
       			this.context = this.canvas.getContext("2d");
				var ctx = this.canvas.getContext("2d");
				var myPara = this.canvas;
				var mychild = document.getElementById("start");
				mychild.appendChild(myPara);
        		this.interval = setInterval(this.update, 16);
			},
			
			checkfinish : function() {
                for (var i = 0; i < chars.length; i++) {
                    if (map[chars[i].pos_y][chars[i].pos_x] == "F") {
                        game.finishit(i);
                    }
                }
			},
			
			finishit : function(id) {
                var win = true;
                for (var j = 0; j < lines; j++) {
                    if (map[j].includes("c")) {
                        win = false;
                    }
                }
                if (win) {
                    for( var j = 0; j < chars.length; j++)
                    {
                        if ( chars[j] === chars[id]) { 
                            chars.splice(j, 1); 
                        }
                    }
                    if (chars.length == 0)
                    {
                        game.next();
                    }
                }
			},
			update : function() {
				game.context.clearRect(0, 0, game.canvas.width, game.canvas.height);
				for (var i = 0; i < chars.length; i++) {
					if (chars[i].locked) {
						switch (map[chars[i].pos_y][chars[i].pos_x]) {
							case "c":
								sfx[1].play();
								map[chars[i].pos_y][chars[i].pos_x] = " ";
								break;
							case "^":
								chars[i].direction = 1;
								sfx[3].play();
								chars[i].remap();
								break;
							case "<":
								chars[i].direction = 2;
								sfx[3].play();
								chars[i].remap();
								break;
							case "H":
								chars[i].direction = 0;
								chars[i].locked = false;
								chars[i].teleport("F");
								break;
							case "E":
								chars[i].direction = 0;
								chars[i].locked = false;
								chars[i].teleport("G");
								break;
							case "C":
								chars[i].direction = 0;
								chars[i].locked = false;
								chars[i].teleport("D");
								break;
							case "A":
								chars[i].direction = 0;
								chars[i].locked = false;
								chars[i].teleport("B");
								break;
							case "V":
								chars[i].direction = 3;
								sfx[3].play();
								chars[i].remap();
								break;
							case "+":
                                sfx[6].play();
								alert("Game over: Stepped on death block!");
								document.getElementById("selector").style.display = "block";
								document.getElementById("leveldisp").innerHTML = "<span style=\"color: red;\">Game over</span>";
								chars[i].pos_x = -1;
								chars[i].pos_y = -1;
								chars[i].direction = 0;
								chars[i].locked = true;
								break;
							case ">":
								chars[i].direction = 4;
								sfx[3].play();
								chars[i].remap();
								break;
							case "_":
								if (!chars[i].beenhere) {
									chars[i].direction = 0;
									chars[i].locked = false;
									//map[chars[i].pos_y][chars[i].pos_x] = "*";
									sfx[4].play();
									chars[i].beenhere = true;
									break;
								} else { chars[i].beenhere = false; break; }
							case "b":
								var t_x = chars[i].pos_x;
								var t_y = chars[i].pos_y;
								sfx[2].play();
								switch (chars[i].direction) {
									case 1:
										t_y--;
										break;
									case 2:
										t_x--;
										break;
									case 3:
										t_y++;
										break;
									case 4:
										t_x++;
										break;
								}
								if (map[t_y][t_x] == " ") {
									map[chars[i].pos_y][chars[i].pos_x] = " ";
									map[t_y][t_x] = "b";
								} else {
									switch (chars[i].direction) {
										case 1:
											chars[i].pos_y += 1;
											break;
										case 2:
											chars[i].pos_x += 1;
											break;
										case 3:
											chars[i].pos_y -= 1;
											break;
										case 4:
											chars[i].pos_x -= 1;
											break;
									}
									chars[i].direction = 0;
									chars[i].locked = false;
									
								}
								break;
							case "F":
                                game.finishit(i);
								break;
						}
						var t_x = chars[i].pos_x;
						var t_y = chars[i].pos_y;
						switch (chars[i].direction) {
							case 1:
								t_y--;
								break;
							case 2:
								t_x--;
								break;
							case 3:
								t_y++;
								break;
							case 4:
								t_x++;
								break;
						}
						if (t_y < 0) {
							t_y = 0;
							chars[i].direction = 0;
							chars[i].locked = false;
						} else if (t_x < 0) {
							t_x = 0;
							chars[i].direction = 0;
							chars[i].locked = false;
						} else if (t_x > cols - 1) {
							t_x = cols - 1;
							chars[i].direction = 0;
							chars[i].locked = false;
						} else if (t_y > lines - 1) {
							t_y = lines - 1;
							chars[i].direction = 0;
							chars[i].locked = false;
						}
						if (map[t_y][t_x] != "#") {
							chars[i].pos_x = t_x;
							chars[i].pos_y = t_y;
						} else {
							chars[i].direction = 0;
							chars[i].locked = false;
							sfx[0].play();
						}
					} else {
						chars[i].remap();
					}
				}
				if (CheckCollide() == true) {
					alert("Game over: Two or more characters collided!");
					document.getElementById("selector").style.display = "block";
					document.getElementById("leveldisp").innerHTML = "<span style=\"color: red;\">Game over</span>";
					chars = new Array();
				}
				game.checkfinish();
				game.draw();
			},
			
			
			next : function() {
				c_lvl += 1;
				if (c_lvl == levelpack.length) {
					alert("Congratulations! You finished all levels in this level pack!");
					document.getElementById("selector").style.display = "block";
					document.getElementById("leveldisp").innerHTML = "You win!";
					return;
				}
				for (var i = 0; i < chars.length; i++) {
					chars[i].direction = 0;
					chars[i].locked = false;
				}
				document.getElementById("selector").style.display = "none";
				level = levelpack[c_lvl][0];
				document.getElementById("leveldisp").innerHTML = "Level " + String(c_lvl + 1) + "/" + String(levelpack.length);
				LoadLevel(level, levelpack[c_lvl][1], levelpack[c_lvl][2]);
			},
			
			draw : function() {
				/* värvib tausta */
				game.context.fillStyle = "#00baff";
				game.context.fillRect(0, 0, block * cols, block * lines);
				for (var y = 0; y < lines; y++) {
					for (var x = 0; x < cols; x++) {
						var real_x = x * block;
						var real_y = y * block;
						var type = map[y][x];
						var drect = true;
						switch (type) {
							case "#":
								game.context.fillStyle = "#088";
								break;
							case "F":
								game.context.drawImage(textures[6], real_x, real_y);
								drect = false;
								break;
							case "c":
								game.context.drawImage(textures[5], real_x, real_y);
								drect = false;
								break;
							case "_":
								game.context.drawImage(textures[8], real_x, real_y);
								drect = false;
								break;
							case "A":
								game.context.drawImage(textures[9], real_x, real_y);
								drect = false;
								break;
							case "C":
								game.context.drawImage(textures[9], real_x, real_y);
								drect = false;
								break;
							case "E":
								game.context.drawImage(textures[9], real_x, real_y);
								drect = false;
								break;
							case "H":
								game.context.drawImage(textures[9], real_x, real_y);
								drect = false;
								break;
							case "b":
							    game.context.drawImage(textures[0], real_x, real_y);
								drect = false;
								break;
							case "+":
								game.context.drawImage(textures[7], real_x, real_y);
								drect = false;
								break;
							case "<":
								game.context.drawImage(textures[1], real_x, real_y);
								drect = false;
								break;
							case "^":
								game.context.drawImage(textures[4], real_x, real_y);
								drect = false;
								break;
							case ">":
								game.context.drawImage(textures[3], real_x, real_y);
								drect = false;
								break;
							case "V":
								game.context.drawImage(textures[2], real_x, real_y);
								drect = false;
								break;
							default:
								drect = false
								break;
						}
						if (drect) {
							game.context.fillRect(real_x, real_y, block, block);
						}
					}
				}
				for (var i = 0; i < chars.length; i++) {
					game.context.drawImage(chars[i].texture, chars[i].pos_x * block, chars[i].pos_y * block);
				}
			}
		}
		
		function newgame() {
			document.getElementById("start").innerHTML = "";
			clearInterval(game.interval);
			game.init();
			document.addEventListener("keydown", keydown_handle(event));
			document.addEventListener("keyup", keyup_handle(event));
			//game.update();
		}
		LoadLevel(level, [1, 0], [12, 8]);
		function pausegame() {
			alert("dummy");
		}
		
		function CharactersFree() {
			var unlocked = true;
			for (var i = 0; i < chars.length; i++) {
				if (chars[i].locked) {
					unlocked = false;
				}
			}
			return unlocked;
		}
		
		function CheckCollide() {
			var collide = false;
			for (var i = 0; i < chars.length; i++) {
				for (var j = 0; j < chars.length; j++) {
					if (i != j) {
						if ((chars[j].pos_x == chars[i].pos_x) && (chars[j].pos_y == chars[i].pos_y)) {
							collide = true;
							sfx[7].play();
						}
					}
				}
			}
			return collide;
		}
		
		function LockChars() {
			for (var i = 0; i < chars.length; i++) {
				chars[i].locked = true;
			}
		}
		
		function SetDir(Dir) {
			LockChars();
			for (var i = 0; i < chars.length; i++) {
				chars[i].direction = Dir;
			}
		}
		
		function keydown_handle(e) {
			if (CharactersFree()) {
 				var x = e.keyCode;
				switch(x) {
					//vasem
					case 37:
						SetDir(2);
						break;
					case 38:
						SetDir(1);
						break;
					case 39:
						SetDir(4);
						break;
					case 40:
						SetDir(3);
						break;
					case 87:
						SetDir(1);
						break;
					case 65:
						SetDir(2);
						break;
					case 83:
						SetDir(3);
						break;
					case 68:
						SetDir(4);
						break;
					case 80:
						SetDir(1);
						break;
					case 69:
						SetDir(2);
						break;
					case 85:
						SetDir(3);
						break;
					case 73:
						SetDir(4);
						break;
					case 90:
						SetDir(1);
						break;
					case 81:
						SetDir(2);
						break;
				}
			}
		}
	
		function keyup_handle(event) {
			switch(event.keyCode) {
				//vasem
				case 27:
					pausegame();
					break;
			}
		}
		
		function LoadPack(pack) {
            c_lvl = -1;
            levelpack = pack;
            game.next();
		}
		
		function DevTest() {
            var data = document.getElementById("data").value;
            var dims = [Number(document.getElementById("width").value), Number(document.getElementById("height").value)];
            var starts = document.getElementById("starts").value.replace(" ", "").split(",");
            c_lvl = -1;
            levelpack = [[data, starts, dims]];
            game.next();
		}
		

	</script>
	<div id="start"></div>
	
	<div id="touchpad" style="float: right; position: fixed; right: 150px; bottom: 100px; visibility: <?php 
        if ($isMob) {
            echo "visible";
        } else {
            echo "hidden";
        }
	?>">
        <table>
            <tr>
                <td></td><td><a class="listitems" style="padding: 20px; margin: 10px; font-size: 40pt;" href="#/" onclick="SetDir(1);">&uarr;</a></td><td></td>
            <tr style="visibility: hidden;">
                <td><a class="listitems" style="padding: 20px; margin: 10px; font-size: 40pt;" href="#/">&larr;</a></td><td><a class="listitems" style="padding: 20px; margin: 10px; font-size: 40pt;" href="#/">&darr;</a></td><td><a class="listitems" style="padding: 20px; margin: 10px; font-size: 40pt;" href="#/">&rarr;</a></td>
            </tr>
            </tr>
        </table>
        <table>
            <tr>
                <td><a class="listitems" style="padding: 20px; margin: 10px; font-size: 40pt;" href="#/" onclick="SetDir(2);">&larr;</a></td><td><a class="listitems" style="padding: 20px; margin: 10px; font-size: 40pt;" href="#/" onclick="SetDir(3);">&darr;</a></td><td><a class="listitems" style="padding: 20px; margin: 10px; font-size: 40pt;" href="#/" onclick="SetDir(4);">&rarr;</a></td>
            </tr>
        </table>
	</div>
	<p id="leveldisp">Please select a level pack</p>
	<div id="selector">
        <div id="dsel" style="display: none;">
		<h1>Level packs</h1>
        <a href="#" onclick="LoadPack([['############# c  ##    ##  #c      ##   #c _<  ##      ^   ##    c   b ## c#  #  F #############', [6, 4, 8, 2, 3, 1, 1, 3], [12, 8]], ['#############     c   b## #      c ## b  #     ## ##   b   ####  #   # ##ccc  # c  ######F######', [1, 1, 1, 4], [12, 8]], ['#############c c   _  ### _c   c   ##c c >_c<  ##  _   c   ##  _   ^  c## _ _ c #F #############', [3, 6, 2, 6, 10, 6], [12, 8]], ['_ ###########  V  c   ### # #  c   ##_ >     V_##     >b_< ## #  #   # ##Fc>_<# c  #############', [0, 0, 9, 6], [12, 8]], ['# ########### ## # _< ###V> V# V  V##>^#>b  ^# ### # c   c ##   _###^ <##F #c # #c #############', [1, 0], [12, 8]], ['###########   c  _ ## #### # ##c  V   <##### ##  ##  _ _ c###F# # #  ###########', [1, 1, 5, 3, 6, 5, 3, 6], [10, 8]], ['####################  c     b    c   ##        _  _     <# ###  >     b    ##     c   < _     <# #c             c## b       #F_  b  <############_######', [2, 2, 5, 5], [19, 8]], ['################  c          ##     b  _  _ ## ###         ##    >c  ^ <_ ##     b       ##        #  _ ##   b c  c# _ ##    #        ##F b      _   ################', [1, 1], [15, 11]], ['#############  #c  # cF### #  b  V ##  >>  cb <##c## c  # ### # c## # ### c  # ^  <#############', [1, 1], [12, 8]]]);">For the beginners</a><br/>
        <a href="#" onclick="LoadPack([['#  B        +#F          ##_#         ##_#         ##_#         ##_*        A##_#          ', [10, 5], [13, 7]], ['##+++++++++++#+##c_F#          ##c_ _      H   ##c#_##         ## #_#          ## #_#          ## #            #### +           ', [13, 7], [16, 8]], ['#F+++++++++A##-++#++++++_##--B#++#+++_##+++-------_##+++-#+-+++_##+++----#--_##+++--#++++_##+++-++++++_##+++-++++++_##+++#++++++_#', [4, 8], [13, 10]], ['################F        ###### ############## ###+++  ###### ###+D+######## #E#+++######## #B############ #C#####C#A#### #######_#_####G#######_#_############   ##################', [10, 10], [15, 12]], ['################# ########### ###             F## # ######### ### # ######### ### # ######### ### # ######### ### # ######### ### # ######### ### #  ######## ### +#          ##### #########+##', [13, 10], [16, 12]], ['####################A#H#A#F#A#A#A#A#A## # # ### # # # # ## # # ### # # # # ## # # ### # # # # ## # # ### # # # # ## #B# ### # # # # ## # # ### # # # # ## # # ### # # # # ## # # ### # # # # ####################', [17, 9], [19, 11]]]);">Crazygame 1 levels</a><br/>
        <a href="#" onclick="LoadPack([['######################HcD ccc<F###C###A###### ####c###c## ##c#####c###c  _  c###+ c    +##########B#############', [8, 4, 10, 4], [16, 7]], ['################# _ _#  D cccAF### # c c c  #  ##  # # ## # c# ### ###   _  c# ## _   C_## #   ###B#############', [14, 5, 4, 2, 13, 2, 1, 3], [16, 7]], ['#A###########B##Ac#       <#V##A^< b     ^ <##Ac<  C       ##A##        D #####F##########', [9, 2, 9, 4], [15, 6]], ['+++++++ +++ +++ ++++++# F #   #   #   #  ++# c # c # c # c # c++   #  _#  _#  _#  #++  ^ <#^ <#  <#  <# ++++++++++++++++++++++', [19, 1, 15, 0, 16 ,1], [21, 6]]]);">Experimental</a><br/>
        
        More level packs coming soon!
        <?php if ($_COOKIE["cookie_ok"] == "dev") {
        echo '<h2>Development</h2>
        <p>Test custom level</p>
        <form autocomplete="off">
            <ul><li>Level data: <input style="width: 100%;" id="data" type="text"></input></li>
            <li>Dimensions: <input style="width: 40px;" id="width"></input><input style="width: 40px;" id="height"></input></li>
            <li>Start locations: <input id="starts"></input></input></li>
            </ul>
        </form>
        <a href="#/" onclick="DevTest();">Test level</a>';}?>
        <h2>How to play?</h2>
        <p>This is a puzzle game, where your goal is to collect all shiny coins and get all robots to the finish line.
        You control robots with a several sensrors attached to their legs. They can recieve a command to
        go, but they'll need to use their own sensors to stop. This usually means that they won't stop until hitting a wall (with certain exceptions).
        <p>To command Iems, you can use the following keys:</p>
        <ul>
            <li>&larr;&uarr;&darr;&rarr; (Arrow keys)</li>
            <li>WASD (QWERTY)</li>
            <li>ZQSD (AZERTY)</li>
            <li>PEUI (Dvorak)</li>
            <li><a href="#/" onclick="if (document.getElementById('touchpad').style.visibility == 'hidden') { document.getElementById('touchpad').style.visibility = 'visible';} else { document.getElementById('touchpad').style.visibility = 'hidden';}">Touch controls</a></li>
        </ul>
        Also, all Iems move at the same and can't hit each other. Iems look like this:</p>
        <img id="charactertextures" onload="PrepareTexture2();" src="images/shootme/character.png">
        <p>This game has special blocks, which affect how characters move. They are the following:</p>
        <ul>
            <li><span style="color: #00f;">Pointers</span> - These are blue arrows, which forcibly change the direction of a character it touches</li>
            <li><span style="color: #fa0;">Shiny coins</span> - You must collect all of these before you can finish the puzzle</li>
            <li><span style="color: #f4f;">Goo block</span> - Stops the character movement, allowing you to move in any direction</li>
            <li><span style="color: #930;">Box</span> - This is a movable block. If you touch it while moving, it moves as well and it stops moving when it hits any other block</li>
            <li>Finish - This is the block you must move all Iems to after collecting all coins</li>
            <li><span style="color: #90f;">Portal</span> - This moves the character into a designated spot</li>
            <li><span style="color: #f00;">Death block</span> - You cannot hit this block, because it'll explode when hit by a character, which causes the game to end</li>
        </ul>
        </div>
        <div id="loader" style="display: block;">
            <p>One second please...</p>
        </div>
	</div>
    <img id="normaltextures" onload="PrepareTexture1();" src="images/shootme/text2.png" style="display: none;">
