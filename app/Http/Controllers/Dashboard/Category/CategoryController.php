<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        //
        $categories = $this->categoryService->getCategories();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        //$data = $request->validated();
        Category::create([
            'name'=> [
                'en' => $request->name_en,
                'ar'=> $request->name_ar
            ],
            'status'=> $request->status
            ]);
        //$this->categoryService->createCategory($data);
        flash()->addSuccess('Category is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.categories.index');
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
        $category = $this->categoryService->getCategoryById($id);
        return view('dashboard.categories.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        $category = $this->categoryService->getCategoryById($id);
        $category->update([
                'name'=> [
                    'en' => $request->name_en,
                    'ar'=> $request->name_ar
                ],
                'status'=> $request->status
            ]);
        /* $data = $request->validated();
        $this->categoryService->updateCateory($id,$data); */
        flash()->addSuccess('Category is updated successfully');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->categoryService->deleteCategory($id);
        flash()->addSuccess('Category is deleted successfully');
        return redirect()->back();
    }
}
