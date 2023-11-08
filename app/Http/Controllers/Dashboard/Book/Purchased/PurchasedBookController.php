<?php

namespace App\Http\Controllers\Dashboard\Book\Purchased;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Book\Purchased\StorePurchasedBookRequest;
use App\Http\Requests\Dashboard\Book\Purchased\UpdatePurchasedBookRequest;
use App\Http\traits\media;
use App\Models\Author;
use App\Models\Category;
use App\Models\PurchasedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\PurchasedBookService;

class PurchasedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use media;
    public $purchasedBookService;
    public function __construct(PurchasedBookService $purchasedBookService)
    {
        $this->purchasedBookService = $purchasedBookService;
    }
    public function index()
    {
        //
        $purchasedBooks = $this->purchasedBookService->getPurchasedBooks();
        return view('dashboard.books.purchased_books.index',compact('purchasedBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $authors = Author::select('id','name')->where('status',1)->get();
        $categories = Category::select('id','name')->where('status',1)->get();
        return view('dashboard.books.purchased_books.create',compact('authors','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchasedBookRequest $request)
    {
        //
        //$data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->uploadImage($request->image,'public/purchasedBooks');
        }
        PurchasedBook::create([
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
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'released_date'=>$request->released_date,
            'category_id'=>$request->category_id,
            'author_id'=>$request->author_id,
            'image'=>$image
        ]);
        flash()->addSuccess('Book is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.purchased_books.index');
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $purchasedBook = $this->purchasedBookService->getPurchasedBookById($id);
        return view('dashboard.books.purchased_books.show',compact('purchasedBook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $purchasedBook = $this->purchasedBookService->getPurchasedBookById($id);
        $authors = Author::select('id','name')->where('status',1)->get();
        $categories = Category::select('id','name')->where('status',1)->get();
        return view('dashboard.books.purchased_books.edit',compact('purchasedBook','authors','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchasedBookRequest $request,$id)
    {
        //
        $purchasedBook = $this->purchasedBookService->getPurchasedBookById($id);
        if ($request->hasFile('image')) {
            // delete image
            if ($purchasedBook->image != null) {
                Storage::disk('local')->delete('public/purchasedBooks/' . $purchasedBook->image);
            }

            $image = $this->uploadImage($request->image,'public/purchasedBooks');
            $purchasedBook->update(['image'=>$image]);
        }
        $purchasedBook->update([
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
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'author_id'=>$request->author_id,
            'quantity'=>$request->quantity,
            'released_date'=>$request->released_date,
        ]);
        flash()->addSuccess('Book is updated successfully');
        return redirect()->route('admin.purchased_books.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->purchasedBookService->deletePurchasedBook($id);
        flash()->addSuccess('Book is deleted successfully');
        return redirect()->back();
    }
}
