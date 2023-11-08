<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Address extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
