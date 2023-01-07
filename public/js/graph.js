let Cabohydrate = document.getElementById('cabohydrateId');
let splitCabohydrate = Cabohydrate.value.split(" ");
let todayCabohydrate = splitCabohydrate[0];
let goalCabohydrate = splitCabohydrate[2];

let Protein = document.getElementById('proteinId');
let splitProtein = Protein.value.split(" ");
let todayProtein = splitProtein[0];
let goalProtein = splitProtein[2];

let Fat = document.getElementById('fatId');
let splitFat = Fat.value.split(" ");
let todayFat = splitFat[0];
let goalFat = splitFat[2];

(async function() {
    const data = {
    labels: [
        'Carboidratos',
        'Proteínas',
        'Gorduras'
    ],
    datasets: [{
        label: 'Seu consumo em gramas: ',
        data: [todayCabohydrate, todayProtein, todayFat],
        backgroundColor: [
        'rgb(220,53,69,255)',
        'rgb(13,110,253,255)',
        'rgb(255,193,7,255)'
        ],
        hoverOffset: 4
    }]
};

new Chart(
    document.getElementById('myChart'),
    {
    type: 'pie',
    data: data,
    }
);
})();