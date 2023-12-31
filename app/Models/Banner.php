<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Banner extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded = [];
    public $translatable = ['title'];

    public static function banners(){
        $banners = Banner::query()->where('status',1)->get();
        return $banners;
    }
}
