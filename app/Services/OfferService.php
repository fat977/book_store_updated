<?php
namespace App\Services;

use App\Models\Offer;

class OfferService{

    public function getOffers(){
        return Offer::all();
    }

    public function getOfferById($id){
        return Offer::findOrFail($id);
    }

    public function deleteOffer($id){
        $offer = $this->getOfferById($id);
        $offer->delete();
    }
}