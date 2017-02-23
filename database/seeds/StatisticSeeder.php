<?php

use Illuminate\Database\Seeder;
use App\Statistic;
use App\User;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statistic = new Statistic();
        $statistic->goals = 0;
        $statistic->owngoals = 0;
        $statistic->points = 0;
        $statistic->wins = 0;
        $statistic->loses = 0;
        $statistic->draws = 0;
        $statistic->totalgames = 0;
        $statistic->save();

        $statistic = new Statistic();
        $statistic->goals = 0;
        $statistic->owngoals = 0;
        $statistic->points = 0;
        $statistic->wins = 0;
        $statistic->loses = 0;
        $statistic->draws = 0;
        $statistic->totalgames = 0;
        $statistic->save();


        $statistic = new Statistic();
        $statistic->goals = 0;
        $statistic->owngoals = 0;
        $statistic->points = 0;
        $statistic->wins = 0;
        $statistic->loses = 0;
        $statistic->draws = 0;
        $statistic->totalgames = 0;
        $statistic->save();

        $statistic = new Statistic();
        $statistic->goals = 0;
        $statistic->owngoals = 0;
        $statistic->points = 0;
        $statistic->wins = 0;
        $statistic->loses = 0;
        $statistic->draws = 0;
        $statistic->totalgames = 0;
        $statistic->save();


    }
}
