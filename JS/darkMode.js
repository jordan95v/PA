import { switchCards } from "./function.js";
import { switchTheme } from "./function.js";


const btn = document.querySelector('#darkSwitch');
const localTheme = localStorage.getItem('theme');

btn.addEventListener('click', function () {
    document.body.classList.toggle('light-theme');
    let theme = "";

    if (document.body.classList.contains('light-theme')) {
        theme = "light";
        switchTheme('text-dark', 'text-light');
        switchCards('light');
    } else {
        theme = 'dark';
        switchTheme('text-light', 'text-dark');
        switchCards('dark');
    }
    localStorage.setItem('theme', theme);
})

if (localTheme == 'light') {
    document.body.classList.add('light-theme');
    btn.setAttribute('checked', 'true');
    switchTheme('text-dark', 'text-light');
    switchCards('light');
}
if (localTheme == 'dark') {
    document.body.classList.remove('light-theme');
    btn.removeAttribute('checked');
    switchTheme('text-light', 'text-dark');
    switchCards('dark');
}




