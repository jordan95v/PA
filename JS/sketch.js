const pokemon = ['Pikachu', 'Ronflex', 'Salameche', 'Miaouss', 'Bulbizarre'];
const round = document.querySelector('#round')
const help = document.querySelector('#captchaHelp');
const captcha = document.querySelector("#captcha");
const btns = document.querySelectorAll('.captchaBtn');
const submit = document.querySelector('#reg');

let roundNumber = 1;
let choice = pokemon[Math.floor(Math.random() * pokemon.length)];
help.innerHTML = `Cliquez sur ${choice} pour compléter le captcha. 🤩`


for (let index = 0; index < btns.length; index++) {
    const btn = btns[index];
    btn.addEventListener('click', function () {
        if (this.id == choice) {
            roundNumber += 1;
            choice = pokemon[Math.floor(Math.random() * pokemon.length)];
            help.innerHTML = `Cliquez sur ${choice} pour compléter le captcha. 🤩`
        }
        if (roundNumber == 4) {
            submit.classList.remove('disabled');
            help.innerHTML = 'Vousavez l\'oeil d\'un fin dresseur de Pokemon, vous avez réussi 🎊 !';
            round.innerHTML = 'Vous avez réussi !'
            return;
        }
        round.innerHTML = `Manche ${roundNumber} / 3`;
    }
    );
}





