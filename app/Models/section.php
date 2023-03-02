<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    public function class (){
        return $this->belongsTo(classroom::class,"classroom_id","id");
    }
    public function grade (){
        return $this->belongsTo(grade::class,"Grade_id","id");
    }

}
