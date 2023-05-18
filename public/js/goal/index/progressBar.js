//Nutrient progress bar of the day.
let progressbarCalorie = document.getElementById("progressbarCalorieId");
let progressbarCarbohydrate = document.getElementById(
    "progressbarCarbohydrateId"
);
let progressbarProtein = document.getElementById("progressbarProteinId");
let progressbarTotalFat = document.getElementById("progressbarTotalFatId");

//Calories
let calories = document.getElementById("caloriesId");
let splitCalories = calories.value.split(" ");
let todayCalories = splitCalories[0];
let goalCalories = splitCalories[2];

//Calorie value calculations.
let equivalentOnePercentCalorie = goalCalories / 100;
let finalValueCalorie = parseInt(todayCalories / equivalentOnePercentCalorie);
progressbarCalorie.style.width = `${finalValueCalorie}%`;

//Cabohydrate
let Carbohydrate = document.getElementById("carbohydrateId");
let splitCarbohydrate = Carbohydrate.value.split(" ");
let todayCarbohydrate = splitCarbohydrate[0];
let goalCarbohydrate = splitCarbohydrate[2];

//Carbohydrate value calculations.
let equivalentOnePercentCarbohydrate = goalCarbohydrate / 100;
let finalValueCarbohydrate = parseInt(
    todayCarbohydrate / equivalentOnePercentCarbohydrate
);
progressbarCarbohydrate.style.width = `${finalValueCarbohydrate}%`;

//Protein
let Protein = document.getElementById("proteinId");
let splitProtein = Protein.value.split(" ");
let todayProtein = splitProtein[0];
let goalProtein = splitProtein[2];

//Protein value calculations.
let equivalentOnePercentProtein = goalProtein / 100;
let finalValueProtein = parseInt(todayProtein / equivalentOnePercentProtein);
progressbarProtein.style.width = `${finalValueProtein}%`;

//Fat
let Fat = document.getElementById("fatId");
let splitFat = Fat.value.split(" ");
let todayFat = splitFat[0];
let goalFat = splitFat[2];

//Fat value calculations.
let equivalentOnePercentTotalFat = goalFat / 100;
let finalValueTotalFat = parseInt(todayFat / equivalentOnePercentTotalFat);
progressbarTotalFat.style.width = `${finalValueTotalFat}%`;
