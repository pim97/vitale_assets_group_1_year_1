<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LoadLevelSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BreachLocationSeeder::class);
        $this->call(NewsCategorySeeder::class);
        $this->call(AssetSeeder::class);
    }
}
