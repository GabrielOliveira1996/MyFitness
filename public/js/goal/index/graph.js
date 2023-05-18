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

let total =
    parseFloat(goalCarbohydrate) +
    parseFloat(goalProtein) +
    parseFloat(goalFat) -
    (parseFloat(todayCarbohydrate) +
        parseFloat(todayProtein) +
        parseFloat(todayFat));

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
} else {
    infoCarbohydrate = "Carbohydrate";
    infoProtein = "Protein";
    infoFat = "Fat";
    infoTotal = "Lack to consume";
    infoLabel = "Amount in grams";
}

(async function () {
    const data = {
        labels: [infoCarbohydrate, infoProtein, infoFat, infoTotal],
        datasets: [
            {
                label: infoLabel,
                data: [todayCarbohydrate, todayProtein, todayFat, total],
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
