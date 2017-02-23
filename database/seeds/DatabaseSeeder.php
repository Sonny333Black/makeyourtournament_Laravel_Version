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
        $this->call(ModusSeeder::class);
        $this->call(StatisticSeeder::class);
        $this->call(RoundSeeder::class);

    }
}
