function allFoods(){

    axios
        .get('http://localhost:8000/api/food/all')
        .then((response) => {
            const repos = response.data
            //console.log(repos[0].quantity_grams);
        });

}

let quantityGramsFix = document.getElementById('quantityGramsFixId');
let quantityGrams = document.getElementById('quantityGramsId');

let quantityCalorieFix = document.getElementById('quantityCalorieFixId');
let quantityCalorie = document.getElementById('quantityCalorieId');

let quantityCarbohydrateFix = document.getElementById('quantityCarbohydrateFixId');
let quantityCarbohydrate = document.getElementById('quantityCarbohydrateId');

let quantityProteinFix = document.getElementById('quantityProteinFixId');
let quantityProtein = document.getElementById('quantityProteinId');

let quantityTotalFatFix = document.getElementById('quantityTotalFatFixId');
let quantityTotalFat = document.getElementById('quantityTotalFatId');

let quantitySaturatedFatFix = document.getElementById('quantitySaturatedFatFixId');
let quantitySaturatedFat = document.getElementById('quantitySaturatedFatId');

let quantityTransFatFix = document.getElementById('quantityTransFatFixId');
let quantityTransFat = document.getElementById('quantityTransFatId');

quantityGrams.addEventListener("keyup", this.quantityGramsModify);

function quantityGramsModify(){

    let modifiedValueQuantityCalorie = (quantityGrams.value * quantityCalorieFix.value) / quantityGramsFix.value;
    let modifiedValueQuantityCarbohydrate = (quantityGrams.value * quantityCarbohydrateFix.value) / quantityGramsFix.value;
    let modifiedValueQuantityProtein = (quantityGrams.value * quantityProteinFix.value) / quantityGramsFix.value;
    let modifiedValueQuantityTotalFat = (quantityGrams.value * quantityTotalFatFix.value) / quantityGramsFix.value;
    let modifiedValueQuantitySaturatedFat = (quantityGrams.value * quantitySaturatedFatFix.value) / quantityGramsFix.value;
    let modifiedValueQuantityTransFat = (quantityGrams.value * quantityTransFatFix.value) / quantityGramsFix.value;
    
    quantityCalorie.value = modifiedValueQuantityCalorie.toFixed(2);
    quantityCarbohydrate.value = modifiedValueQuantityCarbohydrate.toFixed(2);
    quantityProtein.value = modifiedValueQuantityProtein.toFixed(2);
    quantityTotalFat.value = modifiedValueQuantityTotalFat.toFixed(2);
    quantitySaturatedFat.value = modifiedValueQuantitySaturatedFat.toFixed(2);
    quantityTransFat.value = modifiedValueQuantityTransFat.toFixed(2);

}

