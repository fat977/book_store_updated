<?php

namespace App\Http\Controllers\Dashboard\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Banner\BannerRequest;
use App\Http\Requests\Dashboard\Banner\UpdateBannerRequest;
use App\Http\traits\media;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $banners = Banner::all();
        return view('dashboard.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        //
        if($request->hasFile('image')){
            $image = $this->uploadImage($request->image,'public/banners');
        }
        Banner::create([
            'image'=>$image,
            'title'=>[
                'en'=>$request->title_en,
                'ar'=>$request->title_ar
            ],
            'status'=>$request->status
        ]);
        flash()->addSuccess('Banner is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.banners.index');
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
        $banner = Banner::findOrFail($id);
        return view('dashboard.banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request,$id)
    {
        //
        $banner = Banner::findOrFail($id);       
        if($request->hasFile('image')){
            if($banner->image != null){
                Storage::disk('local')->delete('public/banners/'.$banner->image);
            }
            $image = $this->uploadImage($request->image,'public/banners');
            $banner->update(['image' => $image]);
        }
        $banner->update([
            'title'=>[
                'en'=>$request->title_en,
                'ar'=>$request->title_ar
            ],
            'status'=>$request->status
        ]);
        flash()->addSuccess('Banner is updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $banner = Banner::findOrFail($id);
        if($banner->image != null){
            Storage::disk('local')->delete('public/banners/'.$banner->image);
        }
        $banner->delete();
        flash()->addSuccess('Banner is deleted successfully');
        return redirect()->back();
    }
}
