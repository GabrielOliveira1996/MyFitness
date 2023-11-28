const { createApp } = Vue;

createApp({
    el: '#goal-index',
    data() {
        return {
            axios: null,
            foods: [], // Alimentos encontrados na pesquisa.
            perGrams: [], // Macronutriente por grama.
            goalFoods: [], // Alimentos já adicionados ficaram nesta lista.
            foodName: '',
            error: '',
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
            carbohydratePercentage: '',
            proteinPercentage: '',
            fatPercentage: '',
            quantityGramsIdU: null,
            quantityCalorieIdU: null,
            quantityCarbohydrateIdU: null,
            quantityProteinIdU: null,
            quantityTotalFatIdU: null,
            quantitySaturatedFatIdU: null,
            quantityTransFatIdU: null,
        };
    },
    mounted() {
        this.calculations();
        this.fetchData();
        this.goalGraph();
    },
    methods: { 
        calculatePerGrams() { 
            this.perGrams = this.foods.map(food => {
                const quantityGramsValue = food.quantity_grams || 1;
                return {
                    quantityCaloriePerGram: food.calories / quantityGramsValue,
                    quantityCarbohydratePerGram: food.carbohydrate / quantityGramsValue,
                    quantityProteinPerGram: food.protein / quantityGramsValue,
                    quantityTotalFatPerGram: food.total_fat / quantityGramsValue,
                    quantitySaturatedFatPerGram: food.saturated_fat / quantityGramsValue,
                    quantityTransFatPerGram: food.trans_fat / quantityGramsValue,
                };
            });
        },
        quantityGramsModify(e, index) {
            const quantityGrams = e.target;
            const quantityCalorie = document.getElementById(`quantityCalorieId-${index}`);
            const quantityCarbohydrate = document.getElementById(`quantityCarbohydrateId-${index}`);
            const quantityProtein = document.getElementById(`quantityProteinId-${index}`);
            const quantityTotalFat = document.getElementById(`quantityTotalFatId-${index}`);
            const quantitySaturatedFat = document.getElementById(`quantitySaturatedFatId-${index}`);
            const quantityTransFat = document.getElementById(`quantityTransFatId-${index}`);
            
            const quantityGramsValue = quantityGrams.value || 1;
            
            if (this.perGrams[index]) {
                quantityCalorie.value = (this.perGrams[index].quantityCaloriePerGram * quantityGramsValue).toFixed(2);
                quantityCarbohydrate.value = (this.perGrams[index].quantityCarbohydratePerGram * quantityGramsValue).toFixed(2);
                quantityProtein.value = (this.perGrams[index].quantityProteinPerGram * quantityGramsValue).toFixed(2);
                quantityTotalFat.value = (this.perGrams[index].quantityTotalFatPerGram * quantityGramsValue).toFixed(2);
                quantitySaturatedFat.value = (this.perGrams[index].quantitySaturatedFatPerGram * quantityGramsValue).toFixed(2);
                quantityTransFat.value = (this.perGrams[index].quantityTransFatPerGram * quantityGramsValue).toFixed(2);
            }
        },

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
        fillInMacronutrientPercentage(){
            if (typeOfDietId.value == 1) { 
                this.carbohydratePercentage = '50%';
                this.proteinPercentage = '20%';
                this.fatPercentage = '30%';
            } 
            if (typeOfDietId.value == 2) { 
                this.carbohydratePercentage = '50%';
                this.proteinPercentage = '25%';
                this.fatPercentage = '25%';
            } 
            if (typeOfDietId.value == 3) {
                this.carbohydratePercentage = '60%';
                this.proteinPercentage = '25%';
                this.fatPercentage = '15%';
            } 
            if (typeOfDietId.value == 4) { 
                this.carbohydratePercentage = '25%';
                this.proteinPercentage = '40%';
                this.fatPercentage = '35%';
            } 
            if (typeOfDietId.value == 5) {
                this.carbohydratePercentage = '5%';
                this.proteinPercentage = '30%';
                this.fatPercentage = '65%';
            }
        },
        calculations() {
            imcId.value = this.calculusImc();
            waterId.value = this.calculusWater();
            
            if (genderId.value === 1) { // Gender Masculine
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

            if(genderId.value === 2) { // Gender Feminine
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

                this.fillInMacronutrientPercentage();
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

                this.fillInMacronutrientPercentage();
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

                this.fillInMacronutrientPercentage();
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

                this.fillInMacronutrientPercentage();
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

                this.fillInMacronutrientPercentage();
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
        },
        passingDataToModal(event) {
            let foodId = event.target.getAttribute('data-food-id');
            let foodName = event.target.getAttribute('data-food-name');
            let foodQuantityGrams = event.target.getAttribute('data-food-quantity-grams'); 
            let foodCalories = event.target.getAttribute('data-food-calories');  
            let foodCarbohydrate = event.target.getAttribute('data-food-carbohydrate');  
            let foodProtein = event.target.getAttribute('data-food-protein');  
            let foodTotalFat = event.target.getAttribute('data-food-total-fat');  
            let foodSaturatedFat = event.target.getAttribute('data-food-saturated-fat'); 
            let foodTransFat = event.target.getAttribute('data-food-trans-fat');  
            let foodTypeOfMeal = event.target.getAttribute('data-food-type-of-meal');  
            
            // Preenche os campos do modal com os valores obtidos.
            $('#foodId').val(foodId);
            $('#foodName').val(foodName);
            $('#foodQuantityGrams').val(foodQuantityGrams);
            $('#foodCalories').val(foodCalories);
            $('#foodCarbohydrate').val(foodCarbohydrate);
            $('#foodProtein').val(foodProtein);
            $('#foodTotalFat').val(foodTotalFat);
            $('#foodSaturatedFat').val(foodSaturatedFat);
            $('#foodTransFat').val(foodTransFat);
            $('#foodTypeOfMeal').val(foodTypeOfMeal);

            $('#FoodEditingModal').find('input[name="id"]').val(foodId);
            $('#FoodEditingModal').find('input[name="name"]').val(foodName);
            $('#FoodEditingModal').find('input[name="quantity_grams"]').val(foodQuantityGrams);
            $('#FoodEditingModal').find('input[name="calories"]').val(foodCalories);
            $('#FoodEditingModal').find('input[name="carbohydrate"]').val(foodCarbohydrate);
            $('#FoodEditingModal').find('input[name="protein"]').val(foodProtein);
            $('#FoodEditingModal').find('input[name="total_fat"]').val(foodTotalFat);
            $('#FoodEditingModal').find('input[name="saturated_fat"]').val(foodSaturatedFat);
            $('#FoodEditingModal').find('input[name="trans_fat"]').val(foodTransFat);
            $('#FoodEditingModal').find('select[name="type_of_meal"]').val(foodTypeOfMeal);
            
            this.calculatePerGramsU();
        },
        calculatePerGramsU() {  
            let quantityGramsValue = document.getElementById('quantityGramsIdU').value || 1;
            this.perGrams = {
                quantityCaloriePerGram: document.getElementById('quantityCalorieIdU').value / quantityGramsValue,
                quantityCarbohydratePerGram: document.getElementById('quantityCarbohydrateIdU').value / quantityGramsValue,
                quantityProteinPerGram: document.getElementById('quantityProteinIdU').value / quantityGramsValue,
                quantityTotalFatPerGram: document.getElementById('quantityTotalFatIdU').value / quantityGramsValue,
                quantitySaturatedFatPerGram: document.getElementById('quantitySaturatedFatIdU').value / quantityGramsValue,
                quantityTransFatPerGram: document.getElementById('quantityTransFatIdU').value / quantityGramsValue,
            };     
        },
        quantityGramsModifyU(event) {
            let quantityGrams = event.target;
            let quantityGramsValue = quantityGrams.value || 1;
            if (this.perGrams) {
                this.quantityCalorieIdU = (this.perGrams.quantityCaloriePerGram * quantityGramsValue).toFixed(2);
                this.quantityCarbohydrateIdU = (this.perGrams.quantityCarbohydratePerGram * quantityGramsValue).toFixed(2);
                this.quantityProteinIdU = (this.perGrams.quantityProteinPerGram * quantityGramsValue).toFixed(2);
                this.quantityTotalFatIdU = (this.perGrams.quantityTotalFatPerGram * quantityGramsValue).toFixed(2);
                this.quantitySaturatedFatIdU = (this.perGrams.quantitySaturatedFatPerGram * quantityGramsValue).toFixed(2);
                this.quantityTransFatIdU = (this.perGrams.quantityTransFatPerGram * quantityGramsValue).toFixed(2);
            }
        },
        async searchFoodGoal() {
            let food = this.foodName;
            const requestUrl = `http://localhost:8000/api/goal/search-food?name=${food}`;
            if(!food){ // Se não for passado nenhum nome no input.
                this.foods = [];
                this.error = 'Nenhum nome de alimento foi passado.';
            }else{
                const response = await axios.get(requestUrl);
                if(response.data.foods && response.data.foods.length > 0){ // Se exitir alimentos.
                    this.foods = response.data.foods;
                    this.$nextTick(() => {
                        this.calculatePerGrams();
                    });
                }else{ // Se for retornado erro do backend.
                    this.foods = [];
                }
            }
        },
        deleteFoodGoal(event){
            let foodId = event.target.getAttribute('data-food-id');
            let foodIndex = event.target.getAttribute('data-food-index');
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir alimento!',
                cancelButtonText: 'Não, cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    const requestUrl = `http://localhost:8000/api/goal/delete`;
                    const response = axios.post(requestUrl, {
                        _method: 'DELETE',
                        id: foodId,
                    }).then(response => {
                        if(response.data){ // Se exitir alimento.

                            if (foodIndex !== -1) {
                                this.goalFoods.splice(foodIndex, 1);
                            }

                            Swal.fire(
                                'Excluído!',
                                'Seu alimento foi excluído.',
                                'success'
                            );
                        }
                    });
                }
            });
        },
        async fetchData() {
            const dataAtual = new Date();
            const ano = dataAtual.getFullYear();
            const mes = (dataAtual.getMonth() + 1).toString().padStart(2, '0'); 
            const dia = dataAtual.getDate().toString().padStart(2, '0');
            const date = `${ano}-${mes}-${dia}`;
            const requestUrl = `http://localhost:8000/api/goal/${date}`;
            const token = localStorage.getItem('token');

            axios.defaults.headers.common['Authorization'] = token;

            const response = await axios.get(requestUrl);
            if(response.data.goalFoods && response.data.goalFoods.length > 0){ // Se exitir alimentos.
                this.goalFoods = response.data.goalFoods;
            }else{ // Se for retornado erro do backend.
                this.goalFoods = [];
            }
        },
        async searchGoalByDate() {
            const date = document.getElementById('dateInput').value;
            const requestUrl = `http://localhost:8000/api/goal/${date}/search-goal-by-date`;
            const token = localStorage.getItem('token');

            axios.defaults.headers.common['Authorization'] = token;
            
            const response = await axios.get(requestUrl);
            if(response.data.goalFoods && response.data.goalFoods.length > 0){ // Se exitir alimentos.
                this.goalFoods = response.data.goalFoods;
            }else{ // Se for retornado erro do backend.
                this.goalFoods = [];
            }
        },
        goalGraph(){
            let Carbohydrate = document.getElementById("carbohydrateId");
            let Protein = document.getElementById("proteinId");
            let Fat = document.getElementById("fatId");

            if (Carbohydrate && Protein && Fat) {
                let splitCarbohydrate = Carbohydrate.value.split(" ");
                let todayCarbohydrate = splitCarbohydrate[1];
                let goalCarbohydrate = splitCarbohydrate[3];

                let splitProtein = Protein.value.split(" ");
                let todayProtein = splitProtein[1];
                let goalProtein = splitProtein[3];

                let splitFat = Fat.value.split(" ");
                let todayFat = splitFat[1];
                let goalFat = splitFat[3];

                // Cálculo dos valores consumidos vs. objetivos
                let carboCalc = Math.min(todayCarbohydrate, goalCarbohydrate);
                let protCalc = Math.min(todayProtein, goalProtein);
                let gordCalc = Math.min(todayFat, goalFat);

                // Cálculo do valor total
                let total = (goalCarbohydrate - carboCalc) + (goalProtein - protCalc) + (goalFat - gordCalc);

                const data = {
                    labels: ['Carboidrato', 'Proteína', 'Gordura', 'Falta Consumir'],
                    datasets: [
                        {
                            label: 'Quantidade em gramas',
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
            }
        }
    },
      
  }).mount("#goal-index");

