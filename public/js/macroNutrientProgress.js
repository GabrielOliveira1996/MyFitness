
//User target macro nutrients.
let goalCalories = document.getElementById('goalCaloriesId');
let goalCarbohydrate = document.getElementById('goalCarbohydrateId');
let goalProtein = document.getElementById('goalProteinId');
let goalTotalFat = document.getElementById('goalTotalFatId');

//Todays macro nutrients.
let todaysCalories = document.getElementById('todaysCaloriesId');
let todaysCarbohydrate = document.getElementById('todaysCarbohydrateId');
let todaysProtein = document.getElementById('todaysProteinId');
let todaysTotalFat = document.getElementById('todaysTotalFatId');

//Nutrient progress bar of the day.
let progressbarCalorie = document.getElementById('progressbarCalorieId');
let progressbarCarbohydrate = document.getElementById('progressbarCarbohydrateId');
let progressbarProtein = document.getElementById('progressbarProteinId');
let progressbarTotalFat = document.getElementById('progressbarTotalFatId');

//Calorie value calculations.
let equivalentOnePercentCalorie = goalCalories.value / 100;
let finalValueCalorie = parseInt(todaysCalories.value / equivalentOnePercentCalorie);
progressbarCalorie.style.width = `${finalValueCalorie}%`;

//Carbohydrate value calculations.
//console.log(goalCarbohydrate.value);
let equivalentOnePercentCarbohydrate = goalCarbohydrate.value / 100;
let finalValueCarbohydrate = parseInt(todaysCarbohydrate.value / equivalentOnePercentCarbohydrate);
progressbarCarbohydrate.style.width = `${finalValueCarbohydrate}%`;

//Protein value calculations.
let equivalentOnePercentProtein = goalProtein.value / 100;
let finalValueProtein = parseInt(todaysProtein.value / equivalentOnePercentProtein);
progressbarProtein.style.width = `${finalValueProtein}%`;

//Fat value calculations.
let equivalentOnePercentTotalFat = goalTotalFat.value / 100;
let finalValueTotalFat = parseInt(todaysTotalFat.value / equivalentOnePercentTotalFat);
progressbarTotalFat.style.width = `${finalValueTotalFat}%`;



