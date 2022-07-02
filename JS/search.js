function switchCards(theme, theme_add, theme_rm) {
    const cards = document.querySelectorAll('.film');
    for (let index = 0; index < cards.length; index++) {
        const element = cards[index];
        const texts = element.querySelectorAll(`.${theme_rm}`)
        if (theme == 'light') {
            element.classList.remove('custom-cards');
            for (let j = 0; j < texts.length; j++) {
                const text = texts[j];
                text.classList.remove(theme_rm);
                text.classList.remove(theme_add);
            }
        }
        if (theme == 'dark') {
            element.classList.add('custom-cards');
            for (let j = 0; j < texts.length; j++) {
                const text = texts[j];
                text.classList.remove(theme_rm);
                text.classList.remove(theme_add);
            }
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
            <div class="p-2 pt-2 flex-grow-1 bd-highlight">
                <h2 class="fw-bold ${theme}">Résultat de la recherche 🤠</h2>
            </div>
        </div>`;
        document.querySelector('#livesearch').insertAdjacentHTML('beforebegin', html)
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
            document.getElementById("livesearch").querySelectorAll()
            switchCards(localStorage.getItem('theme'));
            if (localTheme == 'light') {
                switchCards('light', 'text-dark', 'text-light');
            }
            if (localTheme == 'dark') {
                switchCards('dark', 'text-light', 'text-dark');
            }
        }
    }
    xmlhttp.open("GET", "JS/livesearch.php?q=" + content, true);
    xmlhttp.send();
}

const search = document.querySelector("#search");
search.addEventListener('keyup', showResult)