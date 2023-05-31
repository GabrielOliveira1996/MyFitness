let Carbohydrate = document.getElementById("carbohydrateId");
let splitCarbohydrate = Carbohydrate.value.split(" ");
let todayCarbohydrate = splitCarbohydrate[0];
let goalCarbohydrate = splitCarbohydrate[2];

let Protein = document.getElementById("proteinId");
let splitProtein = Protein.value.split(" ");
let todayProtein = splitProtein[0];
let goalProtein = splitProtein[2];

let Fat = document.getElementById("fatId");
let splitFat = Fat.value.split(" ");
let todayFat = splitFat[0];
let goalFat = splitFat[2];

// necessário definir quantidade máxima carb, pro e gord
let carboCalc = parseFloat(todayCarbohydrate) > parseFloat(goalCarbohydrate) ? parseFloat(goalCarbohydrate) : parseFloat(todayCarbohydrate);
let protCalc = parseFloat(todayProtein) > parseFloat(goalProtein) ? parseFloat(goalProtein) : parseFloat(todayProtein);
let gordCalc = parseFloat(todayFat) > parseFloat(goalFat) ? parseFloat(goalFat) : parseFloat(todayFat);
let total =
    parseFloat(goalCarbohydrate) +
    parseFloat(goalProtein) +
    parseFloat(goalFat) -
    (parseFloat(carboCalc) +
    parseFloat(protCalc) +
    parseFloat(gordCalc));


let infoCarbohydrate;
let infoProtein;
let infoFat;
let infoTotal;
let infoLabel;

const language = window.navigator.language;
if (language === "pt-BR") {
    infoCarbohydrate = "Carboidratos";
    infoProtein = "Proteínas";
    infoFat = "Gorduras";
    infoTotal = "Falta consumir";
    infoLabel = "Quandidade em gramas";
} 

(async function () {
    const data = {
        labels: [infoCarbohydrate, infoProtein, infoFat, infoTotal],
        datasets: [
            {
                label: infoLabel,
                data: [
                    carboCalc, protCalc, gordCalc, total
                ],
                backgroundColor: [
                    "rgb(220, 53, 69, 255)",
                    "rgb(13, 110, 253, 255)",
                    "rgb(255, 193, 7, 255)",
                    "rgb(25, 135, 84)",
                ],
                hoverOffset: 4,
            },
        ],
    };

    new Chart(document.getElementById("chart"), {
        type: "pie",
        data: data,
    });
})();
