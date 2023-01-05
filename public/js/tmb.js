let showResult = document.getElementById('showResultId');

//showResult.addEventListener('click', basalMetabolicRateCalculation);

function basalMetabolicRateCalculation(){
    
    let gender = document.getElementById('genderId');
    let age = document.getElementById('ageId');
    let weight = document.getElementById('weightId');
    let stature = document.getElementById('statureId');
    let activityRateFactor = document.getElementById('activityRateFactorId');
    let objective = document.getElementById('objectiveId');
    let typeOfDiet = document.getElementById('typeOfDietId');
    let basalMetabolicRate = document.getElementById('basalMetabolicRateId');
    let dailyCalories = document.getElementById('dailyCaloriesId');
    let imc = document.getElementById('imcId');
    let water = document.getElementById('waterId');

    //Calculo imc.
    let statureValue = parseFloat(stature.value);
    if(!isNaN(weight.value) && !isNaN(statureValue)){
        imc.value = parseFloat(weight.value / (statureValue * statureValue)).toFixed(1);
    }

    //Calculo requisitos de água.
    water.value = weight.value * 35;

    //Macro nutrientes.
    let dailyCarbohydrate = document.getElementById('dailyCarbohydrateId');
    let dailyProtein = document.getElementById('dailyProteinId');
    let dailyFat = document.getElementById('dailyFatId');

    //Macro nutrientes porcentagens.
    let dailyCarbohydratePercent = document.getElementById('dailyCarbohydratePercentId');
    let dailyProteinPercent = document.getElementById('dailyProteinPercentId');
    let dailyFatPercent = document.getElementById('dailyFatPercentId');

    //Macro nutrientes por kcal.
    let dailyCarbohydrateKcal = document.getElementById('dailyCarbohydrateKcalId');
    let dailyProteinKcal = document.getElementById('dailyProteinKcalId');
    let dailyFatKcal = document.getElementById('dailyFatKcalId');

    //trecho de código ainda não terminado, não utilizar.
    //let dailyKcalProtein = parseFloat((2 * weight.value) * 4).toFixed(1); // quantidade de kcal por kilo de carbo
    //let dailyKcalFat = parseFloat((1 * weight.value) * 9).toFixed(1); // quantidade de kcal por kilo de carbo
    //let proteinAndFat = parseFloat(dailyKcalProtein) + parseFloat(dailyKcalFat);
    //let dailyKcalCarbohydrate = parseFloat(dailyCalories.value - proteinAndFat).toFixed(1); // quantidade de kcal por kilo de carbo
    //console.log(dailyKcalCarbohydrate, dailyKcalProtein, dailyKcalFat);

    //Cálculos TMB para formula do sexo masculino.
    let masculineWeightCalculation = 13.7 * weight.value;
    let masculineStatureCalculation = 5 * (stature.value * 100);
    let masculineAgeCalculation = 6.8 * age.value;

    //Cálculos TMB para formula do sexo masculino.
    let FeminineWeightCalculation = 9.6 * weight.value;
    let FeminineStatureCalculation = 1.8 * stature.value;
    let FeminineAgeCalculation = 4.7 * age.value;

    if(gender.value == 'Masculino'){

        if(objective.value == 'Perder peso rápidamente'){

            dailyCaloriesResult = parseInt(activityRateFactor.value * (66 + masculineWeightCalculation + masculineStatureCalculation - masculineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * -0.20;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;
            
        }else if(objective.value == 'Perder peso lentamente'){
            
            dailyCaloriesResult = parseInt(activityRateFactor.value * (66 + masculineWeightCalculation + masculineStatureCalculation - masculineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * -0.10;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }else if(objective.value == 'Manter o peso'){
            
            dailyCaloriesResult = parseInt(activityRateFactor.value * (66 + masculineWeightCalculation + masculineStatureCalculation - masculineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * 0;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }else if(objective.value == 'Aumentar peso lentamente'){
            
            dailyCaloriesResult = parseInt(activityRateFactor.value * (66 + masculineWeightCalculation + masculineStatureCalculation - masculineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * 0.10;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }else{ // if(objective.value == 'aumentar peso rápidamente') //

            dailyCaloriesResult = parseInt(activityRateFactor.value * (66 + masculineWeightCalculation + masculineStatureCalculation - masculineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * 0.20;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }

    }else{

        if(objective.value == 'Perder peso rápidamente'){

            dailyCaloriesResult = parseInt(activityRateFactor.value * (655 + FeminineWeightCalculation + FeminineStatureCalculation - FeminineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * -0.20;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;
            
        }else if(objective.value == 'Perder peso lentamente'){
            
            dailyCaloriesResult = parseInt(activityRateFactor.value * (655 + FeminineWeightCalculation + FeminineStatureCalculation - FeminineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * -0.10;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }else if(objective.value == 'Manter o peso'){
            
            dailyCaloriesResult = parseInt(activityRateFactor.value * (655 + FeminineWeightCalculation + FeminineStatureCalculation - FeminineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * 0;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }else if(objective.value == 'Aumentar peso lentamente'){
            
            dailyCaloriesResult = parseInt(activityRateFactor.value * (655 + FeminineWeightCalculation + FeminineStatureCalculation - FeminineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * 0.10;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }else{ // if(objective.value == 'aumentar peso rápidamente') //

            dailyCaloriesResult = parseInt(activityRateFactor.value * (655 + FeminineWeightCalculation + FeminineStatureCalculation - FeminineAgeCalculation));
            caloriesNecessary = dailyCaloriesResult * 0.20;
            dailyCalories.value = dailyCaloriesResult + caloriesNecessary;

        }
    }

    
    if(typeOfDiet.value == 'Padrão'){ // Carboidrato 50%, Proteína 20%, Gordura 30%
        //Calculos de macros nutrientes. // valor maximo 3 total 
        dailyCarbohydrate.value = parseFloat(4.63 * weight.value).toFixed(1); 
        dailyProtein.value = parseFloat(1.85 * weight.value).toFixed(1); 
        dailyFat.value = parseFloat(1.25 * weight.value).toFixed(1); 

        dailyProteinKcal.value = parseFloat((2 * weight.value) * 4).toFixed(1); // quantidade de kcal por kilo de proteina
        dailyFatKcal.value = parseFloat(dailyCalories.value * 0.30).toFixed(1); // quantidade de kcal por kilo de gordura
        dailyCarbohydrateKcal.value = parseFloat(dailyCalories.value - (parseFloat(dailyProteinKcal.value) + parseFloat(dailyFatKcal.value))).toFixed(1); // quantidade de kcal por kilo de carbo
    
    }else if(typeOfDiet.value == 'Equilibrado'){ // Carboidrato 50%, Proteína 25%, Gordura 25%
        //Calculos de macros nutrientes. // valor maximo 3 total 
        dailyCarbohydrate.value = parseFloat(4.63 * weight.value).toFixed(1); 
        dailyProtein.value = parseFloat(2.33 * weight.value).toFixed(1); 
        dailyFat.value = parseFloat(1.04 * weight.value).toFixed(1); 

        dailyProteinKcal.value = parseFloat((2 * weight.value) * 4.65).toFixed(1); // quantidade de kcal por kilo de proteina
        dailyFatKcal.value = parseFloat(dailyCalories.value * 0.241).toFixed(1); // quantidade de kcal por kilo de gordura
        dailyCarbohydrateKcal.value = parseFloat(dailyCalories.value - (parseFloat(dailyProteinKcal.value) + parseFloat(dailyFatKcal.value))).toFixed(1); // quantidade de kcal por kilo de carbo

    }else if(typeOfDiet.value == 'Pobre em gorduras'){ // Carboidrato 60%, Proteína 25%, Gordura 15%
        //Calculos de macros nutrientes. // valor maximo 3 total 
        dailyCarbohydrate.value = parseFloat(5.5 * weight.value).toFixed(1); 
        dailyProtein.value = parseFloat(2.32 * weight.value).toFixed(1); 
        dailyFat.value = parseFloat(0.62 * weight.value).toFixed(1); 

        dailyProteinKcal.value = parseFloat((2 * weight.value) * 4.63).toFixed(1); // quantidade de kcal por kilo de proteina
        dailyFatKcal.value = parseFloat(dailyCalories.value * 0.183).toFixed(1); // quantidade de kcal por kilo de gordura
        dailyCarbohydrateKcal.value = parseFloat(dailyCalories.value - (parseFloat(dailyProteinKcal.value) + parseFloat(dailyFatKcal.value))).toFixed(1); // quantidade de kcal por kilo de carbo

    }else if(typeOfDiet.value == 'Rico em proteínas'){ // Carboidrato 25%, Proteína 40%, Gordura 35%
        //Calculos de macros nutrientes. // valor maximo 3 total 
        dailyCarbohydrate.value = parseFloat(2.32 * weight.value).toFixed(1); 
        dailyProtein.value = parseFloat(3.7 * weight.value).toFixed(1); 
        dailyFat.value = parseFloat(1.45 * weight.value).toFixed(1); 

        dailyProteinKcal.value = parseFloat((2 * weight.value) * 7.4).toFixed(1); // quantidade de kcal por kilo de proteina
        dailyFatKcal.value = parseFloat(dailyCalories.value * 0.338).toFixed(1); // quantidade de kcal por kilo de gordura
        dailyCarbohydrateKcal.value = parseFloat(dailyCalories.value - (parseFloat(dailyProteinKcal.value) + parseFloat(dailyFatKcal.value))).toFixed(1); // quantidade de kcal por kilo de carbo

    }else if(typeOfDiet.value == 'Catogénica'){ // Catogénica (Atkins) // Carboidrato 5%, Proteína 30%, Gordura 65%
        //Calculos de macros nutrientes. // valor maximo 3 total 
        dailyCarbohydrate.value = parseFloat(0.46 * weight.value).toFixed(1); 
        dailyProtein.value = parseFloat(2.78 * weight.value).toFixed(1); 
        dailyFat.value = parseFloat(2.68 * weight.value).toFixed(1); 

        dailyProteinKcal.value = parseFloat((2 * weight.value) * 5.56).toFixed(1); // quantidade de kcal por kilo de proteina
        dailyFatKcal.value = parseFloat(dailyCalories.value * 0.6233).toFixed(1); // quantidade de kcal por kilo de gordura
        dailyCarbohydrateKcal.value = parseFloat(dailyCalories.value - (parseFloat(dailyProteinKcal.value) + parseFloat(dailyFatKcal.value))).toFixed(1); // quantidade de kcal por kilo de carbo
    }
    
}


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

}else if(typeOfDietHidden.value === 'Catogénica'){

    $("#typeOfDietId").val('Catogénica'); //Seleciona option através de value

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





