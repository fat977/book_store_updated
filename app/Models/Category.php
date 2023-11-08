<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];

    public static function categories(){
        $getCategories = Category::query()->where('status',1)->get();
        return $getCategories;
    }
}
