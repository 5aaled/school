<?php

namespace App\Models;

use App\Http\Requests\Grade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class classroom extends Model
{
    use HasFactory;
    protected $fillable =[
        "id","name","Grade_id"
    ];
    public function Grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

}
