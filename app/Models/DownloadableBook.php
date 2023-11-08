<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class DownloadableBook extends Model
{
    use HasFactory , HasTranslations;
    protected $guarded = [];
    public $translatable = ['name','desc','publisher'];
    
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function author(){
        return $this->belongsTo(Author::class,'author_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'reacts')->withPivot('like','dislike')->withTimestamps();
    }

    public function users_downloads(){
        return $this->belongsToMany(User::class,'downloads')->withTimestamps();
    }
}
