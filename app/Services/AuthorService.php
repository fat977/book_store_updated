<?php
namespace App\Services;

use App\Models\Author;
use Illuminate\Support\Facades\Storage;

class AuthorService {

    public function getAuthors(){
        return Author::all();
    }

    public function getAuthorById($id){
        return Author::findOrFail($id);
    }

/*     public function createAuthor($data){
        return Author::create($data);
    }

    public function updateAuthor($id,$data){
        $author = $this->getAuthorById($id);
        $author->update($data);
        return $author;
    } */

    public function deleteAuthor($id){
        $author = $this->getAuthorById($id);
        if($author->image != null){
            Storage::disk('local')->delete('public/authors/'.$author->image);
        }
        $author->delete();
    }
}