var game = {

    canvas: document.createElement("canvas"),
    initialize: function () {
		this.canvas.setAttribute("id", "gamecanvas");
        this.canvas.setAttribute("style", "width: 100%; image-rendering: pixelated;");
        this.canvas.width = 200;
        this.canvas.height = 200;
		this.bg_r = 32;
		this.bg_g = 32;
		this.bg_b = 32;
		this.colorful = false;
        this.context = this.canvas.getContext("2d");
        var parentDiv = document.getElementById("asdf");
        document.body.insertBefore(this.canvas, parentDiv);
		this.fps = setInterval(this.update, this.framerate);
    },
  
    clear : function () {
        this.context.fillStyle = "rgb(" + String(game.bg_r) + ", "+ String(game.bg_g) +", "+ String(game.bg_b) +")";
        this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);
    },
    
    update : function () {
		game.clear();
		for (var y = 0; y < game.canvas.height; y ++) {
			for (var x = 0; x < game.canvas.width; x++) {
				if (Math.round(Math.random() * (2 - 0) + 0) > 0) {
					r = Math.round(Math.random() * (2 - 0) + 0) * 255;
					if (r == 0) {
						continue;
					}
					if (game.colorful == false) {
						game.context.fillStyle = "rgb("+r+","+r+","+r+")";
					} else {
						g = Math.round(Math.random() * (2 - 0) + 0) * 255;
						b = Math.round(Math.random() * (2 - 0) + 0) * 255;
						game.context.fillStyle = "rgb("+r+","+g+","+b+")";
					}
					game.context.fillRect( x, y, 1, 1 );
				}
			}
		}
    },
    
    
    stop : function() {
        clearInterval(game.fps);
    },
	
	play : function() {
		this.fps = setInterval(this.update, this.framerate);
	}
};

function stop_play() {
	if (document.getElementById("stopnplay").innerHTML == "Jätka") {
		game.play();
		return;
	} else {
		game.stop();
		return;
	}
}

function set_color() {
	game.colorful = true;
}

function next() {
	game.update();	
}

game.initialize();
