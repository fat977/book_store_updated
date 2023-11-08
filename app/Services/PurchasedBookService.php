<?php
namespace App\Services;
use App\Models\PurchasedBook;
use Illuminate\Support\Facades\Storage;

class PurchasedBookService{
    
    public function getPurchasedBooks(){
        return PurchasedBook::with('category','author')->get();
    }

    public function getPurchasedBookById($id){
        return PurchasedBook::findOrFail($id);
    }

    public function deletePurchasedBook($id){
        $purchasedBook = $this->getPurchasedBookById($id);
        if($purchasedBook->image != null){
            Storage::disk('local')->delete('public/purchasedBooks/'.$purchasedBook->image);
        }
        $purchasedBook->delete();
    }
}