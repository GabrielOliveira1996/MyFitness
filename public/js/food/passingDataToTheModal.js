$(document).ready(function() {
    $('.edit-food-btn').click(function() {
        var foodId = $(this).data('food-id');
        var foodName = $(this).data('food-name');
        var foodQuantityGrams = $(this).data('food-quantity-grams');
        var foodCalories = $(this).data('food-calories');
        var foodCarbohydrate = $(this).data('food-carbohydrate');
        var foodProtein = $(this).data('food-protein');
        var foodTotalFat = $(this).data('food-total-fat');
        var foodSaturatedFat = $(this).data('food-saturated-fat');
        var foodTransFat = $(this).data('food-trans-fat');
        
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

        $('#FoodEditingModal').find('input[name="id"]').val(foodId);
        $('#FoodEditingModal').find('input[name="name"]').val(foodName);
        $('#FoodEditingModal').find('input[name="quantity_grams"]').val(foodQuantityGrams);
        $('#FoodEditingModal').find('input[name="calories"]').val(foodCalories);
        $('#FoodEditingModal').find('input[name="carbohydrate"]').val(foodCarbohydrate);
        $('#FoodEditingModal').find('input[name="protein"]').val(foodProtein);
        $('#FoodEditingModal').find('input[name="total_fat"]').val(foodTotalFat);
        $('#FoodEditingModal').find('input[name="saturated_fat"]').val(foodSaturatedFat);
        $('#FoodEditingModal').find('input[name="trans_fat"]').val(foodTransFat);
    });
});