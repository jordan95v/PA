class Tile {
    constructor(index, image) {
        this.i = index;
        this.img = image;
    }
}

let tiles = [];
let board = [];
let buttons = [];

const captcha = document.getElementById("puzzle");

const height_tile = "100px";
const width_tile = "100px";

function setup_tiles() {
    // Setup the tiles.

    for (let i = 0; i < 9; i++) {
        let img = `./Images/Captcha/${i}.png`;
        let tile = new Tile(i, img);

        tiles[i] = tile;
        board[i] = i;
    }
}

function shuffle() {
    // Shuffle the board.

    for (let i = 0; i < 10; i++) {
        let temp = Math.floor(Math.random() * 9);
        let j = (temp % 3);
        let k = (temp - j) / 3;
        move(j, k);
    }
}

function move(i, j) {
    // Move tiles.

    let blankIndex = find_blank();
    let blankRows = (blankIndex % 3);
    let blankCols = (blankIndex - blankRows) / 3;

    if (isNeighboor(i, j, blankRows, blankCols)) {
        swap(blankIndex, (i + j * 3), board);
    }
}

function find_blank() {
    // Return the index of the empty tile.

    for (let i = 0; i < board.length; i++) {
        if (board[i] == 8) {
            return i;
        }
    }
}

function isNeighboor(i, j, blankX, blankY) {
    // Check if tiles is neightboor.

    if (i != blankX && j != blankY) {
        return false;
    }
    if ((i - blankX == 1) || (blankX - i == 1) || (j - blankY == 1) || (blankY - j == 1)) {
        return true;
    }
    return false;
}

function swap(i, j, arr) {
    // Swap tiles.

    let temp = arr[i];
    arr[i] = arr[j];
    arr[j] = temp;
}

function draw() {
    // Draw the new captcha, so the user can see it.

    for (let i = 0; i < board.length; i++) {
        let temp = board[i];

        //IMAGE
        let img = document.createElement("img");

        img.setAttribute("src", tiles[temp].img);
        img.setAttribute("height", `${height_tile}`);
        img.setAttribute("width", `${width_tile}`);

        //BOUTON
        let button = document.createElement("button");
        button.setAttribute("class", "p-0 m-0 shadow-none");
        button.setAttribute("id", `${board[i]}`);
        button.setAttribute("onclick", `pressed(${i})`);

        button.appendChild(img);

        //après 3 tuiles, nous revenons à la ligne pour former un carré
        if (i != 0 && i % 3 == 0) {
            let br = document.createElement("br");
            captcha.appendChild(br);
        }

        captcha.appendChild(button);
    }
}

function verify() {
    // Check if the captcha is done.

    for (let i = 0; i < (board.length - 1); i++) {
        if (board[i] > board[i + 1]) {
            return false;
        }
    }
    return true;
}

function pressed(index) {
    // Move a tile when a button is pressed.

    captcha.innerHTML = "";
    let i = (index % 3);
    let j = (index - i) / 3;
    move(i, j);
    draw();
}

setup_tiles();
shuffle();
draw();