<?php

use Illuminate\Database\Seeder;
use App\Modus;

class ModusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modu = new Modus();
        $modu->name="Gruppen & KO";
        $modu->description="Erst wird in Gruppen gespielt und dann KO Phase.";
        $modu->save();

        $modu = new Modus();
        $modu->name="Liga";
        $modu->description="Es wird nur jeder gegne jeden gespielt";
        $modu->save();

        $modu = new Modus();
        $modu->name="KO";
        $modu->description="Es wird direkt in die KO-Phase gehen";
        $modu->save();

    }
}
