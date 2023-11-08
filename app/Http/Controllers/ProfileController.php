<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileAddressRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = User::with('addresses')->find(Auth::user()->id);
        
        $cities = City::with('regions')->where('status',1)->get();
        $regions = Region::with('city')->where('status',1)->get();
        //dd($regions);
        return view('profile.edit', [
            'user' => $request->user(),
            'cities'=>$cities,
            'regions'=>$regions,
            'user'=>$user
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        flash()->addSuccess('Profile is updated successfully');
        return Redirect::route('profile.edit');
    }

    public function updateAddress(ProfileAddressRequest $request){
        $data = $request->except('_token','_method');
        $address = Address::query()->where('user_id',Auth::user()->id)->first();
        if($address){
            $address->user_id =Auth::user()->id;
            $address->region_id =$data['region_id'];
            $address->street =$data['street'];
            $address->building =$data['building'];
            $address->floor =$data['floor'];
            $address->note =$data['note'];
            $address->save();
        }else{
            Address::create([
                'user_id' =>Auth::user()->id,
                'region_id' =>$data['region_id'],
                'street' =>$data['street'],
                'building' =>$data['building'],
                'floor' =>$data['floor'],
                'note' =>$data['note'],
            ]);
        }
       
        flash()->addSuccess('Address is updated successfully');
        return redirect()->back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
