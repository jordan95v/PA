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

export { switchCards };
export { switchTheme };