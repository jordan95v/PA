function showResult() {
    let content = this.value;
    if (content.length == 0) {
        document.querySelector('#result').remove();
        document.getElementById("livesearch").innerHTML = "";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    if (!document.querySelector('#result')) {
        let html = `<div id="result" class="d-flex pt-4 bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
                <h2 class="fw-bold">Résultat de la recherche 🤠</h2>
            </div>
        </div>`;
        document.querySelector('#livesearch').insertAdjacentHTML('beforebegin', html)
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "JS/livesearch.php?q=" + content, true);
    xmlhttp.send();
}

const search = document.querySelector("#search");
search.addEventListener('keyup', showResult)