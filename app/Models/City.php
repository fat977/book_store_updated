<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];

    public function regions(){
        return $this->hasMany(Region::class,'city_id')
        ->select('id','city_id','name');
    }
}
