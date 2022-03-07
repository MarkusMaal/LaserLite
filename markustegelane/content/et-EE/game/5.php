	<h1>Lõpmatus</h1>
	<script>
	  function keydown_handle(event) {
		if(["Space","ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(event.code) > -1) {
			event.preventDefault();
		}
		switch (event.keyCode) {
		  case 32:
			if (game.buttons[1] == 0) {
				game.force = 32;
				game.buttons[1] = 1;
				game.beginforce = 32;
				game.willfall = true;
			}
			if (game.stop) {
				game.reset();
			}
			break;
		  case 38:
			if (game.buttons[1] == 0) {
				game.force = 32;
				game.buttons[1] = 1;
				game.beginforce = 32;
				game.willfall = true;
			}
			break;
		  case 37:
			game.buttons[0] = 1;
			break;
		  case 39:
			game.buttons[2] = 1;
			break;
		}
	  }
	  
	  function keyup_handle(event) {
		  switch (event.keyCode) {
			case 37:
			  game.buttons[0] = 0;
			  game.char_m = 0;
			  break;
			case 39:
			  game.buttons[2] = 0;
			  game.char_m = 0;
			  break;
		  }
	  }
	</script>
	 <div id="start"></div>
	<script>
	  var game = {
		canvas : document.createElement("canvas"),
		init : function() {
			  this.canvas = document.createElement("canvas");
			  this.canvas.width = 280;
			  this.canvas.height = 144;
			  this.canvas.setAttribute("style", "width: 60%; image-rendering: crisp-edges; image-rendering: pixelated;");
			  this.context = this.canvas.getContext("2d");
			  this.context.font = '25px Arial';
			  this.boxes = [0, 1, 0, 0, 1, 1, 0, 1];
			  this.clouds = [];
			  for (var i = 0; i < 10; i++) {
			  	this.clouds.push([Math.floor(Math.random() * this.canvas.width), Math.floor(Math.random() * this.canvas.height)]);
			  }
			  this.offset = 0;
			  this.score = 0;
			  this.single = Math.floor(this.canvas.width / this.boxes.length);
			  this.boxes.push(1);
			  var ctx = this.canvas.getContext("2d");
			  var myPara = this.canvas;
			  var mychild = document.getElementById("start");
			  mychild.appendChild(myPara);
			  this.interval = setInterval(this.recall, 16);
			  /* < ^ > */
			  /* 0 1 2 */
			  this.buttons = [0, 0, 0];
			  this.char_x = this.canvas.width;
			  this.char_y = this.canvas.height - 60;
			  this.char_m = 0;
			  this.force = 0;
			  this.fall = false;
			  this.beginforce = 0;
			  this.speed = 0.5;
			  this.stop = false;
			  this.gradient = game.context.createLinearGradient(0, 0, 0, this.canvas.height);
			  this.plr_gradient = game.context.createLinearGradient(0, 0, this.canvas.width, this.canvas.height);
			  var r = Math.floor(Math.random() * 255);
			  var g = Math.floor(Math.random() * 255);
			  var b = Math.floor(Math.random() * 255);
			  this.background = "rgb(" + r + "," + g  + "," + b  + ")";
			  this.foreground = "rgb(" + (255 - r) + "," + (255 - g)  + "," + (255 - b)  + ")";
			  this.midground = "rgb(" + (255 - r) + "," + g + "," + (255 - b) + ")";
		},
		
		collide : function() {
			var collide = false;
			var char_bounds = [game.char_x];
			for (var i = 0; i < game.boxes.length; i++) {
				if (game.boxes[i] == 1) {
					var box_bounds = [i * game.single - game.offset, i * game.single - game.offset + game.single];
					if ((box_bounds[0] - 15 < game.char_x) && (game.char_x < box_bounds[1] + 5))
					{
						collide = true;
					}
				}
			}
			return collide;
		},
		shift : function(reverse) {
		  if (!game.stop) { game.score++;}
		  var nlist = [];
		  game.offset = 0;
		  if (reverse) {
		  	nlist.push(Math.floor(Math.random() * 2));
		  }
		  for (var i = 1; i < game.boxes.length; i++) {
			nlist.push(game.boxes[i]);
		  }
		  var log = [nlist[nlist.length - 3], nlist[nlist.length - 2], nlist[nlist.length - 1]];
		  if ((log[1] == 0) && (log[2] == 0)) {
		  	if (!reverse) {
		  		nlist.push(1);
			}
			if (!game.stop) {
				game.speed += 0.1;
			}
		  } else {
		  	if ((log[0] == 1) && (log[1] == 1) && (log[2] == 1)) {
			  var r = Math.floor(Math.random() * 255);
			  var g = Math.floor(Math.random() * 255);
			  var b = Math.floor(Math.random() * 255);
			  game.background = "rgb(" + r + "," + g  + "," + b  + ")";
			  game.foreground = "rgb(" + (255 - r) + "," + (255 - g)  + "," + (255 - b)  + ")";
			  game.midground = "rgb(" + (255 - r) + "," + g  + "," + (255 - b)  + ")";
			}
			if (!reverse) {
		  		nlist.push(Math.floor(Math.random() * 2));
			}
		  }
		  game.boxes = nlist;
		},
		
		recall : function() {
		  game.offset += game.speed;
		  game.char_x -= game.speed;
		  if (game.char_y > game.canvas.height - 60) {
			game.char_y = game.canvas.height - 60;
		  }
		  for (var i = 0; i < game.clouds.length; i++) {
		  	game.clouds[i][0] -= (0.25) * game.speed;
			if (game.clouds[i][0] < -30) {
				game.clouds[i][0] = game.canvas.width;
				game.clouds[i][1] = Math.floor(Math.random() * game.canvas.height);
			}
		  }
		  if (game.buttons[0] == 1) {
			game.char_m += 1;
			game.char_x -= game.char_m;
		  } else if (game.buttons[2] == 1) {
			game.char_m += 1;
			game.char_x += game.char_m;
		  }
		  if ((!game.collide()) && (game.force == 0) && (game.char_y >= game.canvas.height - 60)) {
		  	game.fall = true;
			game.force = 64;
			game.beginforce = 64;
			game.gameover();
		  }
		  if (game.fall) {
			game.char_y += game.force;
			game.force *= 2;
			if (game.force > game.beginforce) {
			  	if (game.collide()) {
				  game.fall = false;
				  game.beginforce /= 2;
				  game.force = game.beginforce;
			  	} else {
					if (game.char_y > 256) {
						game.gameover();
					}
				}
			}
			if (game.beginforce < 1) {
			  game.force = 0;
			  game.char_m = 0;
			  game.buttons[1] = 0;
			}
		  } else if (game.force > 0) {
			  game.char_y -= game.force;
			  game.force /= 2;
			  if (game.force < 1) {
				game.fall = true;
			  }
		  }
		  if (game.offset > game.single) {
			game.shift(false);
		  }
		  else if (game.offset < -game.single) {
			game.shift(true);
		  }
		  game.screen();
		  /*if (game.stop) {
		  }*/
		},
		screen : function() {
			game.gradient.addColorStop(0, game.background);
			game.gradient.addColorStop(1, game.midground);
			
			game.plr_gradient.addColorStop(0, game.background);
			game.plr_gradient.addColorStop(0.5, game.foreground);
			game.plr_gradient.addColorStop(1, game.midground);
			
			game.context.fillStyle = game.gradient;
			game.context.fillRect(0, 0, game.canvas.width, game.canvas.height);
			game.context.fillStyle = "#fff6";
			for (var i = 0; i < game.clouds.length; i++) {
			  game.context.fillRect(this.clouds[i][0], this.clouds[i][1], 20, 10);
			}
			game.gradient.addColorStop(0, game.midground);
			game.gradient.addColorStop(1, game.foreground);
			game.context.fillStyle = game.gradient;
			for (var i = 0; i < game.boxes.length; i++) {
			  if (game.boxes[i] == 1) {
				game.context.fillRect(Math.floor(i * game.single - game.offset), game.canvas.height - 30, game.single, 30);
			  }
			}

			game.context.fillStyle = 'black';
			for (var i = 0; i < 2; i++) {
				if (i == 1) {
					game.context.fillStyle = '#fff';
				}
				game.context.fillText(game.score, 10 - i, 26 - i);
			}
			if (game.stop) {
				game.context.fillStyle = 'black';
				game.context.font = "16px Arial";
				for (var i = 0; i < 2; i++) {
					if (i == 1) {
						game.context.fillStyle = '#f00';
					}
					game.context.fillText("Mäng läbi", game.canvas.width / 2 - 38 - i, game.canvas.height / 2 - i);
				}
			} else {
				game.context.fillStyle = game.plr_gradient;
				game.context.fillRect(game.char_x, game.char_y, 15, 30);
			}
			 
		},
		
		gameover : function() {
			game.stop = true;
		},
		
		reset : function() {
			document.getElementById("start").innerHTML = "";
			game.stop = false;
			clearInterval(game.interval);
			game.init();
			document.addEventListener("keydown", keydown_handle(event));
			document.addEventListener("keyup", keyup_handle(event));
		}
	  };
	  game.init();
	</script>
	<h2>Kuidas mängida?</h2>
	<p>Mängu eesmärgiks on hüpata platvormilt platvormile ja jõuda nii kaugele kui võimalik.
	   Kui kukute alla või jääte liiga kauaks seisma, saab mäng läbi. Hüppamiseks ühelt
	   platvormile teisele tuleb hoogu koguda. Hooga hüppeid saab teha kui vajutada
	   hüppamis- ja liikumisklahve korraga (mida kauem liikumisklahvi all hoida, seda
	   suurem on tõuge).</p>
	   
	<p>Mängu saab mängida ainult klaviatuuriga. Kasutatavad klahvid:</p>
	<ul>
		<li>Tühik/Ülemine nooleklahv - Hüppa</li>
		<li>Vasak/Parem nooleklahv - Liigu vasakule/paremale</li>
		<li>Tühik - Kui mäng saab läbi, on võimalik vajutada tühikut, et uuesti proovida</li>
	</ul>
	
	<p>Mängu ajal kuvatakse teie skoor üleval vasakus nurgas. Kui mäng saab läbi, ilmub ekraanile
	   tekst &quot;Mäng läbi&quot; ning tegelast ei saa enam juhtida.</p>
