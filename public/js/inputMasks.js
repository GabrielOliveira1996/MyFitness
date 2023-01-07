// código que seleciona option de tipo de dieta.
let typeOfDietHidden = document.getElementById('typeOfDietHiddenId');

if(typeOfDietHidden.value === 'Padrão'){

    $("#typeOfDietId").val('Padrão'); //Seleciona option através de value

}else if(typeOfDietHidden.value === 'Equilibrado'){

    $("#typeOfDietId").val('Equilibrado'); //Seleciona option através de value

}else if(typeOfDietHidden.value === 'Pobre em gorduras'){

    $("#typeOfDietId").val('Pobre em gorduras'); //Seleciona option através de value

}else if(typeOfDietHidden.value === "Rico em proteínas"){

    $("#typeOfDietId").val('Rico em proteínas'); //Seleciona option através de value

}else if(typeOfDietHidden.value === 'Cetogénica'){

    $("#typeOfDietId").val('Cetogénica'); //Seleciona option através de value

}


// código que seleciona option de objetive.
let objectiveHidden = document.getElementById('objectiveHiddenId');

if(objectiveHidden.value === 'Perder peso'){

    $("#objectiveId").val('Perder peso'); //Seleciona option através de value

}else if(objectiveHidden.value === 'Perder peso lentamente'){

    $("#objectiveId").val('Perder peso lentamente'); //Seleciona option através de value

}else if(objectiveHidden.value === 'Manter o peso'){

    $("#objectiveId").val('Manter o peso'); //Seleciona option através de value

}else if(objectiveHidden.value === "Aumentar peso lentamente"){

    $("#objectiveId").val('Aumentar peso lentamente'); //Seleciona option através de value

}else if(objectiveHidden.value === 'Aumentar peso rápidamente'){

    $("#objectiveId").val('Aumentar peso rápidamente'); //Seleciona option através de value

}


// código que seleciona option de activityRateFactor.
let activityRateFactor = document.getElementById('activityRateFactorHiddenId');

if(activityRateFactor.value === '1.20'){

    $("#activityRateFactorId").val(1.2); //Seleciona option através de value
}else if(activityRateFactor.value === '1.38'){

    $("#activityRateFactorId").val(1.38); //Seleciona option através de value
}else if(activityRateFactor.value === '1.55'){

    $("#activityRateFactorId").val(1.55); //Seleciona option através de value
}else if(activityRateFactor.value === '1.72'){

    $("#activityRateFactorId").val(1.72); //Seleciona option através de value
}else if(activityRateFactor.value === '1.90'){

    $("#activityRateFactorId").val(1.9); //Seleciona option através de value
}

///////////////////////////ocorre erro, corrigir
let genderHidden = document.getElementById('genderHiddenId');

if(genderHidden.value == 'Masculino'){

    $("#genderId").val('Masculino'); //Seleciona option através de value
}else{

    $("#genderId").val('Feminino'); //Seleciona option através de value
}


let dailyCarbohydrateKcal = document.getElementById('dailyCarbohydrateKcalId');
let dailyCarbohydrate = document.getElementById('dailyCarbohydrateId');
if(dailyCarbohydrateKcal.value <= 0){
            
    dailyCarbohydrateKcal.value = 0;
    dailyCarbohydrate.value = 0;
}
