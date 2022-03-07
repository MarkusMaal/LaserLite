//jee sain lõpuks tööle :D
var paused = false;
var speed = 1;
var floating = false;
var plr = new player(10, 265, 25, 25, "#aaaaaa");
var obstacles = [];
var position = 0;
var interval = 70;
var spd = 3;
var hotspot = 1;
var continues = 3;
var game = {
    cnv : document.createElement("canvas"),
    init : function() {
        this.cnv = document.createElement("canvas");
        this.cnv.width = 768;
        this.cnv.height = 300;
        this.context = this.cnv.getContext("2d");
        var myPara = this.cnv;
        myPara.setAttribute("onclick", "oncnvclick()");
        myPara.setAttribute("id", "cnv");
        myPara.setAttribute("class", "cnvc");
        var mychild = document.getElementById("start");
        mychild.appendChild(myPara);
        this.interval = setInterval(this.update, 16);
    },
    update : function() {
        game.context.clearRect(0, 0, game.cnv.width, game.cnv.height);
        /* värvib tausta */
        game.context.fillStyle = "#eeeeee";
        game.context.fillRect(0, 0, game.cnv.width, game.cnv.height);
        if (floating) {
            plr.y -= 8;
            if (plr.y < 180) {floating = false;}
        } else {
            if (plr.y < 265) {speed += 0.5; }
            if (plr.y > 265) {plr.y = 265; }
            if (plr.y >= 265) {speed = 0.5; }
            if (plr.y < 265) {plr.y += speed; }
        }
        position += 1;
        if (position == hotspot) {
            if (obstacles.length == 0) {
                obstacles.push(new obstacle(788, 270, 20, 20, "black"));
                interval -= 5;
                if (interval < 50) {interval = 50;}
                hotspot += interval;
            }
        }
        if (obstacles.length > 0) {
            for(var pc = 0; pc < obstacles.length; pc++) {
                obstacles[pc].x -= spd;
                if (obstacles[pc].x <= 0 - obstacles[pc].w) {
                    obstacles[pc].x = game.cnv.width + obstacles[pc].w;
                    spd += 0.5;
                }
                if(collide(plr.x, plr.y, plr.w, plr.h, obstacles[pc].x, obstacles[pc].y, obstacles[pc].w, obstacles[pc].h) == true) {
                    plr.update();
                    clearInterval(game.interval);
                    obstacles[pc].x = game.cnv.width + obstacles[pc].w;
                    plr.y = 270;
                    document.getElementById("hs").innerHTML = "Mäng läbi";
                    if (continues > 0) {
                        document.getElementById("pausnupp").innerHTML = "Jätka (" + String(continues) + ")";
                        continues -= 1;
                    }
                    else {
                        var elem = document.getElementById('pausnupp');
                        elem.parentNode.removeChild(elem);
                    }
                }
                else {
                    document.getElementById("hs").innerHTML = "Hüppamiseks vajutage tühikuklahvi või puudutage mänguala";
                }
                obstacles[pc].update();
            }
        }
        document.getElementById("pts").innerHTML = "Punkte: " + String(position);
        plr.update();
    }
}
var sd = 10;
var puto;
function pausegame() {
    if (paused == false) {
        if (document.getElementById("pausnupp").innerHTML == "Jätka (" + String(continues) + ")") {
            game.interval = setInterval(game.update, 16);
            document.getElementById("pausnupp").innerHTML = "Paus";
            document.getElementById("hs").innerHTML = "Mäng on hetkel pausirežiimis. Vajutage jätka, et mängu jätkata.";
        } else {
            paused = true;
            document.getElementById("pausnupp").innerHTML = "Jätka";
            clearInterval(game.interval);
        }
    } else {
        paused = false;
        document.getElementById("pausnupp").innerHTML = "Paus";
        game.interval = setInterval(game.update, 16);
    }
}
function collide(x1, y1, w1, h1, x2, y2, w2, h2) {
    //vün
    if ((x2 >= x1) && (x2 <= x1 + w1) && (y2 >= y1) && (y2 <= y1 + h1)) {
        return true;
    //pün
    } else if ((x2 + w2 >= x1) && (x2 + w2 <= x1 + w1) && (y2 >= y1) && (y2 <= y1 + h1)) {
        return true;
    //van
    } else if ((x2 >= x1) && (x2 <= x1 + w1) && (y2 + h2 >= y1) && (y2 + h2 <= y1 + h1)) {
        return true;
    //pan
    } else if ((x2 + w2 >= x1) && (x2 + w2 <= x1 + w1) && (y2 + h2 >= y1) && (y2 + h2 <= y1 + h1)) {
        return true;
    } else {
        return false;
    }
}

function oncnvclick() {
    floating = true;
}

function newgame() {
    clearInterval(game.interval);
    game.init();
	window.addEventListener("keydown", keydown_handle(event));
	window.addEventListener("keyup", keyup_handle(event));
    //game.update();
}

function reload() {
    location.reload();
}

function player(x, y, w, h, color) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.color = color;
    this.update = function() {
        var puto = game.context;
		puto.fillStyle = this.color;
		puto.fillRect(this.x, this.y, this.w, this.h);
    }
}

function obstacle(x, y, w, h, color) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.color = color;
    this.update = function() {
        var puto = game.context;
		puto.fillStyle = this.color;
		puto.fillRect(this.x, this.y, this.w, this.h);
    }
}
function collide(x1, y1, w1, h1, x2, y2, w2, h2) {
    //vün
    if ((x2 >= x1) && (x2 <= x1 + w1) && (y2 >= y1) && (y2 <= y1 + h1)) {
        return true;
    //pün
    } else if ((x2 + w2 >= x1) && (x2 + w2 <= x1 + w1) && (y2 >= y1) && (y2 <= y1 + h1)) {
        return true;
    //van
    } else if ((x2 >= x1) && (x2 <= x1 + w1) && (y2 + h2 >= y1) && (y2 + h2 <= y1 + h1)) {
        return true;
    //pan
    } else if ((x2 + w2 >= x1) && (x2 + w2 <= x1 + w1) && (y2 + h2 >= y1) && (y2 + h2 <= y1 + h1)) {
        return true;
    } else {
        return false;
    }

}

function keydown_handle(event) {
    switch(event.keyCode) {
        //vasem
        case 32:
            floating = true;
            break;
    }
}
function keyup_handle(event) {
    switch(event.keyCode) {
        //vasem
        case 32:
            break;
        case 27:
            pausegame();
            break;
    }
}
