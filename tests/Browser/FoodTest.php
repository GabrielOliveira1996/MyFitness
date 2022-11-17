<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FoodTest extends DuskTestCase
{

    /** @test */
    public function createFoodTest(){

        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('email', 'gab-oliveira@hotmail.com')
                    ->type('password', '123456789')
                    ->press('Login')
                    ->assertPathIs('/home')
                    ->visit('/food/create')
                    ->type('name', 'food test')
                    ->type('protein', '1')
                    ->type('carbohydrate', '2')
                    ->type('saturated_fat', '3')
                    ->type('monounsaturated_fat', '4')
                    ->type('polyunsaturated_fat', '5')
                    ->press('Adicionar')
                    ->assertPathIs('/home');
        });

    }
}
