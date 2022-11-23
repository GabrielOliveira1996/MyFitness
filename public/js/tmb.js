

let showResult = document.getElementById('showResultId');

showResult.addEventListener('click', basalMetabolicRateCalculation);

function basalMetabolicRateCalculation(){

    let gender = document.getElementById('genderId');
    let age = document.getElementById('ageId');
    let weight = document.getElementById('weightId');
    let stature = document.getElementById('statureId');
    let activityRateFactor = document.getElementById('activityRateFactorId');
    let basalMetabolicRate = document.getElementById('basalMetabolicRateId');

    //Macro nutrientes.
    let dailyCarbohydrate = document.getElementById('dailyCarbohydrateId');
    let dailyProtein = document.getElementById('dailyProteinId');
    let dailyFat = document.getElementById('dailyFatId');

    //Calculos de macros nutrientes.
    dailyCarbohydrate.value = parseFloat(8 * weight.value).toFixed(1); //carbohydrate 8g/Kg
    dailyProtein.value = parseFloat(1.5 * weight.value).toFixed(1); //protein 0,8g/Kg
    dailyFat.value = parseFloat(0.7 * weight.value).toFixed(1); //fat 0,4g/Kg

    //Cálculos TMB para formula do sexo masculino.
    let masculineWeightCalculation = 13.7 * weight.value;
    let masculineStatureCalculation = 5 * stature.value;
    let masculineAgeCalculation = 6.8 * age.value;

    //Cálculos TMB para formula do sexo masculino.
    let FeminineWeightCalculation = 9.6 * weight.value;
    let FeminineStatureCalculation = 1.8 * stature.value;
    let FeminineAgeCalculation = 4.7 * age.value;

    if(gender.value == 'masculine'){

        result = parseInt(activityRateFactor.value * (66 + masculineWeightCalculation + masculineStatureCalculation - masculineAgeCalculation));
        
        basalMetabolicRate.value = result;

    }else if(gender.value == 'feminine'){
        
        result = parseInt(activityRateFactor.value * (655 + FeminineWeightCalculation + FeminineStatureCalculation - FeminineAgeCalculation));
        
        basalMetabolicRate.value = result;
    }

}

