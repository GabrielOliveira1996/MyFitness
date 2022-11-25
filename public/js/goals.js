
// Exemplo de utilização do axios.
/*
function allFoods(){

    axios
        .get('http://localhost:8000/api/food/all')
        .then((response) => {
            const repos = response.data
            //console.log(repos[0].quantity_grams);
        });

}
*/


const elements = document.querySelectorAll('[name="quantity_grams"]');
const perGrams = [];
elements.forEach(element => {
    const quantityGramsValue = element.value || 1;
    const [, value] = element.id.split('-');
    const quantityCalorieValue = document.getElementById(`quantityCalorieId-${value}`).value || 0;
    const quantityCarbohydrateValue = document.getElementById(`quantityCarbohydrateId-${value}`).value || 0;
    const quantityProteinValue = document.getElementById(`quantityProteinId-${value}`).value || 0;
    const quantityTotalFatValue = document.getElementById(`quantityTotalFatId-${value}`).value || 0;
    const quantitySaturatedFatValue = document.getElementById(`quantitySaturatedFatId-${value}`).value || 0;
    const quantityTransFatValue = document.getElementById(`quantityTransFatId-${value}`).value || 0;

    let quantityCaloriePerGram = (quantityCalorieValue / quantityGramsValue);
    let quantityCarbohydratePerGram = (quantityCarbohydrateValue / quantityGramsValue);
    let quantityProteinPerGram = (quantityProteinValue / quantityGramsValue);
    let quantityTotalFatPerGram = (quantityTotalFatValue / quantityGramsValue);
    let quantitySaturedFatPerGram = (quantitySaturatedFatValue / quantityGramsValue);
    let quantityTransFatPerGram = (quantityTransFatValue / quantityGramsValue);

    perGrams[value] = {
        quantityCaloriePerGram,
        quantityCarbohydratePerGram,
        quantityProteinPerGram,
        quantityTotalFatPerGram,
        quantitySaturedFatPerGram,
        quantityTransFatPerGram
    };
});


elements.forEach(element => {
    element.addEventListener("input", quantityGramsModify);
});

function quantityGramsModify(e) {
    const quantityGrams = e.target;
    const [, value] = e.target.id.split('-'); 
    const quantityCalorie = document.getElementById(`quantityCalorieId-${value}`);
    const quantityCarbohydrate = document.getElementById(`quantityCarbohydrateId-${value}`);
    const quantityProtein = document.getElementById(`quantityProteinId-${value}`);
    const quantityTotalFat = document.getElementById(`quantityTotalFatId-${value}`);
    const quantitySaturatedFat = document.getElementById(`quantitySaturatedFatId-${value}`);
    const quantityTransFat = document.getElementById(`quantityTransFatId-${value}`);
    const quantityGramsValue = quantityGrams.value || 1;

    quantityCalorie.value = (perGrams[value].quantityCaloriePerGram * quantityGramsValue).toFixed(2);
    quantityCarbohydrate.value = (perGrams[value].quantityCarbohydratePerGram * quantityGramsValue).toFixed(2);
    quantityProtein.value = (perGrams[value].quantityProteinPerGram * quantityGramsValue).toFixed(2);
    quantityTotalFat.value = (perGrams[value].quantityTotalFatPerGram * quantityGramsValue).toFixed(2);
    quantitySaturatedFat.value = (perGrams[value].quantitySaturedFatPerGram * quantityGramsValue).toFixed(2);
    quantityTransFat.value = (perGrams[value].quantityTransFatPerGram * quantityGramsValue).toFixed(2);
}
