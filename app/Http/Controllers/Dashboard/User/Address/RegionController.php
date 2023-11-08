<?php

namespace App\Http\Controllers\Dashboard\User\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\Address\RegionRequest;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $regions = Region::with('city')->get();
        return view('dashboard.users.addresses.regions.index',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cities = City::select('id','name')->where('status',1)->get();
        return view('dashboard.users.addresses.regions.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionRequest $request)
    {
        //
        Region::create([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar,
            ],
            'city_id'=>$request->city_id,
            'status'=>$request->status
        ]);
        flash()->addSuccess('Region is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.regions.index');
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
        $region = Region::findOrFail($id);
        $cities = City::query()->where('status',1)->get();
        return view('dashboard.users.addresses.regions.edit',compact('region','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionRequest $request, $id)
    {
        //
        $region = Region::findOrFail($id);
        $region->update([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar,
            ],
            'city_id'=>$request->city_id,
            'status'=>$request->status
        ]);
        flash()->addSuccess('Region is updated successfully');
       
        return redirect()->route('admin.regions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $region = Region::findOrFail($id);
        $region->delete();
        flash()->addSuccess('Region is deleted successfully');
       
        return redirect()->route('admin.regions.index');
    }
}
