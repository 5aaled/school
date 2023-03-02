<?php

namespace Database\Seeders;

use App\Models\gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class genderseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("genders")->delete();
        $types = ["male","female"];
        foreach($types as $type){
           gender::create(
                ["Name" =>$type]
            );
        }
    }
}
