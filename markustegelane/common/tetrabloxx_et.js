const getCookie = (c_name) => 
{
    var i,x,y,ARRcookies=document.cookie.split(";");

    for (i=0;i<ARRcookies.length;i++)
    {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name)
        {
            return unescape(y);
        }
     }
}
let game = {
	cnv : document.createElement("canvas"),
	init : () => {
		this.cnv = document.createElement("canvas")
		this.cnv.width = 260
		this.cnv.height = 481
		this.blockCnv = document.createElement("canvas")
		this.blockCnv.width = 140
		this.blockCnv.height = 80
		this.bcontext = this.blockCnv.getContext("2d")
		this.context = this.cnv.getContext("2d")
		let r = Math.floor(Math.random() * 95)
		let g = Math.floor(Math.random() * 95)
		let b = Math.floor(Math.random() * 95)
		document.querySelector("#rightpanel").style.background = `rgb(${r}, ${g}, ${b})`
		document.querySelector("#gamewindow").appendChild(this.cnv)
		document.querySelector("#nextblock").appendChild(this.blockCnv)
		r = 160 + Math.floor(Math.random() * 95)
		g = 160 + Math.floor(Math.random() * 95)
		b = 160 + Math.floor(Math.random() * 95)
		this.background = `rgb(${r}, ${g}, ${b})`
		this.gfxmode = getCookie("gfx")
		if (this.gfxmode == undefined) { this.gfxmode = "nice"; }
		this.shine = null
		if (this.gfxmode == "nice") {
			this.shine = this.context.createRadialGradient(0, 0, 1, 0, 0, this.cnv.width)
			this.shine.addColorStop(0, "#fffe")
			this.shine.addColorStop(1, "#fff0")
		}
		this.highscore = 0;
		this.paused = true;
		this.gameover = false;
		let lsHs = localStorage.getItem("tb_Hs")
		if (lsHs != null) {
			highscore = lsHs
		}
		this.interval = setInterval(game.loop, 16)
		this.box_size = 20
		this.bgrid = []
		this.score = 0
		this.playmusic = getCookie("soundmode")
		if (this.playmusic == undefined) {
			this.playmusic = "all"
		}
		if (this.playmusic == "all") { document.querySelector("#bgm").volume = 0.25; }
		for (let y = 0; y < this.cnv.height / this.box_size - 1; y ++) {
			let gridline = []
			for (let x = 0; x < this.cnv.width / this.box_size; x ++) {
				gridline.push(this.background)
			}
			this.bgrid.push(gridline)
		}
		document.querySelector("#pauseButton").style.display = "none"
		floating_brick.init()
	},
	
	getOver : () => {
		return this.gameover
	},
	
	getMusic : () => {
		return this.playmusic
	},
	
	over : () => {
		document.querySelector("#next").innerHTML = "Mäng läbi"
		document.querySelector("#pauseButton").style.display = "none"
		if (this.playmusic != "none") {
			document.querySelector("#gameover").play()
		}
		if (this.playmusic == "all") {
			document.querySelector("#bgm").pause()
			document.querySelector("#bgm").src = ""
			let findrand = Math.floor(Math.random() * 6) + 1
			document.querySelector("#bgm").src = `music/bgm${findrand}.mp3`
		}
		this.gameover = true;
	},
	
	checkCollides : (fgrid, fpos, off_y, off_x) => {
		for (let n = 0; n < fgrid.length; n++) {
			for (let m = 0; m < fgrid[0].length; m++) {
				if ((fpos[1] + n + off_y > -1) && (fpos[1] + n + off_y < this.bgrid.length) && (fpos[0] + m + off_x > -1) && (fpos[0] + m + off_x < bgrid[0].length)) {
					if ((this.bgrid[fpos[1] + n + off_y][fpos[0] + m + off_x] != this.background) && (fgrid[n][m] == 1)) {
						return true;
					}
				} else {
					if (fpos[1] + n + off_y >= this.bgrid.length) {
						return true;
					} else if (fpos[0] + m + off_x < bgrid[0].length) {
						return true;
					}
					break;
				}

			}
		}
		return false
	},
	
	randomColors : () => {
		let r = Math.floor(Math.random() * 95)
		let g = Math.floor(Math.random() * 95)
		let b = Math.floor(Math.random() * 95)
		document.querySelector("#rightpanel").style.background = `rgb(${r}, ${g}, ${b})`
		document.querySelector("#gamewindow").appendChild(this.cnv)
		r = 160 + Math.floor(Math.random() * 95)
		g = 160 + Math.floor(Math.random() * 95)
		b = 160 + Math.floor(Math.random() * 95)
		let last_ground = this.background
		this.background = `rgb(${r}, ${g}, ${b})`
		for (let y = 0; y < this.bgrid.length; y++) {
			for (let x = 0; x < this.bgrid[0].length; x++) {
				if (this.bgrid[y][x] == last_ground) {
					this.bgrid[y][x] = this.background
				}
			}
		}
	},
	
	saveScores : () => {
		localStorage.setItem("tb_Hs", this.score)
	},
	addGrid : (fcol, fgrid, fpos) => {
		if (game.checkCollides(fgrid, fpos, 1, 0)) {
			
			if (this.playmusic != "none") {
				document.querySelector("#block").play()
			}
			this.score += 1
			if (this.score > this.highscore) {
				this.highscore = this.score
				game.saveScores()
			}
			for (let n = 0; n < fgrid.length; n++) {			
				if ((n > 3)) {
					break;
				}
				for (let m = 0; m < fgrid[0].length; m++) {
					if (!((fpos[1] + n < 0) || (fpos[0] + m < 0))) {							
						if (fgrid[n][m] == 1) {
							this.bgrid[fpos[1] + n][fpos[0] + m] = `rgb(${fcol[0]}, ${fcol[1]}, ${fcol[2]})`
						}
					}
				}
			}
		}
	},
	getScore : () => {
		return this.score
	},
	getGrid : () => {
		return this.bgrid
	},
	
	getSpeed : () => {
		return Math.ceil(10 - this.score / 100)
	},
	
	getBg : () => {
		return this.background
	},
	
	getBoxSize : () => {
		return this.box_size
	},
	
	getCnv: () => {
		return this.cnv
	},
	
	screen : () => {
		if (!this.gameover) {
			this.bcontext.fillStyle = document.querySelector("#rightpanel").style.background
			this.bcontext.fillRect(0, 0, this.blockCnv.width, this.blockCnv.height)
			let nextcolor = [255, 255, 255]
			let nextgrid = []
			switch (this.next) {
				case 0:
					nextcolor = [255, 255, 0]
					nextgrid = [[1, 1],
								 [1, 1]]
					break;
				case 1:
					nextcolor = [255, 180, 0]
					nextgrid = [[1, 0],
								 [1, 0],
								 [1, 1]]
					break;
				case 2:
					nextcolor = [0, 0, 255]
					nextgrid = [[0, 1],
								 [0, 1],
								 [1, 1]]
					break;
				case 3:
					nextcolor = [0, 255, 255]
					nextgrid = [[1],
							[1],
							[1],
							[1]]
					break;
				case 4:
					nextcolor = [0, 255, 0]
					nextgrid = [[0,1,1],
								 [1,1,0]]
					break;
				case 5:
					nextcolor = [255, 0, 0]
					nextgrid = [[1,1,0],
								 [0,1,1]]
					break;
				case 6:
					nextcolor = [128, 0, 255]
					nextgrid = [[1,1,1],
								 [0,1,0]]
					break;
			}
		
			for (let y = 1 * this.box_size; y < this.box_size + this.box_size * (nextgrid.length); y+= this.box_size) {
				for (let x = 1 * this.box_size; x < 1 * this.box_size + this.box_size * (nextgrid[0].length); x+= this.box_size) {
					let bx = Math.round(x / this.box_size - 1)
					let by = Math.round(y / this.box_size - 1)
					if (nextgrid[by][bx] == 1) {
						let fBb = [nextcolor[0] - 100, nextcolor[1] - 100, nextcolor[2] - 100];
						if (fBb[0] < 0) { fBb[0] = 0 }
						if (fBb[1] < 0) { fBb[1] = 0 }
						if (fBb[2] < 0) { fBb[2] = 0 }
						this.bcontext.fillStyle = `rgb(${fBb[0]}, ${fBb[1]}, ${fBb[2]})`
						this.bcontext.fillRect(x, y - this.box_size, this.box_size, this.box_size)
						this.bcontext.fillStyle = `rgb(${nextcolor[0]}, ${nextcolor[1]}, ${nextcolor[2]})`
						this.bcontext.fillRect(x + 2, y + 2 - this.box_size, this.box_size - 4, this.box_size - 4)
						if (this.gfxmode == "nice") {
							let shine = this.bcontext.createRadialGradient(x + 5, y + 5 - this.box_size, 1, x + 5, y + 5 - this.box_size, 5);
							shine.addColorStop(0, "#fffc");
							shine.addColorStop(1, "transparent");
							this.bcontext.fillStyle = shine
						}
						this.bcontext.fillRect(x + 2, y + 2 - this.box_size, this.box_size / 4, this.box_size / 4)
					}
				}
			}
		}
		this.context.fillStyle = this.background
		this.context.fillRect(0, 0, this.cnv.width, this.cnv.height)
		this.context.fillStyle = this.shine
		this.context.fillRect(0, 0, this.cnv.width, this.cnv.height)
		for (let y = 0; y < this.bgrid.length; y++) {
			for (let x = 0; x < this.bgrid[0].length; x++) {
				if (this.bgrid[y][x] != this.background) {
					let fAc = this.bgrid[y][x].replace(", ", ",").replace("rgb(", "").replace(")", "").split(",")
					let fBb = [Number(fAc[0]) - 100, Number(fAc[1]) - 100, Number(fAc[2]) - 100];
					if (fBb[0] < 0) { fBb[0] = 0 }
					if (fBb[1] < 0) { fBb[1] = 0 }
					if (fBb[2] < 0) { fBb[2] = 0 }
					this.context.fillStyle = `rgb(${fBb[0]}, ${fBb[1]}, ${fBb[2]})`
					this.context.fillRect(x * this.box_size, y * this.box_size, this.box_size, this.box_size)
					this.context.fillStyle = this.bgrid[y][x]
					this.context.fillRect(x * this.box_size + 2, y * this.box_size + 2, this.box_size - 4, this.box_size - 4)
					if (this.gfxmode == "nice") {
						let shine = this.context.createRadialGradient(x * this.box_size + 5, y * this.box_size + 5, 1, x * this.box_size + 5, y * this.box_size + 5, 5);
						shine.addColorStop(0, "#fffc");
						shine.addColorStop(1, "transparent");
						this.context.fillStyle = shine
					}
					this.context.fillRect(x * this.box_size + 2, y * this.box_size + 2, this.box_size / 4, this.box_size / 4)
				}
			}
		}
		let fBc = floating_brick.getColor()
		let fBg = floating_brick.getGrid()
		let fBp = floating_brick.getPosition()
		for (let y = fBp[1] * this.box_size; y < fBp[1] * this.box_size + this.box_size * (floating_brick.getGrid().length); y+= this.box_size) {
			for (let x = fBp[0] * this.box_size; x < fBp[0] * this.box_size + this.box_size * (floating_brick.getGrid()[0].length); x+= this.box_size) {
				let bx = Math.round(x / this.box_size - fBp[0])
				let by = Math.round(y / this.box_size - fBp[1])
				if (((by > -1) && (by < fBg.length)) && ((bx > -1) && (bx < fBg[0].length))) {
					if (fBg[by][bx] == 1) {
						let fBb = [fBc[0] - 100, fBc[1] - 100, fBc[2] - 100];
						if (fBb[0] < 0) { fBb[0] = 0 }
						if (fBb[1] < 0) { fBb[1] = 0 }
						if (fBb[2] < 0) { fBb[2] = 0 }
						this.context.fillStyle = `rgb(${fBb[0]}, ${fBb[1]}, ${fBb[2]})`
						this.context.fillRect(x, y, this.box_size, this.box_size)
						this.context.fillStyle = `rgb(${fBc[0]}, ${fBc[1]}, ${fBc[2]})`
						this.context.fillRect(x + 2, y + 2, this.box_size - 4, this.box_size - 4)
						if (this.gfxmode == "nice") {
							let shine = this.context.createRadialGradient(x + 5, y + 5, 1, x + 5, y + 5, 5);
							shine.addColorStop(0, "#fffc");
							shine.addColorStop(1, "transparent");
							this.context.fillStyle = shine
						}
						this.context.fillRect(x + 2, y + 2, this.box_size / 4, this.box_size / 4)
					}
				}
			}
		}
	},
	
	loop : () => {
		if (!this.paused) {
			
			game.sandcastle_check()
			floating_brick.fall()
			game.screen()
			document.querySelector("#score").innerHTML = `Skoor: ${this.score}<br/>Tippskoor: ${this.highscore}`
		}
	},
	
	sandcastle_check : () => {
		for (let y = 0; y < this.bgrid.length; y++) {
			let blocks = 0;
			for (let x = 0; x < this.bgrid[0].length; x++) {
				if (this.bgrid[y][x] != this.background) {
					blocks += 1;
				}
			}
			if (blocks == this.bgrid[0].length) {
				this.score += this.bgrid[0].length
				if (this.playmusic != "none") {
					document.querySelector("#line").play()
				}
				if (this.score > this.highscore) {
					this.highscore = this.score
					game.saveScores()
				}
				for (let z = y; z > 0; z--) {
					bgrid[z] = bgrid[z - 1].slice();
				}
				let gridline = []
				for (let x = 0; x < this.cnv.width / this.box_size; x ++) {
					gridline.push(this.background)
				}
				this.bgrid[0] = gridline
			}
		}
	},
	
	reset : () => {
		
		if (this.playmusic == "all") {
			document.querySelector("#bgm").play(-1)
		}
		document.querySelector("#next").innerHTML = "Järgmine"
		document.querySelector("#pauseButton").style.display = "inline"
		this.gameover = false
		if (this.paused) {
			this.paused = false
		}
		this.bgrid = []
		for (let y = 0; y < this.cnv.height / this.box_size - 1; y ++) {
			let gridline = []
			for (let x = 0; x < this.cnv.width / this.box_size; x ++) {
				gridline.push(this.background)
			}
			this.bgrid.push(gridline)
		}
		this.score = 0
	},
	
	pause : () => {
		if (this.paused) {
			document.querySelector("#next").innerHTML = "Järgmine"
			this.paused = false
			if (this.playmusic == "all") {
				document.querySelector("#bgm").play()
			}
			document.querySelector("#pauseButton").innerHTML = "Paus"
		} else {
			this.paused = true
			if (this.playmusic == "all") {
				document.querySelector("#bgm").pause()
			}
			document.querySelector("#pauseButton").innerHTML = "Jätka"
		}
	}
}

let floating_brick = {
	init: () => {
		this.grid = [[1],
				[1],
				[1],
				[1]]
		this.color = [0, 255, 255]
		this.position = [0, 0]
		this.fakeposition = [0, 0]
		this.angle = 0
		this.delay = 0
		this.maxdelay = game.getSpeed()
		this.fast = false
		this.next = Math.floor(Math.random() * 7)
		this.pastfirstframe = false
	},
	fallFast: () => {
		this.fast = true
	},
	stopFallFast: () => {
		this.fast = false
	},
	getColor: () => { return this.color },
	getGrid: () => { return this.grid },
	getPosition: () => { return this.fakeposition },
	getRealPosition: () => { return this.position },
	
	rotate: () => {
		if (!game.checkCollides(this.grid, this.position, 1, 0)) {
			let result = [];
			this.grid.forEach(function (a, i, aa) {
				a.forEach(function (b, j, bb) {
					result[bb.length - j - 1] = result[bb.length - j - 1] || []
					result[bb.length - j - 1][i] = b
				})
			})
			this.grid = result;
			if (this.position[0] > (game.cnv.width / game.getBoxSize()) - this.grid[0].length) {
				this.position[0] = (game.cnv.width / game.getBoxSize()) - this.grid[0].length
			} else if (this.position[0] < 0) {
				this.position[0] = 0
			}
		}
	},
	
	fall: () => {
		if (game.getOver()) {
			return
		}
		if ((this.delay == this.maxdelay) || this.fast) {
			let lastspeed = this.maxdelay
			this.maxdelay = game.getSpeed()
			if (this.maxdelay != lastspeed) {
				if (this.playmusic == "sfx") {
					document.querySelector("#levelup").play()
				}
				game.randomColors()
			}
			if ((this.position[1] < game.getCnv().height / game.getBoxSize() - this.grid.length - 1) && (!game.checkCollides(this.grid, this.position, 1, 0))) {
				this.position[1] += 1
				this.fakeposition[0] = position[0]
				this.fakeposition[1] = position[1]
				this.pastfirstframe = true
			} else {
				game.addGrid(this.color, this.grid, this.position)
				if (this.pastfirstframe == false) {
					game.over()
					return
				}
				floating_brick.randomize()
			}
			this.delay = 0
		} else {
			this.delay += 1
			if ((game.checkCollides(this.grid, this.position, 1, 0))) {
				this.fakeposition[1] = this.position[1]
			} else {
				this.fakeposition[1] += 1/this.maxdelay
			}
		}
		document.querySelector("#debug_speed").innerHTML = "Tasand: " + String(11 - game.getSpeed())
		//document.querySelector("#debug_pos").innerHTML = "Positsioon: " + this.position
		//document.querySelector("#debug_fpos").innerHTML = "Visuaalne positsioon: <br/>" + this.fakeposition
	},
	randomize: () => {
		this.position[1] = 0
		this.position[0] = Math.floor(Math.random() * ((game.cnv.width / game.getBoxSize()) - 4))
		let rblock = this.next
		this.next = Math.floor(Math.random() * 7)
		this.pastfirstframe = false
		this.fakeposition[0] = this.position[0]
		this.fakeposition[1] = this.position[1]
		this.angle = 0
		switch (rblock) {
			case 0:
				this.color = [255, 255, 0]
				this.grid = [[1, 1],
							 [1, 1]]
				break;
			case 1:
				this.color = [255, 180, 0]
				this.grid = [[1, 0],
							 [1, 0],
							 [1, 1]]
				break;
			case 2:
				this.color = [0, 0, 255]
				this.grid = [[0, 1],
							 [0, 1],
							 [1, 1]]
				break;
			case 3:
				this.color = [0, 255, 255]
				this.grid = [[1],
						[1],
						[1],
						[1]]
				break;
			case 4:
				this.color = [0, 255, 0]
				this.grid = [[0,1,1],
							 [1,1,0]]
				break;
			case 5:
				this.color = [255, 0, 0]
				this.grid = [[1,1,0],
							 [0,1,1]]
				break;
			case 6:
				this.color = [128, 0, 255]
				this.grid = [[1,1,1],
							 [0,1,0]]
				break;
		}
	},
	moveX: (dir) => {
		if (game.getOver()) {
			floating_brick.randomize()
			game.reset()
		}
		if (dir == -1) {
			if ((this.position[0] != 0) && (!game.checkCollides(this.grid, this.position, 0, -1))) {
				this.position[0] -= 1
			}
		} else if ((this.position[0] < (game.getCnv().width / game.getBoxSize()) - this.grid[0].length) && (!game.checkCollides(this.grid, this.position, 0, 1))) {
			this.position[0] += 1
		}
		this.fakeposition[0] = this.position[0]
	}
}

function keyDown(e) {
	switch (e.keyCode) {
		case 40:
			//Down
			floating_brick.fallFast()
			break
		case 39:
			//Right
			floating_brick.moveX(1)
			break
		case 38:
			//Up
			floating_brick.rotate()
			break
		case 37:
			//Left
			floating_brick.moveX(-1)
			break
		case 32:
			//Space
			break
		default:
			break
	}
}

function keyUp(e) {
	switch (e.keyCode) {
		case 40:
			//Down
			floating_brick.stopFallFast()
			break
		case 39:
			//Right
			break
		case 38:
			//Up
			break
		case 37:
			//Left
			break
		case 32:
			//Space
			break
		default:
			break
	}
}

const levelup = document.querySelector('#levelup')
const bgm = document.querySelector("#bgm")
if (levelup != null) {
	document.querySelector('#levelup').addEventListener('ended', function(){
		if (this.playmusic == "all") {
			document.querySelector("#bgm").play()
		}
	}, false);
}
if (bgm != null) {
	document.querySelector("#bgm").addEventListener("ended", () => {
		if (this.playmusic == "all") {
			let findrand = Math.floor(Math.random() * 6) + 1
			document.querySelector("#bgm").src = `music/bgm${findrand}.mp3`
			document.querySelector("#bgm").play()
		}
	});
}
document.addEventListener("DOMContentLoaded", game.init())
document.addEventListener("keydown", keyDown)
document.addEventListener("keyup", keyUp)
