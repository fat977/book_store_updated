<?php

namespace App\Http\Controllers\Dashboard\User\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\Address\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cities = City::all();
        return view('dashboard.users.addresses.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.users.addresses.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        //
        City::create([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar,
            ],
            'shipping'=>$request->shipping,
            'status'=>$request->status
        ]);
        flash()->addSuccess('City is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.cities.index');
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
        $city = City::findOrFail($id);
        return view('dashboard.users.addresses.cities.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, $id)
    {
        //
        $city = City::findOrFail($id);
        $city->update([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar,
            ],
            'shipping'=>$request->shipping,
            'status'=>$request->status
        ]);
        flash()->addSuccess('City is updated successfully');
       
         return redirect()->route('admin.cities.index');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $city = City::findOrFail($id);
        $city->delete();
        flash()->addSuccess('City is deleted successfully');
        return redirect()->back();
    }
}
