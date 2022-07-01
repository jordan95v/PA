function switchTheme(theme_add, theme_rm) {
    const lightText = document.body.querySelectorAll(`.${theme_rm}`);
    for (let index = 0; index < lightText.length; index++) {
        const element = lightText[index];
        element.classList.remove(theme_rm);
        element.classList.add(theme_add);
    }
}

function switchCards(theme) {
    const cards = document.querySelectorAll('.film');
    for (let index = 0; index < cards.length; index++) {
        const element = cards[index];
        if (theme == 'light') {
            element.classList.remove('custom-cards');
        }
        if (theme == 'dark') {
            element.classList.add('custom-cards');
        }
    }
}

function showResult() {
    const localTheme = localStorage.getItem('theme');
    let content = this.value;
    if (content.length == 0) {
        document.querySelector('#result').remove();
        document.getElementById("livesearch").innerHTML = "";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    if (!document.querySelector('#result')) {
        const theme = (localStorage.getItem('theme') == 'light') ? 'text-dark' : 'text-light';
        let html = `<div id="result" class="d-flex pt-4 bd-highlight">
            <div class="p-2 pt-5 flex-grow-1 bd-highlight">
                <h2 class="fw-bold ${theme}">Résultat de la recherche 🤠</h2>
            </div>
        </div>`;
        document.querySelector('#livesearch').insertAdjacentHTML('beforebegin', html)
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
            switchCards(localStorage.getItem('theme'));
            if (localTheme == 'light') {
                switchTheme('text-dark', 'text-light');
                switchCards('light');
            }
            if (localTheme == 'dark') {
                switchTheme('text-light', 'text-dark');
                switchCards('dark');
            }
        }
    }
    xmlhttp.open("GET", "JS/livesearch.php?q=" + content, true);
    xmlhttp.send();
}

const search = document.querySelector("#search");
search.addEventListener('keyup', showResult)