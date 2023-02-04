<script>
	
	class Obstacle {
		constructor(x, y, w, h, c) {
			this.x = x;
			this.y = y;
			this.w = w;
			this.h = h;
			this.c = c;
			this.ani = 0;
		}
		
		
		Collides(x, y, r) {
			if ((x > this.x - (r / 2)) && (x < this.x + this.w + (r / 2)) &&
				(y > this.y - (r / 2)) && (y < this.y + this.w + (r / 2))) {
					return true;
			}
			return false;
		}
		
		Draw(context) {
			context.fillStyle = this.c;
			context.fillRect(this.x, this.y, this.w, this.h);
		}
		
	}
	
	class Ball {
		constructor(x, y, r, c) {
			this.f_x = 0;
			this.f_y = 0;
			this.x = x;
			this.y = y;
			this.g = 1;
			this.b = 100;
			this.r = r;
			this.c = c;
			this.p_y = 1;
			this.p_x = 1;
			this.direction = this.Neg(this.x);
			this.rects = [];
		}
		
		
		AddRect(obs_clo) {
			this.rects.push(obs_clo);
		}
		
		Neg(val) {
			if (val < 0) {
				return -1;
			} else {
				return 1
			}
		}
		
		Abs(val) {
			if (val < 0) {
				return -val;
			} else {
				return val;
			}
		}
		
		Update(bounds) {
			if (this.b > 1) {
				this.y += (this.f_y / this.p_y);
			}
			if ((this.f_y == 0) && (this.y < bounds[1] - this.r) && (!this.Collides())) {
				this.f_y = 1;
			}
			if (this.direction == 1) {
				this.x += (this.f_x * 10/ this.p_x);
			} else {
				this.x -= (this.f_x * 10/ this.p_x);
			}
			if ((this.y > bounds[1]) || (this.Collides())) {
				if ((!this.Collides()) && (this.y > bounds[1] - this.r)) {
					this.y = bounds[1] - this.r;
				}
				this.f_y = -this.f_y * this.b;
				this.p_y = 1;
			}
			else if ((this.f_y < 0) && (this.p_y < 1)) {
				this.f_y = -this.f_y * this.b;
				this.b /= 2;
				this.p_y = 1;
			} else if ((-2 < (this.f_y / this.p_y)) && ((this.f_y / this.p_y) < 0)) {
				this.f_y = 1;
				this.b /= 2;
				this.p_y = 1;
			}
			if (this.f_y > 0) {
				this.p_y /= 1.5;
			} else {
				this.p_y *= 2;
			}
			this.p_x *= this.direction * 1.1;
			if (this.x > bounds[0] - this.r) {
				this.f_x = -this.f_x;
				this.x = bounds[0] - this.r;
				this.direction = -1;
			} else if (this.x < this.r) {
				this.f_x = -this.f_x;
				this.x = this.r;
				this.direction = 1;
			}
			
		}
		
		Nudge(x1, y1) {
			this.p_y = 1;
			this.b = 100;
			this.p_x = 1;
			this.f_x = x1;
			this.f_y = y1;
		}
		Collides () {
			for (var i = 0; i < this.rects.length; i++) {
				if (this.rects[i].Collides(this.x, this.y, this.r)) {
					this.y = this.rects[i].y - this.r;
					return true;
				}
			}
			return false;
		}
		Draw(context) {
			context.fillStyle = "#fff";
			context.beginPath();
			context.arc(this.x, this.y, this.r / 2, 0, 2 * Math.PI);
			context.fill();
		}
	}
	var game = {
		canvas : document.createElement("canvas"),
		init : function() {
			  this.canvas = document.createElement("canvas");
			  this.canvas.width = 320;
			  this.canvas.height = 480;
			  this.context = this.canvas.getContext("2d");
			  var ctx = this.canvas.getContext("2d");
			  var myPara = this.canvas;
			  var mychild = document.getElementById("start");
			  mychild.appendChild(myPara);
			  this.ball = new Ball(0, 0, 10, "#fff");
			  this.ball.Nudge(-3, 0);
			  this.randRect = new Obstacle(50, 200, 100, 20, "#fff");
			  this.ball.AddRect(this.randRect);
			  this.interval = setInterval(this.update, 16);
		},
		update : function() {
			game.ball.Update([game.canvas.width, game.canvas.height]);
			game.screen();
		},
		screen : function() {
			game.context.fillStyle = "#000";
			game.context.fillRect(0, 0, game.canvas.width, game.canvas.height);
			game.ball.Draw(game.context);
			game.randRect.Draw(game.context);
		}
	}
</script>
<h2>Mäng 7</h2>
<div id="start">
</div>
<script>
	game.init();
</script>
