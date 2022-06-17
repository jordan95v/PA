function sortTables(n) {
    const rows = document.querySelector("#logTable").rows;
    let swap = true;
    let dir = "asc";
    let change = false;
    let i, count = 0;
    while (swap) {
        swap = false;
        for (i = 1; i < rows.length - 1; i++) {
            change = false
            console.log(n.target.param)
            let element = rows[i].querySelector(`#${n.target.param}`).innerHTML.toLowerCase();
            let next = rows[i + 1].querySelector(`#${n.target.param}`).innerHTML.toLowerCase();

            if (dir == "asc") {
                if (element > next) {
                    change = true;
                    break;
                }
            }
            if (dir == "desc") {
                if (element < next) {
                    change = true;
                    break;
                }
            }
        }
        if (change) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            swap = true;
            count++;
        }
        else {
            if (count == 0) {
                swap = true;
                dir = "desc";
            }
        }
    }
}

const table = document.querySelector("#headers");
const header = table.querySelectorAll("th")

for (let index = 1; index < header.length; index++) {
    const element = header[index];
    element.addEventListener("click", sortTables)
    element.param = element.innerHTML.toLowerCase();
}