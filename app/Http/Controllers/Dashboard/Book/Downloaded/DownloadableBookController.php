<?php

namespace App\Http\Controllers\Dashboard\Book\Downloaded;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Book\Downloaded\StoreDownloadableBookRequest;
use App\Http\Requests\Dashboard\Book\Downloaded\UpdateDownloadableBookRequest;
use App\Http\traits\media;
use App\Models\Author;
use App\Models\Category;
use App\Models\DownloadableBook;
use App\Services\DownloadableBookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadableBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use media;
    public $downloadableBookService;
    public function __construct(DownloadableBookService $downloadableBookService)
    {
        $this->downloadableBookService = $downloadableBookService;
    }
    public function index()
    {
        //
        $downloadableBooks = $this->downloadableBookService->getDownloadableBooks();
        return view('dashboard.books.downloadable_books.index',compact('downloadableBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $authors = Author::select('id','name')->where('status',1)->get();
        $categories = Category::select('id','name')->where('status',1)->get();
        return view('dashboard.books.downloadable_books.create',compact('authors','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDownloadableBookRequest $request)
    {
        //
        $data =$request->validated();
        if($request->hasFile('image')){
            $image = $this->uploadImage($request->image,'public/downloadedBook/images');
        }
        if($request->hasFile('file')){
            $file = $this->uploadFile($request->file,'public/downloadedBook/files');
        }
        DownloadableBook::create([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar
            ],
            'desc'=>[
                'en'=>$request->desc_en,
                'ar'=>$request->desc_ar
            ],
            'publisher'=>[
                'en'=>$request->publisher_en,
                'ar'=>$request->publisher_ar
            ],
            'status'=>$request->status,
            'released_date'=>$request->released_date,
            'category_id'=>$request->category_id,
            'author_id'=>$request->author_id,
            'image'=>$image,
            'file'=>$file,
            'size'=>$request->size,
            'no_pages'=>$request->no_pages
        ]);
        flash()->addSuccess('Book is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.downloadable_books.index');
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $downloadableBook = $this->downloadableBookService->getDownloadableBookById($id);
        return view('dashboard.books.downloadable_books.show',compact('downloadableBook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $downloadableBook = $this->downloadableBookService->getDownloadableBookById($id);
        $authors = Author::select('id','name')->where('status',1)->get();
        $categories = Category::select('id','name')->where('status',1)->get();
        return view('dashboard.books.downloadable_books.edit',compact('downloadableBook','authors','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDownloadableBookRequest $request,$id)
    {
        $downloadableBook = $this->downloadableBookService->getDownloadableBookById($id);
        if ($request->hasFile('image')) {
            // delete image
            if ($downloadableBook->image != null) {
                Storage::disk('local')->delete('public/downloadedBook/images/' . $downloadableBook->image);
            }

            $image = $this->uploadImage($request->image,'public/downloadedBook/images');
            
            $downloadableBook->update(['image'=>$image]);
        }
        if ($request->hasFile('file')) {
            // delete file
            if ($downloadableBook->file != null) {
                Storage::disk('local')->delete('public/downloadedBook/files/' . $downloadableBook->file);
            }

            $file = $this->uploadFile($request->file,'public/downloadedBook/files');
            $downloadableBook->update(['file'=>$file]);
        }
        $downloadableBook->update([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar
            ],
            'desc'=>[
                'en'=>$request->desc_en,
                'ar'=>$request->desc_ar
            ],
            'publisher'=>[
                'en'=>$request->publisher_en,
                'ar'=>$request->publisher_ar
            ],
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'author_id'=>$request->author_id,
            'released_date'=>$request->released_date,
            'size'=>$request->size,
            'no_pages'=>$request->no_pages
        ]);
        flash()->addSuccess('Book is updated successfully');
        return redirect()->route('admin.downloadable_books.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->downloadableBookService->deleteDownloadableBook($id);
        flash()->addSuccess('Book is deleted successfully');
        return redirect()->back();
    }
}
