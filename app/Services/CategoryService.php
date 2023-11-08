<?php
namespace App\Services;

use App\Models\Category;

class CategoryService {

    public function getCategories(){
        return Category::all();
    }

    public function getCategoryById($id){
        return Category::findOrFail($id);
    }

/*     public function createCategory($data){
        return Category::create($data);
    }

    public function updateCateory($id,$data){
        $category = $this->getCategoryById($id);
        $category->update($data);
        return $category;
    } */

    public function deleteCategory($id){
        $category = $this->getCategoryById($id);
        $category->delete();
    }
}