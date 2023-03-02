<?php

namespace Database\Seeders;

use App\Models\nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class nationality_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("nationalities")->delete();
        $nationality = ["egyptian","syrian","sauidian","american"];
        foreach($nationality as $n){
            nationality::create(["name" => $n]);

        }

    }
}
