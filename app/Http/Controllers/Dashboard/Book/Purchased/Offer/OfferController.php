<?php

namespace App\Http\Controllers\Dashboard\Book\Purchased\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Book\Offer\OfferRequest;
use App\Models\Offer;
use App\Services\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $offerService;
    public function __construct(OfferService $offerService)
    {
        $this->offerService =$offerService;
    }
    public function index()
    {
        //
        $offers = $this->offerService->getOffers();
        return view('dashboard.books.purchased_books.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.books.purchased_books.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {
        //
        Offer::create([
            'title'=>[
                'en'=>$request->title_en,
                'ar'=>$request->title_ar
            ],
            'discount'=>$request->discount,
            'start_at'=>$request->start_at,
            'end_at'=>$request->end_at
        ]);
        flash()->addSuccess('Offer is created successfully');
        if($request->page =='back'){
            return redirect()->back();
        }else{
            return redirect()->route('admin.offers.index');
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
        $offer = $this->offerService->getOfferById($id);
        return view('dashboard.books.purchased_books.offers.edit',compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, $id)
    {
        //
        $offer = $this->offerService->getOfferById($id);
        $offer->update([
            'title'=>[
                'en'=>$request->title_en,
                'ar'=>$request->title_ar
            ],
            'discount'=>$request->discount,
            'start_at'=>$request->start_at,
            'end_at'=>$request->end_at
        ]);
        flash()->addSuccess('Offer is updated successfully');
        return redirect()->route('admin.offers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->offerService->deleteOffer($id);
        flash()->addSuccess('Offer is deleted successfully');
        return redirect()->back();
    }
}
