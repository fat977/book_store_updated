<?php
namespace App\Services;

use App\Models\DownloadableBook;
use Illuminate\Support\Facades\Storage;

class DownloadableBookService{
    
    public function getDownloadableBooks(){
        return DownloadableBook::with('category','author')->get();
    }

    public function getDownloadableBookById($id){
        return DownloadableBook::findOrFail($id);
    }

    public function deleteDownloadableBook($id){
        $DownloadableBook = $this->getDownloadableBookById($id);
        if($DownloadableBook->image != null){
            Storage::disk('local')->delete('public/downloadedBook/images/'.$DownloadableBook->image);
        }
        if($DownloadableBook->file != null){
            Storage::disk('local')->delete('public/downloadedBook/files/'.$DownloadableBook->file);
        }
        $DownloadableBook->delete();
    }
}