<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    use HasFactory;
    protected $fillable =[
        "id","name","notes"
    ];
    public function classrooms (){
        return $this->hasMany(classroom::class,"Grade_id","id");
    }
    public function sections (){
        return $this->hasMany(section::class,"Grade_id","id");
    }
    
}
