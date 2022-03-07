let isDrawing = false;
let x = 0;
let y = 0;
let filltype = 2;
function handle_click(event) {
    if ((game.pause) && (!game.over)) {
        game.lc_down = true;
        isDrawing = true;
    }
}
function handle_up(event) {
    game.lc_down = false;
    isDrawing = false;
}

function inv_remove() {
    if (game.remove) {
        game.remove = false;
        document.getElementById("btype").innerHTML = "Režiim: Joonistamine";
    } else {
        game.remove = true;
        document.getElementById("btype").innerHTML = "Režiim: Kustutamine";
    }
}
function handle_anyclick(event) {
    var rect = game.canvas.getBoundingClientRect();
    if (filltype == 2) {
        var mousex = (event.clientX - rect.left) * (game.canvas.width / rect.width);
        var mousey = (event.clientY - rect.top) * (game.canvas.height / rect.height);
        /* var mousex = event.clientX * document.getElementById("gamecanvas").style.width - rect.left;
        var mousey = event.clientY * document.getElementById("gamecanvas").style.width - rect.top; */
        var mousex_grid = Math.floor(mousex / game.board.tilesize + 1);
        var mousey_grid = Math.floor(mousey / game.board.tilesize + 1);
        if ((!((mousex_grid >= game.board.width) || (mousey_grid >= game.board.height))) && (((mousex_grid > 0) && (mousey_grid > 0)))) {
        z = game.board;
            if (game.remove) {
                filltype = 0;
            } else {
                filltype = 1;
            }
        }
    }
    x = (event.clientX - rect.left) * (game.canvas.width / rect.width);
    y = (event.clientY - rect.top) * (game.canvas.height / rect.height);
    var mousex_grid = Number(Math.floor(x / game.board.tilesize + 1));
    var mousey_grid = Number(Math.floor(y / game.board.tilesize + 1));
    if ((!((mousex_grid >= game.board.width) || (mousey_grid >= game.board.height))) && (((mousex_grid > 0) && (mousey_grid > 0)))) {
        z = game.board;
        if (z.boardgrid[mousex_grid][mousey_grid] == 0) {
            if (game.remove) {
                z.boardgrid[mousex_grid][mousey_grid] = 0;
            } else {
                z.boardgrid[mousex_grid][mousey_grid] = 1;
            }
        } else {
            if (game.remove) {
                z.boardgrid[mousex_grid][mousey_grid] = 0;
            } else {
                z.boardgrid[mousex_grid][mousey_grid] = 1;
            }
        }
    }
}

function update_location(event) {
    var rect = game.canvas.getBoundingClientRect();
    if (filltype == 2) {
        var mousex = (event.clientX - rect.left) * (game.canvas.width / rect.width);
        var mousey = (event.clientY - rect.top) * (game.canvas.height / rect.height);
        /* var mousex = event.clientX * document.getElementById("gamecanvas").style.width - rect.left;
        var mousey = event.clientY * document.getElementById("gamecanvas").style.width - rect.top; */
        var mousex_grid = Math.floor(mousex / game.board.tilesize + 1);
        var mousey_grid = Math.floor(mousey / game.board.tilesize + 1);
        if ((!((mousex_grid >= game.board.width) || (mousey_grid >= game.board.height))) && (((mousex_grid > 0) && (mousey_grid > 0)))) {
        z = game.board;
            if (Number(z.boardgrid[mousey_grid][mousex_grid]) == 1) {
                filltype = 0;
            } else {
                filltype = 1;
            }
        }
    }
    if (game.lc_down) {
        x = (event.clientX - rect.left) * (game.canvas.width / rect.width);
        y = (event.clientY - rect.top) * (game.canvas.height / rect.height);
        var mousex_grid = Number(Math.floor(x / game.board.tilesize + 1));
        var mousey_grid = Number(Math.floor(y / game.board.tilesize + 1));
        if ((!((mousex_grid >= game.board.width) || (mousey_grid >= game.board.height))) && (((mousex_grid > 0) && (mousey_grid > 0)))) {
            z = game.board;
            if (z.boardgrid[mousex_grid][mousey_grid] == 0) {
                if (game.remove) {
                    z.boardgrid[mousex_grid][mousey_grid] = 0;
                } else {
                    z.boardgrid[mousex_grid][mousey_grid] = 1;
                }
            } else {
                if (game.remove) {
                    z.boardgrid[mousex_grid][mousey_grid] = 0;
                } else {
                    z.boardgrid[mousex_grid][mousey_grid] = 1;
                }
            }
        }
    }
}

function iterate() {
    if (game.pause) {
        game.pause = false;
        game.autopause = false;
        game.framerate = game.fullrate;
        document.getElementById("state").innerHTML = "Simulatsioon jookseb...";
        document.getElementById("pause_resume").innerHTML = "Peata simulatsioon";
        clearInterval(game.fps);
		game.fps = setInterval(game.update, game.framerate);
    } else {
        game.pause = true;
        game.framerate = 16;
        document.getElementById("pause_resume").innerHTML = "Jätka simulatsiooni";
        clearInterval(game.fps);
		game.fps = setInterval(game.update, game.framerate);
    }
}

function iterate_one() {
    if (game.pause) {
        game.pause = false;
        game.autopause = true;
        game.framerate = game.fullrate;
        clearInterval(game.fps);
		game.fps = setInterval(game.update, game.framerate);
    }
}


function reload_game() {
    clearInterval(game.fps);
    document.getElementById("btn_parent").innerHTML = '<a href="#/" onclick="iterate()" id="pause_resume" class="listitems">Alusta simulatsiooni</a><a href="#/" onclick="iterate_one()" id="pausnupp" class="listitems" style="margin-left: 5px;">Järgmine iteratsioon</a><a href="#/" onclick="reload_game()" class="listitems" style="margin-left: 5px;">Uus mäng</a><a style="margin-left: 5px;" href="#/" onclick="inv_remove()" class="listitems" id="btype">Režiim: Joonistamine</a>';
    document.getElementById("it_str").innerHTML = 'Vajutage "Alusta simulatsiooni", et alustada';
    document.getElementById("state").innerHTML = 'Joonistamisrežiim';
    document.getElementById("sizesetup").innerHTML = '<span style="margin-right: 10px;">Ristküliku suurus:</span><input style="padding: 10px; border: none; font-size: 12pt; width: 25px;" value="5" id="res_w"></input><a href="#/" style="margin-left: 10px;" onclick="game.set_size()" class="listitems">Muuda</a>';
    game.lc_down = false;
    game.pause = true;
    game.frame = 0;
    game.block_x = 1;
    game.block_y = 1;
    game.secs = false;
    game.last_one = [];
    game.last_two = [];
    game.last_three = [];
    game.last_four = [];
    game.over = false,
    game.autopause = false;
    game.board = new Board(game.canvas.width / game.tilesize + 1, game.canvas.height / game.tilesize + 1, game.tilesize);
    for (var i = 0; i < game.canvas.height / game.tilesize - 1; i++) {
        for (var j = 0; j < game.canvas.width / game.tilesize - 1; j++) {
            game.board.boardgrid[j][i] = 0;
        }
    }
    game.framerate = 16;
    game.fps = setInterval(game.update, game.framerate);
    game.nothing = game.board;
}

function main() {
    game.initialize();
    window.addEventListener("mousemove", update_location, true);
    window.addEventListener("mousedown", handle_click, true);
    window.addEventListener("mouseup", handle_up, true);
    window.addEventListener("click", handle_anyclick, true);
}
