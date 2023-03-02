<?php

namespace Database\Seeders;

use App\Models\religino;
use App\Models\religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class religion_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table("religions")->delete();
       $religions = ["muslim","christian","other"];
       foreach($religions as $re){

           religion::create(
            ["name" => $re ]
           );
       }
    }
}
