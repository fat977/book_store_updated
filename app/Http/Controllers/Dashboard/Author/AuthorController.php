<?php

namespace App\Http\Controllers\Dashboard\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Author\AuthorRequest;
use App\Http\Requests\Dashboard\Author\UpdateAuthorRequest;
use App\Http\traits\media;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use media;
    public $authorService;
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    public function index()
    {
        //
        $authors = $this->authorService->getAuthors();
        return view('dashboard.authors.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        //
        if($request->hasFile('image')){
            $image = $this->uploadImage($request->image,'public/authors');
        }
        Author::create([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar
            ],
            'bio'=>[
                'en'=>$request->bio_en,
                'ar'=>$request->bio_ar
            ],
            'status'=>$request->status,
            'image'=>$image
        ]);

        flash()->addSuccess('Author is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.authors.index');
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $lang = App::currentLocale();
        $author = $this->authorService->getAuthorById($id);
        //json_decode($author->name,true);
        //dd($author->name);
        return view('dashboard.authors.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, $id)
    {
        //
        $author = $this->authorService->getAuthorById($id);
        if ($request->hasFile('image')) {
            // delete image
            if ($author->image != null) {
                Storage::disk('local')->delete('public/authors/' . $author->image);
            }

            $image = $this->uploadImage($request->image,'public/authors');
            $author->update(['image'=>$image]);
        }
        $author->update([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar
            ],
            'bio'=>[
                'en'=>$request->bio_en,
                'ar'=>$request->bio_ar
            ],
            'status'=>$request->status,
        ]);

        flash()->addSuccess('Author is updated successfully');
        return redirect()->route('admin.authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->authorService->deleteAuthor($id);
        flash()->addSuccess('Author is deleted successfully');
        return redirect()->back();
    }
}
