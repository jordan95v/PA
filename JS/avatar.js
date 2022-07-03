function changePart(action) {
    const head = document.querySelector('.head');
    const eyes = document.querySelector('.eyes');
    const mouth = document.querySelector('.mouth');

    let actualHead = Number(head.attributes.src.nodeValue.substring("19", "20"));
    let actualEyes = Number(eyes.attributes.src.nodeValue.substring("19", "20"));
    let actualMouth = Number(mouth.attributes.src.nodeValue.substring("20", "21"));


    switch (action) {
        case 'last-head':
            if (actualHead == 1) {
                actualHead = 5;
            }
            head.attributes.src.nodeValue = `Images/Avatar/head-${actualHead - 1}.png`
            document.querySelector('#headInput').attributes.value.nodeValue = `head-${actualHead - 1}`;
            break;

        case 'next-head':
            if (actualHead == 4) {
                actualHead = 0;
            }
            head.attributes.src.nodeValue = `Images/Avatar/head-${actualHead + 1}.png`
            document.querySelector('#headInput').attributes.value.nodeValue = `head-${actualHead + 1}`;
            break;

        case 'last-eyes':
            if (actualEyes == 1) {
                actualEyes = 4;
            }
            eyes.attributes.src.nodeValue = `Images/Avatar/eyes-${actualEyes - 1}.png`
            document.querySelector('#eyesInput').attributes.value.nodeValue = `eyes-${actualEyes - 1}`;
            break;

        case 'next-eyes':
            if (actualEyes == 3) {
                actualEyes = 0;
            }
            eyes.attributes.src.nodeValue = `Images/Avatar/eyes-${actualEyes + 1}.png`
            document.querySelector('#eyesInput').attributes.value.nodeValue = `eyes-${actualEyes + 1}`;
            break;

        case 'last-mouth':
            if (actualMouth == 1) {
                actualMouth = 4;
            }
            mouth.attributes.src.nodeValue = `Images/Avatar/mouth-${actualMouth - 1}.png`
            document.querySelector('#mouthInput').attributes.value.nodeValue = `mouth-${actualMouth - 1}`;
            break;

        case 'next-mouth':
            if (actualMouth == 3) {
                actualMouth = 0;
            }
            mouth.attributes.src.nodeValue = `Images/Avatar/mouth-${actualMouth + 1}.png`
            document.querySelector('#mouthInput').attributes.value.nodeValue = `mouth-${actualMouth + 1}`;
            break;

        default:
            break;
    }
}