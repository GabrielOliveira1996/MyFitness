const { createApp } = Vue;

// TBM = Taxa Mebolica Basal
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
            // Cálculo do imc.
            imcId.value = parseFloat(
                weightId.value / (statureId.value * statureId.value)
            ).toFixed(1);

            // Cálculo requisitos de água.
            waterId.value = weightId.value * 35;

            // Cálculos TMB para formula do sexo masculino.
            let masculineWeightCalculation = 13.7 * weightId.value;
            let masculineStatureCalculation = 5 * (statureId.value * 100);
            let masculineAgeCalculation = 6.8 * ageId.value;

            // Cálculos TMB para formula do sexo masculino.
            let FeminineWeightCalculation = 9.6 * weightId.value;
            let FeminineStatureCalculation = 1.8 * statureId.value;
            let FeminineAgeCalculation = 4.7 * ageId.value;

            if (genderId.value == "Masculino") {
                if (objectiveId.value == "Perder peso rápidamente") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (66 +
                                masculineWeightCalculation +
                                masculineStatureCalculation -
                                masculineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * -0.2;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                    //basalMetabolicRate.value = dailyCalories.value - 0.20;
                } else if (objectiveId.value == "Perder peso lentamente") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (66 +
                                masculineWeightCalculation +
                                masculineStatureCalculation -
                                masculineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * -0.1;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                } else if (objectiveId.value == "Manter o peso") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (66 +
                                masculineWeightCalculation +
                                masculineStatureCalculation -
                                masculineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * 0;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                } else if (objectiveId.value == "Aumentar peso lentamente") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (66 +
                                masculineWeightCalculation +
                                masculineStatureCalculation -
                                masculineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * 0.1;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                } else {
                    // if(objective.value == 'aumentar peso rápidamente') //

                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (66 +
                                masculineWeightCalculation +
                                masculineStatureCalculation -
                                masculineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * 0.2;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                }
            } else {
                if (objectiveId.value == "Perder peso rápidamente") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactor.value *
                            (655 +
                                FeminineWeightCalculation +
                                FeminineStatureCalculation -
                                FeminineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * -0.2;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                } else if (objectiveId.value == "Perder peso lentamente") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (655 +
                                FeminineWeightCalculation +
                                FeminineStatureCalculation -
                                FeminineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * -0.1;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                } else if (objectiveId.value == "Manter o peso") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (655 +
                                FeminineWeightCalculation +
                                FeminineStatureCalculation -
                                FeminineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * 0;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                } else if (objectiveId.value == "Aumentar peso lentamente") {
                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (655 +
                                FeminineWeightCalculation +
                                FeminineStatureCalculation -
                                FeminineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * 0.1;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                } else {
                    // if(objective.value == 'aumentar peso rápidamente') //

                    let dailyCaloriesResult = parseInt(
                        activityRateFactorId.value *
                            (655 +
                                FeminineWeightCalculation +
                                FeminineStatureCalculation -
                                FeminineAgeCalculation)
                    );
                    caloriesNecessary = dailyCaloriesResult * 0.2;
                    dailyCaloriesId.value =
                        dailyCaloriesResult + caloriesNecessary;
                }
            }

            if (typeOfDietId.value == "Padrão") {
                // Carboidrato 50%, Proteína 20%, Gordura 30%
                dailyCarbohydrateId.value = parseFloat(
                    4.63 * weightId.value
                ).toFixed(1);
                dailyProteinId.value = parseFloat(
                    1.85 * weightId.value
                ).toFixed(1);
                dailyFatId.value = parseFloat(1.25 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(
                    2 * weightId.value * 4
                ).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(
                    dailyCaloriesId.value * 0.3
                ).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value -
                        (parseFloat(dailyProteinKcalId.value) +
                            parseFloat(dailyFatKcalId.value))
                ).toFixed(1); // quantidade de kcal por kilo de carbo
            } else if (typeOfDietId.value == "Equilibrado") {
                // Carboidrato 50%, Proteína 25%, Gordura 25%
                dailyCarbohydrateId.value = parseFloat(
                    4.63 * weightId.value
                ).toFixed(1);
                dailyProteinId.value = parseFloat(
                    2.33 * weightId.value
                ).toFixed(1);
                dailyFatId.value = parseFloat(1.04 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(
                    2 * weightId.value * 4.65
                ).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(
                    dailyCaloriesId.value * 0.241
                ).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value -
                        (parseFloat(dailyProteinKcalId.value) +
                            parseFloat(dailyFatKcalId.value))
                ).toFixed(1); // quantidade de kcal por kilo de carbo
            } else if (typeOfDietId.value == "Pobre em gorduras") {
                // Carboidrato 60%, Proteína 25%, Gordura 15%
                dailyCarbohydrateId.value = parseFloat(
                    5.5 * weightId.value
                ).toFixed(1);
                dailyProteinId.value = parseFloat(
                    2.32 * weightId.value
                ).toFixed(1);
                dailyFatId.value = parseFloat(0.62 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(
                    2 * weightId.value * 4.63
                ).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(
                    dailyCaloriesId.value * 0.183
                ).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value -
                        (parseFloat(dailyProteinKcalId.value) +
                            parseFloat(dailyFatKcalId.value))
                ).toFixed(1); // quantidade de kcal por kilo de carbo
            } else if (typeOfDietId.value == "Rico em proteínas") {
                // Carboidrato 25%, Proteína 40%, Gordura 35%
                dailyCarbohydrateId.value = parseFloat(
                    2.32 * weightId.value
                ).toFixed(1);
                dailyProteinId.value = parseFloat(3.7 * weightId.value).toFixed(
                    1
                );
                dailyFatId.value = parseFloat(1.45 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(
                    2 * weightId.value * 7.4
                ).toFixed(1); // quantidade de kcal por kilo de proteina
                dailyFatKcalId.value = parseFloat(
                    dailyCaloriesId.value * 0.338
                ).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value -
                        (parseFloat(dailyProteinKcalId.value) +
                            parseFloat(dailyFatKcalId.value))
                ).toFixed(1); // quantidade de kcal por kilo de carbo
            } else if (typeOfDietId.value == "Cetogénica") {
                // Carboidrato 5%, Proteína 30%, Gordura 65%
                dailyCarbohydrateId.value = parseFloat(
                    0.46 * weightId.value
                ).toFixed(1);
                dailyProteinId.value = parseFloat(
                    2.78 * weightId.value
                ).toFixed(1);
                dailyFatId.value = parseFloat(2.68 * weightId.value).toFixed(1);

                dailyProteinKcalId.value = parseFloat(
                    2 * weightId.value * 5.56
                ).toFixed(1); // quantidade de kcal por kilo de proteina 700,6
                dailyFatKcalId.value = parseFloat(
                    dailyCaloriesId.value * 0.625
                ).toFixed(1); // quantidade de kcal por kilo de gordura
                dailyCarbohydrateKcalId.value = parseFloat(
                    dailyCaloriesId.value -
                        (parseFloat(dailyProteinKcalId.value) +
                            parseFloat(dailyFatKcalId.value))
                ).toFixed(1); // quantidade de kcal por kilo de carbo

                /*
                if(dailyCarbohydrateKcal.value <= 0){
                    
                    dailyCarbohydrateKcal.value = 0;
                    dailyCarbohydrate.value = 0;
                }
                */
            }
        },
    },
}).mount("#perfil");
