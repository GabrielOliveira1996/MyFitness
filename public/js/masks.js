const input = document.getElementById('statureId');

input.addEventListener('keypress', () => {

    let inputLength = input.value.length;

    if(inputLength === 1){
        input.value += '.';
    }

});

