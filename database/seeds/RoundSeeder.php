<?php

use Illuminate\Database\Seeder;
use App\Round;
class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $round = new Round();
        $round->name="Gruppen Phase";
        $round->save();

        $round = new Round();
        $round->name="Achtelfinale";
        $round->save();

        $round = new Round();
        $round->name="Viertelfinale";
        $round->save();

        $round = new Round();
        $round->name="Halbfinale";
        $round->save();

        $round = new Round();
        $round->name="Finale";
        $round->save();
    }
}
