<?php

namespace App\Http\Controllers\API\Book\Purchased;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchasedBookResource;
use App\Services\PurchasedBookService;
use Illuminate\Http\Request;

class PurchasedBookController extends Controller
{
    public $purchasedBookService;
    public function __construct(PurchasedBookService $purchasedBookService)
    {
        $this->purchasedBookService = $purchasedBookService;
    }
    public function index()
    {
        //
        $purchasedBooks = $this->purchasedBookService->getPurchasedBooks();
        $books = PurchasedBookResource::collection($purchasedBooks);
        return response()->json(['message'=>'','errors'=> "",'data'=>compact('books')],201);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
