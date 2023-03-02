<?php

namespace Database\Seeders;

use App\Models\Bloodtype as ModelsBloodtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Bloodtype extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("bloodtypes")->delete();
        $types = ["A+","A-","B+","B-","O-", "O+","AB"];
        foreach($types as $type){
            ModelsBloodtype::create(
                ["name" =>$type]
            );
        }

    }
}
