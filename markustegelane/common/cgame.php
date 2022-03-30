
	<h1>Crazygame</h1>
	<script>
		class BgElement {
			constructor(pos_x, pos_y, dir, type, cls, size) {
				this.pos_x = pos_x;
				this.pos_y = pos_y;
				this.rgb = [Math.floor(Math.random() * 255), Math.floor(Math.random() * 255), Math.floor(Math.random() * 255)];
				this.dir = dir;
				this.increment = Math.floor(Math.random() * 4) + 1;
				this.type = type;
				this.class = cls;
				this.size = size;
			}
			
			next(bounds) {
				for (var u = 0; u < 3; u++) {
					this.rgb[u] += this.dir[u];
					if (this.rgb[u] > 255) {
						this.rgb[u] = 255;
						this.dir[u] = -1;
					} else if (this.rgb[u] < 0) {
						this.rgb[u] = 0;
						this.dir[u] = 1;
					}
				}
				if ((this.class == "circle") || (this.class == "gradient-circle")) {
					this.pos_x -= this.increment;
					if (this.pos_x < -this.size) {
						this.pos_x = bounds[0] + this.size;
					}
				}
			}
			
			Draw(ctx, multi, bs, bounds) {
				if (multi) {
					ctx.fillStyle = "rgb(" + (bs[0] * this.rgb[0]) + ", " + (bs[1] * this.rgb[1]) + ", " + (bs[2] * this.rgb[2]) + ")";
				} else {
					ctx.fillStyle = "rgb(" + (bs[0] * this.rgb[0]) + ", " + (bs[1] * this.rgb[0]) + ", " + (bs[2] * this.rgb[0]) + ")";
				}
				var gradient = ctx.createLinearGradient(0, 0, bounds[0], bounds[1]);
				gradient.addColorStop(0, "rgb(" + (bs[2] * this.rgb[2]) + ", " + (bs[1] * this.rgb[1]) + ", " + (bs[0] * this.rgb[0]) + ")");
				gradient.addColorStop(.5, "rgb(" + (bs[0] * this.rgb[0]) + ", " + (bs[1] * this.rgb[1]) + ", " + (bs[2] * this.rgb[2]) + ")");
				gradient.addColorStop(1, "rgb(" + (bs[0] * this.rgb[0]) + ", " + (bs[2] * this.rgb[2]) + ", " + (bs[1] * this.rgb[1]) + ")");
				switch (this.class) {
					case "rect":
						ctx.fillRect(this.pos_x, this.pos_y, this.size, this.size);
						break;
					case "circle":
						ctx.beginPath();
						ctx.arc(this.pos_x, this.pos_y, this.size / 2, 0, 2 * Math.PI);
						ctx.fill();
						break;
					case "gradient":
						ctx.fillStyle = gradient;
						ctx.fillRect(0, 0, bounds[0], bounds[1]);
						break;
					case "gradient-circle":
						ctx.fillStyle = gradient;
						ctx.beginPath();
						ctx.arc(this.pos_x, this.pos_y, this.size / 2, 0, 2 * Math.PI);
						ctx.fill();
						break;
					case "gradient-rect":
						ctx.fillStyle = gradient;
						ctx.fillRect(this.pos_x, this.pos_y, this.size, this.size);
						break;
					case "noise":
						ctx.fillStyle = "#fff";
						for (var i = 0; i < 4000; i++) {
							var pos_x = (Math.floor(Math.random() * (bounds[0] / 2)) * 2);
							var pos_y = (Math.floor(Math.random() * (bounds[1] / 2)) * 2);
							ctx.fillRect(pos_x, pos_y, 2, 2);
						}
						break;
					case "color-noise":
						for (var i = 0; i < 5000; i++) {
							ctx.fillStyle = "rgb(" + (Math.floor(Math.random() * 255)) + "," + (Math.floor(Math.random() * 255))+ "," + (Math.floor(Math.random() * 255)) + ")";
							var pos_x = (Math.floor(Math.random() * (bounds[0] / 2)) * 2);
							var pos_y = (Math.floor(Math.random() * (bounds[1] / 2)) * 2);
							ctx.fillRect(pos_x, pos_y, 2, 2);
						}
						break;
					case "bestagon":
						var x = this.pos_x;
						var y = this.pos_y;
						var w = this.size;
						ctx.beginPath();
						ctx.moveTo(x + w / 6, y);
						ctx.lineTo(x + (w / 6) * 5, y);
						ctx.lineTo(x + w, y + w / 2);
						ctx.lineTo(x + (w / 6) * 5, y + w);
						ctx.lineTo(x + w / 6, y + w);
						ctx.lineTo(x, y + w / 2);
						ctx.closePath();
						ctx.fill();
					case "diamond":
						var x = this.pos_x;
						var y = this.pos_y;
						var w = this.size;
						ctx.beginPath();
						ctx.moveTo(x + w / 2, y);
						ctx.lineTo(x, y + w / 2);
						ctx.lineTo(x + w / 2, y + w);
						ctx.lineTo(x + w, y + w / 2);
						ctx.closePath();
						ctx.fill();
				}
			}
			
			
		}
		class Character {
			constructor(pos_x, pos_y, locked, direction, texture) {
				this.pos_x = pos_x;
				this.pos_y = pos_y;
				this.locked = locked;
				this.direction = direction;
				this.texture = texture;
				this.beenhere = false;
				this.sub_x = 0;
				this.sub_y = 0;
			}
			
			teleport(to) {
				for (var y = 0; y < lines; y++) {
					for (var x = 0; x < cols; x++) {
						if (map[y][x] == to) {
							this.pos_x = x;
							this.pos_y = y;
							this.sub_x = 0;
							this.sub_y = 0;
							sfx[5].play();
						}
					}
				}
			}
			
			stop() {
				this.direction = 0;
				this.locked = false;
				this.sub_x = 0;
				this.sub_y = 0;
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
		var levelpack = [["    ", [0, 0], [2, 2]]];
		var cols = 12;
		var lines = 8;
		var add_x = 0;
		var add_y = 0;
		var block = 32;
		var packsel = 0;
		var sel = 0;
		var onedone = false;
		var fancy = true;
		var cc = 0;
		var editblock = 0;
		var dev = 0;
		var edit = [0, 0];
		var keylock = false;
		var offset;
		var bg = [];
		var sfx = [new Audio("images/shootme/move3.wav"), new Audio("images/shootme/coin.wav"), new Audio("images/shootme/box.wav"), new Audio("images/shootme/switch.wav"), new Audio("images/shootme/stuck.wav"), new Audio("images/shootme/teleport.wav"), new Audio("images/shootme/explosion.wav"), new Audio("images/shootme/help.wav"), new Audio("images/shootme/glass.wav"), new Audio("images/shootme/dbox.wav"), new Audio("images/shootme/ladder.wav")];
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
		
		
		function PrepareTexture(filename, lines, cols) {
            var i = 0;
            var lst = new Array();
            var tcnv = document.createElement('canvas');
            tcnv.width = 256;
            tcnv.height = 256;

            // Get the drawing context
            var tctx = tcnv.getContext('2d');
            var temp = document.createElement("img");
            temp.onload = function() {};
            temp.src = "images/shootme/" + filename;
            
            tctx.drawImage(temp, 0, 0);
            // texture mapping
            for (var y = 0; y < lines; y++) {
                for (var x = 0; x < cols; x++) {
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
                    im.onload = function() {};
                    im.src = canvas1.toDataURL("image/png");
                    lst[i] = im;
                    i++;
                }
            }
            if (onedone) {
                document.getElementById("dsel").style = "display: block;";
                document.getElementById("loader").style = "display: none;";
            } else {
                onedone = true;
            }
            return lst;
		}
				
		function LoadTextures(elements, characters) {
			textures = PrepareTexture(elements, 8, 8);
			chrs = PrepareTexture(characters, 0, 4);
		}
		
		
		function GetCoords(x) {
            var rx = x % 8;
            var ry = (x-rx) / 8;
            return [rx, ry]
		}
		
		function randomNumber(min, max) { 
			return Math.random() * (max - min) + min;
		} 
		function CreateBg(game) {
			bg = [];
			var size = 30;
			var rgb;
			let players = [];
			var coords = [];
			var bounds = [game.canvas.width, game.canvas.height];
			if (window.fullscreen) {
				bounds = [screen.width, screen.height];
			}
			var type = Math.floor(Math.random() * 8);
			var clss = ["rect", "circle", "gradient", "gradient-circle", "gradient-rect", "noise", "color-noise", "bestagon", "diamond"];
			var cls = clss[Math.floor(Math.random() * clss.length)];
			if (cls == "bestagon") {
				for (var y = 0; y < bounds[1]; y+=size) {
					for (var x = 0; x <= bounds[0]; x+=size * 2 - (size / 6) * 2) {
						if (Math.floor(Math.random() * 2) == 1) {
							coords.push([x, y]);
						}
						if (Math.floor(Math.random() * 2) == 1) {
							coords.push([x - 5 * (size / 6), y + size / 2]);
						}
						if (Math.floor(Math.random() * 2) == 1) {
							coords.push([x - 5 * (size / 6), y - size / 2]);
						}
					}
				}
			} else if (cls == "diamond") {
				for (var y = -size; y < bounds[1]; y+=size) {
					for (var x = -size; x <= bounds[0]; x+=size) {
						if (Math.floor(Math.random() * 2) == 1) {
							coords.push([x, y]);
						}
						if (Math.floor(Math.random() * 2) == 1) {
							coords.push([x + size / 2, y + size / 2]);
						}
					}
				}
			} else {
				for (var y = 0; y < bounds[1]; y+=size) {
					for (var x = 0; x < bounds[0]; x+=size) {
						if (Math.floor(Math.random() * 2) == 1) {
							coords.push([x, y]);
						}
					}
				}
			} 
			switch (cls) {
				case "circle":
					coords.forEach((coordinate) => bg.push(new BgElement(coordinate[0], coordinate[1], [1, 1, 1], type, cls, Math.floor(Math.random() * 40) + size)));
					break;
				case "gradient-circle":
					coords.forEach((coordinate) => bg.push(new BgElement(coordinate[0], coordinate[1], [1, 1, 1], type, cls, Math.floor(Math.random() * 40) + size)));
					break;
				case "rect":
					coords.forEach((coordinate) => bg.push(new BgElement(coordinate[0], coordinate[1], [1, 1, 1], type, cls, size)));
					break;
				case "gradient-rect":
					coords.forEach((coordinate) => bg.push(new BgElement(coordinate[0], coordinate[1], [1, 1, 1], type, cls, size)));
					break;
				case "bestagon":
					coords.forEach((coordinate) => bg.push(new BgElement(coordinate[0], coordinate[1], [1, 1, 1], type, cls, size)));
					break;
				case "diamond":
					coords.forEach((coordinate) => bg.push(new BgElement(coordinate[0], coordinate[1], [1, 1, 1], type, cls, size)));
					break;
				case "gradient":
					bg.push(new BgElement(0, 0, [1, 1, 1], type, cls, size));
					break;
				default:
					bg.push(new BgElement(0, 0, [1, 1, 1], type, cls, size));
					break;
			}
		}
		function DrawBg(bg, game) {
			var black = false;
			var size = 30;
			var bounds = [game.canvas.getBoundingClientRect().width, game.canvas.getBoundingClientRect().height];
			game.context.fillStyle = "#000";
			game.context.fillRect(0, 0, bounds[0], bounds[1]);
			var bs = [0, 0, 0];
			var multi = true;
			if ((bg == null) || (bg.length == 0)) {
				return;
			}
			switch (bg[0].type) {
				case 0:
					bs = [1, 0, 0];
					break;
				case 1:
					bs = [0, 1, 0];
					break;
				case 2:
					bs = [0, 0, 1];
					break;
				case 3:
					bs = [1, 0, 1];
					multi = false;
					break;
				case 4:
					bs = [1, 1, 0];
					multi = false;
					break;
				case 5:
					bs = [0, 1, 1];
					multi = false;
					break;
				case 6:
					bs = [1, 1, 1];
					break;
				case 7:
					bs = [1, 1, 1];
					multi = false;
					break;
			}
			for (var i = 0; i < bg.length; i++) {
				bg[i].Draw(game.context, multi, bs, bounds);
			}
			bg.forEach((back) => back.next(bounds));
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
				if (ln != null) {
					map[line] = new Array();
					for (var i = 0; i < cols; i++) {
						map[line][i] = ln[i];
					}
				}
			}
			newgame();
		}
		
		var game = {
			canvas : document.createElement("canvas"),
			init : function() {
				this.canvas = document.createElement("canvas");
				this.canvas.width = 300;
				this.canvas.height = 256;
				this.canvas.setAttribute("onclick", "game.chcam();");
                this.canvas.setAttribute("style", "width: <?php
                    if ($isMob) {
                        echo "100";
                    } else {
                        echo "40";
                    }
                ?>%; image-rendering: crisp-edges; image-rendering: pixelated;");
       			this.context = this.canvas.getContext("2d");
				this.context.font = '25px Arial';
				var ctx = this.canvas.getContext("2d");
				var myPara = this.canvas;
				if (document.getElementById("start") != null) {
					document.getElementById("start").innerHTML = "";
					var mychild = document.getElementById("start");
					mychild.appendChild(myPara);
					this.interval = setInterval(this.update, 16);
				}
			},
			
			chcam : function() {
				sel++;
				if (sel > chars.length - 1) {
					if (dev > 6) {
						sel = -6;
					} else {
						sel = -1;
					}
				}
				while (sel > chars.length - 1) {
					sel--;
				}
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
				if((window.fullScreen) ||
				(window.innerWidth == screen.width && window.innerHeight == screen.height)) {
					game.canvas.style = "position: fixed; z-index: 999; top: 0px; left:0px; width: " + screen.width + "px; height: " + screen.height + "px; image-rendering: crisp-edges; image-rendering: pixelated;";
					document.getElementById("exitfs").style.display = "block";
					game.canvas.width = screen.width / 2;
					game.canvas.height = screen.height / 2;
				} else {
					game.canvas.style = "position: block; width: 40%; image-rendering: crisp-edges; image-rendering: pixelated;";
					document.getElementById("exitfs").style.display = "none";
					game.canvas.width = 300;
					game.canvas.height = 256;
				}
				
				if (bg.length == 0) { CreateBg(game); }
				game.context.clearRect(0, 0, game.canvas.width, game.canvas.height);
				for (var i = 0; i < chars.length; i++) {
					if (chars[i].locked) {
						switch (map[chars[i].pos_y][chars[i].pos_x]) {
							case "c":
								sfx[1].play();
								map[chars[i].pos_y][chars[i].pos_x] = " ";
								cc++;
								break;
							case "-":
								alert("<?php echo ms('Mäng läbi: Kukkusite auku', 'Game over: Fell into hole'); ?>!");
								document.getElementById("selector").style.display = "block";
								document.getElementById("leveldisp").innerHTML = "<span style=\"color: red;\"><?php echo ms('Mäng läbi', 'Game over'); ?></span>";
								chars = []
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
								alert("<?php echo ms('Mäng läbi: Astusite tuleblokile', 'Game over: Stepped on death block'); ?>");
								document.getElementById("selector").style.display = "block";
								document.getElementById("leveldisp").innerHTML = "<span style=\"color: red;\"><?php echo ms('Mäng läbi', 'Game over'); ?></span>";
								chars = []
								break;
							case ">":
								chars[i].direction = 4;
								sfx[3].play();
								chars[i].remap();
								break;
							case "_":
								if ((!chars[i].beenhere) && (chars[i].sub_x == 0) && (chars[i].sub_y == 0)) {
									chars[i].direction = 0;
									chars[i].locked = false;
									//map[chars[i].pos_y][chars[i].pos_x] = "*";
									sfx[4].play();
									chars[i].beenhere = true;
									break;
								} else { chars[i].beenhere = false; break; }
							case "f":
								chars.splice(i, 1);
								sfx[5].play();
								if (chars.length == 0) {
									var hascoin = false;
									for (var y = 0; y < lines; y++) {
										for (var x = 0; x < cols; x++) {
											if (map[y][x] == "c") {
												hascoin = true;
											}
										}
									}
									if (hascoin) {
										alert("Game over: You didn't collect all coins");
									} else {
										game.next();
									}
								}
								break;
							case "x":
								if ((chars[i].sub_x == 0) && (chars[i].sub_y == 0)) {
									sfx[3].play();
									switch (chars[i].direction) {
										case 1:
											chars[i].direction = 3;
											break;
										case 2:
											chars[i].direction = 4;
											break;
										case 3:
											chars[i].direction = 1;
											break;
										case 4:
											chars[i].direction = 2;
											break;
									}
								}
								break;
							case "g":
								sfx[8].play();
								var t_x = chars[i].pos_x;
								var t_y = chars[i].pos_y;
								switch (chars[i].direction) {
									case 1:
										t_y++;
										break;
									case 2:
										t_x++;
										break;
									case 3:
										t_y--;
										break;
									case 4:
										t_x--;
										break;
								}
								map[chars[i].pos_y][chars[i].pos_x] = " ";
								chars[i].pos_x = t_x;
								chars[i].pos_y = t_y;
								chars[i].direction = 0;
								chars[i].locked = false;
								break;
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
								if (t_x < 0) { t_x = 0; }
								else if (t_x >= cols) { t_x = cols - 1; }
								if (t_y < 0) { t_y = 0; }
								else if (t_y >= lines) { t_y = lines - 1; }
								if ((map[t_y][t_x] == " ")) {
									map[chars[i].pos_y][chars[i].pos_x] = " ";
									map[t_y][t_x] = "b";
								} else if (map[t_y][t_x] == "f") {
									map[chars[i].pos_y][chars[i].pos_x] = " ";
									chars[i].stop();
								} else if (map[t_y][t_x] == "g") {
									map[t_y][t_x] = " ";
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
									chars[i].stop();
								} else if (map[t_y][t_x] == "-") {
									sfx[9].play();
									map[chars[i].pos_y][chars[i].pos_x] = " ";
									map[t_y][t_x] = ".";
									chars[i].stop();
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
									chars[i].stop();
									
								}
								break;
							case "F":
                                game.finishit(i);
								break;
						}
						var ts_x = chars[i].sub_x;
						var ts_y = chars[i].sub_y;
						switch (chars[i].direction) {
							case 1:
								ts_y -= 0.3;
								break;
							case 2:
								ts_x -= 0.3;
								break;
							case 3:
								ts_y += 0.3;
								break;
							case 4:
								ts_x += 0.3;
								break;
						}
						chars[i].sub_x += ts_x;
						chars[i].sub_y += ts_y;
						if ((chars[i].sub_x >= 0.7) || (chars[i].sub_x <= -0.7) || (chars[i].sub_y >= 0.7) || (chars[i].sub_y <= -0.7)) {
							chars[i].sub_x = 0;
							chars[i].sub_y = 0;
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
								chars[i].stop();
							} else if (t_x < 0) {
								t_x = 0;
								chars[i].stop();
							} else if (t_x > cols - 1) {
								t_x = cols - 1;
								chars[i].stop();
							} else if (t_y > lines - 1) {
								t_y = lines - 1;
								chars[i].stop();
							}
							if (map[t_y][t_x] != "#") {
								if ((map[t_y][t_x] == "h") && (chars[i].direction % 2 == 0)) {
									sfx[10].play();
									chars[i].stop();
								} else {
									chars[i].pos_x = t_x;
									chars[i].pos_y = t_y;
									chars[i].sub_x = 0;
									chars[i].sub_y = 0;
								}
							} else {
								chars[i].direction = 0;
								chars[i].locked = false;
								sfx[0].play();
							}
						}
					} else {
						chars[i].remap();
					}
				}
				if (CheckCollide() == true) {
					alert("<?php echo ms('Mäng läbi: Vähemalt kaks tegelast põrkusid kokku', 'Game over: Two or more characters collided'); ?>");
					document.getElementById("selector").style.display = "block";
					document.getElementById("leveldisp").innerHTML = "<span style=\"color: red;\"><?php echo ms('Mäng läbi', 'Game over'); ?></span>";
					chars = new Array();
				}
				game.checkfinish();
				game.draw();
			},
			
			
			next : function() {
				bg = [];
				if (keylock) {
					c_lvl += 1;
					return;
				}
				c_lvl += 1;
				if (c_lvl == levelpack.length) {
					alert("<?php echo ms('Õnnitleme! Lõpetasite kõik tasandid selles tasandipakis!', 'Congratulations! You finished all levels in this level pack!'); ?>");
					document.getElementById("selector").style.display = "block";
					document.getElementById("leveldisp").innerHTML = "<?php echo ms('Te võitsite', 'You win'); ?>!";
					return;
				}
				for (var i = 0; i < chars.length; i++) {
					chars[i].direction = 0;
					chars[i].locked = false;
				}
				document.getElementById("selector").style.display = "none";
				level = levelpack[c_lvl][0];
				keylock = true;
				document.getElementById("leveldisp").innerHTML = "<?php echo ms('Tasand', 'Level'); ?> " + String(c_lvl + 1) + "/" + String(levelpack.length);
				LoadLevel(level, levelpack[c_lvl][1], levelpack[c_lvl][2]);
				sel = 0;
				document.getElementById("igc").style.display = "block";
				document.getElementById("devoption").style.display = "none";
			},
			PlaceSpecific : function(placable) {
				map[edit[1]][edit[0]] = placable;
				SaveLevel(false);
			},
			PlaceBlock : function() {
				var placable = "";
				switch (editblock) {
					case 0:
						placable = "b";
						break;
					case 1:
						placable = "<";
						break;
					case 2:
						placable = "V";
						break;
					case 3:
						placable = ">";
						break;
					case 4:
						placable = "^";
						break;
					case 5:
						placable = "c";
						break;
					case 6:
						placable = "F";
						break;
					case 7:
						placable = "+";
						break;
					case 8:
						placable = "_";
						break;
					case 9:
						placable = "#";
						break;
					case 10:
						placable = "-";
						break;
					case 11:
						placable = ".";
						break;
					case 12:
						placable = "g";
						break;
					case 13:
						placable = "f";
						break;
					case 14:
						placable = "h";
						break;
					case 15:
						placable = "x";
						break;
				}
				if (sel == -2) {
					map[edit[1]][edit[0]] = placable;
				}
			},
			check_char : function(id, x, y) {
				if (chars.length > id) {
					if ((chars[id].pos_x == x / 8) && (chars[id].pos_y == y / 8)) {
						return true;
					}
				}
				return false;
			},
			picker : function() {
				blockdata = map[edit[1]][edit[0]];
				switch (blockdata) {
					case "b":
						editblock = 0;
						break;
					case "<":
						editblock = 1;
						break;
					case "V":
						editblock = 2;
						break;
					case ">":
						editblock = 3;
						break;
					case "^":
						editblock = 4;
						break;
					case "c":
						editblock = 5;
						break;
					case "F":
						editblock = 6;
						break;
					case "+":
						editblock = 7;
						break;
					case "_":
						editblock = 8;
						break;
					case "#":
						editblock = 9;
						break;
					case "-":
						editblock = 10;
						break;
					case ".":
						editblock = 11;
						break;
					case "g":
						editblock = 12;
						break;
					case "f":
						editblock = 13;
						break;
					case "h":
						editblock = 14;
						break;
					case "x":
						editblock = 15;
						break;
					default:
						alert("This block cannot be picked up using the block picker");
						break;
				}
			},
			draw : function() {
				var width = Math.floor(game.canvas.width / block) * block;
				var height = Math.floor(game.canvas.height / block) * block;
				/* värvib tausta */
				if (fancy) { DrawBg(bg, game); } else {
					game.context.fillStyle = "#1496ff";
					game.context.fillRect(0, 0, game.canvas.width, game.canvas.height);
				}
				keylock = false;
				if (sel == -6) {
					return;
				}
				if (sel == -5) {
					game.context.fillStyle = "#abf";
					if (!fancy) { game.context.fillRect(0, 0, width, height);}
					game.disp_osd(sel, width, height);
					return;
				}
				else if (sel == -4) {
					game.context.fillStyle = "#009a9f";
					if (!fancy) { game.context.fillRect(0, 0, width, height);}
					for (var y = 0; y < (lines + add_y) * 8; y+=8) {
						for (var x = 0; x < (cols + add_x) * 8; x+=8) {
							game.context.fillStyle = "#fff";
							if ((add_y < 0) || (add_x < 0)) { game.context.fillStyle = "#f00"; }
							if ((lines * 8 < y + 1) || (cols * 8 < x + 1)) { game.context.fillStyle = "#f0f"; }
							if (game.check_char(0, x, y)) { game.context.fillStyle = "#0ff"; }
							else if (game.check_char(1, x, y)) { game.context.fillStyle = "#0f0"; }
							else if (game.check_char(2, x, y)) { game.context.fillStyle = "#00f"; }
							else if (game.check_char(3, x, y)) { game.context.fillStyle = "#ff0"; }
							game.context.fillRect(x, y, 4, 4);
						}
					}
					game.disp_osd(sel, width, height);
					return;
				}
				while (sel > chars.length - 1) { sel--;	}
				if (sel > -1) {
					offset = [(chars[sel].pos_x + chars[sel].sub_x) * block - (width) / 2 + (block / 2), (chars[sel].sub_y + chars[sel].pos_y) * block - (height) / 2 + (block / 2)];
				}
				for (var y = 0; y < lines; y++) {
					for (var x = 0; x < cols; x++) {
						var real_x = x * block - offset[0];
						var real_y = y * block - offset[1];
						var type = map[y][x];
						var drect = true;
						if ((bg.length == 1) || (!fancy)) { game.context.drawImage(textures[10], real_x, real_y); }
						
						game.context.font = "25px Arial";
						switch (type) {
							case " ":
								drect = false;
								break;
							case "#":
								game.context.drawImage(textures[11], real_x, real_y);
								drect = false;
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
								if (sel < -1) {
									game.context.fillStyle = 'red';
									game.context.fillText("A", real_x + 8, real_y + 24);
								}
								break;
							case "B":
								if (sel < -1) {
									game.context.fillStyle = 'red';
								} else {
									drect = false;
								}
								break;
							case "C":
								game.context.drawImage(textures[9], real_x, real_y);
								drect = false;
								if (sel < -1) {
									game.context.fillStyle = 'lime';
									game.context.fillText("C", real_x + 8, real_y + 24);
								}
								break;
							case "D":
								if (sel < -1) {
									game.context.fillStyle = 'lime';
								} else {
									drect = false;
								}
								break;
							case "E":
								game.context.drawImage(textures[9], real_x, real_y);
								drect = false;
								if (sel < -1) {
									game.context.fillStyle = 'blue';
									game.context.fillText("E", real_x + 8, real_y + 24);
								}
								break;
							case "G":
								if (sel < -1) {
									game.context.fillStyle = 'blue';
								} else {
									drect = false;
								}
								break;
							case "H":
								game.context.drawImage(textures[9], real_x, real_y);
								drect = false;
								if (sel == -2) {
									game.context.fillStyle = 'aqua';
									game.context.fillText("F", real_x + 8, real_y + 24);
								}
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
							case "-":
								game.context.drawImage(textures[12], real_x, real_y);
								drect = false;
								break;
							case ".":
								game.context.drawImage(textures[13], real_x, real_y);
								drect = false;
								break;
							case "g":
								game.context.drawImage(textures[14], real_x, real_y);
								drect = false;
								break;
							case "f":
								game.context.drawImage(textures[15], real_x, real_y);
								drect = false;
								break;
							case "h":
								game.context.drawImage(textures[16], real_x, real_y);
								drect = false;
								break;
							case "x":
								game.context.drawImage(textures[17], real_x, real_y);
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
				game.disp_osd(sel, width, height);
				for (var i = 0; i < chars.length; i++) {
					game.context.drawImage(chars[i].texture, (chars[i].pos_x + chars[i].sub_x) * block - offset[0], (chars[i].pos_y + chars[i].sub_y) * block - offset[1]);
				}
				if (sel == -2) {
					if (editblock > 9) {
						game.context.drawImage(textures[editblock+2], Math.floor((width / 2) / block) * block + 6, Math.floor((height / 2) / block) * block - (block / 2));
					} else if (editblock != 9) {
						game.context.drawImage(textures[editblock], Math.floor((width / 2) / block) * block + 6, Math.floor((height / 2) / block) * block - (block / 2));
					} else {
						game.context.drawImage(textures[11], Math.floor(width / 2 / block) * block + 6, Math.floor((height / 2) / block) * block - (block / 2));
					}
				}
			},
			disp_osd : function(sel, width, height) {
				if (sel >= 0) {
					game.context.fillStyle = "#000";
					for (var i = 0; i < 2; i++) {
						if (i == 1) {
							game.context.fillStyle = "#fff";
						}
						game.context.font = '12px Segoe UI Semibold';
						game.context.fillText("<?php echo ms('Kaamera', 'Camera'); ?> " + (sel + 1) + "/" + chars.length, 10 - i, 20 - i);
						game.context.font = '20px Segoe UI Semibold';
						game.context.fillText("<?php echo ms('Tasand', 'Level'); ?> " + (c_lvl + 1) + "/" + levelpack.length, 10 - i, height - 30 - i);
						game.context.font = '12px Segoe UI Semibold';
						var coinleft = 0;
						for (var y = 0; y < map.length; y++) {
							for (var x = 0; x < map[y].length; x++) {
								if (map[y][x] == "c") {
									coinleft++;	
								}
							}
						}
						if (coinleft > 0) {
							game.context.fillText(coinleft + " <?php echo ms('allesolevat münti', 'coins remaining'); ?>", 10 - i, height - 15 - i);
						} else {
							game.context.fillText("<?php echo ms('Liikuge finišisse', 'Finish now'); ?>!", 10 - i, height - 15 - i);
						}
					}
				} else {
					switch (sel) {
						case -1:
							game.context.fillStyle = "#000";
							for (var i = 0; i < 2; i++) {
								if (i == 1) {
									game.context.fillStyle = "#fff";
								}
								game.context.font = '12px Segoe UI Semibold';
								if (chars.length > 0) {
									game.context.fillText("<?php echo ms('Vaba kaamera', 'Free camera'); ?>", 10 - i, 20 - i);
								} else {
									if (c_lvl >= levelpack.length) {
										game.context.fillText("<?php echo ms('Te võitsite', 'You win'); ?>", 10 - i, 20 - i);
									} else {
										game.context.fillText("<?php echo ms('Mäng läbi', 'Game over'); ?>", 10 - i, 20 - i);
									}
								}
							}
							break;
						case -2:
							game.context.fillStyle = "#000";
							for (var i = 0; i < 2; i++) {
								if (i == 1) {
									game.context.fillStyle = "#fff";
								}
								game.context.font = '12px Segoe UI Semibold';
								game.context.fillText("<?php echo ms('Tasandiredigeerija', 'Level Editor'); ?>", 10 - i, 20 - i);
								game.context.fillText("<?php echo ms('Saadavalolevad blokid', 'Block selection'); ?>:", 1 - i, height - 20 - i);
							}
							for (var i = 0; i < 16; i++) {
								if (i > 8) {
									game.context.drawImage(textures[i + 2], i * 16,  height - 16, 16, 16);
								} else {
									game.context.drawImage(textures[i], i * 16,  height - 16, 16, 16);
								}
								if (editblock == i) {
									if (Math.floor(Math.random() * 2) == 1) {
										game.context.fillStyle = "#000";
									}
									game.context.fillRect(i * 16, height - 2, 16, 2);
								}
							}
							break;
						case -3:
							game.context.fillStyle = "#000";
							var charstarts = "";
							for (var i = 0; i < chars.length; i++) {
								if (chars.length - 1 == i) {
									charstarts += chars[i].pos_x + "," + chars[i].pos_y;
								} else if (chars.length > i) {
									charstarts += chars[i].pos_x + "," + chars[i].pos_y + ",";
								}
							}
							var level = "";
							for (var y = 0; y < lines; y++) {
								for (var x = 0; x < cols; x++) {
									level = level + map[y][x];
								}
							}
							for (var i = 0; i < 2; i++) {
								if (i == 1) {
									game.context.fillStyle = "#fff";
								}
								game.context.font = '12px Segoe UI Semibold';
								game.context.fillText("<?php echo ms('Arendamine', 'Development'); ?>", 10 - i, 20 - i);
								game.context.fillText("<?php echo ms('Tasandi andmed', 'Level data'); ?>:" + level, 10 - i, 40 - i);
								game.context.fillText("<?php echo ms('Tekkekohad', 'Spawn locations'); ?>: [" + charstarts + "]", 10 - i, 50 - i);
								game.context.fillText("<?php echo ms('Väljaku suurus', 'Map size'); ?>: [" + cols + ", " + lines + "]", 10 - i, 60 - i);
								game.context.fillText("<?php echo ms('Tasandi andmed väljutati allolevasse tekstivälja', 'Level data outputted below'); ?>", 10 - i, 80 - i);
								document.getElementById("data").value = level;
								document.getElementById("width").value = cols;
								document.getElementById("height").value = lines;
								document.getElementById("starts").value = charstarts;
							}
							break;
						case -4:
							game.context.fillStyle = "#000";
							for (var i = 0; i < 2; i++) {
								if (i == 1) {
									game.context.fillStyle = "#fff";
								}
								game.context.font = '12px Segoe UI Semibold';
								game.context.fillText("<?php echo ms('Väljaku suurus', 'Map size'); ?> (" + (cols + add_x) + "x" + (lines + add_y) + ")", 10 - i, height - 20 - i);
							}
							break;
						case -5:
							game.context.fillStyle = '#000';
							game.context.font = '12px Segoe UI Semibold';
							for (var i = 0; i < 2; i++) {
								if (i == 1) {
									game.context.fillStyle = "#fff";
								}
								game.context.fillText("<?php echo ms('Tasandi valik', 'Level select'); ?>", 10 - i, 20 - i);
								game.context.fillText("<?php echo ms('Tasand', 'Level'); ?> " + (packsel + 1), 10 - i, 50 - i);
								var exist = "<?php echo ms('ei', 'no'); ?>";
								if (packsel < levelpack.length) { exist = "<?php echo ms('jah', 'yes'); ?>"; }
								game.context.fillText("<?php echo ms('Eksisteerib', 'Exists'); ?>: " + exist, 10 - i, 70 - i);
							}
					}
				}
				
			}
		}
		
		CreateBg(game);
		function newgame() {
			//document.getElementById("start").innerHTML = "";
			clearInterval(game.interval);
			game.init();
			document.addEventListener("keydown", keydown_handle(event));
			document.addEventListener("keyup", keyup_handle(event));
			bg = [];
			//game.update();
		}
		LoadLevel(level, [1, 0], [12, 8]);
		
		document.addEventListener('copy', function(e) {
		  e.clipboardData.setData('text/plain', "['" + level + "'");
		  e.preventDefault();
		});
		
		function ResizeMap() {
			var nlines = lines + add_y;
			var ncols = cols + add_x;
			for (var y = 0; y < lines; y++) {
				if (map[y].length < ncols) {
					while (map[y].length < ncols) {
						map[y].push(" ");
					}
				} else if (map[y].length > ncols) {
					while (map[y].length > ncols) {
						map[y].splice(-1,1);
					}
				}
			}
			if (nlines > map.length) {
				while (nlines > map.length) {
					var a = new Array();
					for (var i = 0; i < ncols; i++) {
						a[i] = " ";
					}
					map.push(a);
				}
			} else if (nlines < map.length) {
				map.splice(-1,1);
			}
			cols = ncols;
			lines = nlines;
			add_x = 0;
			add_y = 0;
			SaveLevel(false);
		}
		
		function SaveLevel(savepos) {
			var a;
			var b;
			var c;
			level = "";
			for (var y = 0; y < lines; y++) {
				for (var x = 0; x < cols; x++) {
					level = level + map[y][x];
				}
			}
			c = [map[0].length, map.length];
			var spawns = [];
			for (var i = 0; i < chars.length; i++) {
				spawns.push(chars[i].pos_x);
				spawns.push(chars[i].pos_y);
			}
			if (savepos) {
				b = spawns;
			} else {
				b = levelpack[c_lvl][1];
			}
			a = level;
			if (levelpack.length < c_lvl + 1) {
				levelpack.push([a, b, c]);
			} else {
				levelpack[c_lvl][0] = a;
				levelpack[c_lvl][1] = b;
				levelpack[c_lvl][2] = c;
			}
		}
		
		function pausegame() {
			
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
			if (sel > -1) {
				LockChars();
				for (var i = 0; i < chars.length; i++) {
					chars[i].direction = Dir;
					if (map[chars[i].pos_y][chars[i].pos_x] == "h") {
						if (Dir % 2 == 0) {
							chars[i].stop();
						}
					}
				}
			} else {
				if (sel == -5) {
						switch (Dir) {
							case 2:
								packsel--;
								break;
							case 4:
								packsel++;
								break;
						}
						return;
				}
				switch (Dir) {
					case 1:
						offset = [offset[0], offset[1] - 32];
						if (sel == -4) { add_y -= 1; }
						edit = [edit[0], edit[1] - 1];
						break;
					case 2:
						offset = [offset[0] - 32, offset[1]];
						if (sel == -4) { add_x -= 1; }
						edit = [edit[0] - 1, edit[1]];
						break;
					case 3:
						offset = [offset[0], offset[1] + 32];
						if (sel == -4) { add_y += 1; }
						edit = [edit[0], edit[1] + 1];
						break;
					case 4:
						offset = [offset[0] + 32, offset[1]];
						if (sel == -4) { add_x += 1; }
						edit = [edit[0] + 1, edit[1]];
						break;
				}
			}
		}
		function ExitFs() {
			if (document.exitFullscreen) {
            document.exitFullscreen();
			} else if (document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
		function replaceAll(string, search, replace) {
		  return string.split(search).join(replace);
		}
		function keydown_handle(e) {
			if ((CharactersFree()) && (e != null)) {
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
					case 48:
						document.getElementById("igc").style.display = "block";
						document.getElementById("devoption").style.display = "none";
						offset = [0, 0];
						document.getElementById("leveldisp").innerHTML = "Free camera";
						sel = -1;
						break;
					case 82:
						document.getElementById("igc").style.display = "block";
						document.getElementById("devoption").style.display = "none";
						c_lvl -= 1;
						sel = 0;
						game.next();
					case 49:
						document.getElementById("igc").style.display = "block";
						document.getElementById("devoption").style.display = "none";
						document.getElementById("leveldisp").innerHTML = "<?php echo ms('Tasand', 'Level'); ?> " + String(c_lvl + 1) + "/" + levelpack.length;
						sel = 0;
						break;
					case 50:
						document.getElementById("igc").style.display = "block";
						document.getElementById("devoption").style.display = "none";
						if (chars.length > 1) {
							document.getElementById("leveldisp").innerHTML = "<?php echo ms('Tasand', 'Level'); ?> " + String(c_lvl + 1) + "/" + levelpack.length;
							sel = 1;
						}
						break;
					case 51:
						document.getElementById("igc").style.display = "block";
						document.getElementById("devoption").style.display = "none";
						if (chars.length > 2) {
							document.getElementById("leveldisp").innerHTML = "<?php echo ms('Tasand', 'Level'); ?> " + String(c_lvl + 1) + "/" + levelpack.length;
							sel = 2;
						}
						break;
					case 52:
						document.getElementById("igc").style.display = "block";
						document.getElementById("devoption").style.display = "none";
						if (chars.length > 3) {
							document.getElementById("leveldisp").innerHTML = "<?php echo ms('Tasand', 'Level'); ?> " + String(c_lvl + 1) + "/" + levelpack.length;
							sel = 3;
						}
						break;
					case 55:
						if (dev > 6) {
							document.getElementById("leveldisp").innerHTML = "<?php echo ms('Väljaku suurus', 'Map size'); ?>";
							add_x = 0;
							game.context.font = '15px Arial';
							add_y = 0;
							sel = -4;
							document.getElementById("igc").style.display = "none";
							document.getElementById("devoption").style.display = "none";
						}
						break;
					case 17:
						dev++;
						if (dev == 7) {
							document.getElementById("dtest").style.display = "block";
							alert("<?php echo ms('Arendaja valikud sisse lülitatud', 'Developer options enabled'); ?>\n<?php echo ms('Kasutage neid valikuid vastutustundlikult', 'Please use these options responsibly'); ?> ;)");
						}
					case 13:
						if (sel == -6) {
							bg = [];
							CreateBg(game);
						} else if (sel == -4) {
							ResizeMap();
						} else if (sel == -2) {
							game.picker();
						} else if (sel == -5) {
							if (packsel < levelpack.length) {
								c_lvl = packsel - 1;
								game.next();
							} else {
								levelpack.push(["    ", [0,0], [2, 2]]);
								c_lvl = levelpack.length - 2;
								document.getElementById("leveldisp").innerHTML = "<?php echo ms('Väljaku suurus', 'Map size'); ?>";
								add_x = 0;
								game.context.font = '15px Arial';
								add_y = 0;
								document.getElementById("igc").style.display = "none";
								document.getElementById("devoption").style.display = "none";
								sel = -4;
								game.next();
							}
						}
						break;
					case 89:
						if (dev > 6) {
							var charstarts = [];
							for (var i = 0; i < chars.length; i++) {
								charstarts.push(chars[i].pos_x);
								charstarts.push(chars[i].pos_y);
							}
							levelpack[c_lvl] = [level, charstarts, [cols, lines]];
						}
					case 54:
						if (dev > 6) {
							document.getElementById("leveldisp").innerHTML = "<?php echo ms('Tasandivalik', 'Level select'); ?>";
							packsel = c_lvl;
							document.getElementById("igc").style.display = "none";
							document.getElementById("devoption").style.display = "none";
							sel = -5;
						}
						break;
					case 53:
						if (dev > 6) {
							sel = -6;
						}
						break;
					case 56:
						if (dev > 6) {
							sel = -3;
							document.execCommand('copy')
							document.getElementById("igc").style.display = "none";
							document.getElementById("devoption").style.display = "block";
							document.getElementById("selector").style.display = "block";
						}
						break;
					case 57:
						if (dev > 6) {
							edit = [0, 0];
							var width = Math.floor(game.canvas.width / block) * block - 6;
							var height = Math.floor(game.canvas.height / block) * block - 6;
							offset = [-(width) / 2 + (block / 2), -(height) / 2 + (block / 2)];
							document.getElementById("leveldisp").innerHTML = "<?php echo ms('Tasandi redigeerija', 'Level editor'); ?>";
							game.context.font = '25px Arial';
							sel = -2;
							document.getElementById("igc").style.display = "none";
							document.getElementById("devoption").style.display = "block";
							document.getElementById("selector").style.display = "none";
						}
						break;
					case 45:
						if (sel == -2) {
							game.PlaceBlock();
							SaveLevel(false);
						}
						break;
						
					/* Set spawns */
					case 109: /* Numpad - */
						if (sel == -2) {
							chars.splice(-1, 1);
							SaveLevel(true);
						}
						break;
					case 107: /* Numpad + */
						if (sel == -2) {
							if (chars.length < 4)
							{
								chars.push(new Character(edit[0], edit[1], false, 0, chrs[chars.length]));
								SaveLevel(true);
							}
						}
						break;
					case 100: /* Numpad 4 */
						if (sel == -2) {
							chars[3].pos_x = edit[0];
							chars[3].pos_y = edit[1];
							SaveLevel(true); 
						}
						break;
					case 99: /* Numpad 3 */
						if (sel == -2) {
							chars[2].pos_x = edit[0];
							chars[2].pos_y = edit[1];
							SaveLevel(true); 
						}
						break;
					case 98: /* Numpad 2 */
						if (sel == -2) {
							chars[1].pos_x = edit[0];
							chars[1].pos_y = edit[1];
							SaveLevel(true); 
						}
						break;
					case 97: /* Numpad 1 */
						if (sel == -2) {
							chars[0].pos_x = edit[0];
							chars[0].pos_y = edit[1];
							SaveLevel(true); 
						}
						break;
					
					
					/* Teleports */
					case 106: /* Numpad * */
						if (sel == -2) {
							game.PlaceSpecific("G");
						}
						break;
					case 105: /* Numpad 9 */
						if (sel == -2) {
							game.PlaceSpecific("H");
						}
						break;
					case 111: /* Numpad / */
						if (sel == -2) {
							game.PlaceSpecific("E");
						}
						break;
					case 104: /* Numpad 8 */
						if (sel == -2) {
							game.PlaceSpecific("D");
						}
						break;
					case 103: /* Numpad 7 */
						if (sel == -2) {
							game.PlaceSpecific("C");
						}
						break;
					case 102: /* Numpad 6 */
						if (sel == -2) {
							game.PlaceSpecific("B");
						}
						break;
					case 101: /* Numpad 5 */
						if (sel == -2) {
							game.PlaceSpecific("A");
						}
						break;
						
					case 88:
						if (editblock > 0) {
							editblock--;
						} else {
							editblock = 15;
						}
						
						break;
					case 67:
						if (editblock < 15) {
							editblock++;
						} else {
							editblock = 0;
						}
						
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
						
					case 46:
						if (dev > 6) {
							game.PlaceSpecific(" ");
						}
						break;
				}
			}
		}
		
		function SwitchFancy() {
			fancy = !fancy;
		}
	
		function keyup_handle(event) {
			if (event != null) {
				switch(event.keyCode) {
					//vasem
					case 27:
						pausegame();
						break;
				}
			}
		}
		
		function LoadPack(pack) {
            c_lvl = -1;
            levelpack = pack;
            game.next();
		}
		
		function GoFs() {
			var elem = document.getElementsByTagName("body")[0];
			if (elem.requestFullscreen) {
				elem.requestFullscreen();
			} else if (elem.webkitRequestFullscreen) { /* Safari */
				elem.webkitRequestFullscreen();
			} else if (elem.msRequestFullscreen) { /* IE11 */
				elem.msRequestFullscreen();
			}
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
	<div id="exitfs" style="display: none; position: fixed; right: 10px; top: 30px; z-index: 1000;">
		<a class="listitems" style="padding: 20px; font-size: 20pt;" href="#" onclick="ExitFs();">X</a>
	</div>
	<div id="touchpad" style="z-index: 1000; float: right; position: fixed; right: 50px; bottom: 100px; visibility: <?php 
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
	<p id="leveldisp"><?php echo ms('Palun valige tasandipakk', 'Please select a level pack'); ?></p>
	<div id="igc" style="display: none;">
	<a href="#/" onclick="SwitchFancy();"><?php echo ms('Uhke taust', 'Fancy background'); ?></a><br/>
	<a href="#/" onclick="GoFs();"><?php echo ms('Täisekraan', 'Fullscreen'); ?></a>
	<p><?php echo ms('Kaamera', 'Camera'); ?>:</p>
	<a href="#/" onclick="sel = 0;">1</a>
	<a href="#/" onclick="sel = 1;">2</a>
	<a href="#/" onclick="sel = 2;">3</a>
	<a href="#/" onclick="sel = 3;">4</a>
	<a href="#/" onclick="sel = -1;">Free</a>
	<br/><a onclick="c_lvl--; game.next();"><?php echo ms('Laadi tasand uuesti', 'Reset level'); ?></a></div>
	<div id="devoption" style="display: none;">
		
		<p><span style="color: red;"><?php echo ms('Hoiatus', 'Warning'); ?>: </span><?php echo ms('Kopeerige tasandi andmed enne lehekülje uuesti laadimist, kui te seda ei tee, siis tasandi andmed kustutatakse', 'Copy level data before refreshing this page, otherwise level data will be lost'); ?>.</p>
		<h2><?php echo ms('Klahviseosed', 'Key bindings'); ?></h2>
		<ul>
			<li>Insert - <?php echo ms('Paiguta blokk', 'Place block'); ?></li>
			<li>Delete - <?php echo ms('Eemalda blokk/Eemalda teleport/Asenda õhuga', 'Remove block/Remove teleport/Replace with air'); ?></li>
			<li>WASD/PEUI/ZQSD - <?php echo ms('Liiguta blokki', 'Move block'); ?></li>
			<li>C - <?php echo ms('Vali järgmine blokk', 'Switch to next block'); ?></li>
			<li>X - <?php echo ms('Vali eelmine blokk', 'Switch to previous block'); ?></li>
			<li>Enter - <?php echo ms('Blokivõtja', 'Block picker'); ?></li>
			<li>1/2/3/4 - <?php echo ms('Testi väljakut', 'Test map'); ?></li>
			<li>Numpad 1-4 - <?php echo ms('Sea tekkekohad iga tegelase jaoks', 'Set spawn points for each character'); ?></li>
			<li>Numpad +/- - <?php echo ms('Lisa/eemalda tegelane', 'Add/remove character'); ?></li>
			<li>Numpad 5/6 - <?php echo ms('Lisa telpordi allikas/sihtpunkt', 'Add source/destination to teleport'); ?> A</li>
			<li>Numpad 7/8 - <?php echo ms('Lisa telpordi allikas/sihtpunkt', 'Add source/destination to teleport'); ?> C</li>
			<li>Numpad [/]/[*] - <?php echo ms('Lisa telpordi allikas/sihtpunkt', 'Add source/destination to teleport'); ?> E</li>
			<li>Numpad 9 - <?php echo ms('Lisa teleport finišisse', 'Add a teleport to finish block'); ?></li>
			<li>R - <?php echo ms('Laadi väljak uuesti', 'Reload map'); ?></li>
			<li>6 - <?php echo ms('Tasandi valija', 'Level chooser'); ?></li>
			<li>7 - <?php echo ms('Muuda väljaku suurust (kasutage liikumisklahve ja vajutage Enter, et suurust muuta)', 'Change map size (use move keys and press Enter to change size)'); ?></li>
			<li>8 - <?php echo ms('Väljasta väljakuandmed (arendamiseks)', 'Output map data (for development)'); ?></li>
			<li>9 - <?php echo ms('Väljakuredigeerija', 'Level editor'); ?></li>
			<li>0 - <?php echo ms('Vaatle tasandit', 'Spectate level'); ?></li>

		</ul>
	</div>
	<div id="selector">
        <div id="dsel" style="display: none;">
		<h1><?php echo ms('Tasandipakid', 'Level packs'); ?></h1>
        <a href="#" onclick="LoadPack([['############# c  ##    ##  #c      ##   #c _<  ##      ^   ##    c   b ## c#  #  F #############', [6, 4, 8, 2, 3, 1, 1, 3], [12, 8]], ['#############     c   b## #      c ## b  #     ## ##   b   ####  #   # ##ccc  # c  ######F######', [1, 1, 1, 4], [12, 8]], ['#############c c   _  ### _c   c   ##c c >_c<  ##  _   c   ##  _   ^  c## _ _ c #F #############', [3, 6, 2, 6, 10, 6], [12, 8]], ['_ ###########  V  c   ### # #  c   ##_ >     V_##     >b_< ## #  #   # ##Fc>_<# c  #############', [0, 0, 9, 6], [12, 8]], ['# ########### ## # _< ###V> V# V  V##>^#>b  ^# ### # c   c ##   _###^ <##F #c # #c #############', [1, 0], [12, 8]], ['###########   c  _ ## #### # ##c  V   <##### ##  ##  _ _ c###F# # #  ###########', [1, 1, 5, 3, 6, 5, 3, 6], [10, 8]], ['####################  c     b    c   ##        _  _     <# ###  >     b    ##     c   < _     <# #c             c## b       #F_  b  <############_######', [2, 2, 5, 5], [19, 8]], ['################  c          ##     b  _  _ ## ###         ##    >c  ^ <_ ##     b       ##        #  _ ##   b c  c# _ ##    #        ##F b      _   ################', [1, 1], [15, 11]], ['#############  #c  # cF### #  b  V ##  >>  cb <##c## c  # ### # c## # ### c  # ^  <#############', [1, 1], [12, 8]]]);"><?php echo ms('Algus', 'The Beginning'); ?></a><br/>
        <a href="#" onclick="LoadPack([['#  B        +#F          ##_#         ##_#         ##_#         ##_*        A##_#          ', [10, 5], [13, 7]], ['##+++++++++++#+##c_F#          ##c_ _      H   ##c#_##         ## #_#          ## #_#          ## #            #### +           ', [13, 7], [16, 8]], ['#F+++++++++A## ++#++++++_##  B#++#+++_##+++       _##+++ #+ +++_##+++    #  _##+++  #++++_##+++ ++++++_##+++ ++++++_##+++#++++++_#', [4, 8], [13, 10]], ['################F        ###### ############## ###+++  ###### ###+D+######## #E#+++######## #B############ #C#####C#A#### #######_#_####G#######_#_############   ##################', [10, 10], [15, 12]], ['################# ########### ###             F## # ######### ### # ######### ### # ######### ### # ######### ### # ######### ### # ######### ### #  ######## ### +#          ##### #########+##', [13, 10], [16, 12]], ['####################A#H#A#F#A#A#A#A#A## # # ### # # # # ## # # ### # # # # ## # # ### # # # # ## # # ### # # # # ## #B# ### # # # # ## # # ### # # # # ## # # ### # # # # ## # # ### # # # # ####################', [17, 9], [19, 11]]]);"><?php echo ms('Klassikalised tasandid', 'Classic levels'); ?></a><br/>
        <a href="#" onclick="LoadPack([['######################HcD ccc<F###C###A###### ####c###c## ##c#####c###c  _  c###+ c    +##########B#############', [8, 4, 10, 4], [16, 7]], ['################# _ _#  D cccAF### # c c c  #  ##  # # ## # c# ### ###   _  c# ## _   C_## #   ###B#############', [14, 5, 4, 2, 13, 2, 1, 3], [16, 7]], ['#A###########B##Ac#       <#V##A^< b     ^ <##Ac<  C       ##A##        D #####F##########', [9, 2, 9, 4], [15, 6]], ['+++++++ +++ +++ ++++++# F #   #   #   #  ++# c # c # c # c # c++   #  _#  _#  _#  #++  ^ <#^ <#  <#  <# ++++++++++++++++++++++', [19, 1, 15, 0, 16 ,1], [21, 6]], ['#########Ec G#F##B  C  ##bc bc###D    #### bc  ## c#AcH#########', [3,3,6,5,1,6,4,1], [8, 8]], ['# ########b # bbb##V_ >   ##b b_b b##ccccc< ##F#######', [2,1,3,2,4,1,6,2], [9, 6]], ['############## _G####ccc#cH#### BC#######+++#+E++#####  D A###  #   H###F ################', [6,1,2,3,6,5,3,6], [10, 9]], ['#+##D     ### c#  ##c_ E #B#+##G# ##A#cc# #c#+#A# #C # c##cc  ##+##ccccc # ##### #c<#F##ccc##+c#Accccc^  +H#', [0,2,5,1], [12, 9]], ['########## b   b ##   b   ## b   b ##   b   ## b   bF##########', [2,2,5,5,4,3,1,5], [9,7]], ['#############cccccccccc##c Vcc<_cc_##c_c  c   c##c>cccccccc##c c_ccc_cc##ccccc^ccccF############', [4,4,8,2,7,6,2,2], [12,8]]]);"><?php echo ms('Kogemus', 'Le Experience'); ?></a><br/>
        <a href="#" onclick="LoadPack([['# ccccc#####b##h#c#gg##-#- b<#gg## # ########   ccccF#############', [4,2,1,0], [11, 6]], [' cgggccchggggc hhcccccghhgf  Fghhccc _cc', [0,0,3,3,6,1,4,4], [8,5]], [' cc-ch hccb h hcg gh hc bch h c-ccF', [3,2,4,1,2,3,1,4], [7,5]], ['cccc c>_ccbcgb^ccx#-#gb<#cF_c ######', [1,1,4,0,5,4], [6, 6]], ['  > VV <  #- -cc- -##f.fccf.f##g-gccg.g##c cccc c##        ##bbb  bbb##b b  b b##bbb  bbb#####FF####', [2,7,7,7], [10, 10]], ['         # #    #                         ## E # #  G    #     #  #            #  # #   #    ##            #   #     #   #     #  ####    #         ##      #         #     #  #         #       # #         #     #       #   #       #  #      #  #    ##     #           ##   ##    ##  #     ##                 #          #  #    #       ##          #  ##      #  #     #     # #          #   #      #  #     ##  #          # ###   #     #   #       #           #        ##    #   #    #        #   #   #D      #    #   #  #       ##   ##  # ####    #     #  #   ##    #     #      C#     #     #  #       #        #   ##       #    #   #  #  F h    ## # ##          #    ##  #  ### h    #   ##        #   #     #  #     h     #           ###   #        #    h      ##  ####  #  #    #      # #   h     ##  #   ## # ##     #      ###  h    ######     #   #      #        # h          ##        #      #    #   V   <    #    #       #       #    ##  ###    #  #   #       #       #          #  #   #    #       #       #        ####   #      #       ##      #   ##   ##   #        #        #      #    ###A # #         #         #  B # #   #     #                     #  #   #  #                            ###    #     ', [5,2,10,3,8,8,16,8], [38, 32]], ['## V<###F## > ^c ch##ccbcb ch##cc cc - ###########', [1,1,6,1], [10, 5]], ['#############b bb   bb ##c c ccbx b##c  ccc    ##b b ccb# b### ##F######', [4,4,3,3,6,1], [12, 6]], ['F< c >cccc^  c# # +  CB^ # >DAc +G# # E c    >cccc', [6,2,4,2,5,3,5,1], [10, 5]], ['Fc cccccccccF c_###_c#_  # c__#__c_#_## c_ _ _c#_# # c_ # _c# _ #FcccccccccccF', [2,0,8,2,11,1,5,3], [13, 6]], ['#    b- #  g c#  #c   #g x+ x  #  c#g  # c ##gcccccc g  #  xF  ## ', [1,0,2,2,7,3,2,5], [11, 6]], ['F  b-   bE Cc    -b    cb -bB -bD c-b-b c- - c    -bb bAccccc-b GA', [1, 0], [11, 6]]]);"><?php echo ms('Väljaku Pardal', 'Aboard The Board'); ?></a><br/>
        <a href="#" onclick="LoadPack([['++b+++b+++b+++b+++b+b+++++fbfffbfffbfffbfffbfbfff++f.ccccccc.............f++f.ggg.ggg.ggg.ggg.g.g.f++f..g-.gb-cg.g.g..cg.g.f++f..g--ggbcggg.gg.cg.g.f+bb..g-.gb cgg..g..c....bb+f..g..ggg.g.g.ggg.g.g.f++fbfffbfffbfffbfffbfbfbf+++b+++b+++b+++b+++b+b+b++', [21,6,17,4,13,6,9,6], [25,10]], ['#x#x#x#x##gggggg xxgggg gg## ggggggxxgg gggg##gggggggxxggggggg###x#F#x##', [1,3,3,4,5,2,7,1], [9,8]], ['################g ggg        ##g gcccccccc<F##ggggggggggggg##ggggggg xggg ##ccg      g g ##ggg c   cggg ## gg cgggc    ##ggg cg gcg < F###############', [2,2,7,8,11,5,1,7], [15,10]], ['ggggggggggggg c  gg    gg  gc      gg   gc _<  gg      ^   gg    c   b gg cg  g  F ggggggggggggg', [6,4,8,2,3,1,1,3], [12,8]], ['ggggggggggg   c  _ gg gggg g ggc  V   <ggggg gg  gg  _ _ cgggFg g g  ggggggggggg', [1,1,5,3,6,5,3,6], [10,8]], ['ggggggggggggg     c   bgg g      c gg b  g     gg gg   b   gggg  g   g ggccc  g c  ggggggFgggggg', [1,1,1,4], [12,8]], ['FFFFFFFgcgcgcgcgcgcgcg_g g_gcgcgcgcgcgcgcgFFFFFFF', [3,3,1,3,5,3], [7,7]], ['gggggggggggggggggggggggggggggggggggggggggggccccgFFggggg ccccg  ggggggccccg  gggggcc ^cg  ggggggccccg  ggggg >cccg  ggggggccccgFFgggggcccVcgggggggggggccggggggggggggcggggggggggggcgggggggggggggggggg', [5,6,3,8,3,4], [13,15]], [' cgcgcgc _gFgggFg_gcgcgcgcgggggggggggcgcgcgcg_gFgggFg_ cgcgcgc ', [0,0,8,0,8,6,0,6], [9,7]], ['gggggggggggggccccccccccggc Vcc<_cc_ggc_c  c   cggc>ccccccccggc c_ccc_ccggccccc^ccccFgggggggggggg', [4,4,8,2,7,6,2,2], [12,8]]]);"><?php echo ms('Klaas', 'Glass'); ?></a><br/>
        <?php echo ms('Uued väljakupakid peagi tulemas', 'More level packs coming soon'); ?>!
        <div id="dtest" style="display: none;">
			<h2><?php echo ms('Arendamine', 'Development'); ?></h2>
			<p><?php echo ms('Erimenüüd', 'Special menus'); ?></p>
			<ul>
			<li>9 - <?php echo ms('Sisemine väljakuredigeerija', 'Internal level editor'); ?></li>
			<li>8 - <?php echo ms('Silumisinfo', 'Debug info'); ?></li>
			<li>7 - <?php echo ms('Väljaku suurus', 'Map size'); ?></li>
			<li>6 - <?php echo ms('Tasandi valik', 'Level select'); ?></li>
			<li>5 - <?php echo ms('Taustakuva/valija (vajutage Enter, et muuta tausta)', 'Background viewer/selector (press Enter to switch background)'); ?></li></ul>
			<p><?php echo ms('Laadi tasand teksti kaudu', 'Load level with text data'); ?></p>
			<form autocomplete="off">
				<ul><li><?php echo ms('Tasandiandmed', 'Level data'); ?>: <input style="width: 100%;" id="data" type="text"></input></li>
				<li><?php echo ms('Mõõtmed', 'Dimensions'); ?>: <input style="width: 40px;" id="width"></input><input style="width: 40px;" id="height"></input></li>
				<li><?php echo ms('Tekkekohad', 'Spawn locations'); ?>: <input id="starts"></input></input></li>
				</ul>
			</form>
			<a href="#/" onclick="DevTest();"><?php echo ms('Testi tasandit', 'Test level'); ?></a>
		</div>
        <h2><?php echo ms('Kuidas mängida', 'How to play'); ?>?</h2>
        <p><?php echo ms("See on nuputamismäng, kus on teie eesmärgiks koguda kõik säravad mündid ja liigutada kõik robotid finišisse. Roboteid nimetatakse Ieemideks. Nende jalgade küljes on ka sensorid ning neile on võimalik saata käsk minna, kuid nad peavad kasutama endi sensoreid, et peatuda. See tähendab tavaliselt seda, et nad ei peatu enne seina vastu minemist (teatud eranditega)",
						 "This is a puzzle game, where your goal is to collect all shiny coins and get all robots to the finish line. The robots are called Iems. They also have sensors attached to their legs and can recieve a command to go, but they'll need to use their own sensors to stop. This usually means that they won't stop until hitting a wall (with certain exceptions)"); ?>.
        
        <p><?php echo ms('Et Ieeme juhtida, saate kasutada järgnevaid klahve', 'To command Iems, you can use the following keys'); ?>:</p>
        <ul>
            <li>&larr;&uarr;&darr;&rarr; (<?php echo ms('Nooleklahvid', 'Arrow keys'); ?>)</li>
            <li>WASD (QWERTY)</li>
            <li>ZQSD (AZERTY)</li>
            <li>PEUI (Dvorak)</li>
            <li><a href="#/" onclick="if (document.getElementById('touchpad').style.visibility == 'hidden') { document.getElementById('touchpad').style.visibility = 'visible';} else { document.getElementById('touchpad').style.visibility = 'hidden';}"><?php echo ms('Puuteklahvid', 'Touch controls'); ?></a></li>
        </ul>
        <p><?php echo ms('Kiirklahvid', 'Shortcut keys'); ?>:</p>
        <ul>
			<li>1 - <?php echo ms('Kaamera', 'Camera'); ?> 1</li>
			<li>2 - <?php echo ms('Kaamera', 'Camera'); ?> 2</li>
			<li>3 - <?php echo ms('Kaamera', 'Camera'); ?> 3</li>
			<li>4 - <?php echo ms('Kaamera', 'Camera'); ?> 4</li>
			<li>0 - <?php echo ms('Vaba kaamera', 'Free camera'); ?> (<?php echo ms('kasutage liikumisklahve, et ringi vaadata', 'use movement keys to look around'); ?>)</li>
			<li>R - <?php echo ms('Laadi tasand uuesti', 'Reset level'); ?></li>
			<li>F11 - <?php echo ms('Täisekraan', 'Fullscreen mode'); ?></li>
        </ul><?php echo ms("Kõik Ieemid liiguvad üheaegselt ning ei saa üksteise vastu minna. Ieemid näevad välja sellised",
						   "Also, all Iems move at the same and can't hit each other. Iems look like this"); ?>
        :</p>
        <img id="charactertextures" onload="chrs = PrepareTexture('character.png', 1, 4);" src="images/shootme/character.png">
        <p><?php echo ms('Selles mängus on erilised blokid, mis mõjutavad seda, kuidas tegelased liiguvad. Need blokid on järgmised',
						 'This game has special blocks, which affect how characters move. They are the following'); ?>:</p>
        <ul>
            <li><span style="color: #00f;"><?php echo ms('Suunajad', 'Pointers'); ?></span> - <?php echo ms('Need on sinised nooled, mis sunniviisiliselt muudavad tegelase liikumissuunda', 'These are blue arrows, which forcibly change the direction of a character it touches'); ?></li>
            <li><span style="color: #fe0;"><?php echo ms('Säravad mündid', 'Shiny coins'); ?></span> - <?php echo ms('Te peate koguma kõik säravad mündid, et tasand lõpetada', 'You must collect all of these before you can finish the puzzle'); ?></li>
            <li><span style="color: #f4f;"><?php echo ms('Kleepuv blokk', 'Goo block'); ?></span> - <?php echo ms('Peatab tegelase, mis võimaldab tal liikuda ükskõik millises uues suunas', 'Stops the character movement, allowing you to move in any direction'); ?></li>
            <li><span style="color: #ea0;"><?php echo ms('Kast', 'Box'); ?></span> - <?php echo ms('See on liigutatav blokk. Kast lõpetab liikumise, kui see puudutab ükskõik millist muud blokki', 'This is a movable block. If you touch it while moving, it moves as well and it stops moving when it hits any other block'); ?></li>
            <li><span style="color: #888;"><?php echo ms('Auk', 'Hole'); ?></span> - <?php echo ms("Sellesse blokki ei saa tegelasi liigutada, kuid siia saab liigutada kasti, et muuta blokk läbitavaks", "You can't move characters into this block, but you can move a box into a hole to make it passable"); ?></li>
            <li><span style="color: #0af;"><?php echo ms('Klaas', 'Glass'); ?></span> - <?php echo ms("Selle bloki vastu saab minna, kuid pärast vastu põrkumist läheb see katki", "You can hit this block, but it'll break once hit"); ?></li>
            <li><span style="color: #f80;"><?php echo ms('Redel', 'Ladder'); ?></span> - <?php echo ms('Seda blokki saab läbida ainult vertikaalselt', 'You can pass this block vertically'); ?></li>
            <li><span style="color: #555;"><?php echo ms('Must auk', 'Black hole'); ?></span> - <?php echo ms("See eemaldab tegelase väljakult, ilma kontrollimata, kas mündid on kogutud. Kui kõik tegelased siia liigutada ilma münte kogumata, siis kaotate", "This will remove a character from the board, without checking if all coins are collected. If you move all characters here without collecting all coins, you'll lose"); ?>.</li>
            <li><?php echo ms('Finiš', 'Finish'); ?> - <?php echo ms('Siia peate kõik Ieemid liigutama pärast müntide kogumist', 'This is the block you must move all Iems to after collecting all coins'); ?></li>
            <li><span style="color: #90f;"><?php echo ms('Portaal', 'Portal'); ?></span> - <?php echo ms('See liigutab tegelase kindlasse asukohta', 'This moves the character into a designated spot. This can be different depending on the portal'); ?>.</li>
            <li><span style="color: #f00;"><?php echo ms('Tuleblokk', 'Death block'); ?></span> - <?php echo ms("Te ei saa selle bloki vastu minna, sest muidu see plahvata, mis põhjustab mängu lõppemise", "You cannot hit this block, because it'll explode when hit by a character, which causes the game to end"); ?></li>
        </ul>
        </div>
        <div id="loader" style="display: block;">
            <p><?php echo ms('Palun oota', 'Please wait'); ?>...</p>
        </div>
	</div>
    <img id="normaltextures" onload="textures = PrepareTexture('text2.png', 8, 8);" src="images/shootme/text2.png" style="display: none;"> 
