const { createApp } = Vue;


////////////////////////////////////////////////////
// Cálculos de equação de Harris-Benedict, equação
// consiste  em uma fórmula que utiliza a altura, 
// peso, idade e gênero de uma pessoa para calcular 
// sua taxa metabólica basal (TMB). Essa pode não
// ser a opção mais indicada para algumas pessoas,
// uma vez que esta equação não considera a massa
// corporal livre de gordura nem a relação entre 
// massa muscular e massa gorda. Outros tipos de 
// cálculos mais complexos vão ser adicionados. 

createApp({
    el: "#perfil",
    data() {
        return {
            statureId: "statureId",
            weightId: "weightId",
            genderId: "genderId",
            ageId: "ageId",
            activityRateFactorId: "activityRateFactorId",
            objectiveId: "objectiveId",
            typeOfDietId: "typeOfDietId",
            imcId: "imcId",
            waterId: "waterId",
            dailyCaloriesId: "dailyCaloriesId",
            dailyCarbohydrateId: "dailyCarbohydrateId",
            dailyProteinId: "dailyProteinId",
            dailyFatId: "dailyFatId",
            dailyCarbohydrateKcalId: "dailyCarbohydrateKcalId",
            dailyProteinKcalId: "dailyProteinKcalId",
            dailyFatKcalId: "dailyFatKcalId",
        };
    },
    methods: {
        calculations() {
            imcId.value = this.calculusImc();
            waterId.value = this.calculusWater();
            
            if (genderId.value == 1) { // Gender Masculine
                if (objectiveId.value == 1) { // Objetive Perder peso rápidamente
                    let dailyCaloriesResult = this.calculusMasculineMetabolicBasalRate();
                } 
                if (objectiveId.value == 2) { // Objetive Perder peso lentamente
                    let dailyCaloriesResult = this.calculusMasculineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * -0.1;
                } 
                if (objectiveId.value == 3) { // Objetive Manter o peso
                    let dailyCaloriesResult = this.calculusMasculineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * 0;
                } 
                if (objectiveId.value == 4) { // Objetive Aumentar peso lentamente
                    let dailyCaloriesResult = this.calculusMasculineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * 0.1;
                } 
                if (objectiveId.value == 5) { // Objetive Aumentar peso rápidamente 
                    let dailyCaloriesResult = this.calculusMasculineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * 0.2;
                }
            } 

            if(genderId.value == 2) { // Gender Feminine
                if (objectiveId.value == 1) { // Objetive Perder peso rápidamente
                    let dailyCaloriesResult = this.calculusFeminineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * -0.2;
                } 
                if (objectiveId.value == 2) { // Objetive Perder peso lentamente
                    let dailyCaloriesResult = this.calculusFeminineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * -0.1;
                } 
                if (objectiveId.value == 3) { // Objetive Manter o peso
                    let dailyCaloriesResult = this.calculusFeminineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * 0;
                } 
                if (objectiveId.value == 4) { // Objetive Aumentar peso lentamente
                    let dailyCaloriesResult = this.calculusFeminineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * 0.1;
                } 
                if (objectiveId.value == 5) { // Objetive Aumentar peso rápidamente
                    let dailyCaloriesResult = this.calculusFeminineMetabolicBasalRate();
                    dailyCaloriesId.value = dailyCaloriesResult + dailyCaloriesResult * 0.2;
                }
            }

            if (typeOfDietId.value == 1) { // Type of diet Padrão
                // Carboidrato 50%, Proteína 20%, Gordura 30%
                dailyCarbohydrateId.value = parseFloat(4.63 * weightId.value).toFixed(1);
                dailyProteinId.value = parseFloat(1.85 * weightId.value).toFixed(1);
                dailyFatId.value = parseFloat(1.25 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(2 * weightId.value * 4).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(dailyCaloriesId.value * 0.36 ).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value - 
                    (parseFloat(dailyProteinKcalId.value) + 
                    parseFloat(dailyFatKcalId.value))).toFixed(1); // quantidade de kcal por kilo de carbo
            } 
            if (typeOfDietId.value == 2) { // Type of diet Equilibrado
                // Carboidrato 50%, Proteína 25%, Gordura 25%
                dailyCarbohydrateId.value = parseFloat(4.63 * weightId.value).toFixed(1);
                dailyProteinId.value = parseFloat(2.33 * weightId.value).toFixed(1);
                dailyFatId.value = parseFloat(1.04 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(2 * weightId.value * 4.65).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(dailyCaloriesId.value * 0.241).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value - 
                    (parseFloat(dailyProteinKcalId.value) + 
                    parseFloat(dailyFatKcalId.value))).toFixed(1); // quantidade de kcal por kilo de carbo
            } 
            if (typeOfDietId.value == 3) { // Type of diet Pobre em gorduras
                // Carboidrato 60%, Proteína 25%, Gordura 15%
                dailyCarbohydrateId.value = parseFloat(5.5 * weightId.value).toFixed(1);
                dailyProteinId.value = parseFloat(2.32 * weightId.value).toFixed(1);
                dailyFatId.value = parseFloat(0.62 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(2 * weightId.value * 4.63).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(dailyCaloriesId.value * 0.183).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value - 
                    (parseFloat(dailyProteinKcalId.value) +
                    parseFloat(dailyFatKcalId.value))).toFixed(1); // quantidade de kcal por kilo de carbo
            } 
            if (typeOfDietId.value == 4) { // Type of diet Rico em proteínas
                // Carboidrato 25%, Proteína 40%, Gordura 35%
                dailyCarbohydrateId.value = parseFloat(2.32 * weightId.value).toFixed(1);
                dailyProteinId.value = parseFloat(3.7 * weightId.value).toFixed(1);
                dailyFatId.value = parseFloat(1.45 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(2 * weightId.value * 7.4).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(dailyCaloriesId.value * 0.338).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value - 
                    (parseFloat(dailyProteinKcalId.value) +
                    parseFloat(dailyFatKcalId.value))).toFixed(1); // quantidade de kcal por kilo de carbo
            } 
            if (typeOfDietId.value == 5) { // Type of diet Cetogénica
                // Carboidrato 5%, Proteína 30%, Gordura 65%
                dailyCarbohydrateId.value = parseFloat(0.46 * weightId.value).toFixed(1);
                dailyProteinId.value = parseFloat(2.78 * weightId.value).toFixed(1);
                dailyFatId.value = parseFloat(2.68 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(2 * weightId.value * 5.56).toFixed(1); // quantidade de kcal por kilo de proteina 700,6
                dailyFatKcalId.value = parseFloat(dailyCaloriesId.value * 0.625).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value - 
                    (parseFloat(dailyProteinKcalId.value) +
                    parseFloat(dailyFatKcalId.value))).toFixed(1); // quantidade de kcal por kilo de carbo
            }
        },
        calculusImc()
        {
            let weight = weightId.value;
            let stature = statureId.value/100;
            if(statureId.value.length >= 3){
                return (weight / (stature * stature)).toFixed(1);
            }
            return 0;
        },
        calculusWater()
        {
            return weightId.value * 35;
        },
        calculusMasculineMetabolicBasalRate()
        {
            return parseInt(
                activityRateFactorId.value * 
                (66 + (13.7 * weightId.value) + 
                (5 * statureId.value) - 
                (6.8 * ageId.value)));
        },
        calculusFeminineMetabolicBasalRate()
        {
            return parseInt(
                activityRateFactorId.value * 
                (655 + (9.6 * weightId.value) + 
                (1.8 * statureId.value) - 
                (4.7 * ageId.value)));
        }
    },
}).mount("#perfil");
