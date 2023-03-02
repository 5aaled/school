<?php

namespace Database\Seeders;

use App\Models\specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class specializationseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("specializations")->delete();
        $types = ['arabic','science','computer','english'];
        foreach($types as $type){
           specialization::create(

                ["Name" =>$type]
            );
        }
    }
}
