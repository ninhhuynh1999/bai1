<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         factory(App\User::class, 4)->create();
         
        factory(App\ShippingUnit::class, 1000)->create();
    }
}
