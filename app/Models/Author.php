<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Author extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];
    public $translatable = ['name','bio'];
}
