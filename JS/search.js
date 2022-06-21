function showResult() {
    let content = this.value;
    if (content.length == 0) {
        document.querySelector('#result').remove();
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    if (!document.querySelector('#result')) {
        let html = '<h1 id="result" class="text-light">Résultats de la recherche.</h1>';
        document.querySelector('#livesearch').insertAdjacentHTML('beforebegin', html)
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
        }
    }
    xmlhttp.open("GET", "JS/livesearch.php?q=" + content, true);
    xmlhttp.send();
}

const search = document.querySelector("#search");
search.addEventListener('keyup', showResult)