<style>
	img.smile {
		background: #aaa;
		border: solid;
		border-size: 2px;
		border-color: #fff #888 #888 #fff;
		padding: 2px;
		width: 34px;
		image-rendering: crisp-edges;
		image-rendering: pixelated;
		display: block;
		margin-left: auto;
		margin-right: auto;
		text-align: center;
	}
	
	div.window {
		background: #aaa;
		border: solid;
		border-size: 2px;
		border-color: #fff #888 #888 #fff;
		position: fixed;
		left: 10px;
		top: 10px;
	}
	
	div.windowcontents {
		padding: 5px;
		padding-left: 15px;
		padding-right: 15px;
	}
	
	div.windowtitle {
		background: linear-gradient(to right, #008, #06B);
		margin-bottom: 20px;
		width: 95%;
		font-family: "Tahoma";
		padding: 2px;
		padding-left: 15px;
		font-size: 18px;
		color: white;
	}
	
	img.smile:active {
		border-color: #888 #fff #fff #888;
	}
	
	div.osd {
		width: 110px;
		border: solid;
		border-size: 1px;
		border-color: #888 #fff #fff #888;
		background: #000;
	}
	
	#start div {
		margin-top: 20px;
	}

	:root {
	--bg-color: none;
	--ia-color: #600;
	--a-color: #f00;
	--padding-p: 4px;
	--bar-w: 4px;
	--bar-pad: 8px;

	/* no need to change after here */
	--padding: calc(var(--padding-p)*2);
	--bar-h: calc(var(--bar-w)*4);
	--bar-r: calc(var(--bar-w)/2);
	--bar-p: calc(var(--padding-p) + var(--bar-w));
	--bar-p-t: calc(var(--bar-p)*2);
	--c-w: calc(var(--bar-p-t) + var(--bar-h));
	--bar-h-t: calc(var(--bar-h)*2);
	--c-h-np: calc(var(--bar-p-t) + var(--bar-h-t));
	--c-h: calc(calc(var(--c-h-np) + var(--padding-p)) + var(--bar-pad));
	}

	.s7s {
	display: inline-block;
	width: var(--c-w);
	height: var(--c-h);
	background: var(--bg-color);
	position: relative;
	margin: 0;
	}
	.s7s input {
	display: none;
	}

	.s7s seg {
	background: var(--ia-color);
	border-radius: var(--bar-r);
	height: var(--bar-h);
	width: var(--bar-w);
	}

	.s7s seg:nth-of-type(3n+1) {
	height: var(--bar-w);
	width: var(--bar-h);
	left: 50%;
	margin-left: calc(var(--bar-h) / -2);
	}

	.s7s seg:nth-of-type(1) {
	position: absolute;
	top: var(--padding);
	}

	.s7s seg:nth-of-type(2) {
	position: absolute;
	top: var(--bar-p);
	right: var(--padding);
	}

	.s7s seg:nth-of-type(3) {
	position: absolute;
	bottom: var(--bar-p);
	right: var(--padding);
	}

	.s7s seg:nth-of-type(4) {
	position: absolute;
	bottom: var(--padding);
	}

	.s7s seg:nth-of-type(5) {
	position: absolute;
	bottom: var(--bar-p);
	left: var(--padding);
	}

	.s7s seg:nth-of-type(6) {
	position: absolute;
	top: var(--bar-p);
	left: var(--padding);
	}

	.s7s seg:nth-of-type(7) {
	position: absolute;
	top: 50%;
	margin-top: calc(var(--bar-r) * -1);
	}

	input[value='0'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='0'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='0'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}
	input[value='0'] ~ seg:nth-of-type(4) {
	background: var(--a-color);
	}
	input[value='0'] ~ seg:nth-of-type(5) {
	background: var(--a-color);
	}
	input[value='0'] ~ seg:nth-of-type(6) {
	background: var(--a-color);
	}
	
	input[value='-'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}

	input[value='1'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='1'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}

	input[value='2'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='2'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='2'] ~ seg:nth-of-type(4) {
	background: var(--a-color);
	}
	input[value='2'] ~ seg:nth-of-type(5) {
	background: var(--a-color);
	}
	input[value='2'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}

	input[value='3'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='3'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='3'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}
	input[value='3'] ~ seg:nth-of-type(4) {
	background: var(--a-color);
	}
	input[value='3'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}

	input[value='4'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='4'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}
	input[value='4'] ~ seg:nth-of-type(6) {
	background: var(--a-color);
	}
	input[value='4'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}


	input[value='5'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='5'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}
	input[value='5'] ~ seg:nth-of-type(4) {
	background: var(--a-color);
	}
	input[value='5'] ~ seg:nth-of-type(6) {
	background: var(--a-color);
	}
	input[value='5'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}

	input[value='6'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='6'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}
	input[value='6'] ~ seg:nth-of-type(4) {
	background: var(--a-color);
	}
	input[value='6'] ~ seg:nth-of-type(5) {
	background: var(--a-color);
	}
	input[value='6'] ~ seg:nth-of-type(6) {
	background: var(--a-color);
	}
	input[value='6'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}


	input[value='7'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='7'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='7'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}


	input[value='8'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='8'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='8'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}
	input[value='8'] ~ seg:nth-of-type(4) {
	background: var(--a-color);
	}
	input[value='8'] ~ seg:nth-of-type(5) {
	background: var(--a-color);
	}
	input[value='8'] ~ seg:nth-of-type(6) {
	background: var(--a-color);
	}
	input[value='8'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}

	input[value='9'] ~ seg:nth-of-type(1) {
	background: var(--a-color);
	}
	input[value='9'] ~ seg:nth-of-type(2) {
	background: var(--a-color);
	}
	input[value='9'] ~ seg:nth-of-type(3) {
	background: var(--a-color);
	}
	input[value='9'] ~ seg:nth-of-type(4) {
	background: var(--a-color);
	}
	input[value='9'] ~ seg:nth-of-type(6) {
	background: var(--a-color);
	}
	input[value='9'] ~ seg:nth-of-type(7) {
	background: var(--a-color);
	}

	
</style>
<script>
	var grab = false;
	var game = {
			init : function(width, height, minecount) {
				this.canvas = document.createElement("canvas");
				this.canvas.setAttribute("style", "width: 100%; image-rendering: crisp-edges; image-rendering: pixelated; margin-top: 15px;");
				this.canvas.setAttribute("oncontextmenu", "return false;");
				this.mines = [];
				this.blocks = [];
				this.flags = [];
				this.kid_mode = false;
				this.wrapfield = true;
				this.win = false;
				var mode = document.getElementById("modeselect").value;
				switch (mode) {
					case "unlosable":
						this.wrapfield = false;
						this.kid_mode = true;
						break;
					case "classic":
						this.wrapfield = false;
						break;
					case "unbeatable":
						break;
				}
				this.blocksize = 16;
				for (var y = 0; y < height; y++) {
					var row = [];
					for (var x = 0; x < width; x++) {
						row.push(false);
					}
					this.blocks.push(row);
				}
				if (!(mode == "unbeatable")) {
					for (var i = 0; i < minecount; i++) {
						var xr = Math.floor(Math.random() * this.blocks[0].length - 1);
						var yr = Math.floor(Math.random() * this.blocks.length - 1);
						var cont = true;
						while (cont) {
							cont = false;
							xr = Math.floor(Math.random() * this.blocks[0].length - 1) + 1;
							yr = Math.floor(Math.random() * this.blocks.length - 1) + 1;
							for (var l = 0; l < this.mines.length; l++) {
								if ((this.mines[l][0] == xr) && (this.mines[l][1] == yr)) {
									cont = true;
								}
							}
						}
						this.mines.push([xr, yr]);
					}
					this.firstmove = true;
				} else {
					for (var y = 0; y < this.blocks.length; y++) {
						for (var x = 0; x < this.blocks[0].length; x++) {
							this.mines.push([x, y]);
						}
					}
					this.firstmove = false;
				}
				this.canvas.width = this.blocksize * this.blocks[0].length;
				this.canvas.height = this.blocksize * this.blocks.length;
				this.context = this.canvas.getContext("2d");
				this.mpos = [-1, -1];
				this.down = false;
				var ctx = this.canvas.getContext("2d");
				var myPara = this.canvas;
				var mychild = document.getElementById("start");
				mychild.appendChild(myPara);
				this.interval = setInterval(this.recall, 16);
				this.secs = 0;
				this.context.font = '16px Arial';
				this.context.filter = 'none';
				this.context.imageSmoothingEnabled = true;
				document.getElementById("status").setAttribute("src", "images/smile.png");
			},
			recall : function() {
				game.screen();
				var open = 0;
				game.blocks.forEach(block => {
					block.forEach(subblock => {
						if (subblock) { open++; }
					});
				});
				if (!(game.mines.length == (game.blocks.length * game.blocks[0].length))) {
					if (open >= ((game.blocks.length * game.blocks[0].length) - game.mines.length)) {
						if (!game.firstmove) {
							game.firstmove = true;
							for (var y = 0; y < game.blocks.length; y++) {
									for (var x = 0; x < game.blocks[y].length; x++) {
										game.blocks[y][x] = true;
									}
							}
							this.win = true;
							document.getElementById("status").setAttribute("src", "images/smile_cool.png");	
						}
					}
				}
				var mcstr = String(game.mines.length - game.flags.length);
				var tstr = String(game.secs);
				document.getElementById("m100").setAttribute("value", "0");
				document.getElementById("m10").setAttribute("value", "0");
				document.getElementById("m1").setAttribute("value", mcstr.substr(mcstr.length - 1, 1));
				if (mcstr.length > 1) {
					document.getElementById("m10").setAttribute("value", mcstr.substr(mcstr.length - 2, 1));
					if (mcstr.length > 2) {
						document.getElementById("m100").setAttribute("value", mcstr.substr(mcstr.length - 3, 1));
					}
				}
				document.getElementById("t100").setAttribute("value", "0");
				document.getElementById("t10").setAttribute("value", "0");
				document.getElementById("t1").setAttribute("value", tstr.substr(tstr.length - 1, 1));
				if (tstr.length > 1) {
					document.getElementById("t10").setAttribute("value", tstr.substr(tstr.length - 2, 1));
					if (tstr.length > 2) {
						document.getElementById("t100").setAttribute("value", tstr.substr(tstr.length - 3, 1));
					}
				}
			},
			
			open : function(xp, yp) {
				if ((xp < 0) || (yp < 0) ||
				    (yp > game.blocks.length - 1) ||
				    (xp > game.blocks[0].length - 1) ||
				    (game.blocks[yp][xp])) {
					return;
				}
				game.blocks[yp][xp] = true;
				var mp = false;
				for (var i = 0; i < game.mines.length; i++) {
					if ((game.mines[i][0] == xp) && (game.mines[i][1] == yp)) {
						if (!(game.firstmove || game.kid_mode)) {
							mp = true;
						} else {
							game.mines.splice(i, 1);
							var doubleorsame = true;
							var rx = 0;
							var ry = 0;
							while (doubleorsame) {
								doubleorsame = false;
								rx = Math.floor(Math.random() * game.blocks[0].length);
								ry = Math.floor(Math.random() * game.blocks.length);
								if (game.blocks[ry][rx]) {
									doubleorsame = true;
								}
								if ((rx == xp) && (ry == yp)) {
									doubleorsame = true;
								} else {
									game.mines.forEach(mine => {
										if ((mine[0] == rx) && (mine[1] == ry)) {
											doubleorsame = true;
										}
									});
								}
								
							}
							game.mines.push([rx, ry]);
						}
					}
				}
				game.firstmove = false;
				
				if (mp) {
					for (var y = 0; y < game.blocks.length; y++) {
							for (var x = 0; x < game.blocks[y].length; x++) {
								game.blocks[y][x] = true;
							}
					}
					game.firstmove = true;
					document.getElementById("status").setAttribute("src", "images/smile_dead.png");
					return;
				}
				var minecount = 0;
				var xs = [xp - 1, xp, xp + 1];
				var ys = [yp - 1, yp, yp + 1];
				for (var nx = 0; nx < xs.length; nx++) {
					for (var ny = 0; ny < ys.length; ny++) {
						var xm = xs[nx];
						var ym = ys[ny];
						
						for (var i = 0; i < game.mines.length; i++) {
							if ((game.mines[i][0] == xm) && (game.mines[i][1] == ym)) {
								minecount++;
							}
						}
					}	
				}
				if (minecount == 0) {
					for (var nx = 0; nx < xs.length; nx++) {
						for (var ny = 0; ny < ys.length; ny++) {
							if (!((xs[nx] == x) && (ys[ny] == y))) {
								game.open(xs[nx], ys[ny]);
							}
						}
					}
				}
			},
			
			screen : function() {
				game.context.fillStyle = "#444";
				game.context.fillRect(0, 0, game.canvas.width, game.canvas.height);
				for (var y = 0; y < game.blocks.length; y++) {
						var row = game.blocks[y];
						for (var x = 0; x < game.blocks[y].length; x++) {
							var minecount = 0;
							var ismine = false;
							var xs = [x - 1, x, x + 1];
							var ys = [y - 1, y, y + 1];
							
							if (game.wrapfield) {
								if (xs[0] == -1) { xs[0] = game.blocks[0].length - 1; }
								if (xs[2] == game.blocks[0].length) { xs[2] = 0; }							
								if (ys[0] == -1) { ys[0] = game.blocks.length - 1; }
								if (ys[2] == game.blocks.length) { ys[2] = 0; }
							}
							
							for (var i = 0; i < game.mines.length; i++) {
								if ((game.mines[i][0] == x) && (game.mines[i][1] == y)) {
									ismine = true;
								}
							}
							if (!ismine) {
								for (var nx = 0; nx < xs.length; nx++) {							
									for (var ny = 0; ny < ys.length; ny++) {
										var xm = xs[nx];
										var ym = ys[ny];
										if ((xm == x) && (ym == y)) {
											continue;
										}
										for (var i = 0; i < game.mines.length; i++) {
											if ((game.mines[i][0] == xm) && (game.mines[i][1] == ym)) {
												minecount++;
											}
										}
									}	
								}
							}
							if (game.blocks[y][x]) {
								game.context.fillStyle = "#999";
								game.context.fillRect(x * game.blocksize, y * game.blocksize, game.blocksize, game.blocksize);
								game.context.fillStyle = "#bbb";
								game.context.fillRect(x * game.blocksize + 1, y * game.blocksize + 1, game.blocksize - 2, game.blocksize - 2);

								if (minecount > 0) {
									var minevalues = ["blue", "green", "red", "#008", "#800", "#088", "#000", "#888"];
									game.context.fillStyle = minevalues[minecount - 1];
									game.context.fillText(String(minecount), x * game.blocksize + 5, (y + 1) * game.blocksize - 2);
								}
								if (ismine) {
									game.context.fillStyle = "#000";
									game.context.fillRect(x * game.blocksize + 5, y * game.blocksize + 5, game.blocksize - 10, game.blocksize - 10);
									game.flags.forEach(flag => {
										if ((flag[0] == x) && (flag[1] == y)) {
											game.context.fillStyle = "#0f0";
											game.context.fillRect(x * game.blocksize + 5, y * game.blocksize + 5, game.blocksize - 10, game.blocksize - 10);
										}
									});
								} else {
									game.flags.forEach(flag => {
										if ((flag[0] == x) && (flag[1] == y)) {
											game.context.fillStyle = "#f00";
											game.context.fillRect(flag[0] * game.blocksize + 5, flag[1] * game.blocksize + 5, game.blocksize - 10, game.blocksize - 10);
										}
									});
								}
							} else {
								if ((game.mpos[0] == x) && (game.mpos[1] == y) && (game.down)) {
									game.context.fillStyle = "#bbb";
									game.context.fillRect(x * game.blocksize + 1, y * game.blocksize + 1, game.blocksize - 2, game.blocksize - 2);
									game.context.fillStyle = "#444";
									game.context.fillRect(x * game.blocksize, y * game.blocksize, game.blocksize - 1, 1);
								} else {
									game.context.fillStyle = "#bbb";
									game.context.fillRect(x * game.blocksize + 1, y * game.blocksize + 1, game.blocksize - 2, game.blocksize - 2);
									game.context.fillStyle = "#fff";
									game.context.fillRect(x * game.blocksize, y * game.blocksize, game.blocksize - 1, 1);
								}
								game.context.fillRect(x * game.blocksize, y * game.blocksize, 1, game.blocksize - 1);
								game.flags.forEach(flag => {
									if ((flag[0] == x) && (flag[1] == y)) {
										game.context.fillStyle = "#f00";
										game.context.fillRect(x * game.blocksize + 5, y * game.blocksize + 5, game.blocksize - 10, game.blocksize - 10);
									}
								});
							}
						}
				}
			},
			close : function() {
				clearInterval(this.recall);
				document.getElementById("start").innerHTML = "";
			}
	}

	function isDefined(x) {
		var undefined;
		return x !== undefined;
	}
	function update_location(event) {
		if (isDefined(game.canvas))
		{
			var rect = game.canvas.getBoundingClientRect();
			x = (event.clientX - rect.left) * (game.canvas.width / rect.width);
			y = (event.clientY - rect.top) * (game.canvas.height / rect.height);
			game.mpos = [Number(Math.floor(x / game.blocksize + 1)) - 1, Number(Math.floor(y / game.blocksize + 1)) - 1];
		}
	}
	
	function keydown_handle(event) {
		return;
	}
	function keyup_handle(event) {
		return;
	}
	
	function hold_down(event) {
		game.down = true;
		if (!game.firstmove) {
			document.getElementById("status").setAttribute("src", "images/smile_hold.png");
		}
	}
	
	function arrayRemove(arr, value) { 
    
        return arr.filter(function(ele){ 
            return ele != value; 
        });
    }
    
	function click(event) {
		game.down = false;
		if (!game.firstmove) {
			document.getElementById("status").setAttribute("src", "images/smile.png");
		}
		if (isDefined(game.canvas))
		{
			var rect = game.canvas.getBoundingClientRect();
			x = (event.clientX - rect.left) * (game.canvas.width / rect.width);
			y = (event.clientY - rect.top) * (game.canvas.height / rect.height);
			if ((game.mpos[0] == Number(Math.floor(x / game.blocksize + 1)) - 1) &&
			    (game.mpos[1] == Number(Math.floor(y / game.blocksize + 1)) - 1)) {
				var rightclick;
				if (event.which) rightclick = (event.which == 3);
				else if (event.button) rightclick = (event.button == 2);
				var flagged = false;
				game.flags.forEach(flag => {
					if ((flag[0] == game.mpos[0]) && (flag[1] == game.mpos[1])) {
						flagged = true;
					}
				});
				if (!rightclick) {
					if (!flagged) {
						game.open(game.mpos[0], game.mpos[1]);
					}
				} else {
					if (!game.blocks[game.mpos[1]][game.mpos[0]]) {
						if (!flagged) {
							game.flags.push([game.mpos[0], game.mpos[1]]);
						} else {
							for (var i = 0; i < game.flags.length; i++) {
								if ((game.flags[i][0] == game.mpos[0]) && (game.flags[i][1] == game.mpos[1])) {
									game.flags.splice(i, 1);
								}
							}
							game.flags = arrayRemove(game.flags, [game.mpos[0], game.mpos[1]]);
						}
					}
				}
			}
		}
	}
	
	function setDifficulty() {
			switch (document.getElementById("difficulty").value) {
				case "easy":
					document.getElementById("width").setAttribute("value", "9");
					document.getElementById("height").setAttribute("value", "9");
					document.getElementById("mines").setAttribute("value", "10");
					document.getElementById("cnvsize").setAttribute("value", "24");
					break;
				case "intermediate":
					document.getElementById("width").setAttribute("value", "16");
					document.getElementById("height").setAttribute("value", "16");
					document.getElementById("mines").setAttribute("value", "40");
					document.getElementById("cnvsize").setAttribute("value", "48");
					break;
				case "expert":
					document.getElementById("width").setAttribute("value", "24");
					document.getElementById("height").setAttribute("value", "24");
					document.getElementById("mines").setAttribute("value", "99");
					document.getElementById("cnvsize").setAttribute("value", "72");
					break;
			}
			document.getElementById("widthstr").innerHTML = document.getElementById("width").getAttribute("value");
			document.getElementById("heightstr").innerHTML = document.getElementById("height").getAttribute("value");
			document.getElementById("minesstr").innerHTML = document.getElementById("mines").getAttribute("value");
			document.getElementById('canvas_size').innerHTML = document.getElementById('cnvsize').value + '%';
			document.getElementById('minesweeper').setAttribute('style', 'margin: auto; width: ' + document.getElementById('cnvsize').value + '%');
			game.close();
			game.init(document.getElementById('width').value, document.getElementById('height').value, document.getElementById('mines').value);
	}
	
	function handleMouseMove(event) {
		if (grab) {
			document.getElementById("minesweeper").style["left"] = String(event.clientX - 200) + "px";
			document.getElementById("minesweeper").style["top"] = String(event.clientY - 5) + "px";
		}
	}
	
	document.onmousemove = handleMouseMove;
    window.addEventListener("mousemove", update_location, true);
    window.addEventListener("mousedown", hold_down, true);
    window.addEventListener("mouseup", click, true);
    setInterval(function() {
			if (!game.firstmove) {
				game.secs++;
			}
		}, 1000);
</script>
<h1>Wrapsweeper</h1>
<div id="minesweeper" style="width: 24%;" class="window" >
	<div class="windowtitle" onclick="grab=false;" onmousedown="grab = true;">Wrapsweeper</div>
	<div class="windowcontents">
		<div>
			<a onclick="game.close(); game.init(document.getElementById('width').value, document.getElementById('height').value, document.getElementById('mines').value);">
				<img class="smile" id="status" src="images/smile.png"/>
			</a>
		</div>
		<div class="osd" style="display: inline-block; margin-top: -80px;">
			<div class="s7s">
				<input id="m100" value='0' hidden/>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
			</div>
			<div class="s7s">
				<input id="m10" value='1' hidden/>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
			</div>
			<div class="s7s">
				<input id="m1" value='0' hidden/>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
			</div>
		</div>
		<div class="osd" style="display: inline-block; float:right; margin-top: -50px;">
			<div class="s7s">
				<input id="t100" value='0' hidden/>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
			</div>
			<div class="s7s">
				<input id="t10" value='0' hidden/>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
			</div>
			<div class="s7s">
				<input id="t1" value='0' hidden/>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
				<seg></seg>
			</div>
		</div>
		<div id="start" style="margin: auto;"></div>
	</div>
</div>
<p>Raskusaste: 
<select id="difficulty" onchange="setDifficulty();">
	<option value="easy" selected>
		Algaja (9x9, 10 miini)
	</option>
	<option value="intermediate" >
		Edasij??udnud (16x16, 40 miini)
	</option>
	<option value="expert">
		Ekspert (24x24, 99 miini)
	</option>
</select></p>
Laius: <input type="range" min="9" max="100" value="9" id="width" onchange="document.getElementById('widthstr').innerHTML = document.getElementById('width').value;"/><div id="widthstr">9</div>
K??rgus: <input type="range" min="9" max="100" value="9" id="height" onchange="document.getElementById('heightstr').innerHTML = document.getElementById('height').value;"/><div id="heightstr">9</div>
Miinid: <input type="range" min="0" max="200" value="10" id="mines"  onchange="document.getElementById('minesstr').innerHTML = document.getElementById('mines').value;"/><div id="minesstr">10</div>
M??nguakna suurus: <input type="range" min="1" max="100" value="24" id="cnvsize"  onchange="document.getElementById('canvas_size').innerHTML = document.getElementById('cnvsize').value + '%';
																							document.getElementById('minesweeper').setAttribute('style', 'margin: auto; width: ' + document.getElementById('cnvsize').value + '%');"/><div id="canvas_size">24%</div>
<p>Re??iim: 
<select id="modeselect">
	<option value="wrapfield" selected>
		M??hkiv
	</option>
	<option value="classic" >
		Klassikaline
	</option>
	<option value="unlosable">
		V??imatu kaotada
	</option>
	<option value="unbeatable">
		V??imatu v??ita
	</option>
</select></p>
<h2>Kuidas m??ngida?</h2>
<p>M??ng on avatud liigutatavas aknas. Akna p??ises on m??ngu nimi, miinide arv (vasak segmentkuva), uuesti alustamise
nupp (n??gu), kulunud aeg (parem segmentkuva). Kl??psake n??opildiga nuppu, et alustada uus m??ng praeguste seadistustega.
??lej????nud akna moodustab ruudustik. Aeg hakkab jooksma, kui kl??psate esimest ruutu. Akna liigutamiseks on vajalik
arvutihiir v??i puutepadi.</p>
<h3>Miinide otsimine</h3>
<p>M??ngu eesm??rgiks on kl??psate k??iki ruute, millel pole miine. Esimene ruut, mida kl??psate, on alati ohutu.
Numbritega ruudud n??itavad mitu miini on selle ruudu naaberruutudel. V??imalik, et peate alguses kl??psama
juhuslikke ruute enne kui saate mingisuguseid strateegiaid rakendada. Kui olete kindel, et kindlal ruudul
asub miin, saate sellel ruudul paremkl??psata, et sinna paigutada lipp. P??rast lipu paigutamist, v??heneb number
vasakul segmentkuval ja lipuga t??histatud ruutu ei saa enam avada (v.a. kui uuesti paremklikkida, et t??histada
t??histus).</p>
<h3>M??ngure??iimid</h3>
<p>Te saate m??ngure??iimi muuta vastava rippmen???? abil. Wrapsweeperis on j??rgmised m??ngure??iimid:</p>
<ul>
	<li>M??hkiv (vaikere??iim) - Klassikalise re??iimi reeglid, kuid ????rtes asuvad numbrid t??histavad ka ruudustiku teisel poolel olevaid ruute ning nurkadel olevad numbrid ka vastasnurgal olevaid ruute.</li>
	<li>Klassikaline - Numbrid t??histavad naaberruutude arvu, mis on miinid. ????resolevad numbreid ei m??hita teistele pooltele.</li>
	<li>V??imatu kaotada - Nagu klassikaline re??iim, aga miinil kl??psates paigutatakse see kohe kuhugi mujale</li>
	<li>V??imatu v??ita - K??ik ruudud on miinid. Kui kl??psate mingisugusel ruudul, siis kaotate</li>
</ul>
<h3>Kaotamine</h3>
<p>Kui kaotate, avatakse k??ik ruudud ning kuvatakse k??igi miinide asukohad. Korrektselt t??histatud miinid muutuvad
roheliseks. Valesti t??histatud asukohad j????vad punaseks. T??histamata miinid j????vad mustaks. Kui kaotate, muutub
r????mun??gu kurvaks ja silmade asemel kuvatakse ristid (t??histab, et astusite miini otsa). Parem segmentkuva
peatatakse. Et uuesti proovida, saate kl??psata n????d kurba n??gu.</p>
<h3>V??itmine</h3>
<p>Kui v??idate, avatakse k??ik ruudud ning r????mun??o ette ilmuvad p??ikeseprillid. K??ik m??rgitud miinide asukohad
muutuvad roheliseks. Et alustada uut m??ngu, saate kl??psata p??ikeseprillidega r????mun??gu.</p>
<h3>Raskusastme muutmine</h3>
<p>Kui arvate, et olete m??ngus piisavalt hea, saate valida k??rgema raskusastme. Raskusastet saab valida
vastava rippmen???? abil. Raskusastmed on j??rgmised:</p>
<ul>
	<li>Algaja - 81 ruutu, 10 miini (12,3% miinid)</li>
	<li>Edasij??udnud - 256 ruutu, 40 miini (15,6% miinid)</li>
	<li>Ekspert - 576 ruutu, 99 miini (17,2% miinid)</li>
	<li>Kohandatud - saate kasutada vastavaid ligureid nende attribuutide muutmiseks</li>
</ul>
<p><span style="color: #ff0">Pange t??hele</span>: Kui aken on liiga suur v??i liiga v??ike, saate selle suurust muuta vastava liuguri abil.</p>
<script>
	game.init(9, 9, 10);
</script>
