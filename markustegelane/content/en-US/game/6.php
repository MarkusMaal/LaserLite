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
<p>Difficulty level: 
<select id="difficulty" onchange="setDifficulty();">
	<option value="easy" selected>
		Beginner
	</option>
	<option value="intermediate" >
		Intermediate
	</option>
	<option value="expert">
		Expert
	</option>
</select></p>
Width: <input type="range" min="9" max="100" value="9" id="width" onchange="document.getElementById('widthstr').innerHTML = document.getElementById('width').value;"/><div id="widthstr">9</div>
Height: <input type="range" min="9" max="100" value="9" id="height" onchange="document.getElementById('heightstr').innerHTML = document.getElementById('height').value;"/><div id="heightstr">9</div>
Mines: <input type="range" min="0" max="200" value="10" id="mines"  onchange="document.getElementById('minesstr').innerHTML = document.getElementById('mines').value;"/><div id="minesstr">10</div>
Game window size: <input type="range" min="1" max="100" value="24" id="cnvsize"  onchange="document.getElementById('canvas_size').innerHTML = document.getElementById('cnvsize').value + '%';
																							document.getElementById('minesweeper').setAttribute('style', 'margin: auto; width: ' + document.getElementById('cnvsize').value + '%');"/><div id="canvas_size">24%</div>
<p>Mode: 
<select id="modeselect">
	<option value="wrapfield" selected>
		Wrapfield
	</option>
	<option value="classic" >
		Classic
	</option>
	<option value="unlosable">
		Unlosable
	</option>
	<option value="unbeatable">
		Impossible
	</option>
</select></p>
<h2>How to play?</h2>
<p>The game is open in a movable window. The window header consists of the name of the game, mine count (left segment
display), reset button (face), time elapsed (right segment display). Click on the fast to start a new game with
current settings. The rest of the window consists of a grid. The time starts, if you click on the first square.
In order to move the game window, you need a mouse or a touchpad.</p>
<h3>Sweeping mines</h3>
<p>The goal of this game is to click every square, which doesn't have a mine. The first square, that you click on,
is always safe. The numbers on each square show how many mines are on neighbouring squares. It's possible that you
have to click random squares at the beginning, before you can use any strategies. If you are sure, that a specific
square is actually a mine, you can right click to flag it. After flagging the square, the number on the left
segment display decreases and you won't be able to click on the square anymore (unless right click it again to unflag it).
</p>
<h3>Game modes</h3>
<p>You can change the game mode with a designated dropdown menu. Wrapsweeper has the following game modes:</p>
<ul>
	<li>Wrapfield (default) - Classic mode rules apply, but numbers displayed on the edges, also count the squares on the other side aswell, and the cornering squares also refer to opposite corners.</li>
	<li>Classic - Numbers display the number of neighbouring squares, which are mines. Numbers on the edge won't be wrapped to the other side.</li>
	<li>Unlosable - Similar to classic mode, but if you click on a mine, it'll be put somewhere else</li>
	<li>Impossible - All squares are mines. If you click on a square, you lose</li>
</ul>
<h3>Losing</h3>
<p>If you lose, all squares will be open and all mine locations will be displayed. Correctly flagged mines will turn
green. Incorrectly flagged mines will stay red. Unassigned mines stay black. If you lose, the smile will
turn into a sad face and the eyes will be replaced by crosses (which means you stepped on a mine). The right segment
display will be frozen. To try again, you can click on the sad face.</p>
<h3>Winning</h3>
<p>If you win, all squares will be open and sunglasses will appear in front of the smile. All marked mines will turn
green. To start a new game, click on the face with sunglasses.</p>
<h3>Changing the difficulty level</h3>
<p>If you think that you are skilled enough, you can choose a higher difficulty level. You can choose the
difficulty with a designated dropdown list. Difficulty levels are as follows:</p>
<ul>
	<li>Beginner - 81 squares, 10 mines (12.3% mines)</li>
	<li>Intermediate - 256 squares, 40 mines (15.6% mines)</li>
	<li>Expert - 576 squares, 99 mines (17.2% mines)</li>
	<li>Custom - you can use the designated sliders to change these attributes</li>
</ul>
<p><span style="color: #ff0">Note</span>: If the window is too big or too small, you can adjust the size with a designated slider.</p>
<script>
	game.init(9, 9, 10);
</script>
