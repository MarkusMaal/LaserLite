function Board(w, h, tlsize) {
    this.width = w;
    this.height = h;
    this.tilesize = tlsize;

    this.boardgrid = [];

    for (var i = 0; i < this.width; i++) {
        this.boardgrid.push([]);

        for (var j = 0; j < this.height; j++) {
            this.boardgrid[i].push(0);
        }
    }
    
    this.getneighbours = function(i, j) {
        var eds = "";
        var neighbours = 0;
        // ed1
        if (i > 0) {
            if (this.boardgrid[i - 1][j] == 1) {
                eds = eds + "ed1";
                neighbours += 1;
            }
            if (i < this.height) {
                // ed8
                if (this.boardgrid[i - 1][j + 1] == 1) {
                    eds = eds + "ed8";
                    neighbours += 1;
                }
            }
            if (i > 0) {
                // ed2
                if (this.boardgrid[i - 1][j - 1] == 1) {
                    eds = eds + "ed2";
                    neighbours += 1;
                }
            }
        }
        if (j > 0) {
            // ed3
            if (this.boardgrid[i][j - 1] == 1) {
                eds = eds + "ed3";
                neighbours += 1;
            }
        }
        if (j < this.width) {
            // ed7
            if (this.boardgrid[i][j + 1] == 1) {
                eds = eds + "ed7";
                neighbours += 1;
            }
        }
        if (i < this.height - 1) {
            // ed4
            if (j > 0) {
                if (this.boardgrid[i + 1][j - 1] == 1) {
                    eds = eds + "ed4";
                    neighbours += 1;
                }
            }
            // ed5
            if (this.boardgrid[i + 1][j] == 1) {
                eds = eds + "ed5";
                neighbours += 1;
            }
            // ed6
            if (j < this.width) {
                if (this.boardgrid[i + 1][j + 1] == 1) {
                    eds = eds + "ed6";
                    neighbours += 1;
                }
            }
        }
        return neighbours;
    }
    
    this.updategrid = function () {
        if (!game.pause) {
            newboard = [];
            for (var i = 0; i < this.width; i++) {
                for (var j = 0; j < this.height; j++) {
                    if (j == 0) { newboard[i] = []; }
                    newboard[i].push(0);
                }
            }
        }
        for (var i = 0; i < this.width; i += 1) {
            for (var j = 0; j < this.height; j += 1) {
                if (!game.pause) {
                    var state = this.boardgrid[i][j];
                    neighbours = this.getneighbours(i, j);
                    if (state == 1) {
                        if (neighbours < 2) {
                            newboard[i][j] = 0;
                        }
                        else if ((neighbours == 2) || (neighbours == 3)) {
                            newboard[i][j] = 1;
                        }
                        else {
                            newboard[i][j] = 0;
                        }
                    } else {
                        if (neighbours == 3) {
                            newboard[i][j] = 1;
                        }
                    }
                }
            }
        }
        if (!game.pause) {
            document.getElementById("sizesetup").innerHTML = "";
            game.frame += 1;
            if (!game.over)
            {
                document.getElementById("it_str").innerHTML = "Aeg: " + String(game.frame) + " ajaühikut";
            }
            if (game.autopause) {
                game.pause = true;
                game.autopause = false;
            }
            if (this.get_count(newboard) == 0) {
                document.getElementById("state").innerHTML = "Mäng läbi: Entroopia";
                document.getElementById("btn_parent").innerHTML=' <a href="#/" onclick="reload_game()" class="listitems">Proovi uuesti</a>';
                game.pause = true;
                game.over = true;
            } else {
                if (this.compare_lists(newboard, this.boardgrid)) {
                    document.getElementById("state").innerHTML = "Mäng läbi: Liikuvaid rakke pole";
                    document.getElementById("btn_parent").innerHTML=' <a href="#/" onclick="reload_game()" class="listitems">Proovi uuesti</a>';
                    game.pause = true;
                    game.over = true;
                }
                else if ((this.compare_lists(game.last_one, this.boardgrid)) || (this.compare_lists(game.last_three, this.boardgrid))) {
                    if ((this.compare_lists(game.last_two, newboard)) || (this.compare_lists(game.last_four, newboard))) {
                        document.getElementById("state").innerHTML = "Mäng läbi: Seisev evolutsioon";
                        document.getElementById("btn_parent").innerHTML=' <a href="#/" onclick="reload_game()" class="listitems">Proovi uuesti</a>';
                        game.over = true;
                    }
                }
                else if ((this.compare_lists(game.last_two, this.boardgrid)) || (this.compare_lists(game.last_four, this.boardgrid))) {
                    if ((this.compare_lists(game.last_one, newboard)) || (this.compare_lists(game.last_three, newboard)))  {
                        document.getElementById("state").innerHTML = "Mäng läbi: Seisev evolutsioon";
                        document.getElementById("btn_parent").innerHTML=' <a href="#/" onclick="reload_game()" class="listitems">Proovi uuesti</a>';
                        game.over = true;
                    }
                }
            }
            if (game.secs == false) {
                for (var i = 0; i < this.width; i += 1) {
                    game.last_one[i] = this.boardgrid[i];
                }
                for (var i = 0; i < this.width; i += 1) {
                    game.last_two[i] = newboard[i];
                }
                game.secs = true;
            } else {
                for (var i = 0; i < this.width; i += 1) {
                    game.last_three[i] = this.boardgrid[i];
                }
                for (var i = 0; i < this.width; i += 1) {
                    game.last_four[i] = newboard[i];
                }
                game.secs = false;
            }
            this.boardgrid = newboard;
        }
    }
    
    this.compare_lists = function(array1, array2) {
        if (String(array1) == String(array2)) {
            return true;
        } else {
            return false;
        }
    }
    
    this.get_count = function(array1) {
        var count = 0;
        for (var i = 0; i < this.width; i += 1) {
            for (var j = 0; j < this.height; j += 1) {
                if (array1[i][j] == 1) {
                    count++;
                }
            }
        }
        return count;
    }
    
    this.draw = function() {
        var ctx = game.canvas.getContext("2d");
        for (var i = 1; i < this.width; i ++) {
            for (var j = 1; j < this.height; j++) {
        
                if (this.boardgrid[i][j] == 1) {
                    ctx.fillStyle = "rgb(" + String(game.fg_r) + ", "+ String(game.fg_g) +", "+ String(game.fg_b) +")"; 
                }
                else {
                    ctx.fillStyle = "rgb(" + String(game.bg_r) + ", "+ String(game.bg_g) +", "+ String(game.bg_b) +")"; 
                }

                ctx.fillRect((i-1)*(this.tilesize), (j-1)* this.tilesize, this.tilesize, this.tilesize);
            }
        }
    }
}
