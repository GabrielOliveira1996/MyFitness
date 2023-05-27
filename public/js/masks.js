const stature = document.getElementById('statureId');
stature.addEventListener('keypress', () => {
    let statureInputLength = stature.value.length;
    if(statureInputLength === 1){
        stature.value += '.';
    }
});

