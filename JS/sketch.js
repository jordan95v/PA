const pokemon = ['Pikachu', 'Ronflex', 'Salameche', 'Miaouss', 'Bulbizarre'];
const choice = pokemon[Math.floor(Math.random() * pokemon.length)];

const captcha = document.querySelector("#captcha");
const btns = document.querySelectorAll('.captchaBtn');
const submit = document.querySelector('#reg');

document.querySelector('#captchaHelp').innerHTML = `Cliquez sur ${choice} pour compléter le captcha. 🤩`

for (let index = 0; index < btns.length; index++) {
    const btn = btns[index];
    btn.addEventListener('click', function () {
        if (this.id == choice) {
            submit.classList.remove('disabled');
        }
        else {
            submit.classList.add('disabled');
        }
    }
    );
}