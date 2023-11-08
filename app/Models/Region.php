<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Region extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];

    public function addresses(){
        return $this->hasMany(Address::class,'region_id')
        ->select('id','region_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}
