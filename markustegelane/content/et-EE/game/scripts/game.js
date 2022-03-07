var game = {

    canvas: document.createElement("canvas"),
    initialize: function () {
		this.canvas.setAttribute("id", "gamecanvas");
        this.canvas.setAttribute("style", "width: 50%; image-rendering: crisp-edges; image-rendering: pixelated;");
        this.canvas.width = 600;
        this.canvas.height = 600;
        this.mousex = 0;
        this.mousey = 0;
        this.lc_down = false;
        this.framerate = 16;
        this.pause = true;
        this.frame = 0;
        this.block_x = 1;
        this.block_y = 1;
        
        this.secs = false;
        this.last_one = [];
        this.last_two = [];
        this.last_three = [];
        this.last_four = [];
        
        
        this.bg_r = 0;
        this.bg_g = 0;
        this.bg_b = 0;
        
        this.fg_r = 255;
        this.fg_g = 255;
        this.fg_b = 255;        
        this.tilesize = 10;
        this.fullrate = 128;
        this.over = false,
        this.autopause = false;
        this.remove = false;
        this.context = this.canvas.getContext("2d");
        originalDiv = document.getElementById("mai");
        var parentDiv = document.getElementById("startbtn");
        parentDiv.insertBefore(this.canvas, originalDiv.nextSibling);
		this.fps = setInterval(this.update, this.framerate);

        this.board = new Board(this.canvas.width / this.tilesize + 1, this.canvas.height / this.tilesize + 1, this.tilesize);
        for (var i = 0; i < this.canvas.height / this.tilesize - 1; i++) {
            for (var j = 0; j < this.canvas.width / this.tilesize - 1; j++) {
                this.board.boardgrid[j][i] = 0;
            }
        }
        
        this.nothing = this.board;
    },
  
    clear : function () {
        this.context.fillStyle = "rgb(" + String(game.bg_r) + ", "+ String(game.bg_g) +", "+ String(game.bg_b) +")";
        this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);
        this.context.font = "80px Arial";
    },
    
    update : function () {
        game.clear();
        game.board.updategrid();
        game.board.draw();
    },
    
    set_size : function() {
        if (this.pause) {
            this.frame = 0;
            document.getElementById("it_str").innerHTML = 'Vajutage "Alusta simulatsiooni", et alustada';
            game.framerate = 16;
            document.getElementById("pause_resume").innerHTML = "Alusta simulatsiooni";
            this.tilesize = Number(document.getElementById("res_w").value);
            clearInterval(game.fps);
            this.board = new Board(this.canvas.width / this.tilesize + 1, this.canvas.height / this.tilesize + 1, this.tilesize);
            for (var i = 0; i < this.canvas.height / this.tilesize + 1; i++) {
                for (var j = 0; j < this.canvas.width / this.tilesize + 1; j++) {
                    this.board.boardgrid[j][i] = 0;
                }
            }
            this.fps = setInterval(this.update, this.framerate);
        }

    },
    
    stop : function(winner) {
        game.initialize();
        this.context.font = "80px Arial";
        game.board.draw();
        //game.update();
        clearInterval(game.fps);

    }
};
