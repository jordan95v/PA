const btn = document.querySelector('#darkSwitch');
const localTheme = localStorage.getItem('theme');

if (localTheme == 'light') {
    document.body.classList.add('light-theme');
    btn.setAttribute('checked', 'true');
}

function switchTheme(theme_add, theme_rm) {
    const lightText = document.body.querySelectorAll(`.${theme_rm}`);
    for (let index = 0; index < lightText.length; index++) {
        const element = lightText[index];
        element.classList.remove(theme_rm);
        element.classList.add(theme_add);
    }
}

btn.addEventListener('click', function () {
    document.body.classList.toggle('light-theme');
    let theme = "dark";

    if (document.body.classList.contains('light-theme')) {
        theme = "light";
        switchTheme('text-dark', 'text-light')
    } else {
        switchTheme('text-light', 'text-dark')
    }
    localStorage.setItem('theme', theme);
})